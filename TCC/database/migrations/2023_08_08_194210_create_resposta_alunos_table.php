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
        Schema::create('resposta_alunos', function (Blueprint $table) {
            $table->increments('id_resposta');
            // $table->primary('id_resposta');
            $table->integer('fk_id_exercicio');
            $table->foreign('fk_id_exercicio')->references('id_exercicio')->on('exercicios')->onDelete('cascade')->onUpdate('cascade');
            $table->string('letra_respondida');
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resposta_alunos');
    }
};
