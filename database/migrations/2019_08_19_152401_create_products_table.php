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
            $table->integer('id_commerce')->unsigned();
            $table->foreign('id_commerce')->references('id')->on('commerces');
            $table->integer('id_provider')->unsigned();
            $table->foreign('id_provider')->references('id')->on('providers')->nullable();
            $table->integer('id_category')->unsigned();
            $table->foreign('id_category')->references('id')->on('categories')->nullable();
            $table->string('description');
            $table->string('price');
            $table->Integer('stock');
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
