<?php


    if(isset($_POST['id'])){
    
    $userType = $_POST['userType'];
    
    include("../includes/config.php");
    
    $response  = array();
    
    $op = $con->query("SELECT * FROM `user_type` WHERE ID < '$userType' AND STATUS='active'");
    
    if($op->num_rows > 0)
    {   
        while($row = $op->fetch_assoc()){
            
                array_push($response,array("id"=>$row['ID'],"owner"=>$row['OWNER'],"owner_id"=>$row['OWNER_ID'],"name"=>$row['NAME'],"authority"=>$row['AUTHORITY']));
        }
                $myArr = array(
                "status" =>true,
                "message" =>"fetched",
                "data"=>$response
                );
                echo json_encode($myArr);
    }else{
        
                $myArr = array(
                "status" =>false,
                "message" =>"You Don't Posses enough authority",
                "data"=>$response
                );
                echo json_encode($myArr);
    
    }    
        
            
}



?>