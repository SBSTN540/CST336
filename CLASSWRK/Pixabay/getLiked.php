<?php
include 'dbConnection.php';
$conn = getDatabaseConnection();


$search = $_POST['search'];



$sql = "SELECT image_src
        FROM pix_lab 
        WHERE search= '$search';";

$stmt = $conn->prepare($sql);
$stmt->execute();
$records = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($records);
?>