<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Ebook extends Model
{
    protected $fillable = [
        'nome',
        'descricao',
        'url_video',
        'path_image',
        'path_file',
        'num_download',
        'status'
    ];

    public function saveEbook($dados)
    {
        try {

            if (is_null($dados['id'])) {
                $this->nome = $dados['nome'];
                $this->descricao = $dados['descricao'];
                $this->url_video = $dados['url_video'];
                $this->status = $dados['status'];

                if (array_key_exists('path_image', $dados)) {
                    $this->path_image = $dados['path_image'];
                }

                if (array_key_exists('path_file', $dados)) {
                    $this->path_file = $dados['path_file'];
                }

                return $this->save();

            } else {
                $ebook = $this->find($dados['id']);
                $ebook->nome = $dados['nome'];
                $ebook->descricao = $dados['descricao'];
                $ebook->url_video = $dados['url_video'];
                $ebook->status = $dados['status'];

                if (array_key_exists('path_image', $dados)) {
                    $ebook->path_image = $dados['path_image'];
                }

                if (array_key_exists('path_file', $dados)) {
                    $ebook->path_file = $dados['path_file'];
                }

                return $ebook->save();
            }
        } catch (Exption $exception) {
            return $exception->getMessage();
        }
    }
}
