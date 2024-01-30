<?php
include('../includes/config.php');

 $today=date("Y-m-d");  


        $mysql_qry = "SELECT * FROM `lead` WHERE STATUS ='Pending' AND date(DATE_OF_SUBMISSION) = '$today' ORDER BY ID DESC";
        $result = mysqli_query($con ,$mysql_qry);
        $todays_pending = mysqli_num_rows($result); 
        
        
        $mysql_qry = "SELECT * FROM `lead` WHERE STATUS ='Success' AND date(DATE_OF_SUBMISSION) = '$today' ORDER BY ID DESC";
        $result = mysqli_query($con ,$mysql_qry);
        $todays_success = mysqli_num_rows($result); 
        
        
        
        
        $mysql_qry = "SELECT * FROM `activity` WHERE DATE ='$today' AND STATUS='Next Call' ORDER BY ID DESC";
        $result = mysqli_query($con ,$mysql_qry);
        $todays_call = mysqli_num_rows($result); 



        echo json_encode([
                "todays_pending"=>$todays_pending,
                "todays_success"=>$todays_success,
                "todays_call"=>$todays_call
            
            ]);
?>
