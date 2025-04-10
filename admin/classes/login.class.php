<?php

class Login extends Dbh {
    protected function getAdmin($username, $password) { // create function that requires two parameters to query
        $stmt = $this->connect()->prepare('SELECT id FROM admin WHERE username = ? AND password = ?'); // prepare the sql statement

        if(!$stmt->execute(array($username, $password))) { // execute the statement and if the process fails
            $stmt = null; // empty the query statement to not have residual data
            header('locationL ../index.php?error=stmtfailed'); // navigate back to login page
            exit(); // close the if statement
        }

        if($stmt->rowCount() == 0){ // if the user is not found in the database
            $stmt = null; // empty the query statement to not have residual data
            header('location: ../index.php?error=usernotfound'); // navigate back to login page
            exit(); // close the if statement
        }

        $passwordHashed = $stmt->fetchAll(PDO::FETCH_ASSOC); // fetch the data in the query
        $checkPassword = password_verify($password, $passwordHashed[0]['password']); // hash the password in the query and compare it to the database password
        
        if($checkPassword == false){ // if the passwords are different
            $stmt = null; // empty the query statement to not have residual data
            header('location: ../index.php?error=wrongpassword'); // navigate back to login page
            exit(); // close the if statement
        } 
        
        elseif($checkPassword == true) { // if the passwords are similar 
            $stmt = $this->connect()->prepare('SELECT id FROM customer WHERE username = ? AND password = ?'); // prepare the sql statement

            if(!$stmt->execute(array($username, $password))) { // execute the statement and if the process fails
                $stmt = null; // empty the query statement to not have residual data
                header('locationL ../login.php?error=stmtfailed'); // navigate back to login page
                exit(); // close the if statement
            }

            if($stmt->rowCount() == 0) {
                $stmt = null;
                header("location: ../index.php?error=usernotfound");
                exit();
            }

            $user = $stmt->fetchAll(PDO::FETCH_ASSOC);

            session_start();
            $_SESSION['user_id'] = $user[0]['id'];
            $_SESSION['username'] = $user[0]['username'];
        }
        $stmt = null;
    }
}

?>