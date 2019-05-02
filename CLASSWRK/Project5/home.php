<!DOCTYPE html>
<html>
<head>
<title>AJAX POST File Upload</title>    
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="css/styles.css" rel="stylesheet" type="text/css" />

</head>
<body>
    

<div id="myModal" class="modal">

 
  <div class="modal-content">
    <!--<span class="close">&times;</span>-->
    <center>
    <p>Please Login With Email or Continue as Guest</p>
    Email: <input type = "text" id = "modalEmail">
    <button id = "go">Go</button>
    <button id = "guest">Guest</button>
    </center>
  </div>
</div>

<div id = "portal">
<div style="text-align:center">
    
    <br>
    <form id = "myOnlyForm" action = "api/upload.php" method = "POST" enctype = "multipart/form-data">
        <h2>AJAX POST File Upload<div id = "email" name = "email"></div></h2>
        <input type = "file" name ="file">
        Caption: <input type = "text" name ="caption">
        <button name = "submit">UPLOAD</button>
    </form>
    <br>
</div>
</div>

<div id="stream">
<div id="outer_wrapper">
    <div id="inner_wrapper">
        <!--height:150px;-->
        <?php
        $db = mysqli_connect("us-cdbr-iron-east-03.cleardb.net","bb48ad32ca15de","112ccc55","heroku_107660fec7f6777"); //keep your db name
        $sql = "SELECT * from image_upload";
        $sth = $db->query($sql);
        while($result=mysqli_fetch_array($sth)){
            echo '
                <div class="box">
                    <img style="width:300px;"src="data:image/jpeg;base64,'.base64_encode( $result['media'] ).'" onclick="myFunction(this);"/>
                </div>
            ';    
        }
    ?>
    </div>
</div>
</div>

    
<div class="container">
    <span onclick="this.parentElement.style.display='none'" class="closebtn">&times;</span>
    <img id="expandedImg" style="width:100%">
</div>

<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script type="text/javascript">

var modal = document.getElementById('myModal');
var span = document.getElementsByClassName("close")[0];
modal.style.display = "block";

$("#go").on("click",function() {
    var sEmail = $('#modalEmail').val();
    function validateEmail(sEmail) {
        var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
        if (filter.test(sEmail)) {
            return true;
        }
        else{
            return false;
        }
}
    
    if ($.trim(sEmail).length == 0) {
        alert('Please enter valid email address');
    }
    else if (!validateEmail(sEmail)) {
        alert('Invalid Email Address');
        e.preventDefault();
    }
    else if(validateEmail(sEmail)){
        modal.style.display = "none";
        $("#email").html(sEmail);
        e.preventDefault();
    }
    
});
$("#guest").on("click",function() {
    var form = document.getElementById("myOnlyForm");
    var elements = form.elements;
    for (var i = 0, len = elements.length; i < len; ++i) {
        elements[i].disabled = true;
    }
    
    modal.style.display = "none";
});

function myFunction(imgs,email,caption) {
  var expandImg = document.getElementById("expandedImg");
  var imgText = document.getElementById("imgtext");
  expandImg.src = imgs.src;
  expandImg.parentElement.style.display = "block";
  console.log(email);
  console.log(caption);
  
}
</script>

</body>
</html>
