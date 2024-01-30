<?php
    
    $id = $_POST['id'];
    $user_type = $_POST['user_type'];
    
    // $id = "1";
    // $user_type = "1";
    

if($id!=""){
    include("../includes/config.php");
    
    $response  = array();  
    $op = $con->query("SELECT * FROM `dmt_user` WHERE USER_ID = '$id' AND USER_TYPE='$user_type' ORDER BY ID DESC");
    if($op->num_rows > 0)
    { 
        while($row = $op->fetch_assoc()){
                
                $manage = json_decode($row['RESPONSE']);
                
                $details = $manage;
                $manage = $manage->data;
                if($manage!=null){
                array_push($response,array("status"=>$details->status,"response_code"=>$details->response_code,"message"=>$details->message,"fname"=>$manage->fname,"lname"=>$manage->lname,"mobile"=>$manage->mobile,"my_status"=>$manage->status,"bank3_limit"=>$manage->bank3_limit,"bank2_limit"=>$manage->bank2_limit,"bank1_limit"=>$manage->bank1_limit,"id"=>$row['ID']));
                }
        }
        
        echo stripslashes(json_encode($response,JSON_UNESCAPED_SLASHES));
    
    }else{
        
        echo stripslashes(json_encode($response,JSON_UNESCAPED_SLASHES));
    
    }
        
}


?>