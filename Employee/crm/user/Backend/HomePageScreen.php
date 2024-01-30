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
 
 
 

        $allLead = $con->query("SELECT * FROM `lead` WHERE STATE IN('$userState') AND DISTRICT IN('$userDistrict') AND BLOCK IN('$userBlock') ORDER BY ID DESC LIMIT 15000")->num_rows;

        $pending = $con->query("SELECT * FROM `lead` WHERE STATUS ='Pending' AND STATE IN('$userState') AND DISTRICT IN('$userDistrict') AND BLOCK IN('$userBlock') ORDER BY ID DESC LIMIT 15000")->num_rows;
        
        $Call_not_connect = $con->query("SELECT * FROM `lead` WHERE STATUS ='Call not Connect' AND STATE IN('$userState') AND DISTRICT IN('$userDistrict') AND BLOCK IN('$userBlock') ORDER BY ID DESC LIMIT 15000")->num_rows;
        $First_Call = $con->query("SELECT * FROM `lead` WHERE STATUS ='First Call Complete' AND STATE IN('$userState') AND DISTRICT IN('$userDistrict') AND BLOCK IN('$userBlock') ORDER BY ID DESC LIMIT 15000")->num_rows;
        $next_call = $con->query("SELECT * FROM `lead` WHERE STATUS ='Next Call Schedule' AND STATE IN('$userState') AND DISTRICT IN('$userDistrict') AND BLOCK IN('$userBlock') ORDER BY ID DESC LIMIT 15000")->num_rows;
        $Meeting = $con->query("SELECT * FROM `lead` WHERE STATUS ='Meeting Complete' AND STATE IN('$userState') AND DISTRICT IN('$userDistrict') AND BLOCK IN('$userBlock') ORDER BY ID DESC LIMIT 15000")->num_rows;
        $Software = $con->query("SELECT * FROM `lead` WHERE STATUS ='Software Demo Complete' AND STATE IN('$userState') AND DISTRICT IN('$userDistrict') AND BLOCK IN('$userBlock') ORDER BY ID DESC LIMIT 15000")->num_rows;
        $waiting_confirm = $con->query("SELECT * FROM `lead` WHERE STATUS ='Waiting for Customer Confirmation' AND STATE IN('$userState') AND DISTRICT IN('$userDistrict') AND BLOCK IN('$userBlock') ORDER BY ID DESC LIMIT 15000")->num_rows;
        $waiting_payment = $con->query("SELECT * FROM `lead` WHERE STATUS ='Waiting for Payment' AND STATE IN('$userState') AND DISTRICT IN('$userDistrict') AND BLOCK IN('$userBlock') ORDER BY ID DESC LIMIT 15000")->num_rows;
        $tkn_mny = $con->query("SELECT * FROM `lead` WHERE STATUS ='Token Money Recive' AND STATE IN('$userState') AND DISTRICT IN('$userDistrict') AND BLOCK IN('$userBlock') ORDER BY ID DESC LIMIT 15000")->num_rows;
        $area_allotment = $con->query("SELECT * FROM `lead` WHERE STATUS ='Area Allotment and Document Complete' AND STATE IN('$userState') AND DISTRICT IN('$userDistrict') AND BLOCK IN('$userBlock') ORDER BY ID DESC LIMIT 15000")->num_rows;
        $st_binding_up = $con->query("SELECT * FROM `lead` WHERE STATUS ='Store Branding Under Process' AND STATE IN('$userState') AND DISTRICT IN('$userDistrict') AND BLOCK IN('$userBlock') ORDER BY ID DESC LIMIT 15000")->num_rows;
        $st_binding_com = $con->query("SELECT * FROM `lead` WHERE STATUS ='Store Branding Complete' AND STATE IN('$userState') AND DISTRICT IN('$userDistrict') AND BLOCK IN('$userBlock') ORDER BY ID DESC LIMIT 15000")->num_rows;
        $paymnet_recive = $con->query("SELECT * FROM `lead` WHERE STATUS ='Full Payment Recive' AND STATE IN('$userState') AND DISTRICT IN('$userDistrict') AND BLOCK IN('$userBlock') ORDER BY ID DESC LIMIT 15000")->num_rows;
        $store_inaug = $con->query("SELECT * FROM `lead` WHERE STATUS ='Store Inauguration Complete' AND STATE IN('$userState') AND DISTRICT IN('$userDistrict') AND BLOCK IN('$userBlock') ORDER BY ID DESC LIMIT 15000")->num_rows;
        $onBoard = $con->query("SELECT * FROM `lead` WHERE STATUS ='Onboarding Complete' AND STATE IN('$userState') AND DISTRICT IN('$userDistrict') AND BLOCK IN('$userBlock') ORDER BY ID DESC LIMIT 15000")->num_rows;
        $custmer_train = $con->query("SELECT * FROM `lead` WHERE STATUS ='Customer Training Complete' AND STATE IN('$userState') AND DISTRICT IN('$userDistrict') AND BLOCK IN('$userBlock') ORDER BY ID DESC LIMIT 15000")->num_rows;
        $deal_won = $con->query("SELECT * FROM `lead` WHERE STATUS ='Deal Won' AND STATE IN('$userState') AND DISTRICT IN('$userDistrict') AND BLOCK IN('$userBlock') ORDER BY ID DESC LIMIT 15000")->num_rows;
        $deal_loss = $con->query("SELECT * FROM `lead` WHERE STATUS ='Deal Loss' AND STATE IN('$userState') AND DISTRICT IN('$userDistrict') AND BLOCK IN('$userBlock') ORDER BY ID DESC LIMIT 15000")->num_rows;
        
        echo json_encode([
           
               "allLead"=>$allLead,
               "pending"=>$pending,
               "Call_not_connect"=>$Call_not_connect,
               "First_Call"=>$First_Call,
               "next_call"=>$next_call,
               "Meeting"=>$Meeting,
               "Software"=>$Software,
               "waiting_confirm"=>$waiting_confirm,
               "waiting_payment"=>$waiting_payment,
               "tkn_mny"=>$tkn_mny,
               "area_allotment"=>$area_allotment,
               "st_binding_up"=>$st_binding_up,
               "st_binding_com"=>$st_binding_com,
               "store_inaug"=>$store_inaug,
               "onBoard"=>$onBoard,
               "custmer_train"=>$custmer_train,
               "paymnet_recive"=>$paymnet_recive,
               "deal_won"=>$deal_won,
               "deal_loss"=>$deal_loss,
          ]);

?>