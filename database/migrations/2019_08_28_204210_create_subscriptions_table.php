<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('commerce_id');
            $table->foreign('commerce_id')->references('id')->on('commerces');
            $table->integer('client_id');
            $table->foreign('client_id')->references('id')->on('clients');
            $table->integer('employe_id');
            $table->foreign('employe_id')->references('id')->on('employes');
            $table->date('start_date');
            $table->integer('period');            
            $table->enum('enum_start_payment', ['ANTICIPADO','VENCIDO']);
            $table->enum('enum_status', ['ACTIVO','CANCELADO']);
            $table->enum('enum_pay_with',['CREDIT','DEBIT','CASH']);
            $table->integer('total_cost');
            
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
        Schema::dropIfExists('subscriptions');
    }
}
