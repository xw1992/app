@extends('template')

@stop
@section('content')    
<h4>Student Information: {{$user->fname .' '. $user->lname}}</h4><br>
{{Form::open(array('url' => '/editMyInfo'))}}
{{Form::hidden("id", $user->id)}}
@if(Session::has('userSuccess'))
<div class="alert alert-success" role="alert">
    {{Session::get('userSuccess')}}
</div>
@endif
<div class="row">
	<div class="col-xs-4">
		<div class="form-group">
			<h5>First Name:</h5>
			{{Form::text('fname', $user->fname, ["class" => "form-control"])}}
		</div>
	</div>
	<div class="col-xs-4">
		<div class="form-group">
			<h5>Middle Name:</h5>
			{{Form::text('mname', $user->mname, ["class" => "form-control"])}}
		</div>
	</div>
	<div class="col-xs-4">
		<div class="form-group">
			<h5>Last Name:</h5>
			{{Form::text('lname', $user->lname, ["class" => "form-control"])}}
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-4 col-sm-4">
		<div class="form-group">
		<h5>Date of Birth:</h5>
		{{Form::text('dob',$user->dob, ["class" => "form-control"])}}
	</div>
</div>
<div class="col-xs-4 col-sm-4">
	<div class="form-group">
		<h5>Gender:</h5>
		{{Form::text('gender', $user->gender, ["class" => "form-control"])}}
	</div>
</div>
</div>
<div class="row">
	<div class="col-xs-4 col-sm-4">
		<div class="form-group">
			<h5>Country:</h5>
			{{Form::text('country', $user->country, ["class" => "form-control"])}}
		</div>
	</div>
	<div class="col-xs-4 col-sm-4">
		<div class="form-group">
			<h5>Passport Number:</h5>
			{{Form::text('passport_no', Crypt::decrypt($user->passport_no), ["class" => "form-control"])}}
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-4 col-sm-4">
		<div class="form-group">
			<h5>Address:</h5>
			{{Form::text('address', $user->address, ["class" => "form-control"])}}
		</div>
	</div>
	<div class="col-xs-4 col-sm-4">
		<div class="form-group">
			<h5>Phone Number:</h5>
			{{Form::text('phone_no', $user->phone_no, ["class" => "form-control"])}}
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-4 col-sm-4">
		<div class="form-group">
			<h5>Emergency Contact:</h5>
			{{Form::text('emergency_contact_name', $user->emergency_contact_name, ["class" => "form-control"])}}
		</div>
	</div>
	<div class="col-xs-4 col-sm-4">
		<div class="form-group">
			<h5>Emergency Contact Phone:</h5>
			{{Form::text('emergency_contact_phone', $user->emergency_contact_phone, ["class" => "form-control"])}}
		</div>
	</div>
	<div class="col-xs-4 col-sm-4">
		<div class="form-group">
			<h5>Emergency Contact Address:</h5>
			{{Form::text('emergency_contact_address', $user->emergency_contact_address, ["class" => "form-control"])}}
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-4 col-sm-4">
		<div class="form-group">
			<h5>Student Id:</h5>
			{{Form::text('student_id', $user->student_id?:'N/A', ["class" => "form-control"])}}
		</div>
	</div>
	<div class="col-xs-4 col-sm-4">
		<div class="form-group">
			<h5>Campus Box:</h5>
			{{Form::text('campus_box', $user->campus_box, ["class" => "form-control"])}}
		</div>
	</div>
	<div class="col-xs-4 col-sm-4">
		<div class="form-group">
			<h5>Class Year:</h5>
			{{Form::text('class_year', $user->class_year, ["class" => "form-control"])}}
		</div>
	</div>
</div>
@if($userInfo)
<div class="row">
	<div class="col-sm-4 col-xs-4">
		<h5>Academic Interest:</h5>
		{{Form::text('major_academic_interest', $userInfo->major_academic_interest, ["class" => "form-control"])}}
	</div>
	<div class="col-sm-4 col-xs-4">
		<h5>Hometown State:</h5>
		{{Form::text('hometown_state', $userInfo->hometown_state, ["class" => "form-control"])}}
	</div>
	<div class="col-sm-4 col-xs-4">
		<h5>Smoker:</h5>
		{{Form::checkbox('smoke', 1, $userInfo->smoke)}}
	</div>
</div>
<div class="row">
	<div class="col-md-4">
		<h5>Dietary allergies and access needs:</h5>
		{{Form::textarea('dietary_allergies_access_needs', $userInfo->dietary_allergies_access_needs, ["class" => "form-control"])}}
	</div>
	<div class="col-md-4">
		<h5>Allergies or Medical Conditions:</h5>
		{{Form::textarea('allergy_medical_conditions', $userInfo->allergy_medical_conditions, ["class" => "form-control"])}}
	</div>
	<div class="col-md-4">
		<h5>Foreign languages:</h5>
		{{Form::textarea('foreign_languages', $userInfo->foreign_languages, ["class" => "form-control"])}}
	</div>
</div>
<div class="row">
	<div class="col-md-4">
		<h5>Relevant Experience / Interests</h5>
		{{Form::textarea('relevant_experience_interest', $userInfo->relevant_experience_interest, ["class" => "form-control"])}}
	</div>
	<div class="col-md-8">
		<h5>Biography</h5>
		{{Form::textarea('bio', $userInfo->bio, ["class" => "form-control"])}}
	</div>
</div>
@endif
<br>
<center>
	<button type="submit" class="btn btn-info">
		Submit Changes
	</button> 
</center>
</form>

@stop