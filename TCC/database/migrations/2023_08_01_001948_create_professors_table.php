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
        Schema::create('professors', function (Blueprint $table) {
            $table->string('cpf_professor')->primary();
            $table->string('rg_professor')->unique();
            $table->string('nome_professor');
            $table->string('email_professor')->unique();
            $table->string('celular_professor')->nullable();
            // $table->string('fk_materia');
            // $table->foreign('fk_materia')->references('nome_materia')->on('materias');
            $table->string('imagem_professor')->nullable();
            $table->string('descricao_professor')->nullable();
            $table->string('senha_professor');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('professors');

    }
};
