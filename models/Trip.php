<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Trip extends Eloquent{ 
    public function tripForm(){
    	return $this->hasMany('TripForm');
    }
    public function tripUser(){
    	return $this->hasMany('UserTrip');
    }

        public static $rules = [
        'name' => 'required',
        'begin_date' => 'required|date',
        'end_date' => 'required|date',
        'term' => 'required',
        'cost' => 'required',
        'first_due_day' => 'required|date',
        'second_due_day' => 'required|date',
        'capacity' => 'required'
    ];

    public static function isValid($data) {
        $validation = Validator::make($data, static::$rules);

        if ($validation->passes()) {
            return true;
        }
        Session::flash('tripError', $validation->messages()->all());
        return false;
    }
}