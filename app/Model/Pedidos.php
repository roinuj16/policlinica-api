<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Pedidos extends Model
{
    protected $fillable = [
        'aluno_id',
        'reference',
        'code',
        'status',
        'payment_method',
        'qtd_parcela',
        'valor_parcela',
        'valor_total',
        'date',
        'date_refresh_status'
    ];

    /**
     * Relacionamento com tabela Cursos
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function cursos()
    {
        return $this->belongsToMany(Cursos::class, 'curso_pedido');
    }

    /**
     * Gera salva o novo pedido.
     * @param $dadosPedido
     * @param $aluno
     * @param $resultPs
     * @return array|string
     */
    public function newCursoPedidos($dadosPedido, $aluno, $resultPs)
    {
        $arr = [];
        foreach ($dadosPedido['cursos'] as $curso) {
            $arr[] = $curso['id'];
        }
        try {
            $objPedido = $this->create([
                'aluno_id' => $aluno->id,
                'reference' => $resultPs['reference'],
                'code' => $resultPs['code'],
                'status' => $resultPs['status'],
                'payment_method' => $dadosPedido['paymentMode'],
                'qtd_parcela' => $dadosPedido['qtd_parcela'],
                'valor_parcela' => $dadosPedido['vlr_parcela'],
                'valor_total' => $dadosPedido['valorTotal'],
                'date' => date('Ymd'),
            ]);

            $objPedido->cursos()->attach($arr);

            return [
                'success' => true
            ];

        }catch (Exption $exception) {
            return $exception->getMessage();
        }
    }

    /**
     * Atualiza status do pedido
     * @param $newStatus
     */
    public function changeStatus($idPedido, $newStatus)
    {
        $pedido = $this->find($idPedido);
        $pedido->status = $newStatus;
        $pedido->date_refresh_status = date('Ymd');
        $pedido->save();
    }
}
