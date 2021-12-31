<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;
    
    public function resetpwdconfirm(Request $request)
    {
        $token = $request->token;
        $username = $request->username;
        $user = User::where(['remember_token'=>$token, 'name'=>$username])->first();
        $user_email = $user->email;

        if( !!empty($user))
        {
            return redirect( route("forgot", "pwd"))->with("warning", "Username and verify code do not match or you do not have an account yet.");
        }
        $pos = random_int(1,7);
        $char = ["_", "&", "^", "$", "#", "@"][random_int(0, 5)];
        $new_pwd = substr(md5($user->id . date('YndHis') . $user_email), 0, 8);
        $new_pwd = substr($new_pwd, $pos) . $char . substr($new_pwd, 0, $pos);
        
        
        User::find($user->id)->update(["password" => Hash::make( $new_pwd)] );
        $response = ["password" => $new_pwd];

        sendMail([
            'recipent'=>[$user_email],	
            'template'=>'forgot',
            'subject' =>'your password has been reseted',
            'content' => $response,
        ]);        
        return redirect("login");
    }

    public function resetpwdpage(Request $request)
    {
        $token = $request->token;
        $user = User::where('remember_token', $token)->first();

        if( !empty($token))
        {
            if( !!empty($user) ) return redirect("login");
        }        

        return view('mailstester.resetpwd')
                ->with('username', !empty($user) ? $user->name : '' )
                ->with('token', $token);
    }
    public function forgot($type=null)
    {
        if($type=='pwd')
        {
            return view('mailstester.forgotpwd');
        }
        if($type=='usr')
        {
            return view('mailstester.forgotname');
        }
        else
        {
            abort(404);
        }
        return null;
    }

    public function forgottask(Request $request)
    {
        $type="";
        $title = "";
        $user_email = $request->email;
        
        $response = [];
        $user = User::where("email", $user_email)->first();
        if($request->task=="reset.pwd" && !empty($user))
        {
            $verify_code = md5($user->id . date('YndHis') );
            $a_links =  route("resetpwdpage", "token=" . $verify_code);
			
            User::find($user->id)->update(["remember_token" => $verify_code ]);
            $response['verify_code'] = $verify_code;
            $response['a_links']     = $a_links;
			//dd($a_links);
            $response['username']   = $user->name;
            
            sendMail([
                'recipent'=>[$user_email],	
                'template'=>'forgot',
                'subject' =>'Did you forgot ' . $title . "?",
                'content' => $response,
            ]);
            $type = 'pwd';
            return redirect(route("resetpwdpage"));
        }
        else if($request->task=="reset.name" && !empty($user))
        {
            $type = 'usr';
            $title = "user name";
            $response = ["username" => $user->name];
        }
        else
        {
            return redirect("login")->with('warning', translate("You do not have an account yet."));
        }

        return $this->forgot($type);
    }
}
