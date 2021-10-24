<?php

namespace App\Http\Controllers;

use App\Model\Alunos;
use App\Model\Pedidos;
use App\Model\Relatorio;
use Illuminate\Http\Request;

class RelatorioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Monta a grid com todos os pedidos
     * @param Relatorio $relatorio
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function listaPedidos (Relatorio $relatorio)
    {
        $resultados = $relatorio->listaPedidos();
        return view('relatorios.listaPedidos',compact('resultados'));
    }

    /**
     * Lista os detalhes do pedido
     * @param $codPedido
     * @param Relatorio $relatorio
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function listaDetalhesPedido ($codPedido, Relatorio $relatorio)
    {
        $resultados = [];
        $resultados['dados'] = $relatorio->listaDetalhesPedidos($codPedido);
        $resultados['cursos'] = $relatorio->listaCursosPedido($codPedido);
        return view('relatorios.detalhesPedido',compact('resultados'));
    }

    public function listarAlunos (Alunos $alunos)
    {
        $alunos = Alunos::orderBy('id', 'desc')->get();
        return view('relatorios.listarAlunos', compact('alunos'));
    }
}
