<?php

namespace App\Http\Controllers;

use App\Models\Cooperativa;
use App\Models\CooperativaMembro;
use Illuminate\Http\Request;

class CooperativaController extends Controller
{
    public function index(Request $request)
    {
        $cooperativas = Cooperativa::orderBy('nome', 'asc')->paginate(10);

        // Card de Membros INATIVOS (Corrigido para usar a coluna 'activo')
        $totalMembrosInativos = CooperativaMembro::where('activo', false)->count();

        $totalCooperativasActivas = Cooperativa::where('estado', 'activo')->count();

        $totalCooperativas = Cooperativa::count();

        $totalGeralAssociados = CooperativaMembro::distinct('agricultor_id')->count('agricultor_id');

        return view('cooperativas.cooperativas', compact(
            'cooperativas',
            'totalCooperativasActivas',
            'totalCooperativas',
            'totalGeralAssociados'
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([

            'nome' => 'required|string|max:255',
            'nif' => 'required|string|max:50|unique:cooperativas,nif',
            'data_fundacao' => 'nullable|date',
            'descricao' => 'nullable|string',
            'telefone' => 'nullable|string|max:30',
            'email' => 'nullable|email|max:255',
            'website' => 'nullable|string|max:255',

            'provincia' => 'required|string|max:255',
            'municipio' => 'required|string|max:255',
            'comuna' => 'nullable|string|max:255',
            'endereco' => 'nullable|string|max:255',

            'numero_socios' => 'nullable|integer|min:0',

            'principal_cultura' => 'nullable|string|max:255',
            'numero_talhoes' => 'nullable|integer|min:0',
            'producao_estimada' => 'nullable|numeric|min:0',
            'area_total_cultivada' => 'nullable|numeric|min:0',

            'safra' => 'nullable|string|max:100',
            'inicio_safra' => 'nullable|date',
            'fim_previsto_safra' => 'nullable|date',

            'estado' => 'required|in:activo,desactivado',
        ], [
            'nif.unique' => 'Este número de Bilhete de Identidade já está registado no sistema.',
        ]);

        // 2. Upload da Foto (se existir)
        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('cooperativas', 'public');
        }

        $cooperativa = Cooperativa::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Cooperativa registada com sucesso.',
            'cooperativa' => $cooperativa,
        ]);
    }

    public function show($id)
    {
        $cooperativa = Cooperativa::find($id);

        if (! $cooperativa) {
            return response()->json([
                'success' => false,
                'message' => 'Cooperativa não encontrada.',
            ], 404);
        }

        return response()->json($cooperativa);
    }

    public function update(Request $request, $id)
    {
        $cooperativa = Cooperativa::find($id);

        if (! $cooperativa) {
            return response()->json([
                'success' => false,
                'message' => 'Cooperativa não encontrada.',
            ], 404);
        }

        $validated = $request->validate([

            'nome' => 'required|string|max:255',
            'nif' => 'required|string|max:50|unique:cooperativas,nif,'.$id,

            'data_fundacao' => 'nullable|date',
            'descricao' => 'nullable|string',

            'telefone' => 'nullable|string|max:30',
            'email' => 'nullable|email|max:255',
            'website' => 'nullable|string|max:255',

            'provincia' => 'required|string|max:255',
            'municipio' => 'required|string|max:255',
            'comuna' => 'nullable|string|max:255',
            'endereco' => 'nullable|string|max:255',

            'numero_socios' => 'nullable|integer|min:0',

            'principal_cultura' => 'nullable|string|max:255',
            'numero_talhoes' => 'nullable|integer|min:0',
            'producao_estimada' => 'nullable|numeric|min:0',
            'area_total_cultivada' => 'nullable|numeric|min:0',

            'safra' => 'nullable|string|max:100',
            'inicio_safra' => 'nullable|date',
            'fim_previsto_safra' => 'nullable|date',

            'estado' => 'required|in:activo,desactivado',
        ]);

        $cooperativa->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Cooperativa actualizada com sucesso.',
            'cooperativa' => $cooperativa,
        ]);
    }

    public function destroy($id)
    {
        $cooperativa = Cooperativa::find($id);

        if (! $cooperativa) {
            return response()->json([
                'success' => false,
                'message' => 'Cooperativa não encontrada.',
            ], 404);
        }

        $cooperativa->delete();

        return response()->json([
            'success' => true,
            'message' => 'Cooperativa eliminada com sucesso.',
        ]);
    }
}
