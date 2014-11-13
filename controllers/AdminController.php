<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class AdminController extends BaseController {

    public function displayManageParticipants() {
        $users = User::with('userTrip')->get();
        $trips = Trip::get();
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

    public function grantAward() {
        $userTrip = UserTrip::with('user', 'trip')->find(Input::get('id'));
        $userTrip->scholarship_award = Input::get('scholarship_award');
        $userTrip->catholic_award = Input::get('catholic_award');
        $userTrip->leader_award = Input::get('leader_award');
        $userTrip->save();
        Session::flash("adminSuccess", "{$userTrip->user->fname} has been successfully changed awards.");
        return Redirect::to('/manageParticipants');
    }

    public function inputPayment() {
        $userTrip = UserTrip::with('user', 'trip')->find(Input::get('id'));
        $payment = new Payment;
        $payment->user_id = $userTrip->user->id;
        $payment->user_trip_id = $userTrip->id;
        $payment->amount = Input::get('amount');
        $payment->date = Input::get('year', 'month', 'day');
        $payment->save();
        Session::flash("adminSuccess", "{$userTrip->user->fname} has created a payment of {$payment->amount}.");
        return Redirect::to('/manageParticipants');
    }
}
