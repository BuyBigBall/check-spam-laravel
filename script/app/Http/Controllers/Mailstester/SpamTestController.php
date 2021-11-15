<?php

namespace App\Http\Controllers\Mailstester;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cookie;
use App\Models\Settings;
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
use Exception;
 
class SpamTestController extends Controller
{

    // show home page 
    public function index()
    {
        $email = null;
        if (Cookie::has('email')) 
            $email =  Cookie::get('email');
        return view('mailstester.spamtest')->with('email', $email);
        //->with('lang_locale', $locale)->with('lang_name', $lang_name);
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
     * Returns DOM object representing request for information about all available domains
     * @return DOMDocument
     */
    
    public function createMailNodeRequest($username, $site_id, $mail_address, $mail_password=null)
    {
        /*
        <?xml version="1.0" encoding="UTF-8"?>
        <packet>
        <mail>
        <create>
        <filter>
            <site-id>1</site-id>
            <mailname>
                <name>techdept11</name>
                <mailbox>
                        <enabled>true</enabled>
                        <quota>1024000</quota>
                </mailbox>
                <forwarding>
                        <enabled>true</enabled>
                        <address>paul555@testdomain.tst</address>
                </forwarding>
                <alias>michael555</alias>
                <autoresponder>
                        <enabled>true</enabled>
                        <subject>Your request is accepted</subject>
                        <content_type>text/html</content_type>
                        <charset>UTF-8</charset>
                        <text>Your request will be processed in the nearest 10 days. Thank you.</text>
                        <attachment>
                            <tmp-name>/tmp/attachment-file.txt</tmp-name>
                            <file-name>rules.txt</file-name>
                        </attachment>
                    <forward>techdept@technolux.co.uk</forward>
                </autoresponder>
                <password>
                        <value>test123</value>
                        <type>plain</type>
                </password>
                <antivir>inout</antivir>
            </mailname>
            <mailname>
                <name>admin11</name>
                <password>
                    <value>test</value>
                </password>
                <antivir>inout</antivir>
            </mailname>
        </filter>
        </create>
        </mail>
        </packet>   
        */


        
        $xmldoc = new DomDocument('1.0', 'UTF-8');
        $xmldoc->formatOutput = true;
    
        // <packet>
        $packet = $xmldoc->createElement('packet');//        $packet->setAttribute('version', '1.4.1.2');
        $xmldoc->appendChild($packet);
    
        // <packet/dommailain>
        $mail = $xmldoc->createElement('mail');
        $packet->appendChild($domain);
    
        // <packet/mail/create>
        $create = $xmldoc->createElement('create');
        $mail->appendChild($create);

        // <packet/mail/create/filter>
        $filter = $xmldoc->createElement('filter');
        $create->appendChild($filter);
    
        // <packet/domain/get/filter/siteid>
        $siteid = $xmldoc->createElement('site-id');
        $siteid->nodeValue = $site_id;
        $filter->appendChild($siteid);

        $mailname = $xmldoc->createElement('mailname');
        $filter->appendChild($mailname);

        ########### ---> mailname elements
        $mailname_name = $xmldoc->createElement('name');
        $mailname_name->nodeValue=$mail_address;
        $mailname->appendChild($mailname_name);

        $mailname_password = $xmldoc->createElement('password');
        $mailname->appendChild($mailname_password);

            ## ---> mail password
            if($mail_password==null)
            {
                $mail_password = substr(md5($mail_address.date('YndHis')), 0, 8);
            }
            $mailname_password_value = $xmldoc->createElement('value');
            $mailname_password_value->nodeValue = $mail_password;
            $mailname_password->appendChild($mailname_password_value);
            ##<--

        $mailname_antivir = $xmldoc->createElement('antivir');
        $mailname_antivir->nodeValue = 'inout';
        $mailname->appendChild($mailname_antivir);
    
        $mailname_alias = $xmldoc->createElement('alias');
        $mailname_alias->nodeValue = $username;
        $mailname->appendChild($mailname_alias);
        ########### ---< mailname elements
    
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
        // for domail List API
        // $resultNode = $response->domain->get->result;
        // // check if request was successful
        // if ('error' == (string)$resultNode->status)
        //         throw new ApiRequestException("Plesk API returned error: " . (string)$resultNode->result->errtext);
    }
    
    //
    // int main()
    //
    public function createMailAddress($username, $site_id, $mail_address)
    {
        $host = '87.106.124.240';
        $login = 'mail-analyzer';
        $password = '3b_lfwNDDd55ijzn';
        $domain = 'mail-analyzer.com';

        $curl = $this->curlInit($host, $login, $password);
    
        try {
        
            //$response = $this->sendRequest($curl, $this->domainsInfoRequest()->saveXML());
            $response = $this->sendRequest($curl, $this->createMailNodeRequest($username, $site_id, $mail_address)->saveXML());
            $responseXml = $this->parseResponse($response);
            $this->checkResponse($responseXml);
        
        } catch (ApiRequestException $e) {
            echo $e;
            die();
        }
        
        print_r($responseXml); die;
        // Explore the result
        // foreach ($responseXml->xpath('/packet/domain/get/result') as $resultNode) {
        //     echo "Domain id: " . (string)$resultNode->id . " ";
        //     echo (string)$resultNode->data->gen_info->name . " (" . (string)$resultNode->data->gen_info->dns_ip_address . ")\n";
        // }
    }
}

/**
 * Reports error during API RPC request
 */
class ApiRequestException extends Exception {}

