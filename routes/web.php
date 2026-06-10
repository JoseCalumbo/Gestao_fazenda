<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ConfiguracaoController;
use App\Http\Controllers\CooperativaController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/login', [AuthController::class, 'index'])->name('login');

Route::post('/login', [AuthController::class, 'login']);

Route::get('/dashboard', [AuthController::class, 'dashboard'])->middleware('auth');

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::get('/configuracoes', [ConfiguracaoController::class, 'index'])
        ->name('configuracoes');

    // Route::post('/configuracoes/utilizadores', [ConfiguracaoController::class, 'store'])
    //     ->name('configuracoes.utilizadores.store');

});

Route::middleware('auth')->group(function () {

    Route::post('/users', [UserController::class, 'store'])
        ->name('users.store');

    Route::get('/users/{id}', [UserController::class, 'show'])
        ->name('users.show');

    Route::get('/users', [UserController::class, 'index'])
        ->name('users.index');

    Route::delete('/users/{id}', [UserController::class, 'destroy'])
        ->name('users.destroy');

    Route::put('/users/{id}', [UserController::class, 'update'])
        ->name('users.update');

});

Route::middleware(['auth'])->group(function () {

    Route::get('/cooperativas', [CooperativaController::class, 'index'])
        ->name('cooperativas');

    // Rota para carregar a página principal (Listagem e Modais)
    Route::get('/cooperativas', [CooperativaController::class, 'index'])->name('cooperativas');

    // Rotas específicas para manipulação de dados via AJAX (retornam JSON)
    Route::post('/cooperativas/store', [CooperativaController::class, 'store'])->name('cooperativas.store');
    Route::get('/cooperativas/{id}/edit', [CooperativaController::class, 'edit'])->name('cooperativas.edit');
    Route::put('/cooperativas/{id}/update', [CooperativaController::class, 'update'])->name('cooperativas.update');
    Route::delete('/cooperativas/{id}/destroy', [CooperativaController::class, 'destroy'])->name('cooperativas.destroy');
});
