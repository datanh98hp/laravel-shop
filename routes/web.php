<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\CkeditorController;
use App\Http\Controllers\ConfigPage\SettingController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ShopCart;
use App\Http\Controllers\ShopCartController;
use App\Models\ImageProducts;

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

// Route::get('/', function () {
//     return view('welcome');
// });


// Route::get('/', function () {
//     return view('Home');
// });

Route::controller(HomeController::class)->group(function(){
    Route::get('/','index');
});
Route::controller(HomeController::class)->group(function(){
    Route::get('/shop','shop');
});
Route::controller(ProductController::class)->group(function(){
    Route::get('/product-detail/{id}','show');
});
Route::controller(CategoriesController::class)->group(function(){
    Route::get('/products-by-category/{id}','getProductById');
});


Route::controller(HomeController::class)->group(function(){
    Route::get('/contact','contactPage');
});
Route::controller(HomeController::class)->group(function(){
    Route::post('/contact','createRequestCustomer');
});



Route::middleware(['auth','admin'])->group(function () {
    Route::get('/categories', [CategoriesController::class,'index']);
    Route::post('/categories', [CategoriesController::class,'store'])->name('create.category');
    //multi-del-categories
    Route::post('/multi-del-categories', [CategoriesController::class,'multiDdel']);
    Route::post('/del-category', [CategoriesController::class,'delete']);
    Route::post('/update-category/{id?}', [CategoriesController::class,'update']);
    // 
    //products

    Route::get('/products',[ProductController::class,'index']);
    Route::post('/products',[ProductController::class,'store'])->name('create.product');
    Route::post('/multi-del-products', [ProductController::class,'multiDdel']);
   
    Route::post('/del-product/{id}', [ProductController::class,'destroy']);
    Route::post('/update-product/{id}', [ProductController::class,'update'])->name('update.product');



    /// order list

    
    Route::get('/order-list',[OrderController::class,'index']);

    Route::post('/order-by-status',[OrderController::class,'filterByStatus'])->name('filter.order.status');

    Route::get('/order-by-rangedate',[OrderController::class,'filterByStatus']);


    //for ajax
    Route::post('/filter-product-by-category', [ProductController::class,'filterByCategory'])->name('filter.product.category');
    Route::post('/filter-product-by-numDay', [ProductController::class,'filterByNumberDay'])->name('filter.product.numDay');
    Route::post('/filter-product-by-rangeTime', [ProductController::class,'filterByTime'])->name('filter.product.rangeTime');  
    Route::get('/get-products', [ProductController::class,'getall'])->name('filter.products'); 

    //edit image

    Route::post('/update-image/{id}', [ProductController::class,'updateImg'])->name('update.image_product');
    Route::post('/add-image/{product_id}', [ProductController::class,'addImg'])->name('add.image_product');
    Route::post('/del-image/{img_id}', [ProductController::class,'delImg'])->name('del.image_product');

    
/// old cart
    Route::get('cart', [CartController::class, 'cartList'])->name('cart.list');
    Route::post('cart', [CartController::class, 'addToCart'])->name('cart.store'); 
    Route::post('cart_ajax', [CartController::class, 'addToCartAjax'])->name('cart.store.ajax');

    
    Route::post('update-cart', [CartController::class, 'updateItemCart'])->name('cart.update');

    Route::post('remove', [CartController::class, 'removeCart'])->name('cart.remove');
    Route::post('clear', [CartController::class, 'clearAllCart'])->name('cart.clear');
    
    Route::post('checkout',[CartController::class,'checkout'])->name('cart.checkout.ajax');

    Route::post('/pay',[CartController::class,'pay']);
    Route::post('/onepay_payment',[CartController::class,'onepay_payment']);
    //
    Route::post('/vnpay_payment',[CartController::class,'vnpay_payment']);


    Route::get('/payment-status',[CartController::class,'payment_status']);


//new cart

Route::get('shop-cart', [ShopCartController::class, 'index'])->name('shop-cart');





    // setting page 

    Route::get('settings-banner',[SettingController::class,'setting_banner']);

    Route::post('set-banner/{pos}',[SettingController::class,'setBannerImg']);
    // Route::post('set-banner-left',[SettingController::class,'setBannerLeft']);
    // Route::post('set-banner-right',[SettingController::class,'setBannerRight']);

    Route::get('settings-inf',[SettingController::class,'setting_inf']);
    Route::post('set-inf',[SettingController::class,'setBasicInf']);
    Route::post('set-maketinginf',[SettingController::class,'setMarketingInf']);
    Route::post('change-text_banner',[SettingController::class,'changeTextBanner']);
});

Route::get('dashboard', [CustomAuthController::class, 'dashboard']); 

Route::get('login', [CustomAuthController::class, 'index'])->name('login');
Route::post('custom-login', [CustomAuthController::class, 'customLogin'])->name('login.custom'); 
Route::get('registration', [CustomAuthController::class, 'registration'])->name('register-user');
Route::post('custom-registration', [CustomAuthController::class, 'customRegistration'])->name('register.custom'); 
Route::get('signout', [CustomAuthController::class, 'signOut'])->name('signout');

Route::post('Ckeditor/upload',[CkeditorController::class,'upload'])->name('ckeditor.upload');