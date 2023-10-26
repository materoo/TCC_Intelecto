<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('redacao_alunos', function (Blueprint $table) {  
            $table->increments('id_redacao');
            $table->string('fk_cpf_aluno');
            $table->foreign('fk_cpf_aluno')->references('cpf_aluno')->on('alunos')->onDelete('cascade')->onUpdate('cascade');
            $table->string('fk_tema');
            $table->foreign('fk_tema')->references('titulo')->on('redacaos')->onDelete('cascade')->onUpdate('cascade');
            $table->string('nome_arquivo');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('redacao_alunos');
    }
};
