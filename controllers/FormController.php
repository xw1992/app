<?php

class FormController extends BaseController {

	public function displayManageForms() {
    	$trips = Trip::with('tripForm')->get();
        $tripForms = [];
    	$forms = FormFile::with('tripForm')->get();
        foreach ($forms as $form) {
            $fTrips = [];
            foreach ($form->tripForm as $tripForm) {
                $fTrips[] = $tripForm->trip_id; 
            }
            $tripForms[$form->id] = $fTrips;
        }
    	return View::make('manage_forms', compact('trips', 'forms','tripForms'));
    }

    public function addNewForm(){
        $trips = Trip::get();

    	$file = Input::file('form');
    	$filename = Input::get('form_name');
        $url = public_path().'/forms';
        $originalName = $file->getClientOriginalName();
        $array = explode('.', $originalName);
        $type = $array[count($array)-1];
    	$file->move($url, $filename.".".$type);

        $form = new FormFile();
        $form->name = $filename;
        $form->location = "forms/".$filename.".".$type;
        $form->save();

        foreach($trips as $trip){
            $tripCheck = Input::get("trip".$trip->id);
            if($tripCheck){
        	   $tripForms = new TripForm();
        	   $tripForms->trip_id = $trip->id;
        	   $tripForms->form_id = $form->id;
               $tripForms->save();
            }
        }
        Session::flash("adminSuccess", "You have successfully uploaded the form: {$filename}.");
        return Redirect::to('/manageForms');
    }

    public function deleteForm(){
    	$formID = FormFile::find(Input::get('id'));
    	$formID->delete();
    	Session::flash("adminSuccess", "You have successfully deleted the file.");
        return Redirect::to('/manageForms');
    }

    public function editForm(){
        $form = FormFile::with('tripForm')->find(Input::get('id'));
        $tripArray = [];

        foreach($form->tripForm as $tForm){
            $tripCheck = Input::get($tForm->trip_id);
            if(!$tripCheck){
                $tForm->delete();
            }
            $tripArray[] = $tForm->trip_id;
        }

        $trips = Trip::all();
        foreach($trips as $trip){
            $tripCheck = Input::get('trip'.$trip->id);
            if($tripCheck){
                if(!in_array($tripCheck, $tripArray)){
                    $tripForms = new TripForm();
                    $tripForms->trip_id = $trip->id;
                    $tripForms->form_id = $form->id;
                    $tripForms->save();
                }
            }
        }
        Session::flash("adminSuccess", "You have successfully edited the existing form-trip association.");
        return Redirect::to('/manageForms');
    }
}