<!DOCTYPE html>
<?php session_start(); 
 if($_SESSION['username'] != '') {
     header("Location: user-home.php");
 }
$GLOBALS['sitepath'] = realpath(dirname(__FILE__));
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link type="text/css" href="css/login.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="login.php"><span class="company">Connect</span></a>
    </div> 
    <div class="navbar-collapse collapse">
        <ul class="nav navbar-nav">
            <li class="active"><a href="#">Home</a></li>
            <li><a href="#">Contact</a></li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Invite Friends <b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li><a href="http://www.facebook.com">Facebook</a></li>
                    <li><a href="http://www.twitter.com">Twitter</a></li>
                    <li><a href="https://plus.google.com">Google+</a></li>
                </ul>
            </li>
        </ul>
    </div>    
    </nav>
<!-- End Navigation -->
      <div class="login">
          <div class="row">
            <div class="col-sm-4 col-sm-offset-4">
                <img class="img-responsive logo" src="images/client-logo8-trans.png" />
                
                <form method="POST" name="loginForm" id="loginForm" action="dao/loginDAO.php" class="form-vertical">
                    <div class="form-group">
                        <div class="col-xs-10">
                            <input data-toggle="popover" data-placement="right" data-content="Please check your username" type="username" class="form-control" name="username" id="username" placeholder="Username">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-10">
                            <input data-toggle="popover" data-placement="right" data-content ="Please check your password" type="password" class="form-control"  name="password" id="password" placeholder="Password">
                        </div>
                    </div>
                <!--    <div class="form-group">
                        <div class="col-xs-offset-2 col-xs-10">
                            <div class="checkbox">
                                <label><input type="checkbox"><span class="remember">Remember me</span></label>
                            </div>
                        </div>
                    </div> -->
                    <div class="form-group">
                        <div class="col-xs-offset-2 col-xs-10">
                            <input name="login" id="login-btn" type="submit" value="Login" class="btn btn-primary login-btn"></input>
                            <a href="register.php" class="btn btn-primary register-btn">Sign Up</a>

                        </div>
                    </div>
                </form>
                <!-- Form Ends here -->
            </div>
          </div>
      </div>
<!-- Login Section Ends here -->
    <!--<div class="ftr">
    <div class="container">
        <div class="row">
            <div class="col-sg-8">
                <div class="pull-left ft_space">
                    <p>&copy; Connect. 2013</p>
                </div>
            </div>
            <div class="col-sg-4">
                <div class=" ft_space logo">
                    <img class="img-responsive" src="images/client-logo4.png">
                </div>
            </div>
        </div>
    </div> -->    
<!-- End Footer -->

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    
    <script>
        
        $(document).ready(function() {
          $('#loginForm').submit(function(e) {
            e.preventDefault();
            if(validate() == true) {
                $.ajax({
                   type: "POST",
                   url: 'DAO/loginDAO.php',
                   data: $(this).serialize(),  //Data is sent in th serialized form,for security purpose
                   dataType: "text",
                   success: function(data)
                   {
                      if (data === 'success') {
                        window.location = '/tsn/user-home.php';
                      }
                       else {
                         error();
                       }
                   }
               });
             }
          });
        });
                          
        function error() {
            var inputs = document.getElementsByClassName("form-control");
            for(var i = 0; i < inputs.length; i++) {
                inputs[i].style.borderColor = 'red';
                inputs[i].style.boxShadow =  "0 0 10px red";
                var id = inputs[i].id;
                $(function () { $("[data-toggle='popover']").popover('show'); });
            }
        }
        
        function validate() {
            var ret=true;
            var inputs = document.getElementsByClassName("form-control");
            for(var i = 0; i < inputs.length; i++) {
                if(inputs[i].value == '' ) {
                    ret = false;
                    inputs[i].style.borderColor = 'red';
                    inputs[i].style.boxShadow =  "0 0 10px red";
                    var id = inputs[i].id;
                    $(function () { $('#'+inputs[i].id).popover('show'); });
                }
                if(inputs[i].value != '' ) {
                    $(function () { $('#'+inputs[i].id).popover('destroy'); });
                }

            }
            return ret;
        }
    </script>
  </body>
</html>