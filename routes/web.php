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
     * Clients
     */
    Route::group(['prefix' => 'clients'], function () {
        Route::get('/data', 'ClientsController@anyData')->name('clients.data');
        Route::post('/create/cvrapi', 'ClientsController@cvrapiStart');
        Route::post('/upload/{id}', 'DocumentsController@upload');
        Route::patch('/updateassign/{id}', 'ClientsController@updateAssign');
    });
        Route::resource('clients', 'ClientsController');
	    Route::resource('documents', 'DocumentsController');
	
    /**
     * Members
     */
    Route::group(['prefix' => 'members'], function () {
        Route::get('/data', 'MembersController@anyData')->name('members.data');
        Route::post('/create/cvrapi', 'MembersController@cvrapiStart');
        Route::post('/upload/{id}', 'DocumentsController@upload');
        Route::patch('/updateassign/{id}', 'MembersController@updateAssign');
    });
        Route::resource('members', 'MembersController');
    
    /**
     * Meetings
     */
    Route::group(['prefix' => 'meetings'], function () {
        Route::get('/data', 'MeetingsController@anyData')->name('meetings.data');
        Route::post('/upload/{id}', 'MeetingsController@upload');
        Route::patch('/updateassign/{id}', 'MeetingsController@updateAssign');
    });
        Route::resource('meetings', 'MeetingsController');

    /**
     * Attendance
     */
    Route::group(['prefix' => 'attendance'], function () {
        Route::get('/data', 'AttendanceController@anyData')->name('attendance.data');
        Route::post('/upload/{id}', 'AttendanceController@upload');
        Route::patch('/updateassign/{id}', 'AttendanceController@updateAssign');
    });
        Route::resource('attendance', 'AttendanceController');

    /**
     * Guests
     */
    Route::group(['prefix' => 'guests'], function () {
        Route::get('/data', 'GuestController@anyData')->name('guests.data');
        Route::post('/upload/{id}', 'GuestController@upload');
        Route::patch('/updateassign/{id}', 'GuestController@updateAssign');
    });
        Route::resource('guests', 'GuestController');
    
    /**
     * Referral
     */
    Route::group(['prefix' => 'referral'], function () {
        Route::get('/data', 'ReferralController@anyData')->name('referrals.data');
        Route::post('/upload/{id}', 'ReferralController@upload');
        Route::patch('/updateassign/{id}', 'ReferralController@updateAssign');
    });
        Route::resource('referrals', 'ReferralController');
    
    /**
     * Referral
     */
    Route::group(['prefix' => 'onetoones'], function () {
        Route::get('/data', 'OnetoOneController@anyData')->name('onetoones.data');
        Route::post('/upload/{id}', 'OnetoOneController@upload');
        Route::patch('/updateassign/{id}', 'OnetoOneController@updateAssign');
    });
        Route::resource('onetoones', 'OnetoOneController');
    
    /**
     * Revenue
     */
    Route::group(['prefix' => 'revenues'], function () {
        Route::get('/data', 'RevenueController@anyData')->name('revenues.data');
        Route::post('/upload/{id}', 'RevenueController@upload');
        Route::patch('/updateassign/{id}', 'RevenueController@updateAssign');
    });
        Route::resource('revenues', 'RevenueController');
    
      
    
    /**
     * Settings
     */
    Route::group(['prefix' => 'settings'], function () {
        Route::get('/', 'SettingsController@index')->name('settings.index');
        Route::patch('/permissionsUpdate', 'SettingsController@permissionsUpdate');
        Route::patch('/overall', 'SettingsController@updateOverall');
    });

    /**
     * Departments
     */
        Route::resource('departments', 'DepartmentsController'); 

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
