<?php

use Illuminate\Database\Seeder;

use Carbon\Carbon;

class SiteParametersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('site_parameters')->delete();

        $parameters = array(
            ['id' => 1, 'name' => 'display_next_quarter_attributions', 'value' => '', 'boolean_value' => true, 'created_at' => new DateTime, 'updated_at' => new DateTime]
        );

        DB::table('site_parameters')->insert($parameters);
    }
}
