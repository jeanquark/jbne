<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCalendarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calendar', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('year')->default(0);
            $table->integer('quarter')->default(0);
            $table->string('month')->default('');
            $table->string('week1')->default('');
            $table->integer('week1_nb');
            $table->string('week2')->default('');
            $table->integer('week2_nb');
            $table->string('week3')->default('');
            $table->integer('week3_nb');
            $table->string('week4')->default('');
            $table->integer('week4_nb');
            $table->string('week5')->nullable();
            $table->integer('week5_nb')->nullable()->unsigned();
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
        Schema::dropIfExists('calendar');
    }
}
