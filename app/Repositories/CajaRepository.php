<?php

namespace App\Repositories;
use App\Entry;
use App\Egress;
use App\Caja;
use Carbon\Carbon;
use App\Closing;

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
            "payment_id" =>$payment,
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


    public function Closing(Caja $caja){
        
        $entrys = $caja->entry()->get('total');
        $total_entry=0;
        foreach( $entrys as $entry){          
            $total_entry += $entry->total;
        }

        $egress = $caja->egress()->get('total');
        $total_egress=0;
        foreach( $egress as $egres){          
            $total_egress += $egres->total;
        }

        $total=  $total_entry - $total_egress;

        $caja->total = $caja->total + $total;

        $caja->save();

        $date = Carbon::now();

        $close = Closing::create([
            "caja_id" =>  $caja->id,
            "date_closing" => $date->format('Y-m-d')
        ]);

        return $caja;
        
    }
  
}