<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrganizationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organizations', function (Blueprint $table) {
            $table->bigIncrements('organization_id');
            $table->unsignedBigInteger('city_id');
            $table->foreign('city_id')->references('city_id')->on('cities');
            $table->string('title');
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('logo')->nullable();
            $table->string('address')->nullable();
            $table->string('pincode')->nullable();
            $table->string('landmark')->nullable();
            $table->date('established')->nullable();
            $table->string('website')->nullable();
            $table->string('affiliation_number')->nullable();
            $table->string('managing_committe')->nullable();
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
        Schema::dropIfExists('organizations');
    }
}
