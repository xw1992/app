	@extends('templateDoubleNav')

	@section('nav_items')
	<li class = "active">
		<a href="/"><font size = "4" color="white">log out</font></a>
	</li>
	@stop

	@section('content')    

	<h1 class="text-center">Manage Trips<span class="pull-right"><button data-target="#newTripModal" data-toggle="modal" class="btn btn-primary">New Trip</button></span></h1>
	<hr>
	<table class="table table-hover">
		<thead>
			<tr>
				<th>Trip Name</th>
				<th>Status</th>
				<th>International</th>
				<th>Term</th>
				<th>Finances</th>
				<th>Trip starts</th>
				<th>Trip ends</th>
				<th>Enrolled/Capacity (Waitlisted)</th>
				<th>Forms</th>
				<th>Delete</th>
			</tr>
		</thead>
		@foreach($trips as $trip)
		<tr>
			<td><a href="#" data-target="#tripNameModal{{$trip->id}}" data-toggle="modal">{{$trip->name}}</a></td>
			<td>
				<a href="#" data-target="#tripStatusModal{{$trip->id}}" data-toggle="modal">{{$trip->open?'open':'closed'}}</a>
			</td>
			<td>
				<a href="#" data-target="#tripInternationalModal{{$trip->id}}" data-toggle="modal">{{$trip->international?'yes':'no'}}</a>
			</td>
			<td>
				<a href="#" data-target="#tripTermModal{{$trip->id}}" data-toggle="modal">{{$trip->term}}</a>
			</td>
			<td>
				<a href="#" data-target="#tripFinanceModal{{$trip->id}}" data-toggle="modal">Finances</a>
			</td>
			<td>
				<a href="#" data-target="#tripDateModal{{$trip->id}}" data-toggle="modal">{{$trip->begin_date}}</a>
				
			</td>
			<td>
				<a href="#" data-target="#tripDateModal{{$trip->id}}" data-toggle="modal">{{$trip->end_date}}</a>
			</td>
			<td>
				<a href="#" data-target="#tripEnrollModal{{$trip->id}}" data-toggle="modal">{{$trip->enroll_no.'/'.$trip->capacity.' ('.$trip->waitlist_no.')'}}</a>
			</td>
			<td>
				<a href="#" data-target="#tripFormsModal{{$trip->id}}" data-toggle="modal">Forms</a>
			</td>
			<td>
				<a href="#" class="btn btn-danger btn-sm" data-target="#tripDeleteModal{{$trip->id}}" data-toggle="modal">Delete</a>
			</td>
		

		<div class="modal fade" id="tripFinanceModal{{$trip->id}}" tabindex="-1" role="dialog" aria-labelledby="tripFinanceModalLabel$trip->id}}" aria-hidden="true"> 
			<div class="modal-dialog">
				<div class="modal-content text-center"> 
					<div class="modal-header"> 
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
						<h4 class="modal-title" id="tripFinanceModalLabel$trip->id}}">Finance Information for {{$trip->name}}</h4>
					</div>
					<div class="modal-body">
					{{Form::open(['url'=>'/editTripCost'])}}
						{{Form::hidden('trip_id',$trip->id)}}
						<div class="row">
						<h4>Cost of the trip (US dollars): </h4>
						<div class="col-xs-8 col-xs-offset-2">
							{{Form::text('cost', $trip->cost,['class'=>'form-control','required'])}}
						</div></div>
						<div class="row">
						<h4>Due Date of 1st Payment: </h4>
						<div class="col-xs-8 col-xs-offset-2">
							{{Form::text('first', $trip->first_due_day,['class'=>'form-control','required'])}}
						</div></div>
						<div class="row">
						<h4>Due Date of 2nd Payment: </h4>
						<div class="col-xs-8 col-xs-offset-2">
							{{Form::text('second', $trip->second_due_day,['class'=>'form-control','required'])}}
						</div></div>
						
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-info">Save changes</button>
					</div>
					</form>
				</div>
			</div>
		</div>

		<div class="modal fade" id="tripDateModal{{$trip->id}}" tabindex="-1" role="dialog" aria-labelledby="tripFinanceModalLabel$trip->id}}" aria-hidden="true"> 
			<div class="modal-dialog">
				<div class="modal-content text-center"> 
					<div class="modal-header"> 
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
						<h4 class="modal-title" id="tripFinanceModalLabel$trip->id}}">Edit begin and end dates for trip: {{$trip->name}}</h4>
					</div>
					<div class="modal-body">

					{{Form::open(['url'=>'/editTripDates'])}}
						{{Form::hidden('trip_id',$trip->id)}}
						<div class="row">
						<h4>Begin date: </h4>
						<div class="col-xs-8 col-xs-offset-2">
							{{Form::text('begin_date', $trip->begin_date,['class'=>'form-control','id'=>'datepicker','required'])}}
						</div></div>
						<div class="row">
						<h4>End date: </h4>
						<div class="col-xs-8 col-xs-offset-2">
							{{Form::text('end_date', $trip->end_date,['class'=>'form-control','id'=>'datepicker','required'])}}
						</div></div>
						
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-info">Save changes</button>
					</div>
					</form>
				</div>
			</div>
		</div>

		<div class="modal fade" id="tripEnrollModal{{$trip->id}}" tabindex="-1" role="dialog" aria-labelledby="tripEnrollModalLabel$trip->id}}" aria-hidden="true"> 
			<div class="modal-dialog">
				<div class="modal-content text-center"> 
					<div class="modal-header"> 
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
						<h4 class="modal-title" id="tripEnrollModalLabel$trip->id}}">Students Enrolled for {{$trip->name}}</h4>
					</div>
					<div class="modal-body">
						<div class="row">
							<h3>Capacity</h3>
							<div class="col-xs-8 col-xs-offset-2">
								{{Form::open(['url'=>'/changeCapacity'])}}
								{{Form::hidden('trip_id', $trip->id)}}
								{{Form::text('capacity', $trip->capacity,['class'=>'form-control','required'])}}
								
							</div>
						</div>
						<h3>Enrolled:</h3>
						<div class="row">
							@foreach($trip->TripUser as $tripUser)
							@if($tripUser->approved)
							<p>
								{{$tripUser->user->fname.' '.$tripUser->user->lname}},
								student ID: 
								{{$tripUser->user->student_id?:'N/A'}}
							</p>
							@endif
							@endforeach
						</div>
						<h3>Waitlisted:</h3>
						<div class="row">
							@foreach($trip->TripUser as $tripUser)
							@if($tripUser->waitlisted)
							<p>
								{{$tripUser->user->fname.' '.$tripUser->user->lname}},
								student ID: 
								{{$tripUser->user->student_id?:'N/A'}}
							</p>
							@endif
							@endforeach
						</div>
						<h3>Awaiting approval:</h3>
						<div class="row">
							@foreach($trip->TripUser as $tripUser)
							@if(!$tripUser->waitlisted and !$tripUser->approved)
							<p>
								{{$tripUser->user->fname.' '.$tripUser->user->lname}},
								student ID: 
								{{$tripUser->user->student_id?:'N/A'}}
							</p>
							@endif
							@endforeach
						</div>
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-info">Save changes</button>
					</div>
					{{Form::close()}}
				</div>
			</div>
		</div>

		<div class="modal fade" id="tripNameModal{{$trip->id}}" tabindex="-1" role="dialog" aria-labelledby="tripWaitlistModalLabel$trip->id}}" aria-hidden="true"> 
			<div class="modal-dialog">
				<div class="modal-content text-center"> 
					<div class="modal-header"> 
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
						<h4 class="modal-title" id="tripWaitlistModalLabel$trip->id}}">Change trip name</h4>
					</div>
					<div class="modal-body">
						<div class="row">
						{{Form::open(['url'=>'/changeTripName'])}}
						{{Form::hidden('trip_id',$trip->id)}}
						<h3>Trip name: </h3>
						<div class="col-xs-8 col-xs-offset-2">
						<div class="form-group">
						{{Form::text('trip_name',$trip->name,['class'=>'form-control','required'])}}
						</div></div>
					</div>

					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-info">Save changes</button>
					</div>
					{{Form::close()}}
				</div>
			</div>
		</div>

		<div class="modal fade" id="tripTermModal{{$trip->id}}" tabindex="-1" role="dialog" aria-labelledby="tripWaitlistModalLabel$trip->id}}" aria-hidden="true"> 
			<div class="modal-dialog">
				<div class="modal-content text-center"> 
					<div class="modal-header"> 
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
						<h4 class="modal-title" id="tripWaitlistModalLabel$trip->id}}">Change trip term</h4>
					</div>
					<div class="modal-body">
						<div class="row">
						{{Form::open(['url'=>'/changeTripTerm'])}}
						{{Form::hidden('trip_id',$trip->id)}}
						<h3>Trip term: </h3>
						<div class="col-xs-8 col-xs-offset-2">
						<div class="form-group">
						{{Form::text('trip_term',$trip->term,['class'=>'form-control','required'])}}
						</div></div>
					</div>
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-info">Save changes</button>
					</div>
					{{Form::close()}}
				</div>
			</div>
		</div>

		<div class="modal fade" id="tripStatusModal{{$trip->id}}" tabindex="-1" role="dialog" aria-labelledby="tripWaitlistModalLabel$trip->id}}" aria-hidden="true"> 
			<div class="modal-dialog">
				<div class="modal-content text-center"> 
					<div class="modal-header"> 
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
						<h4 class="modal-title" id="tripWaitlistModalLabel$trip->id}}">Change trip status</h4>
					</div>
					<div class="modal-body">
						<div class="row">
						{{Form::open(['url'=>'/changeTripStatus'])}}
						{{Form::hidden('trip_id',$trip->id)}}
						<button type"submit" class="btn btn-primary">{{$trip->open?'Close this trip':'Open this trip'}}</button>
						{{Form::close()}}
					</div>
					</div>
				</div>
			</div>
		</div>
						<form action="form">

							<h5>Trip Name: </h5>{{Form::text('name', $trip->name)}
							<h5>Trip Start Date: </h5>{{Form::text('begin_date', 'id'=>'datepicker',$trip->begin_date')}}
							<h5>Trip End Date: </h5>{{Form::text('end_date', 'id'=>'datepicker',$trip->end_date)}}<br><br>


		<div class="modal fade" id="tripInternationalModal{{$trip->id}}" tabindex="-1" role="dialog" aria-labelledby="tripWaitlistModalLabel$trip->id}}" aria-hidden="true"> 
			<div class="modal-dialog">
				<div class="modal-content text-center"> 
					<div class="modal-header"> 
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
						<h4 class="modal-title" id="tripWaitlistModalLabel$trip->id}}">Change trip type</h4>
					</div>
					<div class="modal-body">
						<div class="row">
						{{Form::open(['url'=>'/changeTripType'])}}
						{{Form::hidden('trip_id',$trip->id)}}
						<button type"submit" class="btn btn-primary">{{$trip->international?'Change the trip type to "Domestic"':'Change trip type to "International"'}}</button>
						{{Form::close()}}
					</div>
					</div>
				</div>
			</div>
		</div>

		<div class="modal fade" id="tripFormsModal{{$trip->id}}" tabindex="-1" role="dialog" aria-labelledby="tripFormsModalLabel$trip->id}}" aria-hidden="true"> 
			<div class="modal-dialog">
				<div class="modal-content text-center"> 
					<div class="modal-header"> 
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
						<h4 class="modal-title" id="tripFormsModalLabel$trip->id}}">Forms associated with {{$trip->name}}</h4>
					</div>
					<div class="modal-body">
						<div class="row">
							@foreach($trip->tripForm as $tripForm)
								<p class="lead">{{$tripForm->form->name}}</p>
							@endforeach
							
						</div>
					</div>
					<div class="modal-footer">
						<p class="text-left">If you wish to edit form-trip association, please click on "forms" on the navigation bar.</p>
					</div>
				</div>
			</div>
		</div>

		<div class="modal fade" id="tripDeleteModal{{$trip->id}}" tabindex="-1" role="dialog" aria-labelledby="tripManageModalLabel$trip->id}}" aria-hidden="true"> 
			<div class="modal-dialog">
				<div class="modal-content"> 
					<div class="modal-header"> 
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
						<h4 class="modal-title" id="tripManageModalLabel$trip->id}}">Are you sure you want to delete trip: {{$trip->name}}</h4>
					</div>
					<div class="modal-body">
						<div class="row">
						{{Form::open(['url'=>'/deleteTrip'])}}
						{{Form::hidden('trip_id',$trip->id)}}
						<div class="col-xs-6 text-center">
							<button type="submit" class="btn btn-lg btn-danger">Yes</button>
						</div>
						<div class="col-xs-6 text-center">
						<button type="button" class="btn btn-lg btn-info"  class="close" data-dismiss="modal">No</button>
						</div>
						{{Form::close()}}
					</div>
					</div>

				</div>
			</div>
		</div>
			</tr>
			@endforeach

		</table>

		<div class="modal fade" id="newTripModal" tabindex="-1" role="dialog" aria-labelledby="newTripModalLabel" aria-hidden="true"> 
			<div class="modal-dialog">
				<div class="modal-content text-center"> 
					<div class="modal-header"> 
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
						<h4 class="modal-title" id="newTripModalLabel">Create New Trip</h4>
					</div>
					<div class="modal-body">
						<div class="row">
						{{Form::open(['url'=>'/createTrip'])}}
						<div class="form-group">
							<div class="col-xs-6">
						<h4>Trip name: </h4>
						{{Form::text('name','',['class'=>'form-control','required'])}}
						<h4>Start Date:</h4>
						{{Form::text('begin_date','',['class'=>'form-control','required','placeholder'=>'YYYY/MM/DD'])}}
						<h4>End Date:</h4>
						{{Form::text('end_date','',['class'=>'form-control','required','placeholder'=>'YYYY/MM/DD'])}}
						<h4>Term:</h4>
						{{Form::text('term','',['class'=>'form-control','required','placeholder'=>'eg. Spring 2015'])}}						
						<h4>International</h4>
						{{Form::checkbox('international')}}
					</div>
					<div class="col-xs-6">
						<h4>Cost (US dollars):</h4>
						{{Form::text('cost','',['class'=>'form-control','required'])}}
						<h4>First Payment Date</h4>
						{{Form::text('first_due_day','',['class'=>'form-control','required','placeholder'=>'YYYY/MM/DD'])}}
						<h4>Second Payment Date</h4>
						{{Form::text('second_due_day','',['class'=>'form-control','required','placeholder'=>'YYYY/MM/DD'])}}
						<h4>Capacity</h4>
						{{Form::text('capacity','',['class'=>'form-control','required'])}}
					</div>
					</div>
					</div>
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-info">Create Trip</button>
					</div>
					{{Form::close()}}
				</div>
			</div>
		</div>

		<center>
			<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#newTripModal">
				Add new Trip
			</button>
		</center>

		<div class="modal fade" id="newTripModal" tabindex="-1" role="dialog" aria-labelledby="newTripModal" aria-hidden="true"> 
			<div class="modal-dialog">
				<div class="modal-content"> 
					<div class="modal-header"> 
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
						<h4 class="modal-title" id="newTripModalLabel">{{Manage $trip->name}}</h4>
					</div>
					<div class="modal-body">
						<form action="form">

							<h5>Trip Name: </h5>{{Form::text('name')}
							<h5>Trip Start Date: </h5>{{Form::text('begin_date')}}
							<h5>Trip End Date: </h5>{{Form::text('end_date')}}<br><br>

							<h5>International?</h5>{{Form::checkbox('international')}}


							<button type="submit" class="btn btn-info">Open Trip</button>
							<button type="submit" class="btn btn-danger">Delete Trip</button>

						</div>
						<div class="modal-footer">
							<button type="submit" class="btn btn-info">Save Changes</button>
						</form>
					</div>
				</div>
			</div>
		@stop