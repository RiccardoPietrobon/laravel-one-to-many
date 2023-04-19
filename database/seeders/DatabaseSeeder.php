<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            TypeSeeder::class, //per i framework circa
            ProjectSeeder::class, //per i dati
            UserSeeder::class, //per l'utente generato
            TechnologySeeder::class, //per le tecnologie
            ProjectTechnologySeeder::class, //per la tabella ponte, per ultima rispetto a Project e Technology
        ]);
    }
}