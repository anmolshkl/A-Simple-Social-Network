<?php
include('connection.php');

class User {
    //ideally we should use getter and setter methods
    public $username='';
    public $password='';
    public $confPassword='';
    public $fn='';
    public $ln='';
    public $email='';
    public $dob='';
    public $addr='';
    public $city='';
    public $mob='';
    public $secques='';
    public $secans='';
    public $inter='';
    public $about='';
    public $profile_pic='';

    public function initiateQuery() {
      /*having some error with class Config & Connection for now,making direct connection instead
        $conObj = new Connection();
        $conn = $conObj->getConnection();
        */
         try {
            $conn = new PDO("mysql:host=localhost;dbname=tsn", "root", ''); //Using MySQL DB for now,
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conn->setAttribute( PDO::ATTR_EMULATE_PREPARES, false );

        }
        catch(PDOException $e) {
            echo $e->getMessage();
        }
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

        $query = "SELECT * FROM users WHERE username= :user";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':user', $GLOBALS['userToRetrieve'], PDO::PARAM_STR);
        $stmt->execute();
        $rows=$stmt->fetch(PDO::FETCH_ASSOC);
        $this->username=$rows['username'];
        $this->fn=$rows['first_name'];
        $this->ln=$rows['last_name'];
        $this->email=$rows['email'];
        $this->dob=$rows['dob'];
        $this->addr=$rows['address'];
        $this->city=$rows['city'];
        $this->mob=$rows['mobile'];
        $this->secques=$rows['sec_ques'];
        $this->secans=$rows['sec_ans'];
        $this->inter=$rows['interests'];
        $this->about=$rows['about'];
        $this->profile_pic=$rows['profile_pic'];
    }
}
?>
