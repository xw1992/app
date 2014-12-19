<?php

// csrf filter
Route::when('*', 'csrf', ['post', 'put', 'patch']);

// 'auth' filter is applied to this group
// only authenticated user will be able access the routes in this group
/*
Route::get('encrypt', function(){
    $users = User::all();
    foreach ($users as $user) {
        $user->passport_no = Crypt::encrypt($user->passport_no);
        $user->save();
    }
    return "done";
});
*/

Route::group(['before' => 'auth'], function() {

    Route::get('/authTest', function() {
        return "You are logged in.";
    });

    Route::get('/logout', 'UserController@logout');

    Route::post('/selectTrip', 'TripController@selectTrip');

    Route::post('/waitlistChangeTrip', 'TripController@waitlistChangeTrip');

    Route::post('/saveInfo', 'UserController@saveInfo');

    Route::post('/removeFromWaitlist', 'TripController@removeFromWaitlist');

    Route::get('/myInfo', 'UserController@displayMyInfo');

    Route::post('/editMyInfo', 'UserController@editMyInfo');

    Route::post('/changeMyPassword', 'UserController@changeMyPassword');
});

// 'admin' filter is applied to this group
// only authenticated admin will be able access the routes in this group
Route::group(['before' => 'admin'], function() {

    Route::get('/adminTest', function() {
        return "You are an admin.";
    });

    Route::post('/changePassword', 'AdminController@changePassword');

    Route::post('remindPayments', 'AdminController@remindPayments');

    Route::get('/manageParticipants', 'AdminController@displayManageParticipants');

    Route::get('/reports', 'ReportController@showReports');

    Route::post('/waitlistApplicant', 'AdminController@waitlist');

    Route::post('/changeTripTerm', 'TripController@changeTripTerm');

    Route::post('/saveStudentForms', 'FormController@saveStudentForms');

    Route::post('/approveApplicant', 'AdminController@approve');

    Route::post('/assignTripLeader', 'AdminController@assignTripLeader');

    Route::post('/changeTrip', 'AdminController@changeTrip');

    Route::post('/removeFromTrip', 'AdminController@removeFromTrip');

    Route::post('/editFinances', 'AdminController@editFinances');

    Route::post('/editPayments', 'AdminController@editPayments');

    Route::get('/manageForms', 'FormController@displayManageForms');

    Route::post('/addNewForm', 'FormController@addNewForm');

    Route::post('/deleteForm', 'FormController@deleteForm');

    Route::post('/editForm', 'FormController@editForm');

    Route::get('/manageTrips', 'TripController@displayManageTrips');

    Route::post('/createTrip', 'TripController@createTrip');

    Route::post('/deleteTrip', 'TripController@deleteTrip');

    Route::post('/changeTripStatus', 'TripController@changeTripStatus');

    Route::post('/changeTripName', 'TripController@changeName');

    Route::post('/editTripDates', 'TripController@editTripDate');

    Route::post('/editTripCost', 'TripController@editFinances');

    Route::post('/changeCapacity', 'TripController@changeCapacity');

    Route::post('/changeTripType', 'TripController@changeTripType');

    Route::post('/editStudentForms', 'AdminController@editStudentForms');

    Route::get('/info/{user_id}', 'AdminController@displayStudentInfo');

    Route::post('/editStudentInfo', 'AdminController@editStudentInfo');

    Route::post('/saveStudentFinances', 'AdminController@saveStudentFinances');
});

Route::group(['before' => 'guest'], function() {
    Route::post('/login', 'UserController@login');

    Route::get('/register', 'UserController@showSignup');

    Route::post('/signup', 'UserController@signup');
});

Route::get('/', 'UserController@home');



