<?php
class CustomerView extends Customer {

    public function showCustomer($user_id) { // set to public to display to user
        $results = $this->getCustomer($user_id); // collect data from the customer class
        return $results[0]['username']; // return the data to the user
    }

    public function createCustomer($username, $password, $people){ // add parameters to allow the types of data to manipulate
        $this->setCustomer($username, $password, $people); // push the data to the customer class
    }

}
?>