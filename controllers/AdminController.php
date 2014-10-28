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
        $userTrip->trip->name = Input::get(/*attribute for changing a trip*/);
        $userTrip->trip->save();
        Session::flash("adminSuccess", "{$userTrip->user->fname} successfully changed trips to {$userTrip->trip->name}.");
        return Redirect::to('/');
    }
}