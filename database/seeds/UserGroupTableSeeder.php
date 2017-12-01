<?php

use Illuminate\Database\Seeder;

class UserGroupTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('group_user')->delete();
        
        \DB::table('group_user')->insert(array (
            0 =>
            array (
                'id' => 1,
                'user_id' => 1,
                'group_id' => 1,
                'created_at' => null,
                'updated_at' => null,
            ),
            1 =>
            array (
                'id' => 2,
                'user_id' => 2,
                'group_id' => 1,
                'created_at' => null,
                'updated_at' => null,
            ),
            2 =>
            array (
                'id' => 3,
                'user_id' => 3,
                'group_id' => 1,
                'created_at' => null,
                'updated_at' => null,
            ),
            3 =>
            array (
                'id' => 4,
                'user_id' => 4,
                'group_id' => 1,
                'created_at' => null,
                'updated_at' => null,
            ),
            4 =>
            array (
                'id' => 5,
                'user_id' => 2,
                'group_id' => 2,
                'created_at' => null,
                'updated_at' => null,
            ),
            5 =>
            array (
                'id' => 6,
                'user_id' => 2,
                'group_id' => 3,
                'created_at' => null,
                'updated_at' => null,
            ),
            6 =>
            array (
                'id' => 7,
                'user_id' => 5,
                'group_id' => 6,
                'created_at' => null,
                'updated_at' => null,
            ),
            7 =>
            array (
                'id' => 8,
                'user_id' => 5,
                'group_id' => 7,
                'created_at' => null,
                'updated_at' => null,
            ),
            8 =>
            array (
                'id' => 9,
                'user_id' => 5,
                'group_id' => 8,
                'created_at' => null,
                'updated_at' => null,
            ),
            9 =>
            array (
                'id' => 10,
                'user_id' => 5,
                'group_id' => 9,
                'created_at' => null,
                'updated_at' => null,
            ),
            10 =>
            array (
                'id' => 11,
                'user_id' => 2,
                'group_id' => 6,
                'created_at' => null,
                'updated_at' => null,
            ),
        ));
    }
}
