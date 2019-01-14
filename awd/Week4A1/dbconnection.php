<?php
//show no errors for production code
error_reporting(0);

//show all errrors for development
//error_reporting(E_ALL);

$dbhost = 'localhost'; 
$dbuser = 'thetrud7_WPVYZ';
$dbpass = 'T123r12u1';
$dbname = 'thetrud7_AWD';

$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

//if connection fails output a json response indicating the error. 
if (!$conn) {
       $json = '{
                     "result":"false",
                     "message":"Database error: ' . mysqli_connect_errno() . ': ' . mysqli_connect_error() . '"
                     }';
       echo $json;
}

?>
<?php

