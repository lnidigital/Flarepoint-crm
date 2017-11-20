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
        
        $adminRole = new Role;
        $adminRole->display_name = 'Administrator';
        $adminRole->name = 'administrator';
        $adminRole->description = 'System Administrator';
        $adminRole->save();

        $editorRole = new Role;
        $editorRole->display_name = 'Manager';
        $editorRole->name = 'manager';
        $editorRole->description = 'Group manager';
        $editorRole->save();

        $employeeRole = new Role;
        $employeeRole->display_name = 'Member';
        $employeeRole->name = 'member';
        $employeeRole->description = 'Group member';
        $employeeRole->save();
    }
}
