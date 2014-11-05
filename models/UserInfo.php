<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class UserInfo extends Eloquent {

    public static $rules = [
        'passport_no' => 'required',
        'reason' => 'required',
        'autobiography' => 'required'
    ];

    public static function isValid($data) {
        $validation = Validator::make($data, static::$rules);

        if ($validation->passes()) {
            return true;
        }
        Session::flash('formError', $validation->all());
        return false;
    }

}
