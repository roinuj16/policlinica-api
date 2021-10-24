<?php

namespace App\Http\Controllers;

use App\Model\Especialidades;
use Illuminate\Http\Request;

class EspecialidadesController extends MainController
{
//    const WIDTH = 275;
//    const HEIGTH = 183;
    const WIDTH = 509;
    const HEIGTH = 360;
    /**
     * Passando middleware de autenticação
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Tela que lista todas as especialidades cadastradas
     */
    public function verEspecialidades()
    {
        $especialidades = Especialidades::where('user_id', auth()->user()->id)->get();
        return view('especialidades.verEspecialidades',compact('especialidades'));
    }

    /**
     * Monta tela de cadastro
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function cadastroEspecialidades()
    {
        return view('especialidades.cadEspecialidades');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editEspecialidades($id)
    {
        $especialidades = Especialidades::find($id);
        return view('especialidades.cadEspecialidades',compact('especialidades'));
    }

    /**
     * Salva/edita
     * @param Request $request
     */
    public function saveEspecialidades(Request $request)
    {
        $especialidade = new Especialidades();
        $data = $request->all();

        if (!is_null($request->image)) {
            $imgPath = self::uploadFile($request->image, 'especialidades', self::WIDTH, self::HEIGTH);
            $data['image'] = $imgPath ? $imgPath['url'] : false;
        }

        $result = $especialidade->saveEspecialidades($data);

        if($result) {
            $notification = array(
                'message' => 'Especialidade criada com sucesso!',
                'alert-type' => 'success'
            );
            return back()->with($notification);
        }
    }

    /**
     * Exclui uma especialidade
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteConteudo($id)
    {
        $conteudo = Especialidades::destroy($id);
        return response()->json($conteudo);
    }
}
