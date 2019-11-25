<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstCursoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inst_curso', function (Blueprint $table) {
            $table->Increments('id_inst_curso');
            $table->integer('id_instituicao')->unsigned();
            $table->integer('id_curso')->unsigned();
            $table->integer('status');
            $table->timestamps();
            $table->foreign('id_instituicao')->references('id_instituicao')->on('instituicao');
            $table->foreign('id_curso')->references('id_curso')->on('curso');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inst_curso');
    }
}
