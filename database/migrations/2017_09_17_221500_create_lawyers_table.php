<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLawyersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lawyers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('lawyer_office_id')->nullable()->unsigned();
            // $table->foreign('lawyer_office_id')->references('id')->on('lawyers_office')
                // ->onUpdate('cascade')->onDelete('cascade');
            $table->string('firstname')->nullable();
            $table->string('lastname')->nullable();
            $table->string('username')->unique();
            $table->string('email')->default('')->index();
            $table->string('password');
            $table->string('phone_mobile')->nullable();
            $table->string('languages')->nullable();
            // $table->string('street')->nullable();
            // $table->string('city')->nullable();
            // $table->string('phone_office')->nullable();
            // $table->string('fax_office')->nullable();
            $table->boolean('is_confirmed')->default(false);
            $table->string('confirmation_code')->nullable();
            $table->rememberToken();
            $table->boolean('is_verified')->default(false);
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
        Schema::dropIfExists('lawyers');
    }
}
