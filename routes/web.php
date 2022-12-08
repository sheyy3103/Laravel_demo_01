<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ExampleController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

//EXAMPLE
Route::get('/', [ExampleController::class, 'home'])->name('home');
Route::get('/about', [ExampleController::class, 'about'])->name('about');

//AUTHOR
Route::prefix('author')->group(function () {
    Route::get('/', [AuthorController::class, 'author'])->name('author.author');
    Route::get('/add', [AuthorController::class, 'add'])->name('author.add');
    Route::post('/added', [AuthorController::class, 'added'])->name('author.added');
    Route::get('/update/{id}', [AuthorController::class, 'update'])->name('author.update');
    Route::put('/updated/{id}', [AuthorController::class, 'updated'])->name('author.updated');
    Route::delete('/delete/{id}', [AuthorController::class, 'delete'])->name('author.delete');
    Route::get('/detail/{id}', [AuthorController::class, 'detail'])->name('author.detail');
    Route::get('/back', [AuthorController::class, 'back'])->name('author.back');
});

//BOOK
Route::prefix('book')->group(function () {
    Route::get('/', [BookController::class, 'book'])->name('book.book');
    Route::get('/add', [BookController::class, 'add'])->name('book.add');
    Route::post('/added', [BookController::class, 'added'])->name('book.added');
    Route::get('/update/{id}', [BookController::class, 'update'])->name('book.update');
    Route::put('/updated/{id}', [BookController::class, 'updated'])->name('book.updated');
    Route::delete('/delete/{id}', [BookController::class, 'delete'])->name('book.delete');
    Route::get('/back', [BookController::class, 'back'])->name('book.back');
});
