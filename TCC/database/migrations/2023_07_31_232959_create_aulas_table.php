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
        Schema::create('aulas', function (Blueprint $table) {
            $table->string('nome_aula')->primary();
            $table->string('nome_arquivo');
            $table->string('fk_assunto');
            $table->foreign('fk_assunto')->references('nome_assunto')->on('assuntos')->onDelete('cascade')->onUpdate('cascade');
            $table->string('fk_materia');
            $table->foreign('fk_materia')->references('nome_materia')->on('materias')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aulas');
    }
};
