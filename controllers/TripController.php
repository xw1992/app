<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class TripController extends BaseController {

    public function selectTrip() {
        $tripUser = new UserTrip();
        $tripUser->waitlisted = 0;
        $tripUser->approved = 0;
        $tripUser->user_id = Auth::user()->id;
        $tripUser->trip_id = Input::get('trip_id');
        $tripUser->save();
        Session::flash("userSuccess", "You have successfully selected a trip.");
        return Redirect::to('/');
    }

    public function removeFromWaitlist() {
        $userTrip = UserTrip::with('user', 'trip')->find(Input::get('id'));
        $userTrip->trip->waitlist_no--;
        $userTrip->trip->save();
        $userTrip->delete();
        Session::flash("userSuccess", "You have successfully been removed from the waitlist.");
        return Redirect::to('/');
    }

    public function displayManageTrips(){
        $trips = Trip::get();
        return View::make('manage_trips', compact('trips', ));
    }

    public function changeTripStatus(){
        $trip = Trip::find(Input::get('id'));
        if($trip->open){
            $trip->open = 0;
            $trip->save();
            Session::flash("adminSuccess", "You have successfully closed the trip: {$name}.");
            return Redirect::to('/manageTrips');
        }
        else{
            $trip->open = 1;
            $trip->save();
            Session::flash("adminSuccess", "You have successfully opened the trip: {$name}.");
            return Redirect::to('/manageTrips');
        }
    }

    public function createTrip(){
        $trip = new Trip();
        $trip->name = Input::get('name');
        $trip->international = Input::get('international');
        $trip->open = Input::get('open');
        $trip->enroll_no = Input::get('enroll_no');
        $trip->capacity = Input::get('capacity');
        $trip->waitlist_no = Input::get('waitlist_no');
        $trip->cost = Input::get('cost');
        $trip->first_due_day = Input::get('first_due_day');
        $trip->second_due_day = Input::get('second_due_day');
        $trip->begin_date = Input::get('begin_date');
        $trip->end_date = Input::get('end_date');
        Session::flash("adminSuccess", "You have successfully created the trip: {$name}.");
        return Redirect::to('/manageTrips');
    }

    public function deleteTrip(){
        $trip = Trip::find(Input::get('id'));
        $trip->delete();
        Session::flash("adminSuccess", "You have successfully deleted the trip.");
        return Redirect::to('/manageTrips');
    }
}
