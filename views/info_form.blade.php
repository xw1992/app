@extends('template')

@section('nav_items')

<li class = "active">
        <a href="/"><font size = "4" color="white">log out</font></a>
        </li>
@stop

@section('content')
<div class="alert alert-success">
     <h3>Congratulations you have been approved for this trip please fill out the form below.</h3>
     </div>

        <div class="row centered-form">
        	<div class="panel panel-default">
        		<div class="panel-heading">
			    		<h3 class="panel-title">Participant Information</h3>
			 			</div>
			 			<div class="panel-body">
			 		{{Form::open(['url'=>'/saveInfo', 'method'=>'post','class'=>'form'])}}
			    		
			    		Please fill out the following participant information.  This information
			    		will be used by the Project Leader to get to know you better, and by the site
			    		partner in arranging for your stay
			    		<br><br>
                                        @if(!Auth::user()->passport_no and $international)
			    		        <div class="row">
			    				<div class="col-md-4 col-md-6 col-md-6">
			    					<div class="form-group">
			    					<h5>Passport Number:</h5>
                                                                <input type="text" name="passport_no" id="passport_no" class="form-control input-md" required>
			    					</div>
			    				</div>
			    			</div>
                                        @endif
			    			<div class="row">
			    				<div class="col-md-4 col-md-6 col-md-6">
			    					<div class="form-group">
			    					<h5>Major field of study or academic interest:</h5>
			                <input type="text" name="major" id="major" class="form-control input-md" required>
			    					</div>
			    				</div>
			    			</div>
                                        
                                                <div class="row">
			    				<div class="col-md-4 col-md-6 col-md-6">
			    					<div class="form-group">
			    					<h5>Hometown and State:</h5>
                                                                <input type="text" name="hometown_state" class="form-control input-md" required>
			    					</div>
			    				</div>
			    			</div>
			    			
			    			<div class="row">
			    				<div class="col-md-6 col-md-6 col-md-6">
			    					<div class = "form-group">
			    					<h5>Dietary Needs / Food Allergies / Access Needs:</h5>
			    						<textarea name ="dietary_needs" id="dietary_needs" class="form-control input-md" rows="5"></textarea>
			    					</div>
			    				</div>
                                                </div>   				
			    				 
			    		  <div class="row">			
			    			<div class = "col-md-6 col-md-6 col-md-6">
			    				<div class="form-group">
			    				<h5>Are you fluent in a foreign language?  If so, list which language(s):</h5>
			    					<textarea name="languages" id="languages" class="form-control input-md" rows="3"></textarea>
			    				</div>
			    			</div>	
			    			</div>

							<div class="row">
							<div class = "col-md-6 col-sm-6 col-md-6">
							<h5>Do you smoke?</h5>
			    			This information is relevent for host families.<br>
								</div>
								</div>
								<div class="row">
								<div class = "col-md-2 col-sm-6 col-md-6">
			    				<div class="form-group">
			    					<select class="form-control input-sm" name = "smoker">
			    						<option value="0">No</option>
			    						<option value="1">Yes</option>
			    					</select>
			    					</div>
			    			</div>
			    	  </div>  	
			    	  
			    	  <div class="row">		    			
			    			<div class = "col-md-6 col-md-6 col-md-6">
			    				<div class="form-group">
			    				<h5>List any allergies or medical conditions of which your host family/site coordinator should be aware of.</h5>
			    				<textarea name="medical" id="medical" class="form-control input-md" rows = "5"></textarea>
			    				</div>
			    			</div>		
			    		</div>
			    		
			    		<div class="row">
			    		<div class="col-md-6 col-md-6 col-md-6">
			    			<div class="form-group">
			    				<h5>List your interests or previous experiences relevent to the location or nature of the project site.  
			    				Why did you choose this site?</h5>
			    				<textarea name="reason" id="reason" class="form-control input-md" rows="5" required></textarea>
			    			</div>
			    		</div>  
						</div>			    		
			    		
			    		<div class="row">
			    		<div class="col-md-6 col-md-6 col-md-6">
			    			<div class="form-group">
			    				<h5>Write a brief autobiographical sketch that tells the site coordinator
			    				and the host family about you.  Topics you might cover are:
			    				family, where you have lived, hobbies or interests, campus activities, etc.</h5>
			    				<textarea name="autobiography" id="autobiography" class="form-control input-md" rows="5" required></textarea>
			    			</div>
			    		</div>	
			    		</div>	
			    		
			    		<div style="text-align:center;">
						<button type="submit" class="btn btn-info">Submit</button>			    		
			    		</div>
			    		</div> 
							</div>
							</div>		    			
			    		</form>
			    	</div>

@stop
