<?php

use Illuminate\Database\Seeder;
use App\Models\Role;

class RolesTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superRole = new Role;
        $superRole->display_name = 'Super User';
        $superRole->name = 'super';
        $superRole->description = 'Super User';
        $superRole->save();

        $adminRole = new Role;
        $adminRole->display_name = 'Administrator';
        $adminRole->name = 'administrator';
        $adminRole->description = 'Group Administrator';
        $adminRole->save();

        $managerRole = new Role;
        $managerRole->display_name = 'Manager';
        $managerRole->name = 'manager';
        $managerRole->description = 'Group manager';
        $managerRole->save();

        $memberRole = new Role;
        $memberRole->display_name = 'Member';
        $memberRole->name = 'member';
        $memberRole->description = 'Group member';
        $memberRole->save();
        
    }
}
