<?php

use Illuminate\Database\Seeder;

class AseguradoraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('aseguradoras')->insert([
            'Razon_Social' => 'Aseguradora Del Sur',
            'Ruc' => '1234567890123',
            'created_at'=> '2020-06-27 04:33:16',
            'updated_at'=> '2020-06-27 04:33:16'
        ]);
    }
}
