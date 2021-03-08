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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->tinyInteger('type')->default(1)->comment('1=customer2=market');
            $table->string('ar_title')->nullable();
            $table->string('en_title')->nullable();
            $table->string('image')->nullable();
            $table->string('banner')->nullable();
            $table->string('phone_code')->nullable();
            $table->string('phone')->nullable();
            $table->tinyInteger('is_block')->default(0);
            $table->double('latitude')->default(0);
            $table->double('longitude')->default(0);
            $table->string('email')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
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
