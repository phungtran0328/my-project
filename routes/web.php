<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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
    Route::get('/chi-tiet-sach/{id}','DetailController@getDetail');
});

Route::get('/search','HomeController@searchName');
Route::get('/tim-kiem','HomeController@search')->name('search-book');

//contact
Route::get('/request/new','ContactController@indexRequest');
Route::post('/request','ContactController@storeRequest');
Route::get('/map', function (){
   return view('page.contact.map');
});

//top sell
$top_sach = str_slug('top sach ban chay nhat','-');
Route::get('/'.$top_sach,[
    'as'=>'sell',
    'uses'=>'SellController@getTopSell']
);
$top_van_hoc = str_slug('top sach van hoc ban chay nhat','-');
Route::get('/'.$top_van_hoc,[
    'as'=>'sell/kindOfBook',
    'uses'=>'SellController@getTopSellKindOfBook'
]);
$top_kinh_te = str_slug('top sach kinh te ban chay nhat','-');
Route::get('/'.$top_kinh_te,[
    'as'=>'sell/kindOfBookEconomic',
    'uses'=>'SellController@getTopSellEconomic'
]);
// (/ =>url , as => route)

//shopping cart
Route::get('/cart','CartController@index');
Route::post('/cart','CartController@store');
Route::post('/cart/update/{id}','CartController@update');
Route::post('cart/delete/{id}','CartController@destroy');
Route::post('/cart/empty', 'CartController@emptyCart');
Route::get('/thanh-toan','CheckoutController@index')->name('checkout');
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
    Route::get('/order/view/{id}','EditController@showOrderDetail');
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
    Route::get('/setting/{id}', 'Admin\UpdateController@showChangePass');
    Route::post('/setting/{id}','Admin\UpdateController@changePass');

    //thêm, hiển thị danh sách loại sách
    Route::get('/kind-of-book','Admin\KindOfBookController@showKind_of_book');
    Route::post('/kind-of-book','Admin\KindOfBookController@kind_of_book')->middleware('can:book.create');

    //chỉnh sửa loại sách
    Route::post('/kind-of-book/update/{id}','Admin\KindOfBookController@updateKindOfBook')->middleware('can:book.update');
    //xóa loại sách
    Route::get('/kind-of-book/delete/{id}','Admin\KindOfBookController@deleteKindOfBook')->middleware('can:book.delete');

    //route dạng resource [index, create, store, show{$id}, edit{$id}, update{$id}, destroy{$id}]
    Route::resource('cover-type','Admin\CoverTypeController')->only(['index']);
    Route::post('cover-type','Admin\CoverTypeController@store')->middleware('can:book.create');
    Route::post('cover-type/update/{id}','Admin\CoverTypeController@postUpdate')->middleware('can:book.update');
    Route::get('cover-type/delete/{id}','Admin\CoverTypeController@delete')->middleware('can:book.delete');
    //promotion
    Route::resource('promotion','Admin\PromotionController')->only(['index']);
    Route::post('promotion','Admin\PromotionController@store')->middleware('can:book.create');
    Route::patch('promotion/{id}','Admin\PromotionController@update')->middleware('can:book.update');
    Route::post('promotion/book/{id}','Admin\PromotionController@updateBook')->middleware('can:book.update');
    //promotion delete
    Route::get('promotion/delete/{id}','Admin\PromotionController@delete')->middleware('can:book.delete');

    //publisher
    Route::resource('publisher','Admin\PublisherController')->only(['index']);
    Route::post('publisher','Admin\PublisherController@store')->middleware('can:book.create');
    Route::post('publisher/update/{id}','Admin\PublisherController@postUpdate')->middleware('can:book.update');
    Route::get('publisher/delete/{id}','Admin\PublisherController@delete')->middleware('can:book.delete');

    Route::resource('author','Admin\AuthorController')->only(['index']);
    Route::post('author','Admin\AuthorController@store')->middleware('can:book.create');
    Route::post('author/update/{id}','Admin\AuthorController@postUpdate')->middleware('can:book.update');
    Route::get('author/delete/{id}','Admin\AuthorController@delete')->middleware('can:book.delete');

    //book show, update
    Route::resource('book','Admin\BookController')->only('index');
    Route::get('book/create','Admin\BookController@create')->middleware('can:book.create');
    Route::post('book','Admin\BookController@store')->middleware('can:book.create');
    Route::get('book/edit/{id}','Admin\BookController@edit')->middleware('can:book.update');
    Route::patch('book/{id}','Admin\BookController@update')->middleware('can:book.update');
    Route::get('book/delete/{id}','Admin\BookController@delete')->middleware('can:book.delete');
    Route::get('book/export','Admin\BookController@export');
    Route::post('book/import','Admin\BookController@import');

    //book image
    Route::resource('book/image','Admin\ImageController')->only('update')->middleware('can:book.update');

    //book author and translator
    Route::resource('book/author','Admin\BookAuthorController')->only('update')->middleware('can:book.update');
    Route::post('book/author/translator/{id}','Admin\BookAuthorController@updateTrans')->middleware('can:book.update');

    //release company
    Route::get('company','Admin\ReleaseCompanyController@index');
    Route::post('company','Admin\ReleaseCompanyController@store')->middleware('can:invoice-in.create');
    Route::post('company/update/{id}','Admin\ReleaseCompanyController@update')->middleware('can:invoice-in.update');
    Route::get('company/delete/{id}','Admin\ReleaseCompanyController@delete')->middleware('can:invoice-in.delete');

    //user (employee)
    Route::get('user','Admin\UserController@index');
    Route::get('user/create','Admin\UserController@create')->middleware('can:user.create');
    Route::post('user/create','Admin\UserController@store')->middleware('can:user.create');
    //user update profile
    Route::post('user/update/{id}','Admin\UserController@update')->middleware('can:user.update');
//    Route::get('user/delete/{id}','Admin\UserController@delete')->middleware('can:user.delete');
    Route::get('user/print','Admin\UserController@print')->middleware('can:user.create');

    //role
    Route::get('role','Admin\RoleController@index');
    Route::get('role/create','Admin\RoleController@create')->middleware('can:user.create');
    Route::post('role/create','Admin\RoleController@store')->middleware('can:user.create');

    Route::post('role/update/user/{id}','Admin\RoleController@updateUser')->middleware('can:user.update');
    Route::get('role/update/{id}','Admin\RoleController@show')->middleware('can:user.update');
    Route::post('role/update/{id}','Admin\RoleController@update')->middleware('can:user.update');

    Route::get('role/delete/{id}','Admin\RoleController@delete')->middleware('can:user.delete');

    //customer
    Route::get('customer','Admin\CustomerController@index');
    Route::get('customer/delete/{id}','Admin\CustomerController@delete')->middleware('can:customer.delete');
    Route::get('customer/export','Admin\CustomerController@export');

    //invoice-in
    Route::get('invoice-in','Admin\InvoiceInController@index');
    Route::get('invoice-in/create','Admin\InvoiceInController@create')->middleware('can:invoice-in.create');
    Route::post('invoice-in/create','Admin\InvoiceInController@store')->middleware('can:invoice-in.create');
    Route::get('invoice-in/create-detail','Admin\InvoiceInController@createDetail')->middleware('can:invoice-in.create');
    Route::post('invoice-in/create-detail/{id}','Admin\InvoiceInController@storeDetail')->middleware('can:invoice-in.create');

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

    //backup
    Route::get('backup','Admin\BackupController@index');
    Route::get('backup/create','Admin\BackupController@create')->middleware('can:backup.create');
    Route::get('backup/download/{file_name}', 'Admin\BackupController@download')->middleware('can:backup.download');
    Route::get('backup/delete/{file_name}', 'Admin\BackupController@delete')->middleware('can:backup.delete');

    //slider
    Route::get('slider','Admin\SliderController@index');
    Route::post('slider/create','Admin\SliderController@store')->middleware('can:book.create');
    Route::post('slider/update/{id}','Admin\SliderController@update')->middleware('can:book.update');
    Route::get('slider/delete/{id}','Admin\SliderController@delete')->middleware('can:book.delete');

    Route::get('contact','Admin\ContactController@index');
    Route::get('contact/delete/{id}','Admin\ContactController@delete')->middleware('can:book.delete');

    Route::get('search','Admin\HomeController@search');
});