<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;
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

Route::get('paerntt', function () {
    return view('cms.paernt');
});

Route::prefix('/cms/borrow_book_login/')->middleware('guest:web')->group(function () {
    Route::get('{guard}/showlogin', [AuthController::class, 'showlogin'])->name('show.login');
    Route::post('{guard}/login', [AuthController::class, 'login'])->name('user.login');
});
// Route::prefix('cms/borrow_book')->middleware('auth:web')->group(function () {

// });


// Route::prefix('/cms/borrow_book/')->group(function () {
Route::prefix('/cms/borrow_book/')->middleware('auth:web')->group(function () {
    Route::get('logout', [AuthController::class, 'logout'])->name('view.logout');
    Route::get('users_create_view/', [UserController::class, 'create_view'])->name('ss');
    Route::resource('users', UserController::class);

    Route::resource('students', StudentController::class);
    Route::post('students_update/{id}', [StudentController::class, 'update']);

    Route::resource('employees', EmployeeController::class);
    // Route::get('employees_create_view/', [EmployeeController::class, 'create_view'])->name('ll');
    // Route::post('store_users/', [EmployeeController::class, 'store_view'])->name('sto');
    Route::post('employees_update/{id}', [EmployeeController::class, 'update']);

    Route::resource('doctors', DoctorController::class);
    Route::post('doctors_update/{id}', [DoctorController::class, 'update']);

    Route::resource('books', BookController::class);
    Route::post('books_update/{id}', [BookController::class, 'update']);
    Route::post('/stor_user/{usertype}/', [UserController::class, 'store']);

    // Route::get('{guard}/resevebooks/{id}', [BookController::class, 'reseve'])->name('reseve.book');
});
Route::get('borrowbooks', [BookController::class, 'availableBooks'])->name('available.book');
Route::delete('borrowbooks_delete/{id}', [BookController::class, 'destroys'])->name('destroys.book');
Route::get('create_reseve_book', [BookController::class, 'create_reseve_books'])->name('create_reseve_books.book');
Route::post('/reseve_book', [BookController::class, 'reseve_books'])->name('borrow.book');
Route::get('restore_reseve_book/{id}', [BookController::class, 'restoreBook'])->name('restore_reseve_book.book');
