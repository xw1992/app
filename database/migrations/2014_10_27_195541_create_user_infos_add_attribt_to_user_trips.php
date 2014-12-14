<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserInfosAddAttribtToUserTrips extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        //
        Schema::create('user_infos', function($table) {
            $table->integer('user_id')->unsigned();
            $table->primary('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('hometown_state');
            $table->string('major_academic_interest');
            $table->string('dietary_allergies_access_needs')->nullable();
            $table->string('foreign_languages')->nullable();
            $table->boolean('smoke');
            $table->text('allergy_medical_conditions')->nullable();
            $table->text('relevant_experience_interest')->nullable();
            $table->text('bio')->nullable();
            $table->timestamps();
        });

        Schema::table('trip_users', function($table) {
            $table->boolean('trip_leader')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        //
        Schema::drop('user_infos');

        Schema::table('trip_users', function($table) {
            $table->dropColumn('trip_leader');
        });
    }

}
