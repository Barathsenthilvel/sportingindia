<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\AuthenticatedUser;

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/login', function () {
    return view('auth.login');
})->name('user.login');


Route::get('/register', function () {
    return view('auth.register');
})->name('user.register');

Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
Route::post('/login', [LoginController::class, 'login'])->name('login.store');

Route::post('/logout',[LoginController::class, 'logout'])->name('logout');


Route::middleware([AuthenticatedUser::class])->group(function () {
    Route::get('/profile', [UserController::class, 'profilepage'])->name('user.profile');
    Route::get('/unauthorized', function () {
        return view('errors.403');
    })->name('unauthorized');
});

Route::middleware([AdminMiddleware::class])->group(function () {
    Route::get('/dashboard', [UserController::class, 'index'])->name('user.dashboard');
    Route::get('/pending-applications', [UserController::class, 'getPendingApplications'])->name('pending.applications');
    Route::get('/approved-applications', [UserController::class, 'getApprovedApplications'])->name('approved.applications');
    Route::get('/rejected-applications', [UserController::class, 'getRejectedApplications'])->name('rejected.applications');
    Route::post('/approveapplication', [UserController::class, 'approveApplication'])->name('approve.application');
    Route::post('/rejectapplication', [UserController::class, 'rejectApplication'])->name('reject.application');
});




