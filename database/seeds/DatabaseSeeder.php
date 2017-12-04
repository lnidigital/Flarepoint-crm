<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $this->call('UsersTableSeeder');

        $this->call('IndustriesTableSeeder');
        $this->call('SettingsTableSeeder');
        $this->call('PermissionsTableSeeder');
        $this->call('RolesTablesSeeder');
        $this->call('RolePermissionTableSeeder');
        $this->call('UserRoleTableSeeder');
        
        /*
        $this->call('OrganizationsTableSeeder');
        $this->call('GroupsTableSeeder');
        $this->call('UserGroupTableSeeder');
        $this->call('ContactsTableSeeder');
        $this->call('MeetingsTableSeeder');
        $this->call('AttendancesTableSeeder');
        $this->call('ReferralsTableSeeder');
        $this->call('OnetoOnesTableSeeder');
        */
    }
}
