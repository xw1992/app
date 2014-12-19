<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="Anna Kane" >
        <link rel="icon" href="../../favicon.ico">

        <title>Immersion Projects Management System</title>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootswatch/3.2.0/cerulean/bootstrap.min.css">
        <!-- https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css -->

    <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
    <script src="http://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>

    <script type="text/javascript" src="assets/twitterbootstrap/js/bootstrap-tab.js"></script>
    <script>
  $(document).ready(function() {
    $("#datepicker").datepicker({
        dateFormat:'yy/mm/dd'
    });
  });
  </script>
    </head>

    <body>

        <nav class="navbar navbar-inverse" role="navigation">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">Immersion Projects Management System</a>
          </div>
          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
              <li><a href="/manageParticipants">participants</a></li>
              <li><a href="/manageForms">forms</a></li>
              <li><a href="/manageTrips">trips</a></li>
              <li><a href="/reports">reports</a></li>
            </ul>
            <ul class = "nav navbar-nav pull-right">          
                    <li>
                        <a href="/myInfo">{{Auth::user()->fname.' '.Auth::user()->lname}}</a>
                    </li>
                     <li>
                        <a href="/logout">Logout</a>
                    </li>
                </ul>
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </nav>
        
        <!--div class="navbar navbar-inverse navbar-static-top" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">Immersion Project Management System</a>
                </div>
                <ul class = "nav navbar-nav navbar-right">
                    @yield('nav_items')
                    <li class = "active">
                        <a href="/logout"><font size = "4" color="white">log out</font></a>
                    </li>
                </ul>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                    </ul>
                </div>
            </div>

            <div class="container">
                <div class="navbar-header">
                    <ul class="nav navbar-nav">
                        <li><a href="#">Manage Applicants</a>
                        </li>
                        <li><a href="#">Manage Trips</a>
                        </li>
                        <li><a href="#">Manage Forms</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div-->

        <div class="container">

            @yield('content')


        </div>
        <hr>

        <div class="footer">
            <div class="container">
                <p class="text-muted">IPMS</p>
            </div>
        </div>

    </body>
</html>