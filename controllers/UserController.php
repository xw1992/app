<?php

class UserController extends BaseController {

    public function home() {
        if (!Auth::check()) {
            return View::make('login');
        } else if (Auth::user()->type == 'admin') {
            $userTrips = UserTrip::with('user', 'trip')->where('waitlisted', '=', 0)->where('approved', '=', 0)->get();

            return View::make('admin_home', compact('userTrips'));
        } else {
            $userTrip = UserTrip::with('trip')->where('user_id', '=', Auth::user()->id)->first();
            if (!$userTrip) {
                $trips = Trip::where('open', '=', 1)->get();
                return View::make('select_trip', compact('trips'));
            } else {
                if ($userTrip->waitlisted) {
                    return View::make('waitlist', compact('userTrip'));
                } else if ($userTrip->approved) {
                    $infoCheck = UserInfo::where('user_id', '=', Auth::user()->id)->first();
                    if (!$infoCheck) {
                        $trip = $userTrip->trip;
                        return View::make('info_form', compact('trip'));
                    } else {
                        $tripForms = TripForm::with('form')->where('trip_id', '=', $userTrip->trip_id)->get();
                        $authUser = User::with('userForm')->find(Auth::id());
                        $users = User::with('userTrip')->get();
                        return View::make('dashboard', compact('users','userTrip','authUser','tripForms'));
                    }
                } else {
                    return View::make('awaiting_approval', compact('userTrip'));
                }
            }
        }
    }

    public function login() {
        if (Auth::attempt(array('email' => Input::get('email'), 'password' => Input::get('password')))) {
            return Redirect::to('/');
        }
        Session::flash('loginError', 'Invalid credentials. Please try again.');
        return Redirect::to('/')->withInput();
    }

    public function logout() {
        Auth::logout();
        return Redirect::to('/');
    }

    public function showSignup() {
        return View::make('register');
    }

    public function signup() {
        if (!User::isValid(Input::all())) {
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
        $user->type = (Input::get('id_number') == null ? 'non-student' : 'student');
        $user->phone_no = Input::get('cell');
        $user->address = Input::get('campus_address');
        $user->passport_no = Crypt::encrypt(Input::get('passport'));
        $user->country = Input::get('passport_country');
        $user->emergency_contact_name = Input::get('emergency_name');
        $user->emergency_contact_address = Input::get('emergency_street');
        $user->emergency_contact_phone = Input::get('emergency_phone');
        $user->student_id = Input::get('id_number');
        $user->class_year = Input::get('class');
        $user->campus_box = Input::get('campus_box');

        $user->save();

        Auth::login($user);

        Session::flash('registration_success', 1);

        return Redirect::to('/');
    }

    public function saveInfo() {
        if (!UserInfo::isValid(Input::all())) {
            return Redirect::to('/')->withInput();
        }
        $user = Auth::user();
        $userInfo = new UserInfo();
        $userInfo->user_id = Auth::user()->id;
        $userInfo->major_academic_interest = Input::get('major');
        $user->passport_no = Crypt::encrypt(Input::get('passport_no'));
        $userInfo->hometown_state = Input::get('hometown_state');
        $userInfo->dietary_allergies_access_needs = Input::get('dietary_needs');
        $userInfo->foreign_languages = Input::get('languages');
        $userInfo->smoke = Input::get('smoker');
        $userInfo->allergy_medical_conditions = Input::get('medical');
        $userInfo->relevant_experience_interest = Input::get('reason');
        $userInfo->bio = Input::get('autobiography');
        $userInfo->trip_id = Input::get('trip_id');

        $userInfo->save();
        $user->save();

        Session::flash('userSuccess', 'You have successfully filled out your user information sheet.');

        return Redirect::to('/');
    }

    public function displayMyInfo(){
        $user = Auth::user();
        $userInfo = UserInfo::find(Auth::id());
        Return View::make('my_info', compact('user','userInfo'));
    }

    public function editMyInfo(){
        if (!User::isValid(Input::all())) {
            return Redirect::to('/myInfo')->withInput();
        }
        $user = Auth::user();
        $userInfo = UserInfo::find(Auth::id());

        $user->fname = Input::get('fname');
        $user->mname = Input::get('mname');
        $user->lname = Input::get('lname');
        $user->dob = Input::get('dob');
        $user->gender = Input::get('gender');
        $user->country = Input::get('country');
        $user->passport_no = Crypt::encrypt(Input::get('passport_no'));
        $user->address = Input::get('address');
        $user->phone_no = Input::get('phone_no');
        $user->emergency_contact_name = Input::get('emergency_contact_name');
        $user->emergency_contact_phone = Input::get('emergency_contact_phone');
        $user->emergency_contact_address = Input::get('emergency_contact_address');
        $user->student_id = Input::get('student_id');
        $user->campus_box = Input::get('campus_box');
        $user->class_year = Input::get('class_year');

        $user->save();

        if($userInfo){
        if (!UserInfo::isValid(Input::all())) {
            return Redirect::to('/myInfo')->withInput();
        }
            $userInfo->major_academic_interest = Input::get('major_academic_interest');
            $userInfo->hometown_state = Input::get('hometown_state');   
            $userInfo->smoke = Input::get('smoke');
            $userInfo->foreign_languages = Input::get('foreign_languages');
            $userInfo->dietary_allergies_access_needs = Input::get('dietary_allergies_access_needs');
            $userInfo->allergy_medical_conditions = Input::get('allergy_medical_conditions');
            $userInfo->relevant_experience_interest = Input::get('relevant_experience_interest');
            $userInfo->bio = Input::get('bio');

            $userInfo->save();
        }   

        Session::flash("userSuccess", "Your information has been updated.");
        return Redirect::to('/myInfo');
    }

}
