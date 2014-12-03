@extends('templateDoubleNav')

@stop
@section('content')    
<h4>Student Information: {{$user->fname .' '. $user->lname}}</h4><br><br>
{{Form::open(array('url' => '/editStudentInfo'))}}
{{Form::hidden("id", $user->id)}}
                        @if(Session::has('adminSuccess'))
                        <div class="alert alert-success" role="alert">
                            {{Session::get('adminSuccess')}}
                        </div>
                        @endif
<div class="row">
	<div class="col-xs-4 col-xs-4 col-xs-4">
		<div class="form-group">
			<h5>First Name:</h5>
			{{Form::text('fname', $user->fname, ["class" => "form-control"])}}
		</div>
	</div>
	<div class="col-xs-4 col-xs-4 col-xs-4">
		<div class="form-group">
			<h5>Middle Name:</h5>
			{{Form::text('mname', $user->mname)}}
		</div>
	</div>
	<div class="col-xs-4 col-xs-4 col-xs-4">
		<div class="form-group">
			<h5>Last Name:</h5>
			{{Form::text('lname', $user->lname)}}
		</div>
	</div>
</div>
<div class="row">
	<div class="col-sm-4 col-xs-4 col-sm-4">
		<div class="form-group">
		<h5>Date of Birth:</h5>
		{{Form::text('dob',$user->dob)}}
	</div>
</div>
<div class="col-sm-4 col-xs-4 col-sm-4">
	<div class="form-group">
		<h5>Gender:</h5>
		{{Form::text('gender', $user->gender)}}
	</div>
</div>
</div>
<div class="row">
	<div class="col-sm-4 col-xs-4 col-sm-4">
		<div class="form-group">
			<h5>Country:</h5>
			{{Form::text('country', $user->country)}}
		</div>
	</div>
	<div class="col-sm-4 col-xs-4 col-sm-4">
		<div class="form-group">
			<h5>Passport Number:</h5>
			{{Form::text('passport_no', $user->passport_no)}}
		</div>
	</div>
</div>
<div class="row">
	<div class="col-sm-4 col-xs-4 col-sm-4">
		<div class="form-group">
			<h5>Address:</h5>
			{{Form::text('address', $user->address)}}
		</div>
	</div>
	<div class="col-sm-4 col-xs-4 col-sm-4">
		<div class="form-group">
			<h5>Phone Number:</h5>
			{{Form::text('phone_no', $user->phone_no)}}
		</div>
	</div>
</div>
<div class="row">
	<div class="col-sm-4 col-xs-4 col-sm-4">
		<div class="form-group">
			<h5>Emergency Contact:</h5>
			{{Form::text('emergency_contact_name', $user->emergency_contact_name)}}
		</div>
	</div>
	<div class="col-sm-4 col-xs-4 col-sm-4">
		<div class="form-group">
			<h5>Emergency Contact Phone:</h5>
			{{Form::text('emergency_contact_phone', $user->emergency_contact_phone)}}
		</div>
	</div>
	<div class="col-sm-4 col-xs-4 col-sm-4">
		<div class="form-group">
			<h5>Emergency Contact Address:</h5>
			{{Form::text('emergency_contact_address', $user->emergency_contact_address)}}
		</div>
	</div>
</div>
<div class="row">
	<div class="col-sm-4 col-xs-4 col-sm-4">
		<div class="form-group">
			<h5>Student Id:</h5>
			{{Form::text('student_id', $user->student_id)}}
		</div>
	</div>
	<div class="col-sm-4 col-xs-4 col-sm-4">
		<div class="form-group">
			<h5>Campus Box:</h5>
			{{Form::text('campus_box', $user->campus_box)}}
		</div>
	</div>
	<div class="col-sm-4 col-xs-4 col-sm-4">
		<div class="form-group">
			<h5>Class Year:</h5>
			{{Form::text('class_year', $user->class_year)}}
		</div>
	</div>
</div>
<div class="row">
	<div class="col-sm-4 col-xs-4 col-sm-4">
		<h5>Academic Interest:</h5>
		{{Form::text('major_academic_interest', $userInfo->major_academic_interest)}}
	</div>
	<div class="col-sm-4 col-xs-4 col-sm-4">
		<h5>Hometown State:</h5>
		{{Form::text('hometown_state', $userInfo->hometown_state)}}
	</div>
	<div class="col-sm-4 col-xs-4 col-sm-4">
		<h5>Smoker:</h5>
		{{Form::checkbox('smoke', 1, $userInfo->smoke)}}
	</div>
</div>
<div class="row">
	<div class="col-md-4 col-md-4 col-md-4">
		<h5>Allergies or Medical Conditions:</h5>
		{{Form::textarea('allergy_medical_conditions', $userInfo->allergy_medical_conditions)}}
	</div>
	<div class="col-md-4 col-md-4 col-md-4">
	</div>
	<div class="col-md-4 col-md-4 col-md-4">
		<h5>Relevant Experience / Interests</h5>
		{{Form::textarea('relevant_experience_interest', $userInfo->relevant_experience_interest)}}
	</div>
</div>
<div class="row">
	<div class="col-md-6 col-md-6">
		<h5>Biography</h5>
		{{Form::textarea('bio', $userInfo->bio)}}
	</div>
</div>
<br>
<center>
	<button type="submit" class="btn btn-info">
		Submit Changes
	</button> 
</center>
</form>

@stop
