<?php
include 'db.php';

$sql = "SELECT customers.room_number, usage_data.water_usage, usage_data.electricity_usage, usage_data.date 
        FROM usage_data 
        JOIN customers ON usage_data.customer_id = customers.id";
$result = $conn->query($sql);

$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode($data);

$conn->close();
?>