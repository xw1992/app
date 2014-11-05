	@extends('templateDoubleNav')

	@section('nav_items')
	<li class = "active">
		<a href="/"><font size = "4" color="white">log out</font></a>
	</li>
	@stop

	@section('content')    

	<h4>Manage Participants</h4>

	@foreach($trips as $trip)
	<table>
		<thead>
			<tr>
				<th>Student Id</th>
				<th>Name</th>
				<th>Status</th>
				<th>Trip Leader</th>
				<th>Manage</th>
			</tr>
		</thead>
		@foreach($userTrips as $userTrip)
			<tr>
				<td> {{$userTrip->user->student_id }}</td>
				<td> {{$userTrip->user->fname . $suerTrip->user->lname}}</td>
				<td> {{$userTrip->user->tripStatus}}</td>
				<td> {{$userTrip->user->tripLeader}}</td>
				<td> <button type="button" class="btn btn-info btn-cons" data-toggle="modal" data-target="#manageModal">
								Manage Participant
					 </button></td>
			</tr>
		@endforeach
	</table>
	@endforeach

	<div class="modal fade" id="manageModal" tabindex="-1" role="dialog" aria-labelledby="manageModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<h4 class="modal-title" id="myModalLabel">Manage Participant: {{Auth::user()->fname . Auth::user()->lname}}</h4>
				</div>

				<div class="modal-body">
					<div class="container">
						<div class="row">
							Change the trip of the participant:
							<div class="form-group col-xs-8 col-xs-offset-2">
								 Form::open(array('url' => '/selectTrip', 'method' => 'post')) }}
								<select class="form-control input-lg" name = "trip_id">
									@foreach($trips as $trip)
									<option value="{{$trip->id }}"> {{$trip->name }}</option>
									@endforeach
								</select>								
							</div>
						</div>	
						<button type="submit" class="btn btn-info">Confirm Trip Change</button>
						<br>
						<div class="row">
							<button type = "button" class="btn btn-success btn-sm">Approve Applicant</button>
      						<button type = "button" class="btn btn-sunny-sm">Move to Waitlist</button>
      						<button type = "button" class="btn btn-danger-sm">Remove from Trip</button>
						</div>

						<div class="row">
							Check if you would like this student to be a trip leader.
							<input type="checkbox" name="tripLeader">
						</div>

						<h3>Student Application Status</h3>


						<br>
						<h3>Student Payment Information</h3>
						<h4>Payment History</h4>
						<table>
								@foreach($payments as $payment)
									<tr>
										<td>{{$payment->amount}}</td>
										<td>{{$payment->date}}</td>
									</tr>
								@endforeach
						</table>

						Record a Payment:<br>
						Amount:
						<input type="text" name="amount" class="form-control input-md">
						Date:
						<input type="text" name="date" class="form-control input-md">
						
					</div>
				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
					<button type="submit" class="btn btn-info">Save changes</button>
				</div>
			</div>
		</div>
	</div>

	@stop