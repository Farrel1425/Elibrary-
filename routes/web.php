<?php


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
