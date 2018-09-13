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
//        \App\User::create([
//            'name' => 'admin',
//            'email' => 'salvandofelipe@hotmail.com',
//            'password' => bcrypt('jxn9sid4'),
//        ]);

                \App\User::create([
            'name' => 'Hesron Gonçalves',
            'email' => 'pastor@adecal.com',
            'password' => bcrypt('123456'),
            'account_id' => 1,
        ]);

        \App\User::create([
            'name' => 'Josemiro',
            'email' => 'pastor@castro.com',
            'password' => bcrypt('123456'),
            'account_id' => 2,
        ]);

    }
}
