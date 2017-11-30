<?php

use Illuminate\Database\Seeder;

class ReferralsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('referrals')->delete();
        
        \DB::table('referrals')->insert(array (
            0 =>
            array (
                'id' => 1,
                'from_contact_id' => 3,
                'to_contact_id' => 4,
                'referral_date' => '2017-1-04 13:42:19',
                'meeting_id' => 1,
                'group_id' => 1
            ),
            1 =>
            array (
                'id' => 2,
                'from_contact_id' => 3,
                'to_contact_id' => 4,
                'referral_date' => '2017-1-10 13:42:19',
                'meeting_id' => 1,
                'group_id' => 1
            ),
            2 =>
            array (
                'id' => 3,
                'from_contact_id' => 3,
                'to_contact_id' => 4,
                'referral_date' => '2017-1-11 13:42:19',
                'meeting_id' => 1,
                'group_id' => 1
            ),
            3 =>
            array (
                'id' => 4,
                'from_contact_id' => 3,
                'to_contact_id' => 4,
                'referral_date' => '2017-1-17 13:42:19',
                'meeting_id' => 1,
                'group_id' => 1
            ),
            4 =>
            array (
                'id' => 5,
                'from_contact_id' => 3,
                'to_contact_id' => 4,
                'referral_date' => '2017-1-19 13:42:19',
                'meeting_id' => 1,
                'group_id' => 1
            ),
            5 =>
            array (
                'id' => 6,
                'from_contact_id' => 3,
                'to_contact_id' => 4,
                'referral_date' => '2017-1-21 13:42:19',
                'meeting_id' => 1,
                'group_id' => 1
            ),
            6 =>
            array (
                'id' => 7,
                'from_contact_id' => 3,
                'to_contact_id' => 4,
                'referral_date' => '2017-1-27 13:42:19',
                'meeting_id' => 1,
                'group_id' => 1
            ),
            7 =>
            array (
                'id' => 8,
                'from_contact_id' => 3,
                'to_contact_id' => 4,
                'referral_date' => '2017-2-1 13:42:19',
                'meeting_id' => 1,
                'group_id' => 1
            ),
            8 =>
            array (
                'id' => 9,
                'from_contact_id' => 3,
                'to_contact_id' => 4,
                'referral_date' => '2017-2-5 13:42:19',
                'meeting_id' => 1,
                'group_id' => 1
            ),
            9 =>
            array (
                'id' => 10,
                'from_contact_id' => 3,
                'to_contact_id' => 4,
                'referral_date' => '2017-2-18 13:42:19',
                'meeting_id' => 1,
                'group_id' => 1
            ),
            10 =>
            array (
                'id' => 11,
                'from_contact_id' => 3,
                'to_contact_id' => 4,
                'referral_date' => '2017-2-26 13:42:19',
                'meeting_id' => 1,
                'group_id' => 1
            ),
            11 =>
            array (
                'id' => 12,
                'from_contact_id' => 3,
                'to_contact_id' => 4,
                'referral_date' => '2017-3-3 13:42:19',
                'meeting_id' => 1,
                'group_id' => 1
            ),
            12 =>
            array (
                'id' => 13,
                'from_contact_id' => 3,
                'to_contact_id' => 4,
                'referral_date' => '2017-3-15 13:42:19',
                'meeting_id' => 1,
                'group_id' => 1
            ),
            13 =>
            array (
                'id' => 14,
                'from_contact_id' => 3,
                'to_contact_id' => 4,
                'referral_date' => '2017-3-17 13:42:19',
                'meeting_id' => 1,
                'group_id' => 1
            ),
            14 =>
            array (
                'id' => 15,
                'from_contact_id' => 3,
                'to_contact_id' => 4,
                'referral_date' => '2017-3-19 13:42:19',
                'meeting_id' => 1,
                'group_id' => 1
            ),
            15 =>
            array (
                'id' => 16,
                'from_contact_id' => 3,
                'to_contact_id' => 4,
                'referral_date' => '2017-4-11 13:42:19',
                'meeting_id' => 1,
                'group_id' => 1
            ),
        ));


    }
}
