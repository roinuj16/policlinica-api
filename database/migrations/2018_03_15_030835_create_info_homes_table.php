<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInfoHomesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('info_homes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('titulo','100');
            $table->string('descricao','255');
            $table->string('classe_css_1','100');
            $table->string('label_1', '50');
            $table->string('info_label_1', '255');
            $table->string('classe_css_2','100');
            $table->string('label_2', '50');
            $table->string('info_label_2', '255');
            $table->string('classe_css_3','100');
            $table->string('label_3', '50');
            $table->string('info_label_3', '255');
            $table->string('classe_css_4','100');
            $table->string('label_4', '50');
            $table->string('info_label_4', '255');
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
        Schema::dropIfExists('info_homes');
    }
}
