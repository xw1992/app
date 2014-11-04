<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class AdminController extends BaseController{
    public function waitlist(){
        $userTrip = UserTrip::with('user', 'trip')->find(Input::get('id'));
        $userTrip->waitlisted = 1;
        $userTrip->save();
        $userTrip->trip->waitlist_no++;
        $userTrip->trip->save();
        Session::flash("adminSuccess", "{$userTrip->user->fname} successfully waitlisted for {$userTrip->trip->name}.");
        return Redirect::to('/');
    }

    public function approve(){
        $userTrip = UserTrip::with('user', 'trip')->find(Input::get('id'));
        $userTrip->approved = 1;
        $userTrip->save();
        $userTrip->trip->enroll_no++;
        $userTrip->trip->save();
        Session::flash("adminSuccess", "{$userTrip->user->fname} successfully approved for {$userTrip->trip->name}.");
        return Redirect::to('/');
    }
    
    public function approveWaitlistedApplicant(){
        $userTrip = UserTrip::with('user', 'trip')->find(Input::get('id'));
        $userTrip->approved = 1;
        $userTrip->waitlisted = 0;
        $userTrip->save();
        $userTrip->trip->enroll_no++;
        $userTrip->trip->waitlist_no--;
        $userTrip->trip->save();
        Session::flash("adminSuccess", "{$userTrip->user->fname} successfully approved for {$userTrip->trip->name}.");
        return Redirect::to('/');
    }
    
    public function assignTripLeader(){
        $userTrip = UserTrip::with('user', 'trip')->find(Input::get('id'));
        if($userTrip->trip_leader){
            $userTrip->trip_leader = 0;
            $userTrip->user->save();
            Session::flash("adminSuccess", "{$userTrip->user->fname} successfully unassigned as a Trip leader for {$userTrip->trip->name}.");
            return Redirect::to('/');
        }
        else{
            $userTrip->trip_leader = 1;
            $userTrip->user->save();
            Session::flash("adminSuccess", "{$userTrip->user->fname} successfully assigned as a Trip leader for {$userTrip->trip->name}.");
            return Redirect::to('/');
        }
    }
    
    public function changeTrip(){
        $userTrip = UserTrip::with('user', 'trip')->find(Input::get('id'));
        $userTrip->trip_id = Input::get(/*attribute for changing a trip*/);
        $userTrip->save();
        Session::flash("adminSuccess", "{$userTrip->user->fname} successfully changed trips to {$userTrip->trip->name}.");
        return Redirect::to('/');
    }
    
    public function removeFromTrip(){
        $userTrip = UserTrip::with('user', 'trip')->find(Input::get('id'));
        $userTrip->trip->enroll_no--;
        $userTrip->save();
        $userTrip->delete();
        Session::flash("adminSuccess", "{$userTrip->user->fname} has been successfully removed from the trip.");
        return Redirect::to('/');
    }
   
    public function grantLeaderAward(){
        $userTrip = UserTrip::with('user', 'trip')->find(Input::get('id'));
        $userTrip->leader_award = 500;
        $userTrip->save();
        Session::flash("adminSuccess", "{$userTrip->user->fname} has been successfully granted a Leader award.");
        return Redirect::to('/');
    }
    
    public function grantScholarshipAward(){
        $userTrip = UserTrip::with('user', 'trip')->find(Input::get('id'));
        $userTrip->scholarship_award = 500;
        $userTrip->save(); 
        Session::flash("adminSuccess", "{$userTrip->user->fname} has been successfully granted a Scholarship award.");
        return Redirect::to('/');
    }
    
    public function grantCatholicAward(){
        $userTrip = UserTrip::with('user', 'trip')->find(Input::get('id'));
        $userTrip->catholic_award = 500;
        $userTrip->save();
        Session::flash("adminSuccess", "{$userTrip->user->fname} has been successfully granted a Catholic award.");
        return Redirect::to('/');
    }
    
    public function inputPayment(){
        $userTrip = UserTrip::with('user', 'trip')->find(Input::get('id'));
        $payment = new Payments;
        $payment->user_id = $userTrip->user->id;
        $payment->trip_trip_id = $userTrip->id;
        $payment->amount = Input::get(/* amount put in, attribute in front end */);
        $payment->date = Input::get(/*attribute for date*/);
        $payment->save();
        // somehow add this input to the users previous inputs?
        // currently no value in trip_users for how much each student has paid
        Session::flash("adminSuccess", "{$userTrip->user->fname} has created a payment of {$payment->amount}.");
        return Redirect::to('/');
    }
}