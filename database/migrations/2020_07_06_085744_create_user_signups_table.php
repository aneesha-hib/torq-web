<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserSignupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_signups', function (Blueprint $table) {
            $table->increments('user_id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('code');
            $table->string('phone');
            $table->string('email');
            $table->string('password');
            $table->string('confirm_password');
            $table->string('ProfileImage');
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
        Schema::dropIfExists('user_signups');
    }
}
