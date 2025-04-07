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

        $user = $this->loginModel->getUser($username);
        if($user && password_verify($password, $user['password'])) {
            session_start();
            $_SESSION['user_id'] = $user['id'];
            header("location: ../user_dashboard.php");
            exit();
        } else {
            return "invalid credentials";
        }
    }
}
?>