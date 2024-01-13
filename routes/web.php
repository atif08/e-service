<?php

use App\Admin\Controllers\CertifiedUserController;
use App\Admin\Controllers\DashboardController;
use App\Admin\Controllers\PriceController;
use App\Admin\Controllers\UsersController;
use App\Frontend\Controllers\CreateCertifiedUserController;
use App\Frontend\Controllers\StoreCertifiedUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
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

// Auth

Route::get('login', [AuthenticatedSessionController::class, 'create'])
    ->name('login')
    ->middleware('guest');

Route::post('login', [AuthenticatedSessionController::class, 'store'])
    ->name('login.store')
    ->middleware('guest');

Route::delete('logout', [AuthenticatedSessionController::class, 'destroy'])
    ->name('logout');

// Certified User

Route::get('/', CreateCertifiedUserController::class)->name('certified-user');
Route::post('/certified-user', StoreCertifiedUserController::class)->name('certified-user.store');

// Admin certified-users

Route::resource('certified-users', CertifiedUserController::class)->middleware('auth');
Route::put('certified-users/{certified_user}/restore', [CertifiedUserController::class, 'restore'])
    ->name('certified-users.restore')
    ->middleware('auth');

//Dashboard

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard')
    ->middleware('auth');

// Prices
Route::resource('prices', PriceController::class);

// Users

Route::resource('users', UsersController::class)
    ->middleware('auth');

Route::put('users/{user}/restore', [UsersController::class, 'restore'])
    ->name('users.restore')
    ->middleware('auth');
