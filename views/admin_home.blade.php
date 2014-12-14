@extends('templateDoubleNav')
@section('content')
    <div class="row col-md-12">
        @if(Session::has('adminSuccess'))
        <div class="alert alert-success" role="alert">
            {{Session::get('adminSuccess')}}
        </div>
        @endif
        <table class="table table-striped custab">
            <thead>
                <tr> <h4>Approve / Waitlist Trip Applicants</h4>
            </tr>
            <tr>
                <th>Student Id</th>
                <th>Name</th>
                <th>Desired Trip</th>
                <th>Available Space</th>
                <th class="text-center">Approve</th>
                <th class="text-center">Waitlist</th>
            </tr>
            </thead>



            @foreach($userTrips as $userTrip)
            <tr>
                <td> {{$userTrip->user->student_id?:'N/A' }}</td>
                <td>{{ $userTrip->user->fname.' '.$userTrip->user->lname }}</td>
                <td>{{$userTrip->trip->name }}</td>
                <td>{{$userTrip->trip->capacity-$userTrip->trip->enroll_no}}</td>
                <td class="text-center">
                    {{Form::open(array('url' => '/approveApplicant', "method" => "post"))}}
                    <input type="hidden" value="{{$userTrip->id}}" name="id">
                    <button type="submit" class='btn btn-info btn-xs'> Approve</button> 
                    </form>
                </td>
                <td class="text-center">
                    {{Form::open(array('url' => '/waitlistApplicant', "method" => "post"))}}
                    <input type="hidden" value="{{$userTrip->id}}" name="id">
                    <button type="submit" class="btn btn-danger btn-xs"> Waitlist</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
    </div>

@stop