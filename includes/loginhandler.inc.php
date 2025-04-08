<?php
// handler file collects and sanitizes user data before passing it on to the controller
class LoginHandler extends LoginController {

    public function handler() {
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = $_POST['username'];
            $password = $_POST['password'];
        
            $loginController = new LoginController();
            $error = $loginController->loginUser($username,$password);
        }
        
        if($error) {
            echo $error;
        }
    }
}
?>