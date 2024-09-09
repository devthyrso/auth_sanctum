<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;

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

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('auth')->group(function () {
    Route::get('login', function () {
        return view('auth.login');
    })->name('login');
});

Route::prefix('auth')->group(function () {
    Route::get('register', function () {
        return view('auth.register');
    })->name('register');
});


Route::get('/home', function () {
    return view('home');
})->middleware('auth:sanctum');

Route::get('/users/{user}/edit', function (User $user) {
    return view('users.edit', compact('user'));
})->name('users.edit')->middleware('auth:sanctum');

Route::get('password/reset', function () {
    return view('auth.passwords.email');
})->name('password.request');

Route::get('password/reset/{token}', function ($token) {
    return view('auth.passwords.reset', ['token' => $token]);
})->name('password.reset');
