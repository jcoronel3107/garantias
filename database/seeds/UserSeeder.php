<?php

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
        DB::table('users')->insert([
            'name' => 'Juan Fernando Coronel',
            'email' => 'jcoronel@bomberos.gob.ec',
            'password' => Hash::make('K@rin@2018'),
            'created_at'=> '2020-06-27 04:33:16',
            'updated_at'=> '2020-06-27 04:33:16'
        ]);
    }
}
