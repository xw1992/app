
@extends('template')

@section('nav_items')
<li>
    <a href="#"><font size = "4" color="white">logged in : {{Auth::user()->fname}}</font></a>
</li>
<li>
    <a href="/logout"><font size = "4" color="white">Logout</font></a>
</li>
@stop

@section('content')                  		

@if(Session::has('registration_success'))
<h4><center>Your registration was successful!</center></h4>
@endif   

<div style="text-align:center;">
    <div class="container">
        <div class="row">

            <h2>Select your trip:</h2>

            <div class="form-group col-xs-8 col-xs-offset-2">
                {{ Form::open(array('url' => '/selectTrip', 'method' => 'post')) }}
                <select class="form-control input-lg" name = "trip_id">
                    @foreach($trips as $trip)
                    <option value="{{ $trip->id }}">{{ $trip->name }}</option>
                    @endforeach
                </select>

            </div>

        </div>
    </div>
</div>


<div class="container">
    <h5>Parent or Guardian Signature (required for those under 18 years of age)</h5>
    Check below to notify CPS to email participant a copy of this form for additional signature.
    <br><br>
    <input type="checkbox" name="under_18">  Check if you are under 18.<br><br>

    <h5>Please read the Terms and Agreement outlined below.</h5>
    I submit this Registration Form and understand that I am required to ALSO submit a $100 deposit to be 
    considered a participant on the project. Upon receipt of this form, CPS will follow-up with an email regarding 
    my registration status. If the program is NOT full, CPS will email a link with payment information. I understand that 
    I have 48 hours to make a payment to guarantee my participation on the trip. By submitting this form and a $100 
    deposit, I understand that I am entering into a contractual agreement with the Center for Public Service, that this 
    deposit is part of the total project cost and is non-refundable should I withdraw from the project, and that I am 
    responsible for paying the project fees or any expenses incurred on my behalf, should I decide to withdraw from the 
    project. I understand the Center for Public Service has the right to remove me from the project should I fail to meet 
    the expectations stated in all materials/correspondence I received in hard copy and/or mentioned in the CPS website.
    FOR MORE INFORMATION ON POLICIES , FEES, WITHDRAWAL AND CONTRACTUAL INFORMATION, REFER TO THE CPS
    WEBSITE AT: www.gettysburg.edu/cps, click on Immersion Projects.
    <br>
    <br>
    <input type="checkbox" name="accept_terms" required = "required">   Please check box upon reading and understanding the above information.
</div>
<br><br>

<!--	<div class="modal-footer">-->
<!--<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>-->
<center><button type="submit" class="btn btn-info">Submit</button></center>
<!--</div>-->
</form>
</div>
</div>
</div>

@stop
