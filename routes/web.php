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
Route::get('/author', [AuthorController::class, 'author'])->name('author.author');
Route::get('/add-author', [AuthorController::class, 'add'])->name('author.add');
Route::post('/added-author', [AuthorController::class, 'added'])->name('author.added');
Route::get('/update-author/{id}', [AuthorController::class, 'update'])->name('author.update');
Route::put('/updated-author/{id}', [AuthorController::class, 'updated'])->name('author.updated');
Route::delete('/delete-author/{id}', [AuthorController::class, 'delete'])->name('author.delete');

//BOOK
Route::get('/book', [BookController::class, 'book'])->name('book.book');
Route::get('/add-book', [BookController::class, 'add'])->name('book.add');
Route::post('/added-book', [BookController::class, 'added'])->name('book.added');
Route::get('/update-book/{id}', [BookController::class, 'update'])->name('book.update');
Route::put('/updated-book/{id}', [BookController::class, 'updated'])->name('book.updated');
Route::delete('/delete-book/{id}', [BookController::class, 'delete'])->name('book.delete');
