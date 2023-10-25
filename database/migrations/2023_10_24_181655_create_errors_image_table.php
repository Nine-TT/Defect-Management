<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateErrorsImageTable extends Migration
{
    public function up()
    {
        Schema::create('errors_image', function (Blueprint $table) {
            $table->id('ErrorsImageID');
            $table->unsignedBigInteger('errorID');
            $table->string('imagePath');
            $table->timestamps();
            $table->foreign('errorID')->references('errorID')->on('errors');
        });
    }

    public function down()
    {
        Schema::dropIfExists('errors_image');
    }
}

