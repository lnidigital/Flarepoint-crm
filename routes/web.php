<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/
Route::auth();
Route::get('/logout', 'Auth\LoginController@logout');
Route::group(['middleware' => ['auth']], function () {
    
    /**
     * Main
     */
        Route::get('/', 'PagesController@dashboard');
        Route::get('dashboard', 'PagesController@dashboard')->name('dashboard');
        Route::post('dashboard', 'PagesController@store')->name('dashboard.store');
        
    /**
     * Users
     */
    Route::group(['prefix' => 'users'], function () {
        Route::get('/data', 'UsersController@anyData')->name('users.data');
        Route::get('/taskdata/{id}', 'UsersController@taskData')->name('users.taskdata');
        Route::get('/leaddata/{id}', 'UsersController@leadData')->name('users.leaddata');
        Route::get('/clientdata/{id}', 'UsersController@clientData')->name('users.clientdata');
        Route::get('/users', 'UsersController@users')->name('users.users');
    });
        Route::resource('users', 'UsersController');

	 /**
     * Roles
     */
        Route::resource('roles', 'RolesController');
    
    /**
     * Contacts
     */
    Route::group(['prefix' => 'contacts'], function () {
        Route::get('/data', 'ContactsController@anyData')->name('contacts.data');
        Route::post('/create/cvrapi', 'ContactsController@cvrapiStart');
        Route::post('/upload/{id}', 'DocumentsController@upload');
        Route::patch('/updateassign/{id}', 'ContactsController@updateAssign');
    });
        Route::resource('contacts', 'ContactsController');
    
    /**
     * Members
     */
    Route::group(['prefix' => 'members'], function () {
        Route::get('/data', 'MembersController@anyData')->name('members.data');
        Route::post('/upload/{id}', 'DocumentsController@upload');
        Route::patch('/updateassign/{id}', 'MembersController@updateAssign');
    });
        Route::resource('members', 'MembersController');

    /**
     * Guests
     */
    Route::group(['prefix' => 'guests'], function () {
        Route::get('/data', 'GuestController@anyData')->name('guests.data');
        Route::get('/contactdata/{id}', 'GuestController@contactData')->name('guests.contactdata');
        Route::post('/upload/{id}', 'DocumentsController@upload');
        Route::patch('/updateassign/{id}', 'GuestController@updateAssign');
    });
        Route::resource('guests', 'GuestController');
    
    
    /**
     * Meetings
     */
    Route::group(['prefix' => 'meetings'], function () {
        Route::get('/data', 'MeetingsController@anyData')->name('meetings.data');
        Route::get('/contactdata/{id}', 'MeetingsController@contactData')->name('meetings.contactdata');
        Route::post('/upload/{id}', 'MeetingsController@upload');
        Route::patch('/updateassign/{id}', 'MeetingsController@updateAssign');
    });
        Route::resource('meetings', 'MeetingsController');

    /**
     * Attendance
     */
    Route::group(['prefix' => 'attendance'], function () {
        Route::get('/data', 'AttendanceController@anyData')->name('attendance.data');
        Route::get('/meetingdata/{meetingid}/{statusid}', 'AttendanceController@attendanceData')->name('attendance.meetingdata');
        Route::post('/upload/{id}', 'AttendanceController@upload');
        Route::patch('/updateassign/{id}', 'AttendanceController@updateAssign');
    });
        Route::resource('attendance', 'AttendanceController');

    /**
     * Referral
     */
    Route::group(['prefix' => 'referrals'], function () {
        Route::get('/data', 'ReferralController@anyData')->name('referrals.data');
        Route::get('/meetingdata/{meetingid}', 'ReferralController@meetingData')->name('referrals.meetingdata');
        Route::get('/datagiven/{id}', 'ReferralController@referralsGivenData')->name('referrals.datagiven');
        Route::get('/datareceived/{id}', 'ReferralController@referralsReceivedData')->name('referrals.datareceived');
        Route::post('/upload/{id}', 'ReferralController@upload');
        Route::patch('/updateassign/{id}', 'ReferralController@updateAssign');
    });
        Route::resource('referrals', 'ReferralController');
    
    /**
     * 1-to-1s
     */
    Route::group(['prefix' => 'onetoones'], function () {
        Route::get('/data', 'OnetoOneController@anyData')->name('onetoones.data');
        Route::get('/meetingdata/{meetingid}', 'OnetoOneController@meetingData')->name('onetoones.meetingdata');
        Route::get('/contactdata{id}', 'OnetoOneController@contactData')->name('onetoones.contactdata');
        Route::post('/upload/{id}', 'OnetoOneController@upload');
        Route::patch('/updateassign/{id}', 'OnetoOneController@updateAssign');
    });
        Route::resource('onetoones', 'OnetoOneController');
    
    /**
     * Revenue
     */
    Route::group(['prefix' => 'revenues'], function () {
        Route::get('/data', 'RevenueController@anyData')->name('revenues.data');
        Route::get('/contactdata/{id}', 'RevenueController@contactData')->name('revenues.contactdata');
        Route::post('/upload/{id}', 'RevenueController@upload');
        Route::patch('/updateassign/{id}', 'RevenueController@updateAssign');
    });
        Route::resource('revenues', 'RevenueController');
     
    /**
     * Revenue
     */
    Route::group(['prefix' => 'organizations'], function () {
        Route::get('/data', 'OrganizationsController@anyData')->name('organizations.data');
        Route::get('/userdata/{id}', 'OrganizationsController@userData')->name('organizations.userdata');
        Route::post('/upload/{id}', 'OrganizationsController@upload');
        Route::patch('/updateassign/{id}', 'OrganizationsController@updateAssign');
    });
        Route::resource('organizations', 'OrganizationsController');
       
    
    /**
     * Settings
     */
    Route::group(['prefix' => 'settings'], function () {
        Route::get('/', 'SettingsController@index')->name('settings.index');
        Route::patch('/permissionsUpdate', 'SettingsController@permissionsUpdate');
        Route::patch('/overall', 'SettingsController@updateOverall');
    });

    /**
     * Groups
     */
    Route::group(['prefix' => 'groups'], function () {
        Route::get('/data', 'GroupsController@anyData')->name('groups.data');
        Route::post('/upload/{id}', 'GroupsController@upload');
        Route::patch('/updateassign/{id}', 'GroupsController@updateAssign');
    });
        Route::resource('groups', 'GroupsController'); 

    /**
     * Integrations
     */
    Route::group(['prefix' => 'integrations'], function () {
        Route::get('Integration/slack', 'IntegrationsController@slack');
    });
        Route::resource('integrations', 'IntegrationsController');

    /**
     * Notifications
     */
    Route::group(['prefix' => 'notifications'], function () {
        Route::post('/markread', 'NotificationsController@markRead')->name('notification.read');
        Route::get('/markall', 'NotificationsController@markAll');
        Route::get('/{id}', 'NotificationsController@markRead');
    });

});
