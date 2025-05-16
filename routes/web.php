<?php

<<<<<<< HEAD
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\MemberController;

Route::get('/', function () {
    return view('welcome');
});

// Route untuk resource books
Route::resource('books', BookController::class);
Route::resource('members', MemberController::class);
=======

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\LoanController;

Route::resource('books', BookController::class);
Route::resource('members', MemberController::class);
Route::middleware(['auth'])->group(function () {
    Route::resource('loans', LoanController::class)->except(['edit', 'update']);
    Route::patch('/loans/{loan}/return', [LoanController::class, 'returnBook'])->name('loans.return');
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
>>>>>>> 077f2ba7555bf4d01cbea2e7efd19cf3d7a1f086
