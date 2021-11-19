<?php

namespace App\Http\Controllers\Mailstester;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use App\Models\Settings;
use App\Models\TrashMail;
use Illuminate\Http\Request;

// use Illuminate\Support\Str;
// use Illuminate\Support\Facades\Cache;
// use Vinkla\Hashids\Facades\Hashids;
// use Carbon\Carbon;

use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;

use App\Models\Menu;
use \Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Models\Language;
use DomDocument;
use SimpleXMLElement;
use Exception;
 
class SpamTestController extends Controller
{

    // show home page 
    public function index(Request $request)
    {
        $email = null;
        if (Cookie::has('email')) 
        {
            $email =  Cookie::get('email');
            //$id = TrashMail::GetLastUnreadMail($email); # <-- for this , it' takes long time
        }
		
        if( !empty($request->input('message_id')) )
        {
            $id = $request->input('message_id');
        }
		// /*
        if(!empty($id))
        {
            return redirect( route('testresult').'?message_id='.$id );
        }
        else
		// */
        return view('mailstester.spamtest')->with('email', $email);
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
		//print($randPassword); // die;
		$randPassword = env('TEMPORARY_MAIL_PASSWORD');
		
        $curl = $this->curlInit($host, $login, $password, $panel_port);
        try {
            $xmlObject = $this->createXML($site_id, $mail_account_name, $randPassword );
            $response = $this->sendRequest($curl, $xmlObject);
            $responseXml = $this->parseResponse($response);
            $this->checkResponse($responseXml);
        
        } catch (ApiRequestException $e) {
            echo $e;
            die();
        }
        //print_r($responseXml); die;
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

    public function temporaryEmailCheck()
    {
        $email = null;
        if (Cookie::has('email')) 
        {
            $email =  Cookie::get('email');
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
            return json_encode(['result'=>'ok', 'message_id'=>$id] );
        else
            return json_encode(['result'=>'fail']);
        
    }

	function getbody($html) {
		
        $dom = new DOMDocument;
        libxml_use_internal_errors(true);
		$dom->loadHTML($html);
		libxml_use_internal_errors(false);
        $bodies = $dom->getElementsByTagName('body');
        assert($bodies->length === 1);
        $body = $bodies->item(0);
        //for ($i = 0; $i < $body->children->length; $i++) {
        //    $body->remove($body->children->item($i));
        //}
        $stringbody = $dom->saveHTML($body);
        return $stringbody;
    }
	function getserverauth($header) 
	{
		$posend = $i = $pos = stripos( $header, 'X-PM-IP', 0);
		
		if($pos!==false)
		{
			$i=$pos= ($pos+8);
			while($i<strlen($header))
			{
				$ch = substr($header, $i, 1);
				if($ch==' ' || $ch==':')
				{
					$i++;$pos++; continue;
				}
				
				if(!is_numeric($ch) && $ch!='.')
				{
					$posend = $i;
					break;
				}
				$i++;
			}
		}
		$result = 'no trust';
		$server_ip = substr($header, $pos, $posend - $pos);
		if( stripos($header, 'spf=pass', 0)!==false )
			$result = 'auth';
		
		return [$result, $server_ip];
	}
	
	function getDKIMsign($header) 
	{
		$start = false;
		$posend = $i = 0;
		while( ($pos = stripos( $header, 'DKIM-Signature:', $i))!==false )
		{
			$start = $pos;$i= $pos + 15;
		}
		
		if($start!==false)
		{
			$word1 = 'Received:';
			$word2 = 'From:';
			$i=$pos= ($start+15);
			while($i<strlen($header))
			{
				$ch = substr($header, $i, 1);
				$wd1 = substr($header, $i, strlen($word1));
				$wd2 = substr($header, $i, strlen($word2));
				if($ch==' ' || $ch==':')
				{
					$i++;$pos++; continue;
				}
				
				if(($wd1)==$word1 || ($wd2)==$word2) //strtolower
				{
					$posend = $i;
					break;
				}
				$i++;
			}
		}
		$result = 'fail';
		$dkim_sign = substr($header, $pos, $posend - $pos);
		if( stripos($header, 'dkim=pass', 0)!==false )
			$result = 'pass';
		
		return [$result, $dkim_sign];
	}
	function getDMARCsign($header) 
	{
		$start = false;
		$posend = $i = 0;
		while( ($pos = stripos( $header, 'DMARC-Signature:', $i))!==false )
		{
			$start = $pos;$i= $pos + 15;
		}
		
		if($start!==false)
		{
			$word1 = 'Received:';
			$word2 = 'From:';
			$i=$pos= ($start+15);
			while($i<strlen($header))
			{
				$ch = substr($header, $i, 1);
				$wd1 = substr($header, $i, strlen($word1));
				$wd2 = substr($header, $i, strlen($word2));
				if($ch==' ' || $ch==':')
				{
					$i++;$pos++; continue;
				}
				
				if(($wd1)==$word1 || ($wd2)==$word2) //strtolower
				{
					$posend = $i;
					break;
				}
				$i++;
			}
		}
		$result = 'fail';
		$dkim_sign = substr($header, $pos, $posend - $pos);
		if( stripos($header, 'dmarc=pass', 0)!==false )
			$result = 'pass';
		
		return [$result, $dkim_sign];
	}

	function getRDNSsign($header, $server) 
	{
		$start = false;
		$posend = $i = 0;
		while( ($pos = stripos( $header, 'helo=', $i))!==false )
		{
			$start = $pos;$i= $pos + strlen('helo=');
		}
		
		if($start!==false)
		{
			
			$i=$pos= ($start+strlen('helo='));
			while($i<strlen($header))
			{
				$ch = substr($header, $i, 1);
				if($ch==' ' || $ch=='=')
				{
					$i++;$pos++; continue;
				}
				
				if($ch==';' || $ch==' ' ) 
				{
					$posend = $i;
					break;
				}
				$i++;
			}
		}
		
		$helo_name = substr($header, $pos, $posend - $pos);
		$rdns_name = gethostbyaddr($server[1]);
		
		return [$server[1], $helo_name, $rdns_name];
	}
    public function TestResult(Request $request)
    {
        $score = new \palPalani\SpamassassinScore\SpamassassinScore();
		
        $message_id = $request->input('message_id');
        $email = null;
        if (Cookie::has('email')) 
            $email =  Cookie::get('email');
        $response = TrashMail::messages($email, $message_id);
		

        if( empty($response['messages']['error'])  && count($response)>0 )
        {
            $response = $response[0];
        }
		else
		{
			$response['subject'] = '';
            $response['is_seen'] = 0;
            $response['from'] = '';
            $response['from_email'] = '';
            $response['receivedAt'] = '';
            $response['id'] = $message_id;
            $response['attachments'] = [];
			$response['content'] = '';
			$response['header'] = '';
		}
        
        //Cookie::queue('mail_body_html', $response['content'], 3);	//size error
		Session::put('mail_body_html', $response['content']);
        $score_report = $score->getScore( '<header>'.$response['header'].'</header>' .'<subject>'.$response['subject'].'</subject>'  .'<body>'.$this->getbody($response['content']).'</body>');

		/*
		$assassin_item = [];
		$ary = (explode("<br />", nl2br($score_report['report']))); 
		for($i=0; $i<count($ary); $i++)
		{
			if($i<=1) continue;
			if( is_numeric(substr($ary[$i],0,3)) || substr($ary[$i],0,1)=='-')
			{
				$temp = (explode(' ', $ary[$i])); 
				$assassin_item[] = ($temp[0]=='') ? $temp[1] : $temp[2];
			}
		}
		*/
		
		//for($i=0; $i<strlen($ary[0]); $i++)			print( ord(substr($ary[0], $i,1))."<br>");		die;
		//print_r($this->getserverauth($response['header'] )); die;
		$auth_serverInfo = $this->getserverauth( $response['header'] );
		
        return view('mailstester.testresult')
            ->with('email',     $email )
            ->with('report', 	$score_report['report'])
			->with('rules', 	$score_report['rules'])
			->with('score', 	10 - $score_report['score'])
			->with('server_auth', $auth_serverInfo )
            ->with('dkim_auth', $this->getDKIMsign($response['header'] ) )
			->with('dmarc_auth', $this->getDMARCsign($response['header'] ) )
			->with('rdns_auth', $this->getRDNSsign($response['header'], $auth_serverInfo ) )
			->with('message',   $response );
		
		
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
		$email_body = preg_replace("/<img[^>]+\>/i", "(image) ", Session::get('mail_body_html') ); 
        }
        print($email_body);die;
    }
}

/**
 * Reports error during API RPC request
 */
class ApiRequestException extends Exception {}

