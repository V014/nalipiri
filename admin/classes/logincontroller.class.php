<?php
class LoginController extends Login {

    private $username;
    private $password;

    public function __construct($username, $password) { // create constructor that holds expected values from customer
        $this->username = $username;
        $this->password = $password;
    }
    
    public function loginUser() {
        if($this->emptyInput() == false) { // send customer back to login page if data is missing
            header("location: ../login.php?error=emptyinput");
            exit();
        }

        $this->getAdmin($this->username, $this->password); // push data to the login model
    }

    private function emptyInput() { //  check to see if data is missing
        $result = null;
        if(empty($this->username )|| empty($this->password)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }
}
?>