   @extends('template')@section('nav_items')@stop@section('content')       @if(Session::has('userSuccess'))<div class="alert alert-success" role="alert">    {{Session::get('userSuccess')}}</div>@endif<center>    <h2>Your application for</h2>    <h1>{{ $userTrip->trip->name }}</h1>    <h2>is awaiting approval</h2>      <br>    <h4><a href="#">Click here to pay your deposit</a></h4>      		</center>@stop