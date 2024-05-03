<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get("/home" , [HomeController::class , 'redirect'])->name("redirect")->middleware('auth');
Route::get("about" , function(){
    return view('about');
});
Route::get("contact" , function(){
    return view('contact');
});

Route::middleware('auth' , 'is_admin')->group(function(){
Route::controller(ProductController::class)->group(function(){
    Route::get("products" , "all");
    Route::get("products/show/{id}" , "show");
    Route::get("products/create" , "create");
    Route::post("products" , "store");
    Route::get("products/edit/{id}" , "edit");
    Route::post("products/update/{id}" , "update");
    Route::post("products/delete/{id}" , "delete");
    Route::get("searchProduct" , 'search');
});
Route::resource('roles', RoleController::class);
Route::resource('users', UserController::class); 
Route::get("categories" , [CategoryController::class , 'index']);
Route::get("categories/create" , [CategoryController::class , "create"]);
Route::post("categories" , [CategoryController::class , 'store']);
Route::get("categories/edit/{id}" , [CategoryController::class , 'edit']);
Route::post("categories/update/{id}" , [CategoryController::class , 'update']);
Route::delete('categories/delete/{id}', [CategoryController::class, 'destroy'])->name('categories.delete');
Route::get("manageUser" , [UserController::class , "manageUser"]);
Route::get("searchUser" , [UserController::class , 'searchUser']);
Route::post("users/change/{id}" , [UserController::class , 'changeStatus']);
Route::delete("user/delete/{id}" , [UserController::class , 'deleteUser'])->name('users.delete');
Route::get("orders" , [OrderController::class , 'viewOrders']);
Route::get("searchOrder" , [OrderController::class , 'searchOrder']);
Route::get("orders/show/{id}" , [OrderController::class , 'showOrder']);
Route::get("delivered/{id}" , [OrderController::class , 'delivered']);
Route::get("print_pdf/{id}" , [OrderController::class , 'printPDF']);
});


Route::controller(CustomerController::class)->group(function(){
    Route::get("" , "index");
    Route::get("products/{id}" , "show");
    Route::get("search" , "search");
    Route::get("allProducts" , 'all'); 
});

Route::controller(CartController::class)->group(function(){
    Route::middleware('auth' , 'is_user')->group(function(){
        Route::post("add_cart/{id}" , 'addCart');
        Route::get("showCart" , 'showCart');
        Route::post("remove_cart/{id}" , 'removeCart');
    });
});

Route::controller(OrderController::class)->middleware('auth' , 'is_user')->group(function(){
    Route::post("makeOrder" , 'makeOrder');
    Route::get("stripe" , 'stripe');
    Route::post('stripe/{totalPrice}', 'stripePost')->name('stripe.post');
    Route::get("displayOrder" , 'displayOrdersToCustomer');
    Route::get("order/details/{id}" , 'showOrderDetailsToCustomer');
    Route::post("cancel_order/{id}" , 'cancelOrder');
});



