<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTripsTableTripUsersTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        //
        Schema::create('trips', function($table) {
            $table->increments('id');
            $table->string('name');
            $table->boolean('international');
            $table->boolean('open');
            // format example: "spring break 2014" 
            $table->string('term');
            $table->smallInteger('enroll_no');
            $table->smallInteger('capacity');
            $table->smallInteger('waitlist_no');
            $table->timestamps();
        });

        Schema::create('trip_users', function($table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('trip_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('trip_id')->references('id')->on('trips')->onDelete('cascade');
            $table->boolean('approved');
            $table->boolean('waitlisted');
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
        Schema::drop('trip_users');
        Schema::drop('trips');
    }

}
