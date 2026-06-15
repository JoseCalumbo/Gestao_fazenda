<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cooperativa;


class CooperativaController extends Controller
{
    
    // Exibe a página principal com a listagem inicial
    public function index()
    {
        // $cooperativas = Cooperativa::all();
        // return view('cooperativas.cooperativas', compact('cooperativas'));
        return view('cooperativas.cooperativas');
    }
}
