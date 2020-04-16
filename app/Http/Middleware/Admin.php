<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role = null)
    {
        if($role == null)
            $role = \Request::route()->getName();

        if (!Auth::user()->isGranted($role)){
            abort(401, 'Unauthorized action.');
        }
        return $next($request);
    }
}
