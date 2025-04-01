<?php
class CustomerView extends Customer {

    public function showCustomer($user_id) { // set to public to display to user
        $results = $this->getCustomer($user_id); // collect data from the customer class
        return $results[0]['username']; // return the data to the user
    }
}
?>