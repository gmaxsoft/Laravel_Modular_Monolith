<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('user-management.profile.show');
    }

    return redirect()->route('auth.login');
});
