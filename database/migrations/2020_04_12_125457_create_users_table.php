<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // DONE
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('user_id');
            // FK
            $table->unsignedInteger('role_id');
            $table->foreign('role_id')->references('role_id')->on('roles');
            $table->unsignedBigInteger('organization_id')->nullable();
            $table->foreign('organization_id')->references('organization_id')->on('organizations');
            
            $table->string('name');
            $table->string('email')->unique();
            $table->string('roll_no')->nullable();
            $table->string('password');
            $table->string('phone');
            $table->string('profile_pic')->nullable();
            $table->timestamp('email_verified_at')->nullable();
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
        Schema::dropIfExists('users');
    }
}
