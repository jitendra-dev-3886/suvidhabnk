<?php
// session_start();
// error_reporting(E_ALL);
// ini_set("display_errors" , 1);
include("../../../Db/config.php");
include("../Userinfo/getuserinfo.php");
include("../Functions/all_function.php");
// include("../Auth/userdata.php");
include("../../include/Auth.php");


if(isset($_POST['acctype'])){
    $type = filterVal($_POST['acctype']);
      $tkn = create_token();
    $curl = curl_init();
    
    $data = json_encode([
            "merchantcode"=> $paysprint['MERCHANT_CODE'].$usid,
             "type"=> $type
        ]);
    echo $data;
    curl_setopt_array($curl, [
      CURLOPT_URL => $paysprint['URL']."/api/v1/service/axisbank-utm/axisutm/generateurl",
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
    
    curl_close($curl);
    // echo $response;
       echo "<h1 style='text-align:center; margin-top:20px;'>Redirecting.. Please do not refresh the page</h1>";
// exit;
  $rs = json_decode($response , true);
  $response_code = $rs['response_code'];
  $url = $rs['data'];
    $msg = str_replace("'" ,"\'", $rs['message']);
    $msg = str_replace("\n" ," ", $msg);
  if($response_code == 1 || $response_code == 3){
      header("location:$url");
         echo "<script>
          location.replace('$url');
      </script>";
  }else{
      echo "<script>alert('$msg')
          location.replace('../../index');
      </script>";
  } 
    
}
