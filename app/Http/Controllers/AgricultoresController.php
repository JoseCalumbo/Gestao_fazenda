<?php

namespace App\Http\Controllers;

use App\Models\Agricultor;

class AgricultoresController extends Controller
{
    public function index()
    {
        $agricultores = Agricultor::orderBy('nome_completo', 'desc')
            ->paginate(10);

        return view(
            'agricultores.agricultores',
            compact('agricultores')
        );
    }
}
