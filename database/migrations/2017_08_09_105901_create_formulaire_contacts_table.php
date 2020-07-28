<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormulaireContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (App::environment('local')) {
            Schema::create('formulaire_contacts', function (Blueprint $table) {
                $table->increments('id');
                $table->string('nom')->nullable();
                $table->string('prenom')->nullable();
                $table->string('email')->nullable();
                $table->text('message')->nullable();
                $table->boolean('is_read')->default(false);
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (App::environment('local')) {
            Schema::dropIfExists('formulaire_contacts');
        }
    }
}
