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
        Schema::create('alternativas', function (Blueprint $table) {
            $table->increments('id_alternativa');
            $table->string('letra');
            $table->string('descricao_alternativa')->nullable();
            $table->string('imagem_alternativa')->nullable();
            $table->boolean('correta');
            $table->integer('fk_id_exercicio');
            $table->foreign('fk_id_exercicio')->references('id_exercicio')->on('exercicios')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alternativas');
    }
};
