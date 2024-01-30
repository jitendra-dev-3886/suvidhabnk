<?php

include("../includes/config.php");


$main_owner = $user['MAIN_OWNER'];
$main_owner_id = $user['MAIN_OWNER_ID'];

$owner_id = $user['OWNER_ID'];

$user_type = $user['USER_TYPE'];
$user_id = $user['ID'];

$amount = $_POST['amount'];
$trans_id = $_POST['transaction_id'];
$payment_mode = $_POST['payment_mode'];
$recipt = $_POST['receipt'];
$remark = $_POST['remarks'];

$date = date("Y-m-d g:i:s A");
$branchName = $_POST['branchName'];
$bankId = $_POST['bankID'];
//Bank details table id;


if(isset($_POST['transaction_id'])){
    
    $recipt_name = uploadImage($recipt);
    

    $query_run = "INSERT INTO `fund`(`MAIN_OWNER`, `MAIN_OWNER_ID`, `OWNER_ID`, `USER_ID`, `AMOUNT`, `REFFRENCE_ID`, `PAYMENT_MODE`, `RECIEPT`, `REMARK`, `STATUS`, `DATE`, `FUND_TYPE`) VALUES
    ('$main_owner','$main_owner_id','$owner_id','$user_id','$amount','$trans_id','$payment_mode','$recipt_name','$remark','Pending','$date', 'Offline Requested')";
    
    if($con->query($query_run)){
        echo json_encode(["status"=>true, "response_code"=>1, "message"=>"Successfully requested."]);
    }else{
         echo json_encode(["status"=>false, "response_code"=>200, "message"=>"Something went wrong."]);
    }

}








function uploadImage($imageString){
    $InsertProfilePath = "";
    $data = base64_decode($imageString);
    // $extension = explode('/', getMIMETYPE($imageString))[1];
    $extension = "png";
    $imageName = generateRandomString(12).".".$extension;
    $insertion = $InsertProfilePath.$imageName;
    file_put_contents("$insertion" ,$data);
    return $imageName;
}

function getMIMETYPE($base64string){
    $imgdata = base64_decode($base64string);
    $f = finfo_open();
    $mime_type = finfo_buffer($f, $imgdata, FILEINFO_MIME_TYPE);   
    return $mime_type;
}

function generateRandomString($length) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}




?>