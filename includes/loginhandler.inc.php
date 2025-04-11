<?php
include 'autoLoader.inc.php';
// handler file collects and sanitizes user data before passing it on to the controller
class LoginHandler {

    public function handler() {
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = $_POST['username'] ?? null; // Use null coalescing to avoid undefined index
            $password = $_POST['password'] ?? null;

            if (empty($username) || empty($password)) {
                echo "Username and password are required.";
                return;
            }
        
            $loginController = new LoginController();
            $error = $loginController->loginUser($username,$password);

            if($error) {
                echo $error; // Display error message if login fails
                return;
            } 
            // Redirect only if login is successful
            header("Location: ../dashboard.php"); // Redirect to dashboard
            exit();
        }
        else {
            echo "Invalid request method.";
            return;
        }
    }
}
?>