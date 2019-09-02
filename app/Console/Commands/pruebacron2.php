<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class pruebacron2 extends Command
{
  
    protected $signature = 'clients:delete';

    
    protected $description = 'Command description';


    public function __construct()
    {
        parent::__construct();
    }

   
    public function handle()
    {
        Clients::where('phone_nunmber',1111)->delete();
        Long::info("user delete");
    }
}
