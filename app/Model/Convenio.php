<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Convenio extends Model
{
    protected $fillable = [
        "nome",
        "status",
        "path_image"
    ];

    /**
     * Executa a ação de inserir ou editar
     * @param $data
     * @return bool|string
     */
    public function saveConvenio($data)
    {
        try {
            if (is_null($data['id'])) {
                $this->nome = $data['nome'];
                $this->status = $data['status'];

                if (array_key_exists('path_image', $data)) {
                    $this->path_image = $data['path_image'];
                }

                return $this->save();

            } else {
                $convenio = $this->find($data['id']);
                $convenio->nome = $data['nome'];
                $convenio->status = $data['status'];

                if (array_key_exists('path_image', $data)) {
                    $convenio->path_image = $data['path_image'];
                }

                return $convenio->save();
            }
        } catch (Exption $exception) {
            return $exception->getMessage();
        }
    }
}
