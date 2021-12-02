<?php

use App\Models\Translate;
use App\Models\Language;
use App\Models\settings;

use Illuminate\Support\Str;
use File as fle;


//We use this to convert date to new format

function ToDate($date)
{
    if($date==null) return '';

    if(gettype($date)=='string') return $date;
    try{
        return $date->format('Y-m-d');
    }
    catch(Exception $e)
    {
        return '';
    }
};


//for scalability as parameters is same to translate
function as_it_is($key, $coll = 'general' ,  $lang = null){
    return $key;
}


//We use this to translate text 

function translate($key, $coll = 'general' ,  $lang = null){
    if($key==null) return '';
    if($lang == null){
        $lang = App::getLocale();
    }

    // if Translate = 0 create new one
    $translation = Translate::where('lang', env('DEFAULT_LANGUAGE', 'en'))->where('key', $key)->where('collection', $coll)->first();
    if($translation == null){
        if($key!=null)
        foreach(Language::all() as $lang_locale){
            $translation = new Translate;
            $translation->lang = $lang_locale['code'];
            $translation->key = $key;
            $translation->value = $lang_locale['code']=='en' ? $key : null;
            $translation->collection = $coll;
            $translation->save();
        }
    }

    $translation_locale = Translate::where('key', $key)->where('lang', $lang)->where('collection', $coll)->first();
    if($translation_locale != null && $translation_locale->value != null){
        return $translation_locale->value;
    }
    // elseif($translation->value != null){
    //     return $translation->value;
    // }
    else{
        return $key;
    }
};



//We use this to remove files

function removeFile($path)
{
    if (!file_exists($path)) {
        return true;
    }
    return fle::delete($path);
};

// We use this to make files directory

function makeDirectory($path)
{
    if (fle::exists($path)) {
        return true;
    }
    return fle::makeDirectory($path, 0775, true);
};


// We use this to upload images

function FileUpload($file, $location, $old = null , $specificName = null)
{
    $path = makeDirectory($location);
    if (!empty($old)) {
        removeFile($old);
    }
    if (!empty($specificName)) {
        $filename = $specificName . '.' . $file->getClientOriginalExtension();
    } else {
        $filename = Str::random(15) . '_' . time() . '.' . $file->getClientOriginalExtension();
    }
    $file->move($location, $filename);
    return $location . $filename;
};



function getSupportedLocales()
    {
        $locales = [];

        foreach (Language::all() as $lang) {
            $locales[$lang->code] = [
                'name' => $lang->name
            ];
        }

        return $locales;
    }



    function setEnv($key,$value)
    {
        $path = base_path('.env');

        if(is_bool(env($key)))
        {
            $old = env($key)? 'true' : 'false';
        }
        elseif(env($key)===null){
            $old = 'null';
        }
        else{
            $old = env($key);
        }

        if (file_exists($path)) {
            file_put_contents($path, str_replace(
                "$key=".$old, "$key=".$value, file_get_contents($path)
            ));
        }
    }


    function get_option($option, $default = null)
    {
        $cacheKey = 'get.' . $option;
        $result = \App\Models\Option::where('option', $option)->value('value');
        if ($result) {
            return $result;
        }
        return $default;
    }
    
    // recipent : receiver email array
    // subject : subject string
    // content : content array[token, active, ]
    // template : template keyname
    function sendMail(array $request) //[recipent, title, content, template]
    {
        $templatename = '';
        $recipent   = $request['recipent'];
        $content    = $request['content'];
        if ( empty($request['subject']))                $request['subject'] = '';
        if ( empty($request['content']))                $content = [];
        if (!empty($request['template'])) {
            if($request['template']=='welcome')
            {
                $url = route('activate');
                $activate_link = $url . '?token='.$content['token'];
            }
            $templatename = $request['template'];
        }
        $success_count = 0;
        foreach ($recipent as $to) {
            if(!empty($templatename)) {
                $user = \App\Models\User::where('email', $to)->first();
                $template_view = view('emails.' .    $templatename)
                            ->with('email',     $user->email )
                            ->with('name',      $user->name )
                            ->with('subject',   $request['subject'] )
                            ->with('activate',  $activate_link );
                
                Mail::send('emails.content', ['content' => $template_view ], 
                    function ($mail) use ($user, $request) 
                    {
                        $mail->to($user->email, $user->name);
                        $mail->subject($request['subject']);
                        $mail->from( settings::selectSettings('MAIL_FROM_ADDRESS') );
                        // if (isset($request['attach']) && $request['attach'] != '') {
                        //     $mail->attach(public_path() . $request['attach']);
                        // }
                    });
                $success_count++;
            }
        }
    
        if (count(Mail::failures()) > 0) {
            return false;
        } else {
            return $success_count;
        }
    
    }
