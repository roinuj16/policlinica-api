<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class InfoHome extends Model
{
    protected $fillable = [
        'user_id',
        'titulo',
        'descricao',
        'classe_css_1',
        'label_1',
        'info_label_1',
        'classe_css_2',
        'label_2',
        'info_label_2',
        'classe_css_3',
        'label_3',
        'info_label_3',
        'classe_css_4',
        'label_4',
        'info_label_4'
    ];

    public function saveInfos($dados)
    {
        $infos = $this->find($dados['id']);

        $infos->user_id = auth()->user()->id;
        $infos->titulo = $dados['titulo'];
        $infos->descricao = trim($dados['descricao']);
        $infos->classe_css_1 = $dados['classe_css_1'];
        $infos->label_1 = $dados['label_1'];
        $infos->info_label_1 = $dados['info_label_1'];
        $infos->classe_css_2 = $dados['classe_css_2'];
        $infos->label_2 = $dados['label_2'];
        $infos->info_label_2 = $dados['info_label_2'];
        $infos->classe_css_3 = $dados['classe_css_3'];
        $infos->label_3 = $dados['label_3'];
        $infos->info_label_3 = $dados['info_label_3'];
        $infos->classe_css_4 = $dados['classe_css_4'];
        $infos->label_4 = $dados['label_4'];
        $infos->info_label_4 = $dados['info_label_4'];
        $result = $infos->save();
        
        return $result;
    }
}
