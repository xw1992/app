
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
                <ul class = "nav navbar-nav pull-right">
                    <li class = "active">
                        <a href="/"><font size = "4" color="white">log in</font></a>
                    </li>


                </ul>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">
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