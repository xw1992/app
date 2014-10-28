<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class UserInfo extends Eloquent{    
    public static $rules = [
        
    ];
    
    public static $messages = [
        
    ];
    
    public static function isValid($data){
            $validation = Validator::make($data, static::$rules, static::$messages);
        
            if($validation->passes()){
                return true;
            }
            Session::flash('formError', $validation->messages()->all());
            return false;
        } 
}