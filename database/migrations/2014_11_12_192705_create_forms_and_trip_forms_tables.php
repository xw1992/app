<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormsAndTripFormsTables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::create('forms', function($table){
			$table->engine = 'InnoDB';
			$table->increments('id');
			$table->string('name');
			$table->string('location');
			$table->timestamps();
		});
		
		Schema::create('trip_forms', function($table){
			$table->engine = 'InnoDB';
			$table->increments('id');
			$table->integer('trip_id')->unsigned();
			$table->integer('form_id')->unsigned();
			$table->foreign('trip_id')->references('id')->on('trips')->onDelete('cascade');
			$table->foreign('form_id')->references('id')->on('forms')->onDelete('cascade');
			$table->timestamps();
		
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
		Schema::drop('trip_forms');
		Schema::drop('forms');
	}

}
