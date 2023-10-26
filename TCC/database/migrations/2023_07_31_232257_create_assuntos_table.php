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
        Schema::create('assuntos', function (Blueprint $table) {
            $table->string('nome_assunto');
            $table->primary('nome_assunto');
            $table->integer('carga_horaria')->nullable();
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
        Schema::dropIfExists('assuntos');
    }
};
