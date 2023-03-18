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

Route::group([
'middleware' => 'auth:web'
], function() {
Route::get('/', 'Admin\HomeController@index')->name('home');

/** Category */
Route::resource('category', 'Admin\CategoryController');
Route::get('categoeryEdit/{id}','Admin\CategoryController@edit')->name('categoeryEdit');
Route::post('catDelete/{id}','Admin\CategoryController@destroy')->name('catDelete');
Route::get('category/sub/gets/{id?}','Admin\CategoryController@get')->name('getSub-Cat');


/**
* Sub Category
*/
Route::resource('subcategory', 'Admin\SubCategoryController');
Route::get('sub/category/edit/{id}','Admin\SubCategoryController@edit')->name('subcategoeryEdit');
Route::post('sub/category/delete/{id}','Admin\SubCategoryController@destroy')->name('subcatDelete');
Route::get('sub/category/gets/{id?}','Admin\SubCategoryController@get')->name('getSubCat');

Route::resource('product', 'Admin\ProductController');
Route::get('product/edits/{ads}', 'Admin\ProductController@edit')->name('product.edits');
Route::post('product/delete/{id}','Admin\ProductController@destroy')->name('product.delete');
Route::get('product/download/{type?}', 'Admin\ProductController@download')->name('product.download');
Route::post('product/img/{id}','Admin\ProductController@deleteImg')->name('img.deletess');
    Route::get('product/get/{status?}','Admin\ProductController@index')->name('product.status');


    Route::resource('event', 'Admin\EventController');
    Route::post('event/delete/{id}','Admin\EventController@destroy')->name('event.delete');


  Route::resource('feed', 'Admin\FeedController');
    Route::post('feed/delete/{id}','Admin\FeedController@destroy')->name('feed.delete');


Route::resource('orders', 'Admin\OrderController');
Route::get('order/edit/{id}','Admin\OrderController@edit')->name('order.edit');
Route::get('order/data/','Admin\OrderController@table')->name('order.data');
Route::get('orders/get/{status}','Admin\OrderController@index')->name('order.status');
Route::post('order/Delete/{id}','Admin\OrderController@destroy')->name('order.delete');
Route::post('order/updates/','Admin\OrderController@updateBulk')->name('orders.updates');
Route::post('orders/status/{id}','Admin\OrderController@status')->name('orders.status');
Route::get('order/download/{type?}', 'Admin\OrderController@download')->name('order.download');
Route::get('order/email/{order}', 'Admin\OrderController@sendemail')->name('order.email');





    /**
     * Social
     */
    Route::resource('social', 'Admin\SocialController');
    Route::get('socials/edit/{id}','Admin\SocialController@edit')->name('social.edit');
    Route::post('socials/Delete/{id}','Admin\SocialController@destroy')->name('social.delete');

    /**
     * Pages
     */
    Route::resource('page', 'Admin\PageController');
    Route::get('pages/edit/{id}','Admin\PageController@edit')->name('page.edit');
    Route::post('pages/Delete/{id}','Admin\PageController@destroy')->name('pages.delete');

    /**
     * emails
     */
    Route::resource('email', 'Admin\EmailController');
    Route::get('email/download/{type?}', 'Admin\EmailController@download')->name('email.download');



    Route::prefix('front')->group(function () {
Route::get('ar/section1','FrontController@ar');
Route::get('ar/section3','FrontController@ar2');
Route::get('ar/section4','FrontController@ar4');
Route::get('ar/section5','FrontController@ar5');
/**
* En
*/
Route::get('en/section1','FrontController@en');
Route::get('en/section3','FrontController@en2');
Route::get('en/section4','FrontController@en4');
Route::get('en/section5','FrontController@en5');


Route::patch('ar/post','FrontController@ar_post')->name('ar.post');
Route::patch('en/post','FrontController@en_post')->name('en.post');
Route::patch('ar/post/{service}','FrontController@ar_srevice')->name('ar.service');
Route::patch('ar/question/{question}','FrontController@ar_question')->name('ar.question');
Route::post('ar/question/create','FrontController@questionCreate')->name('ar.question.create');


});


Route::prefix('user')->group(function () {
Route::get('client', 'Admin\UserController@client');
Route::get('client/search/{value?}', 'Admin\UserController@search');
Route::resource('user', 'Admin\UserController');
Route::get('download/csv/{type?}', 'Admin\UserController@download');
Route::get('user/order/{id}','Admin\UserController@userOrders')->name('users.userOrder');
Route::get('UserEdit/{id}','Admin\UserController@edit')->name('users.UserEdit');
Route::post('UserDelete/{user}','Admin\UserController@destroy')->name('users.UserDelete');

/** Admin */
Route::resource('admin', 'Admin\AdminController');
Route::get('adminEdit/{id}','Admin\AdminController@edit')->name('admin.UserEdit');
Route::post('adminDelete/{user}','Admin\AdminController@destroy')->name('admin.UserDelete');
});





// Quick search dummy route to display html elements in search dropdown (header search)
Route::get('/quick-search', 'PagesController@quickSearch')->name('quick-search');




});


