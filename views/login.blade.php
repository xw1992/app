
@extends('template')

@section('nav_items')
<li class = "active">
    <a href="/Immersion/public/register"><font size = "4" color="white">new user?</font></a>
</li>
@stop

@section('content')

<div class="container" style="margin-top:30px">
    <div class="col-md-6 col-md-offset-3 form-group">
        <div class="panel panel-default">
            <div class="panel-heading"><h3 class="panel-title"><strong>Sign In </strong></h3></div>
            <div class="panel-body">
                @if(Session::has('loginError'))
                <div class="alert alert-danger" role="alert">
                    {{Session::get('loginError')}}
                </div>
                @endif
                {{Form::open(array('url'=>'/login','method'=>'post'))}}
                <!--<form role="form" action="/login" method="post">-->
                <div class="form-group">
                    <label for="email" class="lead">Email</label>
                    {{Form::email('email','',array('class'=>'form-control', 'placeholder'=>'Enter email', 'required'=>'required'))}}
                    <!--input type="email" value="" class="form-control" name = "email" id="exampleInputEmail1" placeholder="Enter email" required="required"-->
                </div>
                <div class="form-group">
                    <label for="password" class="lead">Password <a href="#" data-toggle="modal" data-target="#forgotPassword">(forgot password)</a></label>
                    <input type="password" class="form-control"  name = "password" id="exampleInputPassword1" placeholder="Password" required="required">
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-lg btn-primary">Sign in</button><br/><br/>
                    <a href = "register" class="lead">new user?</a>
                </div>
                <div class="modal fade" id="forgotPassword" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="myModalLabel">Forgot password</h4>
                      </div>
                      <div class="modal-body">
                        <p>Please contact Jeff Rioux at jrioux@gettysburg.edu to reset your password.</p>
                      </div>
                    </div>
                  </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

@stop