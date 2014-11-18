<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class UserTrip extends Eloquent {
    protected $table = 'trip_users';

    public function user() {
        return $this->belongsTo('User');
    }

    public function trip() {
        return $this->belongsTo('Trip');
    }

    public function info() {
        return $this->belongsTo('UserInfo');
    }

    public function payment() {
        return $this->belongsTo('Payments');
    }
}
