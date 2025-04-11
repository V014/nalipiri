<?php
session_start(); // start session to hold values
require_once 'login.class.php'; // include login class

class LoginController { 
    // create properties for login controller
    private $loginModel;

    public function __construct() { // create constructor that holds expected values from customer
        $this->loginModel = new Login();
    }
    
    public function loginUser($username, $password) {
        if (empty($username) || empty($password)) { // Check if username and password are empty
            $_SESSION['error'] = "Username and password are required"; // Set session for error message
            header("location: ../login.php");
            exit(); // Stop further execution
        }
    
        $user = $this->loginModel->getUser($username, $password); // Fetch user from the database
        if (!$user) {
            $_SESSION['error'] = "Incorrect Username/Password"; // Set session for error message
            header("location: ../login.php");
            exit(); // Stop further execution
        }
    
        // Check if the password matches the hashed password in the database
        if (!password_verify($password, $user['password'])) {
            $_SESSION['error'] = "Incorrect Username/Password"; // Set session for error message
            header("location: ../login.php");
            exit(); // Stop further execution
        }
    
        // Handle user roles
        if ($user['role'] == 'admin') {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $username;
            unset($_SESSION['error']); // Clear any previous errors
            header("location: ../admin/admin_dashboard.php");
            exit();
        } elseif ($user['role'] == 'customer') {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $username;
            unset($_SESSION['error']); // Clear any previous errors
            header("location: ../customer_dashboard.php");
            exit();
        } else {
            $_SESSION['error'] = "Invalid role"; // Set session for error message
            header("location: ../login.php");
            exit();
        }
    }
}
?>