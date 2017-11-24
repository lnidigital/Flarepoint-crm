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
        $adminRole->description = 'Group Administrator';
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

        $employeeRole = new Role;
        $employeeRole->display_name = 'Super User';
        $employeeRole->name = 'super';
        $employeeRole->description = 'Super User';
        $employeeRole->save();
    }
}
