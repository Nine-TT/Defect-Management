<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectMemberTable extends Migration
{
    public function up()
    {
        Schema::create('projectMembers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('userID');
            $table->unsignedBigInteger('projectID');
            $table->string('role');
            $table->timestamps();

            $table->foreign('userID')->references('userID')->on('users');
            $table->foreign('projectID')->references('projectID')->on('projects');
        });
    }

    public function down()
    {
        Schema::dropIfExists('projectMembers');
    }
}
