<?php
    session_start();

    if (!isset($_SESSION['username'])){
      header("Location: loginDashboard.php");
    }
?>


<!DOCTYPE html>
<html>
    <head>
        <title>Dashboard</title>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link href="css/font-awesome.min.css" rel="stylesheet">
        <link href="css/simple-line-icons.css" rel="stylesheet">
        <link rel="stylesheet" href="styles.css" type="text/css" />
        <link href='https://fonts.googleapis.com/css?family=ZCOOL KuaiLe' rel='stylesheet'>
        <!--<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body>
        <header>
            Scheduler
            <button type="button" id="logout" onclick="loginModal">Logout</button>
        </header>
        
        <div id="body">
            <button type="button" id="createButton">Create New Timeslots</button>
            <table id="table">
                <tr>
                    <td>Date</td><td>Start Time</td><td>Duration</td><td>Booked By</td>
                </tr>
            </table>
        </div>
        <div id="myModal" class="modal">
              <!-- Modal content -->
              <div class="modal-content">
                <span class="close">&times;</span>
                <form>
                  <fieldset>
                    <legend>Add Time Slots</legend>
                    Date MM/DD/YYYY:<br>
                    <input type="text" id="date"><br>
                    Start Time:<br>
                    <input type="text" id="start"><br>
                    Duration:<br>
                    <input type="text" id="duration"><br>
                    <input type="button" value="Add" id="add">
                    <input type="button" value="Cancel" id="cancel">
                  </fieldset>
                </form>
              </div>
        </div>
        <div id="deleteModal" class="modal">
              <!-- Modal content -->
              <div class="modal-content">
                <span class="close">&times;</span>
                <div id="deleteInfo">
                    hello
                </div>
                <input type="button" value="Delete" id="deleteSlot" style="width:175px;">
                <input type="button" value="Cancel" id="cancel1" style="width:175px;">
              </div>
        </div>
         <audio controls autoplay>
             <source src="Hope Song.wav" type="audio/wav"> 
        </audio>
       
        <div id="end">
            
        </div>
     
    
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
         <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script>
            var idHolder;
            
            $("#logout").on("click", function() {
                window.location = "logout.php";
            });
            
            $("#cancel").on("click", function(){
                 modal.style.display = "none";
                 document.location.reload();
            });
            
            $("#cancel1").on("click", function(){
                 deleteModal.style.display = "none";
            });
            
            $("#deleteSlot").on("click", function() {
                $.ajax({
                    type: "GET",
                    url: "API/deleteSlot.php",
                    data:{
                        "id" : idHolder,
                    },
                    success: function(status){
                        console.log("Success");
                        // alert("Timeslot Deleted");
                        document.location.reload();
                        
                    }
                });
            });
            
            $("#add").on("click", function(){
                var x = $("#date").val();
                var date = new Date(x);
                if (isNaN(date.getTime())) {  
                    alert("Not a valid date");
                    return;
                }
                console.log($("#start").val())
                $.ajax({
                    type: "POST",
                    url: "API/addSlot.php",
                    data:{
                        "date": $("#date").val(),
                        "start": $("#start").val(),
                        "duration": $("#duration").val()
                    },
                    success: function(status){
                        $("#date").val("");
                        $("#start").val("");
                        $("#duration").val("");
                        // alert("Time Slot created\nPress Cancel to Exit");
                        
                    }
                });
                 
            });
            
            $(document).ready(function(){
                    $.ajax({
                        type: "GET",
                        url: "API/schedule.php",
                        dataType: "json",
                        success: function(data, status){
                            if (data.length == 0) { // Checks if the API returned a non-empty list
                                $("#table").html("");//clears content
                            }
                            var today = new Date();
                            for (var i = 0; i < data.length; i++) {
                                var date = new Date(data[i]['date']);
                                console.log(date);
                                if(date > today){
                                    $("#table").append("<tr> <td> " + data[i]['date'] + "</td> <td> " +  data[i]['start_time'] + " </td><td> " + data[i]['duration'] + "</td> <td>" + data[i]['booked_by'] + "</td> <td><button type='button' onClick='deleteFunct(" + data[i]['id'] + ")'>Delete</button></td></tr>");
                                }
                            }
                        } 
                    });
            }); 
            
            
            var modal = document.getElementById('myModal');
            var deleteModal = document.getElementById('deleteModal');

            var btn = document.getElementById("createButton");
            
            var close1 =  span = document.getElementsByClassName("close")[0];
            var close2 = span = document.getElementsByClassName("close")[1];
            
            btn.onclick = function()  {
                modal.style.display = "block";
            };

            close1.onclick = function() {
                 modal.style.display = "none";
            };
            close2.onclick = function() {
                 deleteModal.style.display = "none";
                  document.location.reload();
            };
            
            function deleteFunct(x){
            //   console.log(x);      
              deleteModal.style.display = "block";
              idHolder = x;
              $.ajax({
                type: "GET",
                url: "API/deleteInfo.php",
                dataType: "json",
                data:{
                    "id": x,  
                },
                success: function(data, status){
                    console.log(data);
                    console.log(data['date']);
                    $("#deleteInfo").html("Delete Time Slot: " + data[0]['date'] + " - " + data[0]['start_time'] + " - " + data[0]['duration'] + " Booked By: " + data[0]['booked_by'] + "<br>Once deleted This cannot be undone");
                } 
                  
              });
            }
            
        </script>
    </body>
    
    
    
    
    
</html>


<?php
?>