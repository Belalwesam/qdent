<?php

namespace App\Http\Controllers;

use App\Mail\UserVerfiy;
use App\Mail\UserVerfiyPassword;
use App\Model\Device;
use App\Model\Membership;
use App\Model\MobileToken;
use App\Rate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Validator;
use Laravel\Passport\HasApiTokens;
use App\Http\Resources\UserResource;
use Illuminate\Http\Response;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\JsonResponse;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public static function convertArabicNumbers($string)
    {
        //$engish = array(0,1,2,3,4,5,6,7,8,9);
        static $fromchar = array(
            '۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹',
            '٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩'
        );
        static $num = array(
            '0', '1', '2', '3', '4', '5', '6', '7', '8', '9',
            '0', '1', '2', '3', '4', '5', '6', '7', '8', '9'
        );
        return str_replace($fromchar, $num, $string);
    }

    /**
     * Create user
     *
     * @param  [string] name
     * @param  [string] email
     * @param  [string] password
     * @param  [string] password_confirmation
     * @return [string] message
     */
    public function signup(Request $request)
    {

        //        dd($request->all());all

        $validator = Validator::make($request->all(), [
            'phone' => ['required', 'string', 'unique:users'],
            'email' => ['required', 'string', 'email', 'unique:users'],
            'username' => ['required', 'string', 'unique:users'],
            'name' => ['required', 'string'],
            'password' => ['required', 'string', 'min:6'],
            'fcm_token' => ['required'],
            'device' => ['required'],
        ]);

        if ($validator->fails()) {
            return Parent::json('422', false, $validator->messages()->first(), $validator->messages());
        }
        //
        $user = new User();
        $user->fill($request->all());
        $user->password = bcrypt($request->password);
        $user->status = 'active';
        $user->save();

        MobileToken::query()->updateOrCreate(
            ['user_id' => $user->id, 'token' => $request->fcm_token, 'device' => $request->device],
            ['user_id' => $user->id, 'token' => $request->fcm_token, 'device' => $request->device]
        );

        if ($request->has('player_id')) {
            $device = new Device();
            $device->user_id = $user->id;
            $device->device = $request->device;
            $device->player_id = $request->player_id;
            $device->save();
        }
        //        $email = Mail::to($user->email)->send(new UserVerfiy($user));

        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        if ($request->remember_me)
            $token->expires_at = Carbon::now()->addWeeks(1);
        $token->save();
        $data = [
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString(), 'user' => UserResource::make($user)
        ];
        $user->update();

        return Parent::json('200', true, 'User Registration Done ', $data);
    }


    /**
     *
     *
     * Acitve user
     */
    public function activeUser(Request $request)
    {

        //        return \response()->json($request->all());

        $user = $request->user();

        if ($user->code != $request->code & $user->code != null) {
            return Parent::json(
                '403',
                false,
                __('رمز التفعيل خاطئ , يرجى التأكد مرى أخرى')
            );
        } else {
            $user->status = 'active';
            $user->code = null;
            $user->update();
            $tokenResult = $user->createToken('Personal Access Token');
            $token = $tokenResult->token;
            if ($request->remember_me)
                $token->expires_at = Carbon::now()->addWeeks(1);
            $token->save();
            $data = [
                'access_token' => $tokenResult->accessToken,
                'token_type' => 'Bearer',
                'expires_at' => Carbon::parse(
                    $tokenResult->token->expires_at
                )->toDateTimeString()
            ];
            $user->update();
            return Parent::json('200', true, 'تم تفعيل الحساب', $data);

            //            return response()->json([
            //                'message'=>'تم تفعيل الحساب'
            //            ],200);
        }
    }

    /**
     * Login user and create token
     *
     * @param  [string] email
     * @param  [string] password
     * @param  [boolean] remember_me
     * @return [string] access_token
     * @return [string] token_type
     * @return [string] expires_at
     */
    public function chckphone(Request $request)
    {
    }

    public function socialLogin(Request $request)
    {

        $user = User::where('email', $request->email)->first();
        if ($user == null) {
            $user = new User();
            $user->fill($request->all());
            $user->status = 'active';
            $username = strstr($request->email, '@', true);
            $user->name = $request->name;
            $user2 = User::where('username', $username)->first();
            if ($user2 == null) {
                $user->username = $username;
            } else {
                $fourRandomDigit = rand(1000, 9999);

                $user->username = $username . $fourRandomDigit;
            }
            if ($request->has('avatar_img')) {
                $fileContents = file_get_contents($request->avatar_img);
                $path = 'avatars/' . $user->username . rand(10000, 99999) . ".jpg";
                //                \File::put( '/home/swipiali/public_html/swipy/storage/app/public/'. $path, $fileContents);
                $user->img = $path;
            }
            $user->save();
            if ($request->has('player_id')) {
                $device = Device::where('user_id', $user->id)->where('player_id', $request->player_id)->first();
                if ($device == null) {
                    $device = new Device();
                    $device = new Device();
                    $device->user_id = $user->id;
                    $device->device = $request->device;
                    $device->player_id = $request->player_id;
                    $device->save();
                }
            }
        }
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        if ($request->remember_me)
            $token->expires_at = Carbon::now()->addWeeks(1);
        $token->save();
        $data = [
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString(), 'user' => UserResource::make($user)
        ];

        return Parent::json('200', true, 'تسجيل الدخول', $data);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required'],
            'password' => ['required'],
            'fcm_token' => ['required'],
            'device' => ['required'],
        ]);
        if ($validator->fails()) {
            return Parent::json(
                '422',
                false,
                $validator->messages()->first(),
                $validator->messages()
            );
        }


        if (!Auth::guard('drivers-web')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return Parent::json(
                '401',
                false,
                'البيانات المدخلة خاطئة'
            );
        }
        $user = Auth::guard('drivers-web')->user();

        if ($request->has('player_id')) {
            $device = Device::where('user_id', $user->id)->where('player_id', $request->player_id)->first();
            if ($device == null) {
                $device = new Device();
                $device = new Device();
                $device->user_id = $user->id;
                $device->device = $request->device;
                $device->player_id = $request->player_id;
                $device->save();
            }
        }

        MobileToken::query()->updateOrCreate(
            ['user_id' => $user->id, 'token' => $request->fcm_token, 'device' => $request->device],
            ['user_id' => $user->id, 'token' => $request->fcm_token, 'device' => $request->device]
        );

        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        if ($request->remember_me)
            $token->expires_at = Carbon::now()->addWeeks(1);
        $token->save();
        $data = [
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString(), 'user' => UserResource::make($user)
        ];
        if ($user->status == 'inactive') {
            $fourRandomDigit = rand(1000, 9999);
            $user->code = $fourRandomDigit;
            $user->update();
            //                $email = Mail::to($user->email)->send(new UserVerfiy($user));
            $sms = parent::phone($user->phone, $user->codeText());

            return Parent::json('201', true, __("Please Active your account "), $data);
        }
        return Parent::json('200', true, 'Login', $data);
    }

    /**
     * Logout user (Revoke the token)
     *
     * @return [string] message
     */
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        if ($request->user()->guest) {
            $user = User::find($request->user()->id);
            $user->delete();
        }
        return Parent::json('200', true, 'تسجيل خروج');
    }

    /**
     * Get the authenticated User
     *
     * @return [json] user object
     */
    public function user(Request $request)
    {
        return Parent::json('200', true, $request->user()->name, UserResource::make($request->user()));
    }

    public function userUpdate(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'username' => ['string', 'max:255', 'unique:users'],
            'email' => ['string', 'max:255', 'unique:users'],

        ]);
        $user = $request->user();
        $user->update($request->all());
        //        if (isset($request->password)) {
        //            if (Hash::check($request->oldPassword, $user->password)) {
        //                if ($request->password == $request->Cpassword) {
        //                    $user->password = bcrypt($request->password);
        //
        //
        //
        //                } else {
        //                    return Parent::json('402', false, 'كلمة المرور غير متطابقة');
        //                }
        //            } else {
        //                return Parent::json('402', false, 'كلمة المرور  القديمة غير متطابقة');
        //
        //            }
        //
        //        }
        if ($request->has('password')) {
            $user->password = bcrypt($request->password);
        }
        $user->update();
        if ($request->hasFile('img')) {
            $path = $request->file('img')->storeAs('avatars', $user->username . rand(10000, 99999) . ".jpg");
            $user->img = $path;
            $user->update();
        }

        return Parent::json('200', true, 'تم تحديث البيانات', [UserResource::make($user)]);
    }


    public function generateCode()
    {
        return Parent::json('200', true, 'تم إرسال الرمز مرة آخرى');
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * Check Code is true
     */
    public function checkCode(Request $request)
    {
        $user = User::where('phone', $request->phone)->where('code', $request->code)->first();
        if ($user != null) {
            $user->code = null;
            $user->update();
            return Parent::json('200', true, 'Code Verified', ['phone' => $user->phone]);
        } else {
            return Parent::json(
                '404',
                false,
                'يرجى التأكد من الرمز المدخل '
            );
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * Rest Password and Login
     */


    public function forget(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['string'],
        ]);
        if ($validator->fails()) {
            return Parent::json(
                '422',
                false,
                $validator->messages()->first(),
                $validator->messages()
            );
        }

        $user = User::where('email', $request->email)->first();


        if ($user != null) {
            $fourRandomDigit = rand(1000, 9999);
            $user->code = $fourRandomDigit;
            $user->update();
            $email = Mail::to($user->email)->send(new UserVerfiyPassword($user));

            return Parent::json('200', true, __('Your email confirmation code has been sent'), ['email' => $user->email]);
        } else {

            return Parent::json('404', true, __('Please make sure of your email'));
        }
    }

    public function check(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['string'],
            'phone' => ['string'],
            'code' => ['required'],
        ]);
        if ($validator->fails()) {
            return Parent::json(
                '422',
                false,
                $validator->messages()->first(),
                $validator->messages()
            );
        }
        if ($request->has('email')) {
            $user = User::where('email', $request->email)->where('code', $request->code)->first();
        }
        if ($request->has('phone')) {
            $user = User::where('phone', $request->phone)->where('code', $request->code)->first();
        }
        if ($user != null) {
            return Parent::json('200', true, __('Activation code confirmed'), ['email' => $user->email, 'phone' => $user->phone, 'code' => $user->code]);
        } else {
            return Parent::json('400', true, __('Please confirm your code'));
        }
    }

    public function reset(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => ['required', 'string', 'min:6'],
            'email' => ['string'],
            'phone' => ['string'],
            'code' => ['required'],
        ]);
        if ($validator->fails()) {
            return Parent::json(
                '422',
                false,
                $validator->messages()->first(),
                $validator->messages()
            );
        }

        if ($request->has('email')) {
            $user = User::where('email', $request->email)->where('code', $request->code)->first();
        }
        if ($request->has('phone')) {
            $user = User::where('phone', $request->phone)->where('code', $request->code)->first();
        }
        if ($user != null) {
            $user->password = bcrypt($request->password);
            $user->code = null;
            $user->update();
            $tokenResult = $user->createToken('Personal Access Token');
            $token = $tokenResult->token;
            if ($request->remember_me)
                $token->expires_at = Carbon::now()->addWeeks(1);
            $token->save();
            $data = [
                'access_token' => $tokenResult->accessToken,
                'token_type' => 'Bearer',
                'expires_at' => Carbon::parse(
                    $tokenResult->token->expires_at
                )->toDateTimeString()
            ];

            return Parent::json('200', true, 'Login', $data);
        } else {

            return Parent::json(
                '402',
                false,
                __('Something went wrong')
            );
        }
    }

    /**
     * Redirect the user to the Provider authentication page.
     *
     * @param $provider
     * @return JsonResponse
     */
    public function redirectToProvider($provider)
    {
        $validated = $this->validateProvider($provider);
        if (!is_null($validated)) {
            return $validated;
        }

        return Socialite::driver($provider)->stateless()->redirect();
    }

    /**
     * Obtain the user information from Provider.
     *
     * @param $provider
     * @return JsonResponse
     */
    public function handleProviderCallback($provider)
    {
        $validated = $this->validateProvider($provider);
        if (!is_null($validated)) {
            return $validated;
        }
        try {
            $user = Socialite::driver($provider)->stateless()->user();
        } catch (ClientException $exception) {
            return response()->json(['error' => 'Invalid credentials provided.'], 422);
        }

        $userCreated = User::firstOrCreate(
            [
                'email' => $user->getEmail()
            ],
            [
                'email_verified_at' => now(),
                'name' => $user->getName(),
                'status' => true,
            ]
        );
        $userCreated->providers()->updateOrCreate(
            [
                'provider' => $provider,
                'provider_id' => $user->getId(),
            ],
            [
                'avatar' => $user->getAvatar()
            ]
        );
        $token = $userCreated->createToken('token-name')->plainTextToken;

        return response()->json($userCreated, 200, ['Access-Token' => $token]);
    }

    /**
     * @param $provider
     * @return JsonResponse
     */
    protected function validateProvider($provider)
    {
        if (!in_array($provider, ['facebook', 'github', 'google'])) {
            return response()->json(['error' => 'Please login using facebook, github or google'], 422);
        }
    }


    public function verifyUrl(Request $request)
    {
        if ($request->has('token_data')) {
            $token = json_decode(base64_decode($request->token_data));
            $user = User::where('id', $token->id)->where('code', $token->code)->first();
            if ($user) {
                $user->update([
                    'code' => null,
                    'status' => 'active'
                ]);
                $tokenResult = $user->createToken('Personal Access Token');
                $token = $tokenResult->token;
                if ($request->remember_me)
                    $token->expires_at = Carbon::now()->addWeeks(1);
                $token->save();
                $data = [
                    'access_token' => $tokenResult->accessToken,
                    'token_type' => 'Bearer',
                    'expires_at' => Carbon::parse(
                        $tokenResult->token->expires_at
                    )->toDateTimeString()
                ];
                $user->update();
                return Parent::json('200', true, 'تم تفعيل الحساب', $data);
            } else {
                return Parent::json('403', true, __('يرجى التأكد من الرمز الخاص الخاص بك'));
            }
        } else {
            return Parent::json('404', true, __('يرجى التأكد من الرمز الخاص الخاص بك'));
        }
    }

    public function social_login(Request $request)
    {
        $rules = [
            'social_provider' => 'required',
            'social_token' => 'required',
            'fcm_token' => 'required',
            'device' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return Parent::json('422', false, $validator->messages()->first(), $validator->messages());
        }

        $user = User::query()->where('social_token', $request->social_token)->get()->first();

        if (!$user) {
            $new_user = User::query()->create([
                'social_token' => $request->social_token,
                'social_provider' => $request->social_provider,
                'name' => 'User#' . Carbon::now()->timestamp,
                'username' => 'User#' . Carbon::now()->timestamp,
            ]);

            MobileToken::query()->updateOrCreate(
                ['user_id' => $new_user->id, 'token' => $request->fcm_token, 'device' => $request->device],
                ['user_id' => $new_user->id, 'token' => $request->fcm_token, 'device' => $request->device]
            );

            $tokenResult = $new_user->createToken('Personal Access Token');
            $token = $tokenResult->token;
            $token->expires_at = Carbon::now()->addWeeks(1);
            $token->save();
            $data = [
                'access_token' => $tokenResult->accessToken,
                'token_type' => 'Bearer',
                'expires_at' => Carbon::parse($tokenResult->token->expires_at)->toDateTimeString(),
                'user' => UserResource::make($new_user)
            ];
        } else {
            $user->update(['social_token' => $request->social_token]);

            MobileToken::query()->updateOrCreate(
                ['user_id' => $user->id, 'token' => $request->fcm_token, 'device' => $request->device],
                ['user_id' => $user->id, 'token' => $request->fcm_token, 'device' => $request->device]
            );

            $tokenResult = $user->createToken('Personal Access Token');
            $token = $tokenResult->token;
            $token->expires_at = Carbon::now()->addWeeks(1);
            $token->save();
            $data = [
                'access_token' => $tokenResult->accessToken,
                'token_type' => 'Bearer',
                'expires_at' => Carbon::parse($tokenResult->token->expires_at)->toDateTimeString(),
                'user' => UserResource::make($user)
            ];
        }

        return Parent::json('200', true, 'Login', $data);
    }
    // guest login 
    public function guestLogin()
    {
        // $validator = Validator::make($request->all(), [
        //     'phone' => ['required', 'string', 'unique:users'],
        //     'email' => ['required', 'string', 'email', 'unique:users'],
        //     'username' => ['required', 'string', 'unique:users'],
        //     'name' => ['required', 'string'],
        //     'password' => ['required', 'string', 'min:6'],
        //     'fcm_token' => ['required'],
        //     'device' => ['required'],
        // ]);

        // if ($validator->fails()) {
        //     return Parent::json('422', false, $validator->messages()->first(), $validator->messages());
        // }
        //
        $guest_login = \DB::table('app')->first()->guest_login;
        if ($guest_login == 0) {
            return response()->json([
                'success' => false,
                'message' => 'Guest login is currently disabled.'
            ], 403);
        }
        $user_data = [
            'name' => 'guest',
            'username' => 'guest' . random_int(1000, 10000),
            'email' => 'guest' . random_int(10000, 100000) . '@qdent.com',
            'phone' => '123456789',
            'status' => 'active',
            'type' => 'user',
        ];
        $user = new User();
        $random_password = Str::random(8);
        $user->fill($user_data);
        $user->password = bcrypt($random_password);
        $user->status = 'active';
        $user->guest = 1;
        $user->save();

        MobileToken::query()->updateOrCreate(
            ['user_id' => $user->id, 'token' => Str::random(16), 'device' => Str::random(16)],
            ['user_id' => $user->id, 'token' => Str::random(16), 'device' => Str::random(16)]
        );

        // if ($request->has('player_id')) {
        //     $device = new Device();
        //     $device->user_id = $user->id;
        //     $device->device = $request->device;
        //     $device->player_id = $request->player_id;
        //     $device->save();
        // }
        //        $email = Mail::to($user->email)->send(new UserVerfiy($user));

        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        // if ($request->remember_me)
        //     $token->expires_at = Carbon::now()->addWeeks(1);
        $token->save();
        $data = [
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString(), 'user' => UserResource::make($user)
        ];
        $user->update();
        return Parent::json('200', true, 'User Registration Done ', $data);
    }
    public function guestLoginStatus()
    {
        $guest_login = \DB::table('app')->first()->guest_login;
        if ($guest_login) {
            return response()->json([
                'status' => 'active',
                'guestLogin' => true
            ]);
        }
        return response()->json([
            'status' => 'inactive',
            'guestLogin' => false
        ]);
    }
}
