<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

    use UserTrait,
        RemindableTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = array('password', 'remember_token');
    public static $rules = [
        'first_name' => 'required|alpha',
        'middle_name' => 'alpha',
        'last_name' => 'required|alpha',
        'dob' => 'required|regex:/^\d{4}\/\d{2}\/\d{2}$/',
        'gender' => 'alpha',
        'cell' => 'required',
        'campus_address' => 'required',
        'passport' => 'alpha_num',
        'passport_country' => 'alpha_dash',
        'emergency_name' => 'required|alpha',
        'emergency_street' => 'required',
        'emergency_phone' => 'required',
        'id_number' => 'numeric',
        'class' => 'numeric',
        'campus_box' => 'numeric',
        'email' => 'required|email|unique:users',
        'password' => 'required|alpha_num|min:6|confirmed',
        'password_confirmation' => 'required|min:6|alpha_num',
    ];
    public static $messages = [
        'dob.regex' => 'Your :attribute is not formatted right. Please use format "01/01/2001"',
    ];

    public static function isValid($data) {
        $validation = Validator::make($data, static::$rules, static::$messages);

        if ($validation->passes()) {
            return true;
        }
        Session::flash('registerError', $validation->messages()->all());
        return false;
    }

    public function userTrip() {
        return $this->hasOne('UserTrip');
    }

    public function userInfo(){
        return $this->hasOne('UserInfo');
    }
}
