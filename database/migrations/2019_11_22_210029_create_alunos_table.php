<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlunosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alunos', function (Blueprint $table) {
            $table->Increments('id_aluno');
            $table->string('nome');
            $table->string('cpf');
            $table->date('data_nascimento');
            $table->string('email');
            $table->string('celular');
            $table->string('endereco');
            $table->integer('numero');
            $table->string('bairro');
            $table->string('cidade');
            $table->string('uf');
            $table->integer('status');
            $table->timestamps();
            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alunos');
    }
}
