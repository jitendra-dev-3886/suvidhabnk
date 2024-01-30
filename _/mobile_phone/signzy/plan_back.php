<?php
    
    include("../includes/configuration.php");
    
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);
    
    
    echo "<h1>Wow Subscription is done.. great</h1>";
    
    
    if($json!="" || $json!=null){
        
    
        
        $insert_report = "INSERT INTO `plan_callback`(`RESPONSE`) VALUES ('$json')";
            $con->query($insert_report);
    }


?>