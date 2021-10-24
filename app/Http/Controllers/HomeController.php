<?php

namespace App\Http\Controllers;


use App\Model\Pedidos;
use App\Model\Relatorio;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Relatorio $relatorio)
    {
        $resultados = [];
        $resultados['cursos'] = $relatorio->totalCursosVendido();
        $resultados['pacientes'] = 0;
        return view('home',compact('resultados'));
    }
}
