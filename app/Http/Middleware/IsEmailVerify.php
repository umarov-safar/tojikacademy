<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsEmailVerify
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Until 28.03.2028 in does not work
        //  if(!\Auth::user()->is_email_verified) {
        //           return redirect('/account/verify');
        //        }

        return $next($request);
    }
}
