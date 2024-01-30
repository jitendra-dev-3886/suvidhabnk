<?php


$id = $_POST['user_id'];
$user_type_id = $_POST['user_type'];
$token_id = $_POST['token'];
$package_type = $_POST['pack_type'];
include("../includes/config.php");
include("../includes/main_function.php");

$response  = array();
$mysql_qry = "select * FROM user WHERE ID ='$id' AND TOKEN_ID = '$token_id'";
$result = mysqli_query($con ,$mysql_qry);
if(mysqli_num_rows($result) > 0) {
    
}else{
    
                $myArr = array(
                "status" =>false,
                "message" =>"Package Fetched",
                "response_code"=>999,
                "selected"=>$selected,
                "data"=>$response
                );

            echo json_encode($myArr);
            return;
}

if(isset($_POST['fetch'])){
    
    
    $user_package1 = $con->query("SELECT * FROM user WHERE ID='$id'")->fetch_assoc();
    if($package_type=="aeps"){
        $COMM = $user_package1['AEPS_COMM'];
    }
    else{
        $COMM = $user_package1['M_ATM_COMM'];
    }
    $pack_query1 = $con->query("SELECT * FROM commission_package where STATUS='ACTIVE' AND ID='$COMM'")->fetch_assoc();
    $selected = $pack_query1['PACKAGE_NAME'];
    
     $service_manager = $con->query("SELECT * FROM `service_manager` WHERE SERVICE = '$package_type' order by ID asc ")->fetch_assoc();
     $service = $service_manager['ID'];
     $pack_query2 = $con->query("SELECT * FROM commission_package where STATUS='ACTIVE' AND USER_TYPE='$user_type_id' AND SERVICES='$service' order by ID desc");
     while($packDt2 = $pack_query2->fetch_assoc()){
        $packID =  $packDt2['ID'];
        $packName = $packDt2['PACKAGE_NAME'];
        $packPrice = $packDt2['PACKAGE_PRICE'];
        $commType = $packDt2['COMM_TYPE'];
        array_push($response,array("id"=>$packID, "name"=>$packName,"price"=>$packPrice,"type"=>$commType));
     }
    
                $myArr = array(
                "status" =>true,
                "message" =>"Package Fetched",
                "response_code"=>1,
                "selected"=>$selected,
                "data"=>$response
                );

            echo json_encode($myArr);
}

if(isset($_POST['set_package'])){
    $selectedId  = $_POST['selectedId'];
    
    //
    
    
    
    //


    
    if($package_type=="aeps"){
        $update_date = "update user set AEPS_COMM='$selectedId' where ID='$id'";    
    }
    else{
        $update_date = "update user set M_ATM_COMM='$selectedId' where ID='$id'"; 
    }

    if($con->query($update_date)){
        
                $myArr = array(
                "status" =>true,
                "message" =>"Package Updated",
                "response_code"=>1
                );

            echo json_encode($myArr);
        
    }
    else{
        
                $myArr = array(
                "status" =>false,
                "message" =>"Something went wrong..",
                "response_code"=>200
                );

            echo json_encode($myArr);
        
    }
    
}


?>