<?php

use App\Http\Controllers\AgricultoresController;
use App\Http\Controllers\AnoAgricolaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ConfiguracaoController;
use App\Http\Controllers\CooperativaController;
use App\Http\Controllers\CooperativaMembroController;
use App\Http\Controllers\HistoricoEstoqueController;
use App\Http\Controllers\InsumosController;
use App\Http\Controllers\MovimentoInsumoController;
use App\Http\Controllers\SafraController;
use App\Http\Controllers\TalhoesController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VendaController;
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
    Route::get('/agricultores/{id}/historico-json', [AgricultoresController::class, 'getHistoricoJson']);

    // associar o agricltoresa uma coooerativa
    Route::prefix('cooperativas/{cooperativaId}/membros')->group(function () {
        Route::get('/json', [CooperativaMembroController::class, 'indexJson']);
        Route::post('/associar', [CooperativaMembroController::class, 'store']);
        Route::post('/{id}/alternar-estado', [CooperativaMembroController::class, 'toggleStatus']);
        Route::delete('/{id}/remover', [CooperativaMembroController::class, 'destroy']);
    });

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
    Route::get('/cooperativa/{cooperativa}/agricultor/{agricultor}/historico', [InsumosController::class, 'historicoPorAgricultor']);

    // Talhões
    Route::get('/talhoes', [TalhoesController::class, 'index'])->name('talhoes.index'); //painel geral
    Route::get('api/cooperativas/{cooperativa}/talhoes',[TalhoesController::class, 'apiIndex']);//pega os dados json
    Route::post('/talhoes', [TalhoesController::class, 'store'])->name('talhoes.store');
    Route::get('/talhoes/{id}', [TalhoesController::class, 'show'])->name('talhoes.show');
    Route::put('/talhoes/{id}', [TalhoesController::class, 'update'])->name('talhoes.update');
    Route::delete('/talhoes/{id}', [TalhoesController::class, 'destroy'])->name('talhoes.destroy');

    // safras
    Route::prefix('cooperativas/{cooperativa}')
        ->group(function () {

            Route::get('/safras', [SafraController::class, 'index'])->name('safras.index');
            Route::get('/safras', [SafraController::class, 'index'])->name('safras.index');
            Route::post('/safras', [SafraController::class, 'store'])->name('safras.store');
            Route::put('/safras/{safra}', [SafraController::class, 'update'])->name('safras.update');
            Route::delete('/safras/{safra}', [SafraController::class, 'destroy'])->name('safras.destroy');
        });
    // safra geral
    Route::get('/safras', [SafraController::class, 'painel'])
        ->name('safras.painel');

    // Rota para o painel administrativo ver o histórico global de todas as cooperativas
    // Route::get('/admin/estoque/historico-global', [HistoricoEstoqueController::class, 'exibirHistoricoAdmin'])->name('admin.historico.global');

    Route::get('/api/cooperativa/agricultores', [CooperativaMembroController::class, 'index']);

    Route::prefix('cooperativas/{cooperativa}')
        ->group(function () {

            Route::get('/vendas', [VendaController::class, 'index'])
                ->name('vendas.index');

            Route::post('/vendas', [VendaController::class, 'store'])
                ->name('vendas.store');

            Route::put('/vendas/{venda}', [VendaController::class, 'update'])
                ->name('vendas.update');

            Route::delete('/vendas/{venda}', [VendaController::class, 'destroy'])
                ->name('vendas.destroy');
        });
    });
