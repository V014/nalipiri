<?php
include 'db.php';

$customer_id = $_GET['customer_id'];

$sql = "SELECT * FROM usage_data WHERE customer_id='$customer_id'";
$result = $conn->query($sql);

$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode($data);

$conn->close();
?>