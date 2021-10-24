<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = [
        'user_id',
        'titulo',
        'conteudo',
        'resumo',
        'status',
        'img_path',
        'img_thumb_path'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Grava os dados do cadastro e da edição.
     * @param $dados
     * @return bool
     */
    public function saveConteudo($dados)
    {
        if (is_null($dados['id'])) {
            $this->user_id = auth()->user()->id;
            $this->titulo = $dados['titulo'];
            $this->conteudo = $dados['conteudo'];
            $this->status = $dados['status'];

            if($dados['image'] && array_key_exists('image', $dados) && count($dados['image']) > 0) {
                $this->img_path = $dados['image']['url'];
                $this->img_thumb_path = array_key_exists('urlThumb', $dados['image']) ? $dados['image']['urlThumb'] : null;
            }
            return $this->save();
        }
        else {
            $blog = $this->find($dados['id']);
            $blog->titulo = $dados['titulo'];
            $blog->user_id = $dados['user_id'];
            $blog->conteudo = $dados['conteudo'];
            $blog->status = $dados['status'];

            if($dados['image'] && array_key_exists('image', $dados) && count($dados['image']) > 0) {
                $blog->img_path = $dados['image']['url'];
                $blog->img_thumb_path = array_key_exists('urlThumb', $dados['image']) ? $dados['image']['urlThumb'] : null;
            }
            return $blog->save();
        }
    }
}
