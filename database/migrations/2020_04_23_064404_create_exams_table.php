<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exams', function (Blueprint $table) {
            $table->bigIncrements('exam_id');
            $table->unsignedBigInteger('organization_id');
            $table->foreign('organization_id')->references('organization_id')->on('organizations');
            $table->string('title');
            $table->string('prepared_by')->references('teacher_id')->on('teachers');
            $table->string('written_by')->references('student_id')->on('students');
            $table->integer('total_marks');

            $table->datetime('asses_start_by')->nullable(false);
            $table->datetime('asses_end_by')->nullable(false);
            $table->integer('duration')->nullable(false);
            $table->integer('total_weight')->nullable(false);
            $table->tinyInteger('camera_capture')->default(0);
            $table->tinyInteger('continous_capture')->default(0);
            $table->integer('camera_interval')->default(0);
            $table->text('exam_intructions')->nullable();
            $table->tinyInteger('start_exam_sharp')->default(1);
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
        Schema::dropIfExists('exams');
    }
}