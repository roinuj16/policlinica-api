<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePedidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('aluno_id')->unsigned();
            $table->foreign('aluno_id')->references('id')->on('alunos')->onDelete('cascade');
            $table->string('reference', 191)->unique(); //Reference do pagseguro gerado na model
            $table->string('code', 191)->unique(); //Code retorno pagseguro
            $table->enum('status', [1,2,3,4,5,6,7,8,9]); //status da compra
            $table->enum('payment_method', [1,2,3,4,5,6,7]); //Forma de pagamento 1 cartão 2 boleto
            $table->integer('qtd_parcela')->default(1);
            $table->double('valor_parcela', 10, 2);
            $table->double('valor_total', 10, 2); //Valor total do pedido
            $table->date('date'); //Data do pedido
            $table->date('date_refresh_status')->nullable(); //Data de atualização do status
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pedidos');
    }
}
