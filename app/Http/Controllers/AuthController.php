<?php

namespace App\Http\Controllers;

use App\Models\Agricultor;
use App\Models\Cooperativa;
use App\Models\Insumo;
use App\Models\MovimentoInsumo;
use App\Models\Venda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    //
    public function index()
    {
        if (Auth::check()) {
            return redirect('/dashboard');
        }

        return view('login.login');
    }

    public function login(Request $request)
    {
        $credenciais = $request->only('email', 'password');

        if (Auth::attempt($credenciais)) {

            $user = Auth::user();
            $user->update(['ultimo_acesso' => now()]);

            $request->session()->regenerate();

            return response()->json([
                'status' => true,
                'message' => 'Login efetuado com sucesso',
                'redirect' => url('/dashboard'),
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Email ou senha inválidos',
        ]);
    }

    // Mostra o dashboard do utilizador logado
    public function dashboard()
    {
        // $totalReceita = Venda::sum('valor_total') ?? 0;

        // // Agricultores ativos (estado = 'ativo')
        // $agricultoresAtivos = Agricultor::where('estado', 'Activo')->count();

        // // Produção estimada total (soma da produção_estimada de todas as cooperativas)
        // $producaoTotal = Cooperativa::sum('producao_estimada') ?? 0;

        // // Pagamentos em atraso (vendas com status = 'Atraso')
        // $pagamentosAtraso = Venda::where('status', 'Pago')->count();

        // // Total de insumos em estoque (valor total)
        // $totalInsumos = Insumo::sum(DB::raw('quantidade * preco_unitario')) ?? 0;

        // // (Opcional) Quantidade total de insumos
        // $quantidadeInsumos = Insumo::sum('quantidade') ?? 0;

        // return view('dashboard.dashboard', compact(
        //     'totalReceita',
        //     'agricultoresAtivos',
        //     'producaoTotal',
        //     'pagamentosAtraso',
        //     'totalInsumos',
        //     'quantidadeInsumos' // se quiser exibir
        // ));

        $iconesPorTipo = [
            'semente' => 'bi-flower2',
            'fertilizante' => 'bi-droplet-fill',
            'defensivo' => 'bi-bug-fill',
            'herbicida' => 'bi-tree',
            // ...
        ];

        // Métricas principais
        $totalReceita = Venda::sum('valor_total') ?? 0;
        $agricultoresAtivos = Agricultor::where('estado', 'Activo')->count();
        $producaoTotal = Cooperativa::sum('producao_estimada') ?? 0;
        $totalInsumos = Insumo::sum(DB::raw('quantidade * preco_unitario')) ?? 0;
        $quantidadeInsumos = Insumo::sum('quantidade') ?? 0;

        // Mapeamento de ícones por tipo de insumo
        $iconesPorTipo = [
            'semente' => 'bi-flower2',
            'fertilizante' => 'bi-droplet-fill',
            'defensivo' => 'bi-bug-fill',
            'herbicida' => 'bi-tree',
            'fungicida' => 'bi-shield-fill',
            'inseticida' => 'bi-bug-fill',
            // Adicione outros conforme sua base
        ];

        // Mapeamento de cores para modalidades (para o badge)
        $coresModalidade = [
            'vendido' => 'pago',       // verde
            'oferta' => 'pendente',   // amarelo
            'distribuicao' => 'pago',       // verde
            'credito' => 'atraso',     // vermelho
            'troca' => 'pendente',   // amarelo
        ];

        // Últimos movimentos de insumos (todos)
        $ultimosMovimentos = MovimentoInsumo::with(['insumo', 'agricultor'])
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        return view('dashboard.dashboard2', compact(
            'totalReceita',
            'agricultoresAtivos',
            'producaoTotal',
            'totalInsumos',
            'quantidadeInsumos',
            'ultimosMovimentos',
            'iconesPorTipo',
            'coresModalidade'
        ));

    }

    /**
     * API - Obtem os dados do utilizador logado
     */
    public function getAuthUser()
    {
        if (Auth::check()) {
            $user = Auth::user();

            return response()->json([
                'success' => true,
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'nivel' => $user->nivel,
                    'estado' => $user->estado,
                    'telefone' => $user->telefone,
                    'foto_url' => $user->foto_url,
                    'iniciais' => $user->iniciais,
                ],
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Sem utilizador autenticado',
        ], 401);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
