@extends('templateDoubleNav')

@section('content')    

@if(Session::has('adminSuccess'))
<div class="alert alert-success" role="alert">
	{{Session::get('adminSuccess')}}
</div>
@endif
<h4 class="text-center">Manage Forms</h4>

<table class="table table-hover">
	<thead>
		<tr>
			<th>Form Name</th>
			<th>Trips</th>
			<th>Manage</th>
		</tr>
	</thead>
	<tr>
		<td>Form Name</td>
		<td><button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#formTripModal">
			Trips
		</button>
	</td>
	<td><button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#formModal$user->id}}">
		Manage
	</button>
</td>
</tr>

<div class="modal fade" id="formTripModal" tabindex="-1" role="dialog" aria-labelledby="formTripModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="formTripModalLabel">Manage the trips using this form: $form->name}}</h4>
			</div>
			
			<div class="modal-body">
				@foreach($trips as $trip)
				<div class="col-xs-6">
					{{$trip->name}}
				</div>
				<div class="col-xs-6">
					{{Form::checkbox('formTrip', 0)}}
				</div>

				@endforeach              
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
				<button type="submit" class="btn btn-info">Save changes</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="newFormModal" tabindex="-1" role="dialog" aria-labelledby="newFormModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="newFormModalLabel">Add a new form</h4>
			</div>
			<div class="modal-body">
				<div class="col-md-6">
					<form>
						<h5>Name:</h5>
						{{Form::text('form_name')}}<br><br>
						<h5>Select a file from your computer:</h5>
						{{Form::file('image')}}

					</form>
				</div>
				<div class="col-md-6">
					<div class="row">
						<h5>Which trips would you like to add this form to?</h5>
						<form>
							trip1
							{{Form::checkbox('tripCheck', 0)}}
						</form>

					</div>
				</div>

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
				<button type="submit" class="btn btn-info">Save changes</button>
			</div>
		</div>
	</div>
</div>






</table>
<center>
	<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#newFormModal">
		Add a Form
	</button>
</center>
<div class="modal fade" id="newFormModal" tabindex="-1" role="dialog" aria-labelledby="newFormModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="newFormModalLabel">Add a new form</h4>
			</div>
			<div class="modal-body">
				<form>
					<h5>Name:</h5>
					{{Form::text('form_name')}}<br><br>
					<h5>Select a file from your computer:</h5>
					{{Form::file('image')}}

				</form>

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
				<button type="submit" class="btn btn-info">Save changes</button>
			</div>
		</div>
	</div>
</div>

@stop