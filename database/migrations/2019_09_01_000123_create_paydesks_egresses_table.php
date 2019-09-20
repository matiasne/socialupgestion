<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaydesksEgressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paydesks_egresses', function (Blueprint $table) {
            $table->bigIncrements('id'); 
            $table->integer('payment_id')->nullable();
            $table->foreign('payment_id')->references('id')->on('payments')->nullable();          
            $table->integer('paydesk_id');
            $table->foreign('paydesk_id')->references('id')->on('paydesks');
            $table->string('description');
            $table->integer('total');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('paydesks_egresses');
    }
}