<?php
class LoginController extends Login {

    private $username;
    private $password;

    public function __construct($user_id, $password) { // create constructor that holds expected values from customer
        $this->username = $user_id;
        $this->password = $password;
    }
    
    public function loginUser() {
        if($this->emptyInput() == false) { // send customer back to login page if data is missing
            header("location: ../login.php?error=empty_input");
            exit();
        }

        $this->getCustomer($this->username, $this->password); // push data to the login model
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