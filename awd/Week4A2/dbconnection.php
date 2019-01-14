<?php
error_reporting(0);

$dbhost = 'localhost'; 
$dbuser = 'thetrud7_WPVYZ';
$dbpass = 'T123r12u1';
$dbname = 'thetrud7_AWD';

$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

if (!$conn) {
       $json = '{
                     "result":"false",
                     "message":"Database error: ' . mysqli_connect_errno() . ': ' . mysqli_connect_error() . '"
                     }';
       echo $json;
}

?>