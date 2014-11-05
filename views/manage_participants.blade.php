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
        </tr>
    </thead>
    @foreach($users as $user)
    @if($user->userTrip and $trip->id == $user->userTrip->trip_id)
    <tr>
        <td> {{$user->student_id }}</td>
        <td> {{$user->fname .' '. $user->lname}}</td>
        <td> 
            @if($user->userTrip->approved)
            approved
            @elseif($user->userTrip->waitlisted)
            waitlisted
            @else
            awaiting approval
            @endif
        </td>
        <td> 
            @if( $user->userTrip->trip_leader)
            Yes
            @else
            No

            @endif
        </td>
        <td> <button type="button" class="btn btn-info btn-cons" data-toggle="modal" data-target="#manageModal{{ $user->id }}">
                Manage Participant
            </button></td>
    </tr>
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


                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-info">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    @endif
    @endforeach
</table>
@endforeach

@stop