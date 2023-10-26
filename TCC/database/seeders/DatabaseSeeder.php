<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            MateriasSeeder::class,
            AssuntosSeeder::class,
            AlunosSeeder::class,
            ExerciciosSeeder::class,
            AlternativasSeeder::class,
            RedacaosSeeder::class,
            AulasSeeder::class,
            ProfessorsSeeder::class,
            UsuarioSeeder::class
        ]);
    }
}
