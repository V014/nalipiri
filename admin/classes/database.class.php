<?php
class Dbh {
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "nalipiri_eco_resort_db";

    protected function connect() {
        try {
            $dsn = 'mysqli:host=' . $this->host . ';database=' . $this->database;
            $pdo = new PDO($dsn, $this->username, $this->password); // Creating a new PDO instance
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC); // Setting PDO Fetch method
            return $pdo;
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage(); // Display error message if the connection fails
        }
    }
}
?>