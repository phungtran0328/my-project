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
Route::get('/category/author/{id}','CategoryController@authorCategory');

Route::group(['middleware' => 'filter'], function() {
    Route::get('/detail/{id}','DetailController@getDetail');
});

Route::get('/search','HomeController@searchName');
Route::get('/search_book','HomeController@search');

//shopping cart
Route::get('/cart','CartController@index');
Route::post('/cart','CartController@store');
Route::post('/cart/update/{id}','CartController@update');
Route::post('cart/delete/{id}','CartController@destroy');
Route::post('/cart/empty', 'CartController@emptyCart');
Route::get('/checkout','CheckoutController@index');
Route::post('/checkout/check','CheckoutController@checkAuth');
Route::post('/checkout/register','CheckoutController@registerAuth');
Route::post('/checkout','CheckoutController@checkout');


Auth::routes();
Route::group(['middleware' => ['web']], function () {
    //Login Routes...
    Route::get('/login','LoginController@showLoginForm');
    Route::post('/login','LoginController@login');
    Route::get('/logout','LoginController@logout');

    // Registration Routes...
    Route::get('/register', 'RegisterController@showRegisterForm');
    Route::post('/register', 'RegisterController@create');

    //home
    Route::get('/index', 'HomeController@getIndex');

    //information customer
    Route::get('/edit/{id}','EditController@showEditForm');
    Route::post('/edit/{id}','EditController@edit');
    Route::get('/change-password/{id}','EditController@showChangePass');
    Route::post('/change-password/{id}','EditController@changePass');
    Route::get('/order/{id}','EditController@showOrder');
    Route::get('/order/delete/{id}','EditController@deleteOrder');
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
    Route::post('/kind-of-book/update/{id}','Admin\KindOfBookController@updateKindOfBook');
    //xóa loại sách
    Route::get('/kind-of-book/delete/{id}','Admin\KindOfBookController@deleteKindOfBook');

    //route dạng resource [index, create, store, show{$id}, edit{$id}, update{$id}, destroy{$id}]
    Route::resource('cover-type','Admin\CoverTypeController')->only(['index','store']);
    Route::post('cover-type/update/{id}','Admin\CoverTypeController@postUpdate');
    Route::get('cover-type/delete/{id}','Admin\CoverTypeController@delete');
    //promotion
    Route::resource('promotion','Admin\PromotionController')->except(['edit','destroy']);
    //promotion delete
    Route::get('promotion/delete/{id}','Admin\PromotionController@delete');

    //publisher
    Route::resource('publisher','Admin\PublisherController')->except(['edit','destroy','show','update','create']);
    Route::post('publisher/update/{id}','Admin\PublisherController@postUpdate');
    Route::get('publisher/delete/{id}','Admin\PublisherController@delete');

    Route::resource('author','Admin\AuthorController')->except(['show','edit','destroy','create','update']);
    Route::post('author/update/{id}','Admin\AuthorController@postUpdate');
//    Route::get('author/update/{id}','Admin\AuthorController@getUpdate');
    Route::get('author/delete/{id}','Admin\AuthorController@delete');

    //book show, update
    Route::resource('book','Admin\BookController')->only('index');
    Route::get('book/detail/{id}','Admin\BookController@detail');
    Route::get('book/create','Admin\BookController@create')->middleware('can:book.create');
    Route::post('book','Admin\BookController@store')->middleware('can:book.create');
    Route::get('book/edit/{id}','Admin\BookController@edit')->middleware('can:book.update');
    Route::patch('book/{id}','Admin\BookController@update')->middleware('can:book.update');
    Route::get('book/delete/{id}','Admin\BookController@delete')->middleware('can:book.delete');


    //book image
    Route::resource('book/image','Admin\ImageController')->only('create','store','show','update');

    //book author and translator
    Route::resource('book/author','Admin\BookAuthorController')->only('create','store','show','update');

    Route::post('book/author/translator','Admin\BookAuthorController@storeTrans');
    Route::post('book/author/translator/{id}','Admin\BookAuthorController@updateTrans');

    //release company
    Route::get('company','Admin\ReleaseCompanyController@index');
//    Route::get('company/create','Admin\ReleaseCompanyController@create')->middleware('can:invoice-in.create');
    Route::post('company','Admin\ReleaseCompanyController@store');
    Route::post('company/update/{id}','Admin\ReleaseCompanyController@update');
    Route::get('company/delete/{id}','Admin\ReleaseCompanyController@delete');

    //user (employee)
    Route::get('user','Admin\UserController@index');
    Route::get('user/create','Admin\UserController@create')->middleware('can:user.create');
    Route::post('user/create','Admin\UserController@store')->middleware('can:user.create');
    Route::get('user/update/{id}','Admin\UserController@show')->middleware('can:user.update');
    //user update profile
    Route::post('user/update/{id}','Admin\UserController@update')->middleware('can:user.update');
    //user update role
    Route::post('user/update/role/{id}','Admin\UserController@updateRole');
    Route::get('user/delete/{id}','Admin\UserController@delete')->middleware('can:user.delete');
    //role
    Route::get('role','Admin\RoleController@index');
    Route::get('role/create','Admin\RoleController@create');
    Route::post('role/create','Admin\RoleController@store');
    Route::get('role/update/{id}','Admin\RoleController@show');
    Route::post('role/update/{id}','Admin\RoleController@update');
    //customer
    Route::get('customer','Admin\CustomerController@index');
    Route::get('customer/delete/{id}','Admin\CustomerController@delete');

    //invoice-in
    Route::get('invoice-in','Admin\InvoiceInController@index');
    Route::get('invoice-in/create','Admin\InvoiceInController@create')->middleware('can:invoice-in.create');
    Route::post('invoice-in/create','Admin\InvoiceInController@store')->middleware('can:invoice-in.create');
    Route::get('invoice-in/create-detail','Admin\InvoiceInController@createDetail');
    Route::post('invoice-in/create-detail/{id}','Admin\InvoiceInController@storeDetail');

    //order
    Route::get('order','Admin\OrderController@index');
    //Lập hóa đơn
    Route::get('order/invoice/{id}','Admin\InvoiceController@invoice')->middleware('can:order.update');
    //Xác nhận giao hàng thành công
    Route::get('order/complete/{id}','Admin\OrderController@complete')->middleware('can:order.update');
    //Hủy đơn hàng
    Route::get('order/cancel/{id}','Admin\OrderController@cancelOrder')->middleware('can:order.update');
    //hiển thị danh sách hóa đơn
    Route::get('invoice','Admin\InvoiceController@index');
//    Route::resource('/admin/order', 'Admin\AdminBillController');
});