<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Anna Kane" >
    <link rel="icon" href="../../favicon.ico">

    <title>Immersion Project Management System</title>

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
      <li><a href="#">Manage Applicants</a>
      </li>
      <li><a href="#">Manage Trips</a>
      </li>
      <li><a href="#">Manage Forms</a>
      </li>
    </ul>
        </div>
      </div>
    </div>

<div class="container">

@yield('content')


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