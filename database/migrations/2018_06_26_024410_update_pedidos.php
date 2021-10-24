<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdatePedidos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pedidos', function($table) {
//            $table->integer('qtd_parcela')->default(1)->after('payment_method'); //Quantidade parcela
//            $table->double('valor_parcela', 10, 2)->after('qtd_parcela'); //Valor Parcela
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
