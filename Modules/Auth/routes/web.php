<?php

use Illuminate\Support\Facades\Route;
use Modules\Auth\Http\Controllers\LoginController;
use Modules\Auth\Http\Controllers\NewPasswordController;
use Modules\Auth\Http\Controllers\PasswordResetLinkController;
use Modules\Auth\Http\Controllers\RegisterController;

Route::middleware('guest')->group(function () {
    Route::get('login', [LoginController::class, 'create'])->name('auth.login');
    Route::post('login', [LoginController::class, 'store']);
    Route::get('register', [RegisterController::class, 'create'])->name('auth.register');
    Route::post('register', [RegisterController::class, 'store']);
    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])->name('auth.password.request');
    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])->name('auth.password.email');
    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])->name('auth.password.reset');
    Route::post('reset-password', [NewPasswordController::class, 'store'])->name('auth.password.store');
});

Route::middleware('auth')->group(function () {
    Route::post('logout', [LoginController::class, 'destroy'])->name('auth.logout');
});
