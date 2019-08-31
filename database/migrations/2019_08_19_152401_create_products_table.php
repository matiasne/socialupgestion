<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('commerce_id')->unsigned();
            $table->foreign('commerce_id')->references('id')->on('commerces');
            $table->integer('provider_id')->unsigned();
            $table->foreign('provider_id')->references('id')->on('providers')->nullable();
            $table->integer('category_id')->unsigned();
            $table->foreign('category_id')->references('id')->on('categories')->nullable();
            $table->integer('code');
            $table->string('description');
            $table->string('price');
            $table->Integer('stock');
            $table->string('imgproduct');
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
        Schema::dropIfExists('products');
    }
}
