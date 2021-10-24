<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Especialidades extends Model
{
    protected $fillable = [
        'user_id',
        'nome',
        'img_path',
        'conteudo'
    ];

    /**
     * Grava os dados do cadastro e da edição.
     * @param $dados
     * @return bool
     */
    public function saveEspecialidades($dados)
    {
        if (is_null($dados['id'])) {
            $this->user_id = auth()->user()->id;
            $this->nome = $dados['nome'];
            $this->conteudo = $dados['conteudo'];
            if(array_key_exists('image', $dados)) {
                $this->img_path = $dados['image'];
            }

            return $this->save();
        } else {
            $especialidade = $this->find($dados['id']);
            $especialidade->user_id = $dados['user_id'];
            $especialidade->nome = $dados['nome'];
            $especialidade->conteudo = $dados['conteudo'];

            if(array_key_exists('image', $dados)) {
                $especialidade->img_path = $dados['image'];
            }

            return $especialidade->save();
        }
    }
}
