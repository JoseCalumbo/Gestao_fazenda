<?php

namespace App\Http\Controllers;

use App\Models\Cooperativa;
use App\Models\Produto;
use App\Models\Venda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VendaController extends Controller
{
    public function indexPainel($cooperativaId)
    {
        // $cooperativa = Cooperativa::with('user')->findOrFail($cooperativaId);

        $cooperativa = Cooperativa::findOrFail($cooperativaId);

        // Buscar produtos da cooperativa
        $produtos = Produto::where('cooperativa_id', $cooperativaId)
            ->where('estado', 'disponivel')
            ->where('quantidade', '>', 0)
            ->get();

        // Buscar vendas da cooperativa
        $vendas = Venda::where('cooperativa_id', $cooperativaId)
            ->with('itens.produto')
            ->orderBy('created_at', 'desc')
            ->limit(50)
            ->get();

        return view('vendas.index', compact('produtos', 'vendas', 'cooperativa'));
    }

    /**
     * Get products by cooperative (JSON)
     */
    public function getProdutos($cooperativaId)
    {
        $produtos = Produto::where('cooperativa_id', $cooperativaId)
            ->where('estado', 'disponivel')
            ->where('quantidade', '>', 0)
            ->select('id', 'nome', 'categoria', 'quantidade', 'unidade', 'preco_venda', 'agricultor_id')
            ->get();

        return response()->json($produtos);
    }


    // Salva venda
    public function storeVenda(Request $request)
    {
        $request->validate([
            'cooperativa_id' => 'required|exists:cooperativas,id',
            'cliente' => 'required|string|max:255',
            'forma_pagamento' => 'required|in:dinheiro,transferencia,credito,cheque',
            // 'status' => 'required|in:pago,pendente',
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
            $produtosAtualizados = [];

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
                $novaQuantidade = $produto->quantidade - $item['quantidade'];
                $produto->quantidade = max(0, $novaQuantidade); // Não permite negativo

                // Se quantidade for 0 ou menos, muda estado para 'esgotado'
                if ($produto->quantidade <= 0) {
                    $produto->estado = 'esgotado';
                } elseif ($produto->estado == 'esgotado' && $produto->quantidade > 0) {
                    // Se estava esgotado e ganhou novo stock, volta para ativo
                    $produto->estado = 'disponivel';
                }

                $produto->save();
                $produtosAtualizados[] = $produto;
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
                'venda' => $venda->load('itens.produto'),
                'venda_id' => $venda->id,
                'numero' => str_pad($venda->id, 6, '0', STR_PAD_LEFT),
                'produtos_atualizados' => $produtosAtualizados,
            ]);

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Erro ao realizar venda: '.$e->getMessage(),
            ], 500);
        }
    }


    /**
     * Get sales for a cooperative with pagination and filters
     */
    public function getVendas(Request $request, $cooperativaId)
    {
        try {
            $query = Venda::where('cooperativa_id', $cooperativaId)
                ->with(['itens' => function ($q) {
                    $q->with(['produto' => function ($p) {
                        //  $p->withTrashed(); // Inclui produtos deletados

                    }]);
                }]);

            // Filtro por status
            if ($request->has('status') && $request->status != '') {
                $query->where('status', $request->status);
            }

            // Filtro por data
            if ($request->has('data_inicio') && $request->data_inicio != '') {
                $query->whereDate('created_at', '>=', $request->data_inicio);
            }
            if ($request->has('data_fim') && $request->data_fim != '') {
                $query->whereDate('created_at', '<=', $request->data_fim);
            }

            // Filtro por cliente
            if ($request->has('cliente') && $request->cliente != '') {
                $query->where('cliente', 'like', '%'.$request->cliente.'%');
            }

            // Filtro por forma de pagamento
            if ($request->has('forma_pagamento') && $request->forma_pagamento != '') {
                $query->where('forma_pagamento', $request->forma_pagamento);
            }

            // Ordenação
            $sortField = $request->get('sort', 'created_at');
            $sortDirection = $request->get('direction', 'desc');
            $query->orderBy($sortField, $sortDirection);

            // Paginação
            $perPage = $request->get('per_page', 10);
            $vendas = $query->paginate($perPage);

            // Formatar dados para o frontend
            $formattedVendas = $vendas->map(function ($venda) {
                return [
                    'id' => $venda->id,
                    'numero' => str_pad($venda->id, 5, '0', STR_PAD_LEFT),
                    'data' => $venda->created_at->format('d/m/Y H:i'),
                    'cliente' => $venda->cliente,
                    'total' => number_format($venda->valor_total, 0, ',', '.'),
                    'total_raw' => $venda->valor_total,
                    'forma_pagamento' => $this->getFormaPagamentoLabel($venda->forma_pagamento),
                    'status' => $venda->status,
                    'status_label' => ucfirst($venda->status),
                    'itens_count' => $venda->itens->count(),
                    'itens' => $venda->itens->map(function ($item) {
                        return [
                            'produto' => $item->produto ? $item->produto->nome : 'Produto removido',
                            'quantidade' => $item->quantidade,
                            'preco_unitario' => number_format($item->preco_unitario, 0, ',', '.'),
                            'subtotal' => number_format($item->subtotal, 0, ',', '.'),
                        ];
                    }),
                    'valor_entregue' => number_format($venda->valor_entregue ?? 0, 0, ',', '.'),
                    'troco' => number_format($venda->troco ?? 0, 0, ',', '.'),
                ];
            });

            return response()->json([
                'success' => true,
                'data' => $formattedVendas,
                'pagination' => [
                    'total' => $vendas->total(),
                    'per_page' => $vendas->perPage(),
                    'current_page' => $vendas->currentPage(),
                    'last_page' => $vendas->lastPage(),
                    'from' => $vendas->firstItem(),
                    'to' => $vendas->lastItem(),
                ],
                'filters' => $request->all(),
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao carregar vendas: '.$e->getMessage(),
            ], 500);
        }
    }

    /**
     * Get label for payment method
     */
    private function getFormaPagamentoLabel($forma)
    {
        $labels = [
            'dinheiro' => 'Dinheiro',
            'transferencia' => 'Transferência',
            'credito' => 'Crédito',
            'cheque' => 'Cheque',
        ];

        return $labels[$forma] ?? $forma;
    }

    // ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    public function indexCooperativasVenda()
    {
        return view('vendas.indexList2');
    }

    /**
     * Get all cooperativas with product counts.
     */
    public function getCooperativas(Request $request)
    {
        try {
            $cooperativas = Cooperativa::withCount('produtos')
                ->where('estado', 'Activa')
                ->orderBy('nome')
                ->get();

            // Buscar total de vendas de hoje
            $vendasHoje = Venda::whereDate('created_at', today())
                ->count();

            // Formatar dados para o frontend
            $data = $cooperativas->map(function ($coop) {
                return [
                    'id' => $coop->id,
                    'nome' => $coop->nome,
                    'nif' => $coop->nif,
                    'municipio' => $coop->municipio,
                    'provincia' => $coop->provincia,
                    'logo' => $this->getLogoIniciais($coop->nome),
                    'total_produtos' => $coop->produtos_count,
                    'endereco' => $coop->endereco,
                    'telefone' => $coop->telefone,
                    'email' => $coop->email,
                    'cor' => $this->getCorCooperativa($coop->id),
                ];
            });

            return response()->json([
                'success' => true,
                'data' => $data,
                'total' => $data->count(),
                'vendas_hoje' => $vendasHoje,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao carregar cooperativas: '.$e->getMessage(),
            ], 500);
        }
    }

    /**
     * Get sales count for today
     */
    public function getVendasHoje()
    {
        try {
            $total = Venda::whereDate('created_at', today())->count();

            // Vendas por cooperativa hoje
            $porCooperativa = Venda::whereDate('created_at', today())
                ->select('cooperativa_id', DB::raw('count(*) as total'))
                ->groupBy('cooperativa_id')
                ->with('cooperativa')
                ->get();

            return response()->json([
                'success' => true,
                'total' => $total,
                'por_cooperativa' => $porCooperativa,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao carregar vendas de hoje: '.$e->getMessage(),
            ], 500);
        }
    }

    /**
     * Get initials from cooperative name for logo
     */
    private function getLogoIniciais($nome)
    {
        $palavras = explode(' ', $nome);
        $iniciais = '';

        foreach ($palavras as $palavra) {
            if (strlen($iniciais) < 3 && ! empty($palavra)) {
                $iniciais .= strtoupper($palavra[0]);
            }
        }

        return $iniciais ?: 'CP';
    }

    /**
     * Get a color for each cooperative based on ID
     */
    private function getCorCooperativa($id)
    {
        $cores = [
            '#1B5E20', // Verde escuro
            '#1565C0', // Azul
            '#6A1B9A', // Roxo
            '#E65100', // Laranja
            '#00838F', // Ciano
            '#2E7D32', // Verde
            '#C62828', // Vermelho
            '#4527A0', // Roxo escuro
            '#00695C', // Verde azulado
            '#BF360C', // Vermelho escuro
        ];

        return $cores[$id % count($cores)];
    }

    /**
     * Get sale details for viewing/printing
     */
    public function getVenda($cooperativaId, $id)
    {
        try {
            $venda = Venda::where('cooperativa_id', $cooperativaId)
                ->with(['itens' => function ($q) {
                    $q->with(['produto' => function ($p) {
                        $p->withTrashed();
                    }]);
                }])
                ->findOrFail($id);

            return response()->json([
                'success' => true,
                'venda' => [
                    'id' => $venda->id,
                    'numero' => str_pad($venda->id, 6, '0', STR_PAD_LEFT),
                    'data' => $venda->created_at->format('d/m/Y H:i'),
                    'data_original' => $venda->created_at,
                    'cliente' => $venda->cliente,
                    'valor_total' => $venda->valor_total,
                    'forma_pagamento' => $this->getFormaPagamentoLabel($venda->forma_pagamento),
                    'forma_pagamento_raw' => $venda->forma_pagamento,
                    'valor_entregue' => $venda->valor_entregue ?? 0,
                    'troco' => $venda->troco ?? 0,
                    'observacoes' => $venda->observacoes,
                    'itens' => $venda->itens->map(function ($item) {
                        return [
                            'id' => $item->id,
                            'produto_id' => $item->produto_id,
                            'produto_nome' => $item->produto ? $item->produto->nome : 'Produto removido',
                            'quantidade' => $item->quantidade,
                            'preco_unitario' => $item->preco_unitario,
                            'subtotal' => $item->subtotal,
                        ];
                    }),
                    'cooperativa_nome' => $venda->cooperativa ? $venda->cooperativa->nome : 'Cooperativa',
                ],
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao carregar detalhes da venda: '.$e->getMessage(),
            ], 500);
        }
    }

    /**
     * Get label for payment method
     */
    // public function getFormaPagamentoLabel($forma)
    // {
    //     $labels = [
    //         'dinheiro' => 'Dinheiro',
    //         'transferencia' => 'Transferência',
    //         'credito' => 'Crédito',
    //         'cheque' => 'Cheque',
    //     ];
    //     return $labels[$forma] ?? $forma;
    // }
}
