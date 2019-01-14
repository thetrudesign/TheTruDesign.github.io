<?php
require_once('dbconnection.php');
$category_id = $_POST['category_id'];
$debugging = $_POST['debugging'];

if ($debugging == "true"){
       sleep(3);
}
mysqli_select_db($conn, $dbname);
$query_Products = "SELECT Product_ID, Product_Name FROM Products WHERE Category_ID = ". $category_id . " ORDER BY Product_Name";
$Products = mysqli_query($conn, $query_Products) or die(mysqli_error());
$results = array(); 
$int = 0; 

while($r = mysqli_fetch_assoc($Products)) {

       $results["products"][$int] = $r;
       $int +=1;
}

$results["count"] = count($results["products"]);
$results["result"] = "true"; 
echo json_encode($results);
mysqli_free_result($Products);
?>