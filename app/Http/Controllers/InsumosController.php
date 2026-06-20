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
    public function store(Request $request)
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
    public function update(Request $request, $id)
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
    public function destroy($id)
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
}
