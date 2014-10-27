<?php

class UserController extends BaseController{
    
    public function home(){
        if(!Auth::check()){
            return View::make('login');
        }
        else if(Auth::user()->type == 'admin'){
            $userTrips = UserTrip::with('user', 'trip')->where('waitlisted', '=', 0)->where('approved', '=', 0)->get();
            
            return View::make('admin_home', compact('userTrips'));
        }
        else{
            $userTrip = UserTrip::where('user_id', '=', Auth::user()->id)->first();
            if(!$userTrip){
                $trips = Trip::where('open', '=', 1)->get();
                return View::make('select_trip', compact('trips'));
            }
            else{
                if($userTrip->waitlisted){
                    return "you have been waitlisted, would you like to select another trip";
                }
                else if($userTrip->approved){
                    return View::make('dashboard');
                }
                else{
                    return View::make('awaiting_approval', compact('userTrip'));
                }
            }
        }
    } 

    public function login(){
        if(Auth::attempt(array('email'=>Input::get('email'),'password'=>Input::get('password')))){
            return Redirect::to('/');
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
        if(!User::isValid(Input::all())){
            
            return Redirect::to('/register')->withInput();
        }
            
        $user = new User();
        $user->email = Input::get('email');
        $user->password = Hash::make(Input::get('password'));
        $user->fname = Input::get('first_name');
        $user->mname = Input::get('middle_name');
        $user->lname = Input::get('last_name');
        $user->dob = Input::get('dob');
        $user->gender = Input::get('gender');
        $user->type = (Input::get('isStudent') == null?'non-student':'student');
        $user->phone_no = Input::get('cell');
        $user->address = Input::get('campus_address');
        $user->passport_no = Input::get('passport');
        $user->country = Input::get('passport_country');
        $user->emergency_contact_name = Input::get('emergency_name');
        $user->emergency_contact_address = Input::get('emergency_street');
        $user->emergency_contact_phone = Input::get('emergency_phone');
        $user->student_id = Input::get('id_number');
        $user->class_year = Input::get('class');
        $user->campus_box = Input::get('campus_box');
        
        $user->save();
    
        Auth::login($user);
        
        Session::flash('registration_success',1);
    
        return Redirect::to('/');
    }
}


