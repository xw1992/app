<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="Anna Kane" >
        <link rel="icon" href="../../favicon.ico">

        <style type="text/css">
            body{
                padding-top:45px;    	
            }
        </style>

        <title>Signing up</title>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootswatch/3.2.0/spacelab/bootstrap.min.css">
        <!-- https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css -->
    </head>

    <body>


        <div class="container">
            <div class="row">

                <div class="col-md-4 col-md-offset-4">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <h5 class="text-center">
                                SIGN UP</h5>
                            <form class="form form-signup" role="form" action="/signup" method="post">
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                                        <input type="text" name="username" class="form-control" placeholder="Username" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span>
                                        </span>
                                        <input type="text" name="email" class="form-control" placeholder="Email Address" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                                        <input type="password" name="password" class="form-control" placeholder="Password" />
                                    </div>
                                </div>

                                <div class= "form-group">
                                    <select name="choose_project" class="form-control"><option>project1</option><option>project2</option><option>project3</option></select>

                                </div>
                                <button type="submit" class="btn btn-sm btn-primary btn-block">
                                    SUBMIT </form>
                        </div>
                    </div>
                </div>
            </div>
        </div> 

    </body>
</html>