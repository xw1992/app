@extends('template')@section('nav_items')<ul class="nav navbar-nav navbar-right">    <li><a href="/logout">Logout</a></li></ul>@stop@section('content')    <h4><center>Welcome to your Dashboard!</center></h4>   <div class="container">    <div class="row">        <div class="col-xs-4">            <h4>Your application progress</h4>                                           <div class="progress">                <div data-percentage="0%" style="width: 0%;" class="progress-bar progress-bar-success" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>            </div>        </div>                <div class="col-xs-4">                      <table class="table table-striped table-bordered">                <thead><h4>Forms for your trip:</h4></thead>                <th>Form</th>                <th>Download</th>                @foreach($forms as $form)                <tr>                    <td>{{$form->name}}</td>                    <td><a href="#">download</a></td>                </tr>                @endforeach            </table>        </div>        <div class="col-xs-4"></div>    </div></div>@stop