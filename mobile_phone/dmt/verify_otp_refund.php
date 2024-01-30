<?php

include("../includes/config.php");
$base_url = "https://api.paysprint.in";

if(isset($_POST['refrence'])){
    
    $refrence = $_POST['refrence'];
    $ackno = $_POST['ackno'];
    $otp = $_POST['otp'];
    
    
    include("../includes/fetch_data.php");
    include("../includes/main_function.php");

$curl = curl_init();

$data = json_encode(
            array(
                "referenceid"=>"$refrence",
                "ackno"=>"$ackno",
                "otp"=>"$otp"
                )
            );
$tkn = create_token();
   

$curl = curl_init();
$tkn = create_token();
curl_setopt_array($curl, [
  CURLOPT_URL => "$base_url/api/v1/service/dmt/refund/refund/",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => $data,
  CURLOPT_HTTPHEADER => [
    "Accept: application/json",
        "Content-Type: application/json",
        "Authorisedkey:".$paysprint['AUTHORISED_KEY'],
        "Token: ".$tkn
    ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);
echo $response;
curl_close($curl);
if ($err) {
  echo "cURL Error #:" . $err;
} else { 
    $rstl = json_decode($response);
    $rs_code = $rstl->response_code; 
    $msg = $rstl->message;
    
    if($rs_code==1){
            
            $mysql_qry = "select * FROM `dmt_transactions` WHERE REFFRENCE_ID ='$refrence'";
            $result = mysqli_query($con ,$mysql_qry);
            $row = mysqli_fetch_array($result);
            $user_id = $row['USER_ID'];
            $user_type = $row['USER_TYPE'];
            $amount = $row['AMOUNT'];
            $user = $con->query("SELECT * FROM `user` WHERE ID='$user_id' and US_STATUS='ACTIVE'")->fetch_assoc(); 
            $old_bal = $user['MAIN_BAL'];
            
            $refund = (int)$old_bal+(int)$amount;
            
            $sql_m = "UPDATE `user` SET MAIN_BAL='$refund' WHERE ID='$user_id' AND USER_TYPE='$user_type'";
            mysqli_query($con, $sql_m);
            
            
            $sql = "UPDATE `dmt_transactions` SET RESPONSE='".str_replace("'" , "\'" , $response)."' WHERE REFFRENCE_ID='$refrence'";
            mysqli_query($con, $sql);
    }
}
    
}



?>