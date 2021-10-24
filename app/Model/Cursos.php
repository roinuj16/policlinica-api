<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Cursos extends Model
{
    protected $fillable = [
        "nome",
        "descricao",
        "url_video",
        "path_image",
        "path_file",
        "tipo_curso",
        "status",
        "valor"
    ];

    public function pedidos()
    {
        return $this->belongsToMany(Pedidos::class);
    }

    /**
     * Salva os dados no banco
     * @param $dados
     * @return bool
     */
    public function saveCursos($dados)
    {
        try {
            if (is_null($dados['id'])) {
                $this->nome = $dados['nome'];
                $this->descricao = $dados['descricao'];
                $this->url_video = $dados['url_video'];
                $this->tipo_curso = $dados['tipo_curso'];
                $this->valor = str_replace(['.', ','], ['', '.'], $dados['valor']);
                $this->status = $dados['status'];

                if (array_key_exists('path_image', $dados)) {
                    $this->path_image = $dados['path_image'];
                }

                if (array_key_exists('path_file', $dados)) {
                    $this->path_file = $dados['path_file'];
                }

                return $this->save();

            } else {
                $curso = $this->find($dados['id']);
                $curso->nome = $dados['nome'];
                $curso->descricao = $dados['descricao'];
                $curso->url_video = $dados['url_video'];
                $curso->tipo_curso = $dados['tipo_curso'];
                $curso->valor = str_replace(['.', ','], ['', '.'], $dados['valor']);
                $curso->status = $dados['status'];

                if (array_key_exists('path_image', $dados)) {
                    $curso->path_image = $dados['path_image'];
                }

                if (array_key_exists('path_file', $dados)) {
                    $curso->path_file = $dados['path_file'];
                }

                return $curso->save();
            }
        } catch (Exption $exception) {
            return $exception->getMessage();
        }
    }
}
