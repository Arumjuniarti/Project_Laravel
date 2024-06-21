<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;

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

Route::group(['prefik'=>'admin', 'middleware'=>['auth'], 'as'=>'admin.'], function(){
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name ('dashboard');
    Route::get('/User', [UserController::class, 'index'])->name('index');
    Route::get('/asset', [UserController::class, 'asset'])->name('asset');
    Route::get('/search', [UserController::class, 'search'])->name('search');
    Route::get('/create', [UserController::class, 'create'])->name('User.create');
    Route::post('/store', [UserController::class, 'store'])->name('User.store');
    Route::get('/edit/{id}', [UserController::class, 'edit'])->name('User.edit');
    Route::get('/detail/{id}', [UserController::class, 'detail'])->name('User.detail');
    Route::put('/update/{id}', [UserController::class, 'update'])->name('User.update');
    Route::delete('/delete/{id}', [UserController::class, 'delete'])->name('User.delete');

    Route::get('/users/deleted', [UserController::class, 'deletedUsers'])->name('users.deleted');
    Route::post('/users/{id}/restore', [UserController::class, 'restore'])->name('users.restore');
    Route::delete('/users/{id}/permanent-delete', [UserController::class, 'permanentDelete'])->name('users.permanentDelete');



});



Route::get('/login', [LoginController::class, 'index'])->name('login');

Route::get('/forgot-password', [LoginController::class, 'forgot_password'])->name('forgot-password');
Route::post('/forgot-password-act', [LoginController::class, 'forgot_password_act'])->name('forgot-password-act');

Route::get('/register.form', [LoginController::class, 'register_form'])->name('register.form');
Route::post('/register.act', [LoginController::class, 'register_act'])->name('register.act');

Route::get('/validasi-forgot-password/{token}', [LoginController::class, 'validasi_forgot_password'])->name('validasi-forgot-password');
Route::get('/validasi-forgot-password-act', [LoginController::class, 'validasi_forgot_password_act'])->name('validasi-forgot-password-act');

Route::post('/login-proses', [LoginController::class, 'login_proses'])->name('login-proses');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

