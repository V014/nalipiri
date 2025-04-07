<?php
include '../classes/database.class.php';

if(!isset($_POST['submit'])) {
    // Grab the data from the form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Instantiate the Login class
    $login = new LoginController($username, $password);

    // Call the loginUser method to check credentials
    $login->loginUser();

    // Check if the user is logged in
    if(isset($_SESSION['admin_id'])) {
        // Redirect to the dashboard
        header("Location: ../admin_dashboard.php");
        exit();
    } else {
        // Redirect back to the login page with an error message
        header("Location: ../index.php?error=invalidcredentials");
        exit();
    }
}

// class Login extends Dbh {

//     protected function getCustomer($username, $password){
//         $sql = "SELECT * FROM admin WHERE username = ? AND password = ?"; // create a query with a temporary query condition
//         $stmt = $this->connect()->prepare($sql); // prepare the statement to run sql before adding user data to prevent breach
//         $stmt->execute([$username, $password]); // execute the statement
//     }
// }

// Handle login form submission
// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     $username = $_POST['username'];
//     $password = $_POST['password'];
//     $id;

//     $stmt = $conn->prepare("SELECT * FROM admin WHERE username = :username AND password = :password");
//     $stmt->bindParam(':username', $username);
//     $stmt->bindParam(':password', $password);
//     $stmt->execute();

//     // Fetch the result
//     $result = $stmt->fetch(PDO::FETCH_ASSOC);
//     $admin_id = $result['id']; // Fetch the user_id from the query result

//     if ($stmt->rowCount() > 0) {
//         $_SESSION['logged'] = true;
//         $_SESSION['username'] = $username;
//         $_SESSION['admin_id'] = $admin_id;
//         header("Location: ../admin_dashboard.php"); // Redirect to dashboard page
//     } else {
//         header("Location: ../index.php"); // Redirect to dashboard page
//         echo "<script>alert('Invalid login credentials');</script>"; // tell the user what happened
//     }
// } else {
//     header("Location: ../index.php"); // Redirect to dashboard page
//     echo "<script>alert('Illegal entry');</script>"; // tell the user what happened
// }
?>