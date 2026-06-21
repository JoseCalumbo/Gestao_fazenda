<?php

namespace App\Http\Controllers;

use App\Models\MovimentoInsumo;
use App\Models\Agricultor;
use App\Models\Cooperativa;
use Illuminate\Http\Request;

class MovimentoInsumoController extends Controller
{

public function getAgricultores($cooperativaId)
{
    // Procura os agricultores vinculados à cooperativa (ajusta o nome da coluna se for diferente, ex: cooperativa_id)
    $agricultores = Agricultor::where('cooperativa_id', $cooperativaId)
        ->select('id', 'nome')
        ->orderBy('nome', 'asc')
        ->get();

    return response()->json($agricultores);
}









    public function index()
    {
        $movimentos = MovimentoInsumo::with([
            'cooperativa',
            'insumo',
            'agricultor',
        ])->latest()->paginate(15);

        return response()->json($movimentos);
    }

    public function store(Request $request)
    {
        $dados = $request->validate([
            'cooperativa_id' => 'required|exists:cooperativas,id',
            'insumo_id' => 'required|exists:insumos,id',
            'agricultor_id' => 'nullable|exists:agricultores,id',
            'tipo' => 'required|in:entrada,saida',
            'quantidade' => 'required|numeric|min:0.01',
            'modalidade' => 'required|in:compra,doacao,distribuicao,devolucao,ajuste',
        ]);

        $movimento = MovimentoInsumo::create($dados);

        return response()->json([
            'success' => true,
            'message' => 'Movimento registado com sucesso.',
            'data' => $movimento,
        ]);
    }

    public function update(Request $request, $id)
    {
        $movimento = MovimentoInsumo::findOrFail($id);

        $dados = $request->validate([
            'cooperativa_id' => 'required|exists:cooperativas,id',
            'insumo_id' => 'required|exists:insumos,id',
            'agricultor_id' => 'nullable|exists:agricultores,id',
            'tipo' => 'required|in:entrada,saida',
            'quantidade' => 'required|numeric|min:0.01',
            'modalidade' => 'required|in:compra,doacao,distribuicao,devolucao,ajuste',
        ]);

        $movimento->update($dados);

        return response()->json([
            'success' => true,
            'message' => 'Movimento actualizado com sucesso.',
            'data' => $movimento,
        ]);
    }

    public function destroy($id)
    {
        $movimento = MovimentoInsumo::findOrFail($id);

        $movimento->delete();

        return response()->json([
            'success' => true,
            'message' => 'Movimento removido com sucesso.',
        ]);
    }
}
