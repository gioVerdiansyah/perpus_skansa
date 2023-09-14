<?php

use App\Http\Controllers\ProfileController;
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

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';


use App\Http\Controllers\BookController as Book;
use App\Http\Controllers\CategoryController as Category;
use App\Http\Controllers\AuthorController as Auhtor;
use App\Http\Controllers\PublisherController as Publisher;
use App\Http\Controllers\BorrowerController as Borrower;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/author/search/', [Auhtor::class, 'search'])->name('author.search');
    Route::get('/categories/search/', [Category::class, 'search'])->name('categories.search');
    Route::get('/publisher/search/', [Publisher::class, 'search'])->name('publisher.search');
    Route::get('/books/search/', [Book::class, 'search'])->name('books.search');

    Route::resource('/books', Book::class);
    Route::post('/books/{books}/comment', [Book::class, 'commentStore'])->name('books.comment.store');
    Route::put('/books/comment/update/{comment}', [Book::class, 'commentUpdate'])->name('books.comment.update');
    Route::delete('/books/comment/delete/{comment}', [Book::class, 'commentDelete'])->name('books.comment.delete');
    Route::resource('/categories', Category::class);
    Route::resource('/author', Auhtor::class);
    Route::resource('/publisher', Publisher::class);

    // Route::resource('/borrower', Borrower::class);
    Route::get('/borrower', [Borrower::class, 'index'])->name('borrower.index');
    Route::post('/borrower', [Borrower::class, 'store'])->name('borrower.store');
    Route::put('/borrower/{borrower}', [Borrower::class, 'update'])->name('borrower.update');
    Route::delete('/borrower/{borrower}', [Borrower::class, 'destroy'])->name('borrower.destroy');
});
