<?php


    if(isset($_POST['my_id'])){

    $my_id = $_POST['my_id'];
    $my_user_status = $_POST['my_status'];
    $userType = $_POST['userTypeC'];
    
    
    include("../includes/config.php");
    
    $response  = array();
    
    $op = $con->query("SELECT * FROM `user` WHERE USER_TYPE > '$userType' AND STATUS='active' AND MAIN_OWNER_ID='$my_id'");
    
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