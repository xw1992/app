
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
  				 <form role="form" action="/login" method="post">
  						<div class="form-group">
    						<label for="exampleInputEmail1" class="lead">Email</label>
                                                {{Form::email('email','',array('class'=>'form-control', 'placeholder'=>'Enter email', 'required'=>'required'))}}
    						<!--input type="email" value="" class="form-control" name = "email" id="exampleInputEmail1" placeholder="Enter email" required="required"-->
  						</div>
  						<div class="form-group">
    					<label for="exampleInputPassword1" class="lead">Password <a href="/sessions/forgot_password">(forgot password)</a></label>
    					<input type="password" class="form-control"  name = "password" id="exampleInputPassword1" placeholder="Password" required="required">
  						</div>
  						<div class="text-center">
  							<button type="submit" class="btn btn-lg btn-primary">Sign in</button><br/><br/>
  							<a href = "register" class="lead">new user?</a>
  						</div>
  				
				</form>
 		 		</div>
		</div>
	</div>
</div>

@stop