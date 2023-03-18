<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('login', 'Auth\AdminLoginController@showLoginForm');
Route::post('login', 'Auth\AdminLoginController@Login')->name('admin.login');
Route::get('logout', 'Auth\AdminLoginController@logout')->name('logout');

Route::group([
    'middleware' => 'auth:web'
], function () {
    Route::get('/', 'Admin\HomeController@index')->name('home');


    // app version
    Route::get('/app-version' , 'Admin\HomeController@appVersion')->name('app.version');
    Route::patch('/app-version' , 'Admin\HomeController@updateAppVersion')->name('app.version.update');

    // guest login control
    Route::get('/guest-login' , 'Admin\HomeController@guestLoginPage')->name('guest_login.page');
    Route::patch('/guest-login' , 'Admin\HomeController@guestLoginUpdate')->name('guest_login.update');

    /** Category */
    Route::resource('category', 'Admin\CategoryController');
    Route::get('categoeryEdit/{id}', 'Admin\CategoryController@edit')->name('categoeryEdit');
    Route::post('catDelete/{id}', 'Admin\CategoryController@destroy')->name('catDelete');
    Route::get('category/sub/gets/{id?}', 'Admin\CategoryController@get')->name('getSub-Cat');


    /**
     * Sub Category
     */
    Route::resource('subcategory', 'Admin\SubCategoryController');
    Route::get('sub/category/edit/{id}', 'Admin\SubCategoryController@edit')->name('subcategoeryEdit');
    Route::post('sub/category/delete/{id}', 'Admin\SubCategoryController@destroy')->name('subcatDelete');
    Route::get('sub/category/gets/{id?}', 'Admin\SubCategoryController@get')->name('getSubCat');

    Route::resource('product', 'Admin\ProductController');
    Route::get('product/edits/{ads}', 'Admin\ProductController@edit')->name('product.edits');
    Route::post('product/delete/{id}', 'Admin\ProductController@destroy')->name('product.delete');
    Route::get('product/download/{type?}', 'Admin\ProductController@download')->name('product.download');
    Route::post('product/img/{id}', 'Admin\ProductController@deleteImg')->name('img.deletess');
    Route::get('product/get/{status?}', 'Admin\ProductController@index')->name('product.status');
    Route::get('product/getSub_attrabiute/{id?}', 'Admin\ProductController@getSub_attrabiute')->name('product.getSub_attrabiute');


    Route::resource('event', 'Admin\EventController');
    Route::post('event/delete/{id}', 'Admin\EventController@destroy')->name('event.delete');
    Route::get('event/{id}/interests', 'Admin\EventController@interested')->name('event.interested');


    Route::resource('feed', 'Admin\FeedController');
    Route::post('feed/delete/{id}', 'Admin\FeedController@destroy')->name('feed.delete');


    Route::get('attrabiute', 'Admin\AttrabiuteController@index');
    Route::get('attrabiute/create', 'Admin\AttrabiuteController@create');
    Route::post('attrabiute', 'Admin\AttrabiteValueController@store')->name('attrabiuteValue.store');
    Route::get('attrabiute/{id}/edit', 'Admin\AttrabiteValueController@edit')->name('attrabiuteValue.edit');
    Route::patch('attrabiute/{id}/update', 'Admin\AttrabiteValueController@update')->name('attrabiuteValue.update');
    Route::post('attrabiute/{id}/delete', 'Admin\AttrabiteValueController@destroy')->name('attrabiuteValue.deletes');

    Route::get('catalog', 'Admin\CatalogController@index');
    Route::get('catalog/create', 'Admin\CatalogController@create');
    Route::post('catalog', 'Admin\CatalogController@store')->name('catalog.store');
    Route::get('catalog/{id}/edit', 'Admin\CatalogController@edit')->name('catalog.edit');
    Route::patch('catalog/{id}/update', 'Admin\CatalogController@update')->name('catalog.update');
    Route::post('catalog/{id}/delete', 'Admin\CatalogController@destroy')->name('catalog.deletes');

    Route::get('admin', 'Admin\AdminController@index');
    Route::get('admin/create', 'Admin\AdminController@create');
    Route::post('admin', 'Admin\AdminController@store')->name('admin.store');
    Route::get('admin/{id}/edit', 'Admin\AdminController@edit')->name('admin.edit');
    Route::patch('admin/{id}/update', 'Admin\AdminController@update')->name('admin.update');
    Route::post('admin/{id}/delete', 'Admin\AdminController@destroy')->name('admin.deletes');

    Route::get('user', 'Admin\UsersController@index');
    Route::get('user/create', 'Admin\UsersController@create');
    Route::post('user', 'Admin\UsersController@store')->name('user.store');
    Route::get('user/{id}/edit', 'Admin\UsersController@edit')->name('user.edit');
    Route::get('user/{id}/events', 'Admin\UsersController@events')->name('users.events');
    Route::patch('user/{id}/update', 'Admin\UsersController@update')->name('user.update');
    Route::post('user/{id}/delete', 'Admin\UsersController@destroy')->name('user.deletes');

    Route::get('employee', 'Admin\EmployeeController@index');
    Route::get('employee/create', 'Admin\EmployeeController@create');
    Route::post('employee', 'Admin\EmployeeController@store')->name('employee.store');
    Route::get('employee/{id}/edit', 'Admin\EmployeeController@edit')->name('employee.edit');
    Route::patch('employee/{id}/update', 'Admin\EmployeeController@update')->name('employee.update');
    Route::post('employee/{id}/delete', 'Admin\EmployeeController@destroy')->name('employee.deletes');

    Route::get('shippingmethod', 'Admin\ShippingMethodController@index');
    Route::get('shippingmethod/create', 'Admin\ShippingMethodController@create');
    Route::post('shippingmethod', 'Admin\ShippingMethodController@store')->name('shippingmethod.store');
    Route::get('shippingmethod/{id}/edit', 'Admin\ShippingMethodController@edit')->name('shippingmethod.edit');
    Route::patch('shippingmethod/{id}/update', 'Admin\ShippingMethodController@update')->name('shippingmethod.update');
    Route::post('shippingmethod/{id}/delete', 'Admin\ShippingMethodController@destroy')->name('shippingmethod.deletes');

    Route::get('setting', 'Admin\SettingsController@index');
    Route::get('setting/privacy', 'Admin\SettingsController@privacy');
    Route::get('setting/terms', 'Admin\SettingsController@terms');
    Route::get('setting/about', 'Admin\SettingsController@about');
    Route::patch('setting/update', 'Admin\SettingsController@update')->name('setting.update');

    Route::get('chat', function () {
        return view('admin.chat.chat');
    });
    Route::get('chat/new', function () {
        $users = App\User::query()->get();
        return view('admin.chat.new', compact('users'));
    });

    /**
     * Brands Category
     */
    Route::resource('brand', 'Admin\BrandsController');
    Route::get('brand/edit/{id}', 'Admin\BrandsController@edit')->name('brands.edit');
    Route::post('brand/Delete/{id}', 'Admin\BrandsController@destroy')->name('brands.delete');
    /**
     * Slider Category
     */
    Route::resource('slider', 'Admin\SliderController');
    Route::get('slider/edit/{id}', 'Admin\SliderController@edit')->name('sliders.edit');
    Route::get('banner/{id}', 'Admin\SliderController@banner')->name('banner.edit');
    Route::post('banner/{id}/update', 'Admin\SliderController@bannerUpdate')->name('banner.update');
    Route::post('slider/Delete/{id}', 'Admin\SliderController@destroy')->name('sliders.delete');

    /**
     * City
     */
    Route::resource('city', 'Admin\CityController');
    Route::post('city/Delete/{id}', 'Admin\CityController@destroy')->name('city.delete');
    /**
     * Region
     */
    Route::resource('region', 'Admin\RegionController');
    Route::get('region/edit/{id}', 'Admin\RegionController@edit')->name('region.edit');
    Route::post('region/Delete/{id}', 'Admin\RegionController@destroy')->name('region.delete');

    /**
     * Period
     */
    Route::resource('period', 'Admin\PeriodController');
    Route::get('periods/edit/{id}', 'Admin\PeriodController@edit')->name('periods.edit');
    Route::post('period/Delete/{id}', 'Admin\PeriodController@destroy')->name('periods.delete');

    /**
     * Coupon
     */
    Route::resource('coupon', 'Admin\CouponController');
    Route::get('coupons/edit/{id}', 'Admin\CouponController@edit')->name('coupons.edit');
    Route::post('coupons/Delete/{id}', 'Admin\CouponController@destroy')->name('coupons.delete');

    /**
     * Shipping Method
     */
    Route::resource('shipping', 'Admin\ShippingMethodController');
    Route::get('shippings/edit/{id}', 'Admin\ShippingMethodController@edit')->name('shippings.edit');
    Route::post('shippings/Delete/{id}', 'Admin\ShippingMethodController@destroy')->name('shippings.delete');
    /**
     * Orders
     */
    Route::resource('orders', 'Admin\OrderController');
    Route::get('order/edit/{id}', 'Admin\OrderController@edit')->name('order.edit');
    Route::get('order/data/', 'Admin\OrderController@table')->name('order.data');
    Route::get('orders/get/{status}', 'Admin\OrderController@index')->name('order.status');
    Route::post('order/Delete/{id}', 'Admin\OrderController@destroy')->name('order.delete');
    Route::post('order/updates/', 'Admin\OrderController@updateBulk')->name('orders.updates');
    Route::post('orders/status/{id}', 'Admin\OrderController@status')->name('orders.status');
    Route::get('order/download/{type?}', 'Admin\OrderController@download')->name('order.download');
    Route::get('order/email/{order}', 'Admin\OrderController@sendemail')->name('order.email');


    /**
     * Social
     */
    Route::resource('social', 'Admin\SocialController');
    Route::get('socials/edit/{id}', 'Admin\SocialController@edit')->name('social.edit');
    Route::post('socials/Delete/{id}', 'Admin\SocialController@destroy')->name('social.delete');

    /**
     * Pages
     */
    Route::resource('page', 'Admin\PageController');
    Route::get('pages/edit/{id}', 'Admin\PageController@edit')->name('page.edit');
    Route::post('pages/Delete/{id}', 'Admin\PageController@destroy')->name('pages.delete');

    /**
     * emails
     */
    Route::resource('email', 'Admin\EmailController');
    Route::get('email/download/{type?}', 'Admin\EmailController@download')->name('email.download');


    Route::prefix('front')->group(function () {
        Route::get('ar/section1', 'FrontController@ar');
        Route::get('ar/section3', 'FrontController@ar2');
        Route::get('ar/section4', 'FrontController@ar4');
        Route::get('ar/section5', 'FrontController@ar5');
        /**
         * En
         */
        Route::get('en/section1', 'FrontController@en');
        Route::get('en/section3', 'FrontController@en2');
        Route::get('en/section4', 'FrontController@en4');
        Route::get('en/section5', 'FrontController@en5');


        Route::patch('ar/post', 'FrontController@ar_post')->name('ar.post');
        Route::patch('en/post', 'FrontController@en_post')->name('en.post');
        Route::patch('ar/post/{service}', 'FrontController@ar_srevice')->name('ar.service');
        Route::patch('ar/question/{question}', 'FrontController@ar_question')->name('ar.question');
        Route::post('ar/question/create', 'FrontController@questionCreate')->name('ar.question.create');
    });


    Route::prefix('user')->group(function () {
        Route::get('client', 'Admin\UserController@client');
        Route::get('client/search/{value?}', 'Admin\UserController@search');
        Route::resource('user', 'Admin\UserController');
        Route::get('download/csv/{type?}', 'Admin\UserController@download');
        Route::get('user/order/{id}', 'Admin\UserController@userOrders')->name('users.userOrder');
        Route::get('UserEdit/{id}', 'Admin\UserController@edit')->name('users.UserEdit');
        Route::post('UserDelete/{user}', 'Admin\UserController@destroy')->name('users.UserDelete');

        /** Admin */
        Route::resource('admin', 'Admin\AdminController');
        Route::get('adminEdit/{id}', 'Admin\AdminController@edit')->name('admin.UserEdit');
        Route::post('adminDelete/{user}', 'Admin\AdminController@destroy')->name('admin.UserDelete');
    });


    // Quick search dummy route to display html elements in search dropdown (header search)
    Route::get('/quick-search', 'PagesController@quickSearch')->name('quick-search');
});
