<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
class LoginController extends Controller
{




    use AuthenticatesUsers ;

    /**
     * Where to redirect users after login.
     *ss
     * @var string
     */
    protected $redirectTo = '/owner';

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

    public function showAdminLoginForm()
    {
        return view('auth.login', ['url' => 'admin']);
    }


    public function showRegistrationForm(){

        return view('auth.register-2');

    }
    public function adminLogin(Request $request)
    {

        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]);
        if (Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {

            return redirect()->intended('/admin');
        }
        return back()->withInput($request->only('email', 'remember'))->withErrors([ ' تأكد من البيانات المدخلة']);
    }



    public function showLoginForm()
    {
        return view('auth.login-2', ['url' => 'owner']);
    }

//    public function login(Request $request)
//    {
//        dd('234');
//        $this->validate($request, [
//            'phone'   => 'required',
//            'password' => 'required|min:6'
//        ]);
//
//        if (Auth::guard('drivers-web')->attempt(['phone' => $request->phone, 'password' => $request->password,'is_owner'=> 1], $request->get('remember'))) {
//
//            return redirect()->intended('/owner');
//        }
//        return back()->withInput($request->only('phone', 'remember'))->withErrors([ ' تأكد من البيانات المدخلة']);
//    }
    protected function getFailedLoginMessage()
    {
        return 'what you want here.';
    }

//    public function logout(Request $request)
//    {
////        $this->performLogout($request);
//        return redirect()->route('login');
//    }
}
