
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">

    <html lang="en">
        <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <meta name="description" content="">
            <meta name="author" content="Anna Kane" >
            <link rel="icon" href="../../favicon.ico">

            <title>Immersion Project Mangagement System</title>

            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootswatch/3.2.0/cerulean/bootstrap.min.css">
            <!-- https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css -->

        </head>

        <body>

            <div class="navbar navbar-inverse navbar-static-top" role="navigation">
                <div class="container">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="#">Immersion Project Management System</a>
                    </div>
                    <ul class = "nav pull-righ">

                    </ul>
                    <div class="collapse navbar-collapse">
                        <ul class="nav navbar-nav">
                        </ul>
                    </div>
                </div>

                <div class="container">
                    <div class="navbar-header">
                        <ul class="nav navbar-nav">
                            <li><a href="/manageParticipants">Manage Applicants</a>
                            </li>
                            <li><a href="#">Manage Trips</a>
                            </li>
                            <li><a href="/manageForms">Manage Forms</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="container">

                <div class="container">
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
                                <td> {{$userTrip->user->student_id }}</td>
                                <td>{{ $userTrip->user->fname }}</td>
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
                </div>

            </div>

            <div class="footer">
                <div class="container">
                    <p class="text-muted">IPMS</p>
                </div>
            </div>

        </body>
        <script src="http://code.jquery.com/jquery-2.1.1.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>



    </html>