<?php
ob_start();
require('../lib/PasswordHash.php');
require('/connection.php');

//Uses phpass hashing library to store the passwords
$username = '';
$password = '';
 
 if(isset($_POST['username']) && isset($_POST['password'])) {

     $username = ($_POST['username']); //Sanitizing the input
     $password = ($_POST['password']); //Sanitizing the input
     if($password != '' && $username != '' ) {

         $pwdHasher = new PasswordHash(8, FALSE);

         //create connection
         $connObj = new Connection(); //get a connection object
         $conn = $connObj->getConnection(); //get a new PDO connection
         $stmt = $conn->prepare("SELECT user_id,username,password FROM users WHERE username = :user");

         $stmt->bindParam(':user', $username, PDO::PARAM_STR);
         $stmt->execute();
         $rows=$stmt->fetch();
         if ($rows > 0) {
             $hash = $rows['password'];
             if($pwdHasher->CheckPassword($password, $hash) ) {
                 session_start();
                 session_regenerate_id();
                 $_SESSION['user_id'] = $rows['user_id'];
                 $_SESSION['username'] = $rows['username'];
                 $GLOBALS['userToRetrieve'] = $rows['username'];
                 session_write_close();
                 echo 'success';
             }
            else {
                echo 'failure';
            }

         } else {
             echo "failure";
         }
     } else {
             //$_GLOBALS['error'] = "Please enter a correct output";  
             //header('Location: ../login.php');
         echo 'failure';
     }
 }
else {
    echo 'failure';
}

//close the connection
$conn = null; 
$stmt = null;

?>