<?php
require("connect.php");
$config = new Config("localhost","root",'',"tsn");
$connClass = new Connection();
$conn = $connClass->getConnection($config);

?>
