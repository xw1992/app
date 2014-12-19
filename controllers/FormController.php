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

    public function saveStudentForms(){
        $userTrips = UserTrip::where('trip_id','=',Input::get('trip_id'))->get();
        $forms = FormFile::all();
        foreach ($userTrips as $userTrip) {
            $existing_forms = UserForm::where('user_id','=',$userTrip->user_id)->get();
            foreach ($existing_forms as $existing_form) {
                if(!Input::get($existing_form->form_id.'form'.$userTrip->user_id)){
                    $existing_form->delete();
                }
            }
            foreach ($forms as $form) {
                if(Input::get($form->id.'form'.$userTrip->user_id)){
                    if(!$this->formExists($existing_forms, $form->id)){
                        $userForm = new UserForm;
                        $userForm->user_id = $userTrip->user_id;
                        $userForm->form_id = $form->id;
                        $userForm->save();
                    }    
                }
            }
        }
        Session::flash('adminSuccess', 'You have successfully saved the participant form information.');
        Session::flash('indicator', 1);
        return Redirect::back();
    }

    public function formExists($forms, $form_id){
        foreach ($forms as $form) {
            if($form->form_id == $form_id){
                return true;
            }
        }
        return false;
    }

    public function addNewForm(){
        if (!FormFile::isValid(Input::all())) {
            return Redirect::to('/manageForms')->withInput();
        }

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
            $tripCheck = Input::get('trip'.$tForm->trip_id);
            if(!$tripCheck){
                $tForm->delete();
            }else{
                $tripArray[] = $tForm->trip_id;
            } 
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