<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQueOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('que_options', function (Blueprint $table) {
            $table->bigIncrements('que_option_id');
            $table->unsignedBigInteger('que_id');
            $table->foreign('que_id')->references('que_id')->on('questions');
            $table->string('title')->nullable(false);
            $table->float('weightage')->nullable();
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
        Schema::dropIfExists('que_options');
    }
}