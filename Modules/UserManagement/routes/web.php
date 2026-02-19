<?php

use Illuminate\Support\Facades\Route;
use Modules\UserManagement\Http\Controllers\AccountSettingsController;
use Modules\UserManagement\Http\Controllers\ProfileController;

Route::middleware(['auth'])->prefix('user-management')->name('user-management.')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/account-settings', [AccountSettingsController::class, 'show'])->name('account-settings.show');
    Route::put('/account-settings/password', [AccountSettingsController::class, 'updatePassword'])->name('account-settings.password');
});
