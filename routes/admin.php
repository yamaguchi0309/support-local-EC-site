<?php

use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Admin\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Admin\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Admin\Auth\NewPasswordController;
use App\Http\Controllers\Admin\Auth\PasswordController;
use App\Http\Controllers\Admin\Auth\PasswordResetLinkController;
use App\Http\Controllers\Admin\Auth\RegisteredUserController;
use App\Http\Controllers\Admin\Auth\VerifyEmailController;
use App\Http\Controllers\Admin\ItemController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest:admin')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
                ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('/login', [AuthenticatedSessionController::class, 'create'])             
                ->name('login');

    Route::post('/login', [AuthenticatedSessionController::class, 'store']);

    Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])           
                ->name('password.request');

    Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])               
                ->name('password.email');

    Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])               
                ->name('password.reset');

    Route::post('/reset-password', [NewPasswordController::class, 'store'])                
                ->name('password.update');
                // ->name('password.store');
});

Route::middleware('auth:admin')->group(function () {
    Route::get('/verify-email', [EmailVerificationPromptController::class, '__invoke'])
                ->name('verification.notice');

    Route::get('/verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
                    ->middleware(['auth', 'signed', 'throttle:6,1'])
                    ->name('verification.verify');

    Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                    ->middleware(['auth', 'throttle:6,1'])
                    ->name('verification.send');

    Route::get('/confirm-password', [ConfirmablePasswordController::class, 'show'])
                    ->name('password.confirm');

    Route::post('/confirm-password', [ConfirmablePasswordController::class, 'store']);


    Route::put('/password', [PasswordController::class, 'update'])
                ->name('password.update');

    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('logout'); 

// items:商品管理ルート
    Route::get('/items', [ItemController::class, 'selectItemData'])->name('search.items'); 
    Route::post('/items', [ItemController::class, 'selectItemData'])->name('search.items'); 
   
    Route::post('/items/confirm', [ItemController::class, 'confirm']);
    Route::post('/items/complete', [ItemController::class, 'insert']);

    Route::get('/items/edit', [ItemController::class, 'findItemData']);
    Route::post('/items/edit',[ItemController::class, 'findItemData']);
    Route::post('/items/edit_confirm',[ItemController::class, 'edit_confirm']);
    Route::post('/items/edit_complete', [ItemController::class, 'update']);

    Route::delete('/items/delete', [ItemController::class, 'delete']);
    Route::get('/items/delete', function () {
        $url = url()->previous();
        if($url == "http://localhost:8888/admin/items/"){
            return view('/items/delete');
        }
        return redirect()->back();
    });

// contacts:問合管理ルート
    Route::get('/contacts', [ContactController::class, 'selectContactData'])->name('search.contacts'); 
    Route::post('/contacts', [ContactController::class, 'selectContactData'])->name('search.contacts'); 

    Route::get('/contacts/edit', [ContactController::class, 'findContactData']);
    Route::post('/contacts/edit',[ContactController::class, 'findContactData']);
    Route::post('/contacts/edit_confirm',[ContactController::class, 'edit_confirm']);
    Route::post('/contacts/edit_complete', [ContactController::class, 'update']);

    Route::delete('/contacts/delete', [ContactController::class, 'delete']);
    Route::get('/contacts/delete', function () {
        $url = url()->previous();
        if($url == "http://localhost:8888/admin/contacts/"){
            return view('/contacts/delete');
        }
        return redirect()->back();
    });

// users:会員管理ルート
    Route::get('/users', [UserController::class, 'selectUserData'])->name('search.users');
    Route::post('/users', [UserController::class, 'selectUserData'])->name('search.users');

    Route::get('/users/edit', [UserController::class, 'findUserData']);
    Route::post('/users/edit',[UserController::class, 'findUserData']);
    Route::post('/users/edit_confirm',[UserController::class, 'edit_confirm']);
    Route::post('/users/edit_complete', [UserController::class, 'update']);

    Route::delete('/users/delete', [UserController::class, 'delete']);
    Route::get('/users/delete', function () {
        $url = url()->previous();
        if($url == "http://localhost:8888/admin/users/"){
            return view('/users/delete');
        }
        return redirect()->back();
    });

// orders:注文管理ルート
    Route::get('/orders', [OrderController::class, 'selectOrderData'])->name('search.orders');
    Route::post('/orders', [OrderController::class, 'selectOrderData'])->name('search.orders');
    Route::get('/orders/detail/{id}', [OrderController::class, 'findOrderData'])->name('orders.detail');
    Route::get('/orders/edit/{id}', [OrderController::class, 'edit_findOrderData'])->name('orders.edit');
    Route::patch('/orders/edit', [OrderController::class, 'update'])->name('orders.update');
    Route::post('/orders/edit', [OrderController::class, 'edit_update'])->name('orders.edit_update');


    Route::prefix('admin')->name('admin.')->group(function(){

    });

});

