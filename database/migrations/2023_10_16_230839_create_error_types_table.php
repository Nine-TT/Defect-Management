<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateErrorTypesTable extends Migration
{
    public function up()
    {
        Schema::create('errorTypes', function (Blueprint $table) {
            $table->id('errorTypeID');
            $table->string('typeName');
            $table->unsignedBigInteger('projectID');
            $table->foreign('projectID')->references('projectID')->on('projects'); // Khóa ngoại đến bảng projects
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('errorTypes');
    }
}
