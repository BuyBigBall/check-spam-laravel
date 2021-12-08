<?php

namespace App\Http\Controllers\Mailstester;

use App\Models\TrashMail;
use Exception;
use Vinkla\Hashids\Facades\Hashids;
use App\Http\Controllers\Mailstester\SpamAssassin;

class SpamTestJson
{
    public static function get_brokenlinks_array($bodycontent, $from_email)
    {
        $broken_urls = SpamAssassin::check_broken_links( $bodycontent );	//"
        $broken_score = 0;
        $broken_url_array = [];
        foreach($broken_urls as $row)
        {
            $broken_url_array[] = $row['url'];
            $broken_score += $row['score'];
        }
        $result = [
            "title" => (count($broken_urls)>0) ? sprintf(translate("You have %d broken links"), count($broken_urls)) : translate("No broken links"),
            "mark" => 0,
            "displayedMark" => "",
            "statusClass" => ((count($broken_urls)>0) ? "warning" : "success" ) . " icon-check",
            "description" => "Checks if your newsletter contains broken links.",
            "messages" => (count($broken_urls)>0) ? sprintf(translate("%d broken links found"), count($broken_urls)) : translate("No links found."),
            "urls" => $broken_url_array,
            "brokenLinks" => count($broken_urls),
            "redirects" => 0,
            "notFound" => 0,
            "timeouts" => 0,
            "imagesWeight" => 0
        ];
        return $result;
    }
    
    public static function get_blacklist_array($serverip, $from_email)
    {
            $result = [];
        $bl_score_list = SpamAssassin::cheking_blacklist($serverip);	//'95.19.4.3');//
        
        $black_list_score_sum = array_sum($bl_score_list);
        
        $hitMark = abs($black_list_score_sum) / SpamAssassin::$bl_score_unit;
        $result["title"] = sprintf(translate("You're %s listed in %s blacklist")
                    , ($black_list_score_sum==0 ? "not " : "") 
                    , ($hitMark==0 ? "any" : $hitMark ) );
        $result["mark"] = $black_list_score_sum;
        $result["displayedMark"] = $black_list_score_sum;
        $result["statusClass"] = $black_list_score_sum==0 ? "success" : "failure";
        $result["description"] = sprintf( translate("Matches your server IP address (<b>%s</b>) against %d of the most common IPv4 blacklists.")
                    ,$serverip , count($bl_score_list));
        $result["hits"] = 1;
        $result["timeout"] = 0;
        $result["messages"] = "<div class=\"row\">";
        foreach($bl_score_list as $keyname=>$check_score)
        {
            $result["messages"] .= sprintf("<div class=\"col-sm-6 col-md-4 bl-result\"><span class=\"status-success\">%s</span> in <a target=\"_blank\" href=\"%s\">%s</a></div>", ($check_score==0) ? translate("Not listed") : (($check_score<1) ? translate('Listed -0.1')  : translate('Critical -1.0')), SpamAssassin::$dnsbl_lookup[$keyname], $keyname );
            $result[ SpamAssassin::$dnsbl_lookup[$keyname] ] = [
                "name" => $keyname,
                "url" => "https://".SpamAssassin::$dnsbl_lookup[$keyname],
                "dns" => SpamAssassin::$dnsbl_lookup[$keyname],
                "statusCode" => 0,
                "hitMark" => -0.5 - $check_score,
                "mark" => -$check_score,
                "details" => ""
            ];
        }

        $result["messages"] .= "</div>";
        return $result;
    }
    public static function get_mailbody_array($mailbody, $from_email)
    {
        $body_length = size(strlen($mailbody) );
        $weight      = strlen($mailbody)==0 ? '0' : strlen( \Soundasleep\Html2Text::convert( $mailbody ) ) / strlen($mailbody)  * 100;
        $result = [];
        $result["title"] = translate("Your message could be improved");
        $result["mark"] = 0;
        $result["displayedMark"] = "";
        $result["status"] = "";
        $result["statusClass"] = translate("warning icon-check");
        $result["description"] = translate("Checks whether your message is well formatted or not.");
        $result["messages"] = sprintf( translate("<p class=\"message-weight\">Weight of the HTML version of your message: <b>%s</b>.</p><p>Your message contains <b>%d</b>%% of text.</p>")
                , $body_length, round($weight));

        $result["subtests"] = [];
        $result["subtests"]["textToHtmlRatio"] = 
         [
            "title" => sprintf( translate("Your message contains <b>%d</b>%% of text."), $weight),
            "mark" => 0,
            "statusClass" => "success",
            "description" => "",
            "ratio" => $weight / 100.0
         ];

         $result["subtests"]["altAttributes"] = [
                "title" => translate("You have no images in your message"),
                "mark" => 0,
                "displayedMark" => "",
                "statusClass" => "success icon-check",
                "description" => translate("ALT attributes provide a textual alternative to your images.<br/>It is a useful fallback for people who are blind or visually impaired and for cases where your images cannot be displayed."),
                "imagesWithoutAlt" => [],
                "messages" => ""
         ];
        $result["subtests"]["forbiddenTags"] = [
                "title" => translate("Your content is safe"),
                "mark" => 0,
                "displayedmark" => 0,
                "statusClass" => "success icon-check",
                "description" => translate("Checks whether your message contains dangerous html elements such as javascript, iframes, embed content or applet."),
                "matches" => 0,
                "messages" => "",
                "rules" => [],
                "displayedMark" => ""
        ];
        $result["subtests"]["shorturl"] = [
                "title" => translate("We didn't find short URLs"),
                "mark" => 0,
                "displayedMark" => "",
                "statusClass" => "success icon-check",
                "description" => translate("Checks whether your message uses URL shortener systems."),
                "matches" => 0,
                "messages" => "",
                "rules" => [],
                "tested" => ""
        ];
        $result["subtests"]["listUnsubscribe"] = [
                "title" => translate("Your message does not contain a List-Unsubscribe header"),
                "mark" => 0,
                "displayedMark" => "",
                "statusClass" => "warning icon-check",
                "description" => translate("The List-Unsubscribe header is required if you send mass emails, it enables the user to easily unsubscribe from your mailing list."),
                "messages" => translate("Your message does not contain a List-Unsubscribe header"),
                "tested" => ""
        ];
        return $result;
    }
    public static function get_signature_array($mailheader, $auth_serverInfo, $from_email)
    {
        $mail_server_domain = explode('@', $from_email)[1];
		$auth_rDnsInfo   = SpamAssassin::getRDNSsign( $mailheader, $auth_serverInfo );
        $auth_SPDcheck   = SpamAssassin::getSPFcheck($mailheader, $auth_rDnsInfo, $from_email );
        $auth_DMARCInfo  = SpamAssassin::getDMARCsign($mailheader, $mail_server_domain );
        $auth_DKIMInfo   = SpamAssassin::getDKIMsign( $mailheader );
        $dmark_results   = dns_get_record("_dmarc.".$mail_server_domain, DNS_TXT);

        $score = 0; $s1 = ""; $s2 = "";
        foreach( $auth_SPDcheck['spf_record']  as $entry) $s1 .= '<pre>'.$entry.'</pre>';
        foreach( $auth_SPDcheck['dig-query'] as  $entry)  
        {
            $s2 .= ($entry['cmd'].' :') ;
            foreach( $entry['details'] as $line) $s2 .= $line;
        }

        $result = [];
        $result['title'] = translate('SpamAssassin thinks you can improve');
        $result['mark'] = $score;
        $result['diplayedMark'] = 0;
        $result['status'] = "";
        $result['statusClass'] = "success icon-check";
        $result['description'] = translate("We check if the server you are sending from is authenticated");
        $result['subtests'] = [];
        $result['subtests']["spf"] = [
            "title"=> sprintf( translate('[SPF] Your server <b>%s</b> is authorized to use <b>%s</b>'), $auth_serverInfo['serverip'], $from_email ),
            "mark"=> 0,
            "displayedMark"=> "",
            "status"=> "pass",
            "statusClass"=> "success icon-check",
            "description"=> translate("Sender Policy Framework (SPF) is an email validation system designed to prevent email spam by detecting email spoofing, a common vulnerability, by verifying sender IP addresses."),
            "messages"=> sprintf(translate('<p>What we retained as your current SPF record is:</p>%s<br/><br/><p>Verification details:</p><pre>%s</pre>'), $s1, $s2),
            "record"=> $s1,
            "newrecord"=> $s1
        ];
        $s1 = $auth_DKIMInfo['dkim_sign'];
        $result['subtests']["dkim"] = [
            "title" => translate("Your DKIM signature is valid"),
            "mark" => 0,
            "displayedMark" => "",
            "statusClass" => "success icon-check",
            "description" => translate("DomainKeys Identified Mail (DKIM) is a method for associating a domain name to an email message, thereby allowing a person, role, or organization to claim some responsibility for the message."),
            "messages" => sprintf(translate('<p>The DKIM signature of your message is:</p><pre>\t%s</pre><p>Key length: 1024bits</p>'), $s1),
            "status" => "pass"
        ];
        if($auth_DMARCInfo['auth_result']!='auth')  $s1 = "not"; else $s1 = "";
        $s2 = "";$s3 = "";
        foreach($auth_DMARCInfo['dmarc_entries'] as $entry)     $s2 .= "<pre>$entry</pre>";
        foreach($auth_DMARCInfo['dmarc_rows'] as $entry)        $s3 .= "<li>$entry</li>";

        $result['subtests']["dmarc"] = [
            "status" => "pass",
            "title" => translate( "Your message passed the DMARC test" ),
            "mark" => 0,
            "displayedMark" => "",
            "statusClass" => "success icon-check",
            "description" => translate("A DMARC policy allows a sender to indicate that their emails are protected by SPF and/or DKIM, and give instruction if neither of those authentication methods passes. Please be sure you have a DKIM and SPF set before using DMARC."),
            "messages" => sprintf( translate("Your DMARC record is %s set correctly and your message passed the DMARC test<p>DMARC DNS entry found for the domain <b>_dmarc.%s</b>:%s</p><p>Verification details:</p><pre><ul>%s</ul></pre>")
                    , $s1, $mail_server_domain, $s2, $s3 ),
        ];

        $rdns_domain = empty($auth_rDnsInfo['helo_domain']) ? $auth_rDnsInfo['rdns_domain'] :$auth_rDnsInfo['helo_domain'];
        $result['subtests']["rDns"] = [
            "title" => sprintf(translate("Your server <b>%s</b> is successfully associated with <b>%s</b>"), $auth_serverInfo['serverip'], $rdns_domain),
            "mark" => 0,
            "displayedMark" => "",
            "status" => "pass",
            "statusClass" => "success icon-check",
            "description" => translate("Reverse DNS lookup or reverse DNS resolution (rDNS) is the determination of a domain name that is associated with a given IP address.<br />Some companies such as AOL will reject any message sent from a server without rDNS, so you must ensure that you have one.<br />You cannot associate more than one domain name with a single IP address."),
            "messages" => "",
            "tested" => sprintf(translate("Here are the tested values for this check:<br/><ul><li>IP: %s</li><li>HELO: %s</li><li>rDNS: %s</li></ul>")
                    , $auth_rDnsInfo['server_ip'], $auth_rDnsInfo['helo_domain'], $auth_rDnsInfo['rdns_domain']), 
        ];
        
        $result['subtests']["aRecord"] = [
                "title" => sprintf( translate("Your hostname <strong>%s</strong> is assigned to a server."), $rdns_domain ),
                "mark" => 0,
                "displayedMark" => "",
                "status" => "pass",
                "statusClass" => "success icon-check",
                "description" => sprintf( translate("We check if there is a server (A Record) behind your hostname <strong>%s</strong>."), $rdns_domain),
                "messages" => "",
                "tested" => sprintf( translate("A records (%s) : <ul><li>%s</li></ul>"), $rdns_domain, $auth_serverInfo['serverip']),
        ];

        $ii = 0; $s1 = ""; $mxhosts = []; $mxweight = [];
        try{
            getmxrr($mail_server_domain,$mxhosts,$mxweight); 
        } catch(Exception $except) {}

        foreach( $mxhosts as $host_domain)
            $s1 .= "<li> " . $mxweight[$ii++]  . " $host_domain.</li>";
        
        $result['subtests']["mxRecord"] = [
                "title" => sprintf(translate("Your domain name <strong>%s</strong> is assigned to a mail server."), $mail_server_domain),
                "mark" => 0,
                "displayedMark" => "",
                "status" => "pass",
                "statusClass" => "success icon-check",
                "description" => sprintf(translate("We check if there is a mail server (MX Record) behind your domain name <strong>%s</strong>."), $mail_server_domain),
                "messages" => "",
                "tested" => sprintf( translate("MX records (%s) : <ul>%s</ul>"), $mail_server_domain, $s1),
        ];

        return $result;
    }
    public static function get_spamassassin_array($mailheader, $score, $max = -5)
    {   $result = [];
        $result['title'] = translate('SpamAssassin thinks you can improve');
        $result['score'] = $score;
        $result['mark'] = $score;
        $result['diplayedMark'] = 0;
        $result['threshold'] = -$max;
        $result['statusClass'] = $score==0 ? "success" : ($score>=-5 ?  "warning" : ($score>=-6 ?  "credicalwarning" : ($score>=-8 ?  "cretical" : 'fail')));
        $result['description'] = 'The famous spam filter <a href="http://spamassassin.apache.org/" target="_blank">SpamAssassin</a>. Score: '.number_format(-$score, 1).'.<br />A score below '.$max.' is considered spam.';
        $result['displayedMark'] = $score;
        $result['rules'] = [];
        $rules = SpamAssassin::GetSpamAssassinRules($mailheader, $remove_score);
        foreach($rules as $rule)
        {
            $result['rules'][$rule['key']] = [
                $rule['code'] = $rule['key'],
                $rule['score'] = $rule['score'],
                $rule['description'] = $rule['description'],
                $rule['solution'] = $rule['recommended'],
                $rule['status'] =  $rule['score']==0 ? "status-ok" : ($rule['score']<0.1 ? "status-warning" : ($rule['score']<0.5 ? "status-warnng" : "status-cretical")),
            ];
        }
        
        return $result;
    }

    public static function get_email_array($email, $mail_id, $score, $inbox_object, $mark_serial='mark-4')
    {
        $title = $inbox_object!=null ? 
            (
                (($score>=-3.0) ?  translate("Wow! Perfect, you can send") : 
                (($score>=-5.0) ?  translate("Good! you can send the mail") : 
                (($score>=-6.0) ?  translate("Warning! you cannot send the mail, but you can improve mail's content.") : 
                                   translate("critical! This is a special spam mail.")  
                 )))
             ) : "Mail not found. Please wait a few seconds and try again.";
        $email_object_array = [];
        $email_object_array["title"] = $title;
        $email_object_array["mark"] = $inbox_object!=null ? (-$score) : 0;
        $email_object_array["displayedMark"] = $inbox_object!=null ?  number_format(10 - $score, 1) .'/10' : "";
        $email_object_array["maxMark"] = $inbox_object!=null ? 0 : 0;
        $email_object_array["commentedMark"] = $inbox_object!=null ? "Your lovely total: " . $email_object_array["displayedMark"] : "";
        $email_object_array["status"] = true;
        $email_object_array["redirect"] = false;
        $email_object_array["access"] = true;
        $email_object_array["mailboxId"] = $email;
        $email_object_array["messageId"] = $mail_id;
        $email_object_array["markClass"] = $mark_serial;
        $email_object_array["messageInfo"] = [
            'subject'               => $inbox_object['subject'],
            'dateReceivedDisplayed' => $ago_time = agotime( $inbox_object['receivedAt'] ),
            'dateReceived'          => $inbox_object['receivedAt'],
            'bounceAddress'         => $inbox_object['from_email'],
            'bounceAddressDisplayed'=> 'Bounce address : ' . $inbox_object['from_email'],
            'fromAddress'           => $inbox_object['from'] . ' <' . $inbox_object['from_email'] .'>',
            'fromAddressDisplayed'  =>  '<b>From :</b> ' . $inbox_object['from'] . ' ' . htmlspecialchars($inbox_object['from_email']),
            'replyto'               => [ $inbox_object['from'] . ' ' . $inbox_object['from_email'] ],
            'replytoDisplayed'      => '<b>From :</b> ' . $inbox_object['from'] . ' ' . htmlspecialchars($inbox_object['from_email']) ,
        ];
        $email_object_array["spamAssassin"] = null;
        $email_object_array["signature"] = null;
        $email_object_array["body"] = null;
        $email_object_array["blacklists"] = null;
        $email_object_array["links"] = null;        

        return $email_object_array;
    }
}

