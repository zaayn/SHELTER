<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            // return redirect('/home');
            $user = \Auth::user();
            if ( $user->isAdmin() ) 
            {
                return redirect('/admin/home');
            }
            if ( $user->issuperadmin() ) 
            {
                return redirect('/superadmin/home');
            }
            if ( $user->isofficercrm() ) 
            {
                return redirect('/officer_crm/home');
            }
            if ( $user->ismanagercrm() ) 
            {
                return redirect('/manager_crm/home');
            }
            if ( $user->isdirektur() ) 
            {
                return redirect('/direktur/home');
            }
            if ( $user->ismanagernoncrm() ) 
            {
                return redirect('/manager_non_crm/home');
            }
        }

        return $next($request);
    }
}
