<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Redacao;

class RedacaosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Redacao::create([
            'titulo'=>'Racismo', 
            'nome_imagem'=>'racismo.png',
            'texto_imagem'=>'Reação sobre o racismo estrutural',
            'descricao'=>'blallasllsa AS ASAS'
        ]);

       
    }
}
