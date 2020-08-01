<?php

namespace App\Http\Middleware;

use Closure;

class isSuperAdmin
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
        if(\Auth::check() && $request->user()->issuperadmin()){
            return $next($request);
        }
        return redirect('/login');
    }
}
