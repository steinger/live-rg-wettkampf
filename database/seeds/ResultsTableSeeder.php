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
              'apparatus' => 'U1',
              'startno' => 601,
              'name' => 'RG Gruppe G4',
              'body' => 'Keulen/Reif 2 9.400, D:4.500, E:5.200, Abzug:-0.300',
              'created_at' => date("Y-m-d H:i:s", strtotime(date("Y-m-d H:i:s").'- 30 minute')),
              'updated_at' => date("Y-m-d H:i:s", strtotime(date("Y-m-d H:i:s").'- 30 minute')),
          ]
        );
        DB::table('results')->insert(
          [
              'event_id' => 1,
              'rgid' => 101001,
              'apparatus' => 'BD',
              'startno' => 401,
              'name' => 'Ann Muster P4',
              'body' => 'Band 7.850, D:5.100, E:2.750',
              'created_at' => date("Y-m-d H:i:s", strtotime(date("Y-m-d H:i:s").'- 25 minute')),
              'updated_at' => date("Y-m-d H:i:s", strtotime(date("Y-m-d H:i:s").'- 25 minute')),
          ]
        );
        DB::table('results')->insert(
          [
              'event_id' => 1,
              'rgid' => 101002,
              'apparatus' => 'BL',
              'startno' => 402,
              'name' => 'Noëlle Müller P4',
              'body' => 'Ball 10.350, D:6.400, E:3.950',
              'created_at' => date("Y-m-d H:i:s", strtotime(date("Y-m-d H:i:s").'- 20 minute')),
              'updated_at' => date("Y-m-d H:i:s", strtotime(date("Y-m-d H:i:s").'- 20 minute')),
          ]
        );
        DB::table('results')->insert(
          [
              'event_id' => 1,
              'rgid' => 101003,
              'apparatus' => 'RF',
              'startno' => 403,
              'name' => 'Sophie Smith P4',
              'body' => 'Reif 14.800, D:8.000, E:6.950, Abzug:-0.150',
              'created_at' => date("Y-m-d H:i:s", strtotime(date("Y-m-d H:i:s").'- 15 minute')),
              'updated_at' => date("Y-m-d H:i:s", strtotime(date("Y-m-d H:i:s").'- 15 minute')),
          ]
        );
        DB::table('results')->insert(
          [
              'event_id' => 1,
              'rgid' => 101004,
              'apparatus' => 'KL',
              'startno' => 404,
              'name' => 'Felicia Meier P4',
              'body' => 'Keulen 11.600, D:5.900, E:5.700',
              'created_at' => date("Y-m-d H:i:s", strtotime(date("Y-m-d H:i:s").'- 10 minute')),
              'updated_at' => date("Y-m-d H:i:s", strtotime(date("Y-m-d H:i:s").'- 10 minute')),
          ]
        );
        DB::table('results')->insert(
          [
              'event_id' => 1,
              'rgid' => 101005,
              'apparatus' => 'KL',
              'startno' => 405,
              'name' => 'Sibile Annemarie Wildeisen P4',
              'body' => 'Keulen 11.600, D:5.900, E:5.700',
              'created_at' => date("Y-m-d H:i:s", strtotime(date("Y-m-d H:i:s").'- 5 minute')),
              'updated_at' => date("Y-m-d H:i:s", strtotime(date("Y-m-d H:i:s").'- 5 minute')),
          ]
        );
        DB::table('results')->insert(
          [
              'event_id' => 1,
              'rgid' => 101006,
              'apparatus' => 'BL',
              'startno' => 401,
              'name' => 'Ann Muster P4',
              'body' => 'Ball 14.350, D:5.800, E:8.550',
              'created_at' => date("Y-m-d H:i:s", strtotime(date("Y-m-d H:i:s").'- 1 minute')),
              'updated_at' => date("Y-m-d H:i:s", strtotime(date("Y-m-d H:i:s").'- 1 minute')),
          ]
        );
    }
}
