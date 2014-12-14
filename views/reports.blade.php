@extends('templateDoubleNav')
@section('content')
    <div class="row col-md-12">
        @if(Session::has('adminSuccess'))
        <div class="alert alert-success" role="alert">
            {{Session::get('adminSuccess')}}
        </div>
        @endif
    </div>

    <div class="alert alert-success" role="alert">
        Reports section is still under development. Coming soon.<br>
        It will show gender ratio, class year ratio, student vs. non-student ratio for each trip and all trips.<br>
        It will also have specific reports for Res life/DPS.<br>
        Trip leaders will see trip participants' contact information, their emergency contact information in the trip leader dashboard.
    </div>

@stop