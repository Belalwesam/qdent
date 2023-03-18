<?php

//use Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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

Route::get('table/{id}','Api\HomeController@table');
Route::get('/testme', function (Request $request) { dd($request->header()); });


Route::group([
    'prefix' => 'auth'
], function () {

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
Route::middleware(['auth:api'])->group(function () {
    // Authorized routs
    Route::get('user', 'AuthController@user');
    Route::patch('user/update', 'AuthController@userUpdate');
    Route::get('home', 'Api\HomeController@home');
    Route::get('categories', 'Api\HomeController@categories');
    Route::get('category/{category}/{sub_Category?}', 'Api\HomeController@category');
    Route::get('product/{product}', 'Api\HomeController@product');
    Route::post('rate', 'Api\HomeController@rate');

    Route::get('event/{event}', 'Api\HomeController@event');
    Route::post('interested/', 'Api\HomeController@interested');

    Route::get('feed/{feed}', 'Api\HomeController@feed');
    Route::post('like/', 'Api\HomeController@like');

    Route::post('address/', 'Api\HomeController@address');
    Route::get('address', 'Api\HomeController@addressGet');

    Route::get('search/{text}', 'Api\HomeController@search');


    Route::resource('favorite', 'Api\FavoriteContrroler');


//    Route::post('order', 'Api\HomeController@orderPost');

    Route::resource('order', 'Api\OrderController');


});
