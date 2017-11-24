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
        ));
    }
}
