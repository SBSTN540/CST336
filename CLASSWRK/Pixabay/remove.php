<?php
include 'dbConnection.php';
$conn = getDatabaseConnection();

$image = $_POST['image'];

$sql = "DELETE FROM pix_lab
    WHERE image_src = '$image'";

$stmt = $conn->prepare($sql);
$stmt->execute();

echo("Success");
?>