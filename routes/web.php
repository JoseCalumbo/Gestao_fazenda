<?php

use App\Http\Controllers\AnoAgricolaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ConfiguracaoController;
use App\Http\Controllers\CooperativaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AgricultoresController;
use App\Http\Controllers\InsumosController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/login', [AuthController::class, 'index'])->name('login');

Route::post('/login', [AuthController::class, 'login']);

Route::get('/dashboard', [AuthController::class, 'dashboard'])->middleware('auth')->name('dashboard');;

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');

// Rota para obter os dados logados
Route::get('/api/auth-user', [AuthController::class, 'getAuthUser']);

Route::middleware('auth')->group(function () {
    Route::get('/configuracoes', [ConfiguracaoController::class, 'index'])
        ->name('configuracoes');

});

// user
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

// Ano Agricola
Route::middleware('auth')->group(function () {

    Route::get( '/ano_agricola',  [AnoAgricolaController::class, 'index'])->name('ano.index');

    Route::post( '/ano_agricola',   [AnoAgricolaController::class, 'store']  )->name('ano.store');

    Route::get(  '/ano_agricola/{id}', [AnoAgricolaController::class, 'show'] )->name('ano.show');

    Route::put( '/ano_agricola/{id}', [AnoAgricolaController::class, 'update'] )->name('ano.update');

    Route::delete(  '/ano_agricola/{id}',  [AnoAgricolaController::class, 'destroy'] )->name('ano.destroy');
});


// Agricultores
Route::middleware('auth')->group(function () {

    Route::get('/agricultores',[AgricultoresController::class,'index'])->name('agricultores.index');

    Route::post('/agricultores',[AgricultoresController::class,'store'])->name('agricultores.store');

    Route::get('/agricultores/{id}',[AgricultoresController::class,'show'])->name('agricultores.show');

    Route::put('/agricultores/{id}',[AgricultoresController::class,'update'])->name('agricultores.update');

    Route::delete('/agricultores/{id}',[AgricultoresController::class,'destroy'])->name('agricultores.destroy');
});

// Insumos
Route::middleware('auth')->group(function () {

    Route::get('/insumos', [InsumosController::class, 'index'])
        ->name('insumos.index');

    Route::post('/insumos', [InsumosController::class, 'store'])
        ->name('insumos.store');

    Route::get('/insumos/{id}', [InsumosController::class, 'show'])
        ->name('insumos.show');

    Route::put('/insumos/{id}', [InsumosController::class, 'update'])
        ->name('insumos.update');

    Route::delete('/insumos/{id}', [InsumosController::class, 'destroy'])
        ->name('insumos.destroy');
});

// cooperativa
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
