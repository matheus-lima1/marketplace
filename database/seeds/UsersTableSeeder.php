<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // CRIANDO 40 USERS, MAS PARA CADA USER SENDPO GERADA UMA STORE
       factory(\App\User::class,40)->create()->each(function($user){ // each() cada linha executada adiciona a loja

        // create() trabalha com arrays
        // save() trabalha com objetos
        $user->store()->save(factory(\App\Store::class)->make()); // store() é um método do relacionamento 1:1 com User

        

       });
    }
}
