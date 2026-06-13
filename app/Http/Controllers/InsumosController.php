<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Insumo;


class InsumosController extends Controller
{
        public function index()
    {
        $insumos = Insumo::orderBy('nome', 'desc')
            ->paginate(10);

        return view(
            'insumos.insumos',
            compact('insumos')
        );
    }
}
