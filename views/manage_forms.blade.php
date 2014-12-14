@extends('templateDoubleNav')

@section('content')    

@if(Session::has('adminSuccess'))
<div class="alert alert-success" role="alert">
	{{Session::get('adminSuccess')}}
</div>
@endif
<h1 class="text-center">Manage Forms</h1>
@if(!$forms->isEmpty())
@foreach($forms as $form)
<table class="table table-hover">
	<thead>
		<tr>
			<th>Form Name</th>
			<th>Trips</th>
			<th>Delete</th>
		</tr>
	</thead>
	<tr>
		<td>{{$form->name}}</td>
		<td><button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#formTripModal">
			Trips
		</button>
	</td>
	<td><button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#deleteFormModal">
		Delete
	</button>
</td>
</tr>

<div class="modal fade" id="formTripModal" tabindex="-1" role="dialog" aria-labelledby="formTripModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="formTripModalLabel">The following trips have this form: {{$form->name}}</h4>
			</div>
			
			<div class="modal-body">
				{{Form::open(array("url" => "/editForm"))}}
				{{Form::hidden("id", $form->id)}}
				@foreach($trips as $trip)
				<div class="row">
				<div class="col-xs-6 col-sm-3">
					{{$trip->name}}
				</div>
				<div class="col-xs-6 col-sm-3">
					{{Form::checkbox('trip'.$trip->id, 1, in_array($trip->id, $tripForms[$form->id]))}}
				</div>
			</div>
				@endforeach             
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
				<button type="submit" class="btn btn-info">Save changes</button>
				</form> 
			</div>
		</div>
	</div>
</div>


<div class="modal fade" id="deleteFormModal" tabindex="-1" role="dialog" aria-labelledby="deleteFormModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="deleteFormModalLabel">Delete Form</h4>
			</div>
			<div class="modal-body">
				{{Form::open(array("url" => "/deleteForm"))}}
				{{Form::hidden("id", $form->id)}}
				<h3>Are you sure you want to delete this form?</h3>
				<h4>Form name: {{$form->name}}</h4>
					<button type="submit" class="btn btn-default">Yes, delete</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
				</form>

			</div>
		</div>
	</div>
</div>
@endforeach
</table>
@else
<h2 class="text-center">No form has been added to the database.</h2>
@endif
<hr>

<center>
	<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#newFormModal">
		 Add new Form
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
				<div class="row">
				<div class="col-md-6">
					{{ Form::Open(array('files'=>true, "url" => "/addNewForm"))}}
						<h5>Name:</h5>
						{{Form::text('form_name')}}<br><br>
						<h5>Select a file from your computer:</h5>
						{{Form::file('form')}}

				
				</div>
				<div class="col-md-6">
					<div class="row">
						<h5>Which trips would you like to add this form to?</h5>
							@foreach($trips as $trip)
							{{Form::checkbox('trip'.$trip->id)}}
							{{$trip->name}}
							@endforeach
						

					</div>
				</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
				<button type="submit" class="btn btn-info">Save changes</button>
			</form>
			</div>
		</div>
	</div>
</div>


@stop