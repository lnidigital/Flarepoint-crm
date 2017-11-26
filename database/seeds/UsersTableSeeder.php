<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 =>
            array (
                'id' => 1,
                'name' => 'Test Member',
                'email' => 'grow-member@lnidigital.com',
                'password' => bcrypt('password'),
                'address' => '',
                'work_number' => 0,
                'personal_number' => 0,
                'image_path' => '',
                'remember_token' => null,
                'created_at' => '2016-06-04 13:42:19',
                'updated_at' => '2016-06-04 13:42:19',
            ),
            1 =>
            array (
                'id' => 2,
                'name' => 'Test Manager',
                'email' => 'grow-manager@lnidigital.com',
                'password' => bcrypt('password'),
                'address' => '',
                'work_number' => 0,
                'personal_number' => 0,
                'image_path' => '',
                'remember_token' => null,
                'created_at' => '2016-06-04 13:42:19',
                'updated_at' => '2016-06-04 13:42:19',
            ),
            2 =>
            array (
                'id' => 3,
                'name' => 'Test Admin',
                'email' => 'grow-admin@lnidigital.com',
                'password' => bcrypt('password'),
                'address' => '',
                'work_number' => 0,
                'personal_number' => 0,
                'image_path' => '',
                'remember_token' => null,
                'created_at' => '2016-06-04 13:42:19',
                'updated_at' => '2016-06-04 13:42:19',
            ),
            3 =>
            array (
                'id' => 4,
                'name' => 'Test Super',
                'email' => 'grow-super@lnidigital.com',
                'password' => bcrypt('password'),
                'address' => '',
                'work_number' => 0,
                'personal_number' => 0,
                'image_path' => '',
                'remember_token' => null,
                'created_at' => '2016-06-04 13:42:19',
                'updated_at' => '2016-06-04 13:42:19',
            ),
        ));
    }
}
