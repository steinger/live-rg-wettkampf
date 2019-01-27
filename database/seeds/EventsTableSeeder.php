<?php

use Illuminate\Database\Seeder;

class EventsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('events')->insert(
        [
            'name' => 'Berner Kantonalmeisterschaft - Championnat cantonal bernois, '. date("d. F Y"),
            'file' => '',
            'ranking' => 1,
            'created_at' => date("Y-m-d H:i:s")
        ]
      );
    }
}
