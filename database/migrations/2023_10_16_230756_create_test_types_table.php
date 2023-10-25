<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestTypesTable extends Migration
{
    public function up()
    {
        Schema::create('testTypes', function (Blueprint $table) {
            $table->id('testTypeID');
            $table->string('typeName');
            $table->unsignedBigInteger('projectID');
            $table->foreign('projectID')->references('projectID')->on('projects'); // Khóa ngoại đến bảng projects
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('testTypes');
    }
}
