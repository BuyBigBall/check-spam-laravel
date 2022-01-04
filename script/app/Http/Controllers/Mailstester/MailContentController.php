<?php

namespace App\Http\Controllers\Mailstester;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use App\Models\Settings;
use App\Models\TrashMail;
use App\Models\TestResult;
use App\Models\WhiteLabel;
use App\Models\Balance;
use App\Models\Visitor;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\MicroPayment;

use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;

use App\Models\Menu;
use \Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Models\Language;
use DomDocument;
use SimpleXMLElement;
use Exception;
use SPFLib\Term\Mechanism;
use Vinkla\Hashids\Facades\Hashids;
use App\Http\Controllers\Mailstester\SpamAssassin;

class MailContentController extends Controller
{
    function save_test_count_for_free_user($email, $mail_id=0)
    {
        $user_ip = $_SERVER['REMOTE_ADDR'];
        if($mail_id==0 || $user_ip=='127.0.0.1' || $user_ip=='::1') return;
        $visitor = Visitor::where(['user_ip'=>$user_ip, 'mail_id'=>$mail_id])->first();
        if($visitor!=null)
        {
            Visitor::find($visitor->id)->update(['test_count' => $visitor->test_count+1 ]);
        }
        else
        {
            $visitor = [
                'user_ip'   =>  $user_ip,
                'test_count'=>  1,
                'test_email'=>  $email,
                'mail_id'   =>  $mail_id
            ];
            Visitor::create($visitor);
        }

        if (Auth::guard(null)->check()) {
            $user_id = Auth::user()->id;
            $db_hist = Balance::where(['supply'=>'>used', 'user_id'=>$user_id])->orderBy('id')->first();
            if($db_hist!=null)
            {
                $db_hist_id = $db_hist->id;
                Balance::where('id', $db_hist_id)->update('used' ,$db_hist->used+1);
            }
        }
    }

    function check_test_count_for_free_user()
    {
        Session::put('could_not_use_by_paid_user', '');
        $paid_user_flag = false;
        if (Auth::guard(null)->check()) {
            $user_id = Auth::user()->id;
            $db_hist = Balance::where(['supply'=>'>used', 'user_id'=>$user_id])->first();
            if($db_hist==null)
            {
                $paid_user_flag = true;
            }
        }
        $could_not_use = false;
        if(!$paid_user_flag)
        {
            $user_ip = $_SERVER['REMOTE_ADDR'];
            $test_total = Visitor::select('user_ip', Visitor::raw('count(*) as total'))
                            ->groupBy('user_ip')
                            ->where(['user_ip'=>$user_ip])
                            ->get();
            if( $test_total!=null && 
                $test_total->first()!=null && 
                $test_total->first()->total >= env('MAX_FREETEST_COUNT') && env('MAX_FREETEST_COUNT')>0 )
            {
                $could_not_use = true;
            }
        }

        return $could_not_use;
    }

	private function check_test_micropayment_user(Request $request)
    {
        $mailbox = !empty($request->mailbox) ? $request->mailbox : (!empty(session('mailbox')) ? session('mailbox') : null);
        if( empty($mailbox ) )
		{
			return true;
		}
		$mailbox = explode('@', $mailbox)[0] .'@'. env('MAIL_HOST');
        $mail_address = TrashMail::where('email', $mailbox)->first();
        
        if($mail_address==null)     return false;
        if($mail_address->user==null) return false;

        $owner_id = $mail_address->user->id;
        $email_id = $mail_address->id;
		
		if($mail_address->useroption==null) return false;
        if($mail_address->useroption->use_micropay)
        {
            $query = MicroPayment::where('user_id', $owner_id)
                        ->where('email_id', $email_id)
                        ->where('guest_email', $request->guest_email)
                        ->where(DB::raw('supply_count-use_count'),'>', 0);
			
			$MicroPayment = $query->first();
            if($MicroPayment!=null)
            {
                MicroPayment::where('id', $MicroPayment->id)->update(['use_count'=>$MicroPayment->use_count+1]);
                return false;                
            }
            
            $query = MicroPayment::where('user_id', $owner_id)
                        ->where('email_id', $email_id)
                        ->where('guest_email', $request->guest_email)
                        ->where(DB::raw('expire_date - TIMESTAMPDIFF(HOUR, charge_date, now())'), '>=', '0');
			
			$MicroPayment = $query->first();
            if($MicroPayment!=null)
            {
                MicroPayment::where('id', $MicroPayment->id)->update(['use_count'=>$MicroPayment->use_count+1]);
                return false;                
            }
            else
                return true;
            
        }
        return false;
    }

    #show /testresult page
    public function TestResultView(Request $request)
    {
        $mail_id = 0;
        $mailbox = !empty($request->mailbox) ? $request->mailbox : (!empty(session('mailbox')) ? session('mailbox') : null);
		$email = explode('@', $mailbox)[0] .'@'. env('MAIL_HOST');
		//dd($mailbox);
        if(empty($mailbox)) return redirect(route('home') );

        $Hash_id = $request->input('message_id');
        if( !empty($request->input('mail_id')))
        {
            $mail_id     = $request->input('mail_id');
            $Hash_id      = Hashids::encode($request->input('mail_id'));
        }
        if( !empty($Hash_id))
        {
            $id_hash = Hashids::decode($Hash_id);
            if(empty($id_hash) || !is_array($id_hash) || count($id_hash)==0) abort(419);
            $mail_id     = $id_hash[0];
        }
        // http://localhost/testresult?mail_id=35&mailbox=yakov.757
        //dd($request);
        if( ($could_not_use=$this->check_test_micropayment_user($request) ))
        {
            Session::put('could_not_use_by_paid_user', 'You have expired the micro-payment limit.');
            return redirect(route('checkout-micropay').'?message_id='.$Hash_id )
                            ->with('mailbox', $email);
        }
        
        if( ($could_not_use=$this->check_test_count_for_free_user() ))
        {
            Session::put('could_not_use_by_paid_user', 'You have exceeded the free user limit.');
            return redirect(route('prices'));
        }
        
        
        $this->save_test_count_for_free_user($email, $mail_id);
        
        $score = null;
        $response = [];
        $json_array = [];
        $json_object = null;
        $to_email = $email;
        $json_string = '';
		
            $db_hist = \App\Models\TestResult::where(['mail_id'=>$mail_id])->first();
            
            if($db_hist!=null)
            {
                $response['header'] = $db_hist->header;
                $response['subject']= $db_hist->subject;
                $response['is_seen'] = 1;
                $response['from'] = $db_hist->name;
                $response['from_email'] = $db_hist->email;
                $response['receivedAt'] = $db_hist->received_at;
                $response['id'] = $Hash_id;
				$response['no'] = $mail_id;
                $response['attachments'] = [];
                $response['content'] = $db_hist->content;
                $response = [$response];
                $json_string = $db_hist->json;
            }
            
            // #############   get mail object from inbox   ##############
            // for test ===>
            if( $_SERVER['HTTP_HOST']=='localhost')  
            {
                $db_hist=null;
                $json_string = '';
            }
            //<----------- for test

            if( $db_hist==null  ) // && (empty($request->input('flag')) || $request->input('flag')!='whitelabel' )
            {
                if($_SERVER['HTTP_HOST']!='localhost')
                {
                    $response = TrashMail::messages($email, $Hash_id);
                }

                if( empty($response['messages'])  && count($response)>0 )
                {
                    $response = $response[0];
                }
                else
                {
                    if($request->input('flag')!==null && $request->input('flag')=='whitelabel' )
                        {
                            $response['subject'] = 'test for whitlabel';
                            $response['is_seen'] = 0;
                            $response['from'] = 'from whitlabel';
                            $response['from_email'] = 'test@test.com';
                            $response['receivedAt'] = date('Y-m-d H:i:s');
							$response['id'] = $Hash_id;
							$response['no'] = $mail_id;
                            $response['attachments'] = [];
                            $response['content'] = 'test email for whitelabel';
                            $response['header'] = '';
                            $response['json'] = '';
                            //$response = [$response];
                        }
                    else
                        abort(419);
                    
                }
                
                if(empty($json_string))
                $json_array = MailContentController::GetJsonArray( $email ,  $response, $mail_id);
            }
		    if(empty($json_string) && empty($json_array) && !empty($response))
                $json_array = MailContentController::GetJsonArray( $email ,  $response, $mail_id);
            // ############################################################
            
		//dd($json_array);
        if(empty($json_string) && count($json_array)>0) $json_string = json_encode($json_array);
        
        $json_object = json_decode($json_string);
        
        if($request->input('flag')!='whitelabel' )
        {
            //$auth_SPDcheck   = SpamAssassin::getSPFcheck($response['header'], $auth_rDnsInfo, $response['from_email'] );

            if(!empty($response) && !empty($response[0])) $response = $response[0];
            $guard = null;
            if (Auth::guard($guard)->check()) {
                $user_id   = Auth::user()->id;
                $user_name = Auth::user()->name;
                $user_email= Auth::user()->email;
			}      
			else
			{
                $user_id   = 0;
                $user_name = '';
                $user_email= '';
			}

            $mail_id   = $response['no'];
            if($db_hist==null)
            {
                $message_result = [
                    'mail_id' =>    $mail_id,
                    'user_id' =>    $user_id,
                    'name' =>       $user_name ,
                    'email' =>      $user_email,
                    'receiver'=>    $to_email,
                    'sender' =>     $response['from_email'],
                    'tested_at' =>  date('Y-n-d H:i:s', time()),
                    'received_at' =>$response['receivedAt'],
                    'subject' =>    $response['subject'],
                    'header' =>     $response['header'],
                    'content' =>    $response['content'],
                    'score' =>      $json_object->mark,
                    'json' =>       $json_string ,
                ];
                $db_hist =  TestResult::create($message_result);
            }
            else if( !!empty($db_hist->tested_at) )
            {
                TestResult::find($db_hist->id)->update([
                    'tested_at' =>  date('Y-n-d H:i:s', time()),
                    'user_id' =>    $user_id,
                    'name' =>       $user_name ,
                    'email' =>      $user_email,
                ]);
                //'user_id' =>    1,      //now admin 
                //'name' =>       "admin" ,
                //'email' =>      $email,

            }
        }
            
        ################# whitelabel style ################
        $css = '';$guard = null;
        if (Auth::guard($guard)->check()) {
            $user_id = Auth::user()->id;
            $whitelabel = WhiteLabel::where(['user_id'=>$user_id, 'active'=>1] )->get();
            if($whitelabel->first()!==null)
            {
                $css = $whitelabel->first()->css;
            }
        }
		
		##### whitelabel style preview
        if($request->input('flag')!==null && $request->input('flag')=='whitelabel' )
        {
            $css = $request->input('css');
        }
        
        ################### return view ##################
        
        //dd($json_object->blacklists);
        Session::put('mail_body_html', $response['content']);
        $total_score = 10 - $json_object->mark;
        return view('mailstester.testresult')
            ->with('mail_id',       $Hash_id)
            ->with('broken_urls',   !empty($json_object->links) ? $json_object->links->urls : [] )       //['url'=>, 'score'=>]
            ->with('broken_score',  !empty($json_object->links) ? $json_object->links->mark : 0 )
            ->with('css',           $css)
            ->with('email',         $to_email )
			->with('ago_time',		agotime( $json_object->messageInfo->dateReceived ))
			->with('score_rules',   $json_object->spamAssassin->rules )
			->with('assassin_score',$json_object->spamAssassin->score )
			->with('total_score', 	$total_score )
            ->with('black_list_score', !empty($json_object->blacklists) ? $json_object->blacklists->mark : 0)
            ->with('bl_score_unit', SpamAssassin::$bl_score_unit)
			->with('server_auth',   $json_object->signature )
            ->with('BL_results',    $json_object->blacklists )
            ->with('BODY_check',    $json_object->body)
			->with('content_body',  $response['content'] )
			->with('content_header',$response['header'] )
			->with('message',       $json_object->messageInfo );
    }

    public function mail_body_html()
    {
		
        $email_body = '';
        if (Session::has('mail_body_html')) 
        {
			$email_body =  Session::get('mail_body_html');
        }
        print($email_body);die;
    }

    public function mail_body_html_noimg()
    {
        $email_body = '';
        if (Session::has('mail_body_html')) 
        {
		$email_body = preg_replace("/<img[^>]+>/", "", Session::get('mail_body_html') ); 
        }
        print($email_body);die;
    }

    public static function GetJsonArray($email, $inbox_object, $mail_id)
    {
        if( !empty($inbox_object) && !empty($inbox_object[0])) $inbox_object = $inbox_object[0];
        $mailheader = $inbox_object['header'];
        $mailbody = $inbox_object['content'];
        $assassin_score = SpamAssassin::GetSpamAssassinScore($mailheader);
        
        $array_object                   = SpamTestJson::get_email_array($email, $mail_id,  $assassin_score, $inbox_object);
        $array_object['spamAssassin']   = SpamTestJson::get_spamassassin_array($mailheader, $assassin_score);
        $from_email                     = $array_object['messageInfo']['bounceAddress'];
        $auth_serverInfo                = SpamAssassin::getserverauth( $mailheader );
        $array_object['signature']      = SpamTestJson::get_signature_array($mailheader, $auth_serverInfo, $from_email);
        $array_object['signature']['serverip'] = $auth_serverInfo['serverip'];                
        $array_object['body']           = SpamTestJson::get_mailbody_array($mailbody, $from_email);
        if( $_SERVER['HTTP_HOST']!='localhost')
        {
            $array_object['blacklists']     = SpamTestJson::get_blacklist_array($auth_serverInfo['serverip'], $from_email);
            $array_object['links']          = SpamTestJson::get_brokenlinks_array($mailbody, $from_email);
        }


        // Summery =>
        $score = $inbox_object!=null ? $assassin_score : 0;
        $score += $array_object['signature']['mark'];
        if( $_SERVER['HTTP_HOST']!='localhost')
        {
            $score += $array_object['blacklists']['mark'];
            $score += $array_object['links']['mark'];
        }
        $array_object["mark"] = $score;
        $array_object["maxMark"] = 10;
        $array_object["displayedMark"] = $inbox_object!=null ?  number_format(10 - $score, 1) .'/10' : "";

        $title = $inbox_object!=null ? 
        (
            (($score<=3.0) ?  __("Wow! Perfect, you can send") : 
            (($score<=5.0) ?  __("Good! you can send the mail") : 
            (($score<=6.0) ?  __("Warning! you cannot send the mail, but you can improve mail's content.") : 
                               __("critical! This is a special spam mail.")  
             )))
         ) : "Mail not found. Please wait a few seconds and try again.";
         
        $array_object["title"] = $title;
        // <== Summery
		
        return $array_object;
    }

    public function json($email)
    {
        $email_address = explode("@", $email)[0] . "@" . env("MAIL_HOST");
        $message_id = TrashMail::GetLastReceiveMail($email_address);

        if( !!empty($message_id))
        {
            print json_encode(['status'=>'0', 'title'=>'there is no any message received to ' . $email_address ]);
            return;
        }
        $id_hash = Hashids::decode($message_id);
        if(empty($id_hash) || !is_array($id_hash) || count($id_hash)==0) abort(419);
        $mail_id     = $id_hash[0];


        $inbox_object = TrashMail::messages($email_address, $message_id);
        $array_object = MailContentController::GetJsonArray($email_address, $inbox_object, $mail_id);
        $json_string  = json_encode($array_object);
        header("Content-Type: application/json");
		header("Accept: application/json");
        print($json_string); die;
    }
}

/**
 * Reports error during API RPC request
 */
// class ApiRequestException extends Exception {}

