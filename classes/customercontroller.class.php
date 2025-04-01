<?php
class CustomerController extends Customer { // pulls data from the customer class

    public function createCustomer($username, $password, $people){ // add parameters to allow the types of data to manipulate
        $this->setCustomer($username, $password, $people); // push the data to the customer class
    }
}
?>