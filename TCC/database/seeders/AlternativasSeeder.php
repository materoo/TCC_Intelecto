<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Alternativa;

class AlternativasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Alternativa::create([
            'letra'=>'c',
            'descricao_alternativa'=>'Verde',
            'imagem_alternativa'=>null,
            'correta'=>false,
            'fk_id_exercicio'=>3
        ]);
    }
}
