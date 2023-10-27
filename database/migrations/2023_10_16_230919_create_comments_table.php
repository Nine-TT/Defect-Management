<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id('commentID');
            $table->unsignedBigInteger('errorID');
            $table->unsignedBigInteger('userID');
            $table->text('content');
            $table->string('type');
            $table->timestamps();
            $table->foreign('errorID')->references('errorID')->on('errors');
            $table->foreign('userID')->references('userID')->on('users');
        });
    }

    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
