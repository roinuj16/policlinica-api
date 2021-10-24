<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Alunos extends Model
{
    protected $fillable = [
        "nome",
        "telefone",
        "cpf",
        "email"
    ];

    public function pedidos()
    {
        return $this->hasMany(Pedidos::class);
    }

    public function newAluno($nome, $telefone, $cpf, $email)
    {
        try {
            $aluno = $this->where('cpf', $cpf)->first();

            if(count($aluno) <= 0) {
                return $this->create([
                    "nome" => $nome,
                    "telefone" => $telefone,
                    "cpf" => $cpf,
                    "email" => $email,
                ]);
            }
            return $aluno;

        }catch (Exption $exception) {
            return $exception->getMessage();
        }
    }

    /**
     * Metodo responsável por salvar o nome e o email de quem esta fazendo o download
     * do Ebook. So e cadastrado uma vez, a validação e por email, se o email existir no banco
     * não salva e segue o processamento de envio de email.
     * @param $nome
     * @param $email
     * @return string
     */
    public function saveDownloadEbook($nome, $email)
    {
        try {
            $aluno = $this->where('email', $email)->first();

            if(count($aluno) <= 0) {
                return $this->create([
                    "nome" => $nome,
                    "email" => $email,
                ]);
            }
            return $aluno;

        }catch (Exption $exception) {
            return $exception->getMessage();
        }


    }
}
