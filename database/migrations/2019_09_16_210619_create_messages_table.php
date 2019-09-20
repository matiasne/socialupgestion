<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sender_id');
            $table->integer('sent_to_id');
            $table->text('body');
            $table->text('subject');
            $table->string('enum_type');
            $table->string('enum_status');
            // It's better to work with default timestamp names:
            $table->timestamps(); 

            // `sender_id` field referenced the `id` field of `users` table:
            $table->foreign('sender_id')
                  ->references('id')
                  ->on('users');

            // Let's add another foreign key on the same table,
            // but this time fot the `sent_to_id` field:
            $table->foreign('sent_to_id')
                  ->references('id')
                  ->on('users');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('messages');
    }
}
