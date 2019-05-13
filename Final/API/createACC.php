<?php

// //connect to database
// include 'dbConnection.php';
// $conn = getDatabaseConnection();
$dbname = 'heroku_107660fec7f6777';
$host = 'us-cdbr-iron-east-03.cleardb.net';
$username = 'bb48ad32ca15de';
$password = '112ccc55'; 
      
  
// Get Data from DB
$conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 

$sql = 'SELECT * 
        FROM users 
        WHERE username = :uId';

$np = array();
$np['uId'] = $_GET['username'];

$stmt = $conn->prepare($sql);
$stmt->execute($np);
$records = $stmt->fetchAll(PDO::FETCH_ASSOC);

if(count($records) < 1)
{
    $np['uPass'] = password_hash($_GET['password'], PASSWORD_BCRYPT);
    $sql = "INSERT INTO users (username, password) values (:uId, :uPass)"; 
    $stmt = $conn->prepare($sql);
    $stmt->execute($np);
    $var = array("acc" => 1);
    echo json_encode($var);
}
else{
    $var = array("acc" => 0);
    echo json_encode($var);
}
?>