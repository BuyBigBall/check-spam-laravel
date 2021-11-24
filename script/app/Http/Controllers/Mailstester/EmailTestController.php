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
 
class EmailTestController extends Controller
{

    // show home page 
    public function index(Request $request)
    {
        //	Samir Chakouri
        //To	vvnavqq798@mail-analyzer.com, test-ebs4g0bo6@srv1.mail-tester.com
        // Date	Today 13:12
        
        // Cookie::queue('email', 'vvnavqq798@mail-analyzer.com', 3);	
        
        $email = null;
        if (Cookie::has('email')) 
        {
            $email =  Cookie::get('email');
        }
		
        if( !empty($request->input('message_id')) )
        {
            $id = $request->input('message_id');
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

        
        if(!empty($id) && 
            (       !Session::has('could_not_use_by_paid_user') 
            || empty(Session::get('could_not_use_by_paid_user')) ))
        {
            return redirect( route('testresult').'?message_id='.$id );
        }
        else
            return view('mailstester.spamtest') 
                    ->with('css', $css)
                    ->with('email', $email);
    }

    /**
     * Returns DOM object representing request for information about all available domains
     * @return DOMDocument
     */
    
    function domainsInfoRequest()
    {
        /*
        <?xml version="1.0" encoding="UTF-8" ?>
        <packet version="1.4.1.2">
        <domain>
        <get>
              <filter/>
              <dataset>
                     <limits/>
                     <prefs/>
                     <user/>
                     <hosting/>
                     <stat/>
                     <gen_info/>
              </dataset>
        </get>
        </domain>
        </packet>        
        */
        $xmldoc = new DomDocument('1.0', 'UTF-8');
        $xmldoc->formatOutput = true;
    
        // <packet>
        $packet = $xmldoc->createElement('packet');
        $packet->setAttribute('version', '1.4.1.2');
        $xmldoc->appendChild($packet);
    
        // <packet/domain>
        $domain = $xmldoc->createElement('domain');
        $packet->appendChild($domain);
    
        // <packet/domain/get>
        $get = $xmldoc->createElement('get');
        $domain->appendChild($get);
    
        // <packet/domain/get/filter>
        $filter = $xmldoc->createElement('filter');
        $get->appendChild($filter);
    
        // <packet/domain/get/dataset>
        $dataset = $xmldoc->createElement('dataset');
        $get->appendChild($dataset);
    
        // dataset elements
        $dataset->appendChild($xmldoc->createElement('limits'));
        $dataset->appendChild($xmldoc->createElement('prefs'));
        $dataset->appendChild($xmldoc->createElement('user'));
        $dataset->appendChild($xmldoc->createElement('hosting'));
        $dataset->appendChild($xmldoc->createElement('stat'));
        $dataset->appendChild($xmldoc->createElement('gen_info'));
    
        return $xmldoc;
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

    public static function temporaryEmailCheck($email=null)
    {
        if($email == null)
        {
            if (Cookie::has('email')) 
            {
                $email =  Cookie::get('email');
            }
        }
        
        if( !empty($email))
        {
            $id = TrashMail::GetLastUnreadMail($email);
        }


            //print($email); die;

        # get unread message details
        // if(!empty($id))
        // {
        //     $response = TrashMail::messages($email, $id);
		// 	//print_r($response); die;
        //     if( empty($response['messages']['error']) && count($response)>0 )
        //     {
        //         $message_idnum = $response[0]['id'];
        //     }
        // }
        // else
        //     $message_idnum = 0;
        #<-----

        if(!empty($id))
            return json_encode(['result'=>'ok', 'message_id'=>$id, 'email'=>$email] );
        else
            return json_encode(['result'=>'fail', 'email'=>$email]);
        
    }

	
}

/**
 * Reports error during API RPC request
 */
class ApiRequestException extends Exception {}

