<?php

use Illuminate\Database\Seeder;

class OrganizationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('organizations')->delete();
        
        \DB::table('organizations')->insert(array (
            0 =>
            array (
                'id' => 1,
                'name' => 'Nova Networking Group',
                'user_id' => 1,
                'created_at' => '2017-11-25 13:42:19',
                'updated_at' => '2017-11-25 13:42:19',
            ),
            1 =>
            array (
                'id' => 2,
                'name' => 'Asian American Chamber of Commerce',
                'user_id' => 1,
                'created_at' => '2017-11-25 13:42:19',
                'updated_at' => '2017-11-25 13:42:19',
            ),
            2 =>
            array (
                'id' => 3,
                'name' => 'NOVA Business Roundtable',
                'user_id' => 1,
                'created_at' => '2017-11-25 13:42:19',
                'updated_at' => '2017-11-25 13:42:19',
            ),
            3 =>
            array (
                'id' => 4,
                'name' => 'Greater Reston Chamber of Commerce',
                'user_id' => 1,
                'created_at' => '2017-11-25 13:42:19',
                'updated_at' => '2017-11-25 13:42:19',
            ),
        ));
    }
}
