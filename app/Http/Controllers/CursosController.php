<?php

namespace App\Http\Controllers;

use App\Model\Cursos;
use Illuminate\Http\Request;

class CursosController extends MainController
{
    const WIDTH = 240;
    const HEIGTH = 135;

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function listarCursos()
    {
        $cursos = Cursos::orderBy('id', 'desc')->get();
        return view('cursos.listarCursos',compact('cursos'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function formCursos()
    {
        return view('cursos.formCursos');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editCurso($id)
    {
        $curso = Cursos::find($id);
        return view('cursos.formCursos',compact('curso'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function saveCursos(Request $request)
    {
        $data = $request->all();
        $file_path = \Request::file('path_file');

        if(!is_null($request->path_file)) {
            $data['path_file'] = ($file_path) ? self::uploadPdf($file_path, 'curso', $request->nome, true) : '';
        }

        if (!is_null($request->path_image)) {
            $imgPath = self::uploadFile($request->path_image, 'cursos', self::WIDTH, self::HEIGTH);
            $data['path_image'] = $imgPath ? $imgPath['url'] : false;
        }

        $objCurso = new Cursos();
        $result = $objCurso->saveCursos($data);

        if($result) {
            $notification = array(
                'message' => 'Curso cadastrado com sucesso!',
                'alert-type' => 'success'
            );
            return back()->with($notification);
        }
    }

    /**
     * Exclui um curso
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteCurso($id)
    {
        $curso = Cursos::destroy($id);
        return response()->json($curso);
    }
}
