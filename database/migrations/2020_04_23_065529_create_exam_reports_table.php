<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExamReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam_reports', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->enum('file_type', ['Organization Logo','User Profile Photo']);
            $table->unsignedBigInteger('organization_id');
            $table->foreign('organization_id')->references('organization_id')->on('organizations');
            $table->unsignedBigInteger('file_type_id')->nullable();
            $table->unsignedBigInteger('teacher_id');
            $table->foreign('teacher_id')->references('teacher_id')->on('teachers');
            $table->unsignedBigInteger('student_id');
            $table->foreign('student_id')->references('student_id')->on('students');
            $table->float('total_marks');
            $table->float('obtained_marks');
            $table->float('percentage');
            $table->string('grade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exam_reports');
    }
}