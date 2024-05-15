<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Auth;



    Route::get('/', [HomeController::class, 'index']);

    Route::middleware(['auth:sanctum', 'verified'])->
        get('/dashboard', function () {
            return view('dashboard');
        })->name('dashboard');

    Route::middleware(['auth:sanctum', 'verified'])->prefix('admin')->group(function () {
            Route::get('/dashboard', function () {
                return view('admin.dashboard');
            })->name('admin.dashboard');
        });


    Route::get('/redirect', [HomeController::class, 'redirect'])->middleware('auth','verified');

    Route::get('/view_category', [AdminController::class, 'view_category']);

    Route::post('/add_category', [AdminController::class, 'add_category']); 

    Route::get('/delete_category/{id}', [AdminController::class, 'delete_category']);

    Route::get('/view_product', [AdminController::class, 'view_product']);

    Route::post('/add_product', [AdminController::class, 'add_product']);

    Route::get('/show_product', [AdminController::class, 'show_product'])->name('show_product');

    Route::get('/delete_product/{id}', [AdminController::class, 'delete_product']);
 
    Route::get('/update_product/{id}', [AdminController::class, 'update_product']);

    Route::post('/update_product_confirm/{id}', [AdminController::class, 'update_product_confirm']);

    Route::get('/product_details/{id}', [HomeController::class, 'product_details']);

    Route::post('/add_cart/{id}', [HomeController::class, 'add_cart']);

    Route::get('/show_cart', [HomeController::class, 'show_cart']);

    Route::get('/remove_cart/{id}', [HomeController::class, 'remove_cart']);
   
    Route::get('/cash_order/{totalproduct}', [HomeController::class, 'cash_order']);

        //stripe route to card payment
    Route::get('/stripe/{totalprice}', [HomeController::class, 'stripe']);

    Route::post('stripe/{totalprice}', [HomeController::class,'stripePost'])->name('stripe.post');

    Route::get('/show_order', [HomeController::class, 'show_order']);

    Route::get('/order', [AdminController::class, 'order']);

    Route::get('/delivered/{id}', [AdminController::class, 'delivered']);

    Route::get('/print_pdf/{id}', [AdminController::class, 'print_pdf']);

    Route::get('/send_email/{id}', [AdminController::class, 'send_email']);

    Route::post('/send_user_email/{id}', [AdminController::class, 'send_user_email']);

    Route::get('/search', [AdminController::class, 'searchdata']);

    Route::get('/cancel_order/{id}', [HomeController::class, 'cancel_order']);

    Route::get('/product_search', [HomeController::class, 'product_search']);

    Route::get('/products', [HomeController::class, 'product']);





   