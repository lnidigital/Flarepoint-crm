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
            ),
            2 =>
            array (
                'id' => 3,
                'meeting_date' => '2017-1-10 12:00:00',
                'meeting_notes' => 'Group 1 Meeting',
                'group_id' => 6
            ),
            3 =>
            array (
                'id' => 4,
                'meeting_date' => '2017-1-24 12:00:00',
                'meeting_notes' => 'Group 2 meeting',
                'group_id' => 6
            ),
            4 =>
            array (
                'id' => 5,
                'meeting_date' => '2017-2-14 12:00:00',
                'meeting_notes' => 'Group 1 Meeting',
                'group_id' => 6
            ),
            5 =>
            array (
                'id' => 6,
                'meeting_date' => '2017-2-28 12:00:00',
                'meeting_notes' => 'Group 2 meeting',
                'group_id' => 6
            ),
            6 =>
            array (
                'id' => 7,
                'meeting_date' => '2017-3-14 12:00:00',
                'meeting_notes' => 'Group 1 Meeting',
                'group_id' => 6
            ),
            7 =>
            array (
                'id' => 8,
                'meeting_date' => '2017-3-28 12:00:00',
                'meeting_notes' => 'Group 2 meeting',
                'group_id' => 6
            ),
            8 =>
            array (
                'id' => 9,
                'meeting_date' => '2017-4-11 12:00:00',
                'meeting_notes' => 'Group 1 Meeting',
                'group_id' => 6
            ),
            9 =>
            array (
                'id' => 10,
                'meeting_date' => '2017-4-25 12:00:00',
                'meeting_notes' => 'Group 2 meeting',
                'group_id' => 6
            ),
            10 =>
            array (
                'id' => 11,
                'meeting_date' => '2017-5-9 12:00:00',
                'meeting_notes' => 'Group 1 Meeting',
                'group_id' => 6
            ),
            11 =>
            array (
                'id' => 12,
                'meeting_date' => '2017-5-23 12:00:00',
                'meeting_notes' => 'Group 2 meeting',
                'group_id' => 6
            ),
            12 =>
            array (
                'id' => 13,
                'meeting_date' => '2017-6-13 12:00:00',
                'meeting_notes' => 'Group 1 Meeting',
                'group_id' => 6
            ),
            13 =>
            array (
                'id' => 14,
                'meeting_date' => '2017-6-27 12:00:00',
                'meeting_notes' => 'Group 2 meeting',
                'group_id' => 6
            ),
            14 =>
            array (
                'id' => 15,
                'meeting_date' => '2017-7-11 12:00:00',
                'meeting_notes' => 'Group 1 Meeting',
                'group_id' => 6
            ),
            15 =>
            array (
                'id' => 16,
                'meeting_date' => '2017-7-25 12:00:00',
                'meeting_notes' => 'Group 2 meeting',
                'group_id' => 6
            ),
            16 =>
            array (
                'id' => 17,
                'meeting_date' => '2017-8-8 12:00:00',
                'meeting_notes' => 'Group 1 Meeting',
                'group_id' => 6
            ),
            17 =>
            array (
                'id' => 18,
                'meeting_date' => '2017-8-22 12:00:00',
                'meeting_notes' => 'Group 2 meeting',
                'group_id' => 6
            ),
            18 =>
            array (
                'id' => 19,
                'meeting_date' => '2017-9-12 12:00:00',
                'meeting_notes' => 'Group 1 Meeting',
                'group_id' => 6
            ),
            19 =>
            array (
                'id' => 20,
                'meeting_date' => '2017-9-26 12:00:00',
                'meeting_notes' => 'Group 2 meeting',
                'group_id' => 6
            ),
            20 =>
            array (
                'id' => 21,
                'meeting_date' => '2017-10-10 12:00:00',
                'meeting_notes' => 'Group 1 Meeting',
                'group_id' => 6
            ),
            21 =>
            array (
                'id' => 22,
                'meeting_date' => '2017-10-24 12:00:00',
                'meeting_notes' => 'Group 2 meeting',
                'group_id' => 6
            ),
            22 =>
            array (
                'id' => 23,
                'meeting_date' => '2017-11-14 12:00:00',
                'meeting_notes' => 'Group 1 Meeting',
                'group_id' => 6
            ),
            23 =>
            array (
                'id' => 24,
                'meeting_date' => '2017-11-28 12:00:00',
                'meeting_notes' => 'Group 2 meeting',
                'group_id' => 6
            )
        ));
    }
}
