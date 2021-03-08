<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('ar_title')->nullable();
            $table->string('en_title')->nullable();
            $table->string('ar_des')->nullable();
            $table->string('en_des')->nullable();
            $table->string('image')->nullable();
            $table->double('price')->default(0);
            $table->double('quntity')->default(0);
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
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
        Schema::dropIfExists('products');
    }
}
