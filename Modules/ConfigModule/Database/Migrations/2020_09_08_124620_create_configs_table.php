<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('var');
            $table->integer('is_static')->default(0);
            $table->string('static_value')->nullable();
            $table->tinyInteger('type');
            $table->integer('cat_id')->unsigned();
            $table->foreign('cat_id')->references('id')->on('configCategories')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('config_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('config_id')->unsigned();
            $table->string('display_name');
            $table->text('value')->nullable();
            $table->string('locale')->index();
            $table->unique(['config_id', 'locale']);
            $table->foreign('config_id')->references('id')->on('configs')->onDelete('cascade');
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
        Schema::dropIfExists('configs');
        Schema::dropIfExists('config_translations');
    }
}
