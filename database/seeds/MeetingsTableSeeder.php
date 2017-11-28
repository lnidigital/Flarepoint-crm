<?php

use Illuminate\Database\Seeder;

class MeetingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('meetings')->insert(array (
            0 =>
            array (
                'id' => 1,
                'meeting_date' => '2017-11-15 12:00:00',
                'meeting_notes' => 'Group 1 Meeting',
                'group_id' => 1
            ),
            1 =>
            array (
                'id' => 2,
                'meeting_date' => '2017-11-15 12:00:00',
                'meeting_notes' => 'Group 2 meeting',
                'group_id' => 2
            )
        ));
    }
}
