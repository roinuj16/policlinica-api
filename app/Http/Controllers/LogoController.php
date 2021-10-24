<?php

namespace App\Http\Controllers;

use App\Model\Logo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LogoController extends MainController
{

    const WIDTH = 239;
    const HEIGTH = 239;

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
     * @param Logo $logo
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function formLogo(Logo $logo)
    {
        $logo = Logo::first();
        $img = ($logo == false ? [] : $logo);
        return view('logo.formLogo', compact('img'));
    }

    /**
     * @param Request $request
     * @param Logo $logo
     * @return \Illuminate\Http\RedirectResponse
     */
    public function saveLogo(Request $request, Logo $logo)
    {
        $data = $request->all();

        if (!is_null($request->path_image)) {
            $imgPath = self::uploadFile($request->path_image, 'logo', self::WIDTH, self::HEIGTH, true);
            $data['path_image'] = $imgPath ? $imgPath['url'] : false;
        }

        $result = $logo->saveCursos($data);

        if($result) {
            $notification = array(
                'message' => 'Curso cadastrado com sucesso!',
                'alert-type' => 'success'
            );
            return back()->with($notification);
        }

    }
}
