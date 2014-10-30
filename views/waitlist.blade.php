
@extends('template')

@section('nav_items')
        <li class = "active">
        <a href="/Immersion/public/"><font size = "4" color="white">log out</font></a>
        </li>
@stop

@section('content')        @if(Session::has('userSuccess'))        <div class="alert alert-success" role="alert">        {{Session::get('userSuccess')}}        </div>@endif<center><h3>You have been waitlisted for</h3>
<h3>{{ $userTrip->trip->name }}</h3>
<br>
</center><h4>You now have the option to remain on the waitlist or 
			choose another trip</h4>
	If you would like to choose a different trip, please select the trip
	you would like to switch to.<br><br>

  <div class="form-group col-sm-6">
	{{ Form::open(array('url' => '/selectTrip', 'method' => 'post')) }}
	<select class="form-control input-sm" name = "trip_id">
            @foreach($trips as $trip)
                <option value="{{ $trip->id }}">{{ $trip->name }}</option>
            @endforeach
	</select>
	
	</div>		

@stop

