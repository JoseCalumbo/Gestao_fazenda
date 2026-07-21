<?php

namespace App\Http\Controllers;

use App\Models\Cooperativa;
use App\Models\Safra;
use Illuminate\Http\Request;

class SafraController extends Controller
{
    public function index($cooperativaId)
    {
        $safras = Safra::where('cooperativa_id', $cooperativaId)
            ->orderByDesc('id')
            ->paginate(10);

        return view('safras.index', compact(
            'safras',
            'cooperativaId'
        ));
    }


        /**
     * Display the specified resource.
     */
    public function show(Safra $safra)
    {
        return response()->json([
            'success' => true,
            'data' => $safra->load('cooperativa')
        ]);
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'ano' => 'required|integer|min:2000|max:2100',
            'estado' => 'required|in:activa,inactiva,Planeada,Encerrada',
            'data_inicio' => 'required|date',
            'data_fim' => 'required|date|after_or_equal:data_inicio',
            'cooperativa_id' => 'required|exists:cooperativas,id',
            'descricao' => 'nullable|string',
        ]);

        $safra = Safra::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Safra registada com sucesso!',
            'data' => $safra,
        ]);
    }

    // public function update(Request $request, Safra $safra)
    // {
    //     $request->validate([
    //         'nome' => 'required|max:255',
    //         'ano' => 'required|integer',
    //         'data_inicio' => 'required|date',
    //         'data_fim' => 'required|date',
    //         'estado' => 'required',
    //     ]);

    //     $safra->update($request->all());

    //     return back()->with('success', 'Safra actualizada com sucesso.');
    // }


 public function update(Request $request, Safra $safra)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'ano' => 'required|integer|min:2000|max:2100',
            'estado' => 'required|in:activa,inactiva,Planeada,Encerrada',
            'data_inicio' => 'required|date',
            'data_fim' => 'required|date|after_or_equal:data_inicio',
            'cooperativa_id' => 'required|exists:cooperativas,id',
            'descricao' => 'nullable|string',
        ]);

        $safra->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Safra actualizada com sucesso!',
            'data' => $safra
        ]);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Safra $safra)
    {
        $safra->delete();

        return response()->json([
            'success' => true,
            'message' => 'Safra eliminada com sucesso!',
        ]);
    }

    // ============================================================================================

    public function painel()
    {
        $cooperativas = Cooperativa::whereIn('estado', ['activa', 'activo'])->count();
        $safras = Safra::with('cooperativa')
            ->paginate(10);

        return view('safras.safras', compact('safras'));
    }

    /**
     * Lista de safras com paginação e filtros (para a API)
     */
    public function list(Request $request)
    {
        $query = Safra::with('cooperativa');

        if ($request->filled('nome')) {
            $query->where('nome', 'like', '%'.$request->nome.'%');
        }
        if ($request->filled('estado')) {
            $query->where('estado', $request->estado);
        }
        if ($request->filled('cooperativa_id')) {
            $query->where('cooperativa_id', $request->cooperativa_id);
        }

        $safras = $query->orderBy('created_at', 'desc')->paginate(10);

        return response()->json($safras);
    }
}
