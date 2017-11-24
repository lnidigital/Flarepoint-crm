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
                'name' => 'Asian American Chamber of Commerce',
                'user_id' => 1,
                'created_at' => '2016-06-04 13:42:19',
                'updated_at' => '2016-06-04 13:42:19',
            ),
        ));
    }
}
