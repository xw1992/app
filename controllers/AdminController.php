<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class AdminController extends BaseController {

    public function displayManageParticipants() {
        $users = User::with('userTrip')->get();
        $trips = Trip::with('tripForm.form')->get();
        return View::make('manage_participants', compact('users', 'trips'));
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
        Session::flash("adminSuccess", "{$userTrip->user->fname} successfully approved for {$userTrip->trip->name}.");
        return Redirect::to('/manageParticipants');
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
}
