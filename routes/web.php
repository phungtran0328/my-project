<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('index',[
    'as'=>'home',
    'uses'=>'HomeController@getIndex'
]);

Route::get('login',[
    'as'=>'login',
    'uses'=>'LoginController@showLoginForm'
]);

Route::post('login',[
    'as'=>'login',
    'uses'=>'LoginController@login'
]);

//Route::get('dang-xuat',[
//    'as'=>'dang-xuat',
//    'uses'=>'khController@postDangxuat'
//]);

Auth::routes();

Route::group(['prefix' => 'admin'], function () {
    //Login Routes...
    //Tiền tố admin
    Route::get('/login','Admin\LoginController@showLoginForm');
    Route::post('/login','Admin\LoginController@login');
//    Route::get('/admin/logout','Admin\AuthController@logout');

    // Registration Routes...
//    Route::get('admin/register', 'Admin\AuthController@showRegistrationForm');
//    Route::post('admin/register', 'Admin\AuthController@register');

    Route::get('/', 'Admin\LoginController@index');

//    Route::resource('/admin/order', 'Admin\AdminBillController');
});