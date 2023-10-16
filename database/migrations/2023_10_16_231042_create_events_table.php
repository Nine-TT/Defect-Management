<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id('eventID');
            $table->string('eventType');
            $table->text('eventDescription')->nullable();
            $table->datetime('eventDate');
            $table->unsignedBigInteger('userID');
            $table->unsignedBigInteger('errorID');
            $table->timestamps();

            $table->foreign('userID')->references('userID')->on('users');
            $table->foreign('errorID')->references('errorID')->on('errors');
        });
    }

    public function down()
    {
        Schema::dropIfExists('events');
    }
}
