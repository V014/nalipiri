<?php
class Dbh {
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "nalipiri_eco_resort_db";

    protected function connect() {
        try {
            // Creating a new PDO instance
            $conn = new PDO("mysql:host=$this->host;dbname=$this->database;charset=utf8", $this->username, $this->password);
            
            // Setting the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            // echo "Connected successfully!";
        } catch (PDOException $e) {
            // Display error message if the connection fails
            echo "Connection failed: " . $e->getMessage();
        }
    }
}
?>