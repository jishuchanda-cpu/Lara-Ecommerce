<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CouponController as AdminCouponController;

/* |-------------------------------------------------------------------------- | Frontend Routes |-------------------------------------------------------------------------- */

// Home
Route::get('/', [HomeController::class , 'index'])->name('home');

// Products
Route::get('/products', function () {
    return view('products.index');
})->name('products.index');

Route::get('/products/{product:slug}', [HomeController::class , 'productShow'])->name('products.show');

// Categories
Route::get('/categories/{category:slug}', [HomeController::class , 'categoryShow'])->name('categories.show');

/* |-------------------------------------------------------------------------- | Customer Order Routes |-------------------------------------------------------------------------- */

Route::middleware('auth')->prefix('orders')->name('orders.')->group(function () {
    Route::get('/', [OrderController::class , 'index'])->name('index');
    Route::get('/{order}', [OrderController::class , 'show'])->name('show');
    Route::post('/{order}/cancel', [OrderController::class , 'cancel'])->name('cancel');
});

/* |-------------------------------------------------------------------------- | Cart & Checkout Routes |-------------------------------------------------------------------------- */

Route::get('/cart', [CheckoutController::class , 'cart'])->name('cart');
Route::patch('/cart/update', [CheckoutController::class , 'updateCart'])->name('cart.update');
Route::get('/cart/remove/{productId}', [CheckoutController::class , 'removeItem'])->name('cart.remove');

Route::get('/checkout', [CheckoutController::class , 'checkout'])->name('checkout');
Route::post('/checkout', [CheckoutController::class , 'process'])->name('checkout.process');
Route::get('/checkout/confirmation/{order}', [CheckoutController::class , 'confirmation'])->name('checkout.confirmation');

// Coupons
Route::post('/coupon/apply', [CouponController::class , 'apply'])->name('coupon.apply');
Route::get('/coupon/remove', [CouponController::class , 'remove'])->name('coupon.remove');

/* |-------------------------------------------------------------------------- | Authentication Routes |-------------------------------------------------------------------------- */

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', [AuthenticatedSessionController::class , 'store']);
Route::post('/logout', [AuthenticatedSessionController::class , 'destroy'])->name('logout');

/* |-------------------------------------------------------------------------- | Chat Routes |-------------------------------------------------------------------------- */

Route::get('/chat', function () {
    return view('chat');
})->middleware('auth');

Route::prefix('api/chat')->middleware('auth')->group(function () {
    Route::get('/conversations', [ChatController::class , 'conversations']);
    Route::post('/conversations', [ChatController::class , 'createConversation']);
    Route::get('/conversations/{conversation}/messages', [ChatController::class , 'messages']);
    Route::post('/conversations/{conversation}/messages', [ChatController::class , 'sendMessage']);
    Route::put('/conversations/{conversation}/title', [ChatController::class , 'updateConversationTitle']);
    Route::delete('/conversations/{conversation}', [ChatController::class , 'deleteConversation']);
});

/* |-------------------------------------------------------------------------- | Admin Routes |-------------------------------------------------------------------------- */

Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'admin'])
    ->group(function () {
        Route::get('/dashboard', [AdminController::class , 'dashboard'])->name('dashboard');

        // Products
        Route::resource('products', AdminProductController::class);

        // Categories
        Route::resource('categories', AdminCategoryController::class);

        // Orders with additional routes
        Route::resource('orders', AdminOrderController::class)->except(['create', 'store']);
        Route::post('/orders/{order}/status', [AdminOrderController::class , 'updateStatus'])->name('orders.status.update');
        Route::post('/orders/{order}/payment', [AdminOrderController::class , 'updatePaymentStatus'])->name('orders.payment.update');
        Route::post('/orders/{order}/note', [AdminOrderController::class , 'addNote'])->name('orders.note.add');
        Route::post('/orders/{order}/cancel', [AdminOrderController::class , 'cancel'])->name('orders.cancel');

        // Users
        Route::resource('users', UserController::class)->except(['create', 'store']);

        // Coupons
        Route::resource('coupons', AdminCouponController::class);
    });
