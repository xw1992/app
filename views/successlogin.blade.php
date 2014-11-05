
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="Anna Kane" >
        <link rel="icon" href="../../favicon.ico">

        <title>approval_page</title>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootswatch/3.2.0/spacelab/bootstrap.min.css">
        <!-- https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css -->
    </head>

    <body>

        <div class="navbar navbar-inverse navbar-static-top" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Immersion Project</a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                    </ul>
                </div>
            </div>
        </div>

        <h1><p class="text-center">You have successfully logged in, {{Auth::user()->username}}!</p></h1>


        <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
    </body>
</html>