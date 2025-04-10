<?php
include '../includes/utils.inc.php'; // include utils file for extra function
class LoginController extends Login {

    private $loginModel;

    public function __construct() { // create constructor that holds expected values from customer
        $this->loginModel = new Login();
    }
    
    public function loginUser($username, $password) {
        if(empty($username) || empty($password)) {
            return "Username and password are required";
            setcookie("errors", "Username and password are required"); // set cookie for error message
            header("location: ../login.php"); // send to login page
        }
        
        $user = $this->loginModel->getUser($username, $password); // push values to login model
        if(!$user) {
            return "User not found";
            setcookie("errors", "Incorrect Username/Password"); // set cookie for error message
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

            session_start();
            
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $username;
            exit();

        } else {
            return "invalid credentials";
            header("location: ../login.php"); // send to login page
        }
    }
}
?>