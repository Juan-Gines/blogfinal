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
    public function run()
    {
        //creamos 2 registros validos
        User::create([
            'name'=>'Juan Ginés Alentà',
            'email'=>'juangalenta@hotmail.com',
            'password'=>bcrypt('12345678')
        ]);
        User::create([
            'name'=>'Ariadna Alentà',
            'email'=>'ariadnaalenta@hotmail.com',
            'password'=>bcrypt('12345678')
        ]);
        User::factory(98)->create();//crea 98 registros falsos
    }
}
