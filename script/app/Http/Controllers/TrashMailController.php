<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use App\Models\Settings;
use App\Models\TrashMail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;
use Vinkla\Hashids\Facades\Hashids;
use Carbon\Carbon;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use App\Http\Controllers\Mailstester\SpamTestController;


class TrashMailController extends Controller
{

    // show home page 
    public function index()
    {
        $title = translate('Home Page Title', 'seo');
        $description = translate('Home Page Description', 'seo');
        $keyword = translate('Home Page keywords', 'seo');
        $canonical = url()->current();
        SEOMeta::setTitle($title);
        SEOMeta::setDescription($description);
        SEOMeta::setKeywords($keyword);
        SEOMeta::setCanonical($canonical);
        OpenGraph::setTitle($title);
        OpenGraph::setDescription($description);
        OpenGraph::setSiteName(Settings::selectSettings('name'));
        OpenGraph::addImage(asset(Settings::selectSettings('og_image')));
        OpenGraph::setUrl($canonical);
        OpenGraph::addProperty('type', 'article');
        
        //$this->parsingMailHeader('');
        //Cookie::queue('email', 'vvnavqq798@mail-analyzer.com', 3);	
        return view('frontend.index');
    }


    // generat email and check if unique  
    private function generateRandomEmail($length = 7, $num = 3)
    {
        $characters = 'abcdefghijklmnopqrstuvwxyz';
        $numbers = '013456789';
        $charactersLength = strlen($characters);
        $numbersLength = strlen($numbers);
        $randomEmail = '';
        for ($i = 0; $i < $length; $i++) {
            $randomEmail .= $characters[rand(0, $charactersLength - 1)];
        }
        for ($i = 0; $i < $num; $i++) {
            $randomEmail .= $numbers[rand(0, $numbersLength - 1)];
        }
		$createdAccount = $randomEmail;
        $randomEmail .= "@";

        if (Str::length(Settings::selectSettings("domains")) > 0) {
            $domain = explode(',', Settings::selectSettings("domains"));
            $randomEmail .= $domain[array_rand($domain)];
        } else {
            abort(401, 'You must add a domain');
        }

        if (TrashMail::where('email',  $randomEmail)->exists()) {
            return generateRandomEmail();
        } else {
			//$mailTester = new SpamTestController();
			//$ret = $mailTester->createMailAddress($createdAccount);
            return $randomEmail;
        }
    }

    // get all messages from 
    public function temporaryEmailAddress()
    {
        
        if (Cookie::has('email') && !empty(Cookie::get('email'))) {
            $email =  Cookie::get('email');
        } else {

            ########## create new email address  ###########
            $date = Carbon::now();
            if(Settings::selectSettings("email_lifetime_type") == 1){
                $newDateTime = Carbon::now()->addMinutes(Settings::selectSettings("email_lifetime"));
            }elseif(Settings::selectSettings("email_lifetime_type") == 60){
                $newDateTime = Carbon::now()->addHours(Settings::selectSettings("email_lifetime"));
            }else{
                $newDateTime = Carbon::now()->addDays(Settings::selectSettings("email_lifetime"));
            }
            

            $email = $this->generateRandomEmail();
            Cookie::queue('email', $email, Settings::selectSettings("email_lifetime") * Settings::selectSettings("email_lifetime_type"));
            Settings::updateSettings(
                'total_emails_created',
                Settings::selectSettings('total_emails_created') + 1
            );

            $trashmail = new TrashMail();
            $trashmail->email = $email;
            //$trashmail->delete_in = $newDateTime;
            $trashmail->save();
        }
        return json_encode( ['email'=>$email] );
    }


    // get all messages from 
    public function messages()
    {
        
        // if (Cookie::has('email')) {
        //     $email =  Cookie::get('email');
        // } else {
        //     $date = Carbon::now();
        //     if(Settings::selectSettings("email_lifetime_type") == 1){
        //         $newDateTime = Carbon::now()->addMinutes(Settings::selectSettings("email_lifetime"));
        //     }elseif(Settings::selectSettings("email_lifetime_type") == 60){
        //         $newDateTime = Carbon::now()->addHours(Settings::selectSettings("email_lifetime"));
        //     }else{
        //         $newDateTime = Carbon::now()->addDays(Settings::selectSettings("email_lifetime"));
        //     }
            

        //     $email = $this->generateRandomEmail();
        //     Cookie::queue('email', $email, Settings::selectSettings("email_lifetime") * Settings::selectSettings("email_lifetime_type"));
        //     Settings::updateSettings(
        //         'total_emails_created',
        //         Settings::selectSettings('total_emails_created') + 1
        //     );

        //     $trashmail = new TrashMail();
        //     $trashmail->email = $email;
        //     $trashmail->delete_in = $newDateTime;
        //     $trashmail->save();
        // }
        $json = $this->temporaryEmailAddress();
        $email = json_decode($json, true);
        if(empty($email)) abort(419);   // server error
        $email = $email['email'];

        $response  = TrashMail::allMessages($email);
        
        return $response;
    }

    //delete email
    public function delete()
    {
        if (Cookie::has('count') && Cookie::get('count') >= 5) {
            return back();
        }
            
        $now = Carbon::now();

        if (Cookie::has('email')) {
            $email = Cookie::get('email');
            $trash = TrashMail::where('email', $email)->first();
            if ($trash) {
                $trash->update([
                    'delete_in' => $now,
                ]);
            }

            Cookie::queue(Cookie::forget('email'));
        }

        if (Cookie::has('count')) {
            $count =  Cookie::get('count');
            Cookie::queue('count',$count+1, 3);
        }else{
            Cookie::queue('count',1, 3);
        }
        return redirect(route('home'));
    }

    //check_bot
    public function check_bot(Request $request){

        if (!empty(env('RECAPTCHA_SECRET_KEY'))) {
            $request->validate([
                'g-recaptcha-response' => 'required|captcha'
            ]);
        }

        if (Cookie::has('count') && Cookie::get('count') >= 5) {
            
            Cookie::queue(Cookie::forget('count'));

            return back();
        }
    }

    // delete messgae
    public function deletemessage($id)
    {

        if (Cache::has($id)) {
            Cache::forget($id);
        }
        $id = Hashids::decode($id);

        $email = Cookie::get('email');
        TrashMail::DeleteMessage($email, $id[0]);

        return redirect(route('home'));
    }


    //show message
    public function show($id)
    {
        $message[] = Cache::remember(
            $id
            , Settings::selectSettings("email_lifetime") * Settings::selectSettings("email_lifetime_type") * 60
            , function () use ($id) 
            {
                $email = Cookie::get('email');
                return TrashMail::messages($email , $id);
            });


        $title = translate('Default Title', 'seo');
        $description = translate('Default Description', 'seo');
        $keyword = translate('Default keywords', 'seo');
        $canonical = url()->current();
        SEOMeta::setTitle($title . ' ' .Settings::selectSettings('separator'). ' ' . $message[0]['subject']);
        SEOMeta::setDescription($description);
        SEOMeta::setKeywords($keyword);
        SEOMeta::setCanonical($canonical);
        OpenGraph::setTitle($title . ' ' .Settings::selectSettings('separator'). ' ' . $message[0]['subject']);
        OpenGraph::setDescription($description);
        OpenGraph::setSiteName(Settings::selectSettings('name'));
        OpenGraph::addImage(asset(Settings::selectSettings('og_image')));
        OpenGraph::setUrl($canonical);
        OpenGraph::addProperty('type', 'article');


        return view('frontend.view')->with('message', $message[0]);
    }


    //show message content
    public function message($id)
    {
        $message[] = Cache::remember(
            $id, 
            Settings::selectSettings("email_lifetime") * Settings::selectSettings("email_lifetime_type") * 60, 
            function () use ($id) 
            {
                $email = Cookie::get('email');
                return TrashMail::messages($email , $id);
            });

        return $message[0]['content'];
    }


    // download files 
    public function download($id, $file)
    {
        $id = Hashids::decode($id);

        if (file_exists('temp/attachments/' . $id[0] . '/' . $file)) {
            return response()->download('temp/attachments/' . $id[0] . '/' . $file);
        } else {
            abort(404);
        }
    }


    public function change()
    {

        $title = translate('Change Page Title', 'seo');
        $description = translate('Change Page Description', 'seo');
        $keyword = translate('Change Page keywords', 'seo');
        $canonical = url()->current();
        SEOMeta::setTitle($title);
        SEOMeta::setDescription($description);
        SEOMeta::setKeywords($keyword);
        SEOMeta::setCanonical($canonical);
        OpenGraph::setTitle($title);
        OpenGraph::setDescription($description);
        OpenGraph::setSiteName(Settings::selectSettings('name'));
        OpenGraph::addImage(asset(Settings::selectSettings('og_image')));
        OpenGraph::setUrl($canonical);
        OpenGraph::addProperty('type', 'article');

        return view('frontend.change');
    }

    // create new Custom Email 
    public function create(Request $request)
    {

        if (Cookie::has('count') && Cookie::get('count') >= 5) {
            return back();
        }

        if (Cookie::has('count')) {
            $count =  Cookie::get('count');
            Cookie::queue('count',$count+1, 3);
        }else{
            Cookie::queue('count',1, 3);
        }

        $request->validate([
            'name' => 'required|max:100|min:1|alpha_num|notIn:' . implode(',', explode(',', Settings::selectSettings('forbidden_id'))),
            'domain' => 'required|in:' . implode(',', explode(',', Settings::selectSettings('domains'))),
        ]);

        $new_email =  $request->name . "@" .  $request->domain;

        $check = TrashMail::where('email', '=', $new_email)->count();


        if ($check == 0) {

            $date = Carbon::now();
            if(Settings::selectSettings("email_lifetime_type") == 1){
                $newDateTime = Carbon::now()->addMinutes(Settings::selectSettings("email_lifetime"));
            }elseif(Settings::selectSettings("email_lifetime_type") == 60){
                $newDateTime = Carbon::now()->addHours(Settings::selectSettings("email_lifetime"));
            }else{
                $newDateTime = Carbon::now()->addDays(Settings::selectSettings("email_lifetime"));
            }


            if (Cookie::has('email')) {
                $email =  Cookie::get('email');
                $trash = TrashMail::where('email', $email)->first();
                if ($trash) {
                    $trash->update([
                        'delete_in' => $date,
                    ]);
                }
                Cookie::queue(Cookie::forget('email'));
                $email = $this->generateRandomEmail();
                Cookie::queue('email', $new_email, Settings::selectSettings("email_lifetime") * Settings::selectSettings("email_lifetime_type") );

                Settings::updateSettings(
                    'total_emails_created',
                    Settings::selectSettings('total_emails_created') + 1
                );

                $trashmail = new TrashMail();
                $trashmail->email = $new_email;
                $trashmail->delete_in = $newDateTime;
                $trashmail->save();

                return redirect(route('home'));
            }
        } else {

            // already existing mail address using
            // Cookie::queue('email', $new_email, Settings::selectSettings("email_lifetime") * Settings::selectSettings("email_lifetime_type") );
            //<---- for test
            session()->flash('error', translate('The address you have chosen is already in use. Please choose a different one.'));
            return redirect(route('change'));
        }
    }
    
    //"Return-Path: <pm_bounces@pmbounces.postmarkapp.com>\r\nX-Original-To: tona@mail-analyzer.com\r\nDelivered-To: tona@mail-analyzer.com\r\nReceived: from mta202a-ord.mtasv.net (mta202a-ord.mtasv.net [104.245.209.202])\r\n\tby compassionate-tharp.87-106-124-240.plesk.page (Postfix) with ESMTPS id DB72D20C44\r\n\tfor <tona@mail-analyzer.com>; Wed, 17 Nov 2021 08:46:52 +0100 (CET)\r\nAuthentication-Results: obistar.com;\r\n\tdmarc=pass (p=REJECT sp=NONE) smtp.from=pmbounces.postmarkapp.com header.from=postmarkapp.com;\r\n\tdkim=pass header.d=pm.mtasv.net;\r\n\tdkim=pass header.d=postmarkapp.com;\r\n        spf=pass (sender IP is 104.245.209.202) smtp.mailfrom=pm_bounces@pmbounces.postmarkapp.com smtp.helo=mta202a-ord.mtasv.net\r\nReceived-SPF: pass (obistar.com: domain of pmbounces.postmarkapp.com designates 104.245.209.202 as permitted sender) client-ip=104.245.209.202; envelope-from=pm_bounces@pmbounces.postmarkapp.com; helo=mta202a-ord.mtasv.net;\r\nDKIM-Signature: v=1; a=rsa-sha1; c=relaxed/relaxed; s=pm; d=pm.mtasv.net;\r\n h=From:Date:Subject:Message-Id:To:MIME-Version:Content-Type;\r\n bh=aYN8XNXjk/hpAbI129MeKOYSwEw=;\r\n b=yJru+u64p71RUZPSy4o8ZTu8f3Y1b6cPA/D+Rm982FrjOXKTwUglfZ6FrQeYb5FkP7kyjKUJIa9h\r\n   9DxntMgHCfrquOXkZxkBYWKSnR1boQGgR/7FERQY0mAvMyagphXHAJdh3GScgCIFVnZ0VIkofgiJ\r\n   ZCq6SsWtjj7mJtNlmYg=\r\nReceived: by mta202a-ord.mtasv.net id hiipmq27tk4c for <tona@mail-analyzer.com>; Wed, 17 Nov 2021 02:46:51 -0500 (envelope-from <pm_bounces@pmbounces.postmarkapp.com>)\r\nX-PM-IP: 104.245.209.202\r\nX-IADB-IP: 104.245.209.202\r\nX-IADB-IP-REVERSE: 202.209.245.104\r\nDKIM-Signature: v=1; a=rsa-sha256; d=postmarkapp.com; s=20131124034823.pm;\r\n\tc=relaxed/relaxed; i=support@postmarkapp.com; t=1637135211;\r\n\th=cc:content-transfer-encoding:content-type:date:from:in-reply-to:\r\n\tlist-archive:list-help:list-id:list-owner:list-post:list-subscribe:\r\n\tlist-unsubscribe:mime-version:message-id:references:reply-to:resent-cc:\r\n\tresent-date:resent-from:resent-message-id:resent-sender:resent-to:sender:\r\n\tsubject:to:feedback-id;\r\n\tbh=5tlNiu55cxT96ijI3ovQY8HR9zsjd1+CiMfDCuc9jjw=;\r\n\tb=YeV78KH9qYbYaqGZ4ClqSgf0obTXohk3S8/D5RmTboas7C49XpQV3IoL9K5BCOjrwTC7sTyn5lH\r\n\tRXNr4C1zYuyZguLKNI0nhA1Z2B4j8myKRF1IHjlyaoZNZs5Fbw3zqeXfW6BkgLMxhxhcWhQQrFsaX\r\n\t2DcdhQ01zUKl5dRkcww=\r\nFrom: Postmark Support <support@postmarkapp.com>\r\nDate: Wed, 17 Nov 2021 07:46:48 +0000\r\nSubject: Action Required: Confirm your email\r\nMessage-Id: <53a0ab81-2b43-4608-9d7f-fe2b5e8764d7@mtasv.net>\r\nTo: tona@mail-analyzer.com\r\nFeedback-ID: s40483-c2lnbnVw:s40483:a50355:postmark\r\nX-Complaints-To: abuse@postmarkapp.com\r\nX-PM-Message-Id: 53a0ab81-2b43-4608-9d7f-fe2b5e8764d7\r\nX-PM-Tag: signup\r\nX-PM-RCPT: |bTB8NTAzNTV8NDA0ODN8dG9uYUBtYWlsLWFuYWx5emVyLmNvbQ==|\r\nX-PM-Message-Options: v1;9Hcc_PIAriBnYBOfaIwCcyIPcaJJ4QcTBG0Vjf0upsKfpR9qOJtFHrXwPywaBTAW0yivONdmCE8g_Gy1UcqUBBDOwW7mU_BYoMQKRhXnXR0\r\nMIME-Version: 1.0\r\nContent-Type: multipart/alternative;\r\n\tboundary=mk3-49b3c71cfcf0487aada28f18d4565a2b; charset=UTF-8\r\n\r\n"
    function parsingMailHeader($mailRawHeader)
    {
        // $mailRawHeader = 'Return-Path: <pm_bounces@pmbounces.postmarkapp.com>\r\nX-Original-To: tona@mail-analyzer.com\r\nDelivered-To: tona@mail-analyzer.com\r\nReceived: from mta202a-ord.mtasv.net (mta202a-ord.mtasv.net [104.245.209.202])\r\n\tby compassionate-tharp.87-106-124-240.plesk.page (Postfix) with ESMTPS id DB72D20C44\r\n\tfor <tona@mail-analyzer.com>; Wed, 17 Nov 2021 08:46:52 +0100 (CET)\r\nAuthentication-Results: obistar.com;\r\n\tdmarc=pass (p=REJECT sp=NONE) smtp.from=pmbounces.postmarkapp.com header.from=postmarkapp.com;\r\n\tdkim=pass header.d=pm.mtasv.net;\r\n\tdkim=pass header.d=postmarkapp.com;\r\n        spf=pass (sender IP is 104.245.209.202) smtp.mailfrom=pm_bounces@pmbounces.postmarkapp.com smtp.helo=mta202a-ord.mtasv.net\r\nReceived-SPF: pass (obistar.com: domain of pmbounces.postmarkapp.com designates 104.245.209.202 as permitted sender) client-ip=104.245.209.202; envelope-from=pm_bounces@pmbounces.postmarkapp.com; helo=mta202a-ord.mtasv.net;\r\nDKIM-Signature: v=1; a=rsa-sha1; c=relaxed/relaxed; s=pm; d=pm.mtasv.net;\r\n h=From:Date:Subject:Message-Id:To:MIME-Version:Content-Type;\r\n bh=aYN8XNXjk/hpAbI129MeKOYSwEw=;\r\n b=yJru+u64p71RUZPSy4o8ZTu8f3Y1b6cPA/D+Rm982FrjOXKTwUglfZ6FrQeYb5FkP7kyjKUJIa9h\r\n   9DxntMgHCfrquOXkZxkBYWKSnR1boQGgR/7FERQY0mAvMyagphXHAJdh3GScgCIFVnZ0VIkofgiJ\r\n   ZCq6SsWtjj7mJtNlmYg=\r\nReceived: by mta202a-ord.mtasv.net id hiipmq27tk4c for <tona@mail-analyzer.com>; Wed, 17 Nov 2021 02:46:51 -0500 (envelope-from <pm_bounces@pmbounces.postmarkapp.com>)\r\nX-PM-IP: 104.245.209.202\r\nX-IADB-IP: 104.245.209.202\r\nX-IADB-IP-REVERSE: 202.209.245.104\r\nDKIM-Signature: v=1; a=rsa-sha256; d=postmarkapp.com; s=20131124034823.pm;\r\n\tc=relaxed/relaxed; i=support@postmarkapp.com; t=1637135211;\r\n\th=cc:content-transfer-encoding:content-type:date:from:in-reply-to:\r\n\tlist-archive:list-help:list-id:list-owner:list-post:list-subscribe:\r\n\tlist-unsubscribe:mime-version:message-id:references:reply-to:resent-cc:\r\n\tresent-date:resent-from:resent-message-id:resent-sender:resent-to:sender:\r\n\tsubject:to:feedback-id;\r\n\tbh=5tlNiu55cxT96ijI3ovQY8HR9zsjd1+CiMfDCuc9jjw=;\r\n\tb=YeV78KH9qYbYaqGZ4ClqSgf0obTXohk3S8/D5RmTboas7C49XpQV3IoL9K5BCOjrwTC7sTyn5lH\r\n\tRXNr4C1zYuyZguLKNI0nhA1Z2B4j8myKRF1IHjlyaoZNZs5Fbw3zqeXfW6BkgLMxhxhcWhQQrFsaX\r\n\t2DcdhQ01zUKl5dRkcww=\r\nFrom: Postmark Support <support@postmarkapp.com>\r\nDate: Wed, 17 Nov 2021 07:46:48 +0000\r\nSubject: Action Required: Confirm your email\r\nMessage-Id: <53a0ab81-2b43-4608-9d7f-fe2b5e8764d7@mtasv.net>\r\nTo: tona@mail-analyzer.com\r\nFeedback-ID: s40483-c2lnbnVw:s40483:a50355:postmark\r\nX-Complaints-To: abuse@postmarkapp.com\r\nX-PM-Message-Id: 53a0ab81-2b43-4608-9d7f-fe2b5e8764d7\r\nX-PM-Tag: signup\r\nX-PM-RCPT: |bTB8NTAzNTV8NDA0ODN8dG9uYUBtYWlsLWFuYWx5emVyLmNvbQ==|\r\nX-PM-Message-Options: v1;9Hcc_PIAriBnYBOfaIwCcyIPcaJJ4QcTBG0Vjf0upsKfpR9qOJtFHrXwPywaBTAW0yivONdmCE8g_Gy1UcqUBBDOwW7mU_BYoMQKRhXnXR0\r\nMIME-Version: 1.0\r\nContent-Type: multipart/alternative;\r\n\tboundary=mk3-49b3c71cfcf0487aada28f18d4565a2b; charset=UTF-8\r\n\r\n';

        ### dkim cheking
        $dkim_score = $this->getSpamChekingScore($mailRawHeader, "dkim=");
        
        ### spf cheking
        $spf_score = $this->getSpamChekingScore($mailRawHeader, "spf=");

        ### dmarc cheking
        $dmarc_score = $this->getSpamChekingScore($mailRawHeader, "dmarc=");
 
        ### spamassassin cheking
        $assassin_score = -0.3;
        
        return 10 + $spf_score + $dmarc_score + $dkim_score + assassin;
    } 
    function getSpamChekingScore($mailRawHeader, $key)
    {
        $idx = 0; $_score = 0; $_count = 0;
        while(($idx=stripos($mailRawHeader, $key, $idx))!==false)
        {
           $_score = (substr($mailRawHeader, $idx+strlen($key), 4)=='pass') ? 0 : -1.0;
           $_count++;
           $idx+=10;
        }
        if($_count>0)        $_score = $_score*1.0/$_count;
        return $_score;
    }
}
