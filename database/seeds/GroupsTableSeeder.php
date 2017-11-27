<?php

use Illuminate\Database\Seeder;

class GroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('groups')->delete();
        
        \DB::table('groups')->insert(array (
            0 =>
            array (
                'id' => 1,
                'name' => 'Nova Networking Group - Reston Chapter',
                'user_id' => 1,
                'organization_id' => 1,
                'created_at' => '2016-06-04 13:42:19',
                'updated_at' => '2016-06-04 13:42:19',
            ),
            1 =>
            array (
                'id' => 2,
                'name' => 'Nova Networking Group - Fairfax Chapter',
                'user_id' => 1,
                'organization_id' => 1,
                'created_at' => '2016-06-04 13:42:19',
                'updated_at' => '2016-06-04 13:42:19',
            ),
            2 =>
            array (
                'id' => 3,
                'name' => 'Tysons Business Connection',
                'user_id' => 1,
                'organization_id' => null,
                'created_at' => '2016-06-04 13:42:19',
                'updated_at' => '2016-06-04 13:42:19',
            ),
            3 =>
            array (
                'id' => 4,
                'name' => 'Wednesday BRG',
                'user_id' => 1,
                'organization_id' => 1,
                'created_at' => '2016-06-04 13:42:19',
                'updated_at' => '2016-06-04 13:42:19',
            ),
            4 =>
            array (
                'id' => 5,
                'name' => 'Tysons BRG',
                'user_id' => 1,
                'organization_id' => 1,
                'created_at' => '2016-06-04 13:42:19',
                'updated_at' => '2016-06-04 13:42:19',
            ),
            5 =>
            array (
                'id' => 6,
                'name' => 'GRCC - Tuesday AM LeadShare 8-9am',
                'user_id' => 1,
                'organization_id' => 4,
                'created_at' => '2016-06-04 13:42:19',
                'updated_at' => '2016-06-04 13:42:19',
            ),
            6 =>
            array (
                'id' => 7,
                'name' => 'GRCC - Tuesday PM LeadShare 11:30-12:30pm',
                'user_id' => 1,
                'organization_id' => 4,
                'created_at' => '2016-06-04 13:42:19',
                'updated_at' => '2016-06-04 13:42:19',
            ),
            7 =>
            array (
                'id' => 8,
                'name' => 'GRCC - Wednesday LeadShare 11:30am-12:30pm',
                'user_id' => 1,
                'organization_id' => 4,
                'created_at' => '2016-06-04 13:42:19',
                'updated_at' => '2016-06-04 13:42:19',
            ),
            8 =>
            array (
                'id' => 9,
                'name' => 'GRCC - Thursday LeadShare 12:00pm-1:00pm',
                'user_id' => 1,
                'organization_id' => 4,
                'created_at' => '2016-06-04 13:42:19',
                'updated_at' => '2016-06-04 13:42:19',
            ),
            9 =>
            array (
                'id' => 10,
                'name' => 'Centreville Roundtable',
                'user_id' => 1,
                'organization_id' => 3,
                'created_at' => '2016-06-04 13:42:19',
                'updated_at' => '2016-06-04 13:42:19',
            ),
            10 =>
            array (
                'id' => 11,
                'name' => 'Kingstowne Alexandria Roundtable',
                'user_id' => 1,
                'organization_id' => 3,
                'created_at' => '2016-06-04 13:42:19',
                'updated_at' => '2016-06-04 13:42:19',
            ),
            11 =>
            array (
                'id' => 12,
                'name' => 'Fair Lakes Roundtable',
                'user_id' => 1,
                'organization_id' => 3,
                'created_at' => '2016-06-04 13:42:19',
                'updated_at' => '2016-06-04 13:42:19',
            ),
            12 =>
            array (
                'id' => 13,
                'name' => 'Alexandria Roundtable',
                'user_id' => 1,
                'organization_id' => 3,
                'created_at' => '2016-06-04 13:42:19',
                'updated_at' => '2016-06-04 13:42:19',
            ),
            13 =>
            array (
                'id' => 14,
                'name' => 'Tysons Roundtable',
                'user_id' => 1,
                'organization_id' => 3,
                'created_at' => '2016-06-04 13:42:19',
                'updated_at' => '2016-06-04 13:42:19',
            ),
            14 =>
            array (
                'id' => 15,
                'name' => 'B2B Roundtable',
                'user_id' => 1,
                'organization_id' => 3,
                'created_at' => '2016-06-04 13:42:19',
                'updated_at' => '2016-06-04 13:42:19',
            ),
            15 =>
            array (
                'id' => 16,
                'name' => 'Free Group Business Coaching',
                'user_id' => 1,
                'organization_id' => 3,
                'created_at' => '2016-06-04 13:42:19',
                'updated_at' => '2016-06-04 13:42:19',
            ),
        ));
    }
}
