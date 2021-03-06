<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */
    
    public function handle($request, Closure $next, $guard = null) {
        if (Auth::guard($guard)->check()) {
            $role = Auth::user()->role; 
        	// this handler is called when it already logined and then call login page.
            switch ($role) {
            case 'admin':
                return redirect('/admin/dashboard');
                break;
            case 'user':
                return redirect('get-started');  
                // this is no working , please reference LoginController->redirectTo()
                // look the Auth/LoginController@redirectTo
                break; 
        
            default:
                return redirect('/'); 
                break;
            }
        }
        return $next($request);
    }
}
