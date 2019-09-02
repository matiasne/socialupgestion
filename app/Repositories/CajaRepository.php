<?php

namespace App\Repositories;
use App\Entry;
use App\Egress;
use App\Caja;

class CajaRepository{

    public function generateEntry($payment,$total,$commerce){

        $entry = Entry::create([
            "total" => $total,
            "payment_id" =>$payment,
        ]);
        
        $this->StoreCaja($total,$commerce);
    }

    public function generateEgress($payment,$total,$commerce){
        $egress = Egress::create([
            "total" => $total,
            "payment_id" =>$payment,
        ]);
        
        $this->StoreCaja($total,$commerce);
    }

    public function StoreCaja($total,$commerce){

        $entry = Caja::create([
            "total" => $total,
            "commerce_id" => $commerce,
        ]);

        $entry->save();
    }
  
}