<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Assunto;

class AssuntosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Assunto::create([
            'nome_assunto'=>'Razão',
            'carga_horaria'=>'2',
            'fk_materia'=>'Matemática'
        ]);
    }
}
