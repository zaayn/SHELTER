<?php

namespace App\Http\Controllers\Auth;
namespace App\Http\Middleware;

use Closure;

class isOfficerCRM
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(\Auth::check() && $request->user()->isofficercrm()){
            return $next($request);
        }
        return redirect('/login');
    }
}
