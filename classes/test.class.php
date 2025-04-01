<?php

class Test extends Dbh{

    public function getCustomer(){
        $sql = "SELECT * FROM customer";
        $stmt = $this->connect()->query($sql);
        while($row = $stmt->fetch()) {
            echo $row['username'] . '<br>';
        }
    }

    public function getCustomerStmt($user_id){
        $sql = "SELECT * FROM customer WHERE id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$user_id]);
        $names = $stmt->fetch(); // FetchAll grabs all the data instead of one row

        foreach ($names as $name) {
            echo $name['username'] . '<br>';
        }
    }

    public function setCustomerStmt($username, $password, $people){
        $sql = "INSERT INTO customer(username, password, people) VALUES (?, ?, ?)";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$username, $password, $people]);
    }

}
?>