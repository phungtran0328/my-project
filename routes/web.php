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

//Route::get('index',[
//    'as'=>'home',
//    'uses'=>'HomeController@getIndex'
//]);

Route::get('/category/{id}','CategoryController@category');

//Route::get('login',[
//    'as'=>'login',
//    'uses'=>'LoginController@showLoginForm'
//]);
//
//Route::post('login',[
//    'as'=>'login',
//    'uses'=>'LoginController@login'
//]);

//Route::get('dang-xuat',[
//    'as'=>'dang-xuat',
//    'uses'=>'khController@postDangxuat'
//]);

Auth::routes();

Route::group(['middleware' => ['web']], function () {
    //Login Routes...
    Route::get('/login','LoginController@showLoginForm');
    Route::post('/login','LoginController@login');
    Route::get('/logout','LoginController@logout');

    // Registration Routes...
    Route::get('/register', 'RegisterController@showRegisterForm');
    Route::post('/register', 'RegisterController@create');
//
    Route::get('/index', 'HomeController@getIndex');

});

Route::group(['prefix' => 'admin'], function () {
    //Login Routes...
    //Tiền tố admin
    Route::get('/login','Admin\LoginController@showLoginForm');
    Route::post('/login','Admin\LoginController@login');
    Route::get('/logout','Admin\LoginController@logout');

    // Registration Routes...
//    Route::get('admin/register', 'Admin\AuthController@showRegistrationForm');
//    Route::post('admin/register', 'Admin\AuthController@register');

    Route::get('/', 'Admin\HomeController@index');

//    Route::resource('/admin/order', 'Admin\AdminBillController');
});