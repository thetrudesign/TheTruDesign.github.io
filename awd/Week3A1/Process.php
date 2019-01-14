<?php
       sleep(3);
       
       $message = "The job is done!";
       $json = '{
                     "result":"true",
                     "message":"' . $message . '"
                     }';
       
       echo $json;

?>