<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesProductsDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_products_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('sale_id');
            $table->foreign('sale_id')->references('id')->on('sales');
            $table->integer('product_id');
            $table->foreign('product_id')->references('id')->on('products'); 
            $table->integer('product_amount');
            $table->integer('product_price');            
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
        Schema::dropIfExists('sales_products_details');
    }
}
