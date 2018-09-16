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
Route::get('/detail/{id}','DetailController@getDetail');


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

    Route::get('/edit/{id}','EditController@showEditForm');
    Route::post('/edit/{id}','EditController@edit');
    Route::get('/change-password/{id}','EditController@showChangePass');
    Route::post('/change-password/{id}','EditController@changePass');
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

    //home
    Route::get('/index', 'Admin\HomeController@index');

    //chỉnh sửa profile nhân viên
    Route::get('/profile/{id}','Admin\UpdateController@showUpdateForm');
    Route::post('/profile/{id}','Admin\UpdateController@updateProfile');

    //thêm, hiển thị danh sách loại sách
    Route::get('/kind-of-book','Admin\BookController@showKind_of_book');
    Route::post('/kind-of-book','Admin\BookController@kind_of_book');

    //chỉnh sửa loại sách
    Route::get('/kind-of-book/update/{id}','Admin\BookController@showUpdate');
    Route::post('/kind-of-book/update/{id}','Admin\BookController@updateKindOfBook');

    Route::get('/kind-of-book/delete/{id}','Admin\BookController@deleteKindOfBook');
//    Route::resource('/admin/order', 'Admin\AdminBillController');
});