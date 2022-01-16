<?php

namespace App\Http\Middleware;

use Backpack\PermissionManager\app\Models\Role;
use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
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
//        if (!backpack_user()->hasAnyRole(Role::all())) {
//            return redirect('/');
//        }
        return $next($request);
    }
}
