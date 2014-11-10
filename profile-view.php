<!DOCTYPE html>
<?php
session_start();
if(isset($_GET['userToRetrieve']) && $_GET['userToRetrieve'] != '') {
    $GLOBALS['userToRetrieve'] = $_GET['userToRetrieve'];
}else {
    $GLOBALS['userToRetrieve'] = $_SESSION['username'];
}
include('dao/profileDAO.php');
$user = new User();
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Updates</title>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
      <style>
        body {
            background-color: transparent;
        }
        .well {
            background-color: #FFFFFF;
        }
          
      </style>
  </head>
  <body>
    <div class="container well">
     <div class="row">
        <div class="col-xs-6">
            <label >Profile Pic:</label>  
        </div>
        <div class="col-xs-6">
            <?php $user->initiateQuery();
                $path = $_SERVER['DOCUMENT_ROOT']."/tsn/images/user_images";
                $file = $_SESSION['username'];
                $dir_handle = @opendir($path) or die("Unable to open folder");
                while (false !== ($file = readdir($dir_handle))) {

                if($file != '.' && $file != '..' && $file != 'Thumbs.db')
                {
                echo "<img src=\"$path/$file\" alt='$file'>";
                }
                }
                echo"</table>";
                closedir($dir_handle);            
            ?>  

        </div>
    </div>
    
          <hr>
      
      <div class="row">
        <div class="col-xs-6">
            <label >Username:</label>  
        </div>
        <div class="col-xs-6">
            <?php echo $user->username; ?>  
        </div>
      </div>
          <hr>
      <div class="row">
        <div class="col-xs-6">
            <label>First Name:</label>  
        </div>
        <div class="col-xs-6">
            <?php echo $user->fn; ?>  
        </div>
      </div>
          <hr>
      <div class="row">
        <div class="col-xs-6">
            <label>Last Name:</label>  
        </div>
        <div class="col-xs-6">
            <?php echo $user->ln; ?>  
        </div>
      </div>
          <hr>
      <div class="row">
        <div class="col-xs-6">
            <label>Email:</label>  
        </div>
        <div class="col-xs-6">
            <?php echo $user->email; ?>  
        </div>
      </div>
     <hr>
     <div class="row">
        <div class="col-xs-6">
            <label>Date of Birth:</label>  
        </div>
        <div class="col-xs-6">
            <?php
            echo date('M j Y ', strtotime($user->dob));
            ?>  
        </div>
     </div>
      <hr>    
      <div class="row">
        <div class="col-xs-6">
            <label>Address:</label>  
        </div>
        <div class="col-xs-6">
            <?php echo $user->addr; ?>  
        </div>
      </div>
          <hr>
      <div class="row">
        <div class="col-xs-6">
            <label>City:</label>  
        </div>
        <div class="col-xs-6">
            <?php echo $user->city; ?>  
        </div>
      </div>
          <hr>
      <div class="row">
        <div class="col-xs-6">
            <label>Mobile:</label>  
        </div>
        <div class="col-xs-6">
            <?php echo $user->mob; ?>  
        </div>
      </div>
          <hr>
      <div class="row">
        <div class="col-xs-6">
            <label>Interests:</label>  
        </div>
        <div class="col-xs-6">
            <?php echo $user->inter; ?>  
        </div>
      </div>
          <hr>
      <div class="row">
        <div class="col-xs-6">
            <label>About:</label>  
        </div>
        <div class="col-xs-6">
            <?php echo $user->about; ?>  
        </div>
      </div>
    </div>
      <hr>

      
      
      

  </body>
</html>