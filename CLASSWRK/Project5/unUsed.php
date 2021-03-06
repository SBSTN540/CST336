<?php

?>

<!DOCTYPE html>
<html>
<head>
    <title>AJAX POST File Upload</title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional bootstrap theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <link href="css/style.css" rel="stylesheet" type="text/css" />
    
    <script src="//cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.6/ScrollMagic.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.6/plugins/debug.addIndicators.min.js"></script>
</head>

<body>
    <div id = "portal">
        <div class="container">
            <div class="col-md-3">
                <form>
                    <div style="display:none;">
                        <input type="file" multiple name="fileName[]" />
                    </div>
                    <div>
                        <button id="selectButton" type="button" class="btn btn-primary btn-xs">Pick File(s)</button>
                    </div>
                    <div id="filesList">
                    </div>
                    <div>
                        <button id="uploadButton" type="button" class="btn btn-primary btn-xs">Upload File(s)</button>
                    </div>
                </form>
                <div class="progress">
                    <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
                        0%
                    </div>
                </div>
                <div id="results">
                    
            </div>
        </div>
    </div> 
    </div>
    <div id="stream">
    <table>
        <?php
            $db = mysqli_connect("us-cdbr-iron-east-03.cleardb.net","bb48ad32ca15de","112ccc55","heroku_107660fec7f6777");
            $sql = "SELECT * from image_uploads";
            $sth = $db->query($sql);
            while($result=mysqli_fetch_array($sth)){
                //echo base64_encode($result['image_src']);
                // <td>" . $result['timestamp'] . "</td>
                // echo '<tr> <td> <img style="width:300px; src = "data:image/jpg;base64,' . base64_encode($result['image_src']) . '"> </td> <td>' . $result['timestamp'] . '</td> <tr>';
                // echo '<img style="width:300px; height:150px;"src="data:image/jpeg;base64,'.base64_encode( $result['image_src'] ).'"/>';
                
                echo '<img style="width:400px; height:250px;"src="data:image/jpeg;base64,'.base64_encode( $result['image_src'] ).'"/>';
            }
        ?>
        
        
      
    </table>    
    </div>
        

        <!-- jQuery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

        <script type="text/javascript">
            // 1. Get rid of file input button
            //$("form button:nth-of-type(1)").click(function() {
            $("#selectButton").click(function() {
                console.log("clicked")
                $("form input[type='file']").trigger("click");
            })

            // 2. Use ajax to submit files
            $("form input[type='file']").change(function(e) {
                $('#filesList').empty();
                $.map(this.files, function(val) {
                    $('#filesList')
                        .append($('<div>')
                            .html(val.name)
                        );
                });
            })

            // 3. Send files with ajax
            $('#uploadButton').click(function(e) {
                setProgress(0);
                var formData = new FormData($('form')[0]);
                $.ajax({
                        url: "api/uploadFile.php",
                        type: "POST",
                        data: formData,
                        processData: false,
                        contentType: false,
                        mimeType: "multipart/form-data",
                        cache: false,
                        // This part gives up chunk progress of the file upload
                        xhr: function() {
                            //upload Progress
                            var xhr = $.ajaxSettings.xhr();
                            if (xhr.upload) {
                                xhr.upload.addEventListener('progress', function(event) {
                                    var percent = 0;
                                    var position = event.loaded || event.position;
                                    var total = event.total;
                                    if (event.lengthComputable) {
                                        percent = Math.ceil(position / total * 100);
                                    }
                                    //update progressbar
                                    setProgress(percent);
                                }, true);
                            }
                            return xhr;
                        }
                    })
                    .done(function(data, status, xhr) {
                        console.log('upload done');
                        //window.location.href = "<?php echo BASE_PATH?>/assets/<?php echo $controller->group ?>";
                        console.log(xhr);
                        $("#results").html(xhr.responseText);
                        // getPhotoStream();
                    })
                    .fail(function(xhr) {
                        console.log('upload failed');
                        console.log(xhr);
                        
                    })
                    .always(function() {
                        //console.log('done processing upload');
                    });
            });

            function setProgress(percent) {
                $(".progress-bar").css("width", +percent + "%");
                $(".progress-bar").text(percent + "%");
            }
            
        //     function getPhotoStream() {
        //         console.log("getPhotoStream");
        //          $.ajax({
        //                 type: "GET",
        //                 url: "api/photoStream.php",
        //                 dataType: "json",
        //                 success: function(data, status){
        //                     if (data.length == 0) { // Checks if the API returned a non-empty list
        //                         console.log("empty");//clears content
        //                     }
        //                     for (var i = 0; i < data.length; i++){
        //                         console.log(data);
								// $("#media").append("<div id='media'>  <img src = data:image/jpg;base64," + base64_encode(data[i]['image_src']) + "> <br> '" + data[i]['timestamp'] + "' </div>");
							
        //                     }
        //                 }
        //             });
        //     }
                
            
        </script>
</body>

</html>
