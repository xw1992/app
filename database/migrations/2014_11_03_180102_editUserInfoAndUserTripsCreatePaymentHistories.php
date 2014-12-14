<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditUserInfoAndUserTripsCreatePaymentHistories extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        //
        Schema::table('user_infos', function($table) {
            $table->integer('trip_id')->unsigned();
            $table->foreign('trip_id')->references('id')->on('trips')->onDelete('cascade');
        });

        Schema::table('trip_users', function($table) {
            $table->decimal('deposit')->default(0);
            $table->decimal('leader_award')->default(0);
            $table->decimal('scholarship_award')->default(0);
            $table->decimal('catholic_award')->default(0);
            $table->decimal('total_paid')->default(0);
            $table->decimal('total_due')->default(0);
        });

        Schema::create('payment_histories', function($table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('user_trip_id')->unsigned();
            $table->foreign('user_trip_id')->references('id')->on('trip_users')->onDelete('cascade');
            $table->decimal('amount');
            $table->date('date');
            $table->timestamps();
        });

        Schema::table('trips', function($table) {
            $table->decimal('cost')->default(0);
            $table->date('first_due_day');
            $table->date('second_due_day');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        //
        Schema::table('user_infos', function($table) {
            $table->dropColumn('trip_id');
        });

        Schema::table('trip_users', function($table) {
            $table->dropColumn('deposit');
            $table->dropColumn('leader_award');
            $table->dropColumn('scholarship_award');
            $table->dropColumn('catholic_award');
            $table->dropColumn('total_due');
        });

        Schema::table('trips', function($table) {
            $table->dropColumn('cost');
            $table->dropColumn('first_due_day');
            $table->dropColumn('second_due_day');
        });

        Schema::drop('payment_histories');
    }

}
