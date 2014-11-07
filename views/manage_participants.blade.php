@extends('templateDoubleNav')

@section('nav_items')
<li class = "active">
    <a href="/"><font size = "4" color="white">log out</font></a>
</li>
@stop

@section('content')    

<h4>Manage Participants</h4>

@foreach($trips as $trip)
<h4>{{ $trip->name }}</h4>
<table class="table table-hover">
	<thead>
		<tr>
			<th>Student Id</th>
			<th>Name</th>
			<th>Status</th>
			<th>Trip Leader</th>
			<th>Manage</th>
			<th>Finances</th>
		</tr>
	</thead>
    @foreach($users as $user)
    @if($user->userTrip and $trip->id == $user->userTrip->trip_id)
    <tr>
        <td> {{$user->student_id }}</td>
        <td> <a href="#"
			data-toggle="modal"
			data-target="#studentModal">{{$user->fname .' '. $user->lname}}</a>
		</td>
        <td> 
        	<a href="#"
			data-toggle="modal"
			data-target="#statusModal">
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
			data-target="#studentLeaderModal">
				@if( $user->userTrip->trip_leader)
            		Yes
            	@else
            		No
            	@endif</a>
		</td>
            
        </td>
        <td> <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#manageModal{{ $user->id }}">
                Manage Participant
            </button>
        </td>
        <td><button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#financeModal">
				Finances
			</button>
		</td>
    </tr>
    
    @endif
    @endforeach
</table>
@endforeach

<div class="modal fade" id="studentModal" tabindex="-1" role="dialog" aria-labelledby="studentModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="studentModalLabel">Participant Information: {{$user->fname .' '. $user->lname}}</h4>
			</div>
			<div class="modal-body">
				<a href="#">Edit Information</a>

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
				<button type="submit" class="btn btn-info">Save changes</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="statusModal" tabindex="-1" role="dialog" aria-labelledby="statusModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="statusModalLabel">Participant Status</h4>
			</div>
			<div class="modal-body">
				This student is currently {{$userTrip->user->tripStatus}} for this trip.
				<br>
				<h5>If you would like to change the status of this student, please use the following options:</h5>
				<button type="button" class="btn btn-success btn-sm">Approve</button>
				<button type="button" class="btn btn-warning btn-sm">Waitlist</button>
				<button type="button" class="btn btn-danger btn-sm">Remove</button>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="studentLeaderModal" tabindex="-1" role="dialog" aria-labelledby="studentLeaderModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="studentLeaderModalLabel">Trip Leader</h4>
			</div>
			<div class="modal-body">
				<button type="button" class="btn btn-info btn-sm">
					@if({{userTrip->user->tripLeader ==1 }})
						Remove this student as a trip leader
					@else
						Make this student a student leader
					@endif
				</button>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="manageModal{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="manageModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalLabel">Manage Participant: {{$user->fname .' '. $user->lname}}</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        Change the trip of the participant:
                        <div class="form-group">
                            {{ Form::open(array('url' => '/selectTrip', 'method' => 'post')) }}
                            <select class="form-control input-lg" name = "trip_id">
                                @foreach($trips as $trip)
                                <option value="{{ $trip->id }}">{{ $trip->name }}</option>
                                @endforeach
                            </select>								
                        </div>
                    </div>	
                    <button type="submit" class="btn btn-info">Confirm Trip Change</button>
                    
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-info">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="financeModal" tabindex="-1" role="dialog" aria=labelledby="financeModal" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"<span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="financeModalLabel">Finances</h4>
			</div>
			<div class="modal-body">

				<h4>Submit a payment for this participant</h4>
				Payment Amount:<br>
				{{Form::number('amount','value')}}
				<br><br>
				Date:<br>
				{{Form::selectRange('day', 1, 31)}}
				{{Form::selectMonth('month')}}
				{{Form::selectRange('year', 2000, 2015)}}

				<br><br>
				<h4>Payment History</h4>
				<table class="table table-hover">
					<thead>
						<th>Amount</th>
						<th>Date</th>
					</thead>
					<tr>
						<td>{{$payment->amount}}</td>
						<td>{{$payment->date}}</td>
					</tr>
				</table>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
				<button type="submit" class="btn btn-info">Save changes</button>
			</div>
		</div>
	</div>
</div>

@stop
