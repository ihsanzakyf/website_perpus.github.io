<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BookRentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\RentLogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;

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

Route::get('/', [PublicController::class, 'index']);

Route::middleware('only_guest')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'ceklogin']);
    Route::get('/register', [AuthController::class, 'register']);
    Route::post('/register', [AuthController::class, 'cekregister']);
});

Route::middleware('auth')->group(function () {
    Route::get('logout', [AuthController::class, 'logout']);
    Route::get('profile', [UserController::class, 'profile'])->middleware('only_client');
    Route::middleware('only_admin')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index']);

        Route::get('books', [BookController::class, 'index']);
        Route::get('books-add', [BookController::class, 'add']);
        Route::post('/books-add', [BookController::class, 'store']);
        Route::get('/books-edit/{slug}', [BookController::class, 'edit']);
        Route::put('/books-edit/{slug}', [BookController::class, 'update']);
        Route::get('/books-delete/{slug}', [BookController::class, 'delete']);
        Route::delete('/books-destroy/{slug}', [BookController::class, 'destroy']);

        Route::get('/deleted-book', [BookController::class, 'deleted']);
        // Route::get('/deleted-restore/{slug}', [BookController::class, 'restore']);

        Route::get('category', [CategoryController::class, 'category']);
        Route::get('category-add', [CategoryController::class, 'add']);
        Route::post('category-add', [CategoryController::class, 'store']);
        Route::get('category-edit/{slug}', [CategoryController::class, 'edit']);
        Route::put('category-edit/{slug}', [CategoryController::class, 'update']);
        Route::get('category-delete/{slug}', [CategoryController::class, 'delete']);
        Route::delete('category-destroy/{slug}', [CategoryController::class, 'destroy']);

        Route::get('deleted-list', [CategoryController::class, 'deleted']);
        Route::get('deleted-restore/{slug}', [CategoryController::class, 'restore']);

        Route::get('user', [UserController::class, 'user']);
        Route::get('registered-user', [UserController::class, 'registeredUser']);
        Route::get('user-detail/{slug}', [UserController::class, 'show']);
        Route::get('user-approve/{slug}', [UserController::class, 'approve']);
        Route::get('user-ban/{slug}', [UserController::class, 'delete']);
        Route::delete('user-destroy/{slug}', [UserController::class, 'destroy']);
        Route::get('user-banned', [UserController::class, 'banned']);
        Route::get('user-restore/{slug}', [UserController::class, 'restore']);

        Route::get('/books-rent', [BookRentController::class, 'index']);
        Route::post('/books-rent', [BookRentController::class, 'store']);

        Route::get('/books-return', [BookRentController::class, 'returnBook']);
        Route::post('/books-return', [BookRentController::class, 'pengembalian']);

        Route::get('rentlog', [RentLogController::class, 'rentlog']);
    });
});
