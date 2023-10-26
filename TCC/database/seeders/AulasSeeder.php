<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Aula;

class AulasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Aula::create([
            'nome_aula'=>'Proporção - Aula 3',
            'nome_arquivo'=>'prop.pdf', 
            'fk_assunto'=>'Razão',
            'fk_materia'=>'Matemática'
        ]);

        
    }
}
