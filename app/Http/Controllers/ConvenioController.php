<?php

namespace App\Http\Controllers;

use App\Model\Convenio;
use Illuminate\Http\Request;

class ConvenioController extends MainController
{
    /**
     * Define o tamanho das imagens do convênio
     */
    const WIDTH = 240;
    const HEIGTH = 135;

    /**
     * Adiciona o middleware de autenticação para controller
     * ConvenioController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Monta tela de Consulta de Convênios
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function verConvenios()
    {
        $convenios = Convenio::orderBy('id', 'desc')->get();
        return view('convenio.verConvenios',compact('convenios'));
    }

    /**
     * Monta tela com formulário de cadastro
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function cadConvenio()
    {
        return view('convenio.formConvenio');
    }

    /**
     * Chama o formulário de cadastro passando o Convênio que será atualizado.
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editConvenio($id)
    {
        $convenio = Convenio::find($id);
        return view('convenio.formConvenio',compact('convenio'));
    }

    /**
     * Executa a ação de inserir ou editar
     * @param Request $request
     * @param Convenio $convenio
     * @return \Illuminate\Http\RedirectResponse
     */
    public function gerenciarConvenio(Request $request, Convenio $convenio)
    {
        $data = $request->all();

        if (!is_null($request->path_image)) {
            $imgPath = self::uploadFile($request->path_image, 'convenios', self::WIDTH, self::HEIGTH);
            $data['path_image'] = $imgPath ? $imgPath['url'] : false;
        }

        $result = $convenio->saveConvenio($data);

        if($result) {
            $notification = array(
                'message' => 'Convenio cadastrado com sucesso!',
                'alert-type' => 'success'
            );
            return back()->with($notification);
        }
    }

    /**
     * Remove um registro
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteConvenio($id)
    {
        $convenio = Convenio::destroy($id);
        return response()->json($convenio);
    }
}
