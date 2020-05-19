<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQueBanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('que_banks', function (Blueprint $table) {
            $table->bigIncrements('que_bank_id');
            $table->unsignedBigInteger('organization_id');
            $table->foreign('organization_id')->references('organization_id')->on('organizations');
            $table->string('name');
            $table->longText('rules'); 
            $table->text('description');
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
        Schema::dropIfExists('que_banks');
    }
}
