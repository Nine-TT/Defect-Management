<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateErrorsTable extends Migration
{
    public function up()
    {
        Schema::create('errors', function (Blueprint $table) {
            $table->id('errorID'); // Trường ID của lỗi
            $table->string('errorName'); // Tên của lỗi
            $table->text('description'); // Mô tả chi tiết về lỗi
            $table->string('status'); // Trạng thái của lỗi (Error, Pending, Tested, Closed)
            $table->unsignedBigInteger('assignedTo')->nullable(); // Người được giao xử lý lỗi (khóa ngoại)
            $table->datetime('estimateTime')->nullable(); // Thời gian dự kiến hoàn thành sửa lỗi
            $table->unsignedBigInteger('reporter')->nullable(); // Người báo cáo lỗi (khóa ngoại)
            $table->unsignedBigInteger('testTypeID')->nullable(); // Loại kiểm thử của lỗi (khóa ngoại)
            $table->unsignedBigInteger('errorTypeID')->nullable(); // Loại lỗi (khóa ngoại)
            $table->text('stepsToReproduce'); // Bước để tái tạo lỗi
            $table->text('expectedResult'); // Kết quả mong đợi sau khi sửa lỗi
            $table->text('actualResult'); // Kết quả thực tế sau khi kiểm tra lỗi
            $table->string('priority'); // Mức độ ưu tiên (Cao, Trung bình, Thấp)
            $table->unsignedBigInteger('projectID'); // Thêm trường projectID
            $table->timestamps(); // Thời gian tạo và cập nhật
            $table->foreign('assignedTo')->references('userID')->on('users'); // Khóa ngoại đến bảng người dùng
            $table->foreign('reporter')->references('userID')->on('users'); // Khóa ngoại đến bảng người dùng
            $table->foreign('testTypeID')->references('testTypeID')->on('testTypes'); // Khóa ngoại đến bảng loại kiểm thử
            $table->foreign('errorTypeID')->references('errorTypeID')->on('errorTypes'); // Khóa ngoại đến bảng loại lỗi
            $table->foreign('projectID')->references('projectID')->on('projects'); // Khóa ngoại đến bảng projects
        });
    }

    public function down()
    {
        Schema::dropIfExists('errors'); // Xóa bảng lỗi
    }
}

