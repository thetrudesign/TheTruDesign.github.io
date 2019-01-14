<?php
        //TODO: Add database connection settings
        require_once('dbconnection.php');

       //query our Employees table to return all of them. 
        mysqli_select_db($conn, $dbname); 
        $query_Employees = "SELECT * FROM Employees";
        $Employees = mysqli_query($conn, $query_Employees) or die(mysqli_error());
        $row_Employee = mysqli_fetch_assoc($Employees);
?>

<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Tru Dinh Week3 A2</title>
<!--Jquery 3.2.1 --->
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!--Jquery 3.2.1 --->	
<!--bootstrap 4.0-->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>	
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<!--bootstrap 4.0-->	
<script type="text/javascript">
$(document).ready(function() {

      var $results = $('#results');
      var $loading = $('#loading');
      $loading.hide(); //hide loading graphic

      //global ajaxError that will run when any Ajax request returns an error
       $(document).ajaxError(function(e, jqxhr, settings, errorThrown) {
            $results.html('Error occurred. The error returned was <em>'  + errorThrown + '</em>');
       });

      //for showing and hiding the loading graphic during all Ajax requests
       $(document).ajaxStart(function() {
           $loading.show();
       });

       $(document).ajaxComplete(function() {
           $loading.hide();
       });

//when the employees drop down list changes
$('#employees').change(function() {

         //the employee that was selected.               
         var $employeeID = $(this).val(); 

         if(! $employeeID) {
                 //user did not select an employee
                 //they selected the Please choose option
                 $results.html('Please choose an employee.');
         } else {
                 //ajax call to load employees details. 
                 $.ajax({
                        type: 'POST', 
                        url: "get_employee.php", 
                        dataType: 'text',
                        data: { 
                               'Employee_ID' : $employeeID}, 
                        success: function(data) {
                               $results.html(data);
                        }
                 }); //end ajax
         }
}); //end employees change
}); //end document.ready
</script>

</head>

<body>
<div class="container ">
	<div class="row">
		<div class="col-sm-3"></div>
	<div class="col-sm-6 mt-5">

<h1 class="">EMPLOYEE DETAILS</h1>
		<hr/>
<p>Select a name from the list below to see more details about that employee.</p>

<select id="employees" name="employees">
<option value="">Please choose</option>
  <?php 
    //TODO: Add list of employees
        do { 
     echo "<option value='{$row_Employee['Employee_ID']}'> {$row_Employee['Employee_Name']} </option>";
      } while ($row_Employee = mysqli_fetch_assoc($Employees)); 
?>
</select>

<span id="loading"><i class="fa fa-circle-o-notch fa-spin" style="font-size:24px"> </i>         Loading...please wait.
</span>

<div class="mt-3" id="results">
</div>
<div class="col-sm-3"></div>
	</div></div>
	</div>
</body>
</html>
<?php
         //TODO: Close database connection
         mysqli_free_result($Employees);
?>