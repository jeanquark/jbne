<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class FormulaireContactsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('formulaire_contacts')->delete();

        $faker = Faker\Factory::create();

        // $contacts = array(
        //     [
        //         'id' => 1, 
        //         'prenom' => $faker->firstName, 
        //         'nom' => $faker->lastName, 
        //         'email' => $faker->email, 
        //         'message' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true), 
        //         'created_at' => new DateTime
        //     ]
        // );
        $contacts = array(
            ['id' => 1, 'prenom' => 'John', 'nom' => 'Doe', 'email' => 'john.doe@example.com', 'message' => 'Quia voluptas accusantium ipsum quasi possimus vel. Aut saepe enim quisquam ullam voluptatem aspernatur. Est ea neque veniam eum non quod. Aliquid temporibus quod non voluptatem.', 'created_at' => '2017-09-10 20:58:40', 'updated_at' => new DateTime],
            ['id' => 2, 'prenom' => 'Jane', 'nom' => 'Doe', 'email' => 'jane.doe@example.com', 'message' => 'Chers Confrères, Je vous saurais gré de bien vouloir accepter les baba(s) au rhum en votre sein ! Merci d\'aborder ce thème dans l\'ordre du jour ce soir. A défaut, préparez-vous à un esclandre de large envergure. Me Baba Urhum', 'created_at' => '2017-09-11 09:38:20', 'updated_at' => '2017-09-11 09:38:20'],
        );

        DB::table('formulaire_contacts')->insert($contacts);
    }
}
