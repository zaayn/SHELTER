<?php

namespace App\Http\Middleware;

use Closure;

class isManagerCRM
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
        if(\Auth::check() && $request->user()->ismanagercrm()){
            return $next($request);
        }
        return redirect('/login');
    }
}
