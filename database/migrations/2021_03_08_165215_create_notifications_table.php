<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('from_id')->nullable();
            $table->bigInteger('to_id')->nullable();
            $table->tinyInteger('type')->default(0);
            $table->integer('order_id')->nullable();
            $table->integer('notification_date');
            $table->integer('status')->default(0);
            $table->integer('is_read')->default(0);
            $table->integer('notification_id')->default(0);
            $table->integer('is_deleted')->default(0);
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
        Schema::dropIfExists('notifications');
    }
}
