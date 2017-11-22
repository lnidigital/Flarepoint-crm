<?php

use Illuminate\Database\Seeder;
use App\Models\Permissions;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * User Permissions
         */
        
        $createUser = new Permissions;
        $createUser->display_name = 'Create user';
        $createUser->name = 'user-create';
        $createUser->description = 'Permission to create user';
        $createUser->save();

        $updateUser = new Permissions;
        $updateUser->display_name = 'Update user';
        $updateUser->name = 'user-update';
        $updateUser->description = 'Permission to update user';
        $updateUser->save();

        $deleteUser = new Permissions;
        $deleteUser->display_name = 'Delete user';
        $deleteUser->name = 'user-delete';
        $deleteUser->description = 'Permission to update delete';
        $deleteUser->save();


         /**
         * Client Permissions
         */
        
        $createClient = new Permissions;
        $createClient->display_name = 'Create client';
        $createClient->name = 'client-create';
        $createClient->description = 'Permission to create client';
        $createClient->save();

        $updateClient = new Permissions;
        $updateClient->display_name = 'Update client';
        $updateClient->name = 'client-update';
        $updateClient->description = 'Permission to update client';
        $updateClient->save();

        $deleteClient = new Permissions;
        $deleteClient->display_name = 'Delete client';
        $deleteClient->name = 'client-delete';
        $deleteClient->description = 'Permission to delete client';
        $deleteClient->save();

         /**
         * Tasks Permissions
         */
        
        $createTask = new Permissions;
        $createTask->display_name = 'Create task';
        $createTask->name = 'task-create';
        $createTask->description = 'Permission to create task';
        $createTask->save();

        $updateTask = new Permissions;
        $updateTask->display_name = 'Update task';
        $updateTask->name = 'task-update';
        $updateTask->description = 'Permission to update task';
        $updateTask->save();

         /**
         * Leads Permissions
         */
        
        $createLead = new Permissions;
        $createLead->display_name = 'Create lead';
        $createLead->name = 'lead-create';
        $createLead->description = 'Permission to create lead';
        $createLead->save();

        $updateLead = new Permissions;
        $updateLead->display_name = 'Update lead';
        $updateLead->name = 'lead-update';
        $updateLead->description = 'Permission to update lead';
        $updateLead->save();

        /**
         * Member Permissions
         */
        
        $createClient = new Permissions;
        $createClient->display_name = 'Create member';
        $createClient->name = 'member-create';
        $createClient->description = 'Permission to create member';
        $createClient->save();

        $updateClient = new Permissions;
        $updateClient->display_name = 'Update member';
        $updateClient->name = 'member-update';
        $updateClient->description = 'Permission to update member';
        $updateClient->save();

        $deleteClient = new Permissions;
        $deleteClient->display_name = 'Delete member';
        $deleteClient->name = 'member-delete';
        $deleteClient->description = 'Permission to delete member';
        $deleteClient->save();


        /**
         * Attendance Permissions
         */
        
        $createClient = new Permissions;
        $createClient->display_name = 'Create attendance';
        $createClient->name = 'attendance-create';
        $createClient->description = 'Permission to create attendance';
        $createClient->save();

        $updateClient = new Permissions;
        $updateClient->display_name = 'Update attendance';
        $updateClient->name = 'attendance-update';
        $updateClient->description = 'Permission to update attendance';
        $updateClient->save();

        $deleteClient = new Permissions;
        $deleteClient->display_name = 'Delete attendance';
        $deleteClient->name = 'attendance-delete';
        $deleteClient->description = 'Permission to delete attendance';
        $deleteClient->save();


        /**
         * Guests Permissions (17-19)
         */
        
        $createClient = new Permissions;
        $createClient->display_name = 'Create guest';
        $createClient->name = 'guest-create';
        $createClient->description = 'Permission to create guest';
        $createClient->save();

        $updateClient = new Permissions;
        $updateClient->display_name = 'Update guest';
        $updateClient->name = 'guest-update';
        $updateClient->description = 'Permission to update guest';
        $updateClient->save();

        $deleteClient = new Permissions;
        $deleteClient->display_name = 'Delete guest';
        $deleteClient->name = 'guest-delete';
        $deleteClient->description = 'Permission to delete guest';
        $deleteClient->save();

        /**
         * Referral Permissions (20-22)
         */
        
        $createClient = new Permissions;
        $createClient->display_name = 'Create referral';
        $createClient->name = 'referral-create';
        $createClient->description = 'Permission to create referral';
        $createClient->save();

        $updateClient = new Permissions;
        $updateClient->display_name = 'Update referral';
        $updateClient->name = 'referral-update';
        $updateClient->description = 'Permission to update referral';
        $updateClient->save();

        $deleteClient = new Permissions;
        $deleteClient->display_name = 'Delete referral';
        $deleteClient->name = 'referral-delete';
        $deleteClient->description = 'Permission to delete referral';
        $deleteClient->save();

        /**
         * Referral Permissions (23-25)
         */
        
        $createClient = new Permissions;
        $createClient->display_name = 'Create 1-to-1';
        $createClient->name = 'onetoone-create';
        $createClient->description = 'Permission to create 1-to-1';
        $createClient->save();

        $updateClient = new Permissions;
        $updateClient->display_name = 'Update 1-to-1';
        $updateClient->name = 'onetoone-update';
        $updateClient->description = 'Permission to update 1-to-1';
        $updateClient->save();

        $deleteClient = new Permissions;
        $deleteClient->display_name = 'Delete 1-to-1';
        $deleteClient->name = 'onetoone-delete';
        $deleteClient->description = 'Permission to delete 1-to-1';
        $deleteClient->save();
        
    }
}
