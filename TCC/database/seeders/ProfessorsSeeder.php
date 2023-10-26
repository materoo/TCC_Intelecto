<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Professor;

class ProfessorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Professor::create([
            'cpf_professor'=>'382732672804',
            'rg_professor'=>'230230203023032',
            'nome_professor'=>'Samuel Cunha',
            'email_professor'=>'samuelcunha@gmail.com',
            'celular_professor'=>'14998320012',
            // 'fk_materia'=>'Matemática',
            'imagem_professor'=>null,
            'descricao_professor'=>'baskaslaslslalslalsl',
            'senha_professor'=>bcrypt('Senhadaora')

        ]);
    }
}
