<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->bigIncrements('que_id');
            $table->unsignedBigInteger('organization_id');
            $table->foreign('organization_id')->references('organization_id')->on('organizations');
            $table->unsignedBigInteger('que_bank_id');
            $table->foreign('que_bank_id')->references('que_bank_id')->on('que_banks');
            $table->unsignedBigInteger('que_level_id');
            $table->foreign('que_level_id')->references('que_level_id')->on('que_levels');
            $table->unsignedBigInteger('exam_id');
            $table->foreign('exam_id')->references('exam_id')->on('exams');
            $table->enum('que_type', ['Multi Choice','Single Choice']);
            $table->string('question')->nullable(false);
            $table->float('weight')->nullable(false);
            $table->float('negative_weightage')->nullable();
            $table->tinyInteger('status')->default(1);
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
        Schema::dropIfExists('questions');
    }
}