<?php
include('../includes/config.php');
include('userdata.php');


$BlockArray = explode(",",$user['BLOCK']);
$StateArray = explode(",",$user['STATE']);
$DistrictArray = explode(",",$user['DISTRICT']);


$userBlock = implode("','",$BlockArray);
$userState = implode("','",$StateArray);
$userDistrict = implode("','",$DistrictArray);


$status = $_POST['status'];
$today=date("Y-m-d"); 
 
  
 
 
    if($_POST['status'] == "All Lead"){
        $op = $con->query("SELECT * FROM `lead` WHERE STATE IN('$userState') AND DISTRICT IN('$userDistrict') AND BLOCK IN('$userBlock') ORDER BY ID DESC LIMIT 15000");
        
    }elseif($_POST['status'] == "Pending"){
        $op = $con->query("SELECT * FROM `lead` WHERE STATUS ='Pending' AND STATE IN('$userState') AND DISTRICT IN('$userDistrict') AND BLOCK IN('$userBlock') ORDER BY ID DESC LIMIT 15000");
        
    }elseif($_POST['status'] == "Call not Connect"){
        $op = $con->query("SELECT * FROM `lead` WHERE STATUS ='Call not Connect' AND STATE IN('$userState') AND DISTRICT IN('$userDistrict') AND BLOCK IN('$userBlock') ORDER BY ID DESC LIMIT 15000");
        
    }elseif($_POST['status'] == "First Call Complete"){
        $op = $con->query("SELECT * FROM `lead` WHERE STATUS ='First Call Complete' AND STATE IN('$userState') AND DISTRICT IN('$userDistrict') AND BLOCK IN('$userBlock') ORDER BY ID DESC LIMIT 15000");
        
    }elseif($_POST['status'] == "Next Call Schedule"){
        $op = $con->query("SELECT * FROM `lead` WHERE STATUS ='Next Call Schedule' AND STATE IN('$userState') AND DISTRICT IN('$userDistrict') AND BLOCK IN('$userBlock') ORDER BY ID DESC LIMIT 15000");
        
    }elseif($_POST['status'] == "Meeting Complete"){
        $op = $con->query("SELECT * FROM `lead` WHERE STATUS ='Meeting Complete' AND STATE IN('$userState') AND DISTRICT IN('$userDistrict') AND BLOCK IN('$userBlock') ORDER BY ID DESC LIMIT 15000");
        
    }elseif($_POST['status'] == "Software Demo Complete"){
        $op = $con->query("SELECT * FROM `lead` WHERE STATUS ='Software Demo Complete' AND STATE IN('$userState') AND DISTRICT IN('$userDistrict') AND BLOCK IN('$userBlock') ORDER BY ID DESC LIMIT 15000");
        
    }elseif($_POST['status'] == "Waiting for Customer Confirmation"){
        $op = $con->query("SELECT * FROM `lead` WHERE STATUS ='Waiting for Customer Confirmation' AND STATE IN('$userState') AND DISTRICT IN('$userDistrict') AND BLOCK IN('$userBlock') ORDER BY ID DESC LIMIT 15000");
        
    }elseif($_POST['status'] == "Waiting for Payment"){
        $op = $con->query("SELECT * FROM `lead` WHERE STATUS ='Waiting for Payment' AND STATE IN('$userState') AND DISTRICT IN('$userDistrict') AND BLOCK IN('$userBlock') ORDER BY ID DESC LIMIT 15000");
        
    }elseif($_POST['status'] == "Token Money Recive"){
        $op = $con->query("SELECT * FROM `lead` WHERE STATUS ='Token Money Recive' AND STATE IN('$userState') AND DISTRICT IN('$userDistrict') AND BLOCK IN('$userBlock') ORDER BY ID DESC LIMIT 15000");
        
    }elseif($_POST['status'] == "Area Allotment and Document Complete"){
        $op = $con->query("SELECT * FROM `lead` WHERE STATUS ='Area Allotment and Document Complete' AND STATE IN('$userState') AND DISTRICT IN('$userDistrict') AND BLOCK IN('$userBlock') ORDER BY ID DESC LIMIT 15000");
        
    }elseif($_POST['status'] == "Store Branding Under Process"){
        $op = $con->query("SELECT * FROM `lead` WHERE STATUS ='Store Branding Under Process' AND STATE IN('$userState') AND DISTRICT IN('$userDistrict') AND BLOCK IN('$userBlock') ORDER BY ID DESC LIMIT 15000");
        
    }elseif($_POST['status'] == "Store Branding Complete"){
        $op = $con->query("SELECT * FROM `lead` WHERE STATUS ='Store Branding Complete' AND STATE IN('$userState') AND DISTRICT IN('$userDistrict') AND BLOCK IN('$userBlock') ORDER BY ID DESC LIMIT 15000");
        
    }elseif($_POST['status'] == "Full Payment Received"){
        $op = $con->query("SELECT * FROM `lead` WHERE STATUS ='Full Payment Received' AND STATE IN('$userState') AND DISTRICT IN('$userDistrict') AND BLOCK IN('$userBlock') ORDER BY ID DESC LIMIT 15000");
        
    }elseif($_POST['status'] == "Store Inauguration Complete"){
        $op = $con->query("SELECT * FROM `lead` WHERE STATUS ='Store Inauguration Complete' AND STATE IN('$userState') AND DISTRICT IN('$userDistrict') AND BLOCK IN('$userBlock') ORDER BY ID DESC LIMIT 15000");
        
    }elseif($_POST['status'] == "Onboarding Complete"){
        $op = $con->query("SELECT * FROM `lead` WHERE STATUS ='Onboarding Complete' AND STATE IN('$userState') AND DISTRICT IN('$userDistrict') AND BLOCK IN('$userBlock') ORDER BY ID DESC LIMIT 15000");
        
    }elseif($_POST['status'] == "Customer Training Complete"){
        $op = $con->query("SELECT * FROM `lead` WHERE STATUS ='Customer Training Complete' AND STATE IN('$userState') AND DISTRICT IN('$userDistrict') AND BLOCK IN('$userBlock') ORDER BY ID DESC LIMIT 15000");
        
    }elseif($_POST['status'] == "Deal Won"){
        $op = $con->query("SELECT * FROM `lead` WHERE STATUS ='Deal Won' AND STATE IN('$userState') AND DISTRICT IN('$userDistrict') AND BLOCK IN('$userBlock') ORDER BY ID DESC LIMIT 15000");
        
    }elseif($_POST['status'] == "Deal Loss"){
        $op = $con->query("SELECT * FROM `lead` WHERE STATUS ='Deal Loss' AND STATE IN('$userState') AND DISTRICT IN('$userDistrict') AND BLOCK IN('$userBlock') ORDER BY ID DESC LIMIT 15000");
        
    }
    
    
    if($_POST['status']){
        
        $response = array();
        
        // $op = $con->query("SELECT * FROM `lead` WHERE STATUS='$status' AND date(DATE_OF_SUBMISSION) = '$today' ORDER BY ID DESC LIMIT 15000");
        if($op->num_rows > 0)
        {
         while($row = $op->fetch_assoc()){
            

            if(in_array($row['BLOCK'], $BlockArray)){
                
                $lead_id = $row['ID'];
                $op2 = $con->query("SELECT * FROM `activity` WHERE LEAD_ID ='$lead_id' ORDER BY ID DESC LIMIT 1");
                array_push($response,["lead"=>$row, "activity"=>$row2 = $op2->fetch_assoc()]);
                
            }
            else if(in_array($row['DISTRICT'], $DistrictArray)){
                
                $lead_id = $row['ID'];
                $op2 = $con->query("SELECT * FROM `activity` WHERE LEAD_ID ='$lead_id' ORDER BY ID DESC LIMIT 1");
                array_push($response,["lead"=>$row, "activity"=>$row2 = $op2->fetch_assoc()]);
               
            }
            
            else if(in_array($row['STATE'], $StateArray)){
                
                $lead_id = $row['ID'];
                $op2 = $con->query("SELECT * FROM `activity` WHERE LEAD_ID ='$lead_id' ORDER BY ID DESC LIMIT 1");
                array_push($response,["lead"=>$row, "activity"=>$row2 = $op2->fetch_assoc()]);
                
            }
            else{
                
            }
            

         }
             echo json_encode($response);
        }
        else{
            
            echo json_encode($response);
        }    
        
    }




?>