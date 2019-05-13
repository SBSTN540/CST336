<?php
  session_start();

  $httpMethod = strtoupper($_SERVER['REQUEST_METHOD']);

  switch($httpMethod) {
    case "OPTIONS":
      // Allows anyone to hit your API, not just this c9 domain
      header("Access-Control-Allow-Headers: X-ACCESS_TOKEN, Access-Control-Allow-Origin, Authorization, Origin, X-Requested-With, Content-Type, Content-Range, Content-Disposition, Content-Description");
      header("Access-Control-Allow-Methods: POST, GET");
      header("Access-Control-Max-Age: 3600");
      exit();
    case "GET":
      // TODO: Access-Control-Allow-Origin
      http_response_code(401);
      echo "Not Supported";
      break;
    case 'POST':
      
      $dbname = 'heroku_107660fec7f6777';
      $host = 'us-cdbr-iron-east-03.cleardb.net';
      $username = 'bb48ad32ca15de';
      $password = '112ccc55'; 
      
  
      // Get Data from DB
      $dbConn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
      $dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 

      $sql = "SELECT * FROM users " .
             "WHERE username = :username ";
      
      $stmt = $dbConn->prepare($sql);
      $stmt->execute(array (":username" => $_POST['username']));
      
      $record = $stmt->fetch();
      
      $isAuthenticated = password_verify($_POST["password"], $record["password"]);
      
      $toReturn = array("isAuthenticated" => $isAuthenticated);
      
      if ($isAuthenticated) {
        $_SESSION["username"] = $record["username"];
      }
      
      // // Allow any client to access
      header("Access-Control-Allow-Origin: *");
      // Let the client know the format of the data being returned
      header("Content-Type: application/json");

      // Sending back down as JSON
      echo json_encode($toReturn);

      break;
    case 'PUT':
      // TODO: Access-Control-Allow-Origin
      http_response_code(401);
      echo "Not Supported";
      break;
    case 'DELETE':
      // TODO: Access-Control-Allow-Origin
      http_response_code(401);
      break;
  }
?>