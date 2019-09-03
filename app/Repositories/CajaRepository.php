<?php

namespace App\Repositories;
use App\Entry;
use App\Egress;
use App\Caja;

class CajaRepository{

    public function generateEntry($payment,$total,$commerce,$description,$caja){

        $entry = Entry::create([
            "caja_id" => $caja,
            "total" => $total,
            "payment_id" =>$payment,
            "description" => $description
        ]);  
    }

    public function generateEgress($payment,$total,$commerce,$description,$caja){
        $egress = Egress::create([
            "caja_id" => $caja,
            "total" => $total,
            "description" => $description
        ]);
    }

    public function StoreCaja($name,$total,$commerce){

        $caja = Caja::create([
            "name" => $name,
            "total" => $total,
            "commerce_id" => $commerce,
        ]);

        $caja->save();
    }
  
}