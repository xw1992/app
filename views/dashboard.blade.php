    @extends('template')@section('nav_items')	@stop@section('content')    

<h4><center>Welcome to your Dashboard!</center></h4>   
<div class="row">
<div class="container">
	<div class="row">
		<div class="col-md-4">
                  
                  <p>Your application progress</p>
                  <br>
                  <div class="col-md-11">
                    <div class="progress">
                      <div data-percentage="0%" style="width: 50%;" class="progress-bar progress-bar-success" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    
                  </div>
                </div>

</div>

<div class="container" style="margin-top:20px;">
	
        <div class="col-md-6">
            <h3 class="text-center">Forms for your trip:</h3>
            <div class="well" style="max-height: 300px;overflow: auto;">
        		<ul class="list-group checked-list-box">
                  <li class="list-group-item"><a class='btn btn-info btn-xs' href="#">Form 1</a></li>
                  <li class="list-group-item"><a class='btn btn-info btn-xs' href="#">Form 2</a></li>
                  <li class="list-group-item"><a class='btn btn-info btn-xs' href="#">Form 3</a></li>
                  <li class="list-group-item"><a class='btn btn-info btn-xs' href="#">Form 4</a></li>
                </ul>
            </div>
        </div>
	</div>
</div>

@stop