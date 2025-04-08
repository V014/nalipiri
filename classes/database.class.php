<?php
class Dbh {
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "nalipiri_eco_resort_db";

    // Check if the database exists
    protected function isSetUp()
    {
        $dbh = new PDO("mysql:host=" . $this->host, $this->username, $this->password);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = $dbh->query("SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '" . $this->database . "'");

        if (!$query->fetch()) {
            return false;
        }

        return true;
    }

    // Initialize database tables
    protected function initDB() {
        try {
            $dbh = new PDO("mysql:host=" . $this->host, $this->username, $this->password);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $dbQuery = $dbh->query("SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '" . $this->database . "'");
            // Create the nalipiri_eco_resort_db database if it does not exist
            if (!$dbQuery->fetch()) {
                $dbh->beginTransaction();
                $dbh->query("CREATE DATABASE IF NOT EXISTS " . $this->database);
                $dbh->query("USE " . $this->database);
                // Read contents of nalipiri_eco_resort_db.sql
                $sql = file_get_contents(__DIR__ . "/../db/nalipiri_eco_resort_db.sql") or die("Failed to open nalipiri_eco_resort_db.sql file");
                // Execute nalipiri_eco_resort_db.sql content
                $dbh->exec($sql);
            }
    
            // Create admin entry
            $connection = $this->getConnection();
            $username = "admin";
            $password = password_hash("secret1234", PASSWORD_DEFAULT);
            $role = "administrative";
    
            $sql = "INSERT INTO user (username, password, role) VALUES (:username, :password, :role)";
            $sth = $connection->prepare($sql);
            $sth->execute([
                ":username" => $username,
                ":password" => $password,
                ":role" => $role
            ]);
        } catch (PDOException $exc) {
            die("Database connection failed: " . $exc->getMessage());
        }
    }
    
    // Create PDO instance and retrieve it in subsequent calls without reinitialization
    protected function getConnection()
    {
        static $dbh = null;

        try {
            if (!$this->isSetUp()) {
                $this->initDB();
            }

            if ($dbh === null) {
                $dbh = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->database, $this->username, $this->password);
                $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            }

            return $dbh;
        } catch (PDOException $exc) {
            die("Database connection failed " . $exc->getMessage());
        }
    }
}
?>