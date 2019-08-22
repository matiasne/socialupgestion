<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        DB::table('rols')->insert([
            'name_rol' =>'ADMINISTRADOR',
        ]);
        DB::table('rols')->insert([
            'name_rol' =>'COMERCIO',
        ]);
        DB::table('rols')->insert([
            'name_rol' =>'CLIENTE',
        ]);
    }
}
