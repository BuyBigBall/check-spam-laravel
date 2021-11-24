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
		$dmarc_sign = substr($header, $pos, $posend - $pos);
		if( stripos($header, 'dmarc=pass', 0)!==false )
			$result = 'pass';
		
		return ['auth_result'=>$result, 'dmarc_sign'=>$dmarc_sign];
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
		
        /*
		print_r($checkResult->getMatchedMechanism());	//object (spf.mtasv.net)
		print('<br>');
        print_r($checkResult); die;
		*/

		//print_r(['auth_result'=>$auth_result, 'spf_record'=>$spf_record, 'spf_issues'=>$issue_strings]); die;
		return ['auth_result'=>$auth_result, 'spf_record'=>$spf_record, 'spf_issues'=>$issue_strings];
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
                $test_total->first()->total >= env('MAX_FREETEST_COUNT') )
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

		
		$auth_serverInfo = $this->getserverauth( $response['header'] );
		$auth_rDnsInfo   = $this->getRDNSsign($response['header'], $auth_serverInfo );
        $auth_DMARCInfo  = $this->getDMARCsign($response['header'] );
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
            $auth_SPDcheck   = ['auth_result'=>'', 'spf_record'=>'', 'spf_issues'=>''];


        
        $css = '';$guard = null;
        if (Auth::guard($guard)->check()) {
            $user_id = Auth::user()->id;
            $whitelabel = WhiteLabel::where(['user_id'=>$user_id, 'active'=>1] )->get();
            if($whitelabel->first()!==null)
            {
                $css = $whitelabel->first()->css;
            }
        }
        if($request->input('flag')!==null && $request->input('flag')=='whitelabel' )
        {
            $css = $request->input('css');
        }

        return view('mailstester.testresult')
            ->with('mail_id',       $Hashid)
            ->with('css',           $css)
            ->with('email',         $email )
			->with('ago_time',		$ago_time)
            ->with('report', 	    $score_report['report'])
			->with('rules', 	    $score_report['rules'])
			->with('score', 	    10 - $score_report['score'])
			->with('server_auth',   $auth_serverInfo )
            ->with('dkim_auth',     $auth_DKIMInfo )
			->with('dmarc_auth',    $auth_DMARCInfo )
			->with('rdns_auth',     $auth_rDnsInfo )
			->with('spf_check',     $auth_SPDcheck )
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
		$email_body = preg_replace("/<img[^>]+\>/i", "(image) ", Session::get('mail_body_html') ); 
        }
        print($email_body);die;
    }
}

/**
 * Reports error during API RPC request
 */
class ApiRequestException extends Exception {}

