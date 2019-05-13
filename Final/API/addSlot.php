<?php


$dbname = 'heroku_107660fec7f6777';
$host = 'us-cdbr-iron-east-03.cleardb.net';
$username = 'bb48ad32ca15de';
$password = '112ccc55'; 
      
  
// Get Data from DB
$conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 

$np = array( "date" => $_POST["date"], "start" => $_POST["start"], "duration" => $_POST["duration"], "booked" => "Not Booked" );

$sql = "INSERT INTO time_slot (date, start_time,duration, booked_by) values (:date, :start, :duration, :booked)";
$stmt = $conn->prepare($sql);
$stmt->execute($np);

?>