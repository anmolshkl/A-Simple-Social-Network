<!DOCTYPE html>
<?php session_start(); 
if($_SESSION['user_id'] == '') {
    header("Location: login.php");
}
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User Home</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link type="text/css" href="css/user-home.css" rel="stylesheet">
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
            <li><a href="logout.php">Logout</a></li>
        </ul>
        <img class="img-responsive nav-img pull-right hidden-sm" src="images/client-logo8-trans.png"></img>             
    </div>    
    </nav>
<!-- End Navigation -->
    <!--<div class="container">
        <div class="row">
            <img class="responsive-img banner" src="images/download.jpg" />
        </div>
    </div> -->
<!-- END BANNER --><br><br>
    <div class="body">
        <div class="container body">
            <div class="row search-row">
                <div class="col-12 search">
                   <h1> Hello <?php echo $_SESSION['username']; ?> </h1>
                    <form id="search_form" method="POST" class="form-horizontal tpad" role="form">
                       <div class="form-group">
                            <div class="col-lg-3 pull-right">
                                <input type="text" class="form-control " id="search" placeholder="Search for a friend">
                            </div>
                       </div>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-1 cols myTooltip">
                    <div class='nav-side'>
                      <div class='link active' data-toggle="tooltip" title data-placement="right" data-original-title="Updates" alt="one"><a target="iframe" href="updates.php">&#xf00a;</a></div>
                      <div class='link' data-toggle="tooltip" data-placement="right" title data-original-title="My Profile" alt="one"><a target="iframe" href="profile-view.php">&#xf007;</div>

                      <div class='link' data-toggle="tooltip" title data-placement="right" data-original-title="option 1" alt="one">&#xf012;</div>
                      <div class='link' data-toggle="tooltip" title data-placement="right" data-original-title="option 1" alt="one">&#xf018;</div>
                      <div class='link' data-toggle="tooltip" data-placement="right" title data-original-title="option 1" alt="one">&#xf08d;</div>
                      <div class='link' data-toggle="tooltip" data-placement="right" title data-original-title="option 1" alt="one">&#xf004;</div>
                      <div class='link' data-toggle="tooltip" data-placement="right" title data-original-title="option 1" alt="one">&#xf005;</div>
                      <div class='link' data-toggle="tooltip" data-placement="right" title data-original-title="option 1" alt="one">&#xf002;</div>
                      <div class='link' data-toggle="tooltip" data-placement="right" title data-original-title="option 1" alt="one">&#xf085;</div>
                    </div>
                </div>
                <div class="col-sm-8 well content cols">
                    <iframe src="updates.php"  height="800px" width="100%" 
	id="iframe" class="iframe" name="iframe" frameborder="0" ></iframe>   

                </div>
                <div class="col-sm-2 well cols">
                        FRIEND REQUESTS
                </div>
            </div>
        </div>
    </div>
    
     <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script>
        $(document).ready(function() {
          $('.link').on('click', function() {
            $('.link').removeClass('active');
            $(this).toggleClass('active');
          });
        });
        $(function () {
            $('.myTooltip').tooltip({
                selector: "[data-toggle=tooltip]",
                container: "body"
            })
        })
    </script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>