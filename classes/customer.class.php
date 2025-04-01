<?php
class Customer extends Dbh { // gives access to the database through the Dbh class defined in the database file

    protected function getCustomer($user_id){ // protect all user data, using session id to find the user in the db
        $sql = "SELECT * FROM customer WHERE id = ?"; // create a query with a temporary query condition
        $stmt = $this->connect()->prepare($sql); // prepare the statement to run sql before adding user data to prevent breach
        $stmt->execute([$user_id]); // execute the statement

        $results = $stmt->fetch(); // FetchAll grabs all the data instead of one row
        return $results; // return the results to pass on to the view
    }

    protected function setCustomer($username, $password, $people){ // specify the type of data you want to manipulate
        $sql = "INSERT INTO customer(username, password, people) VALUES (?, ?, ?)";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$username, $password, $people]);
    }
}