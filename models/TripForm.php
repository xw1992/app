<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class TripForm extends Eloquent{ 
	
	protected $table = 'trip_forms';

    public function tripForm() {
        return $this->belongsTo('Trip');
    }
}