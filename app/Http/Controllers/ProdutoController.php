<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;
use App\Models\Cooperativa;
use App\Models\Talhao;


class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }




  



 

    // GET: /cooperativa/{cooperativaId}/produtos
    public function indexJson(Request $request, $cooperativaId)
    {
        $query = Produto::with(['agricultor', 'talhao'])
            ->where('cooperativa_id', $cooperativaId);

        // Filtro por Nome do Produto
        if ($request->filled('nome')) {
            $query->where('nome', 'like', "%{$request->nome}%");
        }

        // Filtro por Categoria
        if ($request->filled('categoria')) {
            $query->where('categoria', $request->categoria);
        }

        // Filtro por Estado (disponivel, esgotado)
        if ($request->filled('estado')) {
            $query->where('estado', $request->estado);
        }

        // Paginação de 10 registos
        $produtosPaginados = $query->orderBy('created_at', 'desc')->paginate(10);

        // Formatação dos dados para o front-end
        $dadosFormatados = collect($produtosPaginados->items())->map(function ($produto) {
            return [
                'id'          => $produto->id,
                'nome'        => $produto->nome,
                'categoria'   => $produto->categoria ?? '--',
                'quantidade'  => $produto->quantidade,
                'unidade'     => $produto->unidade,
                'preco_venda' => $produto->preco_venda,
                'estado'      => $produto->estado,
                'agricultor'  => $produto->agricultor ? $produto->agricultor->nome_completo : 'N/A',
                'talhao'      => $produto->talhao ? $produto->talhao->designacao : 'N/A',
            ];
        });

        return response()->json([
            'success'      => true,
            'data'         => $dadosFormatados,
            'current_page' => $produtosPaginados->currentPage(),
            'last_page'    => $produtosPaginados->lastPage(),
            'total'        => $produtosPaginados->total(),
            'from'         => $produtosPaginados->firstItem(),
            'to'           => $produtosPaginados->lastItem(),
        ]);
    }

    // POST: /cooperativa/{cooperativaId}/produtos/salvar
    public function store(Request $request, $cooperativaId)
    {
        // Validação rigorosa dos campos vindos do formulário
        $request->validate([
            'agricultor_id' => 'required|exists:agricultores,id',
            'talhao_id'      => 'required|exists:talhoes,id',
            'nome'           => 'required|string|max:255',
            'categoria'      => 'nullable|string|max:100',
            'quantidade'     => 'required|numeric|min:0',
            'unidade'        => 'required|string|max:20', // ex: kg, litros
            'preco_venda'    => 'nullable|numeric|min:0',
            'estado'         => 'required|in:disponivel,esgotado',
        ]);

        // Verificação extra de segurança: Garantir que o talhão pertence mesmo a este agricultor
        $talhaoValido = Talhao::where('id', $request->talhao_id)
            ->where('agricultor_id', $request->agricultor_id)
            ->exists();

        if (!$talhaoValido) {
            return response()->json([
                'success' => false, 
                'message' => 'O talhão selecionado não pertence ao agricultor escolhido.'
            ], 422);
        }

        // Criar o produto associado à cooperativa do escopo
        $produto = Produto::create([
            'cooperativa_id' => $cooperativaId,
            'agricultor_id'  => $request->agricultor_id,
            'talhao_id'      => $request->talhao_id,
            'nome'           => $request->nome,
            'categoria'      => $request->categoria,
            'quantidade'     => $request->quantidade,
            'unidade'        => $request->unidade,
            'preco_venda'    => $request->preco_venda,
            'estado'         => $request->estado,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Produto registado e guardado com sucesso!',
            'produto' => $produto
        ], 201);
    }


    public function update(Request $request, $cooperativaId, $id)
    {
        // Encontra o produto garantindo o escopo da cooperativa atual
        $produto = Produto::where('cooperativa_id', $cooperativaId)->findOrFail($id);

        // Validação idêntica à criação
        $request->validate([
            'agricultor_id' => 'required|exists:agricultores,id',
            'talhao_id'      => 'required|exists:talhoes,id',
            'nome'           => 'required|string|max:255',
            'categoria'      => 'nullable|string|max:100',
            'quantidade'     => 'required|numeric|min:0',
            'unidade'        => 'required|string|max:20',
            'preco_venda'    => 'nullable|numeric|min:0',
            'estado'         => 'required|in:disponivel,esgotado',
        ]);

        // Validação de segurança: garantir que o talhão pertence ao agricultor
        $talhaoValido = Talhao::where('id', $request->talhao_id)
            ->where('agricultor_id', $request->agricultor_id)
            ->exists();

        if (!$talhaoValido) {
            return response()->json([
                'success' => false, 
                'message' => 'O talhão selecionado não pertence ao agricultor escolhido.'
            ], 422);
        }

        // Atualizar os dados
        $produto->update([
            'agricultor_id' => $request->agricultor_id,
            'talhao_id'      => $request->talhao_id,
            'nome'           => $request->nome,
            'categoria'      => $request->categoria,
            'quantidade'     => $request->quantidade,
            'unidade'        => $request->unidade,
            'preco_venda'    => $request->preco_venda,
            'estado'         => $request->estado,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Produto atualizado com sucesso!',
            'produto' => $produto
        ]);
    }

    // DELETE: /cooperativa/{cooperativaId}/produtos/{id}/eliminar
    public function destroy($cooperativaId, $id)
    {
        // Encontra e remove o produto
        $produto = Produto::where('cooperativa_id', $cooperativaId)->findOrFail($id);
        $produto->delete();

        return response()->json([
            'success' => true,
            'message' => 'Produto removido com sucesso de forma permanente!'
        ]);
    }

}
