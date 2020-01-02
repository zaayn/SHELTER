<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    public function authenticated()
    {
        $user = \Auth::user();
        if(\Auth::check()){
            if ( $user->isAdmin() ) 
            {
                return redirect('/admin/home');
            }
            else if ( $user->issuperadmin() ) 
            {
                return redirect('/superadmin/home');
            }
            else if ( $user->isofficercrm() ) 
            {
                return redirect('/officer_crm/home');
            }
            else if ( $user->ismanagercrm() ) 
            {
                return redirect('/manager_crm/home');
            }
            else if ( $user->isdirektur() ) 
            {
                return redirect('/direktur/home');
            }
            else if ( $user->ismanagernoncrm() ) 
            {
                return redirect('/manager_non_crm/home');
            }
        }
        else    
            return redirect()->route('login');
    }
    

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();
 
        $request->session()->flush();
 
        $request->session()->regenerate();
 
        return redirect('/login');
    }
}
