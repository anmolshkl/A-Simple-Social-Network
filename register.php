<!DOCTYPE html>
<?php session_start(); 
 if($_SESSION['username'] != '') {
     header("Location: user-home.php");
 }
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link type="text/css" href="css/register.css" rel="stylesheet">
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
      <div class="container">
        <div class="row header">
            
            <h1>REGISTER</h1>  
        </div>
        <div class="row">
            <div class="col-xs-12 well rbody">
                <div class="col-xs-6 col-xs-offset-3 well">
                <form method="POST" name="regForm" id="regForm" action="dao/registerDAO.php" class="form-vertical">
                    <div class="form-group">
                        <label for="fn">First Name</label>
                        <input type="text" class="form-control" name="fn" id="fn">
                    </div>
                    <div class="form-group">
                        <label for="ln">Last Name</label>
                        <input type="text" class="form-control" name="ln" id="ln">
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" name="username" id="username">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" id="password">
                    </div>
                    <div class="form-group">
                        <label for="confPassword">Confirm Password</label>
                        <input type="password" class="form-control" name="confPassword" id="confPassword">
                    </div>
                    <div class="form-group">
                        <label for="ln">Email Address</label>
                        <input type="email" class="form-control" name="email" id="email">
                    </div>
                    <div class="form-group">
                        <label for="pic">Profile Picture</label>
                        <input type="file" class="form-control" name="file" id="file">
                    </div>
                    <div class="form-group">
                        <label for="dob">Date of birth</label>
                        <input type="data" name="dob" class="form-control" id="dob" placeholder="MM/DD/YYYY">
                    </div>
                    <div class="form-group">
                        <label for="addr">Address</label>
                        <textarea name="addr" class="form-control" id="addr">
                        </textarea>
                    </div>
                    <div class="form-group">
                        <label for="city">Ciy</label>
                        <input type="text" name="city" class="form-control" id="city">
                    </div>
                    <div class="form-group">
                        <label for="mob">Mobile Number</label>
                        <input type="text" name="mob" class="form-control" id="mob">
                    </div>
                    <div class="form-group">
                        <label for="sques">Security Question</label>
                        <input type="text" name="sques" class="form-control" id="sques">
                    </div>
                    <div class="form-group">
                        <label for="sans">Security Answer</label>
                        <textarea name="sans" class="form-control" id="sans">
                        </textarea>
                    </div>
                    <div class="form-group">
                        <label for="inter">What interests you? :/</label>
                        <textarea class="form-control" name="inter" id="inter">
                        </textarea>
                    </div>
                    <div class="form-group">
                        <label for="about">Tell us something about yourself</label>
                        <textarea class="form-control" name="about" id="about">
                        </textarea>
                    </div>
                    <input type="submit" value="Register" class="btn btn-primary" />
                    </form>
                 </div>
            </div>
 
        </div>
      </div>
      
      <div class="modal fade" id="modal">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                    </button>
                <h4 class="modal-title"></h4>
              </div>
              <div class="modal-body">
                <p></p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
              </div>
            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
      
      <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    
    <script>
        
        $(document).ready(function() {
          $('#regForm').submit(function(e) {
            e.preventDefault();
            var formData = new FormData($(this)[0]);
            if(validate() == true) {
                $.ajax({
                   type: "POST",
                   url: 'DAO/registerDAO.php',
                   data: formData,
                    async: false,
                    contentType: false,
                    processData: false, 
                   success: function(data)
                   {
                      if (data === 'success') {
                        window.location = '/tsn/login.php';
                      }
                       else {
                         if(data === 'username exists') {
                             $("#username").css({"border-color":"red","box-shadow":"0 0 10px red"});
                             $(".modal-title").text("Username already exists!");
                             $(".modal-body").text("Please choose another username");
                             $("#modal").modal('show');   
                          }
                          else {
                            $(".modal-title").text("Error!");
                            $(".modal-body").text("Please check you inputs");
                          }
                          $("#modal").modal('show');   
                       }
                   }
               });
             }
          });
        });
                          
        
        
        function validate() {
            var ret=true;
            var pass = document.getElementById("password");
            var confPass = document.getElementById("confPassowrd");
            if(pass != password ) {
                $(".modal-title").html("Error!");
                $(".modal-body").html("Confirmation Password doesnt matches original password");
                $("#password").css({"border-color":"red","box-shadow":"0 0 10px red"});
                $("#confPassword").css({"border-color":"red","box-shadow":"0 0 10px red"});
                $("#modal").modal('show');
                ret = false;
            }

            var inputs = document.getElementsByClassName("form-control");
            for(var i = 0; i < inputs.length; i++) {
                if(inputs[i].value == '' ) {
                    ret = false;
                    inputs[i].style.borderColor = 'red';
                    inputs[i].style.boxShadow =  "0 0 10px red";
                    $(".modal-title").html("Error!");
                    $(".modal-body").html("Please check your input");
                    $("#modal").modal('show');
                }
            }
            return ret;
        }
    </script>
  </body>
</html>
