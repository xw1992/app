<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('users', function($table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('email');
            $table->string('password');
            $table->string('fname');
            $table->string('mname')->nullable();
            $table->string('lname');
            $table->date('dob');
            $table->string('gender', 6);
            $table->string('type');
            $table->string('country')->nullable();
            $table->string('passport_no')->nullable();
            $table->integer('student_id')->nullable();
            $table->string('class_year', 4)->nullable();
            $table->string('phone_no', 20)->nullable();
            $table->string('campus_box', 4)->nullable();
            $table->string('address');
            $table->string('emergency_contact_name');
            $table->string('emergency_contact_phone', 20);
            $table->string('emergency_contact_address');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        //
        Schema::drop('users');
    }

}
