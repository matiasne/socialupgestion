<?php

namespace App\Repositories;
use App\PaydeskEntry;
use App\PaydeskEgress;
use App\Paydesk;
use Carbon\Carbon;
use App\Closing;

class PaydeskRepository{    

    

    public function store($name,$total,$commerce){

        $paydesk = new Paydesk;
        $paydesk->name = $name;
        $paydesk->total = $total;
        $paydesk->commerce_id = $commerce;

        $paydesk->save();

        return $paydesk;
    }

    public function update($paydesk){

        $paydesk->update([
            "name" => $request->name,
            "commerce_id" =>  $commerce->id,
            "total" => $request->total
        ]);

        $paydesk->save();

        return $paydesk;
    }

   

    public function destroy($paydesk){

        $paydeskEntries = $paydesk->entries()->get();            

        foreach($paydeskEntries as $paydeskEntry){
            $paydeskEntry->delete();
        }

        $paydeskEgress= $paydesk->paydeskEgress()->get();

        foreach($paydeskEgress as $egres){
            $egres->delete();
        }

        $closings= $paydesk->closings()->get();

        foreach($closings as $closing){
            $closing->delete();
        }

        $paydesk->delete();

        return true;

    }


    public function Closing($paydesk_id, $extracted){
        
        $paydesk = Paydesk::findOrFail($paydesk_id);
        
        $close_date = Closing::where('paydesk_id', $paydesk_id)
                            ->orderBy('created_at','desc')
                            ->first();
                            //->value('created_at');
        if($close_date == null){
            $close_date = "00-00-00";
        }

        $paydeskEntries= $paydesk->paydeskEntry()->whereDate('created_at', '>', $close_date)->get('total');
        $total_paydeskEntry=0;

        foreach( $paydeskEntries as $paydeskEntry){          
            
            $total_paydeskEntry += $paydeskEntry->total;
        }

        $paydeskEgress = $paydesk->paydeskEgress()->whereDate('created_at', '>', $close_date)->get('total');
        $total_paydeskEgress=0;

        foreach( $paydeskEgress as $egres){          
            
            $total_paydeskEgress += $egres->total;
        }

        $subtotal= $paydesk->total + $total_paydeskEntry - $total_paydeskEgress;

        if($extracted <= $subtotal){
            
            $paydesk->total = $subtotal - $extracted;
    
            $paydesk->save();
    
            $date = Carbon::now();
    
            $close =  new Closing;
            
            $close->paydesk_id = $paydesk->id;
            $close->date_closing =$date->format('Y-m-d H:m:s');
            $close->save();
    
            return $close;

        }else{

            return null;
        }
    }
  
}