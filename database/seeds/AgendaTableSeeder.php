<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class AgendaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('agenda')->delete();

        $agenda = array(
            ['id' => 1, 'title' => '11 Septembre 2017', 'content' => 'Assemblée générale constitutive', 'image_path' => '/images/agenda/assemblee.jpg', 'is_published' => true, 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['id' => 2, 'title' => '17 Septembre 2017', 'content' => 'Dépôt du recours abstrait au Tribunal fédéral à l\'encontre la loi portant modification de la loi sur les autorités de protection de l\'enfant et de l\'adulte (LAPEA)', 'image_path' => '/images/agenda/recours.jpg', 'is_published' => true, 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['id' => 3, 'title' => 'Dimanche 15 Octobre 2017, Dès 11h', 'content' => 'Apéritif commun avec l\'ANAS au Parc de Pierre-à-Bot. En cas de mauvais temps, une fondue au fromage à la Pinte de Pierre-à-Bot sera une alternative gourmande', 'image_path' => '/images/agenda/aperitif.jpg', 'is_published' => true, 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['id' => 4, 'title' => 'Mercredi 22 Novembre 2017', 'content' => 'Le Jeune Barreau est fier de dévoiler son nouveau logo qui met en avant l\'héritage de la profession d\'avocat associé à du lettrage moderne et épuré', 'image_path' => '/images/agenda/logo.jpg', 'is_published' => true, 'created_at' => new DateTime, 'updated_at' => new DateTime],
        );

        DB::table('agenda')->insert($agenda);
    }
}
