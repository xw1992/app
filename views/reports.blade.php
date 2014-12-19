@extends('templateDoubleNav')
@section('content')
    <div class="row col-md-12">
        @if(Session::has('adminSuccess'))
        <div class="alert alert-success" role="alert">
            {{Session::get('adminSuccess')}}
        </div>
        @endif
    </div>
    <div class="col-sm-7 col-md-5">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title">Statistics for this year:</h3>
          </div>
          <div class="panel-body">
            <div class="container">
                <h3>Total number of participants: {{$totalNum}}</h3>
                <h3>Male: {{$maleNum}}</h3>
                <h3>Female: {{$totalNum - $maleNum}}</h3>
                <h3>Student member: {{$studentNum}} </h3> 
                <h3>Non-student member: {{$totalNum - $studentNum}}</h3>
                 
                @foreach ($year_array as $key => $value)
                    <h3>class of {{$key}}: {{$value}}</h3> 
                @endforeach
            </div>
          </div>
        </div>
    </div>
    <div class="col-sm-5 col-md-7">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title">Email options:</h3>
          </div>
          <div class="panel-body">
            <div class="container">
                <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#reminder">Remind all participants of their payments</button>

                <div class="modal fade" id="reminder" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="myModalLabel">Remind all participants of their payments</h4>
                      </div>
                      <div class="modal-body text-center">
                        
                        {{Form::open(['url'=>'remindPayments'])}}
                        <div class="row">
                            <div class="col-xs-10 col-xs-offset-1">
                            <h4>Would you like to insert a message to the standard reminder email?</h4>
                            {{Form::textarea('custom_message', '', ['class'=>'form-control'])}}
                            </div>
                        </div>
                        <div class="row"> 
                        <br>  
                        <div class="col-xs-6"><button type="button" class="btn btn-lg btn-default" data-dismiss="modal">Cancel</button></div>    
                            <div class="col-xs-6"><button type="submit" class="btn btn-lg btn-primary">Confirm</button></div>
                            
                        </div>
                        {{Form::close()}}
                    
                      </div>
                    </div>
                  </div>
                </div>
            </div>
          </div>
        </div>
    </div>

@stop