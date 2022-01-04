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
use App\Models\MailBlacklistCheck;
use App\Models\MailBrokenlinkCheck;

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
use App\Http\Controllers\Cron\CronJobController;
use App\Http\Controllers\Mailstester\MailContentController;

class EmailTestController extends Controller
{

    #show /spamtest page
    public function index(Request $request, $param=null)
    {
        $iframe = false;
        $pay_type_ids = [];
        if($param!=null)
        {
            $email = $param . '@' . env('MAIL_HOST');
            $iframe = true;
        }
        else
        {
            $email = $request->input('trsh_mail');
            if (empty($email) && Cookie::has('email'))  $email =  Cookie::get('email');
        }
        
        $email_db_record = TrashMail::where('email', $email)->first();

        // getting useroption for micropayment
        if(    !empty($email_db_record) 
            && !empty($email_db_record->useroption)                 //relation
            && !empty($email_db_record->useroption->use_micropay)   //relation
            && !empty($email_db_record->useroption->pay_types))     //relation
        {
            $pay_type_ids = explode( ",", $email_db_record->useroption->pay_types );
        }
		

        $css = '';$guard = null;
        if (Auth::guard($guard)->check()) {
            $user_id = Auth::user()->id;
            $whitelabel = WhiteLabel::where( ['user_id'=>$user_id, 'active'=>1] )->get();
            if($whitelabel->first()!==null)
            {
                $css = $whitelabel->first()->css;
            }
        }
        if($request->input('flag')!==null && $request->input('flag')=='whitelabel' )
        {
            $css = $request->input('css');
        }
        
        if( !empty($request->input('message_id')) )
        {
            $Hash_id = $request->input('message_id');
			$Hash__decode_id_array = Hashids::decode($Hash_id);
			$id = $Hash__decode_id_array[0];
        }
		
        if(empty($id) && $_SERVER['HTTP_HOST']!='localhost' )
        {
            $db_hist =  TestResult::where('receiver', $email)->whereNull('tested_at')->get()->first();
            if($db_hist!=null) 
            {
                $id = $db_hist->mail_id;
                $Hash_id = Hashids::encode($id);
            }
        //     $LastEmail = TrashMail::GetLastUnreadMail($email);
        //     if($LastEmail != null)
        //     {
        //         $Hash_id = $LastEmail['id'];
        //         $id = $LastEmail['no'];
        //         # it's may be performed by ajax
        //         if( ($find_id=MailBlacklistCheck::where(['mail_id'=>$id])->first())==null || 
        //             $find_id->checkflag<2)
        //             {
        //                 // $Hash_id = null;
        //                 // $id      = null;
        //                 $this->temporaryEmailCheck($email); 
		// 				$mail_id = $id;
		// 				$response = $LastEmail;
		// 				$json_array  = MailContentController::GetJsonArray( $email , [ $response ], $mail_id);
        //                 $json_string = json_encode($json_array);
        //                 $json_object = json_decode($json_string);

        //                 $message_result = [
        //                     'mail_id' =>    $mail_id,
        //                     'user_id' =>    1,      //now admin 
        //                     'name' =>       "admin" ,
        //                     'email' =>      $email,
        //                     'receiver'=>    $email,
        //                     'sender' =>     $response['from_email'],
        //                     'received_at' =>$response['receivedAt'],
        //                     'subject' =>    $response['subject'],
        //                     'header' =>     $response['header'],
        //                     'content' =>    $response['content'],
        //                     'score' =>      $json_object->mark,
        //                     'json' =>       $json_string ,
        //                 ];
        //                 $db_hist =  TestResult::create($message_result);                        
        //             }
        //    }
        }
        
		//dd($pay_type_ids);dd($id);
        if(!empty($id) && count($pay_type_ids)>0 )
        {
            return redirect( route('checkout-micropay').'?message_id='.$Hash_id )
                    ->with('mailbox', $email);
        }

        if(!empty($id) && 
            (       !Session::has('could_not_use_by_paid_user') 
            || empty(Session::get('could_not_use_by_paid_user')) ))
        {
			session()->forget('could_not_use_by_paid_user');
            return redirect( route('testresult').'?message_id='.$Hash_id )
                    ->with('mailbox',  $email);
        }
        else if($iframe)
        {
            return view('mailstester.iframe') 
            ->with('css',   $css)
            ->with('email', $email);
        }
        else
            return view('mailstester.spamtest') 
                    ->with('css',   $css)
                    ->with('email', $email);
    }

    /**
     * Prepares CURL to perform Plesk API request
     * @return resource
     */
    function curlInit($host, $login, $password)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, "https://{$host}:8443/enterprise/control/agent.php");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST,           true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_HTTPHEADER,
                array("HTTP_AUTH_LOGIN: {$login}",
                        "HTTP_AUTH_PASSWD: {$password}",
                        "HTTP_PRETTY_PRINT: TRUE",
                        "Content-Type: text/xml")
        );
    
        return $curl;
    }
    /**
     * Performs a Plesk API request, returns raw API response text
     *
     * @return string
     * @throws ApiRequestException
     */
    function sendRequest($curl, $packet)
    {
        curl_setopt($curl, CURLOPT_POSTFIELDS, $packet);
        $result = curl_exec($curl);
        if (curl_errno($curl)) {
                $errmsg  = curl_error($curl);
                $errcode = curl_errno($curl);
                curl_close($curl);
                throw new ApiRequestException($errmsg, $errcode);
        }
        curl_close($curl);
        return $result;
    }
    
    /**
     * Looks if API responded with correct data
     *
     * @return SimpleXMLElement
     * @throws ApiRequestException
     */
    function parseResponse($response_string)
    {
        $xml = new SimpleXMLElement($response_string);
        if (!is_a($xml, 'SimpleXMLElement'))
                throw new ApiRequestException("Cannot parse server response: {$response_string}");
        return $xml;
    }
    /**
     * Check data in API response
     * @return void
     * @throws ApiRequestException
     */
    function checkResponse(SimpleXMLElement $response)
    {
        //SimpleXMLElement Object ( [@attributes] => Array ( [version] => 1.6.9.1 ) [mail] => SimpleXMLElement Object ( [create] => SimpleXMLElement Object ( [result] => SimpleXMLElement Object ( [status] => ok [mailname] => SimpleXMLElement Object ( [id] => 22 [name] => mail_account ) ) ) ) )
        $resultNode = $response->mail->create->result;
        // for domain List API
        // $resultNode = $response->domain->get->result;
        // // check if request was successful

        //print_r($resultNode); die;
         if ('error' == (string)$resultNode->status)
                 throw new ApiRequestException("Plesk API returned error: " . (string)$resultNode->result->errtext);
    }
    
    function deleteXML($site_id, $mail_account_name)
    {
        $xmlString = '<packet version="1.6.3.0">
                        <mail>
                        <remove>
                        <filter>
                            <site-id>'.$site_id.'</site-id>
                            <name>'.$mail_account_name.'</name>
                            </filter>
                        </remove>
                        </mail>
                        </packet>';
		return $xmlString;
    }

    function createXML($site_id, $mail_account_name, $mail_password)
    {
        $xmlString = '<?xml version="1.0" encoding="UTF-8"?>
                        <packet>
                        <mail>
                        <create>
                        <filter>
                            <site-id>'.$site_id.'</site-id>
                            <mailname>
                                <name>'.$mail_account_name.'</name>
								<cp-access>true</cp-access>
                                <mailbox>
                                        <enabled>true</enabled>
                                        <quota>-1</quota>
                                </mailbox>
                                <password>
                                        <value>'.$mail_password.'</value>
                                        <type>plain</type>
                                </password>
                                <antivir>inout</antivir>
                            </mailname>
                        </filter>
                        </create>
                        </mail>
                        </packet>';
		return $xmlString;
    }
    //
    // int main()
    //
    public function createMailAddress($mail_account_name)
    {
        $host       = env('PLESK_HOST');
        $panel_port = env('PLESK_PORT');
        $site_id    = env('PLESK_SITEID');
        $login      = env('PLESK_USER');
        $password   = env('PLESK_PWD');
        $domain     = env('PLESK_DOMAIN');

        $randPassword= $this->randomPassword();
		$randPassword = env('TEMPORARY_MAIL_PASSWORD');
		
        $curl = $this->curlInit($host, $login, $password, $panel_port);
        try {
            $xmlObject = $this->createXML($site_id, $mail_account_name, $randPassword );
            $response = $this->sendRequest($curl, $xmlObject);
            $responseXml = $this->parseResponse($response);
            $this->checkResponse($responseXml);
        
        } catch (ApiRequestException $e) {
            //echo $e;
            //die();
            return $e;
        }
        //print_r($responseXml); die;
        return null;
    }
	function randomPassword() {
        $special = '!@#$%^&*_';
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        $n = rand(0, strlen($special)-1);
        $pass[] = $special[$n];
		$n = rand(0, strlen($special)-1);
		$pass[] = $special[$n];
        shuffle($pass);
        return implode($pass); //turn the array into a string
    }

    # ajax check_email request
    public static function temporaryEmailCheck(Request $request, $email=null)
    {
        
        if($email == null)
        {
            if( !empty($request->email))
            {
                $email = $request->email;
            }
            else if (Cookie::has('email')) 
            {
                $email =  Cookie::get('email');
            }
        }
        
        if( !empty($email))
        {
            $num = 0;
            $LastEmail = TrashMail::GetLastUnreadMail($email);
            if($LastEmail!=null)
            {
                $Hash_id = $LastEmail['id'];
                $id = $LastEmail['no'];
    
                ## whether cronjob has been performed or not ?
                $blst = MailBlacklistCheck::where('mail_id', $id)->first();
                $blnk = MailBrokenlinkCheck::where('mail_id', $id)->first();
                

                ## beacuse not performed blacklist check, it must be performed blaklist check.
                if($blst==null)
                {   #if no precheck, now check the dns blacklist
                    {
                        MailBlacklistCheck::updateOrCreate(
                            [ 'mail_id'  => $id,    'cron_number'=>$num],
                            [ 'to_email' => $email, 'checkflag' => 1,]
                        );
                
                        MailBrokenlinkCheck::updateOrCreate(
                            [ 'mail_id'  => $id,    'cron_number'=>$num],
                            [ ]
                        );
                    }
                    
                    ## --------------> dns blacklist checker ----------->
                    $cronCheckmodule = (new CronJobController());
                    $mailheader = $LastEmail['header'];
                    $auth_serverInfo = SpamAssassin::getserverauth( $mailheader );
                    $server_ip = $auth_serverInfo['serverip'];			//mail.ru=>128.140.169.216                    
                    $cronCheckmodule->lookfor_blacklist($server_ip, $LastEmail, 0);

                    $addresss_from  = $LastEmail['from_email'];
                    $hostname = explode('@', $addresss_from)[1];
                    $links = $cronCheckmodule->GetLinks( $LastEmail['content'] );
                    $cronCheckmodule->lookfor_brokenlinks($links, $id, 0);
                    unset($cronCheckmodule);

                    ## --------------> mail spamtest  ------------------>
                    $mail_id = $id;
                    $response = $LastEmail;
                    $json_array  = MailContentController::GetJsonArray( $email , [ $response ], $mail_id);
                    $json_string = json_encode($json_array);
                    $json_object = json_decode($json_string);

                    $message_result = [
                        'mail_id' =>    $mail_id,
                        'user_id' =>    1,      //now admin 
                        'name' =>       "admin" ,
                        'email' =>      $email,
                        'receiver'=>    $email,
                        'sender' =>     $response['from_email'],
                        'received_at' =>$response['receivedAt'],
                        'subject' =>    $response['subject'],
                        'header' =>     $response['header'],
                        'content' =>    $response['content'],
                        'score' =>      $json_object->mark,
                        'json' =>       $json_string ,
                    ];
                    $db_hist =  TestResult::create($message_result);
            
                    # mark as seen flag and get last mail again
                    // $LastEmail = TrashMail::messages($email, $Hash_id);

                }
                
                # it's dont need this
                // if($blst==null || $blnk==null)  unset($id);
                ## <----------
            }
        }

        if(!empty($id))
            return json_encode(['result'=>'ok', 'message_id'=>$Hash_id, 'email'=>$email] );
        else
            return json_encode(['result'=>'fail', 'email'=>$email]);
        
    }

	
}

/**
 * Reports error during API RPC request
 */
class ApiRequestException extends Exception {}

