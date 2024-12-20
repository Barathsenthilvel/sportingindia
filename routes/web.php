<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AdminMiddleware;

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/login', function () {
    return view('auth.login');
})->name('user.login');

Route::get('/unauthorized', function () {
    return view('errors.403');
})->name('unauthorized');



Route::get('/register', function () {
    return view('auth.register');
})->name('user.register');;

Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
Route::post('/login', [LoginController::class, 'login'])->name('login.store');

Route::post('/logout',[LoginController::class, 'logout'])->name('logout');


Route::middleware([AdminMiddleware::class])->group(function () {
    Route::get('/dashboard', [UserController::class, 'index'])->name('user.dashboard');
    Route::get('/pending-applications', [UserController::class, 'getPendingApplications'])->name('pending.applications');
    Route::post('/approved-applications', [UserController::class, 'getApprovedApplications'])->name('approve.application');
    Route::get('/approved-applications', [UserController::class, 'getApprovedApplications'])->name('approved.applications');
    Route::get('/rejected-applications', [UserController::class, 'getRejectedApplications'])->name('rejected.applications');
});

Route::get('/profile', [UserController::class, 'show'])->name('user.profile');


