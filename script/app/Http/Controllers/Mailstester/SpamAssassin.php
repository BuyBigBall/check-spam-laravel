<?php 
namespace App\Http\Controllers\Mailstester;
use DomDocument;
use SPFLib\Term\Mechanism;
use Exception;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;
use App\Models\BlacklistResult;
use App\Models\BrokenlinkResult;
use App\Http\Controllers\Cron\CronJobController;

class SpamAssassin
{
    public static $bl_score_unit = 0.5;
	public static $burl_score_unit = 0.5;

    public static $recommended_array = [
        "DKIM_SIGNED"       => "This rule is automatically applied if your email contains a DKIM signature but other positive rules will also be added if your DKIM signature is valid. See immediately below.",
        "DKIM_VALID"        => "Great! Your signature is valid",
        "DKIM_VALID_AU"     => "Great! Your signature is valid and it's coming from your domain name",
        "DKIM_VALID_EF"     => "",
        "FREEMAIL_ENVFROM_END_DIGIT"=> "",
        "FREEMAIL_FROM"                 => "You're sending from a free email account",
        "FREEMAIL_REPLYTO_END_DIGIT"    => "",
        "FROM_EXCESS_BASE64"            => "",
        "HTML_MESSAGE"  => "No worry, that's expected if you send HTML emails",
        "SPF_HELO_PASS" => "",
        "SPF_PASS"      => "Great! Your SPF is valid",
		"URIBL_BLOCKED"	=> "Our own server has been blocked due to too many requests performed. You should ignore this issue",
		
    ];
    public static $removed_array = [
		'PYZOR_CHECK',
	];

	public static $dnsbl_lookup = [
		'Spamhaus PBL'      =>"pbl.spamhaus.org",
		'Spamhaus SBL'      =>"sbl.spamhaus.org",
        'Barracuda'         => "b.barracudacentral.org",
		// updated by TechPlus 2021.12.10
        // 'SORBS (Relay)'     => "dnsbl.sorbs.net",
        // 'SORBS (last 48 hrs)'   => "dul.dnsbl.sorbs.net",
        // 'SORBS (last 28 days)'  => "aspews.ext.sorbs.net",
        'SORBS (last 28 days)'   		=> "recent.spam.dnsbl.sorbs.net",
        'SORBS (last 28 hrs)'  			=> "new.spam.dnsbl.sorbs.net",
        'SORBS Relay (last 28 days)'   	=> "smtp.dnsbl.sorbs.net",
        'SORBS Relay'  					=> "smtp.dnsbl.sorbs.net",
		//<--- updated end
        'SPAMCOP'           =>"bl.spamcop.net",
        'IMP-SPAM'          =>"spamrbl.imp.ch",
        'SEM-BLACK'         => "backscatter.spameatingmonkey.net",
        'SEM-BACKSCATTERER' =>"badnets.spameatingmonkey.net",
        'China Anti-Spam'   => "cbl.anti-spam.org.cn",
        'LashBack'          => "ubl.unsubscore.com", // This the lashback on mail-tester.com
        'RATS-ALL'          => "all.spamrats.com",
		'RATS-Dyna-Spam'    => "dyna.spamrats.com",
        'PSBL'              => "psbl.surriel.com",
        'SWINOG'            => "dnsrbl.swinog.ch",
        'GBUdb Truncate'    => "truncate.gbudb.net",
        'Weighted Private Block List'  => "db.wpbl.info",
        'RBL page'          	 =>"all.s5h.net",		
		'Spam-RBL in Franch'	 => "all.spam-rbl.fr",
		'RBL in Japan'      	 => "all.rbl.jp",
        'DroneBL'           	 => "dnsbl.dronebl.org",
        'DSBL'              	 => "list.dsbl.org",
		'Redhawk'           	 => "access.redhawk.org",
		'Fusionzero'        	 => "0spam-killlist.fusionzero.com",
		'Fusionzero Spam'        => "0spam.fusionzero.com",
		
		// added by TechPlus 2021.12.10
		'Spamhaus CSS Advisory'	 => "zen.spamhaus.org",
		'mailspike'				 => "bl.mailspike.net",
		'Spamhaus XBL Advisory'  => "xbl.spamhaus.org",
		'Hostkarma'				 => "hostkarma.junkemailfilter.com",
		'NiX Spam'				 => "ix.dnsbl.manitu.net",
		//<--- added end

        //"dnsbl-1.uceprotect.net",
        //"dnsbl-2.uceprotect.net",
        //"dnsbl-3.uceprotect.net",
		//"aspews.ext.sorbs.net","b.barracudacentral.org","bb.barracudacentral.org","bl.drmx.org","bl.konstant.no","bl.nszones.com","bl.spamcannibal.org","bl.spameatingmonkey.net","bl.spamstinks.com","black.junkemailfilter.com","blackholes.five-ten-sg.com","blacklist.sci.kun.nl","blacklist.woody.ch","bogons.cymru.com","bsb.empty.us","bsb.spamlookup.net","cbl.abuseat.org","cblless.anti-spam.org.cn","cblplus.anti-spam.org.cn","cdl.anti-spam.org.cn","cidr.bl.mcafee.com","combined.rbl.msrbl.net","db.wpbl.info","dev.null.dk","dialups.visi.com","dnsbl-0.uceprotect.net","dnsbl-1.uceprotect.net","dnsbl-2.uceprotect.net","dnsbl-3.uceprotect.net","dnsbl.anticaptcha.net","dnsbl.aspnet.hu","dnsbl.inps.de","dnsbl.justspam.org","dnsbl.kempt.net","dnsbl.madavi.de","dnsbl.rizon.net","dnsbl.rv-soft.info","dnsbl.rymsho.ru","dnsbl.zapbl.net","dnsrbl.swinog.ch","dul.pacifier.net","dyn.nszones.com","fnrbl.fast.net","fresh.spameatingmonkey.net","images.rbl.msrbl.net","ips.backscatterer.org","korea.services.net","l2.bbfh.ext.sorbs.net","l3.bbfh.ext.sorbs.net","l4.bbfh.ext.sorbs.net","list.bbfh.org","list.blogspambl.com","mail-abuse.blacklist.jippg.org","netbl.spameatingmonkey.net","netscan.rbl.blockedservers.com","no-more-funn.moensted.dk","noptr.spamrats.com","orvedb.aupads.org","phishing.rbl.msrbl.net","pofon.foobar.hu","cart00ney.surriel.com","rbl.abuse.ro","rbl.blockedservers.com","rbl.dns-servicios.com","rbl.efnet.org","rbl.efnetrbl.org","rbl.iprange.net","rbl.schulte.org","rbl.talkactive.net","rbl2.triumf.ca","rsbl.aupads.org","sbl-xbl.spamhaus.org","sbl.nszones.com","short.rbl.jp","spam.dnsbl.anonmails.de","spam.pedantic.org","spam.rbl.blockedservers.com","spam.rbl.msrbl.net","spam.spamrats.com","spamsources.fabel.dk","st.technovision.dk","tor.dan.me.uk","tor.dnsbl.sectoor.de","tor.efnet.org","torexit.dan.me.uk","truncate.gbudb.net","uribl.spameatingmonkey.net","urired.spameatingmonkey.net","virbl.dnsbl.bit.nl","virus.rbl.jp","virus.rbl.msrbl.net","vote.drbl.caravan.ru","vote.drbl.gremlin.ru","web.rbl.msrbl.net","work.drbl.caravan.ru","work.drbl.gremlin.ru","wormrbl.imp.ch","zen.spamhaus.org"
    ];
	
	public static function check_url($url) {
		$headers = @get_headers( $url);
		$headers = (is_array($headers)) ? implode( "\n ", $headers) : $headers;
		return (bool)preg_match('#^HTTP/.*\s+[(200|301|302)]+\s#i', $headers);
	}


	## curl_getinfo is long time without internet
	public static function check_broken_links( $content )
    {
        $matches = [];
		$regexp = "<a\s[^>]*href=(\"??)([^\" >]*?)\\1[^>]*>(.*)<\/a>";
		preg_match_all("/$regexp/siU", $content, $matches, PREG_SET_ORDER);

		##############  ordering way   ##############
		// // duplicated url should be removed
		// $urls_array = [];
		// foreach($matches as $url_items)
		// {
		// 	//$url[0] = tag, $url[1]=?, $url[3]=text
		// 	$url = explode("?", $url_items[2]);
		// 	if(!array_key_exists($url[0], $urls_array))
		// 		$urls_array[$url[0]] = $url_items[2];
		// }

		// $matches = array_values($urls_array);
        // $results = [];
        // foreach($matches as $url)
        // {
		// 	if ( ! SpamAssassin::check_url($url))
		// 		 $results[] = [
		// 					'url' => $url,
		// 					'score'=> SpamAssassin::$burl_score_unit,
		// 				];
        // }


		###############  preperformed by cron ###########
		$results = [];
		$urls_array = [];
		foreach($matches as $url_items)
		{
			//$url_items[0] = tag, $url_items[1]=?, $url_items[3]=text
			$url = $url_items[2];
			if(!in_array($url, $urls_array))
				$urls_array[] = $url;
		}
		foreach($urls_array as $url)
		{
			$query = BrokenlinkResult::where('link_url', $url);
			$blnk_results = $query->first();
			if($blnk_results==null || !empty($blnk_results->mark))
			{
				$results[] = [
					'url' => $url,
					'score'=> CronJobController::$burl_score_unit,
				];
			}
		}
        return $results;
    }
	
	public static function cmd_parse($result)
	{
		$pos = stripos('QUERY:', $result, 0);
		$pos = stripos('ANSWER:', $result, $pos);
		if($pos!==false)
		{
			$posend = stripos(',', $result, $pos);
			return intval(substr($result, $pos, ($posend-$result-strlen('answer:'))));
		}
		return 0;
	}

	## checkdnsrr is long time without internet
    public static function cheking_blacklist($check_ip)
    {
        $listed = [];
        if ($check_ip) {
			################ ordering way ##############
            // $reverse_ip = implode(".", array_reverse(explode(".", $check_ip)));
			// $processes = [];
			// $starttime = time(); // print($starttime .' : ');
            // foreach (SpamAssassin::$dnsbl_lookup as $keyname    =>  $host_url) 
            // {
			// 	if (checkdnsrr($reverse_ip . "." . $host_url . ".", "A")) 
            //         $listed[$keyname] = SpamAssassin::$bl_score_unit;
            //     else 
            //         $listed[$keyname] = 0;
            // }

			//dd($check_ip);
			################ preperform by cronjob ###########
			$query = BlacklistResult::where('serverip', $check_ip)->orderBy('id', 'ASC');
			$bl_results = $query->get();
			foreach($bl_results as $domain_row)
			{
				$keyname = $domain_row->domain_key;
				$link = $domain_row->domain_url;
				$status = $domain_row->result;
				$mark = $domain_row->mark;
				$listed[$keyname] = ['mark'=>$mark, 'status'=>$status, 'link'=>$link];
			}
        }
    	return $listed;
    }
    
	public static function getbody($html) {
		
        $dom = new DOMDocument;
        libxml_use_internal_errors(true);
		$dom->loadHTML($html);
		libxml_use_internal_errors(false);
        $bodies = $dom->getElementsByTagName('body');
        assert($bodies->length === 1);
        $body = $bodies->item(0);

        $stringbody = $dom->saveHTML($body);

		unset($dom);
        return $stringbody;
    }
	public static function getserverauth($header) 
	{
        $offset = strlen('X-PM-IP');
		$posend = $i = $pos = stripos( $header, 'X-PM-IP', 0);
		if($pos===false)
        {
            $offset = strlen('client-ip=');
            $posend = $i = $pos = stripos( $header, 'client-ip=', 0);
        }
		$flag = false;
		if($pos===false)
        {
			$flag = true;
            $offset = strlen('sender IP is ');
            $posend = $i = $pos = stripos( $header, 'sender IP is ', 0);
        }
		if($pos!==false)
		{
			$i=$pos= ($pos + $offset );
			while($i<strlen($header))
			{
				$ch = substr($header, $i, 1);
				
				if(!$flag)
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
		//print($server_ip); die;
		return ['auth_result'=>$result, 'serverip'=>$server_ip];
	}
	
	public static function getDKIMsign($header) 
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
		
		return ['auth_result'=>$result, 'dkim_sign'=>$dkim_sign];
	}
	
	public static function getDMARCsign($header, $mail_server_domain) 
	{
        
        if(($pos = stripos( $header, 'DMARC-Signature:', 0))===false)
        {
            return ['auth_result'=>'fail;', 'dmarc_sign'=>'not found', 'dmarc_entries'=>[], 'dmarc_rows'=>[]];
        }


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
		$result = 'fail'; $dmarc_rows = [];
		$dmarc_sign = substr($header, $pos, $posend - $pos);
		if( ($dmarcpos = stripos($header, 'dmarc=pass', 0))!==false )
		{
			$dmarcpos_end	= stripos($header, ';', $dmarcpos);
			$dmarc_rows[] = substr($header, $dmarcpos,$dmarcpos_end-$dmarcpos+1 );
			$result = 'pass';
		}
		if( ($dmarcpos = stripos($header, 'dkim=pass', 0))!==false )
		{
			$dmarcpos_end	= stripos($header, ';', $dmarcpos);
			$dmarc_rows[] = substr($header, $dmarcpos,$dmarcpos_end-$dmarcpos+1 );
		}
		if( ($dmarcpos = stripos($header, 'dkim=pass', $dmarcpos_end))!==false )
		{
			$dmarcpos_end	= stripos($header, ';', $dmarcpos);
			$dmarc_rows[] = substr($header, $dmarcpos,$dmarcpos_end-$dmarcpos+1 );
		}
		
		$dmarc_result = dns_get_record("_dmarc." .$mail_server_domain,DNS_TXT);
		$dmarc_entries = [];
		if(count($dmarc_result)>0) $dmarc_entries = $dmarc_result[0]['entries'];
		return ['auth_result'=>$result, 'dmarc_sign'=>$dmarc_sign, 'dmarc_entries'=>$dmarc_entries, 'dmarc_rows'=>$dmarc_rows ];
	}

	public static function getRDNSsign($header, $server) 
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
        $rdns_name = '';
        try
        {
            $rdns_name = gethostbyaddr($server['serverip']);
        }catch (\Exception $e) {
            
        }
	
		return ['server_ip'=>$server['serverip'], 'helo_domain'=>$helo_name, 'rdns_domain'=>$rdns_name];
	}

    public static function getSPFcheck($header, $server_Helo_info, $from_email) 
	{
		$environment = new \SPFLib\Check\Environment($server_Helo_info['server_ip'], $server_Helo_info['helo_domain'], $from_email);
		$checker = new \SPFLib\Checker();
        $checkResult = $checker->check($environment);
		$email_domain = explode('@', $from_email);
		if(count($email_domain)>1)	$email_domain = $email_domain[1];
		else 						$server_Helo_info['helo_domain'];
		
		$record = new \SPFLib\Record($email_domain);
		$record
			->addTerm(new Mechanism\MxMechanism(Mechanism::QUALIFIER_PASS))
			->addTerm(new Mechanism\IncludeMechanism(Mechanism::QUALIFIER_PASS, $email_domain))
			->addTerm(new Mechanism\AllMechanism(Mechanism::QUALIFIER_FAIL));		
		
		
		$auth_result = $checkResult->getCode();	//'pass' or 'softfail'
		$spf_record = (string) $record;
		
		$spf = 'v=spf1 all redirect=' . $email_domain . ' redirect='.$server_Helo_info['helo_domain'].' ptr:foo.bar mx include=' . $email_domain . ' exp=test.%{p}';
		$issues = [];
		try{
			$record = (new \SPFLib\Decoder())->getRecordFromTXT($spf);
			$issues = (new \SPFLib\SemanticValidator())->validate($record);
		}
		catch(Exception $except){}
		$issue_strings = '';
		foreach ($issues as $issue) {$issue_strings .= ((string) $issue. "\n");}
		
		$spf_record = [];
		$SPF_result = dns_get_record($email_domain,DNS_TXT);
		
		if(count($SPF_result)>0)		
			foreach($SPF_result as $entry) 
			{
				if( substr($entry['txt'],0,6) != 'v=spf1') continue;
				$spf_record[] = ($entry['txt']);
			}
		
		$print_command = "dig +short TXT ".$email_domain;
		$print_result  = shell_exec( $print_command );
		$pos = stripos( $print_result, 'redirect=_spf.', 0);
		$spf_domain = substr($print_result, $pos+strlen('redirect=_spf.') );
		$pos = stripos( $spf_domain, '"', 0);
		$spf_domain = substr($spf_domain, 0, $pos);
		$ary = explode('"', $print_result); $print_result = [];
		foreach($ary as $item)
		{
			if( strlen(str_replace(" " , "", $item))>10)	$print_result[] = '"'.$item.'"';
		}
		$spf_detail[] =  ['cmd'=>$print_command, 'details'=> $print_result ];
		
		$print_command = "dig +short TXT @ns1." . $spf_domain . ". ".$email_domain;
		$print_result  = shell_exec($print_command);
		$ary = explode('"', $print_result); $print_result = [];
		foreach($ary as $item)
		{
			if( strlen(str_replace(" " , "", $item))>10)	$print_result[] = '"'.$item.'"';
		}
		$spf_detail[] =  ['cmd'=>$print_command, 'details'=>$print_result ];

		//spfquery --scope mfrom --id yasha3651@mail.ru --ip 185.5.136.54 --helo-id f383.i.mail.ru
		$print_command = "spfquery --scope mfrom --id " . $from_email . 
					" --ip " . $server_Helo_info['server_ip'] . 
					" --helo-id ".$server_Helo_info['helo_domain'];
		$print_result  = shell_exec($print_command);
		$ary = explode('"', $print_result); $print_result = [];
		foreach($ary as $item)
		{
			if( strlen(str_replace(" " , "", $item))>10)	$print_result[] = '"'.$item.'"';
		}
		$spf_detail[] =  ['cmd'=>$print_command, 'details'=>$print_result];


		unset($record);
		unset($checker);
		unset($environment);
		return ['auth_result'=>$auth_result, 'spf_record'=>$spf_record, 'spf_issues'=>$issue_strings, 'dig-query'=>$spf_detail];
	}
	public static function ReverseScore($score)
	{
		if($score==='-0.0') return '0.001';
		if($score==='0.0') return '-0.001';
		if($score=='0.0') return '-0.001';
		return number_format (-$score, 1);
	}
	public static function GetSpamAssassinRules($header, &$except_score)
    {
		$except_score = 0;
        $pos = stripos( $header, "X-Spam-Report:", 0);

        if($pos===false)
        {
            $rules[] = [
				'score' 		=> 10, 
				'description'	=> 'spamassassin cannot work well.', 
				'key'			=> '', 
				'recommended'	=> ''
			];
            return $rules;
        }

        $pos += strlen("X-Spam-Report:");
        $posend = stripos( $header, "X-Original-To:", $pos);
		if($posend===false) $posend = stripos( $header, "Delivered-To:", $pos);
		if($posend===false) $posend = stripos( $header, "Received:", $pos);
		if($posend===false) $posend = stripos( $header, "Authentication-Results:", $pos);
		
        $reports = substr($header, $pos, $posend - $pos);
		$rules_array = explode('*', $reports);
		$rules = [];
		$marks = 0;
		$explain = '';
		foreach($rules_array as $line)
		{
			if(strlen($line)<3) continue;
			if(is_numeric (substr($line, 2,1)) || substr($line, 1,1)=='-')
			{
				if(strlen($explain)>5)	//if($explain!='')
				{
					$rule_key = GetFirstWordFromLine($explain);
					if(in_array($rule_key, SpamAssassin::$removed_array))
					{
						$except_score += $marks;
					}
					else
					{
						$rules[] = [
							'score'		 => SpamAssassin::ReverseScore($marks), 
							'key'		 => $rule_key,
							'description'=> str_replace($rule_key, '',  $explain),
							'recommended'=> 
									!empty(SpamAssassin::$recommended_array[$rule_key]) ? 
										SpamAssassin::$recommended_array[$rule_key] : '',
								];
						}
					$explain = '';
					$marks = 0;
				}
				$pos 	  = stripos( $line, ' ', 2);
				$marks 	  = substr(  $line, 1, $pos-1 );
				$explain .= substr($line, $pos );
			}
			else
			{
				$explain .= $line;
			}
		}
		if(strlen($explain)>5)	//if($explain!='')
		{
			$rule_key = GetFirstWordFromLine($explain);

			if(in_array($rule_key, SpamAssassin::$removed_array))
			{
				$except_score += $marks;
			}
			else
			{
				$rules[] = [
					'score'		 => SpamAssassin::ReverseScore($marks), 
					'key'		 => $rule_key,
					'description'=> str_replace($rule_key, '',  $explain),
					'recommended'=> 
							!empty(SpamAssassin::$recommended_array[$rule_key]) ? 
								SpamAssassin::$recommended_array[$rule_key] : '',
						];
				}
			$explain = '';
			$marks = 0;
		}
		//print_r($rules); die;
        return $rules;
    }
	public static function GetSpamAssassinScore($header)
    {
        $pos = stripos( $header, "X-Spam-Status:", 0);
        if($pos===false)
        {
            return 10.0;
        }
        $pos = stripos( $header, "score=", $pos);
        $posend = stripos( $header, " ", $pos+strlen("score="));
        $score = substr($header, $pos+strlen("score="), ($posend-$pos-strlen("score=")));
        $score = abs(floatval($score));
		/*
		print($posend.'<br>');
		print($pos.'<br>');
		print(substr($header, $pos+strlen("score="), ($posend-$pos-strlen("score=")))); 
		die;
		*/
        return $score;
    }

}