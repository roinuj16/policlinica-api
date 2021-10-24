<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCursosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cursos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome', 255);
            $table->text('descricao');
            $table->string('url_video', 255);
            $table->string('path_image', 255);
            $table->string('path_file', 255)->nullable();
            $table->integer('tipo_curso');//1: EAD 2: SEMIPRESENCIAL
            $table->double('valor', 10, 2);
            $table->boolean('status')->default(1);//1: Inativo 2: Ativo

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
        Schema::dropIfExists('cursos');
    }
}
