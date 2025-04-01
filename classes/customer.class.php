<?php
class Customer extends Dbh {

    protected function getCustomer($user_id){ // protect all user data
        $sql = "SELECT * FROM customer WHERE id = ?"; // create a query with a temporary query condition
        $stmt = $this->connect()->prepare($sql); // prepare the statement to run sql before adding user data to prevent breach
        $stmt->execute([$user_id]); // execute the statement

        $results = $stmt->fetch(); // FetchAll grabs all the data instead of one row
        return $results; // return the results to pass on to the view
    }
}