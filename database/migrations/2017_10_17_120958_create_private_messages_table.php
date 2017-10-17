<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrivateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('private_messages', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('sender_id')->index();
            $table->unsignedInteger('receiver_id')->index();
            $table->string('subject', 155);
            $table->text('message');
            $table->unsignedTinyInteger('read')->default(0);
            $table->timestamps();

            $table->index(['sender_id', 'read']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('private_messages');
    }
}
