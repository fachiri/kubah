<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('auth.login');
});
Route::get('/login', [AuthController::class, 'login'])->name('auth.login');
Route::get('/register', [AuthController::class, 'register'])->name('auth.register');
Route::get('/home', [HomeController::class, 'index'])->name('home.index');
Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');
Route::get('/report', [ReportController::class, 'index'])->name('report.index');
Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
