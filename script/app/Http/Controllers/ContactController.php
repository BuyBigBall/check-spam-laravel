<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Mail\ContactUs;
use App\Models\Settings;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;

class ContactController extends Controller
{
    // Create Contact Form
    public function index(Request $request)
    {
        return view('frontend.contact');
    }

    // Send mail to admin
    public function store(Request $request)
    {

        // Form validation

        if (empty(env('RECAPTCHA_SECRET_KEY'))) {

            $this->validate($request, [
                'name' => 'required',
                'email' => 'required|email',
                'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
                'subject' => 'required',
                'message' => 'required',
            ]);

        }else{
            $this->validate($request, [
                'name' => 'required',
                'email' => 'required|email',
                'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
                'subject' => 'required',
                'message' => 'required',
                'g-recaptcha-response' => 'required|captcha'
            ]);
        }
        

        if(!env('DEMO_MODE')){
            Mail::to(Settings::selectSettings("MAIL_TO_ADDRESS"))->send(new ContactUs($request));
        }


        return back()->with('success', __('We have received your message and would like to thank you for writing to us.'));
    }
}
