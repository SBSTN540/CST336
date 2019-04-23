<?php
include 'dbConnection.php';
$conn = getDatabaseConnection();

$np = array();
$np[':search'] = $_POST['search'];
$np[':image'] = $_POST['image'];

$sql = "INSERT INTO pix_lab (search, image_src) VALUES (:search, :image);";

$stmt = $conn->prepare($sql);
$stmt->execute($np);

echo($np[':image']);
?>