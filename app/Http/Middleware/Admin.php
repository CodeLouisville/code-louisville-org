<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Admin
{
    public function handle($request, Closure $next, $guard = null)
    {
        if ( Auth::check() && Auth::user()->admin == 1 )
        {
            return $next($request);
        }
        else
        {
            if ($request->ajax())
            {
                return response('Unauthorized.', 401);
            }
            else
            {
                abort(401);
            }
        }
    }
}
