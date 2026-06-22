<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Talhao;
use App\Models\Safra;
use App\Models\Cooperativa; 

class TalhoesController extends Controller
{
        public function painel()
    {
        $agricultores = Cooperativa::whereIn('estado', ['activa', 'activo'])->count();
        $talhoes = Safra::with('cooperativa')
            ->paginate(10);

        return view('talhoes.talhoes', compact('talhoes','agricultores')); 
    }
}
