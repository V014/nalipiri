<?php
class Dbh {
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "nalipiri_eco_resort_db";

    /*
    Check if the database exists
    */
    protected function isSetUp()
    {
        $dbh = new PDO("mysql:host=" . $this->host, $this->username, $this->password);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = $dbh->query("SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '" . DATABASE . "'");

        if (!$query->fetch()) {
            return false;
        }

        return true;
    }

    protected function initDB() {
        try {
            $dbh = new PDO("mysql:host=" . $this->host, $this->username, $this->password);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $dbQuery = $dbh->query("SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '" . DATABASE . "'");
            // Create the nalipiri_eco_resort database if it does not exist
            if (!$dbQuery->fetch()) {
                $dbh->beginTransaction();
                $dbh->query("CREATE DATABASE IF NOT EXISTS " . DATABASE);
                $dbh->query("USE " . DATABASE);
                // Read contents of nalipiri_eco_resort.sql
                $sql = file_get_contents(__DIR__ . "/../db/nalipiri_eco_resort.sql") or die("Failed to open nalipiri_eco_resort.sql file");
                // Execute nalipiri_eco_resort.sql content
                $dbh->exec($sql);
            }
    
            // Create admin entry
            $connection = getConnection();
            $username = "admin";
            $password = password_hash("secret1234", PASSWORD_DEFAULT);
    
            $sql = "INSERT INTO admin (username, password) VALUES (:username, :password)";
            $sth = $connection->prepare($sql);
            $sth->execute([
                ":username" => $username,
                ":password" => $password
            ]);
        } catch (PDOException $exc) {
            die("Database connection failed: " . $exc->getMessage());
        }
    }
        /*
    Create PDO instance and retrieve it in subsequent calls without reinitilization
    */
    function getConnection()
    {
        static $dbh = null;

        try {
            if (!isSetUp()) {
                initDB();
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