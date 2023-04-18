<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() //così rimane sempre questo utente
    {
        $user = new User;
        $user->name = 'Riccardo';
        $user->email = 'mia@mail.it';
        $user->password = 'miaomiao'; //per criptare la pswd
        $user->save();
    }
}