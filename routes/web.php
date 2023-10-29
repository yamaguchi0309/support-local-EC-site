<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\CartController;
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
Route::get('/nagasaki_sasebo', function () {
    return view('nagasaki_sasebo');})->middleware(['auth']);

Route::get('/shop', function () {
    return view('shop');})->middleware(['auth']);

// mypage
    Route::get('/mypage', function () {
        return view('mypage');})->middleware(['auth']);
    Route::get('/mypage/edit', [UserController::class, 'findUserData']);
    Route::post('/mypage/edit',[UserController::class, 'findUserData']);
    Route::post('/mypage/edit_confirm',[UserController::class, 'edit_confirm']);
    Route::post('/mypage/edit_complete', [UserController::class, 'update']);

// order
    Route::get('/mypage/orders', [OrderController::class, 'selectOrderData']);
    Route::post('/mypage/orders', [OrderController::class, 'selectOrderData']);
    Route::post('/mypage/orders/detail', [OrderController::class, 'findOrderData']);
    Route::post('/mypage/orders/cancel_complete', [OrderController::class, 'update']);

// contact
    Route::get('/contact', function () {
        return view('contact');})->middleware(['auth']);
    Route::post('/contact/confirm',[ContactController::class, 'confirm']);
    Route::post('/contact/complete', [ContactController::class, 'insert']);

// items
    Route::get('/items', [ItemController::class, 'selectItemData'])->name('search.items'); 
    Route::post('/items', [ItemController::class, 'selectItemData'])->name('search.items'); 
    Route::get('/item/detail', [ItemController::class, 'findItemData'])->name('item.detail');

// cart
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart', [CartController::class, 'insertCart'])->name('cart.insert');
    Route::patch('/cart', [CartController::class, 'updateQuantity'])->name('cart.upadate');
    Route::post('/order/confirm', [CartController::class, 'order_confirm'])->name('order.index');
    Route::post('/order/complete',[CartController::class, 'insertOrder']);



Route::get('/dashboard', function () {
    return view('nagasaki_sasebo');})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';

Route::prefix('admin')->name('admin.')->group(function(){

    Route::get('/dashboard', function () {
        return view('admin.setting');
    })->middleware(['auth:admin', 'verified'])->name('admin');

    Route::get('/setting', function () {
        return view('admin.setting');
    })->middleware(['auth:admin', 'verified'])->name('admin');

    Route::get('/items', function () {
        return view('admin.items');
    })->middleware(['auth:admin', 'verified'])->name('items');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    require __DIR__.'/admin.php';
});

