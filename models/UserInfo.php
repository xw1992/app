<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class UserInfo extends Eloquent {
    protected $table = 'user_infos';
    protected $primaryKey = 'user_id';

    public static $rules = [
        'reason' => 'required',
        'autobiography' => 'required'
    ];

    public static function isValid($data) {
        $validation = Validator::make($data, static::$rules);

        if ($validation->passes()) {
            return true;
        }
        Session::flash('infoError', $validation->messages()->all());
        return false;
    }
}
