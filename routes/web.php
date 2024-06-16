<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\FilePondController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\SecurityController;
use Illuminate\Support\Facades\Route;

Route::middleware(['guest'])->group(function () {
    Route::get('/', function () {
        return redirect()->route('home.index');
    });
    Route::get('/login', [AuthController::class, 'login'])->name('auth.login');
    Route::post('/login', [AuthController::class, 'authenticate'])->name('auth.login.authenticate');
    Route::get('/register', [AuthController::class, 'register'])->name('auth.register');
    Route::post('/register', [AuthController::class, 'store'])->name('auth.register.store');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home.index');
    Route::resource('/chats', ChatController::class)->names('chats');
    Route::patch('/chats/{chat}/close', [ChatController::class, 'close'])->name('chats.close');
    Route::post('/messages/store/{chat}', [MessageController::class, 'store'])->name('messages.store');
    Route::resource('/articles', ArticleController::class)->names('articles');
    Route::resource('/complaints', ComplaintController::class)->names('complaints');
    Route::post('/complaints/{complaint}/process', [ComplaintController::class, 'process'])->name('complaints.process');
    Route::post('/complaints/{complaint}/cancel', [ComplaintController::class, 'cancel'])->name('complaints.cancel');
    Route::post('/complaints/{complaint}/resolve', [ComplaintController::class, 'resolve'])->name('complaints.resolve');
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/profile/avatar', [ProfileController::class, 'avatar_update'])->name('profile.avatar.update');
    Route::get('/security', [SecurityController::class, 'index'])->name('security.index');
    Route::patch('/security/change-password', [SecurityController::class, 'change_password'])->name('security.change_password');
    Route::get('/filepond/load/file', [FilePondController::class, 'load_file'])->name('filepond.load.file');
    Route::get('/filepond/load/files', [FilePondController::class, 'load_files'])->name('filepond.load.files');
    Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');
});
