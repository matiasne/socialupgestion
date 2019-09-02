<?php

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
$this->crearComercio();
    }
    private function crearComercio()
    {
    $name= Name::create(['name'=>'libertad',
    $address=Address::create
    ]);
    }
   
}
