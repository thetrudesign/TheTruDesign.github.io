<?php
require_once('dbconnection.php');
$username = $_GET['username'];

mysqli_select_db($conn, $dbname); 
$q = "SELECT Username FROM User WHERE Username= '" . $username . "'";
$r = mysqli_query($conn, $q) or die(mysqli_error());
$totalRows = mysqli_num_rows($r);

if( $totalRows > 0 ) 
{
//username already exists in database, return false. 
echo "false"; 
} else {
echo "true";
}

mysqli_free_result($r); //close connection
?>
