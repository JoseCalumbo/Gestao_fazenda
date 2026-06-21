<?php

namespace App\Http\Controllers;
use App\Models\HistoricoEstoque;
use Illuminate\Http\Request;

class HistoricoEstoqueController extends Controller
{
    /**
     * Retorna o histórico global formatado exatamente para a tabela do Frontend
     */
    public function getHistoricoGlobal($cooperativaId)
    {
        try {
            // Busca o histórico trazendo o relacionamento do insumo (Eager Loading)
            $historico = HistoricoEstoque::with('insumo')
                ->where('cooperativa_id', $cooperativaId)
                ->orderBy('created_at', 'desc')
                ->get();

            // Formata os dados exatamente como as colunas do teu <th> esperam
            $dadosFormatados = $historico->map(function ($item) {
                return [
                    'id'             => $item->id,
                    'data'           => $item->created_at->format('d/m/Y H:i'),
                    'insumo_nome'    => $item->insumo ? $item->insumo->nome : 'Insumo Removido',
                    'tipo_movimento' => $item->tipo_movimento,
                    'quantidade'     => (float) $item->quantidade,
                    'stock_anterior' => (float) $item->stock_anterior,
                    'stock_atual'    => (float) $item->stock_atual,
                    'utilizador'     => $item->utilizador ?? 'Sistema',
                ];
            });

            return response()->json([
                'success' => true,
                'data'    => $dadosFormatados
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao carregar histórico: ' . $e->getMessage()
            ], 500);
        }
    }
}