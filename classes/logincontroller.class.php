<?php
session_start(); // start session to hold values
require_once 'login.class.php'; // include login class

class LoginController { // create class for login controller
    // create properties for login controller

    private $loginModel;

    public function __construct() { // create constructor that holds expected values from customer
        $this->loginModel = new Login();
    }
    
    public function loginUser($username, $password) {
        if(empty($username) || empty($password)) { // check if username and password are empty
            $_SESSION['error'] = "Username and password are required"; // set session for error message
            header("location: ../login.php"); // send to login page
        }
        
        $user = $this->loginModel->getUser($username, $password); // push values to login model
        if(!$user) {
            $_SESSION['error'] = "Incorrect Username/Password"; // set session for error message
            header("location: ../login.php"); // send to login page
        }
        // Check if the password matches the hashed password in the database
        if($user && password_verify($password, $user['password'])) {
            if($user['role'] == 'admin') {
                header("location: ../admin/admin_dashboard.php"); // send to admin dashboard
            } 
            
            else if ($user['role'] == 'customer') {
                header("location: ../customer_dashboard.php"); // send to customer dashboard
            } 
            
            else {
                return "Invalid role";
                header("location: ../index.php"); // send to homepage
            }

            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $username;
            unset($_SESSION['error']); // Clear any previous errors
            exit();

        } else {
            return "invalid credentials";
            header("location: ../login.php"); // send to login page
        }
    }
}
?>