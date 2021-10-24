<?php

namespace App\Http\Controllers;

use App\Model\InfoHome;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;

class InfoHomeController extends MainController
{
    /**
     * Passando middleware de autenticação
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Monta tela de alteração do componente InfoHome
     * @param InfoHome $infoHome
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(InfoHome $infoHome)
    {
        //@TODO: Tratar erro de retorno vazio.
        $dados = InfoHome::findOrFail(1);
        return view('infoHome.infoHome', compact('dados'));
    }

    /**
     * Salva as alterações
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateInfos(Request $request)
    {
        $infoHome = new InfoHome();
        $result = $infoHome->saveInfos($request->all());

        if($result) {
            $notification = array(
                'message' => 'Dados Alterados com sucesso!',
                'alert-type' => 'success'
            );
            return back()->with($notification);
        }
    }
}
