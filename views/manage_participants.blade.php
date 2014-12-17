@extends('templateDoubleNav')

@section('content')    


<h1 class="text-center">Manage Participants</h1>

@if(Session::has('adminSuccess'))
<div class="alert alert-success" role="alert">
    {{Session::get('adminSuccess')}}
</div>
@endif
@if(Session::has('adminFailure'))
<div class="alert alert-warning" role="alert">
    {{Session::get('adminFailure')}}
</div>
@endif
<div role="tabpanel">

	<!-- Nav tabs -->
	<div id="content">
		<ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
			<li class="active"><a href="#info" data-toggle="tab">Trips</a></li>
			<li><a href="#forms" data-toggle="tab">Forms</a></li>
			<li><a href="#finances" data-toggle="tab">Finances</a></li>
		</ul>
		<div id="my-tab-content" class="tab-content">
			<div class="tab-pane active" id="info">
				@foreach($trips as $trip)
				<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
					<div class="panel panel-default">
						<div class="panel-heading" role="tab" id="headingOne">
							<h4 class="panel-title">
								<a data-toggle="collapse" data-parent="#accordion" href="#info{{$trip->id}}" aria-expanded="true" aria-controls="collapseOne">
									{{$trip->name}} Trip Enrolled: {{$trip->enroll_no}}/{{$trip->capacity}}
								</a>
							</h4>
						</div>
						<div id="info{{$trip->id}}" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
							<div class="panel-body">
								<table class="table table-hover">
									<th>Student ID</th>
									<th>Name</th>
									<th>DOB</th>
									<th>Gender</th>
									<th>Trip Leader</th>
									<th>Status</th>
									@foreach($users as $user)
									@if($user->userTrip and $trip->id == $user->userTrip->trip_id)
									<tr>
										<td>{{$user->student_id?:'N/A'}}</td>
										<td>
											<a href="/info/{{$user->id}}">
											{{$user->fname .' '. $user->lname}}
											</a>
										</td>
										<td>{{$user->dob}}</td>
										<td>{{$user->gender}}</td>
										<td>
											<a href="" data-toggle="modal"
											data-target="#studentLeaderModal{{$user->id}}">
											@if( $user->userTrip->trip_leader)
											yes
											@else
											no
											@endif
											</a>
										</td>
										<td>
											<a href="" data-toggle="modal"
											data-target="#statusModal{{$user->id}}">
											@if($user->userTrip->approved)
											approved
											@elseif($user->userTrip->waitlisted)
											waitlisted
											@else
											awaiting approval
											@endif
											</a>
										</td>
									</tr>
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
												<div class="row">
												@if(!$user->userTrip->approved and $trip->enroll_no < $trip->capacity)
												{{ Form::open(array('url' => '/approveApplicant', 'method' => 'post')) }}
												{{Form::hidden("id", $user->userTrip->id)}}
												<button type="submit" class="btn btn-success btn-sm">Approve</button>
												{{Form::close()}}
											@endif
											@if(!$user->userTrip->approved and !$user->userTrip->waitlisted)
											{{ Form::open(array('url' => '/waitlistApplicant', 'method' => 'post')) }}
											{{Form::hidden("id", $user->userTrip->id)}}
											<button type="submit" class="btn btn-warning btn-sm">Waitlist</button>
											{{Form::close()}}
										@endif
										{{ Form::open(array('url' => '/removeFromTrip', 'method' => 'post')) }}
										{{Form::hidden("id", $user->userTrip->id)}}
										<button type="submit" class="btn btn-danger btn-sm">Remove from trip</button>
									</div>
										{{Form::close()}}                          
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
													Unassign {{$user->fname}} as a trip leader
													@else
													Make {{$user->fname}} a trip leader
													@endif
												</button>
											</form>
										</div>
									</div>
								</div>
								</div>
									@endif
									@endforeach
									</table>
								</div>
							</div>
						</div>
					</div>
					@endforeach
				</div>
				<div class="tab-pane" id="forms">
					@foreach($trips as $trip)
					<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
						<div class="panel panel-default">
							<div class="panel-heading" role="tab" id="headingOne">
								<h4 class="panel-title">
									<a data-toggle="collapse" data-parent="#accordion" href="#form{{$trip->id}}" aria-expanded="true" aria-controls="collapseOne">
										{{$trip->name}} Forms
									</a>
								</h4>
							</div>
							<div id="form{{$trip->id}}" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
								<div class="panel-body">
									{{Form::open(array('url'=>'/saveStudentForms'))}}
									{{Form::hidden('trip_id', $trip->id)}}
									<table class="table table-hover">
										<th>Student ID</th>
										<th>Name</th>
										@foreach($trip->tripForm as $tripForm)
										<th>{{$tripForm->form->name}}</th>
										@endforeach
										
										@foreach($users as $user)
										@if($user->userTrip and $trip->id == $user->userTrip->trip_id)
										<tr>
											<td>{{$user->student_id?:'N/A'}}</td>
											<td>{{$user->fname.' '.$user->lname}}</td>
											@foreach($trip->tripForm as $tripForm)
											<td>{{Form::checkbox($tripForm->form_id.'form'.$user->id,1,$user->hasForm($tripForm->form_id))}}</td>
											@endforeach
										</tr>
										@endif
										@endforeach
								</table>
								<div class="text-center">
									<button type="submit" class="btn btn-lg btn-primary">Save</button>
								</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				@endforeach
			</div>
			<div class="tab-pane" id="finances">
				@foreach($trips as $trip)
				<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
					<div class="panel panel-default">
						<div class="panel-heading" role="tab" id="headingOne">
							<h4 class="panel-title">
								<a data-toggle="collapse" data-parent="#accordion" href="#finance{{$trip->id}}" aria-expanded="true" aria-controls="collapseOne">
									{{$trip->name}} Finances
								</a>
							</h4>
						</div>
						<div id="finance{{$trip->id}}" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
							<div class="panel-body">
							{{Form::open(['url'=>'/saveStudentFinances'])}}						{{Form::hidden('trip_id', $trip->id)}}
								<table class="table table-hover">
									<th>Student ID</th>
									<th>Name</th>
									<th>Deposit</th>
									<th>Leader Award</th>
									<th>Catholic Award</th>
									<th>Scholarship Award</th>
									<th>New Payment Amount (US dollars)</th>
									<th>New Payment Date</th>
									<th>Amount paid</th>
									<th>Amount Due</th>
									@foreach($users as $user)
									@if($user->userTrip and $trip->id == $user->userTrip->trip_id)
									<tr>
										<td>{{$user->student_id?:'N/A'}}</td>
										<td>{{$user->fname.' '.$user->lname}}</td>
										<td>{{Form::text('deposit'.$user->id,$user->userTrip->deposit,['class'=>'form-control'])}}</td>
										<td>{{Form::text('leader_award'.$user->id,$user->userTrip->leader_award, ['class'=>'form-control'])}}</td>
										<td>{{Form::text('catholic_award'.$user->id,$user->userTrip->catholic_award,['class'=>'form-control'])}}</td>
										<td>{{Form::text('scholarship_award'.$user->id,$user->userTrip->scholarship_award,['class'=>'form-control'])}}</td>
										<td>{{Form::text('payment_amount'.$user->id,'',['class'=>'form-control'])}}</td>
										<td>{{Form::text('payment_date'.$user->id,'',['class'=>'form-control','id'=>'datepicker','placeholder'=>'YYYY/MM/DD'])}}</td>
										<td><a href="#" data-toggle="modal"
											data-target="#studentPaymentsModal{{$user->id}}">{{$user->userTrip->total_paid}}</a></td>
									<div class="modal fade" id="studentPaymentsModal{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="studentPaymentsModalLabel" aria-hidden="true">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
												<h4 class="modal-title" id="studentLeaderModalLabel">Payment history</h4>
											</div>
											<div class="modal-body">
												<ul>
													@foreach ($user->payment as $payment)
														<li>Amount: ${{$payment->amount}}, date: {{$payment->date}}</li>
													@endforeach
												</ul>
											</form>
										</div>
									</div>
								</div>
								</div>
										<td>{{$trip->cost - $user->userTrip->total_paid - $user->userTrip->deposit - $user->userTrip->leader_award - $user->userTrip->catholic_award - $user->userTrip->scholarship_award}}</td>
									</tr>
									@endif
								@endforeach

							</table>
							<div class="text-center">
								<button type="submit" class="btn btn-primary">Save</button>
							</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			@endforeach
		</div>
	</div>
</div>

<script type="text/javascript">
jQuery(document).ready(function ($) {
	$('#tabs').tab();
});
</script> 

</div>



@stop