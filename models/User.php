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
        'dob.regex' => 'Your :attribute is not formatted correctly. Please use format "YYYY/MM/DD", eg. 1993/01/05.',
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

    public function userForm(){
        return $this->hasMany('UserForm');
    }

    public function payment(){
        return $this->hasMany('Payment');
    }

    public function hasForm($form_id){
        foreach($this->userForm as $userForm){
            if($userForm->form_id == $form_id){
                return true;
            } 
        }
        return false;
    }

}
