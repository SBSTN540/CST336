<?php
include 'dbConnection.php';

$conn = getDatabaseConnection();

$sql = "SELECT * FROM image_uploads";
$stmt = $conn->prepare($sql);
$stmt->execute();
$records = $stmt->fetchAll(PDO::FETCH_ASSOC);
// for ($i = 0; $i < sizeof($records) ; $i++) {
//     $records[i]["image_src"] = base64_encode($records[i]["image_src"]);
// }   
// echo($record[0]["image_name"]);
echo json_encode($records);
?>