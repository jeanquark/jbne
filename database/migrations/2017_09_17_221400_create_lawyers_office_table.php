<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLawyersOfficeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lawyers_office', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('updated_by')->nullable()->unsigned();
            $table->string('name');
            $table->string('street');
            $table->string('city');
            $table->string('phone_office');
            $table->string('fax_office');
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
        Schema::dropIfExists('lawyers_office');
    }
}
