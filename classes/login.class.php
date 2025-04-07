<?php

class Login extends Dbh { 
    private $db;

    protected function __construct()
    {
        $this->db = new Dbh();
    }

    public function getUser($username) {
        $stmt = $this->db->getConnection()->prepare("SELECT * FROM user WHERE username = :username");
        $stmt->bindParam(":username", $username, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

        // $stmt = $this->getConnection()->prepare('SELECT id FROM customer WHERE username = ? AND password = ?'); // prepare the sql statement

        // if(!$stmt->execute(array($username, $password))) { // execute the statement and if the process fails
        //     $stmt = null; // empty the query statement to not have residual data
        //     header('locationL ../login.php?error=stmt_failed'); // navigate back to login page
        //     exit(); // close the if statement
        // }

        // if($stmt->rowCount() == 0){ // if the user is not found in the database
        //     $stmt = null; // empty the query statement to not have residual data
        //     header('location: ../index.php?error=user_notfound'); // navigate back to login page
        //     exit(); // close the if statement
        // }

        // $passwordHashed = $stmt->fetchAll(PDO::FETCH_ASSOC); // fetch the data in the query
        // $checkPassword = password_verify($password, $passwordHashed[0]['password']); // hash the password in the query and compare it to the database password
        
        // if($checkPassword == false){ // if the passwords are different
        //     $stmt = null; // empty the query statement to not have residual data
        //     header('location: ../index.php?error=wrong_password'); // navigate back to login page
        //     exit(); // close the if statement
        // } 
        
        // elseif($checkPassword == true) { // if the passwords are similar 
        //     $stmt = $this->getConnection()->prepare('SELECT id FROM customer WHERE username = ? AND password = ?'); // prepare the sql statement

        //     if(!$stmt->execute(array($username, $password))) { // execute the statement and if the process fails
        //         $stmt = null; // empty the query statement to not have residual data
        //         header('locationL ../login.php?error=stmt_failed'); // navigate back to login page
        //         exit(); // close the if statement
        //     }

        //     if($stmt->rowCount() == 0) {
        //         $stmt = null;
        //         header("location: ../index.php?error=user_notfound");
        //         exit();
        //     }

        //     $user = $stmt->fetchAll(PDO::FETCH_ASSOC);

        //     session_start();
        //     $_SESSION['user_id'] = $user[0]['id'];
        //     $_SESSION['username'] = $user[0]['username'];
        // }
        // $stmt = null;

?>