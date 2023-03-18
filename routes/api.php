<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('table/{id}', 'Api\HomeController@table');
Route::get('/testme', function (Request $request) {
    dd($request->header());
});
Route::get('settings', 'Api\HomeController@setting');

Route::post('social_login', 'AuthController@social_login');

Route::group([
    'prefix' => 'auth'
], function () {

    // guest login 
    Route::post('guest-login' , 'AuthController@guestLogin');
    // verify guest login active or not 
    Route::get('guest-login-status' , 'AuthController@guestLoginStatus');
    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signup');
    Route::post('forget', 'AuthController@forget');
    Route::post('check/code', 'AuthController@check');
    Route::post('reset/password', 'AuthController@reset');
    Route::get('/social/{provider}', 'AuthController@redirectToProvider');
    Route::post('login/social/', 'AuthController@socialLogin');
    Route::get('/social/{provider}/callback', 'AuthController@handleProviderCallback');

    /**
     * Rest Password
     */
    Route::post('reset', 'AuthController@reset');
    Route::post('checkCode', 'AuthController@checkCode');
    Route::post('verify/url/', 'AuthController@verifyUrl');
    Route::post('resetPassword', 'AuthController@resetPassword');
});


$middleware = ['api'];
if (Request::header('Authorization'))
    $middleware = array_merge(['auth:api']);

// Route::group(['middleware' => $middleware], function () {
Route::get('home', 'Api\HomeController@home');
Route::get('categories', 'Api\HomeController@categories');
Route::get('category', 'Api\HomeController@category');
Route::get('product/{product}', 'Api\HomeController@product');
Route::get('rate/{product}', 'Api\HomeController@rates');
Route::get('products', 'Api\HomeController@products');
Route::get('arrtabiute', 'Api\HomeController@arrtabiute');
Route::get('event/{event}', 'Api\HomeController@event');
Route::get('events/', 'Api\HomeController@events');
Route::get('feed/{feed}', 'Api\HomeController@feed');
Route::get('feeds', 'Api\HomeController@feeds');
Route::get('catalog/', 'Api\HomeController@catalog');
Route::get('search/{text?}', 'Api\HomeController@search');
Route::get('filter/', 'Api\HomeController@filter');
Route::get('employees', 'Api\HomeController@employees');
Route::get('shippingMethod', 'Api\HomeController@shippingMethod');

// app version route
Route::get('/app-version' , 'Api\HomeController@appVersion');

// });



Route::middleware(['auth:api'])->group(function () {
    // logout method 
    Route::post('auth/logout', 'AuthController@logout');
    //update profile image route
    Route::patch('user-image-change', 'Api\HomeController@profileImageUpdate');

    // Authorized routs
    Route::post('logout', 'AuthController@logout');

    Route::get('user', 'AuthController@user');
    Route::post('like/', 'Api\HomeController@like');
    Route::post('dislike/', 'Api\HomeController@dislike');
    Route::post('user/update', 'AuthController@userUpdate');
    // notification
    Route::get('notifications', 'Api\HomeController@notification');
    Route::post('rate', 'Api\HomeController@rate');
    Route::post('interested/', 'Api\HomeController@interested');
    Route::post('address/', 'Api\HomeController@address');
    Route::get('address', 'Api\HomeController@addressGet');
    Route::post('address/update/{Address}', 'Api\HomeController@addressUpdate');
    Route::post('address/delete/{Address}', 'Api\HomeController@addressDelete');
    Route::get('favorite', 'Api\FavoriteContrroler@index');
    Route::post('favorite/post/{product}', 'Api\FavoriteContrroler@store');
    Route::post('favorite/delete/{product}', 'Api\FavoriteContrroler@destroy');
    // delete from favorite
    //    Route::post('order', 'Api\HomeController@orderPost');
    Route::post('order/post', 'Api\OrderController@store');
    Route::resource('order', 'Api\OrderController');
    Route::get('delete_profile', 'Api\HomeController@delete_user');
});
