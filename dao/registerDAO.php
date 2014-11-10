<?php
require_once("connection.php");
require('../lib/PasswordHash.php');
session_start();
$username='';
$password='';
$confPassword='';
$fn='';
$ln='';
$email='';
$dob='';
$addr='';
$city='';
$mob='';
$secques='';
$secans='';
$inter='';
$about='';
$profile_pic='';


if(isset($_POST['username']) && isset($_POST['addr']) && isset($_POST['password']) && isset($_POST['confPassword']) && isset($_POST['fn']) &&
   isset($_POST['ln']) && isset($_POST['email']) && isset($_POST['dob']) && isset($_POST['sques']) && isset($_POST['sans']) &&
   isset($_POST['inter']) && isset($_POST['about']) && isset($_POST['mob']) && isset($_POST['city']) && $_FILES['file']['tmp_name'] != '') {
        
    if($_POST['username'] != '' && $_POST['password'] != '' && $_POST['confPassword'] != ''  && $_POST['fn'] != '' && $_POST['ln'] != '' &&
       $_POST['email'] != '' && $_POST['dob'] != '' && $_POST['sques'] != ''  && $_POST['mob'] != '' && $_POST['addr'] != '' && $_POST['city'] != '')     {
        
        $username = $_POST['username'];
        $password = $_POST['password'];
        $confPassword = $_POST['confPassword'];
        $fn = $_POST['fn'];
        $ln = $_POST['ln'];
        $email = strtolower($_POST['email']);
        $dob = $_POST['dob'];
        $addr = $_POST['addr'];
        $mob = $_POST['mob'];
        $city= $_POST['city'];
        $secques = $_POST['sques'];
        $secans = $_POST['sans'];
        $inter = $_POST['inter'];
        $about = $_POST['about'];
        $profile_pic = $_POST['username'];
        
        //set the upload path for the image file
        $target_path = $_SERVER['DOCUMENT_ROOT'] . "/tsn/images/user_images/".basename($_POST["username"]).".jpg";/*$_FILES['file']['name']);*/

        
        //regular expression to match an email
        $regex1 = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/'; 
        
        //regular expression to match a date,dd/mm/YYY format
        $regex2 = '/^(?:(?:31(\/|-|\.)(?:0?[13578]|1[02]))\1|(?:(?:29|30)(\/|-|\.)(?:0?[1,3-9]|1[0-2])\2))(?:(?:1[6-9]|[2-9]\d)?\d{2})$|^(?:29(\/|-|\.)0?2\3(?:(?:(?:1[6-9]|[2-9]\d)?(?:0[48]|[2468][048]|[13579][26])|(?:(?:16|[2468][048]|[3579][26])00))))$|^(?:0?[1-9]|1\d|2[0-8])(\/|-|\.)(?:(?:0?[1-9])|(?:1[0-2]))\4(?:(?:1[6-9]|[2-9]\d)?\d{2})$/';
        
        if (preg_match($regex1, $email) && preg_match($regex2,$dob) && $password == $confPassword) {
            
            $pwdHasher = new PasswordHash(8, FALSE);

            // $hash is what we would store in our database
            $hash = $pwdHasher->HashPassword($password);
            
            $conObj = new Connection();
            $conn = $conObj->getConnection();
            
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            
            $query = "SELECT user_id FROM users WHERE username= :user";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':user', $username, PDO::PARAM_STR);
            $stmt->execute();
            $rows=$stmt->fetch();
            if($rows > 0 ) {
                //for now sending error as a plain string,can be sent as JSON object instead
                echo 'username exists';
            }
            else {   
                $dob = strtotime($dob);
                $query = "INSERT INTO " .
                    "users (username,".
                    "password,".
                    "sec_ques,".
                    "sec_ans,".
                    "profile_pic,".
                    "email,".
                    "mobile,".
                    "first_name,".
                    "last_name,".
                    "dob,".
                    "address,".
                    "city,".
                    "interests," .
                    "about) " .
                    "VALUES" .
                    "(:username,:password,:sec_ques,".
                    ":sec_ans,:profile_pic,:email,:mobile,".
                    ":first_name,:last_name,FROM_UNIXTIME(:dob),:address,:city,:interests,:about)";
                //echo $query;
                $stmt = $conn->prepare($query);
                $stmt->bindParam(':username', $username, PDO::PARAM_STR);
                $stmt->bindParam(':password', $hash, PDO::PARAM_STR);
                $stmt->bindParam(':sec_ques', $secques, PDO::PARAM_STR);
                $stmt->bindParam(':sec_ans', $secans, PDO::PARAM_STR);
                $stmt->bindParam(':profile_pic', $profile_pic, PDO::PARAM_STR);
                $stmt->bindParam(':email', $email, PDO::PARAM_STR);
                $stmt->bindParam(':mobile', $mob, PDO::PARAM_STR);
                $stmt->bindParam(':first_name', $fn, PDO::PARAM_STR);
                $stmt->bindParam(':last_name', $ln, PDO::PARAM_STR);
                $stmt->bindParam(':dob', $dob, PDO::PARAM_STR);
                $stmt->bindParam(':address', $addr, PDO::PARAM_STR);
                $stmt->bindParam(':city', $city, PDO::PARAM_STR);
                $stmt->bindParam(':interests', $inter, PDO::PARAM_STR);
                $stmt->bindParam(':about', $about, PDO::PARAM_STR);
                move_uploaded_file($_FILES['file']['tmp_name'],$target_path); //move the uploaded file to the user_image folder
                $stmt->execute();
                
                $user_id = $conn->lastInsertId();
                $query = "INSERT INTO friends (friend_one,friend_two,status) VALUES (:user_id1,:user_id2,:status)";
                $stmt = $conn->prepare($query);
                $status = '2';
                $stmt->bindParam(':user_id1', $user_id, PDO::PARAM_STR);
                $stmt->bindParam(':user_id2', $user_id, PDO::PARAM_STR);
                $stmt->bindParam(':status', $status, PDO::PARAM_STR);
                $stmt->execute();
                
                echo 'success';
            }
        }
        else {
            echo 'Please check your input again 1';
        }

        
    } else {
        echo 'Please check your input again 2';
    }

} else {
    echo 'Please check your input again 3';
}