<?php
//sleep(1);
require_once('dbconnection.php');
$employeeID = $_POST['Employee_ID'];

mysqli_select_db($conn, $dbname); 
$query_Employees = "SELECT * FROM Employees WHERE Employee_ID = $employeeID";
$Employees = mysqli_query($conn, $query_Employees) or die(mysqli_error());
$row_Employee = mysqli_fetch_assoc($Employees);

//create div that will contain details about the employee
echo "<div class='details alert alert-primary alert-primary'>";
echo "<h3 class='text-uppercase text-secondary'>{$row_Employee['Employee_Name']}</h3>";
echo "<div><label class='text-uppercase font-weight-bold'>Department:</label> {$row_Employee['Employee_Department']}</div>";
echo "<div><label class='text-uppercase font-weight-bold'>Email:</label> {$row_Employee['Employee_Email']}</div>";
echo "<div><label class='text-uppercase font-weight-bold'>Phone:</label> {$row_Employee['Employee_Phone']}</div>";   
echo "</div>"; 

mysqli_free_result($Employees);
?>