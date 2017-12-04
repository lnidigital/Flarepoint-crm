<?php

use Illuminate\Database\Seeder;
use App\Models\PermissionRole;

class RolePermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Roles: 1 = super, 2 = admin, 3 = manager, 4 = member
        // Perms: 1-3 = user, 4-6 = contact, 7-9 = attendance, 10-12 = referral, 13-15 = one-to-one, 16-18 = meeting, 19-21 = revenue, 22-24 = group, 25-27 = organization

        /**
         * Super role
         *
         */
        // Super & user
        $createUser = new PermissionRole;
        $createUser->role_id = '1';
        $createUser->permission_id = '1';
        $createUser->timestamps = false;
        $createUser->save();

        $updateUser = new PermissionRole;
        $updateUser->role_id = '1';
        $updateUser->permission_id = '2';
        $updateUser->timestamps = false;
        $updateUser->save();

        $deleteUser = new PermissionRole;
        $deleteUser->role_id = '1';
        $deleteUser->permission_id = '3';
        $deleteUser->timestamps = false;
        $deleteUser->save();

        // Super & contact
        $createContact = new PermissionRole;
        $createContact->role_id = '1';
        $createContact->permission_id = '4';
        $createContact->timestamps = false;
        $createContact->save();

        $updateContact = new PermissionRole;
        $updateContact->role_id = '1';
        $updateContact->permission_id = '5';
        $updateContact->timestamps = false;
        $updateContact->save();

        $deleteContact = new PermissionRole;
        $deleteContact->role_id = '1';
        $deleteContact->permission_id = '6';
        $deleteContact->timestamps = false;
        $deleteContact->save();

        // Super & attendance
        $createAttendance = new PermissionRole;
        $createAttendance->role_id = '1';
        $createAttendance->permission_id = '7';
        $createAttendance->timestamps = false;
        $createAttendance->save();

        $updateAttendance = new PermissionRole;
        $updateAttendance->role_id = '1';
        $updateAttendance->permission_id = '8';
        $updateAttendance->timestamps = false;
        $updateAttendance->save();

        $deleteAttendance = new PermissionRole;
        $deleteAttendance->role_id = '1';
        $deleteAttendance->permission_id = '9';
        $deleteAttendance->timestamps = false;
        $deleteAttendance->save();

        // Super & referral
        $createReferral = new PermissionRole;
        $createReferral->role_id = '1';
        $createReferral->permission_id = '10';
        $createReferral->timestamps = false;
        $createReferral->save();

        $updateReferral = new PermissionRole;
        $updateReferral->role_id = '1';
        $updateReferral->permission_id = '11';
        $updateReferral->timestamps = false;
        $updateReferral->save();

        $deleteReferral = new PermissionRole;
        $deleteReferral->role_id = '1';
        $deleteReferral->permission_id = '12';
        $deleteReferral->timestamps = false;
        $deleteReferral->save();

        // Super & one-to-one
        $createOnetoOne = new PermissionRole;
        $createOnetoOne->role_id = '1';
        $createOnetoOne->permission_id = '13';
        $createOnetoOne->timestamps = false;
        $createOnetoOne->save();

        $updateOnetoOne = new PermissionRole;
        $updateOnetoOne->role_id = '1';
        $updateOnetoOne->permission_id = '14';
        $updateOnetoOne->timestamps = false;
        $updateOnetoOne->save();

        $deleteOnetoOne = new PermissionRole;
        $deleteOnetoOne->role_id = '1';
        $deleteOnetoOne->permission_id = '15';
        $deleteOnetoOne->timestamps = false;
        $deleteOnetoOne->save();

        // Super & meeting
        $createMeeting = new PermissionRole;
        $createMeeting->role_id = '1';
        $createMeeting->permission_id = '16';
        $createMeeting->timestamps = false;
        $createMeeting->save();

        $updateMeeting = new PermissionRole;
        $updateMeeting->role_id = '1';
        $updateMeeting->permission_id = '17';
        $updateMeeting->timestamps = false;
        $updateMeeting->save();

        $deleteMeeting = new PermissionRole;
        $deleteMeeting->role_id = '1';
        $deleteMeeting->permission_id = '18';
        $deleteMeeting->timestamps = false;
        $deleteMeeting->save();

        // Super & revenue
        $createRevenue = new PermissionRole;
        $createRevenue->role_id = '1';
        $createRevenue->permission_id = '19';
        $createRevenue->timestamps = false;
        $createRevenue->save();

        $updateRevenue = new PermissionRole;
        $updateRevenue->role_id = '1';
        $updateRevenue->permission_id = '20';
        $updateRevenue->timestamps = false;
        $updateRevenue->save();

        $deleteRevenue = new PermissionRole;
        $deleteRevenue->role_id = '1';
        $deleteRevenue->permission_id = '21';
        $deleteRevenue->timestamps = false;
        $deleteRevenue->save();

        // Super & group
        $createGroup = new PermissionRole;
        $createGroup->role_id = '1';
        $createGroup->permission_id = '22';
        $createGroup->timestamps = false;
        $createGroup->save();

        $updateGroup = new PermissionRole;
        $updateGroup->role_id = '1';
        $updateGroup->permission_id = '23';
        $updateGroup->timestamps = false;
        $updateGroup->save();

        $deleteGroup = new PermissionRole;
        $deleteGroup->role_id = '1';
        $deleteGroup->permission_id = '24';
        $deleteGroup->timestamps = false;
        $deleteGroup->save();

        // Super & organization
        $createGroup = new PermissionRole;
        $createGroup->role_id = '1';
        $createGroup->permission_id = '25';
        $createGroup->timestamps = false;
        $createGroup->save();

        $updateGroup = new PermissionRole;
        $updateGroup->role_id = '1';
        $updateGroup->permission_id = '26';
        $updateGroup->timestamps = false;
        $updateGroup->save();

        $deleteGroup = new PermissionRole;
        $deleteGroup->role_id = '1';
        $deleteGroup->permission_id = '27';
        $deleteGroup->timestamps = false;
        $deleteGroup->save();

        /**
         * Admin Role
         *
         */
        // Admin & user
        $createUser = new PermissionRole;
        $createUser->role_id = '2';
        $createUser->permission_id = '1';
        $createUser->timestamps = false;
        $createUser->save();

        $updateUser = new PermissionRole;
        $updateUser->role_id = '2';
        $updateUser->permission_id = '2';
        $updateUser->timestamps = false;
        $updateUser->save();

        $deleteUser = new PermissionRole;
        $deleteUser->role_id = '2';
        $deleteUser->permission_id = '3';
        $deleteUser->timestamps = false;
        $deleteUser->save();

        // Admin & contact
        $createContact = new PermissionRole;
        $createContact->role_id = '2';
        $createContact->permission_id = '4';
        $createContact->timestamps = false;
        $createContact->save();

        $updateContact = new PermissionRole;
        $updateContact->role_id = '2';
        $updateContact->permission_id = '5';
        $updateContact->timestamps = false;
        $updateContact->save();

        $deleteContact = new PermissionRole;
        $deleteContact->role_id = '2';
        $deleteContact->permission_id = '6';
        $deleteContact->timestamps = false;
        $deleteContact->save();

        // Admin & attendance
        $createAttendance = new PermissionRole;
        $createAttendance->role_id = '2';
        $createAttendance->permission_id = '7';
        $createAttendance->timestamps = false;
        $createAttendance->save();

        $updateAttendance = new PermissionRole;
        $updateAttendance->role_id = '2';
        $updateAttendance->permission_id = '8';
        $updateAttendance->timestamps = false;
        $updateAttendance->save();

        $deleteAttendance = new PermissionRole;
        $deleteAttendance->role_id = '2';
        $deleteAttendance->permission_id = '9';
        $deleteAttendance->timestamps = false;
        $deleteAttendance->save();

        // Admin & referral
        $createReferral = new PermissionRole;
        $createReferral->role_id = '2';
        $createReferral->permission_id = '10';
        $createReferral->timestamps = false;
        $createReferral->save();

        $updateReferral = new PermissionRole;
        $updateReferral->role_id = '2';
        $updateReferral->permission_id = '11';
        $updateReferral->timestamps = false;
        $updateReferral->save();

        $deleteReferral = new PermissionRole;
        $deleteReferral->role_id = '2';
        $deleteReferral->permission_id = '12';
        $deleteReferral->timestamps = false;
        $deleteReferral->save();

        // Admin & one-to-one
        $createOnetoOne = new PermissionRole;
        $createOnetoOne->role_id = '2';
        $createOnetoOne->permission_id = '13';
        $createOnetoOne->timestamps = false;
        $createOnetoOne->save();

        $updateOnetoOne = new PermissionRole;
        $updateOnetoOne->role_id = '2';
        $updateOnetoOne->permission_id = '14';
        $updateOnetoOne->timestamps = false;
        $updateOnetoOne->save();

        $deleteOnetoOne = new PermissionRole;
        $deleteOnetoOne->role_id = '2';
        $deleteOnetoOne->permission_id = '15';
        $deleteOnetoOne->timestamps = false;
        $deleteOnetoOne->save();

        // Admin & meeting
        $createMeeting = new PermissionRole;
        $createMeeting->role_id = '2';
        $createMeeting->permission_id = '16';
        $createMeeting->timestamps = false;
        $createMeeting->save();

        $updateMeeting = new PermissionRole;
        $updateMeeting->role_id = '2';
        $updateMeeting->permission_id = '17';
        $updateMeeting->timestamps = false;
        $updateMeeting->save();

        $deleteMeeting = new PermissionRole;
        $deleteMeeting->role_id = '2';
        $deleteMeeting->permission_id = '18';
        $deleteMeeting->timestamps = false;
        $deleteMeeting->save();

        // Admin & revenue
        $createRevenue = new PermissionRole;
        $createRevenue->role_id = '2';
        $createRevenue->permission_id = '19';
        $createRevenue->timestamps = false;
        $createRevenue->save();

        $updateRevenue = new PermissionRole;
        $updateRevenue->role_id = '2';
        $updateRevenue->permission_id = '20';
        $updateRevenue->timestamps = false;
        $updateRevenue->save();

        $deleteRevenue = new PermissionRole;
        $deleteRevenue->role_id = '2';
        $deleteRevenue->permission_id = '21';
        $deleteRevenue->timestamps = false;
        $deleteRevenue->save();

        // Admin & group
        $createGroup = new PermissionRole;
        $createGroup->role_id = '2';
        $createGroup->permission_id = '22';
        $createGroup->timestamps = false;
        $createGroup->save();

        $updateGroup = new PermissionRole;
        $updateGroup->role_id = '2';
        $updateGroup->permission_id = '23';
        $updateGroup->timestamps = false;
        $updateGroup->save();

        $deleteGroup = new PermissionRole;
        $deleteGroup->role_id = '2';
        $deleteGroup->permission_id = '24';
        $deleteGroup->timestamps = false;
        $deleteGroup->save();

        // Admin & organization
        $createGroup = new PermissionRole;
        $createGroup->role_id = '2';
        $createGroup->permission_id = '25';
        $createGroup->timestamps = false;
        $createGroup->save();

        $updateGroup = new PermissionRole;
        $updateGroup->role_id = '2';
        $updateGroup->permission_id = '26';
        $updateGroup->timestamps = false;
        $updateGroup->save();

        $deleteGroup = new PermissionRole;
        $deleteGroup->role_id = '2';
        $deleteGroup->permission_id = '27';
        $deleteGroup->timestamps = false;
        $deleteGroup->save();

        /**
         * Manager Role
         *
         */
        // Manager & contact
        $createContact = new PermissionRole;
        $createContact->role_id = '3';
        $createContact->permission_id = '4';
        $createContact->timestamps = false;
        $createContact->save();

        $updateContact = new PermissionRole;
        $updateContact->role_id = '3';
        $updateContact->permission_id = '5';
        $updateContact->timestamps = false;
        $updateContact->save();

        $deleteContact = new PermissionRole;
        $deleteContact->role_id = '3';
        $deleteContact->permission_id = '6';
        $deleteContact->timestamps = false;
        $deleteContact->save();

        // Manager & attendance
        $createAttendance = new PermissionRole;
        $createAttendance->role_id = '3';
        $createAttendance->permission_id = '7';
        $createAttendance->timestamps = false;
        $createAttendance->save();

        $updateAttendance = new PermissionRole;
        $updateAttendance->role_id = '3';
        $updateAttendance->permission_id = '8';
        $updateAttendance->timestamps = false;
        $updateAttendance->save();

        $deleteAttendance = new PermissionRole;
        $deleteAttendance->role_id = '3';
        $deleteAttendance->permission_id = '9';
        $deleteAttendance->timestamps = false;
        $deleteAttendance->save();

        // Manager & referral
        $createReferral = new PermissionRole;
        $createReferral->role_id = '3';
        $createReferral->permission_id = '10';
        $createReferral->timestamps = false;
        $createReferral->save();

        $updateReferral = new PermissionRole;
        $updateReferral->role_id = '3';
        $updateReferral->permission_id = '11';
        $updateReferral->timestamps = false;
        $updateReferral->save();

        $deleteReferral = new PermissionRole;
        $deleteReferral->role_id = '3';
        $deleteReferral->permission_id = '12';
        $deleteReferral->timestamps = false;
        $deleteReferral->save();

        // Manager & one-to-one
        $createOnetoOne = new PermissionRole;
        $createOnetoOne->role_id = '3';
        $createOnetoOne->permission_id = '13';
        $createOnetoOne->timestamps = false;
        $createOnetoOne->save();

        $updateOnetoOne = new PermissionRole;
        $updateOnetoOne->role_id = '3';
        $updateOnetoOne->permission_id = '14';
        $updateOnetoOne->timestamps = false;
        $updateOnetoOne->save();

        $deleteOnetoOne = new PermissionRole;
        $deleteOnetoOne->role_id = '3';
        $deleteOnetoOne->permission_id = '15';
        $deleteOnetoOne->timestamps = false;
        $deleteOnetoOne->save();

        // Manager & meeting
        $createMeeting = new PermissionRole;
        $createMeeting->role_id = '3';
        $createMeeting->permission_id = '16';
        $createMeeting->timestamps = false;
        $createMeeting->save();

        $updateMeeting = new PermissionRole;
        $updateMeeting->role_id = '3';
        $updateMeeting->permission_id = '17';
        $updateMeeting->timestamps = false;
        $updateMeeting->save();

        $deleteMeeting = new PermissionRole;
        $deleteMeeting->role_id = '3';
        $deleteMeeting->permission_id = '18';
        $deleteMeeting->timestamps = false;
        $deleteMeeting->save();

        // Manager & revenue
        $createRevenue = new PermissionRole;
        $createRevenue->role_id = '3';
        $createRevenue->permission_id = '19';
        $createRevenue->timestamps = false;
        $createRevenue->save();

        $updateRevenue = new PermissionRole;
        $updateRevenue->role_id = '3';
        $updateRevenue->permission_id = '20';
        $updateRevenue->timestamps = false;
        $updateRevenue->save();

        $deleteRevenue = new PermissionRole;
        $deleteRevenue->role_id = '3';
        $deleteRevenue->permission_id = '21';
        $deleteRevenue->timestamps = false;
        $deleteRevenue->save();

        /**
         * Member Role
         *
         */
        // Member & referral
        $createReferral = new PermissionRole;
        $createReferral->role_id = '4';
        $createReferral->permission_id = '10';
        $createReferral->timestamps = false;
        $createReferral->save();

        $updateReferral = new PermissionRole;
        $updateReferral->role_id = '4';
        $updateReferral->permission_id = '11';
        $updateReferral->timestamps = false;
        $updateReferral->save();

        $deleteReferral = new PermissionRole;
        $deleteReferral->role_id = '4';
        $deleteReferral->permission_id = '12';
        $deleteReferral->timestamps = false;
        $deleteReferral->save();

        // Member & one-to-one
        $createOnetoOne = new PermissionRole;
        $createOnetoOne->role_id = '4';
        $createOnetoOne->permission_id = '13';
        $createOnetoOne->timestamps = false;
        $createOnetoOne->save();

        $updateOnetoOne = new PermissionRole;
        $updateOnetoOne->role_id = '4';
        $updateOnetoOne->permission_id = '14';
        $updateOnetoOne->timestamps = false;
        $updateOnetoOne->save();

        $deleteOnetoOne = new PermissionRole;
        $deleteOnetoOne->role_id = '4';
        $deleteOnetoOne->permission_id = '15';
        $deleteOnetoOne->timestamps = false;
        $deleteOnetoOne->save();

        // Member & revenue
        $createRevenue = new PermissionRole;
        $createRevenue->role_id = '4';
        $createRevenue->permission_id = '19';
        $createRevenue->timestamps = false;
        $createRevenue->save();

        $updateRevenue = new PermissionRole;
        $updateRevenue->role_id = '4';
        $updateRevenue->permission_id = '20';
        $updateRevenue->timestamps = false;
        $updateRevenue->save();

        $deleteRevenue = new PermissionRole;
        $deleteRevenue->role_id = '4';
        $deleteRevenue->permission_id = '21';
        $deleteRevenue->timestamps = false;
        $deleteRevenue->save();


    }
}
