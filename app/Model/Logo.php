<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Logo extends Model
{

    protected $fillable = [
        "path_image",
    ];

    public function saveCursos($data)
    {

        try {
            if (is_null($data['id'])) {

                if (array_key_exists('path_image', $data)) {
                    $this->path_image = $data['path_image'];
                }

                return $this->save();

            } else {
                $logo = $this->find($data['id']);

                if (array_key_exists('path_image', $data)) {
                    $logo->path_image = $data['path_image'];
                }

                return $logo->save();
            }
        } catch (Exption $exception) {
            return $exception->getMessage();
        }

    }

}
