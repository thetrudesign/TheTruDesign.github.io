<?php
sleep(1);
$dbhost = 'localhost'; 
$dbuser = 'thetrud7_WPVYZ';
$dbpass = 'T123r12u1';
$dbname = 'thetrud7_AWD';
$result = 'true'; 

$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

//if connection fails output a json response indicating the error. 
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

              $first_name = $_POST['first_name'];
              $last_name = $_POST['last_name'];
              $message = $_POST['message'];
              $sql = "INSERT INTO Message_Board (First_Name, Last_Name, Message) VALUES ('$first_name', '$last_name', '$message')";
              
              if ($conn->query($sql) === TRUE) {
                 $result = "true"; 
              } else {
                     //error 
              $result = "false";
              }
    echo json_encode($result); //encode the array as a JSON object. 
$conn->close();


?>
