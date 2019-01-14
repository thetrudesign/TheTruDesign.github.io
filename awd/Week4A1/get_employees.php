<?php
//sleep(1);
require_once('dbconnection.php');
$searchterm = trim($_POST['searchterm']);

mysqli_select_db($conn, $dbname); 
$query_Employees = "SELECT Employee_Name FROM Employees WHERE Employee_Name LIKE '%" . $searchterm . "%'";
$Employees = mysqli_query($conn, $query_Employees) or die(mysqli_error($conn));
$results = array(); //array to hold the database results. 
$int = 0; //used to keep track which number record is being returned

while($r = mysqli_fetch_assoc($Employees)) {
       //for every row returned, add to the array. 
       //we actually create an array within an array. 
       $results["employees"][$int] = $r;
       $int +=1;
       }

$results["count"] = count($results["employees"]); //get number of employees returned
$results["result"] = "true"; //set the result equal to true for error checking on the HTML page. 
echo json_encode($results); //encode the array as a JSON object. 
mysqli_free_result($Employees); //close connection
?>
