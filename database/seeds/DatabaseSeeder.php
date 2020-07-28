<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    protected $toTruncate = ['activities', 'agenda', 'team'];

    public function run()
    {
        Model::unguard();

        if (App::environment('local')) {
            foreach($this->toTruncate as $table) {
                DB::table($table)->truncate();
            }

            $this->call(MembersTableSeeder::class);
            $this->call(PagesTableSeeder::class);
            $this->call(RolesTableSeeder::class);
            $this->call(PermissionsTableSeeder::class);
            $this->call(TasksTableSeeder::class);
            $this->call(StatusTableSeeder::class);
            $this->call(FormulaireContactsTableSeeder::class);
            $this->call(ActivitiesTableSeeder::class);
            $this->call(AgendaTableSeeder::class);
            $this->call(CalendarTableSeeder::class);
            $this->call(LawyersOfficeTableSeeder::class);
            $this->call(LawyersTableSeeder::class);
            $this->call(PermanencesTableSeeder::class);
            $this->call(SiteParametersTableSeeder::class);
            $this->call(TeamTableSeeder::class);
        }

        Model::reguard();
    }
}
