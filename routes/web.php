<?php

use App\Events\CustomerOrderEvent;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\CityWithFeeController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\BusinessInformationController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\NotificationController;
use Illuminate\Support\Facades\Route;
use Intervention\Image\ImageManagerStatic as Image;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;
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
Route::get('tester', function(){
    event(new CustomerOrderEvent('Hello World'));
    return view('pusher');
});
/* Route::get('/', function () {
    return view('welcome');
}); */
/* Route::get('/testmail', [MailController::class, 'orderReceipt']); */
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/contact-us', [HomeController::class, 'contactUsView'])->name('contactUsView');
Route::get('/search-result', [HomeController::class, 'searchResult'])->name('searchResult');

/* Route::get('/', function()
{
    $img = Image::make('https://i.ytimg.com/vi/MPV2METPeJU/maxresdefault.jpg')->resize(400,400)->rotate(-45)->blur(15);

    return $img->response('jpg');

}); */

/* Route::get('/about-us', function(){
    return view('aboutUs');
});

Route::get('/contact-us', function(){
    return view('contactUs');
});
 */
require __DIR__.'/auth.php';

Route::prefix('auth')->name('login.')->group(function () {
    Route::get('/redirect/facebook', [AuthenticatedSessionController::class, 'redirectToFacebook'])->name('facebook');
    Route::get('/facebook/callback', [AuthenticatedSessionController::class, 'handleFacebookCallback']);
    Route::get('/redirect/google', [AuthenticatedSessionController::class, 'redirectToGoogle'])->name('google');
    Route::get('/google/callback', [AuthenticatedSessionController::class, 'handleGoogleCallback']);
});

//Auth Pages
Route::middleware(['auth'])->group(function () {
    //Admin Pages
    Route::middleware(['role:Admin'])->group(function () {
        Route::prefix('admin/business')->name('admin.business.')->group(function(){
            Route::get('/information', [BusinessInformationController::class, 'index'])->name('information');
            Route::put('/business-logo', [BusinessInformationController::class, 'updateLogo'])->name('updateLogo');
            Route::put('/business-information', [BusinessInformationController::class, 'updateInformation'])->name('updateInformation');
        });

        Route::prefix('admin/user')->name('admin.user.')->group(function(){
            Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
            Route::get('/profile', [ProfileController::class, 'index'])->name("profile");
            Route::get('/list', [UsersController::class, 'index'])->name('list');
            Route::get('/live-status/{id}', [UsersController::class, 'liveStatus'])->name('liveStatus');
            Route::get('/details/{id}', [UsersController::class, 'details'])->name('details');
            Route::get('/add', [UsersController::class, 'addUser'])->name('add');
            Route::post('/add-new', [UsersController::class, 'store'])->name('addNew');
            Route::put('/activation/{id}', [UsersController::class, 'activation'])->name('activation');
            Route::delete('/delete/{id}', [UsersController::class, 'delete'])->name('delete');
        });

        Route::prefix('admin/product')->name('admin.product.')->group(function(){
            Route::get('/list', [ProductsController::class, 'index'])->name('list');
            Route::get('/add', [ProductsController::class, 'addProductView'])->name("add");
            Route::get('/edit/{id}', [ProductsController::class, 'editProductView'])->name("edit");
            Route::get('/category', [ProductsController::class, 'category'])->name("category");
            Route::post('/category', [ProductsController::class, 'addCategory'])->name("addCategory");
            Route::put('/category/{id}', [ProductsController::class, 'editCategory'])->name("editCategory");
            Route::delete('/category/{id}', [ProductsController::class, 'deleteCategory'])->name("deleteCategory");
            Route::post('/add', [ProductsController::class, 'addProduct'])->name("add");
            Route::put('/edit/{id}', [ProductsController::class, 'updateProduct'])->name("updateProduct");
            Route::put('/update-image/{id}', [ProductsController::class, 'updateImage'])->name("updateImage");
            Route::delete('/delete/{id}', [ProductsController::class, 'deleteProduct'])->name("deleteProduct");
        });

        Route::prefix('admin/city')->name('admin.city.')->group(function(){
            Route::get('/list', [CityWithFeeController::class, 'index'])->name("list");
            Route::post('/add-new-city', [CityWithFeeController::class, 'addNewCity'])->name("addNewCity");
            Route::put('/update-city/{id}', [CityWithFeeController::class, 'updateCity'])->name("updateCity");
            Route::delete('/delete-city/{id}', [CityWithFeeController::class, 'deleteCity'])->name("deleteCity");
        });

        Route::prefix('admin/order')->name('admin.order.')->group(function(){
            Route::get('/list', [OrdersController::class, 'index'])->name("list");
            Route::get('/shipped-orders', [OrdersController::class, 'shippedOrdersView'])->name("shippedOrders");
            Route::get('/delivered-orders', [OrdersController::class, 'deliveredOrdersView'])->name("deliveredOrders");
            Route::get('/view-order-list/{month}/{date}/{year}', [OrdersController::class, 'orderList'])->name("orderlist");
            Route::get('/view', [OrdersController::class, 'viewOrder'])->name("view");
            Route::get('/customer-order-view/{order_id}', [OrdersController::class, 'customerOrderView'])->name("customerOrderView");
            Route::put('/ship-now/{order_id}/{shipping_fee}/{amount}', [OrdersController::class, 'shipOrDeliver'])->name("shipOrDeliver");
            Route::get('/total-earnings', [OrdersController::class, 'totalEarningsView'])->name("totalEarningsView");
            Route::get('/history', [OrdersController::class, 'orderHistory'])->name("history");
            Route::delete('cancel-checkout', [OrdersController::class, 'cancelCheckout'])->name('cancelCheckout');
        });

        Route::prefix('admin/notification')->name('admin.notification.')->group(function () {
            Route::get('index', [NotificationController::class, 'index'])->name('index');
        });
    });

    //Staff Pages
    Route::middleware(['role:Staff'])->group(function () {
        Route::group(["prefix" => "staff", "as" => "staff."], function(){
            Route::get("/dashboard", [DashboardController::class, 'index'])->name("dashboard");
            Route::get('/profile', [ProfileController::class, 'index'])->name("profile");
            /* Route::get('/profile', [ProfileController::class, 'editProfile'])->name("editProfile"); */
        });

        Route::group(["prefix" => "staff/product", "as" => "staff.product."], function(){
            Route::get('/list', [ProductsController::class, 'index'])->name('list');
            Route::get('/add', [ProductsController::class, 'addProductView'])->name("add");
            Route::get('/edit/{id}', [ProductsController::class, 'editProductView'])->name("edit");
            Route::get('/category', [ProductsController::class, 'category'])->name("category");
            Route::post('/category', [ProductsController::class, 'addCategory'])->name("addCategory");
            Route::put('/category/{id}', [ProductsController::class, 'editCategory'])->name("editCategory");
            Route::delete('/category/{id}', [ProductsController::class, 'deleteCategory'])->name("deleteCategory");
            Route::post('/add', [ProductsController::class, 'addProduct'])->name("add");
            Route::put('/edit/{id}', [ProductsController::class, 'updateProduct'])->name("updateProduct");
            Route::put('/update-image/{id}', [ProductsController::class, 'updateImage'])->name("updateImage");
            Route::delete('/delete/{id}', [ProductsController::class, 'deleteProduct'])->name("deleteProduct");
        });

        Route::group(["prefix" => "staff/city", "as" => "staff.city."], function(){
            Route::get('/list', [CityWithFeeController::class, 'index'])->name("list");
            Route::post('/add-new-city', [CityWithFeeController::class, 'addNewCity'])->name("addNewCity");
            Route::put('/update-city/{id}', [CityWithFeeController::class, 'updateCity'])->name("updateCity");
            Route::delete('/delete-city/{id}', [CityWithFeeController::class, 'deleteCity'])->name("deleteCity");
        });

        Route::group(["prefix" => "staff/order", "as" => "staff.order."], function(){
            Route::get('/list', [OrdersController::class, 'index'])->name("list");
            Route::get('/shipped-orders', [OrdersController::class, 'shippedOrdersView'])->name("shippedOrders");
            Route::get('/delivered-orders', [OrdersController::class, 'deliveredOrdersView'])->name("deliveredOrders");
            Route::get('/view-order-list/{month}/{date}/{year}', [OrdersController::class, 'orderList'])->name("orderlist");
            Route::get('/view', [OrdersController::class, 'viewOrder'])->name("view");
            Route::get('/customer-order-view/{order_id}', [OrdersController::class, 'customerOrderView'])->name("customerOrderView");
            Route::put('/ship-now/{order_id}/{shipping_fee}/{amount}', [OrdersController::class, 'shipOrDeliver'])->name("shipOrDeliver");
            Route::get('/total-earnings', [OrdersController::class, 'totalEarningsView'])->name("totalEarningsView");
            Route::get('/history', [OrdersController::class, 'orderHistory'])->name("history");
            Route::delete('cancel-checkout', [OrdersController::class, 'cancelCheckout'])->name('cancelCheckout');
        });

        Route::prefix('staff/notification')->name('staff.notification.')->group(function () {
            Route::get('index', [NotificationController::class, 'index'])->name('index');
        });
    });

    //Customer Pages
    Route::middleware(['role:Customer'])->group(function () {
        Route::group(["prefix" => "customer", "as" => "customer."], function(){
            Route::get('/cart', [CustomerController::class, "cartView"])->name("cart");
            Route::get('/profile', [ProfileController::class, "index"])->name("profile");
            Route::get('/order-details', [CustomerController::class, "orderDetails"])->name("orderDetails");
            Route::get('/view-order-details/{order_id}', [CustomerController::class, "viewOrderDetails"])->name("viewOrderDetails");
            Route::get('/buy-now/{id}', [CustomerController::class, 'buyNow'])->name('buyNow');
            Route::post('/checkout', [OrdersController::class, 'checkout'])->name('checkout');
            Route::put('/oncart-checkout', [OrdersController::class, 'oncartCheckout'])->name('oncartCheckout');
            Route::post('/addtocart', [OrdersController::class, 'addToCart'])->name('addToCart');
            Route::put('/update-oncart/{id}', [OrdersController::class, 'updateOncartQuantity'])->name('updateOncartQuantity');
            Route::get('/oncart-selected', [OrdersController::class, 'oncartSelectedItems'])->name('oncartSelectedItems');
            Route::delete('delete-oncart/{id}', [OrdersController::class, 'deleteOncart'])->name('deleteOncart');
            Route::delete('cancel-checkout', [OrdersController::class, 'cancelCheckout'])->name('cancelCheckout');
            Route::put('edit-order-details/{order_id}', [OrdersController::class, 'editOrderDetailsForm'])->name('editOrderDetailsForm');
        });

        Route::prefix('customer/notification')->name('customer.notification.')->group(function () {
            Route::get('index', [NotificationController::class, 'index'])->name('index');
        });
    });

    Route::group(['prefix' => 'user', 'as' => 'user.'], function () {
        Route::put('/profile-photo', [ProfileController::class, 'editProfilePhoto'])->name('editProfilePhoto');
        Route::put('/profile-info', [ProfileController::class, 'editProfileInfo'])->name('editProfileInfo');
        Route::put('/profile-password', [ProfileController::class, 'changePassword'])->name('changePassword');
    });
});

