<?php
namespace App\Http\Controllers\Cron;

use App\Http\Controllers\Controller;
use App\Models\BlacklistResult;
use App\Models\BrokenlinkResult;
use App\Models\TrashMail;
use App\Models\MailBlacklistCheck;
use App\Models\MailBrokenlinkCheck;
use Illuminate\Support\Facades\DB;
use Vinkla\Hashids\Facades\Hashids;
use Exception;

// use Illuminate\Support\Facades\Cookie;
// use Illuminate\Support\Facades\Session;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;
// use App\Models\MicroPayment;
// use App\Models\TestResult;
// use App\Models\WhiteLabel;
// use App\Models\Balance;
// use App\Models\Visitor;

// use Artesaos\SEOTools\Facades\SEOMeta;
// use Artesaos\SEOTools\Facades\OpenGraph;

// use App\Models\Menu;
// use \Mcamara\LaravelLocalization\Facades\LaravelLocalization;
// use App\Models\Language;
// use DomDocument;
// use SimpleXMLElement;
// use SPFLib\Term\Mechanism;
// use Vinkla\Hashids\Facades\Hashids;
use App\Http\Controllers\Mailstester\SpamAssassin;

class CronJobController extends Controller
{
    public static $bl_score_unit    = 0.5;
	public static $burl_score_unit  = 0.5;
    public static $ipByHost = [];

    public static $dnsbl_lookup = [
		0 => ['Spamhaus PBL'      , "pbl.spamhaus.org", '', 'red'],
		1 => ['Spamhaus SBL'      , "sbl.spamhaus.org", '', 'red'],
        2 => ['Barracuda'         , "b.barracudacentral.org", '', 'red'],
		// updated by TechPlus 2021.12.10
        3 => ['SORBS (last 28 days)'   		    , "recent.spam.dnsbl.sorbs.net", '', 'red'],
        4 => ['SORBS (last 28 hrs)'  			, "new.spam.dnsbl.sorbs.net", '', 'red'],
        5 => ['SORBS Relay (last 28 days)'   	, "smtp.dnsbl.sorbs.net", '', 'red'],
        6 => ['SORBS Relay'  					, "smtp.dnsbl.sorbs.net", '', 'red'],
		//<--- updated end
        7 => ['SPAMCOP'           , "bl.spamcop.net", '', 'red'],
        8 => ['IMP-SPAM'          , "spamrbl.imp.ch", '', 'red'],
        9 => ['SEM-BLACK'         , "backscatter.spameatingmonkey.net", '', 'red'],
        10 => ['SEM-BACKSCATTERER', "badnets.spameatingmonkey.net", '', 'red'],
        11 => ['China Anti-Spam'  , "cbl.anti-spam.org.cn", '', 'red'],
        12 => ['LashBack'         , "ubl.unsubscore.com", '', 'red'], // This the lashback on mail-tester.co]
        13 => ['RATS-ALL'         , "all.spamrats.com", '', 'red'],
		14 => ['RATS-Dyna-Spam'   , "dyna.spamrats.com", '', 'red'],
        15 => ['PSBL'             , "psbl.surriel.com", '', 'red'],
        16 => ['SWINOG'           , "dnsrbl.swinog.ch", '', 'red'],
        17 => ['GBUdb Truncate'   , "truncate.gbudb.net", '', 'red'],
        18 => ['Weighted Private Block List'  , "db.wpbl.info", '', 'red'],
        19 => ['RBL page'          	   ,"all.s5h.net", '', 'red'],
		20 => ['Spam-RBL in Franch'	   , "all.spam-rbl.fr", '', 'red'],
		21 => ['RBL in Japan'      	   , "all.rbl.jp", '', 'red'],
        22 => ['DroneBL'           	   , "dnsbl.dronebl.org", '', 'red'],
        23 => ['DSBL'              	   , "list.dsbl.org", '', 'red'],
		24 => ['Redhawk'           	   , "access.redhawk.org", '', 'red'],
		25 => ['Fusionzero'        	   , "0spam-killlist.fusionzero.com", '', 'red'],
		26 => ['Fusionzero Spam'       , "0spam.fusionzero.com", '', 'red'],
		
		// added by TechPlus 2021.12.10
		27 => ['Spamhaus CSS Advisory' , "zen.spamhaus.org", '', 'red'],
		28 => ['mailspike'			   , "bl.mailspike.net", '', 'red'],
		29 => ['Spamhaus XBL Advisory' ,  "xbl.spamhaus.org", '', 'red'],
		30 => ['Hostkarma'			   , "hostkarma.junkemailfilter.com", '', 'yellow'],
		31 => ['NiX Spam'			   , "ix.dnsbl.manitu.net", '', 'red'],
		//<--- added end
    ];

    public function GetLinks($content)
    {
        $matches = [];
		$regexp = "<a\s[^>]*href=(\"??)([^\" >]*?)\\1[^>]*>(.*)<\/a>";
		preg_match_all("/$regexp/siU", $content, $matches, PREG_SET_ORDER);

		// duplicated url should be removed
		$urls_array = [];
		foreach($matches as $url_items)
		{
			//$url_items[0] = tag, $url_items[1]=?, $url_items[3]=text
			//$url = explode("?", $url_items[2]);
            $url = $url_items[2];
			if(!in_array($url, $urls_array))	$urls_array[] =  $url;
		}

		$matches = array_values($urls_array);
		return $matches;
    }
	public function cron_brokenlink($num) {
        $mail_messages = TrashMail::GetLastMail();
        if( count($mail_messages['messages'])>0)
        {
            $one_mail = $mail_messages['messages'][0];
            
			$id_hash = Hashids::decode($one_mail['id']);
            $mail_id = $id_hash[0];
			
			$addresss_from  = $one_mail['from_email'];
            $hostname = explode('@', $addresss_from)[1];
            $links = $this->GetLinks( $one_mail['content'] );
            $this->lookfor_brokenlinks($links, $mail_id, $num);
        }
    }

	
    public function cron_blacklist($num) {
        $mail_messages = TrashMail::GetLastMail();
		//dd($mail_messages);
        if( count($mail_messages['messages'])>0)
        {
            $one_mail = $mail_messages['messages'][0];
			
			$id_hash = Hashids::decode($one_mail['id']);
            $mail_id = $id_hash[0];
			
            $addresss_from  = $one_mail['from_email'];
            $hostname = explode('@', $addresss_from)[1];
			//dd($one_mail);
            if(!array_key_exists($hostname, CronJobController::$ipByHost))
            {
                $mailheader = $one_mail['header'];
                $auth_serverInfo = SpamAssassin::getserverauth( $mailheader );
                $server_ip = $auth_serverInfo['serverip'];			//mail.ru=>128.140.169.216
                //$server_ip = gethostbyname($hostname);
				
                CronJobController::$ipByHost[$hostname] = $server_ip;
            }
            else
            {
                $server_ip = CronJobController::$ipByHost[$hostname];
            }
			//dd($server_ip);	// obistar.com=>87.106.127.240
			//print($hostname);
			//dd($server_ip);	// obistar.com=>87.106.127.240
            $this->lookfor_blacklist($server_ip, $one_mail, $num);
        }

    }
	
    public function lookfor_blacklist($server_ip, $one_mail, $num) {
        
        $id_hash = Hashids::decode($one_mail['id']);
        $mail_id = $id_hash[0];

        $target = [];
        foreach($one_mail['to'] as $to_addr)
        {
            if($to_addr->hostname==env('MAIL_HOST'))
            {
                $target[] = $to_addr->getAddress();
            }
        }
        foreach($one_mail['cc'] as $to_addr)
        {
            if($to_addr->hostname==env('MAIL_HOST'))
            {
                $target[] = $to_addr->getAddress();
            }
        }
        foreach($one_mail['bcc'] as $to_addr)
        {
            if($to_addr->hostname==env('MAIL_HOST'))
            {
                $target[] = $to_addr->getAddress();
            }
        }
		$perCount = env('BLACKLIST_LOOKFOR_GROUP_COUNT');
        $reverse_ip = implode(".", array_reverse(explode(".", $server_ip)));
		
        for($i=$perCount*$num; $i<$perCount*($num+1); $i++ )
        {
            if( empty(CronJobController::$dnsbl_lookup[$i]) ) continue;
			
            $domain = CronJobController::$dnsbl_lookup[$i][1];
            $domain_key = CronJobController::$dnsbl_lookup[$i][0];
            $domain_link = !empty(CronJobController::$dnsbl_lookup[$i][2]) ? 
                            CronJobController::$dnsbl_lookup[$i][2] : 
                            CronJobController::$dnsbl_lookup[$i][1];
            $query = BlacklistResult::where('serverip', $server_ip)
					->where( function($query) use ($domain_key, $domain) {
                        $query->orWhere( 'domain_key', $domain_key )
							  ->orWhere( 'domain_url', $domain );
                    });
			//dd($query->toSql());
            $bl_result = $query->first();

            if (checkdnsrr($reverse_ip . "." . $domain . ".", "A")) 
                $result = 1;
            else 
                $result = 0;
			//updateOrCreate
			//dd($bl_result);
            if($bl_result==null)
            {
                $blacklist = new BlacklistResult();
                $blacklist->domain_key  = $domain_key;
                $blacklist->domain_url  = $domain;
                $blacklist->link_url    = $domain_link;
                $blacklist->mark        = $result ? CronJobController::$bl_score_unit : 0;
                $blacklist->serverip    = $server_ip;
                $blacklist->result      = $result;
                $blacklist->save();
            }
            else
            {
                BlacklistResult::find($bl_result->id)->update(['result'=>$result]);
            }
        }
		
        MailBlacklistCheck::updateOrCreate(
            [ 'mail_id' => $mail_id, 'cron_number'=>$num],
            [ 'to_email' => implode(",", $target), 'checkflag' => 2,]
        );
        // $chk = MailBlacklistCheck::where('mail_id', $mail_id)->where('cron_number', $num)->first();
        // if($chk==null)
        // {
        //     $flag = new MailBlacklistCheck();
        //     //dd($flag);
        //     $flag->mail_id = $mail_id;
        //     $flag->to_email = implode(",", $target);
        //     $flag->cron_number = $num;
        //     $flag->save();
        // }

		return true;
	}


    public function lookfor_brokenlinks($links, $mail_id, $num) {
		$perCount = env('BLACKLIST_LOOKFOR_GROUP_COUNT');
        $i=0;
		$links = ['http://www.google.com/'];
		if(!empty($links))
        foreach($links as $link)
        {
            if($i>=$perCount*$num && $i<$perCount*($num+1))
            {
                $links_result = BrokenlinkResult::where('link_url', $link)->first();
				
                //$headers = @get_headers( $url); # this retured false
				//dd($headers);
				{
					$ch = curl_init();
					curl_setopt($ch,  CURLOPT_URL, $link);
					curl_setopt($ch,  CURLOPT_HEADER, 1);
					curl_setopt($ch , CURLOPT_RETURNTRANSFER, 1);
					//curl_setopt($ch,  CURLOPT_TIMEOUT,300); 

					$data = curl_exec($ch);
					$headers = curl_getinfo($ch);
					curl_close($ch);
					/*
					if($headers['http_code']!=200)
					{
						$bExist = false;
						foreach($results as $lst)
						{
							if($lst['url']==$url)
							{
								$bExist = true; break;
							}
						}

						if(!$bExist && stripos($url, 'http', 0)!==false)
							$results[] = [
							'url' => $url,
							'score'=> SpamAssassin::$burl_score_unit,
						];
					}*/					
				}
				//$result  = (bool)preg_match('#^HTTP/.*\s+[(200|301|302)]+\s#i', $headers);
				$result = true;
				if($headers['http_code']==200||$headers['http_code']==301||$headers['http_code']==302) $result = false;
				
                if($links_result==null)
                {
                    $brokenlinkdb = new BrokenlinkResult();
                    $brokenlinkdb->link_url    = $link;
                    $brokenlinkdb->header      = json_encode($headers);
                    $brokenlinkdb->result      = $result;
                    $brokenlinkdb->mark        = $result ? CronJobController::$burl_score_unit : 0;
                    $brokenlinkdb->save();
                }
                else
                {
                    BrokenlinkResult::find($links_result->id)->update(['result'=>$result, 'headers'=>json_encode($headers)]);
                }
            }
            $i++;
        }
        // $chk = MailBrokenlinkCheck::where('mail_id', $mail_id)->where('cron_number', $num)->first();
        // if($chk==null)
        // {
        //     $flag = new MailBrokenlinkCheck();
		// 	$flag->mail_id = $mail_id;
		// 	$flag->cron_number = $num;
		// 	$flag->save();
        // }
        MailBrokenlinkCheck::updateOrCreate(
            ['mail_id' => $mail_id, 'cron_number'=>$num],
            [ ]
        );

        
		return true;
	}
}

/**
 * Reports error during API RPC request
 */
class ApiRequestException extends Exception {}

