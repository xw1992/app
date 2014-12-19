<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class AdminController extends BaseController {

    public function displayManageParticipants() {
        $users = User::with('userTrip','payment','userForm')->get();
        $trips = Trip::with('tripForm.form')->get();
        /*
        foreach ($users as $user) {
            var_dump($user->userForm);
        }
        return;
*/
        return View::make('manage_participants', compact('users', 'trips'));
    }

    public function changePassword(){
        $user = User::find(Input::get('user_id'));
        $new = Input::get('new_password');
        $confirm = Input::get('confirm_password');
        if($new == $confirm and $new >=6){
            $user->Password = Hash::make($new);
            $user->save();
            Session::flash('adminSuccess', 'Password changed successfully!');
            return Redirect::back();
        }else{
            Session::flash('passwordError', 1);
            return Redirect::back();
        }
    }

    public function waitlist() {
        $userTrip = UserTrip::with('user', 'trip')->find(Input::get('id'));
        $userTrip->waitlisted = 1;
        $userTrip->save();
        $userTrip->trip->waitlist_no++;
        $userTrip->trip->save();
        Session::flash("adminSuccess", "{$userTrip->user->fname} successfully waitlisted for {$userTrip->trip->name}.");
        return Redirect::to('/manageParticipants');
    }

    public function approve() {
        $userTrip = UserTrip::with('user', 'trip')->find(Input::get('id'));
        $userTrip->trip->enroll_no++;
        if ($userTrip->waitlisted) {
            $userTrip->trip->waitlist_no--;
        }
        $userTrip->trip->save();
        $userTrip->approved = 1;
        $userTrip->waitlisted = 0;
        $userTrip->save();

        $data = [
            'name' => $userTrip->user->fname,
            'trip_name' => $userTrip->trip->name
        ];
        Mail::send('emails.approval', $data, function($message) use ($userTrip){
            $message->to($userTrip->user->email)->subject('Your Immersion Trip application has been approved!');
        });

        Session::flash("adminSuccess", "{$userTrip->user->fname} successfully approved for {$userTrip->trip->name}.");
        return Redirect::to('/manageParticipants');
    }

    public function remindPayments(){
        $c_message = Input::get('custom_message');

        $trips = Trip::all();
        foreach ($trips as $trip) {
            $userTrips = UserTrip::with('user')->where('trip_id','=',$trip->id)->get();
            foreach ($userTrips as $userTrip) {
                $data = [
                    'c_message' => $c_message,
                    'trip' => $trip,
                    'userTrip' => $userTrip,
                    'due_amount' => ($trip->cost - 
                    $userTrip->deposit - $userTrip->scholarship_award - $userTrip->leader_award-
                    $userTrip->catholic_award)/2.0
                ];

                Mail::send('emails.paymentReminder', $data, function($message) use ($userTrip){
                    $message->to($userTrip->user->email)->subject('Your payments for the Immersion Trip are due soon!');
                });

            }
        }
        Session::flash('adminSuccess', 'The reminder emails have been sent!');
        return Redirect::back();
        
    }

    public function assignTripLeader() {
        $userTrip = UserTrip::with('user', 'trip')->find(Input::get('id'));
        if ($userTrip->trip_leader) {
            $userTrip->trip_leader = 0;
            $userTrip->save();
            Session::flash("adminSuccess", "{$userTrip->user->fname} is no longer a Trip leader for {$userTrip->trip->name}.");
            return Redirect::to('/manageParticipants');
        } else {
            $userTrip->trip_leader = 1;
            $userTrip->save();
            Session::flash("adminSuccess", "{$userTrip->user->fname} is now a Trip leader for {$userTrip->trip->name}.");
            return Redirect::to('/manageParticipants');
        }
    }

    public function changeTrip() {
        $userTrip = UserTrip::with('user', 'trip')->find(Input::get('id'));
        if($userTrip->approved){
            $userTrip->trip->enroll_no--;
        }
        else if($userTrip->waitlisted){
            $userTrip->trip->waitlist_no--;
        }
        $userTrip->trip->save();
        $userTrip->trip_id = Input::get('trip_id');
        $userTrip->approved = 0;
        $userTrip->waitlisted = 0;
        $userTrip->trip_leader = 0;
        $userTrip->save();
        Session::flash("adminSuccess", "{$userTrip->user->fname} successfully changed trips to {$userTrip->trip->name}.");
        return Redirect::to('/manageParticipants');
    }

    public function removeFromTrip() {
        $userTrip = UserTrip::with('user', 'trip')->find(Input::get('id'));
        if ($userTrip->approved) {
            $userTrip->trip->enroll_no--;
            $userTrip->trip->save();
        }
        if ($userTrip->waitlisted) {
            $userTrip->trip->waitlist_no--;
            $userTrip->trip->save();
        }
        $userTrip->save();
        $userTrip->delete();
        Session::flash("adminSuccess", "{$userTrip->user->fname} has been successfully removed from the trip.");
        return Redirect::to('/manageParticipants');
    }

    public function displayStudentInfo($user_id){
        $user = User::find($user_id);
        if($user){
            $userInfo = UserInfo::find($user_id);
            return View::make('/student_info', compact('userInfo', 'user'));
        }
        else{
            return Redirect::to('/');
        }
    }

    public function saveStudentFinances(){
        //dd(Input::all());
        $trip_id = Input::get('trip_id');
        $userTrips = UserTrip::with('user')->where('trip_id','=',$trip_id)->get();
        foreach ($userTrips as $userTrip) {
            $date = Input::get('payment_date'.$userTrip->user_id);
            if($date){
                $validation = Validator::make(['date'=>$date], 
                    ['date' => 'date']);
                if(!$validation->passes()){
                    Session::flash('adminFailure', 'Failed to save: please check if the date format(YYYY/MM/DD) is correct.');
                    return Redirect::to('/manageParticipants');
                }
            }
        }
        foreach ($userTrips as $userTrip) {
            $userTrip->deposit = Input::get('deposit'.$userTrip->user_id);
            $userTrip->leader_award = Input::get('leader_award'.$userTrip->user_id);
            $userTrip->catholic_award = Input::get('catholic_award'.$userTrip->user_id);
            $userTrip->scholarship_award = Input::get('scholarship_award'.$userTrip->user_id);  
            $amount = Input::get('payment_amount'.$userTrip->user_id);
            $date = Input::get('payment_date'.$userTrip->user_id);
            if($amount and $date){
                $payment = new Payment;
                $payment->user_id = $userTrip->user_id;
                $payment->user_trip_id = $userTrip->id;
                $payment->amount = $amount;
                $payment->date = $date;
                $payment->save();
                $userTrip->total_paid += $amount;
            }
            $userTrip->save();

        }
        Session::flash('indicator', 2);
        Session::flash('adminSuccess', 'You have successfully saved the finance information.');
        return Redirect::to('/manageParticipants');
    }

    public function editPayments(){
        $payments = Payment::where('user_id','=',Input::get('user_id'))->get();
        $user_trip = UserTrip::where('user_id','=',Input::get('user_id'))->first();
        $amount_paid = 0;
        foreach ($payments as $payment) {
            $payment->amount = Input::get('amount'.$payment->id);
            $payment->date = Input::get('date'.$payment->id);
            $payment->save();
            $amount_paid += $payment->amount;
        }
        $user_trip->total_paid = $amount_paid;
        $user_trip->save();
        Session::flash('indicator', 2);
        return Redirect::back();
    }

    /*
    public function editFinances(){
        $userTrip = UserTrip::with('user', 'trip', 'payment')->find(Input::get('id'));
        $userTrip->deposit = Input::get('deposit');
        $userTrip->scholarship_award = Input::get('scholarship_award');
        $userTrip->catholic_award = Input::get('catholic_award');
        $userTrip->leader_award = Input::get('leader_award');
        $userTrip->save();  

        $payments = 0;
        if( payment has info ){
            $inputPament = new Payment();
            $inputPayment->user_id = $userTrip->user->id;
            $inputPayment->user_trip_id = $userTrip->id;
            $inputPayment->amount = Input::get('amount');
            $inputPayment->date = Input::get('date');
            $inputPayment->save();
            $payments = $inputPayment->amount;
        }   

        foreach($userTrip->payment as $payment){
            $payments += $payment->amount;
        }

        return $userTrip->trip->cost - $userTrip->deposit - $usertrip->scholarship_award - $userTrip->catholic_award - $userTrip->leader_award - $payments;
    }
    */
    /*
    public function editStudentForms(){
        $userTrip = UserTrip::with('trip', 'tripForm')->find(Input::get('id'));
        $userForms = UserForm::where('user_id', '=', $userTrip->user_id)->get;
        $userFormArray = [];
        foreach($userForms as $userForm){
            $userFormArray[$userForm->form_id] = $userForm;
        }
        foreach($userTrip->tripForm as $tripForm){
            if( checkbox is ticked ){
                if(!array_key_exists($tripForm->form_id, $userFormArray)){
                    $userForm = new UserForm();
                    $userForm->user_id = $userTrip->user_id;
                    $userForm->form_id = $tripForm->form_id;
                    $userForm->save();
                }  
            }
            else{
                if(array_key_exists($tripForm->form_id, $userFormArray)){
                   $userFormArray[$tripForm->form_id]->delete();
                }
            }
        }
        return 1;
    }
    */

    public function editStudentInfo(){
        $user = User::find(Input::get('id'));
        if (!User::editValid(Input::all())) {
            Session::flash('admin_error', 1);
            return Redirect::to('/info/'.$user->id);
        }
        
        $userInfo = UserInfo::find(Input::get('id'));

        $user->fname = Input::get('first_name');
        $user->mname = Input::get('mname');
        $user->lname = Input::get('last_name');
        $user->dob = Input::get('dob');
        $user->gender = Input::get('gender');
        $user->country = Input::get('country');
        $user->passport_no = Crypt::encrypt(Input::get('passport'));
        $user->address = Input::get('campus_address');
        $user->phone_no = Input::get('cell');
        $user->emergency_contact_name = Input::get('emergency_name');
        $user->emergency_contact_phone = Input::get('emergency_phone');
        $user->emergency_contact_address = Input::get('emergency_street');
        $user->student_id = Input::get('id_number');
        $user->campus_box = Input::get('campus_box');
        $user->class_year = Input::get('class');

        $user->save();

        if($userInfo){
            if (!UserInfo::isValid(Input::all())) {
                Session::flash('admin_error', 1);
                return Redirect::to('/info/'.$user->id);
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

        Session::flash("adminSuccess", "{$user->fname}'s information has been updated.");
        return Redirect::to('/info/'.$user->id);
    }
}
