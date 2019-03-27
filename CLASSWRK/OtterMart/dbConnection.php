<?php

//bb48ad32ca15de:112ccc55@us-cdbr-iron-east-03.cleardb.net/heroku_107660fec7f6777?reconnect=true
function getDataBaseConnection($dbname = 'heroku_107660fec7f6777'){

    $host = 'us-cdbr-iron-east-03.cleardb.net';
    $username = 'bb48ad32ca15de';
    $password = '112ccc55'; 
    
    if(strpos($_SERVER['HTTP_HOST'],'herokuapp')!==false){
            $url = parse_url(getenv("CLEARDB_DATABASE_URL"));
            $host = $url["host"];
            $dbname = substr($url["path"], 1);
            $username = $url["user"];
            $password = $url["pass"];
        } 
    
    $dbConn = new PDO("mysql:host=$host;dbname=$dbname;",$username,$password);
    $dbConn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $dbConn;
}


?>