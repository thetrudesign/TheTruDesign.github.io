<?php
$dbhost = 'localhost'; 
$dbuser = 'thetrud7_WPVYZ';
$dbpass = 'T123r12u1';
$dbname = 'thetrud7_AWD';

$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

//if not connected, echo error, otherwise echo connected message.
if (!$conn) {
die('Connect Error (' . mysqli_connect_errno() . ') ' . mysqli_connect_error());
}
?>