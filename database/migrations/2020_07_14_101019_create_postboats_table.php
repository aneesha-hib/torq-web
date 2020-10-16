<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostboatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('postboats', function (Blueprint $table) {
            $table->increments('postboat_id');
            $table->string('type');
            $table->string('make');
            $table->string('condition');
            $table->string('price');
            $table->string('contact');
            $table->string('city');
            $table->string('title');
            $table->string('description');
            $table->string('image');
            $table->string('image2');
            $table->string('image3');
            $table->string('image4');
            $table->string('image5');
            $table->string('image6');
            $table->string('image7');
            $table->string('image8');
            $table->string('vehicleType');
            $table->integer('user_id');
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
        Schema::dropIfExists('postboats');
    }
}
