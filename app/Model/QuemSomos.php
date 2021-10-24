<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class QuemSomos extends Model
{
    protected $fillable = [
        'titulo',
        'conteudo',
        'img_path'
    ];

    public function saveConteudo($dados)
    {
        if ($dados['id']) {
            $obj = $this->find($dados['id']);
            $obj->titulo = $dados['titulo'];
            $obj->conteudo = $dados['conteudo'];
            if(array_key_exists('image', $dados) && count($dados['image']) > 0) {
                $obj->img_path = $dados['image'];
            }
            return $obj->save();
        }

        $this->titulo = $dados['titulo'];
        $this->conteudo = $dados['conteudo'];
        if(array_key_exists('image', $dados) && count($dados['image']) > 0) {
            $this->img_path = $dados['image'];
        }
        return $this->save();
    }
}
