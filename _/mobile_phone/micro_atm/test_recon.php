<?php

    include("../includes/config.php");
    include("../includes/fetch_data.php");
    include("../includes/main_function.php");
    
    $op = $con->query("SELECT * FROM `micro_atm` WHERE RESPONSE='1' ORDER BY ID DESC");
    if($op->num_rows > 0)
    {
        while($row = $op->fetch_assoc()){
            $ref = $row['TXNID'];
            $resp = $row['RESPONSE'];
            if($resp == "1"){
                callToRecon($ref , "Success", "Passed");
                
            }else{
                
            callToRecon($ref , "Failed", "Passed");
                
            }
        }
    }
    
    

    function callToRecon($ref , $status, $msg){
    global $con , $paysprint;
    
        $arr = array(
            "reference"=>"$ref",
            "status"=>"$status",
            );
            
        $data_tkn = encrypt($arr);
        $sendData = array(
            "body"=>$data_tkn,
            );
        $main_body = json_encode($sendData , true);
        $token = create_token();
        
        $curl = curl_init();
        curl_setopt_array($curl, [

          CURLOPT_URL => $paysprint['URL']."/api/v1/service/matm/threeway/update",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => $main_body,
          CURLOPT_HTTPHEADER => [
             "Content-Type: application/json",
            "Authorisedkey:".$paysprint['AUTHORISED_KEY'],
            "Token:".$token
            ],
        ]);
        
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        $deta  = json_decode($response);
        $mymsg = $deta->message;
        echo $response;
      $con->query("INSERT INTO `atm_recon_response`(`DATA`, `RESPONSE`) VALUES ('".json_encode($arr)."','$response')");
}



?>