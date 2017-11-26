<?php

use Illuminate\Database\Seeder;
use App\Models\RoleUser;

class UserRoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Roles: 1 = super, 2 = admin, 3 = manager, 4 = member
        // Users: 1 = member, 2 = manager, 3 = admin, 4 = super
        $newrole = new RoleUser;
        $newrole->user_id = '2';
        $newrole->role_id = '3';
        $newrole->timestamps = false;
        $newrole->save();

        // $newrole = new RoleUser;
        // $newrole->role_id = '3';
        // $newrole->user_id = '1';
        // $newrole->timestamps = false;
        // $newrole->save();

        // $newrole = new RoleUser;
        // $newrole->role_id = '2';
        // $newrole->user_id = '1';
        // $newrole->timestamps = false;
        // $newrole->save();

        // $newrole = new RoleUser;
        // $newrole->role_id = '1';
        // $newrole->user_id = '1';
        // $newrole->timestamps = false;
        // $newrole->save();

        // $newrole = new RoleUser;
        // $newrole->role_id = '2'; 
        // $newrole->user_id = '2';
        // $newrole->timestamps = false;
        // $newrole->save();
    }
}
