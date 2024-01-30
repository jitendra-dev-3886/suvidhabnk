<?php
    
    include("../includes/config.php");




    if(isset($_POST['bene_id'])){
        
    $id = $_POST['id'];
    $usertype_id = $_POST['usertype_id'];
    include("../includes/fetch_data.php");
    include("../includes/main_function.php");
    $bene_id = strip_tags($_POST['bene_id']);
 
    $response  = array();
    $op = $con->query("SELECT * FROM `dmt_transactions` WHERE USER_ID = '$id' AND USER_TYPE='$usertype_id' AND BENE_ID='$bene_id' ORDER BY ID DESC");
    
    if($op->num_rows > 0)
    {   
        while($row = $op->fetch_assoc()){
                
                $manage = json_decode($row['RESPONSE']);    
                if($manage!=null){
                    array_push($response,array("time"=>$row['TIMESTAMP'],"amount"=>$row['AMOUNT'],"trans_type"=>$row['TRANS_TYPE'],"data"=>$manage,"status"=>$row['STATUS'],"reference_id"=>$row['REFFRENCE_ID']));
                }
        }
        
        echo stripslashes(json_encode($response,JSON_UNESCAPED_SLASHES));
    
    }else{
                echo stripslashes(json_encode($response,JSON_UNESCAPED_SLASHES));
    }    
        
    
            
            
}

?>