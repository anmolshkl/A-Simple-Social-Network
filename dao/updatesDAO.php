<?php
require_once("connection.php");
session_start();
$user_id = $_SESSION['user_id'];
$conObj = new Connection();
$conn = $conObj->getConnection();

if(isset($_POST['newStatus']) && $_POST['newStatus'] != '' ) {
    
    $update = $_POST['newStatus'];
    $user_id = $_SESSION['user_id'];
    $timeStamp = time();
    
    $query = "INSERT INTO `updates` (`update`, `user_id`, `created`) VALUES (:update, :user_id, :time)";
    
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':update', $update, PDO::PARAM_STR);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_STR);
    $stmt->bindParam(':time', $timeStamp, PDO::PARAM_STR);
    $stmt->execute();
    
    //new Status has been inserted,now refresh the page
    header("Location:../updates.php");

}

$query = "SELECT U.username, U.email, D.update_id, D.update, D.created FROM users U, updates D, friends F ".
    "WHERE D.user_id = U.user_id ".
    "AND CASE WHEN F.friend_one = :user_id1 THEN F.friend_two = D.user_id "."
    WHEN F.friend_two= :user_id2 "."
    THEN F.friend_one= D.user_id END AND F.status > '0' ORDER BY D.update_id DESC";
    
$stmt = $conn->prepare($query);
$stmt->bindParam(':user_id1', $user_id, PDO::PARAM_STR);
$stmt->bindParam(':user_id2', $user_id, PDO::PARAM_STR);
$stmt->execute();

if ($rows = $stmt->fetchAll(PDO::FETCH_ASSOC) ) {
    echo json_encode($rows);
}

$stmt = null;
$conn = null;
?>
