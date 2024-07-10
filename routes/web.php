<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\AccountController;

// Rota para a home
Route::get('/', function () {
	return view('home');
})->name('home');;

// Rotas para posts (páginas dinâmicas)
Route::get('/posts', [PostController::class, 'index']);
Route::get('/posts/{id}', [PostController::class, 'show']);

// Login
Route::get('entrar', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('entrar', [LoginController::class, 'login']);
Route::get('cadastro', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('cadastro', [RegisterController::class, 'register']);
Route::post('logout', [LogoutController::class, 'logout'])->name('logout');

Route::get('auth/google', [GoogleController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

// Painel
Route::get('/painel', function () {
	return view('painel');
})->middleware('auth')->name('painel');

// Conta do usuário
Route::get('painel/conta', [AccountController::class, 'show'])->name('account.show')->middleware('auth');
Route::post('painel/conta', [AccountController::class, 'update'])->name('account.update')->middleware('auth');
Route::post('painel/conta/excluir', [AccountController::class, 'destroy'])->name('account.destroy')->middleware('auth');

// Rotas dinâmicas para páginas estáticas
Route::get('/{page}', [PageController::class, 'show'])->where('page', '^(?!posts).*');