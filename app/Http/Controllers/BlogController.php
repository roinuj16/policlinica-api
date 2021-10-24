<?php

namespace App\Http\Controllers;

use App\Model\Blog;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BlogController extends MainController
{
    const WIDTH = 850;
    const HEIGTH = 400;

    /**
     * Passando middleware de autenticação
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Lista todos os posts cadastrado
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function listarConteudo()
    {
        $conteudos = Blog::orderBy('id', 'desc')->where('user_id', auth()->user()->id)->get();
        return view('blog.listarConteudo',compact('conteudos'));
    }

    /**
     * Monta tela de Edição
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editConteudo($id)
    {
        $conteudo = Blog::find($id);
        return view('blog.cadConteudo',compact('conteudo'));
    }

    /**
     * Monta dela de Cadastro
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function cadastroConteudo()
    {
        return view('blog.cadConteudo');
    }

    /**
     * Salva dados do cadastro e da edição
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function saveConteudo(Request $request)
    {
        $post = new Blog();
        $data = $request->all();
        $retornoUpload = self::uploadFile($request->image, 'Blog', self::WIDTH, self::HEIGTH, false, true);
        $data['image'] = $retornoUpload;
        $result = $post->saveConteudo($data);
        if($result) {
            $notification = array(
                'message' => 'Especialidade criada com sucesso!',
                'alert-type' => 'success'
            );
            return back()->with($notification);
        }
    }

    /**
     * Exclui um post
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteConteudo($id)
    {
        $conteudo = Blog::destroy($id);
        return response()->json($conteudo);
    }
}
