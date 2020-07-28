<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ActivitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('activities')->delete();

        $activities = array(
            ['id' => 1, 'title' => 'Recours abstrait contre la nouvell LAPEA', 'content' => 'Opposé à la nouvelle méthode de rémunération des curateurs adoptée par le Conseil d’Etat le 18 août 2017, le Jeune Barreau, fraîchement constitué, a instigué une campagne de mobilisation à son encontre puis a permis, avec l’aide de l’Ordre des Avocats Neuchâtelois et d’autres professionnels, à déférer la question de cette modification législative par-devant le Tribunal fédéral.', 'image_path' => '/images/activities/recours.jpg', 'is_published' => true, 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['id' => 2, 'title' => 'Permanence des Avocats de la première heure', 'content' => 'Aujourd’hui, mis en place par l’Ordre des Avocats Neuchâtelois, ce service de piquet garantit à tout justiciable, prévenu ou personne appelée à donner des renseignements dans une procédure pénale, le droit inconditionnel de demander la présence d’un avocat pendant son audition.
                A compter de janvier 2018, le Jeune Barreau se verra confié cette honorable mission consistant à garantir la disponibilité 7 jours par semaine et 24 heures sur 24 d\'avocats aptes à se rendre en tous lieux du canton pour assister en urgence une personne qui va être interrogée, par exemple en cas d\'interpellation immédiate.', 'image_path' => '/images/activities/permanence.jpg', 'is_published' => true, 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['id' => 3, 'title' => 'Conférence et activités joviales', 'content' => 'A l’instar d’autres activités récréatives organisées par l’Ordre, le Jeune Barreau entend favoriser les contacts entre ses membres et leur permettre de se retrouver de façon conviviale dans le cadre de soirées thématiques, d’escapades extérieures ou encore lors de conférences autour d’un thème juridique d’actualité.', 'image_path' => '/images/activities/conferences.jpg', 'is_published' => true, 'created_at' => new DateTime, 'updated_at' => new DateTime],
        );

        DB::table('activities')->insert($activities);
    }
}
