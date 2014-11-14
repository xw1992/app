@extends('templateDoubleNav')

@section('content')    

@if(Session::has('adminSuccess'))
<div class="alert alert-success" role="alert">
	{{Session::get('adminSuccess')}}
</div>
@endif
<h4 class="text-center">Manage Participants</h4>

@foreach($trips as $trip)
<h2>{{ $trip->name }}
	<small>Enrolled: {{$trip->enroll_no}}/{{$trip->capacity}}</small></h2>
	<table class="table table-hover">
		<thead>
			<tr>
				<th>Student Id</th>
				<th>Name</th>
				<th>Status</th>
				<th>Trip Leader</th>
				<th>Move</th>
				<th>Finances</th>
			</tr>
		</thead>
		@foreach($users as $user)
		@if($user->userTrip and $trip->id == $user->userTrip->trip_id)
		<tr>
			<td>{{$user->student_id}}</td>
			<td> <a href="#"
				data-toggle="modal"
				data-target="#studentModal{{$user->id}}">{{$user->fname .' '. $user->lname}}</a>
			</td>
			<td> 
				<a href="#"
				data-toggle="modal"
				data-target="#statusModal{{$user->id}}">
				@if($user->userTrip->approved)
				approved
				@elseif($user->userTrip->waitlisted)
				waitlisted
				@else
				awaiting approval
				@endif</a>
			</td>
			<td> 
				<a href="#"
				data-toggle="modal"
				data-target="#studentLeaderModal{{$user->id}}">
				@if( $user->userTrip->trip_leader)
				Yes
				@else
				No
				@endif</a>
			</td>

		</td>
		<td> <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#manageModal{{ $user->id }}">
			Move Participant
		</button>
	</td>
	<td><button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#financeModal{{$user->id}}">
		Finances
	</button>
</td>
</tr>
<div class="modal fade" id="studentModal{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="studentModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="studentModalLabel">Participant Information: {{$user->fname .' '. $user->lname}}</h4>
			</div>
			<div class="modal-body">
				<h4>{{$user->fname}}</h4>
				<a href="#">Edit Information</a>

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
				<button type="submit" class="btn btn-info">Save changes</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="statusModal{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="statusModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="statusModalLabel">Participant Status</h4>
			</div>
			<div class="modal-body">
				{{$user->fname}} is currently {{$user->userTrip->approved?'approved':($user->userTrip->waitlisted?'waitlisted':'awaiting approval')}} for this trip.
				<br>
				<h5>If you would like to change the status of this student, please use the following options:</h5>
				@if(!$user->userTrip->approved and $trip->enroll_no < $trip->capacity)
				{{ Form::open(array('url' => '/approveApplicant', 'method' => 'post')) }}
				{{Form::hidden("id", $user->userTrip->id)}}
				<button type="submit" class="btn btn-success btn-sm">Approve</button>
			</form>
			@endif
			@if(!$user->userTrip->approved and !$user->userTrip->waitlisted)
			{{ Form::open(array('url' => '/waitlistApplicant', 'method' => 'post')) }}
			{{Form::hidden("id", $user->userTrip->id)}}
			<button type="submit" class="btn btn-warning btn-sm">Waitlist</button>
		</form>
		@endif
		{{ Form::open(array('url' => '/removeFromTrip', 'method' => 'post')) }}
		{{Form::hidden("id", $user->userTrip->id)}}
		<button type="submit" class="btn btn-danger btn-sm">Remove from trip</button>
	</form>                          
</div>
</div>
</div>
</div>

<div class="modal fade" id="studentLeaderModal{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="studentLeaderModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="studentLeaderModalLabel">Trip Leader</h4>
			</div>
			<div class="modal-body">
				{{ Form::open(array('url' => '/assignTripLeader', 'method' => 'post')) }}
				{{Form::hidden("id", $user->userTrip->id)}}
				<button type="submit" class="btn btn-info btn-sm">
					@if($user->userTrip->trip_leader)
					un-assign {{$user->fname}} as a trip leader
					@else
					Make {{$user->fname}} a trip leader
					@endif
				</button>
			</form>
		</div>
	</div>
</div>
</div>

<div class="modal fade" id="manageModal{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="manageModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="myModalLabel">Move Participant: {{$user->fname .' '. $user->lname}}</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					Change the trip of the participant:
					<div class="form-group">
						{{ Form::open(array('url' => '/changeTrip', 'method' => 'post')) }}
						{{Form::hidden("id", $user->userTrip->id)}}
						<select class="form-control input-lg" name = "trip_id">
							@foreach($trips as $trip1)
							<option value="{{ $trip1->id }}">{{ $trip1->name }}</option>
							@endforeach
						</select>								
					</div>
				</div>
				<button type="submit" class="btn btn-info">Confirm Trip Change</button>
			</form>

		</div>
	</div>
</div>
</div>

<div class="modal fade" id="financeModal{{$user->id}}" tabindex="-1" role="dialog" aria=labelledby="financeModal" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"<span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="financeModalLabel">Finances</h4>
			</div>
			<div class="modal-body">

				<div class="col-xs-6">
					<h4>Awards</h4>
					<form>
					<div class="col-xs-4">
						<div class="form-group">
							Leader Award
							<input type="text" name="leader_award" id="leader_award" class="form-control input-sm" name = "leader_award">
						</div>
					</div>
					<div class="col-xs-4">
						<div class = "form-group">
							Scholarship Award
							<input type ="text" name ="scholarship_award" id="scholarship_award" class="form-control input-sm">
						</div>
					</div>
					<div class="col-xs-4">
						<div class="form-group">
							Catholic Award
							<input type="text" name="catholic_award" id="catholic_award" class="form-control input-sm">
						</div>
					</div>

					Cost of Trip: $trips->cost}}<br>
					Amount Awarded: $trip_users->leader_award + $trip_users->scholarship_award = $trip_users->catholic_award}}<br>
					Amount Paid: $trip_users->deposit}}<br>
					Amount Due: $trip_users->total_due}}<br>
					{{Form::submit('save')}}
				</form>

				</div>

				<h4>Submit a payment for this participant</h4>
<<<<<<< Updated upstream
				<div class="panel"
				Payment Amount:<br>
				<Input type="number" name="amount">
				<br><br>
				Date:<br>
				{{Form::selectRange('day', 1, 31)}}
				{{Form::selectMonth('month')}}
				{{Form::selectRange('year', 2014, 2024)}}
			</div>
			{{Form::submit('submit payment')}}
=======
				<div class="col-xs-6">

					<h4>Submit a payment for this participant</h4>

					Payment Amount:<br>
					<form>
						<Input type="number" name="amount">
							<br><br>
							Date:<br>
							<!-- {{ Form::text('date', null, array('type' => 'text', 'class' => 'form-control datepicker', 'id' => 'calendar')) }} -->
							{{Form::selectRange('day', 1, 31)}}
							{{Form::selectMonth('month')}}
							{{Form::selectRange('year', 2000, 2015)}}
							<br><br>
							{{Form::submit('submit payment')}}
						</form>
					
				</div>
>>>>>>> Stashed changes

			</div>
		</div>
	</div>
	@endif
	@endforeach
</table>
@endforeach

@stop
