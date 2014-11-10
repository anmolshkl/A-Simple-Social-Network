<?php
require_once("config.php");

//The object of the class type "Connection" can be used to a get a new connection

//a config object has to be supplied to it, in order to specify the details of the connection

class Connection {
    
    public function getConnection() {
        
        //create a new Config object;
        $config = new Config();
        /*** hostname ***/
        $hostname = $config->host;

        /*** username ***/
        $username = $config->user;

        /*** password ***/
        $password = $config->pass;
        
        /** database **/
        $db = $config->db;

        try {
            $dbh = new PDO("mysql:host=$hostname;dbname=$db", $username, $password); //Using MySQL DB for now,
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $dbh->setAttribute( PDO::ATTR_EMULATE_PREPARES, false );

        }
        catch(PDOException $e) {
            echo $e->getMessage();
        }
        return $dbh;
    }
}
?>