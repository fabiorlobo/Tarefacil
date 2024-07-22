<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\ListaController;
use App\Http\Controllers\TarefaController;
use App\Http\Controllers\ProjetoController;

// Rota para a home
Route::get('/', function () {
	return view('home');
})->name('home');
;

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

// Listas
Route::get('/painel/listas', [ListaController::class, 'index'])->name('listas.index');
Route::get('/painel/listas/criar', [ListaController::class, 'create'])->name('listas.create');
Route::post('/painel/listas', [ListaController::class, 'store'])->name('listas.store');
Route::get('/painel/listas/{id}', [ListaController::class, 'show'])->name('listas.show');
Route::get('/painel/listas/{id}/editar', [ListaController::class, 'edit'])->name('listas.edit');
Route::put('/painel/listas/{id}', [ListaController::class, 'update'])->name('listas.update');
Route::delete('/painel/listas/{id}', [ListaController::class, 'destroy'])->name('listas.destroy');

// Tarefas
Route::get('/painel/tarefas/criar', [TarefaController::class, 'create'])->name('tarefas.create');
Route::get('/painel/tarefas/criar/{lista?}', [TarefaController::class, 'create'])->name('tarefas.create');
Route::post('/painel/tarefas', [TarefaController::class, 'store'])->name('tarefas.store');
Route::get('/painel/tarefas/{id}/editar', [TarefaController::class, 'edit'])->name('tarefas.edit');
Route::put('/painel/tarefas/{id}', [TarefaController::class, 'update'])->name('tarefas.update');
Route::delete('/painel/tarefas/{id}', [TarefaController::class, 'destroy'])->name('tarefas.destroy');
Route::post('/painel/tarefas/{id}/start', [TarefaController::class, 'startTracker'])->name('tarefas.start');
Route::post('/painel/tarefas/{id}/stop', [TarefaController::class, 'stopTracker'])->name('tarefas.stop');
Route::get('/painel/tarefas/{id}/check-status', [TarefaController::class, 'checkStatus']);

// Projetos
Route::prefix('painel')->middleware('auth')->group(function () {
	Route::get('projetos/criar', [ProjetoController::class, 'create'])->name('projetos.create');
	Route::post('projetos', [ProjetoController::class, 'store'])->name('projetos.store');
	Route::get('projetos/{id}', [ProjetoController::class, 'show'])->name('projetos.show');
	Route::get('projetos/{id}/editar', [ProjetoController::class, 'edit'])->name('projetos.edit');
	Route::put('projetos/{id}', [ProjetoController::class, 'update'])->name('projetos.update');
	Route::delete('projetos/{id}', [ProjetoController::class, 'destroy'])->name('projetos.destroy');
	Route::get('projetos', [ProjetoController::class, 'index'])->name('projetos.index');
});

// Rotas dinâmicas para páginas estáticas
Route::get('/{page}', [PageController::class, 'show'])->where('page', '^(?!posts).*');