<?php

namespace App\Http\Controllers\Auth;

use App\Admin;
use App\Http\Controllers\Controller;
use App\Model\City;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Auth;
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'fname' => ['required', 'string', 'max:255'],
            'lname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', ],
            'phone' => ['required', 'string', 'min:10', ],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['fname'].' '.$data['lname'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'city' => $data['city'],
            'address' => $data['address'],
            'is_owner' => 1,
            'status' => 'inactive',
            'password' => Hash::make($data['password']),
        ]);
    }

    public function showRegistrationForm(){
        $cities = City::all();
        return view('auth.register-2',compact('cities'));
    }

    public function ownerRegister(Request $request){
//        dd('asd');
        $this->validate($request,[
            'fname' => 'required|string',
            'lname' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:8',
            'phone' => 'required|string|min:10|unique:users',
        ]);

      $user =   new User();
      $user->fill($request->all());
      $user->name = $request->fname.' '.$request->lname;
        $user->is_owner  = 1;
        $user->password = bcrypt($request->password);
        $user->status = 'inactive';
        $user->code = 00000;
//        $user->save();
        if($user->save()){
            if (Auth::guard('drivers-web')->attempt(['phone' => $request->phone, 'password' => $request->password,'is_owner'=> 1])) {

                return redirect()->intended('/owner');
            }

        }
        return  redirect()->back()->with('error','حصل خطأ ما')->withInput($request->only('email', 'phone','fname','lname','address'));
    }
}
