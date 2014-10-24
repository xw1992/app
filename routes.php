<?php

// csrf filter
Route::when('*', 'csrf', ['post', 'put', 'patch']);

// 'auth' filter is applied to this group
// only authenticated user will be able access the routes in this group
Route::group(['before' => 'auth'], function(){

	Route::get('/authTest',function(){
		return "You are logged in.";
	});

});

// 'admin' filter is applied to this group
// only authenticated admin will be able access the routes in this group
Route::group(['before' => 'admin'], function(){

	Route::get('/adminTest',function(){
		return "You are an admin.";
	});
	
});

Route::get('/dev/createAdmin', function(){
	$exist = User::where('type','=','admin')->first();
	if(!$exist){
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

Route::get('/', 'UserController@showLogin');

Route::get('/logout', 'UserController@logout');

Route::post('/login', 'UserController@login');

Route::get('/de', 'UserController@de');

Route::get('/register', 'UserController@showSignup');

Route::post('/signup', 'UserController@signup');

