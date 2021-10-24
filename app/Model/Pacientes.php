<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Pacientes extends Model
{
    protected $fillable = [
        'nome',
        'email',
        'telefone',
        'cep',
        'endereco',
        'bairro',
        'cidade',
        'estado',
        'local_cadastro',
    ];

    public function savePacientes($dados)
    {
        try {
            if (is_null($dados['id'])) {
                $this->nome           = $dados['nome'];
                $this->email          = $dados['email'];
                $this->dt_nascimento  = $dados['dt_nascimento'];
                $this->sexo           = $dados['sexo'];
                $this->telefone       = $dados['telefone'];
                $this->cep            = $dados['cep'];
                $this->endereco       = $dados['endereco'];
                $this->bairro         = $dados['bairro'];
                $this->cidade         = $dados['cidade'];
                $this->estado         = $dados['estado'];
                $this->local_cadastro = $dados['local_cadastro'];

                return $this->save();

            } else {
                $paciente                 = $this->find($dados['id']);
                $paciente->nome           = $dados['nome'];
                $paciente->email          = $dados['email'];
                $paciente->telefone       = $dados['telefone'];
                $paciente->dt_nascimento  = $dados['dt_nascimento'];
                $paciente->sexo           = $dados['sexo'];
                $paciente->cep            = $dados['cep'];
                $paciente->endereco       = $dados['endereco'];
                $paciente->bairro         = $dados['bairro'];
                $paciente->cidade         = $dados['cidade'];
                $paciente->estado         = $dados['estado'];
                $paciente->local_cadastro = $dados['local_cadastro'];

                return $paciente->save();
            }
        } catch (Exption $exception) {
            return $exception->getMessage();
        }
    }
}
