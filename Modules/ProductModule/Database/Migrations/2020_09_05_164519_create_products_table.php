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
            $table->increments('id');
            $table->string('photo')->nullable();
            $table->double('sell_price')->default(0);
            $table->double('price_before_discount')->default(0);
            $table->integer('current_quantity')->default(0);
            $table->integer('type')->default(0);  /* 0 => default , 1 => featured , 2 => best rated , 3 => deal of week */
            $table->integer('active')->default(1);
            $table->timestamps();
        });
        Schema::create('product_translations', function (Blueprint $table) {
            $table->increments('id')->nullable();
            $table->string('title')->nullable();
            $table->integer('product_id')->unsigned()->nullable();
            $table->string('description')->nullable();
            $table->string('slug')->nullable();
            $table->string('locale')->index();
            $table->unique(['product_id', 'locale']);
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');


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
        Schema::dropIfExists('product_translations');

    }
}
