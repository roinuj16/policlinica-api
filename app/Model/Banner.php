<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $fillable = [
        "nome",
        "path_image",
        "status"
    ];

    public function saveBanner(Array $arrayImage)
    {
        try {
            foreach ($arrayImage as $item) {
                if(is_null($item['id'])) {

                    $this->create([
                        "nome" => $item['nome'],
                        "path_image" =>  $item['path_image']
                    ]);

                }else {
                    $banner = $this->find($item['id']);
                    $banner->nome = $item['nome'];
                    $banner->path_image = $item['path_image'];
                    $banner->save();
                }
            }
        } catch (Exption $exception) {
            return $exception->getMessage();
        }
    }


    public function disableImgBanner($id)
    {
        try {
            $banner = $this->find($id);
            $banner->status = ($banner->status == 1 ? 2 : 1);
            $banner->save();
            return $banner->status;
        } catch (Exception $exception) {
            return $exception->getMessage();
        }
    }

}
