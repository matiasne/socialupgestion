<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{
   
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('commerce_id');
            $table->foreign('commerce_id')->references('id')->on('commerces');
            $table->string('name');
            $table->string('address');
            $table->string('phone_nunmber');
            $table->string('email');
            $table->timestamps();
        });
    }

  
    public function down()
    {
        Schema::dropIfExists('clients');
    }
}
