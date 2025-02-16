<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;



/*
|----------------------------------------------------------------------
| Web Routes
|----------------------------------------------------------------------
*/

Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.process');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Route untuk admin
Route::get('/admin/create', [AdminController::class, 'create'])->name('admin.create'); // Untuk menampilkan form
Route::post('/admin/store', [AdminController::class, 'store'])->name('admin.store'); // Untuk menyimpan data admin
Route::get('/admin/edit/{id}', [AdminController::class, 'edit'])->name('admin.edit'); // Untuk menampilkan form edit
Route::put('/admin/siswa/{id}', [AdminController::class, 'update'])->name('admin.update');
Route::delete('/admin/delete/{id}', [AdminController::class, 'destroy'])->name('admin.delete');

Route::get('/admin/siswa/{id}', [AdminController::class, 'show'])->name('admin.show');

// Route untuk search data
Route::get('search', [AdminController::class, 'search'])->name('admin.search');

Route::get('/admin/dashboard', [AdminController::class, 'index']) // Route dashboard untuk admin
    ->name('admin.dashboard')
    ->middleware(['auth', 'role:admin']);  // Menggunakan middleware dengan role admin


// Route dashboard untuk user
Route::get('/user/dashboard', [UserController::class, 'index'])
    ->name('user.dashboard')
    ->middleware(['auth', 'role:user']);  // Menggunakan middleware dengan role user

    //view
Route::get('/user/search', [UserController::class, 'search'])->name('user.search');
Route::get('/user/{id}', [UserController::class, 'show'])->name('user.show');



    // umbul umbul
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update'); // Untuk mengupdate profil
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    