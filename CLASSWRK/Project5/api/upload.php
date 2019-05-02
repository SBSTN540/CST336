<?php
    include '../dbConnection.php';
    $conn = getDatabaseConnection();
    $sql = '';
    
    if(isset($_POST['submit'])){
        $file = $_FILES['file'];

        $fileName = $file['name'];
        $fileTmpName = $file['tmp_name'];
        $fileSize = $file['size'];
        $fileError = $file['error'];
        $fileType = $file['type'];
        
        
        $fileExt = explode('.', $fileName);
        $realExt = strtolower(end($fileExt));
        
        $allowed = array('jpg', 'jpeg', 'png');
        
        if(in_array($realExt, $allowed)){
            if($fileError === 0){
                if($fileSize < 1000000){
                    
                    
                    $img = addslashes(file_get_contents($fileTmpName));
                    $caption = $_POST['caption'];
                    $email = $_POST['email'];
                    
                    $sql = "INSERT INTO image_upload (email, caption, media) VALUES('$email', '$caption', '$img')";
                    
                    $stmt = $conn->prepare($sql);
                    $stmt->execute();
                    header("Location: ../home.php?uploadsuccess");
                }
                else{
                    header("Location: ../home.php?uploadFAIL");
                }
            }
            else{
                header("Location: ../home.php?uploadFAIL");
            }       
        }
        else{
            header("Location: ../home.php?uploadFAIL");
        }
        
    }
?>