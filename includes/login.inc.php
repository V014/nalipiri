<?php
session_start();
include '../classes/database.class.php';

class Login extends Dbh {

    protected function getCustomer($username, $password){
        $sql = "SELECT * FROM customer WHERE username = ? AND password = ?"; // create a query with a temporary query condition
        $stmt = $this->connect()->prepare($sql); // prepare the statement to run sql before adding user data to prevent breach
        $stmt->execute([$username, $password]); // execute the statement
    }
}

// Handle login form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $id;

    $stmt = $conn->prepare("SELECT * FROM customer WHERE username = :username AND password = :password");
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password);
    $stmt->execute();

    // Fetch the result
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $customer_id = $result['id']; // Fetch the user_id from the query result

    if ($stmt->rowCount() > 0) {
        $_SESSION['logged'] = true;
        $_SESSION['username'] = $username;
        $_SESSION['customer_id'] = $customer_id;
        header("Location: ../user_dashboard.php"); // Redirect to dashboard page
    } else {
        echo "<script>alert('Invalid login credentials');</script>";
    }
} else {
    echo "you failed to hack us";
}
?>