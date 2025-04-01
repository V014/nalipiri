<?php
class LoginController extends Login {

    private $user_id;
    private $password;

    public function __construct($user_id, $password) {
        $this->user_id = $user_id;
        $this->password = $password;
    }
    
    public function loginUser() {
        if($this->emptyInput() == false) {
            header("location: ../login.php?error=emptyinput");
            exit();
        }

        $this->getCustomer($this->user_id, $this->password);
    }

    private function emptyInput() {
        $result = 0;
        if(empty($this->user_id )|| empty($this->password)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }
}
?>