<?php

use Illuminate\Database\Seeder;

class ResultsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('results')->insert(
          [
              'event_id' => 1,
              'rgid' => 102001,
              'apparatus_short' => 'U1',
              'startno' => 601,
              'name' => 'RG Gruppe 1',
              'category' => 'G4',
              'competition_type' => 'MK',
              'apparatus' => 'Keulen/Reif 1',
              'f_score' => '9.400',
              'd_score' => '4.500',
              'e_score' => '5.200',
              'penalty' => 'Abzug:-0.300',
              'created_at' => date("Y-m-d H:i:s", strtotime(date("Y-m-d H:i:s").'- 30 minute')),
              'updated_at' => date("Y-m-d H:i:s", strtotime(date("Y-m-d H:i:s").'- 30 minute')),
          ]
        );
        DB::table('results')->insert(
          [
              'event_id' => 1,
              'rgid' => 101001,
              'apparatus_short' => 'BD',
              'startno' => 401,
              'name' => 'Ann Muster',
              'category' => 'P4',
              'competition_type' => 'MK',
              'apparatus' => 'Band',
              'f_score' => '7.850',
              'd_score' => '5.100',
              'e_score' => '2.750',
              'penalty' => '',
              'created_at' => date("Y-m-d H:i:s", strtotime(date("Y-m-d H:i:s").'- 25 minute')),
              'updated_at' => date("Y-m-d H:i:s", strtotime(date("Y-m-d H:i:s").'- 25 minute')),
          ]
        );
        DB::table('results')->insert(
          [
              'event_id' => 1,
              'rgid' => 101002,
              'apparatus_short' => 'BL',
              'startno' => 402,
              'name' => 'Noëlle Müller',
              'category' => 'P4',
              'competition_type' => 'MK',
              'apparatus' => 'Ball',
              'f_score' => '10.350',
              'd_score' => '6.400',
              'e_score' => '3.950',
              'penalty' => '',
              'created_at' => date("Y-m-d H:i:s", strtotime(date("Y-m-d H:i:s").'- 20 minute')),
              'updated_at' => date("Y-m-d H:i:s", strtotime(date("Y-m-d H:i:s").'- 20 minute')),
          ]
        );
        DB::table('results')->insert(
          [
              'event_id' => 1,
              'rgid' => 101003,
              'apparatus_short' => 'RF',
              'startno' => 403,
              'name' => 'Sophie Smith',
              'category' => 'P4',
              'competition_type' => 'MK',
              'apparatus' => 'Reif',
              'f_score' => '14.800',
              'd_score' => '8.000',
              'e_score' => '6.950',
              'penalty' => 'Abzug:-0.150',
              'created_at' => date("Y-m-d H:i:s", strtotime(date("Y-m-d H:i:s").'- 15 minute')),
              'updated_at' => date("Y-m-d H:i:s", strtotime(date("Y-m-d H:i:s").'- 15 minute')),
          ]
        );
        DB::table('results')->insert(
          [
              'event_id' => 1,
              'rgid' => 101004,
              'apparatus_short' => 'BD',
              'startno' => 404,
              'name' => 'Felicia Meier',
              'category' => 'P4',
              'competition_type' => 'MK',
              'apparatus' => 'Ruban',
              'f_score' => '8.550',
              'd_score' => '3.000',
              'e_score' => '5.600',
              'penalty' => 'Déduction:-0.050',
              'created_at' => date("Y-m-d H:i:s", strtotime(date("Y-m-d H:i:s").'- 10 minute')),
              'updated_at' => date("Y-m-d H:i:s", strtotime(date("Y-m-d H:i:s").'- 10 minute')),
          ]
        );
        DB::table('results')->insert(
          [
              'event_id' => 1,
              'rgid' => 101005,
              'apparatus_short' => 'KL',
              'startno' => 405,
              'name' => 'Sibile Annemarie Wildeisen',
              'category' => 'P4',
              'competition_type' => 'MK',
              'apparatus' => 'Keulen',
              'f_score' => '11.600',
              'd_score' => '5.900',
              'e_score' => '5.700',
              'penalty' => '',
              'created_at' => date("Y-m-d H:i:s", strtotime(date("Y-m-d H:i:s").'- 5 minute')),
              'updated_at' => date("Y-m-d H:i:s", strtotime(date("Y-m-d H:i:s").'- 5 minute')),
          ]
        );
        DB::table('results')->insert(
          [
              'event_id' => 1,
              'rgid' => 101006,
              'apparatus_short' => 'BL',
              'startno' => 401,
              'name' => 'Ann Muster',
              'category' => 'P4',
              'competition_type' => 'MK',
              'apparatus' => 'Ball',
              'f_score' => '14.350',
              'd_score' => '5.800',
              'e_score' => '8.550',
              'penalty' => '',
              'created_at' => date("Y-m-d H:i:s", strtotime(date("Y-m-d H:i:s").'- 1 minute')),
              'updated_at' => date("Y-m-d H:i:s", strtotime(date("Y-m-d H:i:s").'- 1 minute')),
          ]
        );
    }
}
