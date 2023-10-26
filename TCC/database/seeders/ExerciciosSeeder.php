<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Exercicio;

class ExerciciosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Exercicio::create([
            'id_exercicio'=>3,
            'descricao_exercicio'=>'Qual desses é a bola verde?',
            'imagem_exercicio'=>null, 
            'ano_exercicio'=>2014,
            'vestibular'=>'Vunesp',
            'fk_assunto'=>'Razão',
            'fk_materia'=>'Matemática'
        ]);
    }
}
