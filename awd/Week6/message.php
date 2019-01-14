<?php
        //TODO: Add database connection settings
        require_once('dbconnection.php');

       //query our Employees table to return all of them. 
        mysqli_select_db($conn, $dbname); 
        $query_Message = "SELECT * FROM Message_Board";
        $Message = mysqli_query($conn, $query_Message) or die(mysqli_error());
        $row_Message = mysqli_fetch_assoc($Message);
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Message</title>
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
	</head>

<body><div class="container-fluid">
	<table class="table">
	<?php do { ?>
	<tr><p>
<strong><?php echo $row_Message['First_Name']; ?>
	<?php echo $row_Message['Last_Name']; ?></strong></p
	<p>
	<?php echo $row_Message['Message']; ?></p></td>
  	</tr><hr/>
<?php } while ($row_Message = mysqli_fetch_assoc($Message)); ?>
</table>
<?php
mysqli_free_result($Message);
?>
</div>

</body>
</html>