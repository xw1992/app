	@extends('templateDoubleNav')

	@section('nav_items')
	<li class = "active">
		<a href="/"><font size = "4" color="white">log out</font></a>
	</li>
	@stop

	@section('content')    

	<h4>Manage Trips</h4>
	
	<table class="table table-hover">
		<thead>
			<tr>
				<th>Trip id</th>
				<th>Trip Name</th>
				<th>Finances</th>
				<th>Date</th>
				<th>Enrolled</th>
				<th>Capacity</th>
				<th>Waitlisted</th>
				<th>Forms</th>
				<th>Manage</th>
			</tr>
		</thead>
		
		<tr>
			<td>{{$trip->id}}</td>
			<td>{{$trip->name}}</td>
			<td>
				<a type="button" class="btn" href="#tripFinanceModal" data-toggle="modal">Finances</a>
			</td>
			<td>{{$trip->time}}</td>
			<td>
				<a type="button" class="btn" href="#tripEnrollModal" data-toggle="modal">{{$trip->enroll_no}}</a>
			</td>
			<td>{{$trip->capacity</td>
			<td>
				<a type="button" class="btn" href="#tripWaitlistModal" data-toggle="modal">{{$trip->waitlist_no}}</a>
			</td>
			<td>
				<a type="button" class="btn" href="#tripFormsModal" data-toggle="modal">{{Forms}}</a>
			</td>
			<td>
				<a type="button" class="btn" href="#tripManageModal" data-toggle="modal">{{Manage}}</a>
			</td>
		</tr>

		<div class="modal fade" id="tripFinanceModal" tabindex="-1" role="dialog" aria-labelledby="tripFinanceModalLabel$trip->id}}" aria-hidden="true"> 
			<div class="modal-dialog">
				<div class="modal-content"> 
					<div class="modal-header"> 
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
						<h4 class="modal-title" id="tripFinanceModalLabel$trip->id}}">Finance Information for $trip->name}}</h4>
					</div>
					<div class="modal-body">
						<form type="form">
							<h5>Cost of the trip: </h5>{{Form::text('cost', $trip->cost)}}<br>
							<h5>Due Date of 1st Payment: </h5>{{Form::text('first', $trip->first_due_day)}}<br>
							<h5>Due Date of 2nd Payment: </h5>{{Form::text('second', $trip->second_due_day)}}
						</div>
						<div class="modal-footer">
							<button type="submit" class="btn btn-info">Save changes</button>
						</div>
					</form>
				</div>
			</div>
		</div>

		<div class="modal fade" id="tripEnrollModal" tabindex="-1" role="dialog" aria-labelledby="tripEnrollModalLabel$trip->id}}" aria-hidden="true"> 
			<div class="modal-dialog">
				<div class="modal-content"> 
					<div class="modal-header"> 
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
						<h4 class="modal-title" id="tripEnrollModalLabel$trip->id}}">{{Students Enrolled for $trip->name}}</h4>
					</div>
					<div class="modal-body">
						student one
					</div>
				</div>
			</div>
		</div>

		<div class="modal fade" id="tripWaitlistModal" tabindex="-1" role="dialog" aria-labelledby="tripWaitlistModalLabel$trip->id}}" aria-hidden="true"> 
			<div class="modal-dialog">
				<div class="modal-content"> 
					<div class="modal-header"> 
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
						<h4 class="modal-title" id="tripWaitlistModalLabel$trip->id}}">{{Students Waitlisted for $trip->name}}</h4>
					</div>
					<div class="modal-body">
						Student One	
					</div>
				</div>
			</div>
		</div>

		<div class="modal fade" id="tripFormsModal" tabindex="-1" role="dialog" aria-labelledby="tripFormsModalLabel$trip->id}}" aria-hidden="true"> 
			<div class="modal-dialog">
				<div class="modal-content"> 
					<div class="modal-header"> 
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
						<h4 class="modal-title" id="tripFormsModalLabel$trip->id}}">{{Forms associated with $trip->name}}</h4>
					</div>
					<div class="modal-body">
						Forms
					</div>
				</div>
			</div>
		</div>

		<div class="modal fade" id="tripManageModal" tabindex="-1" role="dialog" aria-labelledby="tripManageModalLabel$trip->id}}" aria-hidden="true"> 
			<div class="modal-dialog">
				<div class="modal-content"> 
					<div class="modal-header"> 
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
						<h4 class="modal-title" id="tripManageModalLabel$trip->id}}">{{Manage $trip->name}}</h4>
					</div>
					<div class="modal-body">
						<form class="form">
						
							<h5>Trip Name: </h5>{{Form::text('name', $trip->name)}
							<h5>Trip Start Date: </h5>{{Form::text('begin_date', $trip->begin_date')}}
							<h5>Trip End Date: </h5>{{Form::text('end_date', $trip->end_date)}}<br><br>


							<button type="submit" class="btn btn-info">Open Trip</button>
							<button type="submit" class="btn btn-danger">Delete Trip</button>

						</div>
						<div class="modal-footer">
							<button type="submit" class="btn btn-info">Save Changes</button>
						</form>
					</div>
				</div>
			</div>

		</table>

		@stop