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
                'name' => 'Wednesday BRG',
                'user_id' => 1,
                'organization_id' => 1,
                'created_at' => '2016-06-04 13:42:19',
                'updated_at' => '2016-06-04 13:42:19',
            ),
        ));
    }
}
