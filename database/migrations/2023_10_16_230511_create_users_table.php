<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id('userID');
            $table->string('firstName');
            $table->string('lastName');
            $table->date('birthday');
            $table->string('address');
            $table->string('gender');
            $table->string('phoneNumber')->nullable();
            $table->string('username');
            $table->text('password');
            $table->text('urlImage')->nullable();
            $table->boolean('isActive');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}
