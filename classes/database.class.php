<?php
class Dbh {
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "nalipiri_eco_resort_db";

    protected function connect() {
        try {
            $dsn = 'mysql:host=' . $this->host . ';database=' . $this->database;
            // Creating a new PDO instance
            $pdo = new PDO($dsn, $this->username, $this->password);
            // Setting PDO Fetch method
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            return $pdo;
        } catch (PDOException $e) {
            // Display error message if the connection fails
            echo "Connection failed: " . $e->getMessage();
        }
    }
}
?>