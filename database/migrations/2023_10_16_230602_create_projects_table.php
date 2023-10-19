<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id('projectID');
            $table->string('projectName');
            $table->unsignedBigInteger('projectCreator');
            $table->text('description')->nullable();
            $table->boolean('isOpen');
            $table->timestamps();
            $table->foreign('projectCreator')->references('userID')->on('users');
            
        });
    }

    public function down()
    {
        Schema::dropIfExists('projects');
    }
}

