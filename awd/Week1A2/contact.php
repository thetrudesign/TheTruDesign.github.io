<?php
	   $name = $_POST['name'];
       $email = $_POST['email'];
       $phone = $_POST['phone'];
       $messages = $_POST['message'];
       
       //where the email will be sent to.
       //to send to multiple addresses, separate each with a comma
       $to = "tru.dinh@outlook.com," . $email;
       $from = "webmaster@yoursitename.com";
       $subject = "Contact Form";
       $message = "Thank you for contacting us. Below is the information you provided:\n\n";
       $message .= "Name: {$name} \n\n";
       $message .= "Phone: {$phone} \n\n";
       $message .= "Email: {$email} \n\n";
       $message .= "Message: {$messages} \n\n";
       
       $mail_sent = @mail( $to, $subject, $message, "From: " . $from );
       
       if($mail_sent)
       {
       echo "Email sent";
       } else {
       print "An error occurred while sending the email.";
       }
?>