<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class FormFile extends Eloquent{ 
    protected $table = 'forms';

    public function tripForm() {
        return $this->hasMany('TripForm','form_id');
    }

}