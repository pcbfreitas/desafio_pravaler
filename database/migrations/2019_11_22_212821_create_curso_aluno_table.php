<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCursoAlunoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('curso_aluno', function (Blueprint $table) {
            $table->Increments('id_curso_aluno');
            $table->integer('id_curso')->unsigned();
            $table->integer('id_aluno')->unsigned();
            $table->integer('status');
            $table->timestamps();
            $table->foreign('id_curso')->references('id_curso')->on('curso');
            $table->foreign('id_aluno')->references('id_aluno')->on('alunos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('curso_aluno');
    }
}
