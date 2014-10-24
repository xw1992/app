<?php

class UserController extends BaseController{
    
    public function showLogin(){
        return View::make('login');
    }
    
    public function login(){
        if(Auth::attempt(array('email'=>Input::get('email'),'password'=>Input::get('password')))){
            return View::make('select_trip', compact('trips'));
        }
        Session::flash('loginError','Invalid credentials. Please try again.');
        return Redirect::to('/')->withInput();
    }
    
    public function logout(){
        Auth::logout();
        return Redirect::to('/');
    }
    
    public function showSignup(){
        return View::make('register');
    }
    
    public function signup(){
        $email = Input::get('email');
        $pass = Hash::make(Input::get('password'));
        $first_name = Input::get('first_name');
        $middle_name = Input::get('middle_name');
        $last_name = Input::get('last_name');
        $dob = Input::get('dob');
        $gender = Input::get('gender');
        $cell = Input::get('cell');
        $campus_address = Input::get('campus_address');
        $passport = Input::get('passport');
        $passport_country = Input::get('passport_country');
        $emergency_name = Input::get('emergency_name');
        $emergency_street = Input::get('emergency_street');
        $emergency_phone = Input::get('emergency_phone');
        $id_number = Input::get('id_number');
        $class = Input::get('class');
        $campus_box = Input::get('campus_box');
        $accept_terms = Input::get('accept_terms');
        $isStudent = Input::get('isStudent');
        
        if(!User::isValid(Input::all())){
            
            return Redirect::to('/register')->withInput();
        }
            
        $user = new User();
        $user->email = $email;
        $user->password = $pass;
        $user->fname = $first_name;
        $user->mname = $middle_name;
        $user->lname = $last_name;
        $user->dob = $dob;
        $user->gender = $gender;
        $user->type = ($isStudent == null?'non-student':'student');
        $user->phone_no = $cell;
        $user->address = $campus_address;
        $user->passport_no = $passport;
        $user->country = $passport_country;
        $user->emergency_contact_name = $emergency_name;
        $user->emergency_contact_address = $emergency_street;
        $user->emergency_contact_phone = $emergency_phone;
        $user->student_id = $id_number;
        $user->class_year = $class;
        $user->campus_box = $campus_box;
        
        $user->save();
    
        Auth::login($user);
        
        Session::flash('registration_success',1);
    
        return View::make('select_trip', comptact('trips'));
    }
}


