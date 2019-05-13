<?php

$dbname = 'heroku_107660fec7f6777';
$host = 'us-cdbr-iron-east-03.cleardb.net';
$username = 'bb48ad32ca15de';
$password = '112ccc55'; 
      
  
// Get Data from DB
$conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 

$sql = "SELECT * 
FROM time_slot ORDER BY date ASC;";


$stmt = $conn->prepare($sql);
$stmt->execute();
$records = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($records);


?>