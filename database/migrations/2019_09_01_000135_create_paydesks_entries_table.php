<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaydesksEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paydesks_entries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('payment_id')->nullable();
            $table->foreign('payment_id')->references('id')->on('payments')->nullable();
            $table->integer('paydesk_id');
            $table->foreign('paydesk_id')->references('id')->on('paydesks');
            $table->enum('enum_pay_with',['CREDIT','DEBIT','CASH','CURRENTACOUNT','DISCOUNT']);
            $table->string('description');
            $table->integer('amount');
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
        Schema::dropIfExists('paydesks_entries');
    }
}
