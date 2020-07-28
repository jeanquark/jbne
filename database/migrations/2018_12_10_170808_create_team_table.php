<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeamTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('team', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->default('');
            $table->string('firstname')->default('');
            $table->string('lastname')->default('');
            $table->string('status')->default('');
            $table->string('image_path')->default('');
            $table->string('email')->nullable();
            $table->string('website')->nullable();
            $table->string('linkedIn')->nullable();
            $table->boolean('is_published')->default(0);
            $table->smallInteger('order_of_appearance');
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
        Schema::dropIfExists('team');
    }
}
