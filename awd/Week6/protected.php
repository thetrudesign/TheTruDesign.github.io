<?php
session_start();

if(!isset($_SESSION['user_id'])) {
         //not logged in, send back to login page
         header('Location: index.html');
} else {
         //user is logged in...grab their details
         require_once('dbconnection.php');

         mysqli_select_db($conn, $dbname); 
         $q = "SELECT * FROM User WHERE User_ID=" . $_SESSION['user_id'];
	$First_Name = "SELECT First_Name FROM User";
	$Last_Name = "SELECT Last_Name From User";
         $r = mysqli_query($conn, $q) or die(mysqli_error());
         $totalRows = mysqli_num_rows($r);

         if( $totalRows == 1 ) 
         {
                  //user found
                  $row = mysqli_fetch_array($r, MYSQLI_ASSOC);
         } else {
                  //user not found
         }
}
?>
    <!DOCTYPE HTML>
    <html>

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Your Account</title>
        <!--Jquery 3.2.1 --->
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <!--Jquery 3.2.1 --->
        <!--bootstrap 4.0-->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <!--bootstrap 4.0-->
        <!--Jquery validate -->
        <script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js">


        </script>
        <!--Jquery validate -->


        <script type="text/javascript" src="jquery.blockUI.js"></script>


        <link href="style.css" rel="stylesheet" type="text/css" media="screen" />
        <script type="text/javascript">
            $(document).ready(function() {
                $('#btnSubmit').click(function() {
                    $.ajax({
                        type: "POST",
                        url: "processMessage.php",
                        dataType: 'json',
                        data: {
                            "first_name": $('#first_name').val(),
                            "last_name": $('#last_name').val(),
                            "message": $('#message').val()
                        },
                        beforeSend: function() {
                            //start blocking of page
                            $.blockUI({
                                message: '<h4><i class="fa fa-circle-o-notch fa-spin" style="font-size:24px"></i>   Processing request, please wait...</h4>',
                                css: {
                                    border: 'none',
                                    padding: '15px',
                                    backgroundColor: '#212529',
                                    borderRadius: '5px',
                                    '-webkit-border-radius': '3px',
                                    '-moz-border-radius': '3px',
                                    opacity: .5,
                                    color: '#ffffff'
                                }, //end css
                                overlayCSS: {
                                    backgroundColor: '#cce5ff',
                                    opacity: 0.9
                                } //end overlayCSS
                            }); //end blockUI
                        },
                        complete: function() {
                            $.unblockUI();

                        }, //end complete
                        success: function() {
                            if (data.result == 'true') {
                                $('#result').fadeIn();
                                window.location.reload(true);
                            } else {
                                $("#result.html")('Sorry, an error occurred with your request: ' + data.message);

                            }
                        } //end success()
                    }); //end ajax
                }); //end click function

            }); //end document ready

        </script>
    </head>

    <body>
        <div class="container">
            <div class="row">
                <div class="col-8 mt-5">
                    <h1>Your Account</h1>
                    <p>Your account information is listed below. </p>

                    <hr/>
                    <p><strong>First Name:</strong>
                        <?php echo $row['First_Name']; ?> </p>
                    <p><strong>Last Name:</strong>
                        <?php echo $row['Last_Name']; ?> </p>
                    <p><strong>Email:</strong>
                        <?php echo $row['Email']; ?> </p>
                    <p><strong>Username:</strong>
                        <?php echo $row['Username']; ?> </p>
                    <hr/>
                    <form action="" method="post" name="messagePost" id="messagePost">
                        <p>
                            <input type="hidden" name="first_name" id="first_name" value="<?php echo $row['First_Name']; ?>" class="form-control" />
                            <input type="hidden" name="last_name" id="last_name" class="form-control" value="<?php echo $row['Last_Name']; ?>" />
                            <label for="message" class="col-form-label">Message: (250 character max)</label>
                            <input type="text" maxlength="250" name="message" id="message" class="required form-control" /> <br/>
                            <input type="submit" name="btnSubmit" id="btnSubmit" value="Post" class="btn" />
                    </form>
                    <div id="result" class="alert alert-success">
                        <strong>Your message is posted</strong>
                    </div>
                </div>
                <div id="messageContainer" class="col-4 mt-5 alert alert-primary">
                    <h2>Message Board</h2>
                    <hr/>
                    <?php include('message.php')?>
                </div>
            </div>
        </div>

    </body>

    </html>
    <?php  
         mysqli_free_result($r); //close connection
?>
