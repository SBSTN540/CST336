<html>
        <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="style.css" rel="stylesheet" type="text/css" />
        <link href='https://fonts.googleapis.com/css?family=ZCOOL KuaiLe' rel='stylesheet'>

        <title>Pixabay Lab</title>
    </head>
    <body>
        <div>
            <!--<br>-->
            <!--<a href="home.html"><span style="text-align:center">Matches</span></a>-->
            <!--<a href="history.html"><span style="text-align:center">History</span></a>-->
        </div>
        <div id = "mainBox">
          <div id = "img">
          </div>
          <!--<div id = "userInfo">-->
          <!--    <div id = "usrnm">-->
          <!--    </div>-->
          <!--    <dive id = "about">-->
          <!--    </dive>-->
          <!--</div>-->
        </div>
        <!--<div id = "userInput">-->
        <!--    <button id = "like" onclick = "newMatch()">Like</buttton>-->
        <!--    <button id = "meh" onclick = "newMatch()">Meh</button>-->
        <!--    <button id = "dislike" onclick = "newMatch()">Dislike</button>-->
        <!--</div>-->
        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script type="text/javascript">
            var count = 0;
             $(document).ready(function(){
                    $.ajax({
                        type: "GET",
                        url: "qwerty.php",
                        dataType: "json",
                        success: function(data, status){
                            if (data['hits'].length == 0) { // Checks if the API returned a non-empty list
                            $("#img").html(""); //clears content
                            }
                            console.log(data)
                            for (var i = 0; i < data.hits.length; i++) {
                                $("#img").append("<img src= '" + data.hits[i]["largeImageURL"] +  "' class= 'center'>");
                                $("#img").append("<button  ")
                                
                            }
                            // data['hits'].forEach(function(key) {
                            //     $("#img").append("<img src= '" + ["largeImageURL"] +  "'  /> <br />");
                            // });
                            
                        } 
                    });
             });
             
             function 
        </script>
    </body>
    
    
    
    
</html>