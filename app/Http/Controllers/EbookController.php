<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Ebook;

class EbookController extends MainController
{
    const WIDTH = 240;
    const HEIGTH = 135;

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Lista os ebooks cadastrados
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function listarEbooks()
    {
        $ebooks = Ebook::orderBy('id', 'desc')->get();
        return view('ebooks.listarEbooks',compact('ebooks'));
    }

    public function formEbooks()
    {
        return view('ebooks.formEbooks');
    }

    public function editEbook($id)
    {
        $ebook = Ebook::find($id);
        return view('ebooks.formEbooks',compact('ebook'));
    }

    public function saveEbook(Request $request, Ebook $ebook)
    {
        $data = $request->all();
        $file_path = \Request::file('path_file');

        if(!is_null($request->path_file)) {
            $data['path_file'] = ($file_path) ? self::uploadPdf($file_path, 'Ebooks', $request->nome) : '';
        }

        if (!is_null($request->path_image)) {
            $imgPath = self::uploadFile($request->path_image, 'Ebooks', self::WIDTH, self::HEIGTH);
            $data['path_image'] = $imgPath ? $imgPath['url'] : false;
        }

        $result = $ebook->saveEbook($data);

        if($result) {
            $notification = array(
                'message' => 'E-Book cadastrado com sucesso!',
                'alert-type' => 'success'
            );
            return back()->with($notification);
        }
    }

    /**
     * Exclui um ebook
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteEbook($id)
    {
        $ebook = Ebook::destroy($id);
        return response()->json($ebook);
    }
}
