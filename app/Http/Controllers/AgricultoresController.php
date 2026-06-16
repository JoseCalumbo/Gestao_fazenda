<?php

namespace App\Http\Controllers;

use App\Models\Agricultor;
use App\Models\Cooperativa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class AgricultoresController extends Controller
{
    // public function index()
    // {
    //     // Dados para as tabelas e selects (que você já tinha)
    //     $agricultores = Agricultor::latest()->paginate(10);
    //     $cooperativas = Cooperativa::all();

    //     // 1. Total de agricultores cadastrados
    //     $totalAgricultores = Agricultor::count();

    //     // 2. Associados à cooperativa (quem tem o campo cooperativa_id preenchido)
    //     // $associadosCoop = Agricultor::whereNotNull('cooperativa_id')
    //     //                             ->where('cooperativa_id', '!=', '')
    //     //                             ->where('cooperativa_id', '!=', 0)
    //     //                             ->count();

    //     // 3. Técnicos (tipo_membro = 'Técnico')
    //     // $tecnicos = Agricultor::where('tipo_membro', 'Técnico')->count();

    //     // 4. Activos (estado = 'activo')
    //     $activos = Agricultor::where('estado', 'activo')->count();

    //     // Retorna a view passando TODAS as variáveis necessárias para os cards
    //     return view('agricultores.agricultores', compact(
    //         'agricultores',
    //         'cooperativas',
    //         'totalAgricultores',
    //         //  'associadosCoop',
    //         //   'tecnicos',
    //         'activos'
    //     ));
    // }


    public function index(Request $request)
    {
        // 1. Lista de cooperativas para preencher o <select> no Blade
        $cooperativas = Cooperativa::all();

        // 2. Criar a Query Base para os agricultores (usando Query Builder)
        $query = Agricultor::query();

        // FILTRO: Pesquisa por Nome, BI ou Cooperativa (via relacionamento ou texto)
        // if ($request->filled('search')) {
        //     $search = $request->input('search');
        //     $query->where(function ($q) use ($search) {
        //         $q->where('nome', 'like', "%{$search}%")
        //             ->orWhere('bi', 'like', "%{$search}%"); // Ajuste o nome da coluna do BI se necessário

        //         // Opcional: Se quiser pesquisar pelo nome da cooperativa associada
        //         $q->orWhereHas('cooperativa', function ($coopQuery) use ($search) {
        //             $coopQuery->where('nome', 'like', "%{$search}%");
        //         });
        //     });
        // }

        // FILTRO: Estado
        if ($request->filled('estado')) {
            $query->where('estado', $request->input('estado'));
        }

        // FILTRO: Cooperativa
        // if ($request->filled('cooperativa_id')) {
        //     $query->where('cooperativa_id', $request->input('cooperativa_id'));
        // }

        // // FILTRO: Tipo de Membro
        // if ($request->filled('tipo_membro')) {
        //     $query->where('tipo_membro', $request->input('tipo_membro'));
        // }

        // 3. Obter os agricultores filtrados com paginação (mantendo os filtros na URL)
        $agricultores = $query->latest()->paginate(10)->withQueryString();

        // 4. Contagens para os Cards (Geralmente mantém-se o total geral,
        // mas se quiser que os cards mudem com o filtro, use $query->count() antes de paginar)
        $totalAgricultores = Agricultor::count();
        // $associadosCoop = Agricultor::whereNotNull('cooperativa_id')->where('cooperativa_id', '!=', 0)->count();
        // $tecnicos = Agricultor::where('tipo_membro', 'Técnico')->count();
        $activos = Agricultor::where('estado', 'activo')->count();

        return view('agricultores.agricultores', compact(
            'agricultores',
            'cooperativas',
            'totalAgricultores',
            // 'associadosCoop',
            // 'tecnicos',
            'activos'
        ));
    }

    public function store1(Request $request)
    {
        // 1. Validação dos dados
        $validated = $request->validate([
            'nome_completo' => 'required|string|max:255',
            'sexo' => 'required',
            'data_nascimento' => 'required|date',
            'bilhete' => 'required|string|max:20',
            'telefone_principal' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // max 2MB
        ]);

        // 2. Upload da Foto (se existir)
        $fotoPath = null;
        if ($request->hasFile('foto')) {

            $file = $request->file('foto');
            // Opção A: Usar o nome original que veio do computador do utilizador
            $nomeArquivo = time().'_'.$file->getClientOriginalName();
            // Guarda o arquivo com o nome definido na pasta storage/app/public/agricultores
            $file->storeAs('agricultores', $nomeArquivo, 'public');
            // Salva no banco de dados apenas: "agricultores/nome_do_arquivo.png"
            $fotoPath = 'agricultores/'.$nomeArquivo;
        }

        // 3. Criar o Agricultor
        $agricultor = Agricultor::create([
            'nome_completo' => $request->nome_completo,
            'sexo' => $request->sexo,
            'data_nascimento' => $request->data_nascimento,
            'bilhete' => $request->bilhete,
            'nif' => $request->nif,
            'estado' => $request->estado,
            'tipo_membro' => $request->tipo_membro,
            'telefone_principal' => $request->telefone_principal,
            'telefone_alternativo' => $request->telefone_alternativo,
            'email' => $request->email,
            'endereco' => $request->endereco,
            'foto' => $fotoPath, // Guarda o caminho gerado
        ]);

        // 4. Vincular à Cooperativa se foi selecionada
        if ($request->filled('cooperativa_id')) {
            // Faz a inserção na tabela pivot através do relacionamento ou via DB direto
            \DB::table('agricultor_cooperativa')->insert([
                'agricultor_id' => $agricultor->id,
                'cooperativa_id' => $request->cooperativa_id,
                'cargo' => $request->cargo_cooperativa,
                'data_inicio' => now()->toDateString(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Agricultor guardado e associado à cooperativa com sucesso!',
        ]);
    }

    public function store(Request $request)
    {
        try {

            $request->validate([
                'nome_completo' => 'required|string|max:255',
                'sexo' => 'required',
                'data_nascimento' => 'required|date',
                // unique:tabela,coluna
                'bilhete' => 'required|string|max:20|unique:agricultores,bilhete',
                'telefone_principal' => 'required',
                'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            ], [
                // Mensagem personalizada em português
                'bilhete.unique' => 'Este número de Bilhete de Identidade já está registado no sistema.',
            ]);

            // 2. Upload da Foto (se existir)
            $fotoPath = null;
            if ($request->hasFile('foto')) {
                // Guarda na pasta storage/app/public/agricultores
                $fotoPath = $request->file('foto')->store('agricultores', 'public');
            }

            // 3. Criar o Agricultor
            $agricultor = Agricultor::create([
                'nome_completo' => $request->nome_completo,
                'sexo' => $request->sexo,
                'data_nascimento' => $request->data_nascimento,
                'bilhete' => $request->bilhete,
                'nif' => $request->nif,
                'estado' => $request->estado,
                'tipo_membro' => $request->tipo_membro,
                'telefone_principal' => $request->telefone_principal,
                'telefone_alternativo' => $request->telefone_alternativo,
                'email' => $request->email,
                'endereco' => $request->endereco,
                'foto' => $fotoPath, // Guarda o caminho gerado
            ]);

            // 4. Vincular à Cooperativa se foi selecionada
            if ($request->filled('cooperativa_id')) {
                // Faz a inserção na tabela pivot através do relacionamento ou via DB direto
                \DB::table('agricultor_cooperativa')->insert([
                    'agricultor_id' => $agricultor->id,
                    'cooperativa_id' => $request->cooperativa_id,
                    'cargo' => $request->cargo_cooperativa,
                    'data_inicio' => now()->toDateString(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Agricultor guardado com sucesso!',
            ]);

        } catch (ValidationException $e) {
            // Captura o erro de validação (incluindo o BI duplicado) e envia de forma limpa para o JS
            return response()->json([
                'success' => false,
                'message' => $e->validator->errors()->first(), // Pega a primeira mensagem de erro
            ], 422); // Status 422: Unprocessable Entity
        }
    }

    /**
     * 2. ALTERAÇÃO / EDIÇÃO COMPLETA (PUT /agricultores/{id})
     */
    public function update(Request $request, $id)
    {
        $agricultor = Agricultor::findOrFail($id);

        $request->validate([
            'nome_completo' => 'required|string|max:255',
            'sexo' => 'required',
            'data_nascimento' => 'required|date',
            'bilhete' => 'required|string',
            'telefone_principal' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Se foi enviada uma NOVA foto
        if ($request->hasFile('foto')) {
            // Se já existia uma foto antiga no banco, apaga o arquivo antigo para não acumular lixo
            if ($agricultor->foto) {
                Storage::disk('public')->delete($agricultor->foto);
            }
            // Salva a nova foto
            $agricultor->foto = $request->file('foto')->store('agricultores', 'public');
        }

        // Atualizar todos os dados de texto na tabela 'agricultores'
        $agricultor->update([
            'nome_completo' => $request->nome_completo,
            'sexo' => $request->sexo,
            'data_nascimento' => $request->data_nascimento,
            'bilhete' => $request->bilhete,
            'nif' => $request->nif ?: null,
            'estado' => $request->estado,
            'tipo_membro' => $request->tipo_membro,
            'telefone_principal' => $request->telefone_principal,
            'telefone_alternativo' => $request->telefone_alternativo ?: null,
            'email' => $request->email ?: null,
            'endereco' => $request->endereco ?: null,
            'foto' => $agricultor->foto, // Mantém a foto atual ou a nova
        ]);

        // Gerenciar o vínculo com a Cooperativa (Tabela Pivot)
        if ($request->filled('cooperativa_id')) {
            // Verifica se este agricultor já tinha alguma cooperativa antes
            $vinculo = DB::table('agricultor_cooperativa')->where('agricultor_id', $agricultor->id)->first();

            if ($vinculo) {
                // Se já tinha, atualiza os dados da cooperativa e cargo
                DB::table('agricultor_cooperativa')
                    ->where('agricultor_id', $agricultor->id)
                    ->update([
                        'cooperativa_id' => $request->cooperativa_id,
                        'cargo' => $request->cargo_cooperativa ?: null,
                        'updated_at' => now(),
                    ]);
            } else {
                // Se não tinha cooperativa, cria uma nova associação
                DB::table('agricultor_cooperativa')->insert([
                    'agricultor_id' => $agricultor->id,
                    'cooperativa_id' => $request->cooperativa_id,
                    'cargo' => $request->cargo_cooperativa ?: null,
                    'data_inicio' => now()->toDateString(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        } else {
            // Se o campo cooperativa veio vazio, remove o agricultor de qualquer cooperativa existente
            DB::table('agricultor_cooperativa')->where('agricultor_id', $agricultor->id)->delete();
        }

        return response()->json(['success' => true, 'message' => 'Agricultor atualizado com sucesso!']);
    }

    /**
     * Eliminar Agricultor
     */
    public function destroy($id)
    {
        // Usa uma Transaction para garantir que se algo falhar, nada é apagado por metade
        \DB::beginTransaction();

        try {
            $agricultor = Agricultor::findOrFail($id);

            // 1. Remove o vínculo com a cooperativa na tabela pivot primeiro
            //  \DB::table('agricultor_cooperativa')->where('agricultor_id', $agricultor->id)->delete();

            // 2. Remove a fotografia física do disco (ajustado de 'fotografia' para 'foto')
            if ($agricultor->foto) {
                \Storage::disk('public')->delete($agricultor->foto);
            }

            // 3. Elimina o agricultor da base de dados
            $agricultor->delete();
            // Se tudo correu bem, confirma as alterações na BD
            \DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Agricultor, foto e vínculos eliminados com sucesso.',
            ]);

        } catch (\Exception $e) {
            // Se der algum erro, desfaz tudo para não corromper os dados
            \DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Erro ao eliminar o agricultor: '.$e->getMessage(),
            ], 500);
        }
    }
}
