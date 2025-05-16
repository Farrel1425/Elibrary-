<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\MemberController;

Route::get('/', function () {
    return view('welcome');
});

// Route untuk resource books
Route::resource('books', BookController::class);
Route::resource('members', MemberController::class);
