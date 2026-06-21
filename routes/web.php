<?php

use App\Http\Controllers\AgricultoresController;
use App\Http\Controllers\AnoAgricolaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ConfiguracaoController;
use App\Http\Controllers\CooperativaController;
use App\Http\Controllers\InsumosController;
use App\Http\Controllers\MovimentoInsumoController;
use App\Http\Controllers\TalhoesController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Rotas Públicas (Sem Login)
Route::get('/', function () {
    return redirect('/login');
});

Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/api/auth-user', [AuthController::class, 'getAuthUser']);

// Rotas Protegidas (Exigem Login)
Route::middleware('auth')->group(function () {

    // Auth & Dashboard
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Configurações
    Route::get('/configuracoes', [ConfiguracaoController::class, 'index'])->name('configuracoes');

    // Usuários
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

    // Ano Agrícola
    Route::get('/ano_agricola', [AnoAgricolaController::class, 'index'])->name('ano.index');
    Route::post('/ano_agricola', [AnoAgricolaController::class, 'store'])->name('ano.store');
    Route::get('/ano_agricola/{id}', [AnoAgricolaController::class, 'show'])->name('ano.show');
    Route::put('/ano_agricola/{id}', [AnoAgricolaController::class, 'update'])->name('ano.update');
    Route::delete('/ano_agricola/{id}', [AnoAgricolaController::class, 'destroy'])->name('ano.destroy');

    // Agricultores
    Route::get('/agricultores', [AgricultoresController::class, 'index'])->name('agricultores.index');
    Route::post('/agricultores', [AgricultoresController::class, 'store'])->name('agricultores.store');
    Route::get('/agricultores/{id}', [AgricultoresController::class, 'show'])->name('agricultores.show');
    Route::put('/agricultores/{id}', [AgricultoresController::class, 'update'])->name('agricultores.update');
    Route::delete('/agricultores/{id}', [AgricultoresController::class, 'destroy'])->name('agricultores.destroy');

    // Cooperativas (Web tradicionais e exportação)
    Route::get('/cooperativas/exportar-pdf', [CooperativaController::class, 'exportarPdf'])->name('cooperativas.pdf');
    Route::get('/cooperativas', [CooperativaController::class, 'index'])->name('cooperativas');
    Route::post('/cooperativas', [CooperativaController::class, 'store'])->name('cooperativas.store');
    Route::get('/cooperativas/{id}', [CooperativaController::class, 'show'])->name('cooperativas.show');
    Route::put('/cooperativas/{id}', [CooperativaController::class, 'update'])->name('cooperativas.update');
    Route::delete('/cooperativas/{id}', [CooperativaController::class, 'destroy'])->name('cooperativas.destroy');

    // Cooperativas (Rotas AJAX / Alternativas - Nomes alterados para evitar conflito)
    Route::post('/cooperativas/store', [CooperativaController::class, 'store'])->name('cooperativas.ajax.store');
    Route::get('/cooperativas/{id}/edit', [CooperativaController::class, 'edit'])->name('cooperativas.ajax.edit');
    Route::put('/cooperativas/{id}/update', [CooperativaController::class, 'update'])->name('cooperativas.ajax.update');
    Route::delete('/cooperativas/{id}/destroy', [CooperativaController::class, 'destroy'])->name('cooperativas.ajax.destroy');

    // Cooperativas (Listagens adicionais agora protegidas por login)
    Route::prefix('cooperativas')->name('cooperativas.')->group(function () {
        Route::get('/list', [CooperativaController::class, 'list'])->name('list');
        Route::get('/select-options', [CooperativaController::class, 'selectOptions'])->name('select-options');
    });

    // Insumos estoque entrada
    Route::get('/cooperativas/{id}/estoque', [InsumosController::class, 'estoqueCooperativa'])->name('cooperativas.insumos.index');
    Route::post('/estoque/insumos/store', [InsumosController::class, 'store'])->name('estoque.insumos.store'); // via ajax
    Route::delete('/estoque/insumos/{id}', [InsumosController::class, 'destroy'])->name('estoque.insumos.destroy'); // via ajax
    Route::put('/estoque/insumos/{id}', [InsumosController::class, 'update'])->name('estoque.insumos.update'); // via ajax
    Route::get('/insumos/{id}', [InsumosController::class, 'show'])->name('insumos.show');

    Route::prefix('cooperativas/{id}/estoque')->group(function () {
        Route::post('/entrada', [InsumosController::class, 'registrarEntrada']);
        Route::post('/saida', [InsumosController::class, 'registrarSaida']);
    });

    // Movimento saida
    Route::resource('movimento-insumos', MovimentoInsumoController::class);
    Route::get('/cooperativa/{cooperativa}/agricultores', [MovimentoInsumoController::class, 'getAgricultores']);
    Route::get('/cooperativa/{cooperativa}/movimentos/saidas', [MovimentoInsumoController::class, 'getSaidas']);
    Route::get('/cooperativa/{cooperativa}/estoque', [MovimentoInsumoController::class, 'index'])->name('movimento-insumos.index');
    Route::delete('/cooperativa/{cooperativa}/movimentos/saidas/{id}', [MovimentoInsumoController::class, 'destroySaida']);
    Route::post('/cooperativa/{cooperativa}/movimentos/saidas/{insumo_id}', [MovimentoInsumoController::class, 'movimentarEstoque']);
    Route::put('/cooperativa/{cooperativa}/movimentos/saidas/{id}', [MovimentoInsumoController::class, 'updateSaida']);

    // Rota para buscar o histórico global de estoque da cooperativa
    Route::get('/cooperativa/{cooperativa}/estoque/historico', [HistoricoEstoqueController::class, 'getHistoricoGlobal']);

    // Insumos
    Route::get('/insumos', [InsumosController::class, 'index'])->name('insumos.index');
    Route::post('/insumos', [InsumosController::class, 'storeGeral'])->name('insumos.store');
    Route::get('/insumos/{id}', [InsumosController::class, 'show'])->name('insumos.show');
    Route::put('/insumos/{id}', [InsumosController::class, 'updateGeral'])->name('insumos.update');
    Route::delete('/insumos/{id}', [InsumosController::class, 'destroyGeral'])->name('insumos.destroy');

    // Talhões
    Route::get('/talhoes', [TalhoesController::class, 'index'])->name('talhoes.index');
    Route::post('/talhoes', [TalhoesController::class, 'store'])->name('talhoes.store');
    Route::get('/talhoes/{id}', [TalhoesController::class, 'show'])->name('talhoes.show');
    Route::put('/talhoes/{id}', [TalhoesController::class, 'update'])->name('talhoes.update');
    Route::delete('/talhoes/{id}', [TalhoesController::class, 'destroy'])->name('talhoes.destroy');

});
