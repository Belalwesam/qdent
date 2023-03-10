<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;
use Session;

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
            Auth::logout();
            Session::flush();
            switch ($guard) {
                case 'web':
                    $path = 'web';
                    break;
                case 'drivers-web':
                    $path = 'drivers-web';
                    break;
            }
            return redirect($path='/');
        }
        return $next($request);
    }
}
