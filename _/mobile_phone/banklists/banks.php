<?php
    
    include("../includes/config.php");

    
    // $receive = $_POST['receive'];
    
    $receive = "allbanksindb";

    if($receive == "allbanksindb"){
            
     $response  = array();
    //fetch banks
    $op = $con->query("SELECT * FROM `paysprint_bank_list`");
    
    if($op->num_rows > 0)
    {
        while($row = $op->fetch_assoc()){
            
             array_push($response,array("bankid"=>$row['BANKID'],"bankname"=>$row['BANK_NAME'],"ifsccode"=>$row['IFSC_CODE'],"pennny"=>$row['pennydrop_0_not_allowed_1_allowed'],"column"=>$row['Column_0_NEFT_1_NEFT_and_IMPS_both'],"logo"=>"abc"));
                                                                            
        }
        
        echo json_encode($response);
    }
    else{
        echo "No Data";
    }   
    }



?>