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

// use Illuminate\Support\Str;
// use Carbon\Carbon;

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

class SpamTestController extends Controller
{
    // private $bl_score_unit = 0.5;
	// private $burl_score_unit = 0.5;

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
            // $query = DB::getQueryLog();
            // $query = end($query);
            // print_r($query); die;
            //print($test_total->first()->total); die;
        }

        return $could_not_use;
    }

	
    public function TestResultView(Request $request)
    {
        $mail_id = 0;
        $email = null; if (Cookie::has('email')) $email =  Cookie::get('email');
        $Hashid = $request->input('message_id');
        if( !empty($request->input('mail_id')))
        {
            $mail_id     = $request->input('mail_id');
            $Hashid      = Hashids::encode($request->input('mail_id'));
        }
        if( !empty($Hashid))
        {
            $id_hash = Hashids::decode($Hashid);
            if(empty($id_hash) || !is_array($id_hash) || count($id_hash)==0) abort(419);
            $mail_id     = $id_hash[0];
        }
        
        if( ($could_not_use=$this->check_test_count_for_free_user() ))
        {
            Session::put('could_not_use_by_paid_user', 'You have exceeded the free user limit.');
            return redirect('spamtest');
        }
        $this->save_test_count_for_free_user($email, $mail_id);
        
        $score = null;
        $response = [];
        $to_email = $email;

        $guard = null; $db_hist = null;
        if (Auth::guard($guard)->check()) 
        {
            $user_id = Auth::user()->id;
            
            $db_hist = \App\Models\TestResult::where(['mail_id'=>$mail_id, 'user_id'=>$user_id])->get()->first();
            if($db_hist!=null)
            {
                $response['header'] = $db_hist->header;
                $response['subject']= $db_hist->subject;
                $response['is_seen'] = 1;
                $response['from'] = $db_hist->name;
                $response['from_email'] = $db_hist->email;
                $response['receivedAt'] = $db_hist->received_at;
                $response['id'] = $mail_id;
                $response['attachments'] = [];
                $response['content'] = $db_hist->content;
                $response[] = $response;
            }
        }
        
        #############   get mail object from inbox   ##############
        if( $db_hist==null && (empty($request->input('flag')) || $request->input('flag')!='whitelabel' ))
        {
            $response = TrashMail::messages($email, $Hashid);
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
                        $response['id'] = $Hashid;
                        $response['attachments'] = [];
                        $response['content'] = 'test email for whitelabel';
                        $response['header'] = '';
                    }
                else
                    abort(419);
                
            }
    
            $score = new \palPalani\SpamassassinScore\SpamassassinScore();
        }
		############################################################

        $ago_time = agotime( $response['receivedAt'] );
                    //Cookie::queue('mail_body_html', $response['content'], 3);	//size error
		Session::put('mail_body_html', $response['content']);
        

        $score_report = ['score'=>0, 'report'=>null, 'rules'=>null];
        if( false && $score!=null)
        {
            $score_report = $score->getScore( '<header>'.$response['header'].'</header>' .'<subject>'.$response['subject'].'</subject>'  .'<body>'.SpamAssassin::getbody($response['content']).'</body>');
            if($score_report['success'])
            {
                foreach($score_report['rules'] as &$check_rule)
                {
                    if($check_rule['score']<0)  $check_rule['score'] = '-0.0';
                    $score_report['score'] += $check_rule['score'];
                }
            }
        }

        $score_report['score'] = SpamAssassin::GetSpamAssassinScore($response['header']);
		$score_rules     = SpamAssassin::GetSpamAssassinRules($response['header'], $remove_score);
        $score_report['score'] -= $remove_score;    // for example PYZOR_CHECK
        

		$mail_server_domain = explode('@', $response['from_email'])[1];
		
        //To check DMARC
		$dmark_results   = dns_get_record("_dmarc.".$mail_server_domain, DNS_TXT);
        
		$auth_serverInfo = SpamAssassin::getserverauth( $response['header'] );
		$auth_rDnsInfo   = SpamAssassin::getRDNSsign($response['header'], $auth_serverInfo );
        $auth_DMARCInfo  = SpamAssassin::getDMARCsign($response['header'], $mail_server_domain );
        $auth_DKIMInfo   = SpamAssassin::getDKIMsign($response['header'] );

        

        if($request->input('flag')!='whitelabel' )
        {
            $auth_SPDcheck   = SpamAssassin::getSPFcheck($response['header'], $auth_rDnsInfo, $response['from_email'] );
            $guard = null;
            if (Auth::guard($guard)->check()) {
                $user_id = Auth::user()->id;
                $user_name = Auth::user()->name;
                $mail_id = $response['id'];
                $email = Auth::user()->email;
                
                //$db_hist = TestResult::where(['mail_id'=>$mail_id, 'user_id'=>$user_id])->first();
                if($db_hist==null)
                {
					$message_result = [
                        'mail_id' =>    $mail_id,
                        'user_id' =>    $user_id,
                        'name' =>       $user_name ,
                        'email' =>      $email,
                        'receiver'=>    $to_email,
                        'sender' =>     $response['from_email'],
                        'tested_at' =>  date('Y-n-d H:i:s', time()),
                        'received_at' =>$response['receivedAt'],
                        'subject' =>    $response['subject'],
                        'header' =>     $response['header'],
                        'content' =>    $response['content'],
                        'score' =>      $score_report['score'],
                        // 'created_at' => time(),
                    ];
					//print_r($message_result); die;
                    $db_hist =  TestResult::create($message_result);
                }
            }
        }
        else
            $auth_SPDcheck   = ['auth_result'=>'', 'spf_record'=>[], 'spf_issues'=>'', 'dig-query'=>[] ];

            
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
        
        
		##################  blacklist ip cheking #################
        if(!empty($request->input('flag')) && $request->input('flag')=='whitelabel' )
            $bl_score_list = [];
        else
        {
            //dd($response);
            $bl_score_list = SpamAssassin::cheking_blacklist($auth_serverInfo['serverip']);	//'95.19.4.3');//
        }
		
        $black_list_score = array_sum($bl_score_list);
        $total_score = $score_report['score'];
		$total_score += $black_list_score;
		
        $BL_results = [];
        foreach($bl_score_list as $keyname=>$check_score)
        {
            $BL_results[ $keyname ] = [
                'url'   =>  SpamAssassin::$dnsbl_lookup[$keyname] , 
                'classname' => ($check_score==0) ? 'status-success' : (($check_score<1) ? 'status-warning' : 'status-failure'),
                'label' => ($check_score==0) ? 'Not Listed'     : (($check_score<1) ? 'Listed -0.1'      : 'Critical -1.0'),
                'score' => $check_score ];
        }
        
        ################### broken url cheking ###################
        // if(!empty($request->input('flag')) && $request->input('flag')=='whitelabel' )
        //     $broken_urls = [];
        // else
        {
            $broken_urls = SpamAssassin::check_broken_links( $response['content'] );	//"
            /*
            $broken_urls = SpamAssassin::check_broken_links( '<a href="https://example1.com">Test 1</a>
                                                        <a class="foo" id="bar" href="http://example2.com">Test 2</a>
                                                        <a onclick="foo();" id="bar" href="http://example3.com">Test 3</a>' );
            // */
        }
        $broken_score = 0;
        foreach($broken_urls as $row)
        {
            $broken_score += $row['score'];
        }
		$total_score += $broken_score;
        
		//dd($score_rules); 
        ################### return view ##################
        return view('mailstester.testresult')
            ->with('mail_id',       $Hashid)
            ->with('broken_urls',   $broken_urls)
            ->with('broken_score',  $broken_score)
            ->with('css',           $css)
            ->with('email',         $email )
			->with('ago_time',		$ago_time)
            // ->with('report', 	    $score_report['report'])
			// ->with('rules', 	    $score_report['rules'])
			->with('score_rules',   $score_rules)
			->with('score', 	    10 - $score_report['score'])
			->with('total_score', 	10 - $total_score)
            ->with('black_list_score', $black_list_score)
            ->with('bl_score_unit', SpamAssassin::$bl_score_unit)
			->with('server_auth',   $auth_serverInfo )
            ->with('dkim_auth',     $auth_DKIMInfo )
			->with('dmarc_auth',    $auth_DMARCInfo )
			->with('rdns_auth',     $auth_rDnsInfo )
			->with('spf_check',     $auth_SPDcheck )
            ->with('BL_results',    $BL_results )
			->with('message',       $response );
    }

    public function mail_body_html()
    {
		
        $email_body = '';
        if (Session::has('mail_body_html')) 
        {
            //$email_body =  Cookie::get('mail_body_html');
			$email_body =  Session::get('mail_body_html');
        }
        print($email_body);die;
    }

    public function mail_body_html_noimg()
    {
        $email_body = '';
        if (Session::has('mail_body_html')) 
        {
		// $email_body = preg_replace("/<img[^>]+\>/i", "(image) ", Session::get('mail_body_html') ); 
		$email_body = preg_replace("/<img[^>]+>/", "", Session::get('mail_body_html') ); 
        }
        print($email_body);die;
    }

    public function json($email)
    {
        $email_address = explode("@", $email)[0] . "@" . env("MAIL_HOST");
        $message_id = TrashMail::GetLastReceiveMail($email_address);
        $id_hash = Hashids::decode($message_id);
        if(empty($id_hash) || !is_array($id_hash) || count($id_hash)==0) abort(419);
        $mail_id     = $id_hash[0];


        $inbox_object = TrashMail::messages($email, $message_id);
        if( !empty($inbox_object) && count($inbox_object)>0) $inbox_object = $inbox_object[0];
        $mailheader = $inbox_object['header'];
        $mailbody = $inbox_object['content'];
        $assassin_score = SpamAssassin::GetSpamAssassinScore($mailheader);

        $array_object                   = SpamTestJson::get_email_array($email, $mail_id,  $assassin_score, $inbox_object);
        $array_object['spamAssassin']   = SpamTestJson::get_spamassassin_array($mailheader, $assassin_score);
        $from_email                 = $array_object['messageInfo']['bounceAddress'];
        $auth_serverInfo            = SpamAssassin::getserverauth( $mailheader );
        $array_object['signature']      = SpamTestJson::get_signature_array($mailheader, $auth_serverInfo, $from_email);
        $array_object['body']           = SpamTestJson::get_mailbody_array($mailbody, $from_email);
        $array_object['blacklists']     = SpamTestJson::get_blacklist_array($auth_serverInfo['serverip'], $from_email);
        $array_object['links']          = SpamTestJson::get_brokenlinks_array($mailbody, $from_email);
        
        $json_object  = json_encode($array_object);
    }
}

/**
 * Reports error during API RPC request
 */
class ApiRequestException extends Exception {}

