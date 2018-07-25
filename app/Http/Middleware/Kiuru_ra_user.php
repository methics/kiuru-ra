<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Kiuru_ra_user
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
            if (Auth::check() && Auth::user()->role == 'kiuru-ra-admin') {
                return $next($request);
            }
            elseif (Auth::check() && Auth::user()->role == 'kiuru-ra-user') {
                return redirect('/');
            }
            else {
                return redirect('/');
            }
    }
}
