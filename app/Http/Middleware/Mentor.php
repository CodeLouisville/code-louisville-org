<?php

namespace App\Http\Middleware;

use App\Mentors;
use Closure;
use Illuminate\Support\Facades\Auth;

class Mentor
{
    public function handle($request, Closure $next, $guard = null)
    {
        $mentor = Mentors::find($request->id);

        if (Auth::check() && ( Auth::user()->admin == 1 || Auth::user()->github_id == $mentor->github_id )) {
            return $next($request);
        } else {
            if ($request->ajax()) {
                return response('Unauthorized.', 401);
            } else {
                abort(401);
            }
        }
    }
}
