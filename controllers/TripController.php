<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class TripController extends BaseController{
    public function selectTrip(){
        $tripUser = new UserTrip();
        $tripUser->waitlisted = 0;
        $tripUser->approved = 0;
        $tripUser->user_id = Auth::user()->id;
        $tripUser->trip_id  = Input::get('trip_id');
        $tripUser->save();
        Session::flash("userSuccess", "You have successfully selected a trip");
        return Redirect::to('/');
    }
}