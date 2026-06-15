<?php

namespace App\Http\Controllers;

use App\Models\Agricultor;
use App\Models\Cooperativa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AgricultoresController extends Controller
{
    public function index()
    {
        $agricultores = Agricultor::orderBy('nome_completo', 'desc')
            ->paginate(10);

        $cooperativas = Cooperativa::all();

        return view(
            'agricultores.agricultores',
            compact('agricultores', 'cooperativas')
        );
    }

    /**
     * Mostrar Agricultor
     */
    public function show($id)
    {
        $agricultor = Agricultor::findOrFail($id);

        return response()->json($agricultor);
    }

    /**
     * Registar Agricultor
     */
    public function store(Request $request)
    {
        $request->validate([
            'nome_completo' => 'required|string|max:255',
            'sexo' => 'required|string',
            'data_nascimento' => 'required|date',
            'bilhete' => 'required|string|max:50|unique:agricultores,bilhete',
            'nif' => 'nullable|string|max:50',
            'estado' => 'required|string',
            'telefone_principal' => 'required|string|max:30',
            'telefone_alternativo' => 'nullable|string|max:30',
            'email' => 'nullable|email|max:255',
            'endereco' => 'required|string',
            'fotografia' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $foto = null;

        if ($request->hasFile('fotografia')) {
            $foto = $request->file('fotografia')
                ->store('agricultores', 'public');
        }

        $agricultor = Agricultor::create([
            'nome_completo' => $request->nome_completo,
            'sexo' => $request->sexo,
            'data_nascimento' => $request->data_nascimento,
            'bilhete' => $request->bilhete,
            'nif' => $request->nif,
            'estado' => $request->estado,
            'fotografia' => $foto,
            'telefone_principal' => $request->telefone_principal,
            'telefone_alternativo' => $request->telefone_alternativo,
            'email' => $request->email,
            'endereco' => $request->endereco,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Agricultor registado com sucesso.',
            'data' => $agricultor,
        ]);
    }

    public function update(Request $request, $id)
    {
        $agricultor = Agricultor::findOrFail($id);

        $request->validate([
            'nome_completo' => 'required|string|max:255',
            'sexo' => 'required|string',
            'data_nascimento' => 'required|date',
            'bilhete' => 'required|string|max:50|unique:agricultores,bilhete,'.$id,
            'nif' => 'nullable|string|max:50',
            'estado' => 'required|string',
            'telefone_principal' => 'required|string|max:30',
            'telefone_alternativo' => 'nullable|string|max:30',
            'email' => 'nullable|email|max:255',
            'endereco' => 'required|string',
            'fotografia' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Nova fotografia
        if ($request->hasFile('fotografia')) {

            // Remove a foto antiga
            if ($agricultor->fotografia) {
                Storage::disk('public')->delete($agricultor->fotografia);
            }

            // Guarda a nova foto
            $agricultor->fotografia = $request
                ->file('fotografia')
                ->store('agricultores', 'public');
        }

        $agricultor->update([
            'nome_completo' => $request->nome_completo,
            'sexo' => $request->sexo,
            'data_nascimento' => $request->data_nascimento,
            'bilhete' => $request->bilhete,
            'nif' => $request->nif,
            'estado' => $request->estado,
            'telefone_principal' => $request->telefone_principal,
            'telefone_alternativo' => $request->telefone_alternativo,
            'email' => $request->email,
            'endereco' => $request->endereco,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Agricultor actualizado com sucesso.',
        ]);
    }

    /**
     * Eliminar Agricultor
     */
    public function destroy($id)
    {
        $agricultor = Agricultor::findOrFail($id);

        // Remove fotografia
        if ($agricultor->fotografia) {
            Storage::disk('public')->delete($agricultor->fotografia);
        }

        $agricultor->delete();

        return response()->json([
            'success' => true,
            'message' => 'Agricultor eliminado com sucesso.',
        ]);
    }
}
