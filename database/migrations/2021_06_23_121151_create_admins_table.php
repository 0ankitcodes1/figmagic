<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string("name", 100)->nullable();
            $table->string("email", 100)->unique();
            $table->string("password", 255);
            $table->string("companyName", 255)->nullable();
            $table->string("role", 100)->nullable();
            $table->string("token", 255)->unique()->nullable();
            $table->string("profilePic")->nullable();
            $table->integer("apiLimiter");
            $table->string("verificationCode");
            $table->integer("shareCount");
            $table->string("status", 16);
            $table->string("identifier", 32);
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
        Schema::dropIfExists('admins');
    }
}
