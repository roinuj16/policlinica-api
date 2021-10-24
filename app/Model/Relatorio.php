<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Relatorio extends Model
{

    /**
     * Metodo que lista todos os pedidos
     * @return mixed
     */
    public function listaPedidos()
    {
        $result = DB::select("
            SELECT
                id as cod_pedido,
                code as cod_pagamento,
                status as cod_status,
                CASE
                    WHEN p.status= 1 then 'Aguardando pagamento'
                    WHEN p.status= 2 then 'Em análise'
                    WHEN p.status= 3 then 'Paga'
                    WHEN p.status= 4 then 'Disponível'
                    WHEN p.status= 5 then 'Em disputa'
                    WHEN p.status= 6 then 'Devolvida'
                    WHEN p.status= 7 then 'Cancelada'
                END as status,

                CASE
                    WHEN p.payment_method= 1 then 'Cartão'
                    WHEN p.payment_method= 2 then 'Boleto'
                END as 'pagamento',
                valor_total as valor,
                date as data_compra
            from pedidos p ORDER BY id DESC ;
        ");
        return $result;
    }

    /**
     * Monta relatório de detalhes do pedido
     * @param $codPedido
     * @return mixed
     */
    public function listaDetalhesPedidos ($codPedido)
    {
        $resultQuery = DB::select("
            SELECT
                a.nome,
                a.telefone,
                a.cpf,
                a.email,
                p.id as 'cod_pedido',
                p.code,
                p.valor_total,
                p.qtd_parcela,
                p.status as 'cod_status',
                
                CASE
                    WHEN p.status= 1 then 'Aguardando pagamento'
                    WHEN p.status= 2 then 'Em análise'
                    WHEN p.status= 3 then 'Paga'
                    WHEN p.status= 4 then 'Disponível'
                    WHEN p.status= 5 then 'Em disputa'
                    WHEN p.status= 6 then 'Devolvida'
                    WHEN p.status= 7 then 'Cancelada'
                END as 'status',
                CASE
                    WHEN p.payment_method= 1 then 'Cartão'
                    WHEN p.payment_method= 2 then 'Boleto'
                END as 'forma_pagamento',
                
                p.date as date_compra,
                p.date_refresh_status
                
            FROM pedidos p
            
            INNER JOIN alunos a 
              ON p.aluno_id = a.id
              
            WHERE p.id = $codPedido
        ");

        return current($resultQuery);
    }

    /**
     * Lista os cursos de um pedido
     * @param $codPedido
     * @return mixed
     */
    public function listaCursosPedido($codPedido)
    {
        $query = DB::select("
            SELECT
                cp.pedidos_id as cod_pedido,
                c.nome as nome_curso,
                c.descricao as desc_curso,
                c.valor,
                CASE
                WHEN c.tipo_curso= 1 then 'EAD'
                WHEN c.tipo_curso= 2 then 'Semipresencial'
                END as 'tipo_curso'
            
            FROM curso_pedido cp
            
            INNER JOIN cursos c on cp.cursos_id = c.id
            
            WHERE cp.pedidos_id = $codPedido
        ");

        return $query;
    }

    /**
     * Retorna o total de cursos vendido
     * @return mixed
     */
    public function totalCursosVendido()
    {
        $query = DB::table("pedidos")->where('status','3')->count();
        return $query;
    }
}
