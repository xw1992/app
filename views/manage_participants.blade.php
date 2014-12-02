@extends('templateDoubleNav')

@section('content')    


<h4 class="text-center">Manage Participants</h4>

<div role="tabpanel">

	<!-- Nav tabs -->
	<div id="content">
		<ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
			<li class="active"><a href="#info" data-toggle="tab">Info</a></li>
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
									{{$trip->name}} Information
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
										<td>{{$user->student_id}}</td>
										<td>{{$user->fname .' '. $user->lname}}</td>
										<td>{{$user->dob}}</td>
										<td>{{$user->gender}}</td>
										<td>
											@if( $user->userTrip->trip_leader)
											Yes
											@else
											No
											@endif</td>
											<td> 
											@if($user->userTrip->approved)
											approved
											@elseif($user->userTrip->waitlisted)
											waitlisted
											@else
											awaiting approval
											@endif
										</td>
										</tr>
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
									<table class="table table-hover">
										<th>Student ID</th>
										<th>Name</th>
										@foreach($trip->tripForm as $tripForm)
										<th>{{$tripForm->form->name}}</th>
										@endforeach
										<th>Save</th>
										@foreach($users as $user)
										<tr>
											{{Form::open(array('url'=>'bla'))}}
											<td>id</td>
											<td>name</td>
											@foreach($trip->tripForm as $tripForm)
											<td>{{Form::checkbox('form'.$tripForm->form->id)}}</td>
											@endforeach
											<td>{{Form::submit('save')}}</td>
										</form>
									</tr>
									@endforeach
								</table>
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
								<table class="table table-hover">
									<th>Student ID</th>
									<th>Name</th>
									<th>deposite</th>
									<th>Leader Award</th>
									<th>Catholic Award</th>
									<th>Scholarship Award</th>
									<th>New Payment Amount</th>
									<th>New Payment Date</th>
									<th>Amount Due</th>
									<th>Save</th>
									@foreach($users as $user)
									<tr>
										<td>id</td>
										<td>name</td>
										<td>{{Form::text('deposit',100,['class'=>'form-control'])}}</td>
										<td>{{Form::text('leader_award',0, ['class'=>'form-control'])}}</td>
										<td>{{Form::text('catholic_award',0,['class'=>'form-control'])}}</td>
										<td>{{Form::text('scholarship_award',0,['class'=>'form-control'])}}</td>
										<td>{{Form::text('payment_amount','',['class'=>'form-control'])}}</td>
										<td>{{Form::text('payment_date','',['class'=>'form-control'])}}</td>
										<td>amount due</td>
										<td>{{Form::submit('save')}}</td>
									</form>
								</tr>
								@endforeach
							</table>
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