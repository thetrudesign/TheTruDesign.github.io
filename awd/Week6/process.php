<?php
       sleep(1);
       require_once('dbconnection.php');
       $debugging = $_POST['debugging'];
       $function = $_POST['function'];
       $results = array(); 
       
       if ($debugging == "true"){ 
              //debugging has been enabled, sleep for 3 seconds
              sleep(3);
       }
       
       switch($function)
       {
              case "register": 
                     register($conn); //call the register function
                     break;
              case "login": 
                     login($conn); //call the register function
                     break;
              default: 
       }
       
       //register the user
       function register($conn) {
              $first_name = $_POST['first_name'];
              $last_name = $_POST['last_name'];
              $email = $_POST['email'];
              $username = $_POST['username'];
              $password = $_POST['password'];
              
              //mysqli_select_db($conn, $dbname); 
              $q = "INSERT INTO User (Username, Password, First_Name, Last_Name, Email) VALUES (?, ?, ?, ?, ?)";
              $stmt= mysqli_prepare($conn, $q);
              mysqli_stmt_bind_param($stmt, 'sssss', $username, SHA1($password), $first_name, $last_name, $email);
              mysqli_stmt_execute($stmt);
              
              if(mysqli_stmt_affected_rows($stmt) == 1) {
                     //set the result equal to true for error checking on the HTML page.
                     $results["result"] = "true"; 
              } else {
                     //error 
                     $results["result"] = "false";
              }
              
              mysqli_stmt_close($stmt);
              
              //send confirmation email. 
              $body = "Thank you for registering. Your username and password are below for your reference:\n\n";
              $body .= "Username: " . $username . "\n";
              $body .= "Password: " . $password . "\n";
              mail($email, 'Registration Confirmation', $body, 'From: Tru.dinh@outlook.com');
              
              //output JSON response
              echo json_encode($results); //encode the array as a JSON object. 
        
       } //end register
       
       //login the user
       //login the user
function login($conn) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        //mysqli_select_db($conn, $dbname); 
        $q = "SELECT * FROM User WHERE Username='" . $username . "' AND Password = '" . SHA1($password) . "'";
        $r = mysqli_query($conn, $q) or die(mysqli_error());
        $totalRows = mysqli_num_rows($r);

        //set session variable. 
        session_start();

        if( $totalRows == 1 ) {
                //set the result equal to true for error checking on the HTML page.
                $results["login"] = "true"; 
                $row = mysqli_fetch_array($r, MYSQLI_ASSOC);

                //set session variables
                $_SESSION['user_id'] = $row['User_ID'];
                $_SESSION['loggedIn'] = true;
        } else {

                $_SESSION = array(); //clear the variables
                session_destroy(); //destroy session

                //error 
                $results["login"] = "false";
        } 

        mysqli_free_result($r); //close connection

        //output JSON response
        echo json_encode($results); 
} //end login
?>