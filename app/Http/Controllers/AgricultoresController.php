<?php

namespace App\Http\Controllers;

use App\Models\Agricultor;

class AgricultoresController extends Controller
{
    public function index()
    {
        $anos = Agricultor::orderBy('data_inicio', 'desc')
            ->paginate(10);

        return view(
            'agricultores.agricultores'
        );
    }
}
