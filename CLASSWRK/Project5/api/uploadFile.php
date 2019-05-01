<?php 
// http://php.net/manual/en/features.file-upload.multiple.php

include 'dbConnection.php';
$conn = getDatabaseConnection();

$file_ary = reArrayFiles($_FILES['fileName']);
foreach ($file_ary as $file) {
    if ($file["error"] > 0) {
        echo "Error: " . $file["error"] . "<br>";
    }
    else {
        echo "Upload: " . $file["name"] . "<br>";
        echo "Type: " . $file["type"] . "<br>";
        echo "Size: " . ($file["size"] / 1024) . " KB<br>";
        echo "Stored in: " . $file["tmp_name"] . "<br><br>";
        $np = array();
        // $image_data=file_get_contents($file["tmp_name"]);
        $imgData = addslashes(file_get_contents($file["tmp_name"]));
        $np['name'] = $file["name"];
        $np['src'] = $imgData; 
        
        $sql = "INSERT INTO image_uploads (image_name, image_src) VALUES (:name, :src);";
        $stmt = $conn->prepare($sql);
        $stmt->execute($np);
    }  
    
       
}
    

function reArrayFiles(&$file_post) {
    $file_ary = array();
    $file_count = count($file_post['name']);
    $file_keys = array_keys($file_post);

    for ($i=0; $i<$file_count; $i++) {
        foreach ($file_keys as $key) {
            $file_ary[$i][$key] = $file_post[$key][$i];
        }
    }

    return $file_ary;
}
?>

