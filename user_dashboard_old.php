<?php
session_start(); // start session to access save data
require 'php/database.php'; // connect to db to get data

// check if the user logged in properly
if (!isset($_SESSION['logged'])) {
    echo "<script>alert('You are not authorized')</script>";
    header("Location: index.php");
    exit;
}

// get customer_id
$id = $_SESSION['customer_id'];


if (isset($_SESSION['customer_id']) && !empty($_SESSION['customer_id'])) {
    // Get billing data from the database
    $stmt = $conn->prepare("SELECT * FROM billing WHERE customer_id = :customer_id");
    $stmt->bindParam(':customer_id', $id);
    $stmt->execute();
    
    if ($stmt->rowCount() > 0) {
        $billing = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } else {
        echo "<script>alert('No data yet');</script>";
    }

} else {
    echo "<script>alert('User ID is not set');</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Dashboard</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="dashboard-container">
        <h1>Welcome, <?php echo $_SESSION['username']; ?>!</h1>
        <h2>Your Usage</h2>
        <!-- new table -->
        <table>
          <thead>
              <tr>
                  <th>Customer ID</th>
                  <th>Water Usage (Liters)</th>
                  <th>Electricity Usage (kWh)</th>
                  <th>Water Bill</th>
                  <th>Electricity Bill</th>
                  <th>Total Amount</th>
                  <th>Date</th>
              </tr>
          </thead>
          <tbody>
              <?php foreach ($billing as $bill) { ?>
                  <tr>
                      <td><?php echo $bill['id']; ?></td>
                      <td><?php echo $bill['water_usage']; ?></td>
                      <td><?php echo $bill['kWh_usage']; ?></td>
                      <td><?php echo $bill['water_usage'] * 100; ?></td>
                      <td><?php echo $bill['kWh_usage'] * 150; ?></td>
                      <td><?php echo $bill['water_usage'] * 100 + $bill['kWh_usage'] * 150; ?></td>
                      <td><?php echo $bill['date']; ?></td>
                  </tr>
              <?php } ?>
          </tbody>
      </table>
        <a href="php/logout.php">Logout</a>
    </div>
    <script src="js/script.js"></script>
</body>
</html>