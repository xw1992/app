@extends('templateDoubleNav')

@stop
@section('content')    
<h4>Participant Information: {{$user->fname .' '. $user->lname}}</h4>
@if(Session::has('passwordError'))
<div class="alert alert-danger" role="alert">
    <p>Failed to change password: please make sure the new one has a minimum length of 6 and confirm it correctly.</p>
</div>
@endif
<h4><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#changePassword">Change {{$user->fname}}'s password</button></h4>

<div class="modal fade" id="changePassword" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Change Password</h4>
      </div>
      <div class="modal-body">
        {{Form::open(['url'=>'/changePassword'])}}
        {{Form::hidden('user_id',$user->id)}}
        <div class="row">
        	<div class="col-xs-4">New password:</div>
        	<div class="col-xs-8"><input name="new_password" type="password" class="form-control" required></div>
        </div>
        <br>
        <div class="row">
        	<div class="col-xs-4">Confirm password:</div>
        	<div class="col-xs-8"><input name="confirm_password" type="password" class="form-control" required></div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
        {{Form::close()}}
      </div>
    </div>
  </div>
</div>

{{Form::open(array('url' => '/editStudentInfo'))}}
{{Form::hidden("id", $user->id)}}
@if(Session::has('adminSuccess'))
<div class="alert alert-success" role="alert">
    {{Session::get('adminSuccess')}}
</div>
@elseif(Session::has('editError'))
	<div class="alert alert-danger" role="alert">
	    <ul>
	        @foreach(Session::get('editError') as $m)
	        <li>{{$m}}</li>
	        @endforeach
	    </ul>
	</div>
@elseif (Session::has('infoError'))
	<div class="alert alert-success" role="alert">
    	<ul>
	        @foreach(Session::get('infoError') as $m)
	        <li>{{$m}}</li>
	        @endforeach
	    </ul>
	</div>
@endif
<div class="row">
	<div class="col-xs-4">
		<div class="form-group">
			<h5>First Name: <font color="ef6464">*</font></h5>
			{{Form::text('first_name', $user->fname, ["class" => "form-control"])}}
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
			<h5>Last Name: <font color="ef6464">*</font></h5>
			{{Form::text('last_name', $user->lname, ["class" => "form-control"])}}
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-4 col-sm-4">
		<div class="form-group">
		<h5>Date of Birth:<font color="ef6464">*</font></h5>
		{{Form::text('dob',$user->dob, ["class" => "form-control", 'id'=>'datepicker'])}}
	</div>
</div>
<div class="col-xs-4 col-sm-4">
	<div class="form-group">
		<h5>Gender:<font color="ef6464">*</font></h5>
        <select name="gender" class="form-control"><option value="male" @if($user->gender == "male") selected @endif>Male</option><option value="female" @if($user->gender == "female") selected @endif>Female</option></select>

	</div>
</div>
</div>
<div class="row">
	<div class="col-xs-4 col-sm-4">
		<div class="form-group">
			<h5>Country:<font color="ef6464">*</font></h5>
			{{Form::text('country', $user->country, ["class" => "form-control"])}}
		</div>
	</div>
	<div class="col-xs-4 col-sm-4">
		<div class="form-group">
			<h5>Passport Number:<font color="ef6464">*</font></h5>
			{{Form::text('passport', Crypt::decrypt($user->passport_no), ["class" => "form-control"])}}
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-4 col-sm-4">
		<div class="form-group">
			<h5>Address:<font color="ef6464">*</font></h5>
			{{Form::text('campus_address', $user->address, ["class" => "form-control"])}}
		</div>
	</div>
	<div class="col-xs-4 col-sm-4">
		<div class="form-group">
			<h5>Phone Number:<font color="ef6464">*</font></h5>
			{{Form::text('cell', $user->phone_no, ["class" => "form-control"])}}
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-4 col-sm-4">
		<div class="form-group">
			<h5>Emergency Contact:<font color="ef6464">*</font></h5>
			{{Form::text('emergency_name', $user->emergency_contact_name, ["class" => "form-control"])}}
		</div>
	</div>
	<div class="col-xs-4 col-sm-4">
		<div class="form-group">
			<h5>Emergency Contact Phone:<font color="ef6464">*</font></h5>
			{{Form::text('emergency_phone', $user->emergency_contact_phone, ["class" => "form-control"])}}
		</div>
	</div>
	<div class="col-xs-4 col-sm-4">
		<div class="form-group">
			<h5>Emergency Contact Address:<font color="ef6464">*</font></h5>
			{{Form::text('emergency_street', $user->emergency_contact_address, ["class" => "form-control"])}}
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-4 col-sm-4">
		<div class="form-group">
			<h5>Student Id:</h5>
			{{Form::text('id_number', $user->student_id?:'', ["class" => "form-control"])}}
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
			{{Form::text('class', $user->class_year, ["class" => "form-control"])}}
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
		<h5>Hometown State:<font color="ef6464">*</font></h5>
		{{Form::text('hometown_state', $userInfo->hometown_state, ["class" => "form-control"])}}
	</div>
	<div class="col-sm-4 col-xs-4">
		<h5>Smoker:<font color="ef6464">*</font></h5>
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
		<h5>Relevant Experience / Interests<font color="ef6464">*</font></h5>
		{{Form::textarea('relevant_experience_interest', $userInfo->relevant_experience_interest, ["class" => "form-control"])}}
	</div>
	<div class="col-md-8">
		<h5>Biography<font color="ef6464">*</font></h5>
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
