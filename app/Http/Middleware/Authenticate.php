<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
//        $request->headers->set('Authorization', `Bearer $request->cookie('accessToken')`);

//        dd( $request->headers,$request->cookie('accessToken'));
        if (\Request::wantsJson()) {
//           dd('sad');
            abort(response()->json(['msg'=>'عليك تسجيل الدخول اولا '], 403));
        }
        if (! $request->expectsJson()) {

            if (in_array('auth:web', $request->route()->middleware())) {
                return route('login');
            }else{
                abort(response()->json(['msg'=>'عليك تسجيل الدخول اولا '], 403));

            }
            return route('login');
        }
    }
}
