<?php

use Illuminate\Database\Seeder;

class GuestsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('guests')->delete();
        
        \DB::table('guests')->insert(array (
            0 =>
            array (
                'id' => 1,
                'name' => 'Dave Estep',
                'company_name' => 'The Olmsted Foundation',
                'user_id' => 1,
                'member_id' => 2,
                'group_id' => 1,
                'industry_id' => 1,
                'created_at' => '2016-06-04 13:42:19',
                'updated_at' => '2016-06-04 13:42:19',
            )
        ));
    }
}
