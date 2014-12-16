
@extends('template')

@section('nav_items')

<li class = "active">
    <a href="/"><font size = "4" color="white">log in</font></a>
</li>
@stop

@section('content')


<div class="row centered-form">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">To register, please fill out the following information</h3>
        </div>
        <div class="panel-body">
            @if(Session::has('registerError'))
            <div class="alert alert-danger" role="alert">
                <ul>
                    @foreach(Session::get('registerError') as $m)
                    <li>{{$m}}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            {{Form::open(['url'=>'/signup','class'=>'form'])}}
                <div class ="row">
                    <div class = "col-md-4 col-sm-6">
                        <font color="ef6464">* = Required</font>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 col-sm-6">
                        <div class="form-group">
                            First Name <font color="ef6464">*</font>
                            <!--input type="text" name="first_name" id="first_name" class="form-control input-md" placeholder="As it would appear on your passport" required="required"-->
                            {{Form::text('first_name', '', ['class'=>'form-control input-md','placeholder'=>'As it would appear on your passport','required'])}}
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class = "form-group">
                            Middle Name
                            <!--input type ="text" name ="middle_name" id="middle_name" class="form-control input-md" placeholder="As it would appear on your passport"-->
                            {{Form::text('middle_name', '', ['class'=>'form-control input-md','placeholder'=>'As it would appear on your passport'])}}
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="form-group">
                            Last Name <font color = "ef6464">*</font>
                            <!--input type="text" name="last_name" id="last_name" class="form-control input-md" placeholder="As it would appear on your passport" required = "required"-->
                            {{Form::text('last_name', '', ['class'=>'form-control input-md','placeholder'=>'As it would appear on your passport','required'])}}
                        </div>
                    </div>
                </div>

                <div class = "row">		    			
                    <div class = "col-md-2 col-sm-6">
                        Date of Birth <font color="ef6464">*</font>
                        <div class = "form-group">
                            <!--input type = "date" name="dob" id="dob" class="form-control input-md" placeholder="YYYY/MM/DD" required ="required"-->
                            {{Form::text('dob', '', ['class'=>'form-control input-md','placeholder'=>'YYYY/MM/DD','required'])}}
                        </div>
                    </div>	    			
                    <div class = "col-md-2 col-sm-6">
                        <div class="form-group">
                            Gender <font color="ef6464">*</font>
                            <select name="gender" class="form-control"><option value="male" selected>Male</option><option value="female">Female</option></select>
                        </div>
                    </div>	
                    <div class="col-md-2 col-sm-6">
                        <div class="form-group">
                            Cell Phone# <font color="ef6464">*</font>
                            <!--input type="text" name="cell" id="cell" class= "form-control input-md" placeholder="xxx-xxx-xxxx" required="required"-->
                            {{Form::text('cell', '', ['class'=>'form-control input-md','placeholder'=>'xxx-xxx-xxxx','required'])}}
                        </div>
                    </div>  			    			
                    <div class = "col-md-4 col-sm-6">
                        <div class="form-group">
                            Hall & Room or Off-Campus Address <font color="ef6464">*</font>
                            <!--input type ="text" name="campus_address" id="campus_address" class="form-control input-md" placeholder="Campus Address" required = "required"-->
                            {{Form::text('campus_address', '', ['class'=>'form-control input-md','placeholder'=>'Campus Address','required'])}}
                        </div>
                    </div>		
                </div>   		

                <div class="row">
                    <div class = "col-md-4 col-sm-6">
                        <div class="form-group">
                            Passport Number (for international trips only)
                            <!--input type="text" name="passport" id="passport" class="form-control input-md" placeholder="passport number"-->
                            {{Form::text('passport', '', ['class'=>'form-control input-md','placeholder'=>'passport number'])}}
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="form-group">
                            Country that issued your passport
                            <!--input type="text" name="passport_country" id="passport_country" class="form-control input-md" placeholder="Country"-->
                            {{Form::text('passport_country', '', ['class'=>'form-control input-md','placeholder'=>'Country'])}}
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 col-sm-6">
                        <div class="form-group">
                            Emergency Contact Name <font color="ef6464">*</font>
                            <!--input type="text" name="emergency_name" id="emergency_name" class="form-control input-md" placeholder="contact name" required="required"-->
                            {{Form::text('emergency_name', '', ['class'=>'form-control input-md','placeholder'=>'contact name','required'])}}
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="form-group">
                            Emergency Contact Address <font color="ef6464">*</font>
                            <!--input type="text" name="emergency_street" id="emergency_street" class="form-control input-md" placeholder="Street Address"-->
                            {{Form::text('emergency_street', '', ['class'=>'form-control input-md','placeholder'=>'Street Address','required'])}}
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="form-group">
                            Emergency Contact Phone <font color="ef6464">*</font>
                            <!--input type = "text" name="emergency_phone" class ="form-control input-md" placeholder ="xxx-xxx-xxxx"-->
                            {{Form::text('emergency_phone', '', ['class'=>'form-control input-md','placeholder'=>'xxx-xxx-xxxx','required'])}}
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-4 col-sm-4">
                        <div class="form-group">
                            Email Address <font color="ef6464">*</font>
                            <!--input type="email" name="email" id="email" class="form-control input-md" placeholder="Email Address"-->
                            {{Form::email('email', '', ['class'=>"form-control input-md",'placeholder'=>"Email Address",'required'])}}
                        </div>                          
                        <div class="form-group">
                            Password <font color="ef6464">*</font>
                            <!--input type="password" name="password" id="password" class="form-control input-md" placeholder="Password"-->
                            {{Form::password('password', ['class'=>'form-control input-md','placeholder'=>'Password','required'])}}
                        </div>
                        <div class="form-group">
                            Confirm Password <font color="ef6464">*</font>
                            <!--input type="password" name="password_confirmation" id="password_confirmation" class="form-control input-md" placeholder="Confirm Password"-->
                            {{Form::password('password_confirmation', ['class'=>'form-control input-md','placeholder'=>'Confirm Password','required'])}}
                        </div>
                    </div>
                    <div class="col-md-8 col-sm-8">
                        <div class="panel panel-default">
                          <div class="panel-heading">
                            <h3 class="panel-title">Student only</h3>
                          </div>
                          <div class="panel-body">
                            <div class="row">
                                <div class = "col-sm-4">
                                    <div class = "form-group">
                                        Student ID# <font color = "ef6464">*</font>
                                        <input type = "number" name="id_number" id="id_number" class="form-control input-md" placeholder ="ID number">
                                    </div>

                                </div>
                                <div class = "col-sm-4">
                                    <div class = "form-group">
                                        Class of
                                        <input type = "text" name="class" id="class" class="form-control input-md" placeholder ="YYYY">
                                    </div>                      
                                </div>                          
                                <div class= "col-sm-4">
                                    <div class="form-group">
                                        Campus Box
                                        <input type="text" name="campus_box" id="campus_box" class="form-control input-md" placeholder="xxxx">
                                    </div>
                                </div>
                            </div>
                          </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="text-center">
                    <div class="row">
                        <button type="submit" class="btn btn-lg btn-info">Register</button>							
                    </div>
                </div>	
            {{Form::close()}}
        </div>
    </div>
</div>

@stop
