<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Models\Venda;
use App\Models\VendaItem;
use App\Models\Cooperativa;
use App\Models\Agricultor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class VendaController extends Controller
{
   
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cooperativaId = session('cooperativa_id') ?? 1; // ou pegar da cooperativa logada
        $cooperativa = Cooperativa::find($cooperativaId);
        
        $produtos = Produto::where('cooperativa_id', $cooperativaId)
            ->where('estado', 'ativo')
            ->paginate(10);
            
        $vendas = Venda::where('cooperativa_id', $cooperativaId)
            ->with('itens')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('vendas.index5', compact('produtos', 'vendas', 'cooperativa'));
    }

    /**
     * Get products by cooperative (JSON)
     */
    // public function getProdutos($cooperativaId)
    // {
    //     $produtos = Produto::where('cooperativa_id', $cooperativaId)
    //         ->where('estado', 'disponivel')
    //         ->where('quantidade', '>', 0)
    //         ->select('id', 'nome', 'categoria', 'quantidade', 'unidade', 'preco_venda')
    //         ->get();

    //     return response()->json($produtos);
    // }

    public function getProdutos()
{
    $produtos = Produto::select(
        'id',
        'nome',
        'categoria',
        'quantidade',
        'unidade',
        'preco_venda'
    )->get();

    return response()->json($produtos);
}

    /**
     * Store a newly created sale.
     */
    public function storeVenda(Request $request)
    {
        $request->validate([
            'cooperativa_id' => 'required|exists:cooperativas,id',
            'cliente' => 'required|string|max:255',
            'forma_pagamento' => 'required|in:dinheiro,transferencia,credito,cheque',
            'status' => 'required|in:pago,pendente',
            'valor_entregue' => 'nullable|numeric|min:0',
            'itens' => 'required|array|min:1',
            'itens.*.produto_id' => 'required|exists:produtos,id',
            'itens.*.quantidade' => 'required|numeric|min:0.01',
            'itens.*.preco_unitario' => 'required|numeric|min:0',
        ]);

        try {
            DB::beginTransaction();

            $total = 0;
            $itensData = [];

            foreach ($request->itens as $item) {
                $subtotal = $item['quantidade'] * $item['preco_unitario'];
                $total += $subtotal;

                $itensData[] = [
                    'produto_id' => $item['produto_id'],
                    'quantidade' => $item['quantidade'],
                    'preco_unitario' => $item['preco_unitario'],
                    'subtotal' => $subtotal,
                ];

                // Atualizar stock do produto
                $produto = Produto::find($item['produto_id']);
                $produto->quantidade -= $item['quantidade'];
                $produto->save();
            }

            // Criar venda
            $venda = Venda::create([
                'cooperativa_id' => $request->cooperativa_id,
                'agricultor_id' => $request->agricultor_id ?? null,
                'data_venda' => now(),
                'cliente' => $request->cliente,
                'valor_total' => $total,
                'forma_pagamento' => $request->forma_pagamento,
                'observacoes' => $request->observacoes ?? null,
                'status' => $request->status,
                'valor_entregue' => $request->valor_entregue ?? 0,
                'troco' => $request->valor_entregue ? ($request->valor_entregue - $total) : 0,
            ]);

            // Criar itens da venda
            foreach ($itensData as $item) {
                $venda->itens()->create($item);
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Venda realizada com sucesso!',
                'venda' => $venda->load('itens'),
                'venda_id' => $venda->id,
                'numero' => str_pad($venda->id, 6, '0', STR_PAD_LEFT),
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Erro ao realizar venda: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Get sale details for viewing/printing
     */
    public function getVenda($id)
    {
        $venda = Venda::with('itens.produto')->findOrFail($id);
        return response()->json($venda);
    }























    // public function index(Request $request)
    // {
    //     // Buscar produtos disponíveis (com stock > 0)
    //     $produtosQuery = Produto::where('quantidade', '>', 0)
    //         ->where('estado', 'disponivel')
    //         ->orderBy('nome');

    //     // Filtro por categoria
    //     if ($request->has('categoria') && $request->categoria) {
    //         $produtosQuery->where('categoria', $request->categoria);
    //     }

    //     // Filtro por pesquisa
    //     if ($request->has('search') && $request->search) {
    //         $produtosQuery->where('nome', 'LIKE', '%'.$request->search.'%');
    //     }

    //     $produtos = $produtosQuery->paginate(10);

    //     // Buscar vendas com paginação
    //     $vendasQuery = Venda::with(['cooperativa', 'agricultor', 'itens'])
    //         ->orderBy('created_at', 'desc');

    //     // Filtro por status
    //     if ($request->has('status') && $request->status) {
    //         $vendasQuery->where('status', $request->status);
    //     }

    //     // Filtro por pesquisa (cliente)
    //     if ($request->has('search_venda') && $request->search_venda) {
    //         $vendasQuery->where('cliente', 'LIKE', '%'.$request->search_venda.'%');
    //     }

    //     $vendas = $vendasQuery->paginate(10);

    //     // Estatísticas
    //     $totalVendas = Venda::count();
    //     $vendasPagas = Venda::where('estado', 'pago')->count();
    //     $vendasPendentes = Venda::where('estado', 'pendente')->count();
    //     $totalFaturado = Venda::where('estado', 'pago')->sum('valor_total');

    //     // Cooperativas para filtros (opcional)
    //     $cooperativas = Cooperativa::where('estado', 'activa')->get();

    //     // Agricultores para filtros (opcional)
    //     $agricultores = Agricultor::where('estado', 'activo')->get();

    //     return view('vendas.index4', compact(
    //         'produtos',
    //         'vendas',
    //         'totalVendas',
    //         'vendasPagas',
    //         'vendasPendentes',
    //         'totalFaturado',
    //         'cooperativas',
    //         'agricultores'
    //     ));
    // }



    // /**
    //  * Show the form for creating a new resource.
    //  */
    // public function create()
    // {
    //     //
    // }

    // /**
    //  * Store a newly created resource in storage.
    //  */
    // public function store(Request $request)
    // {
    //     //
    // }

    // /**
    //  * Display the specified resource.
    //  */
    // public function show(Venda $venda)
    // {
    //     //
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  */
    // public function edit(Venda $venda)
    // {
    //     //
    // }

    // /**
    //  * Update the specified resource in storage.
    //  */
    // public function update(Request $request, Venda $venda)
    // {
    //     //
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  */
    // public function destroy(Venda $venda)
    // {
    //     //
    // }
}
