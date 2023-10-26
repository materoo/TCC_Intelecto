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
        Schema::create('alunos', function (Blueprint $table) {
            $table->string('cpf_aluno')->primary();
            $table->string('rg_aluno')->unique();
            $table->string('nome_aluno');
            $table->string('email_aluno')->unique();
            $table->string('celular_aluno')->nullable();
            $table->string('escola_aluno')->nullable();
            $table->string('serie_aluno')->nullable();
            $table->string('imagem_aluno')->nullable();
            $table->string('senha_aluno');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alunos');
    }
};
