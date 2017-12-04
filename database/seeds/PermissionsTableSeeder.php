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
         * Contact Permissions
         */
        
        $createContact = new Permissions;
        $createContact->display_name = 'Create contact';
        $createContact->name = 'contact-create';
        $createContact->description = 'Permission to create contact';
        $createContact->save();

        $updateContact = new Permissions;
        $updateContact->display_name = 'Update contact';
        $updateContact->name = 'contact-update';
        $updateContact->description = 'Permission to update contact';
        $updateContact->save();

        $deleteContact = new Permissions;
        $deleteContact->display_name = 'Delete contact';
        $deleteContact->name = 'contact-delete';
        $deleteContact->description = 'Permission to delete contact';
        $deleteContact->save();


        /**
         * Attendance Permissions
         */
        
        $createAttendance = new Permissions;
        $createAttendance->display_name = 'Create attendance';
        $createAttendance->name = 'attendance-create';
        $createAttendance->description = 'Permission to create attendance';
        $createAttendance->save();

        $updateAttendance = new Permissions;
        $updateAttendance->display_name = 'Update attendance';
        $updateAttendance->name = 'attendance-update';
        $updateAttendance->description = 'Permission to update attendance';
        $updateAttendance->save();

        $deleteAttendance = new Permissions;
        $deleteAttendance->display_name = 'Delete attendance';
        $deleteAttendance->name = 'attendance-delete';
        $deleteAttendance->description = 'Permission to delete attendance';
        $deleteAttendance->save();

        /**
         * Referral Permissions
         */
        
        $createReferral = new Permissions;
        $createReferral->display_name = 'Create referral';
        $createReferral->name = 'referral-create';
        $createReferral->description = 'Permission to create referral';
        $createReferral->save();

        $updateReferral = new Permissions;
        $updateReferral->display_name = 'Update referral';
        $updateReferral->name = 'referral-update';
        $updateReferral->description = 'Permission to update referral';
        $updateReferral->save();

        $deleteReferral = new Permissions;
        $deleteReferral->display_name = 'Delete referral';
        $deleteReferral->name = 'referral-delete';
        $deleteReferral->description = 'Permission to delete referral';
        $deleteReferral->save();

        /**
         * One-to-One Permissions 
         */
        
        $createOnetoone = new Permissions;
        $createOnetoone->display_name = 'Create 1-to-1';
        $createOnetoone->name = 'onetoone-create';
        $createOnetoone->description = 'Permission to create 1-to-1';
        $createOnetoone->save();

        $updateOnetoone = new Permissions;
        $updateOnetoone->display_name = 'Update 1-to-1';
        $updateOnetoone->name = 'onetoone-update';
        $updateOnetoone->description = 'Permission to update 1-to-1';
        $updateOnetoone->save();

        $deleteOnetoone = new Permissions;
        $deleteOnetoone->display_name = 'Delete 1-to-1';
        $deleteOnetoone->name = 'onetoone-delete';
        $deleteOnetoone->description = 'Permission to delete 1-to-1';
        $deleteOnetoone->save();

        /**
         * Meeting Permissions 
         */
        
        $createMeeting = new Permissions;
        $createMeeting->display_name = 'Create Meeting';
        $createMeeting->name = 'meeting-create';
        $createMeeting->description = 'Permission to create meeting';
        $createMeeting->save();

        $updateMeeting = new Permissions;
        $updateMeeting->display_name = 'Update meeting';
        $updateMeeting->name = 'meeting-update';
        $updateMeeting->description = 'Permission to update meeting';
        $updateMeeting->save();

        $deleteMeeting = new Permissions;
        $deleteMeeting->display_name = 'Delete meeting';
        $deleteMeeting->name = 'meeting-delete';
        $deleteMeeting->description = 'Permission to delete meeting';
        $deleteMeeting->save();

        /**
         * Revenue Permissions
         */
        
        $createRevenue = new Permissions;
        $createRevenue->display_name = 'Create revenue';
        $createRevenue->name = 'revenue-create';
        $createRevenue->description = 'Permission to create revenue';
        $createRevenue->save();

        $updateRevenue = new Permissions;
        $updateRevenue->display_name = 'Update revenue';
        $updateRevenue->name = 'revenue-update';
        $updateRevenue->description = 'Permission to update revenue';
        $updateRevenue->save();

        $deleteRevenue = new Permissions;
        $deleteRevenue->display_name = 'Delete revenue';
        $deleteRevenue->name = 'revenue-delete';
        $deleteRevenue->description = 'Permission to delete revenue';
        $deleteRevenue->save();

        /**
         * Group Permissions
         */
        
        $createGroup = new Permissions;
        $createGroup->display_name = 'Create group';
        $createGroup->name = 'group-create';
        $createGroup->description = 'Permission to create group';
        $createGroup->save();

        $updateGroup = new Permissions;
        $updateGroup->display_name = 'Update group';
        $updateGroup->name = 'group-update';
        $updateGroup->description = 'Permission to update group';
        $updateGroup->save();

        $deleteGroup = new Permissions;
        $deleteGroup->display_name = 'Delete group';
        $deleteGroup->name = 'group-delete';
        $deleteGroup->description = 'Permission to delete group';
        $deleteGroup->save();

        /**
         * Organization Permissions
         */
        
        $createGroup = new Permissions;
        $createGroup->display_name = 'Create organization';
        $createGroup->name = 'organization-create';
        $createGroup->description = 'Permission to create organization';
        $createGroup->save();

        $updateGroup = new Permissions;
        $updateGroup->display_name = 'Update organization';
        $updateGroup->name = 'organization-update';
        $updateGroup->description = 'Permission to update organization';
        $updateGroup->save();

        $deleteGroup = new Permissions;
        $deleteGroup->display_name = 'Delete organization';
        $deleteGroup->name = 'organization-delete';
        $deleteGroup->description = 'Permission to delete organization';
        $deleteGroup->save();

        
        
    }
}
