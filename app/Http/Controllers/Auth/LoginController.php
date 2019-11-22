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

    // protected function authenticated(Request $request, $user)
    // {
    //     if ( $user->isAdmin() ) 
    //     {
    //         return redirect('/admin/home');
    //     }
    //     if ( $user->issuperadmin() ) 
    //     {
    //         return redirect('/superadmin/home');
    //     }
    //     if ( $user->isofficercrm() ) 
    //     {
    //         return redirect('/officer_crm/home');
    //     }
    //     if ( $user->ismanagercrm() ) 
    //     {
    //         return redirect('/manager_crm/home');
    //     }
    //     if ( $user->isdirektur() ) 
    //     {
    //         return redirect('/direktur/home');
    //     }
    //     if ( $user->ismanagernoncrm() ) 
    //     {
    //         return redirect('/manager_non_crm/home');
    //     }
    //     // else {
    //     //     return redirect('/');
    //     // }
    // }
    

    /**
     * Where to redirect users after login.
     *
     * @var string
     */


    /**
     * Create a new controller instance.
     *
     * @return void
     */
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
