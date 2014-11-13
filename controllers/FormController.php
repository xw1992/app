<?php

class FormController extends BaseController {

	public function displayManageForms() {
    	$trips = Trip::with('tripForm')->get();
    	$forms = Form::get();
    	return View::make('manage_forms', compact('users', 'trips', 'forms'));
    }

    public function addNewForm(){
    	$file = Input::get(/* attribute for file */);
    	$filename = Input::get(/* attribute for the name of file*/);
    	Input::file($file)->move('public/forms', $filename);
    	Session::flash("adminSuccess", "You have successfully uploaded {$filename}.");
        return Redirect::to('/manageForms');

        $form = new Form();
        $form->name = $filename;
        $form->location = 'public/forms';

        foreach(/* checkbox checked */){
        	$tripForms = new TripForm();
        	$tripForms->trip_id = /*checkboxed trip id*/;
        	$tripForms->form_id = $form->id;
        }
    }

    public function deleteForm(){
    	$trips = Trip::with('tripForm')->find(Input::get('id');
    	$forms = Form::get(/* form that has been selected to be deleted */);
    	foreach($trips as $trip){
    		$trip->delete();
    	}
    	$trips->save();
    	$forms->delete();
    	$forms-save();
    }
}