<?php
			$age = $_POST['age'];
            $month = $_POST['month']; 
            $message = $age - 20;
			$agelimit = $age - 20;
            $json = '{
                        "result":"true",
						"message":"' . $agelimit.  '"
                        }';
            echo $json;


?>