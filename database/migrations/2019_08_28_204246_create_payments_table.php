<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('commerce_id');
            $table->integer('client_id');
            $table->foreign('commerce_id')->references('id')->on('commerces');
            $table->foreign('client_id')->references('id')->on('clients');
            $table->integer('child_table');
            $table->enum('enum_type', ['SALE','SUBSCRIPTION']);
            $table->enum('enum_status', ['PAGADO','PENDIENTE','CANCELADO']);
            $table->string('total_cost');
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
        Schema::dropIfExists('payments');
    }
}
