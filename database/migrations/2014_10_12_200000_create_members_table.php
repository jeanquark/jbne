<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->increments('id');
            $table->string('firstname')->default('');
            $table->string('lastname')->default('');
            $table->string('email')->default('');
            $table->string('password');
            $table->string('rue')->default('');
            $table->string('localite')->default('');
            $table->string('type')->default('');
            $table->string('statut')->default('');
            $table->string('date_inscription_barreau')->nullable();
            $table->string('date_debut_stage')->nullable();
            $table->string('date_fin_stage')->nullable();
            $table->boolean('is_active')->default(0);
            $table->integer('emails_sent')->unsigned()->default(0);
            $table->rememberToken();
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
        Schema::dropIfExists('members');
    }
}
