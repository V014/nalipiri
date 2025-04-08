<?php
class LoginController extends Login {

    private $loginModel;

    public function __construct() { // create constructor that holds expected values from customer
        $this->loginModel = new Login();
    }
    
    public function loginUser($username, $password) {
        if(empty($username) || empty($password)) {
            return "Username and password are required";
        }
        
        $user = $this->loginModel->getUser($username, $password); // push values to login model
        if($user && password_verify($password, $user['password'])) { // verify data
            if($user['role'] == 'admin') {
                header("location: ../admin/admin_dashboard.php");
            } else if ($user['role'] == 'customer') {
                header("location: ../customer_dashboard.php");
            } else {
                return "Invalid role";
            }
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $username;
            exit();
        } else {
            return "invalid credentials";
        }
    }
}
?>