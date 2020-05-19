<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQueLevelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('que_levels', function (Blueprint $table) {
            $table->bigIncrements('que_level_id');
            $table->unsignedBigInteger('organization_id');
            $table->foreign('organization_id')->references('organization_id')->on('organizations');
            $table->string('name')->nullable(false);
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
        Schema::dropIfExists('que_levels');
    }
}
