<?php

use Illuminate\Database\Seeder;

class OnetoOnesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('oneto_ones')->delete();
        
        \DB::table('oneto_ones')->insert(array (
            0 =>
            array (
                'id' => 1,
                'first_contact_id' => 3,
                'second_contact_id' => 4,
                'onetoone_date' => '2017-1-04 13:42:19',
                'meeting_id' => 1,
                'group_id' => 6
            ),
            1 =>
            array (
                'id' => 2,
                'first_contact_id' => 3,
                'second_contact_id' => 4,
                'onetoone_date' => '2017-1-10 13:42:19',
                'meeting_id' => 1,
                'group_id' => 6
            ),
            2 =>
            array (
                'id' => 3,
                'first_contact_id' => 3,
                'second_contact_id' => 4,
                'onetoone_date' => '2017-1-11 13:42:19',
                'meeting_id' => 1,
                'group_id' => 6
            ),
            3 =>
            array (
                'id' => 4,
                'first_contact_id' => 3,
                'second_contact_id' => 4,
                'onetoone_date' => '2017-1-17 13:42:19',
                'meeting_id' => 1,
                'group_id' => 6
            ),
            4 =>
            array (
                'id' => 5,
                'first_contact_id' => 3,
                'second_contact_id' => 4,
                'onetoone_date' => '2017-1-19 13:42:19',
                'meeting_id' => 1,
                'group_id' => 6
            ),
            5 =>
            array (
                'id' => 6,
                'first_contact_id' => 3,
                'second_contact_id' => 4,
                'onetoone_date' => '2017-1-21 13:42:19',
                'meeting_id' => 1,
                'group_id' => 6
            ),
            6 =>
            array (
                'id' => 7,
                'first_contact_id' => 3,
                'second_contact_id' => 4,
                'onetoone_date' => '2017-1-27 13:42:19',
                'meeting_id' => 1,
                'group_id' => 6
            ),
            7 =>
            array (
                'id' => 8,
                'first_contact_id' => 3,
                'second_contact_id' => 4,
                'onetoone_date' => '2017-2-1 13:42:19',
                'meeting_id' => 1,
                'group_id' => 6
            ),
            8 =>
            array (
                'id' => 9,
                'first_contact_id' => 3,
                'second_contact_id' => 4,
                'onetoone_date' => '2017-2-5 13:42:19',
                'meeting_id' => 1,
                'group_id' => 6
            ),
            9 =>
            array (
                'id' => 10,
                'first_contact_id' => 3,
                'second_contact_id' => 4,
                'onetoone_date' => '2017-2-18 13:42:19',
                'meeting_id' => 1,
                'group_id' => 6
            ),
            10 =>
            array (
                'id' => 11,
                'first_contact_id' => 3,
                'second_contact_id' => 4,
                'onetoone_date' => '2017-2-26 13:42:19',
                'meeting_id' => 1,
                'group_id' => 6
            ),
            11 =>
            array (
                'id' => 12,
                'first_contact_id' => 3,
                'second_contact_id' => 4,
                'onetoone_date' => '2017-3-3 13:42:19',
                'meeting_id' => 1,
                'group_id' => 6
            ),
            12 =>
            array (
                'id' => 13,
                'first_contact_id' => 3,
                'second_contact_id' => 4,
                'onetoone_date' => '2017-3-15 13:42:19',
                'meeting_id' => 1,
                'group_id' => 6
            ),
            13 =>
            array (
                'id' => 14,
                'first_contact_id' => 3,
                'second_contact_id' => 4,
                'onetoone_date' => '2017-3-17 13:42:19',
                'meeting_id' => 1,
                'group_id' => 6
            ),
            14 =>
            array (
                'id' => 15,
                'first_contact_id' => 3,
                'second_contact_id' => 4,
                'onetoone_date' => '2017-3-19 13:42:19',
                'meeting_id' => 1,
                'group_id' => 6
            ),
            15 =>
            array (
                'id' => 16,
                'first_contact_id' => 3,
                'second_contact_id' => 4,
                'onetoone_date' => '2017-4-11 13:42:19',
                'meeting_id' => 1,
                'group_id' => 6
            ),
        ));


    }
}
