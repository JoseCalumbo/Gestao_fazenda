<?php

namespace App\Http\Controllers;

use App\Models\Insumo;
use Illuminate\Http\Request;

class InsumosController extends Controller
{
    /**
     * Listar insumos
     */
    public function index()
    {
        $insumos = Insumo::latest()->paginate(10);

        return view('insumos.insumos', compact('insumos'));
    }

    /**
     * Registar novo insumo
     */
    public function storeGeral(Request $request)
    {
        $dados = $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'tipo' => 'required|in:fertilizante,semente,mecanico,pesticida,outro',
            'quantidade' => 'required|numeric|min:0',
            'stock_minimo' => 'nullable|numeric|min:0',
            'unidade' => 'required|string|max:50',
            'preco_unitario' => 'required|numeric|min:0',
            'data_entrada' => 'required|date',
            'estado' => 'nullable|in:activo,inactivo',
        ]);

        $insumo = Insumo::create($dados);

        // Ajustado de 'data' para 'insumo' para bater certo com o teu JS!
        return response()->json([
            'success' => true,
            'message' => 'Insumo registado com sucesso!',
            'insumo' => $insumo,
        ], 201);
    }

    /**
     * Mostrar um insumo
     */
    public function show($id)
    {
        $insumo = Insumo::find($id);

        if (! $insumo) {
            return response()->json([
                'success' => false,
                'message' => 'Insumo não encontrado.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $insumo,
        ]);
    }

    /**
     * Atualizar insumo
     */
    public function updateGeral(Request $request, $id)
    {
        // 1. Procura o insumo no banco de dados
        $insumo = Insumo::find($id);

        // Se não encontrar, responde logo com erro 404
        if (! $insumo) {
            return response()->json([
                'success' => false,
                'message' => 'Insumo não encontrado.',
            ], 404);
        }

        // 2. Validação (Se falhar, o Laravel já devolve os erros em JSON automaticamente)
        $dados = $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'tipo' => 'required|in:fertilizante,semente,mecanico,pesticida,outro',
            'quantidade' => 'required|numeric|min:0',
            'stock_minimo' => 'nullable|numeric|min:0',
            'unidade' => 'required|string|max:50',
            'preco_unitario' => 'required|numeric|min:0',
            'data_entrada' => 'required|date',
            'estado' => 'nullable|in:activo,inactivo',
        ]);

        // 3. Atualiza os dados do insumo
        $insumo->update($dados);

        // 4. Resposta JSON de sucesso (Status 200 OK)
        return response()->json([
            'success' => true,
            'message' => 'Insumo atualizado com sucesso!',
            'insumo' => $insumo, // Mantém o padrão que o teu EventListener espera
        ], 200);
    }

    /**
     * Excluir insumo
     */
    public function destroyGeral($id)
    {
        $insumo = Insumo::find($id);

        // Se não encontrar, responde com status 404 (Não encontrado)
        if (! $insumo) {
            return response()->json([
                'success' => false,
                'message' => 'Insumo não encontrado.',
            ], 404);
        }

        $insumo->delete();

        // Se deletar com sucesso, responde com status 200 (OK)
        return response()->json([
            'success' => true,
            'message' => 'Insumo removido com sucesso!',
        ], 200);
    }









    public function estoqueCooperativa($id)
    {
        // Filtra pelo id da cooperativa e traz os insumos mais recentes com paginação
        $insumos = Insumo::where('cooperativa_id', $id)
            ->latest()
            ->paginate(10);

        // Opcional: Se quiseres passar também os dados da cooperativa para exibir o nome dela no topo da página view
        // $cooperativa = Cooperativa::findOrFail($id);
        // return view('estoque.insumos', compact('insumos', 'cooperativa'));

        return view('estoque.insumos', compact('insumos', 'id'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'tipo' => 'required|string',
            'unidade' => 'required|string|max:50',
            'preco_unitario' => 'required|numeric|min:0',
            'stock_minimo' => 'required|numeric|min:0',
            'descricao' => 'nullable|string',
            'cooperativa_id' => 'required', // Garante que o vínculo existe
        ]);

        $insumo = new Insumo;
        $insumo->nome = $request->nome;
        $insumo->tipo = $request->tipo;
        $insumo->unidade = $request->unidade;
        $insumo->preco_unitario = $request->preco_unitario;
        $insumo->stock_minimo = $request->stock_minimo;
        $insumo->quantidade = 0;
        $insumo->descricao = $request->descricao;
        $insumo->cooperativa_id = $request->cooperativa_id; // Grava o ID correspondente

        $insumo->save();

        return response()->json([
            'message' => 'Insumo cadastrado com sucesso!',
            'insumo' => $insumo,
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'tipo' => 'required|string',
            'unidade' => 'required|string|max:50',
            'preco_unitario' => 'required|numeric|min:0',
            'stock_minimo' => 'required|numeric|min:0',
            'descricao' => 'nullable|string',
        ]);

        $insumo = Insumo::findOrFail($id);
        $insumo->nome = $request->nome;
        $insumo->tipo = $request->tipo;
        $insumo->unidade = $request->unidade;
        $insumo->preco_unitario = $request->preco_unitario;
        $insumo->stock_minimo = $request->stock_minimo;
        $insumo->descricao = $request->descricao;

        $insumo->save();

        return response()->json([
            'message' => 'Insumo atualizado com sucesso!',
            'insumo' => $insumo,
        ], 200);
    }

    public function destroy($id)
    {
        try {
            $insumo = Insumo::findOrFail($id);

            // 💡 Dica de Ouro: Se este insumo já tiver movimentações associadas,
            // podes decidir se apagas em cascata ou se bloqueias a exclusão:
            // Se a tua tabela de histórico/movimentos tiver chave estrangeira para o insumo:
            // $insumo->movimentos()->delete(); // Caso queiras apagar o histórico junto

            $insumo->delete();

            return response()->json([
                'message' => 'Insumo removido com sucesso de forma definitiva.',
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Ocorreu um erro ao tentar eliminar o insumo da base de dados.',
            ], 500);
        }
    }

    // ── ENTRADA DE STOCK ──
    public function registrarEntrada(Request $request, $cooperativa_id)
    {
        $request->validate([
            'insumo_id' => 'required|exists:insumos,id',
            'quantidade' => 'required|numeric|min:0.01',
        ]);

        // Encontra o insumo garantindo que pertence a esta cooperativa
        $insumo = Insumo::where('id', $request->insumo_id)
            ->where('cooperativa_id', $cooperativa_id)
            ->firstOrFail();

        // Soma a nova quantidade ao stock atual
        $insumo->quantidade += $request->quantidade;
        $insumo->save();

        return response()->json([
            'success' => true,
            'message' => "Stock atualizado! Foram adicionadas {$request->quantidade} unidades ao insumo {$insumo->nome}.",
        ]);
    }

    // ── SAÍDA DE STOCK (Distribuição para Agricultor) ──
    public function registrarSaida(Request $request, $cooperativa_id)
    {
        $request->validate([
            'insumo_id' => 'required|exists:insumos,id',
            'agricultor_id' => 'required|exists:agricultores,id', // Valida se o agricultor existe
            'quantidade' => 'required|numeric|min:0.01',
        ]);

        $insumo = Insumo::where('id', $request->insumo_id)
            ->where('cooperativa_id', $cooperativa_id)
            ->firstOrFail();

        // Validação crucial: Verificar se há stock suficiente para a saída
        if ($insumo->quantidade < $request->quantidade) {
            return response()->json([
                'success' => false,
                'message' => "Stock insuficiente. Quantidade disponível: {$insumo->quantidade} {$insumo->unidade}.",
            ], 422);
        }

        // Subtrai a quantidade do stock atual
        $insumo->quantidade -= $request->quantidade;
        $insumo->save();

        // Opcional: Registar esta saída numa tabela de 'historico_movimentacoes' ou 'entregas_insumos'
        // ex: EntregaInsumo::create([...]) para auditar qual agricultor levou o quê.

        return response()->json([
            'success' => true,
            'message' => "Saída registada! Foram deduzidas {$request->quantidade} unidades para o agricultor selecionado.",
        ]);
    }

    // use App\Models\Insumo;
    // use App\Models\Movimento; // Altera para o nome real do teu modelo de histórico
    // use Illuminate\Http\Request;

    // public function movimentar(Request $request)
    // {
    //     $request->validate([
    //         'insumo_id' => 'required|exists:insumos,id',
    //         'tipo_movimento' => 'required|in:Entrada,Saída',
    //         'quantidade' => 'required|integer|min:1',
    //         'data' => 'required|date',
    //         'observacao' => 'nullable|string'
    //     ]);

    //     $insumo = Insumo::findOrFail($request->insumo_id);

    //     // Validação de segurança extra para saídas
    //     if ($request->tipo_movimento === 'Saída' && $insumo->quantidade < $request->quantidade) {
    //         return response()->json(['message' => 'Quantidade de saída excede o stock disponível.'], 422);
    //     }

    //     // 1. Guardar o histórico do movimento
    //     $movimento = new Movimento();
    //     $movimento->insumo_id = $insumo->id;
    //     $movimento->tipo_movimento = $request->tipo_movimento;
    //     $movimento->quantidade = $request->quantidade;
    //     $movimento->stock_anterior = $insumo->quantidade;

    //     // 2. Atualizar o stock real do insumo
    //     if ($request->tipo_movimento === 'Entrada') {
    //         $insumo->quantidade += $request->quantidade;
    //     } else {
    //         $insumo->quantidade -= $request->quantidade;
    //     }

    //     $movimento->stock_atual = $insumo->quantidade;
    //     $movimento->data = $request->data;
    //     $movimento->utilizador = auth()->user()->name ?? 'Sistema';
    //     $movimento->observacao = $request->observacao;

    //     // Salvar ambos no Banco de Dados
    //     $insumo->save();
    //     $movimento->save();

    //     return response()->json(['message' => 'Movimentação registada com sucesso!']);
    // }

}
