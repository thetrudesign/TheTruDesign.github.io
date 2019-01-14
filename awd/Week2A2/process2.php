<?php
			$age = $_POST['age'];
			$reqAge = 20;
			if ($age <= $reqAge) {
				$ageLimit = "You are not old enought to drink alcohol";
				
			}
			else {
				$ageLimit = "Have fun drinking!!";
			}
            $month = $_POST['month']; 
            $message = "You are <em>$age</em> Years old and are born in the month of <em>$month</em>. <em>$ageLimit</em>. ";
            //switch statement to create custom message
            switch($month) {
                case "June":
				case "July": 
				case "August": 
			 $message .= "You are born in the sunny summer.";
                                    break;
                case "September":
				case "October": 
				case "Novemeber": 
                                    $message .= "You are born in the cold Autumn.";
                                    break;
                    case "December":
					case "January":
					case "february":
                                    $message .= "You are born in the snowy winter.";
                                    break;
					 case "March":
					case "April":
					case "May":
                                    $message .= "You are born in the wonderful spring time.";
                                    break;
                        default: 
                                    $message .= "Please choose a month.";
                                    break;
            }
            
            $json = '{
                        "result":"true",
						"message":"' . $message . '"
                        }';
            echo $json;
?>