<html>
        <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="style.css" rel="stylesheet" type="text/css" />
        <link href='https://fonts.googleapis.com/css?family=ZCOOL KuaiLe' rel='stylesheet'>

        <title>Pixabay Lab</title>
    </head>
    <body>
            <div class='menu'>
                <br>
                <h1><center>Lab 8</center></h1>
                <br>
                <a href="liked.html"><span style="text-align:center">Liked</span></a>
                <input type="text" id="search">
                <button type='button' id='searchButton'>Search</button>
            </div>

          <div>
            <!--<center>-->
                <table id = 'table'>
                </table>
            <!--</center>-->
          </div>

        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script type="text/javascript">
            var search;
             $(document).ready(function(){
                 
                $("#searchButton").on("click", function(){
                    if( $("#search").val() === ""){
                        return;
                    }
                    search = $("#search").val();
                    console.log(search)
                    $.ajax({
                        type: "GET",
                        url: "search.php",
                        dataType: "json",
                        data: {
                             "search" : search,
                        },
                        success: function(data, status){
                            if (data['hits'].length == 0) { // Checks if the API returned a non-empty list
                            $("#table").html(""); //clears content
                            }
                            $("#table").html("");
                            console.log(data)
                            var id;
                            var imageId;
                            for (var i = 0; i < data.hits.length; i++) {
                                id = "button" + i;
                                imageId = "image" + i;
                                $("#table").append("<tr> <td> <img src= '" + data.hits[i]["largeImageURL"] +  "' class= 'center' id=" + imageId + "> </td> <td> <input  type='image' src='images/favorite.png' id=" + id +  " class= 'favorite' value='" + i + "' onclick= 'likeUnlike(value)'> </td> </tr>");
                                
                            }
                            
                        } 
                    });
                });
             }); 
             
             //function
            function likeUnlike(x)
                {

                    var id = "#button" + x;
                    var pic = "#image" + x;
                    // console.log($(id).attr('value'));
                    if( $(id).attr("src") === "images/favorite.png")
                    {
                
                        $(id).attr("src", "images/favorite-on.png");
                        $.ajax({
                        type: "POST",
                        url: "send.php",
                        dataType: "json",
                        data: {
                             "search" : search,
                             "image" : $(pic).attr('src'),
                        },
                        success: function(status){
                            console.log("success");
                        }
                    });
                        
                    }
                    else
                    {
        
                        $(id).attr("src", "images/favorite.png");
                        $.ajax({
                        type: "POST",
                        url: "remove.php",
                        dataType: "json",
                        data: {
                             "image" : $(pic).attr('src'),
                        },
                        success: function(data, status){
                            console.log("success");
                        }
                    });
                    }
                }
        </script>
    </body>
    
    
    
    
</html>