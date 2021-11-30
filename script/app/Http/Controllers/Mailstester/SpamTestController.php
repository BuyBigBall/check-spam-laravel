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
 
class SpamTestController extends Controller
{
    private $bl_score_unit = 0.5;
	private $burl_score_unit = 0.5;
    private $dnsbl_lookup = [
		'Spamhaus PBL'      =>"pbl.spamhaus.org",
		'Spamhaus SBL'      =>"sbl.spamhaus.org",
        'Barracuda'         => "b.barracudacentral.org",
        'SORBS (Relay)'     => "dnsbl.sorbs.net",
        'SORBS (last 48 hrs)'   => "dul.dnsbl.sorbs.net",
        'SORBS (last 28 days)'  => "aspews.ext.sorbs.net",
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
        'RBL page'          =>"all.s5h.net",		
		'Spam-RBL in Franch'=> "all.spam-rbl.fr",
		'RBL in Japan'      => "all.rbl.jp",
        'DroneBL'           => "dnsbl.dronebl.org",
        'DSBL'              => "list.dsbl.org",
		'Redhawk'           => "access.redhawk.org",
		'Fusionzero'        => "0spam-killlist.fusionzero.com",
		'Fusionzero Spam'        => "0spam.fusionzero.com",
		
        //"dnsbl-1.uceprotect.net",
        //"dnsbl-2.uceprotect.net",
        //"dnsbl-3.uceprotect.net",
        //"zen.spamhaus.org",
		//"aspews.ext.sorbs.net","b.barracudacentral.org","bb.barracudacentral.org","bl.drmx.org","bl.konstant.no","bl.nszones.com","bl.spamcannibal.org","bl.spameatingmonkey.net","bl.spamstinks.com","black.junkemailfilter.com","blackholes.five-ten-sg.com","blacklist.sci.kun.nl","blacklist.woody.ch","bogons.cymru.com","bsb.empty.us","bsb.spamlookup.net","cbl.abuseat.org","cblless.anti-spam.org.cn","cblplus.anti-spam.org.cn","cdl.anti-spam.org.cn","cidr.bl.mcafee.com","combined.rbl.msrbl.net","db.wpbl.info","dev.null.dk","dialups.visi.com","dnsbl-0.uceprotect.net","dnsbl-1.uceprotect.net","dnsbl-2.uceprotect.net","dnsbl-3.uceprotect.net","dnsbl.anticaptcha.net","dnsbl.aspnet.hu","dnsbl.inps.de","dnsbl.justspam.org","dnsbl.kempt.net","dnsbl.madavi.de","dnsbl.rizon.net","dnsbl.rv-soft.info","dnsbl.rymsho.ru","dnsbl.zapbl.net","dnsrbl.swinog.ch","dul.pacifier.net","dyn.nszones.com","fnrbl.fast.net","fresh.spameatingmonkey.net","hostkarma.junkemailfilter.com","images.rbl.msrbl.net","ips.backscatterer.org","ix.dnsbl.manitu.net","korea.services.net","l2.bbfh.ext.sorbs.net","l3.bbfh.ext.sorbs.net","l4.bbfh.ext.sorbs.net","list.bbfh.org","list.blogspambl.com","mail-abuse.blacklist.jippg.org","netbl.spameatingmonkey.net","netscan.rbl.blockedservers.com","no-more-funn.moensted.dk","noptr.spamrats.com","orvedb.aupads.org","phishing.rbl.msrbl.net","pofon.foobar.hu","cart00ney.surriel.com","rbl.abuse.ro","rbl.blockedservers.com","rbl.dns-servicios.com","rbl.efnet.org","rbl.efnetrbl.org","rbl.iprange.net","rbl.schulte.org","rbl.talkactive.net","rbl2.triumf.ca","rsbl.aupads.org","sbl-xbl.spamhaus.org","sbl.nszones.com","short.rbl.jp","spam.dnsbl.anonmails.de","spam.pedantic.org","spam.rbl.blockedservers.com","spam.rbl.msrbl.net","spam.spamrats.com","spamsources.fabel.dk","st.technovision.dk","tor.dan.me.uk","tor.dnsbl.sectoor.de","tor.efnet.org","torexit.dan.me.uk","truncate.gbudb.net","uribl.spameatingmonkey.net","urired.spameatingmonkey.net","virbl.dnsbl.bit.nl","virus.rbl.jp","virus.rbl.msrbl.net","vote.drbl.caravan.ru","vote.drbl.gremlin.ru","web.rbl.msrbl.net","work.drbl.caravan.ru","work.drbl.gremlin.ru","wormrbl.imp.ch","xbl.spamhaus.org","zen.spamhaus.org"
    ];
	
	private function check_broken_links( $content )
    {
		//print_r($content); die;
        //<a href='https://mail-analyzer.com.'></a>
        $matches = [];
		$regexp = "<a\s[^>]*href=(\"??)([^\" >]*?)\\1[^>]*>(.*)<\/a>";
		preg_match_all("/$regexp/siU", $content, $matches, PREG_SET_ORDER);
		
        $results = [];
        foreach($matches as $url)
        {
			//$url[0] = tag, $url[1]=?, $url[3]=text
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url[2]);
            curl_setopt($ch, CURLOPT_HEADER, 1);
            curl_setopt($ch , CURLOPT_RETURNTRANSFER, 1);
            $data = curl_exec($ch);
            $headers = curl_getinfo($ch);
            curl_close($ch);
            if($headers['http_code']!=200)
            {
				$bExist = false;
				foreach($results as $lst)
				{
					if($lst['url']==$url[2])
					{
						$bExist = true; break;
					}
				}
				
				if(!$bExist && stripos($url[2], 'http', 0)!==false)
                $results[] = [
                    'url' => $url[2],
                    'score'=> $this->burl_score_unit,
                ];
            }
        }
        return $results;
    }
	
    private function cheking_blacklist($check_ip)
    {
		//print($check_ip); die;
        $listed = [];
        if ($check_ip) {
            $reverse_ip = implode(".", array_reverse(explode(".", $check_ip)));
            foreach ($this->dnsbl_lookup as $keyname    =>  $host_url) 
            {
                if (checkdnsrr($reverse_ip . "." . $host_url . ".", "A")) 
                    $listed[$keyname] = $this->bl_score_unit;
                else 
                    $listed[$keyname] = 0;
            }
        }
    	return $listed;
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
		//        print($header); die;
        $offset = strlen('X-PM-IP');
		$posend = $i = $pos = stripos( $header, 'X-PM-IP', 0);
		if($pos===false)
        {
            $offset = strlen('client-ip=');
            $posend = $i = $pos = stripos( $header, 'client-ip=', 0);
        }

		if($pos!==false)
		{
			$i=$pos= ($pos + $offset );
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
		//print($server_ip); die;
		return ['auth_result'=>$result, 'serverip'=>$server_ip];
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
		
		return ['auth_result'=>$result, 'dkim_sign'=>$dkim_sign];
	}
	function getDMARCsign($header, $mail_server_domain) 
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

	// support windows platforms
    // if (!function_exists ('getmxrr') ) {
    //     function getmxrr($hostname, &$mxhosts, &$mxweight) {
    //         if (!is_array ($mxhosts) ) {
    //             $mxhosts = array ();
    //         }
        
    //         if (!empty ($hostname) ) {
    //             $output = "";
    //             @exec ("nslookup.exe -type=MX $hostname.", $output);
    //             $imx=-1;
        
    //             foreach ($output as $line) {
    //             $imx++;
    //             $parts = "";
    //             if (preg_match ("/^$hostname\tMX preference = ([0-9]+), mail exchanger = (.*)$/", $line, $parts) ) {
    //                 $mxweight[$imx] = $parts[1];
    //                 $mxhosts[$imx] = $parts[2];
    //             }
    //             }
    //             return ($imx!=-1);
    //         }
    //         return false;
    //     }
    // }
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
        $rdns_name = '';
        try
        {
            $rdns_name = gethostbyaddr($server['serverip']);
        }catch (\Exception $e) {
            
        }
        
		
		return ['server_ip'=>$server['serverip'], 'helo_domain'=>$helo_name, 'rdns_domain'=>$rdns_name];
	}

    function getSPFcheck($header, $server_Helo_info, $from_email) 
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
		$record = (new \SPFLib\Decoder())->getRecordFromTXT($spf);
		$issues = (new \SPFLib\SemanticValidator())->validate($record);
		$issue_strings = '';
		foreach ($issues as $issue) {$issue_strings .= ((string) $issue. "\n");}
		
		$spf_record = [];
		$SPF_result = dns_get_record($email_domain,DNS_TXT);
		// print_r($SPF_result); die;
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
		return ['auth_result'=>$auth_result, 'spf_record'=>$spf_record, 'spf_issues'=>$issue_strings, 'dig-query'=>$spf_detail];
	}

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
	private function GetSpamAssassinRules($header)
    {
        $pos = stripos( $header, "X-Spam-Report:", 0);
        $pos += strlen("X-Spam-Report:");
        $posend = stripos( $header, "X-Original-To:", $pos);
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
				if(strlen($explain)>5)
				{
					//print(strlen($explain)); die;
					$rules[] = ['score'=>$marks, 'description'=>$explain];
					$explain = '';
					$marks = 0;
				}
				$pos = stripos( $line, ' ', 2);
				$marks = substr(  $line, 1, $pos-1 );
				$explain .= substr($line, $pos );
			}
			else
			{
				$explain .= $line;
			}
		}
		if($explain!='')
		{
			$rules[] = ['score'=>$marks, 'description'=>$explain];
			$explain = '';
			$marks = 0;
		}
		//print_r($rules); die;
        return $rules;
    }
	private function GetSpamAssassinScore($header)
    {
        $pos = stripos( $header, "X-Spam-Status:", 0);
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
	
    public function TestResult(Request $request)
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
        
        $score = new \palPalani\SpamassassinScore\SpamassassinScore();
		
        
        $response = TrashMail::messages($email, $Hashid);
		
        if( empty($response['messages'])  && count($response)>0 )
        {
			//print_r($response); die;
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
        $diff = date_diff( new \DateTime( "now" ), new \DateTime($response['receivedAt']) );
		$ago_time = (($diff->y>=1) ? (($diff->y+1) . ' years ago' ) : 
					(($diff->m>=1) ? (($diff->m+1) . ' months ago' ) : 
					(($diff->d>=1) ? (($diff->d+1) . ' days ago' ) : 
					(($diff->h>=1) ? (($diff->h+1) . ' hours ago' ) : 
					(($diff->i>=1) ? (($diff->i+1) . ' minutes ago' ) : 
					date( 'l d M Y H:i:s P (T)', strtotime($response['receivedAt']) )   )))));
        //Cookie::queue('mail_body_html', $response['content'], 3);	//size error
		Session::put('mail_body_html', $response['content']);
        $score_report = $score->getScore( '<header>'.$response['header'].'</header>' .'<subject>'.$response['subject'].'</subject>'  .'<body>'.$this->getbody($response['content']).'</body>');

        if($score_report['success'])
        {
            $score_report['score'] = 0;
            foreach($score_report['rules'] as &$check_rule)
            {
                if($check_rule['score']<0)  $check_rule['score'] = '-0.0';
                $score_report['score'] += $check_rule['score'];
            }
        }
		$score_report['score'] = $this->GetSpamAssassinScore($response['header']);
		$score_rules = $this->GetSpamAssassinRules($response['header']);
		$mail_server_domain = explode('@', $response['from_email'])[1];
		//To check DMARC
		$dmark_results = dns_get_record("_dmarc.".$mail_server_domain,DNS_TXT);

		$auth_serverInfo = $this->getserverauth( $response['header'] );
		$auth_rDnsInfo   = $this->getRDNSsign($response['header'], $auth_serverInfo );
        $auth_DMARCInfo  = $this->getDMARCsign($response['header'], $mail_server_domain );
        $auth_DKIMInfo   = $this->getDKIMsign($response['header'] );
        if($request->input('flag')!='whitelabel' )
        {
            $auth_SPDcheck   = $this->getSPFcheck($response['header'], $auth_rDnsInfo, $response['from_email'] );
            $guard = null;
            if (Auth::guard($guard)->check()) {
                $user_id = Auth::user()->id;
                $user_name = Auth::user()->name;
                $mail_id = $response['id'];
                $email = Auth::user()->email;
                $db_hist = TestResult::where(['mail_id'=>$mail_id, 'user_id'=>$user_id])->first();
                if($db_hist==null)
                {
					$message_result = [
                        'mail_id' => $mail_id,
                        'user_id' => $user_id,
                        'name' => $user_name ,
                        'email' => $email,
                        'tested_at' => date('Y-n-d H:i:s', time()),
                        'received_at' => $response['receivedAt'],
                        'subject' => $response['subject'],
                        'header' => $response['header'],
                        'content' => $response['content'],
                        'sender' => $response['from_email'],
                        'score' => $score_report['score'],
                        // 'created_at' => time(),
                    ];
					//print_r($message_result); die;
                    $db_hist =  TestResult::create($message_result);
                }
            }
        }
        else
            $auth_SPDcheck   = ['auth_result'=>'', 'spf_record'=>'', 'spf_issues'=>'', 'dig-query'=>[] ];


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
        $bl_score_list = $this->cheking_blacklist($auth_serverInfo['serverip']);	//'95.19.4.3');//
		
        $black_list_score = array_sum($bl_score_list);
        $total_score = $score_report['score'];
		$total_score += $black_list_score;
		
        foreach($bl_score_list as $keyname=>$check_score)
        {
            $BL_results[ $keyname ] = [
                'url'   =>  $this->dnsbl_lookup[$keyname] , 
                'classname' => ($check_score==0) ? 'status-success' : (($check_score<1) ? 'status-warning' : 'status-failure'),
                'label' => ($check_score==0) ? 'Not Listed'     : (($check_score<1) ? 'Listed -0.1'      : 'Critical -1.0'),
                'score' => $check_score ];
        }

        ################### broken url cheking ###################
        $broken_urls = $this->check_broken_links( $response['content'] );	//"
		/*
		$broken_urls = $this->check_broken_links( '<a href="https://example1.com">Test 1</a>
													<a class="foo" id="bar" href="http://example2.com">Test 2</a>
													<a onclick="foo();" id="bar" href="http://example3.com">Test 3</a>' );
		// */
        $broken_score = 0;
        foreach($broken_urls as $row)
        {
            $broken_score += $row['score'];
        }
		$total_score += $broken_score;

		//print_r(broken_urls); die;
        ################### return view ##################
        return view('mailstester.testresult')
            ->with('mail_id',       $Hashid)
            ->with('broken_urls',   $broken_urls)
            ->with('broken_score',  $broken_score)
            ->with('css',           $css)
            ->with('email',         $email )
			->with('ago_time',		$ago_time)
            ->with('report', 	    $score_report['report'])
			->with('rules', 	    $score_report['rules'])
			->with('score_rules',   $score_rules)
			->with('score', 	    10 - $score_report['score'])
			->with('total_score', 	10 - $total_score)
            ->with('black_list_score', $black_list_score)
            ->with('bl_score_unit', $this->bl_score_unit)
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
}

/**
 * Reports error during API RPC request
 */
class ApiRequestException extends Exception {}

