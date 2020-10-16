<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostaddsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('postadds', function (Blueprint $table) {
            $table->increments('postadd_id');
            $table->string('make');
            $table->string('model');
            $table->string('trim');
            $table->string('year');
            $table->string('mileage');
            $table->string('engine_size');
            $table->string('drive_terrain');
            $table->string('transmission');
            $table->string('fuel_type');
            $table->string('condition');
            $table->string('price');
            $table->string('contact');
            $table->string('city');
            $table->string('title');
            $table->string('description');
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
        Schema::dropIfExists('postadds');
    }
}
