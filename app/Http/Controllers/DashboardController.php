<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agricultor;
use App\Models\Cooperativa;
use App\Models\Venda;
use App\Models\Insumo; // se precisar

class DashboardController extends Controller
{
    public function index()
    {
        // Total de receita (soma de todas as vendas)
        $totalReceita = Venda::sum('valor_total') ?? 0;

        // Agricultores ativos (estado = 'ativo')
       // $agricultoresAtivos = Agricultor::where('estado', 'ativo')->count();
        $agricultoresAtivos = 22;

        // Produção estimada total (soma da produção_estimada de todas as cooperativas)
        $producaoTotal = Cooperativa::sum('producao_estimada') ?? 0;

        // Pagamentos em atraso (vendas com status = 'Atraso')
        $pagamentosAtraso = Venda::where('status', 'Atraso')->count();

        // (Opcional) Calcular variação percentual – exemplo fictício
        // Você pode implementar uma lógica comparando com o mês anterior

        return view('dashboard.dashboard', compact(
            'totalReceita',
            'agricultoresAtivos',
            'producaoTotal',
            'pagamentosAtraso'
        ));
    }
}
