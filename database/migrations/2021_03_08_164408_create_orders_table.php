<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('amount')->default(0);
            $table->double('total')->default(0);
            $table->tinyInteger('status')->default(0)->comment('0=new1=accept 2=finsh3=canceled');
            $table->tinyInteger('is_payied')->default(0)->comment('0=new1=accept 2=finsh3=canceled');
            $table->tinyInteger('pay_type')->default(1)->comment('1=cach 2=payment');
            $table->unsignedBigInteger('from_id')->nullable();
            $table->foreign('from_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('to_id')->nullable();
            $table->foreign('to_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('orders');
    }
}
