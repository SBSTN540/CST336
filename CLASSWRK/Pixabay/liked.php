<?php
include 'dbConnection.php';
$conn = getDatabaseConnection();


$sql = "SELECT DISTINCT search
FROM pix_lab;";

$stmt = $conn->prepare($sql);
$stmt->execute();
$records = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($records);
?>