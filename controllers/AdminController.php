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
        Session::flash("adminSuccess", "{$userTrip->user->fname} successfully waitlisted for {$userTrip->trip->name}");
        return Redirect::to('/');
    }

    public function approve(){
        $userTrip = UserTrip::with('user', 'trip')->find(Input::get('id'));
        $userTrip->approved = 1;
        $userTrip->save();
        Session::flash("adminSuccess", "{$userTrip->user->fname} successfully approved for {$userTrip->trip->name}");
        return Redirect::to('/');
    }
}