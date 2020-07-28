<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('status_id')->unsigned()->index();
            $table->string('name')->default('');
            $table->string('description')->default('');
            $table->integer('progress')->default(0);
            $table->timestamps();
        });

        // Schema::create('task_users', function (Blueprint $table) {
        //     $table->increments('id');
        //     $table->integer('task_id')->unsigned()->index();
        //     $table->integer('user_id')->unsigned()->index();
        //     $table->timestamps();
        // });


        Schema::create('task_member', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('task_id')->unsigned()->index();
            $table->integer('member_id')->unsigned()->index();
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
        Schema::dropIfExists('task_users');
        Schema::dropIfExists('tasks');

        Schema::dropIfExists('task_member');
    }
}
