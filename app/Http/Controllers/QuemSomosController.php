<?php

namespace App\Http\Controllers;

use App\Model\QuemSomos;
use Illuminate\Http\Request;

class QuemSomosController extends MainController
{
    const WIDTH = 509;
    const HEIGTH = 360;

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Listar dados da pagina quem somos
     *
     */
    public function gerenciarConteudo()
    {
        $conteudo = [];
        $result = QuemSomos::all();

        if (count($result) > 0) {
            $conteudo = current($result)[0];
        }
        return view('quemSomos.quemSomos',compact('conteudo'));
    }

    public function saveConteudo(Request $request)
    {
        $dados = new QuemSomos();
        $data = $request->all();
        if (!is_null($request->image)) {
            $imgPath = self::uploadFile($request->image, 'quemSomos', self::WIDTH, self::HEIGTH, true);
            $data['image'] = $imgPath ? $imgPath['url'] : false;
        }

        $result = $dados->saveConteudo($data);

        if($result) {
            $notification = array(
                'message' => 'Especialidade criada com sucesso!',
                'alert-type' => 'success'
            );
            return back()->with($notification);
        }
    }
}
