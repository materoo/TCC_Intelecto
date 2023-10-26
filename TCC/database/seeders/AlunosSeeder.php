<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Aluno;

class AlunosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Aluno::create ([
            'cpf_aluno'=>'39234672303',
            'rg_aluno'=>'02302030230202',
            'nome_aluno'=>'Gabriel da Silva', 
            'email_aluno'=>'pedrinho123@gmail.com',
            'celular_aluno'=>'9912365802',
            'escola_aluno'=>'Guedes',
            'serie_aluno'=>'3 ano',
            'imagem_aluno'=>null,
            'senha_aluno'=> bcrypt('gabs')
        ]);
    }
}
