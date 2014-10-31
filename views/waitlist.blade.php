
@extends('template')

@section('nav_items')
        <li class = "active">
        <a href="/Immersion/public/"><font size = "4" color="white">log out</font></a>
        </li>
@stop

@section('content')       
 @if(Session::has('userSuccess'))
        <div class="alert alert-success" role="alert">
        {{Session::get('userSuccess')}}
        </div>
@endif
<center>
<h3>You have been waitlisted for</h3>
<h3>{{ $userTrip->trip->name }}</h3>
<br>
<h4>You now have the option to remain on the waitlist or 
			choose another trip</h4>
	If you would like to choose a different trip, please remove yourself from the waitlist.<br><br>
{{Form::open(["url"=>"/removeFromWaitlist", "method"=>"post"])}}
<input type="hidden" value="{{ $userTrip->id }}" name="id">
<button type="submit" class="btn btn-info">Remove</button>
</form>
</center>

@stop

