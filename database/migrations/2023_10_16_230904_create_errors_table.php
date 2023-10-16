<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateErrorsTable extends Migration
{
    public function up()
    {
        Schema::create('errors', function (Blueprint $table) {
            $table->id('errorID');
            $table->text('issueName');
            $table->text('describe')->nullable();
            $table->string('status');
            $table->unsignedBigInteger('assignedTo');
            $table->datetime('estimateTime');
            $table->unsignedBigInteger('reporter');
            $table->unsignedBigInteger('testTypeID');
            $table->unsignedBigInteger('errorTypeID');
            $table->timestamps();

            $table->foreign('assignedTo')->references('userID')->on('users');
            $table->foreign('reporter')->references('userID')->on('users');
            $table->foreign('testTypeID')->references('testTypeID')->on('testTypes');
            $table->foreign('errorTypeID')->references('errorTypeID')->on('errorTypes');
        });
    }

    public function down()
    {
        Schema::dropIfExists('errors');
    }
}

