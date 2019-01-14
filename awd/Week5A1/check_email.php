<?php
require_once('dbconnection.php');
$email = $_GET['email'];

mysqli_select_db($conn, $dbname); 
$q = "SELECT Email FROM User WHERE Email= '" . $email . "'";
$r = mysqli_query($conn, $q) or die(mysqli_error());
$totalRows = mysqli_num_rows($r);

if( $totalRows > 0 ) 
{
//email already exists in database, return false. 
echo "false"; 
} else {
echo "true";
}

mysqli_free_result($r); //close connection
?>