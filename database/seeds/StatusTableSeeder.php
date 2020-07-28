<?php

use Illuminate\Database\Seeder;

use Carbon\Carbon;

class StatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('status')->delete();

        $status = array(
            ['id' => 1, 'name' => 'En cours', 'slug' => 'encours', 'color' => 'info', 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['id' => 2, 'name' => 'A faire', 'slug' => 'afaire', 'color' => 'primary', 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['id' => 3, 'name' => 'En attente', 'slug' => 'enattente', 'color' => 'warning', 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['id' => 4, 'name' => 'Terminé', 'slug' => 'termine', 'color' => 'success', 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['id' => 5, 'name' => 'Suspendu', 'slug' => 'suspendu', 'color' => 'danger', 'created_at' => new DateTime, 'updated_at' => new DateTime]
        );

        DB::table('status')->insert($status);
    }
}
