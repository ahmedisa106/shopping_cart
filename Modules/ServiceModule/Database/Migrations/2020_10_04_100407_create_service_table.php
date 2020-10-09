<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('service_cat_id')->unsigned();
            $table->string('photo')->nullable();
            $table->string('cover')->nullable();
            $table->tinyInteger('status')->default('1')->comment("0 = active , 1 = inactive");
            $table->foreign('service_cat_id')->references('id')->on('category_service')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('service_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('description');
            $table->integer('service_id')->unsigned();
            $table->string('locale')->index();
            $table->unique(['service_id', 'locale']);
            $table->foreign('service_id')->references('id')->on('service')->onDelete('cascade');


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
        Schema::dropIfExists('service');
        Schema::dropIfExists('service_translations');
    }
}
