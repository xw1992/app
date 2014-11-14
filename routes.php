<?php

// csrf filter
Route::when('*', 'csrf', ['post', 'put', 'patch']);

// 'auth' filter is applied to this group
// only authenticated user will be able access the routes in this group
Route::group(['before' => 'auth'], function() {

    Route::get('/authTest', function() {
        return "You are logged in.";
    });

    Route::get('/logout', 'UserController@logout');

    Route::post('/selectTrip', 'TripController@selectTrip');

    Route::post('/waitlistChangeTrip', 'TripController@waitlistChangeTrip');

    Route::post('/saveInfo', 'UserController@saveInfo');

    Route::post('/removeFromWaitlist', 'TripController@removeFromWaitlist');
});

// 'admin' filter is applied to this group
// only authenticated admin will be able access the routes in this group
Route::group(['before' => 'admin'], function() {

    Route::get('/adminTest', function() {
        return "You are an admin.";
    });

    Route::get('/manageParticipants', 'AdminController@displayManageParticipants');

    Route::post('/waitlistApplicant', 'AdminController@waitlist');

    Route::post('/approveApplicant', 'AdminController@approve');

    Route::post('/assignTripLeader', 'AdminController@assignTripLeader');

    Route::post('/changeTrip', 'AdminController@changeTrip');

    Route::post('/removeFromTrip', 'AdminController@removeFromTrip');

    Route::post('/grantAward', 'AdminController@grantAward');

    Route::post('/inputPayment', 'AdminController@inputPayment');

    Route::get('/manageForms', 'FormController@displayManageForms');

    Route::post('/addNewForm', 'FormController@addNewForm');

    Route::post('/deleteForm', 'FormController@deleteForm');

    Route::post('/editForm', 'FormController@editForm');
});

Route::group(['before' => 'guest'], function() {
    Route::post('/login', 'UserController@login');

    Route::get('/register', 'UserController@showSignup');

    Route::post('/signup', 'UserController@signup');
});

Route::get('/dev/createAdmin', function() {
    $exist = User::where('type', '=', 'admin')->first();
    if (!$exist) {
        $admin = new User;
        $admin->email = "admin";
        $admin->password = Hash::make('Passnimda');
        $admin->fname = "admin";
        $admin->lname = "master";
        $admin->dob = "0000-00-00";
        $admin->gender = "na";
        $admin->type = "admin";
        $admin->address = "";
        $admin->emergency_contact_name = "";
        $admin->emergency_contact_phone = "";
        $admin->emergency_contact_address = "";
        $admin->save();
    }
    return Redirect::to('/');
});

Route::get('/', 'UserController@home');



