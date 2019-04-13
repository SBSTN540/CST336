<?php
    include '../dbConnection.php';
    
    $conn = getDatabaseConnection();
    
    $sql = "SELECT * FROM user ORDER BY id";
    
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode($records);
?>