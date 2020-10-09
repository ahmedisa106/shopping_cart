<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryServiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_service', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('status')->default(1)->comment("0 = inActive , 1 = active");
            $table->string('photo');
            $table->timestamps();
        });


        Schema::create('category_service_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_service_id')->unsigned();
            $table->string('title');
            $table->string('description');
            $table->string('locale')->index();
            $table->unique(['category_service_id', 'locale']);
            $table->foreign('category_service_id')->references('id')->on('category_service')->onDelete('cascade');

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
        Schema::dropIfExists('category_service');
        Schema::dropIfExists('category_service_translations');
    }
}
