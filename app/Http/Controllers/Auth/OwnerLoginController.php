<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
class OwnerLoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:drivers-web')->except('logout');
        $this->middleware('guest:web')->except('logout');
    }

  




    public function showOwnerLoginForm()
    {
        return view('auth.login-2', ['url' => 'owner']);
    }

    public function ownerLogin(Request $request)
    {
        $this->validate($request, [
            'phone'   => 'required',
            'password' => 'required|min:6'
        ]);

        if (Auth::guard('drivers-web')->attempt(['phone' => $request->phone, 'password' => $request->password,'is_owner'=> 1], $request->get('remember'))) {

            return redirect()->intended('/owner');
        }
        return back()->withInput($request->only('phone', 'remember'));
    }

}
