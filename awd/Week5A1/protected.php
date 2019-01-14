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
<link href="style.css" rel="stylesheet" type="text/css" media="screen" />

</head>
<body>
<div class="container">
	<div class="row">
		<div class="col-2"></div>
		<div class="col-8 mt-5">
         <h1>Your Account</h1>
<p>Your account information is listed below. </p>
			<hr/>

<p><strong>First Name:</strong> <?php echo $row['First_Name']; ?> </p>
<p><strong>Last Name:</strong> <?php echo $row['Last_Name']; ?> </p>
<p><strong>Email:</strong> <?php echo $row['Email']; ?> </p>
<p><strong>Username:</strong> <?php echo $row['Username']; ?> </p>
</div><div class="col-2"></div>
</div></div>
</body>
</html>
<?php  
         mysqli_free_result($r); //close connection
?>