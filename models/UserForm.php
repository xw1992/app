<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class UserForm extends Eloquent{ 
    protected $table = 'user_forms';

    public function userTrip() {
        return $this->belongsTo('UserTrip');
    }
}