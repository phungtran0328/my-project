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
    Route::get('/kind-of-book','Admin\KindOfBookController@showKind_of_book');
    Route::post('/kind-of-book','Admin\KindOfBookController@kind_of_book');

    //chỉnh sửa loại sách
    Route::get('/kind-of-book/update/{id}','Admin\KindOfBookController@showUpdate');
    Route::post('/kind-of-book/update/{id}','Admin\KindOfBookController@updateKindOfBook');
    //xóa loại sách
    Route::get('/kind-of-book/delete/{id}','Admin\KindOfBookController@deleteKindOfBook');

    //route dạng resource [index, create, store, show{$id}, edit{$id}, update{$id}, destroy{$id}]
    Route::resource('cover-type','Admin\CoverTypeController')->only(['index','create','store','show','update']);

    //promotion
    Route::resource('promotion','Admin\PromotionController')->except(['edit','destroy']);
    //promotion delete
    Route::get('promotion/delete/{id}','Admin\PromotionController@delete');

    //publisher
    Route::resource('publisher','Admin\PublisherController')->except(['edit','destroy']);
    Route::get('publisher/delete/{id}','Admin\PublisherController@delete');

    Route::resource('author','Admin\AuthorController')->except(['edit','destroy']);
    Route::get('author/delete/{id}','Admin\AuthorController@delete');

    //book show, update
    Route::resource('book','Admin\BookController')->only('index','create','store','show','update');
    Route::get('book/edit/{id}','Admin\BookController@edit')->middleware('can:book.update');
    Route::get('book/delete/{id}','Admin\BookController@delete');
//    Route::get('book/search','Admin\BookController@getSearch');

    //book image
    Route::resource('book/image','Admin\ImageController')->only('create','store','show','update');

    //book author and translator
    Route::resource('book/author','Admin\BookAuthorController')->only('create','store','show','update');

    Route::post('book/author/translator','Admin\BookAuthorController@storeTrans');
    Route::post('book/author/translator/{id}','Admin\BookAuthorController@updateTrans');

    //release company
    Route::get('company','Admin\ReleaseCompanyController@index');
    Route::get('company/create','Admin\ReleaseCompanyController@create');
    Route::post('company/create','Admin\ReleaseCompanyController@store');
    Route::get('company/update/{id}','Admin\ReleaseCompanyController@show');
    Route::post('company/update/{id}','Admin\ReleaseCompanyController@update');
    Route::get('company/delete/{id}','Admin\ReleaseCompanyController@delete');

    //user (employee)
    Route::get('user','Admin\UserController@index');
    Route::get('user/create','Admin\UserController@create');
    Route::post('user/create','Admin\UserController@store');
    Route::get('user/update/{id}','Admin\UserController@show');
    Route::post('user/update/{id}','Admin\UserController@update');
    Route::get('user/delete/{id}','Admin\UserController@delete');
    //role
    Route::get('role','Admin\RoleController@index');
    Route::get('role/create','Admin\RoleController@create');
    Route::post('role/create','Admin\RoleController@store');
    //customer
    Route::get('customer','Admin\CustomerController@index');
    Route::get('customer/delete/{id}','Admin\CustomerController@delete');

    //invoice-in
    Route::get('invoice-in','Admin\InvoiceInController@index');

    Route::get('invoice-in/create','Admin\InvoiceInController@create')->middleware('can:invoice-in.create');
    Route::post('invoice-in/create','Admin\InvoiceInController@store')->middleware('can:invoice-in.create');

    Route::get('invoice-in/create-detail','Admin\InvoiceInController@createDetail');
    Route::post('invoice-in/create-detail/{id}','Admin\InvoiceInController@storeDetail');
//    Route::resource('/admin/order', 'Admin\AdminBillController');
});