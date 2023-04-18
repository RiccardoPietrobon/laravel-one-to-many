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
            ProjectSeeder::class, //per i dati
            UserSeeder::class, //per l'utente generato
            TypeSeeder::class //per il tipo

        ]);
    }
}
