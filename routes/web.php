<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');



//protected routes
Route::middleware(["auth", "verified"])->group(function () {
    Route::view("productos", "products")
        ->name("products");

    Route::view('profile', 'profile')
        ->name('profile');

    Route::view('dashboard', 'dashboard')
        ->name('dashboard');
});



Route::view("test", "livewire.test")->middleware(["auth", "verified"]);

require __DIR__ . '/auth.php';
