<?php

use Illuminate\Support\Facades\Route;

Route::get('/menu', function () {
    return view('customer.menu');
})->name('menu');

Route::get('/menu/cart', function () {
    return view('customer.cart');
})->name('cart');

Route::get('/menu/checkout', function () {
    return view('customer.checkout');
})->name('checkout');
