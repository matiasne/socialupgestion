<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('client_id');
            $table->foreign('client_id')->references('id')->on('clients');
            $table->integer('commerce_id');
            $table->foreign('commerce_id')->references('id')->on('commerces');
            $table->integer('employe_id');
            $table->foreign('employe_id')->references('id')->on('employes');
            $table->date('creation_date');
            $table->string('description');
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
        Schema::dropIfExists('sales');
    }
}
