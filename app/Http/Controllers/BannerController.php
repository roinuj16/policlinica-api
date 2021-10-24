<?php

namespace App\Http\Controllers;

use App\Model\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

error_reporting(E_ALL | E_STRICT);

class BannerController extends MainController
{
    const WIDTH = 1900;
    const HEIGTH = 700;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function formBanner(Banner $banner)
    {
        $imgs = $banner->all();

        $images = [];

        if (count($imgs) > 0) {
            foreach ($imgs as $key => $image) {
                $k = explode("_", $image->getAttribute('nome'));
                $images[$k[1]] = $image;
            }
        }

        return view('banner.formBanner', compact('images'));
    }

    public function saveBanner(Request $request, Banner $banner)
    {
        $arrayImage = [];

        if (count($request->path_image) > 0) {
            foreach ($request->path_image as $item => $value) {
                if (array_key_exists('file', $value)) {
                    $arrayImage[$item]['id'] = $value['id'];
                    $arrayImage[$item]['nome'] = $value['nome'];
                    $imgPath = $this->uploadBanner($value['file'], 'banner', $value['nome']);
                    $arrayImage[$item]['path_image'] = $imgPath ? $imgPath : false;
                }
            }

            $banner->saveBanner($arrayImage);
            return redirect()->back();

        }
    }

    public function uploadBanner($image, $folder, $imgName)
    {
        $extension = $image->extension();
        $fileName = $imgName.'.'.$extension;
        $destinationPath = public_path('storage/'.$folder.'/');
        $fullPath = $destinationPath.$fileName;

        $url = 'http://'.$_SERVER['HTTP_HOST'].'/storage/'.$folder.'/'.$fileName;

        $image = Image::make($image);

        if(!file_exists($destinationPath)) {
            File::makeDirectory($destinationPath, 0777, true, true);
        }

        if(file_exists($fullPath)) {
            unlink($fullPath);
        }

        $image->resize(self::WIDTH, self::HEIGTH);
        $image ->encode('jpg');
        $image->save($fullPath, 100);

        return $url;
    }

    public function disableBanner($id, Banner $banner)
    {
        $banner = $banner->disableImgBanner($id);
        return response()->json($banner);
    }
}
