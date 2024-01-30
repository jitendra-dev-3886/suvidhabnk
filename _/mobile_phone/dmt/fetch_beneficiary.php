
<?php

//from my server
if(isset($_POST['mobile'])){
    
include("../includes/config.php");
include("../includes/fetch_data.php");
include("../includes/main_function.php");
$tkn = create_token();
    
    $mobile = $_POST['mobile'];
    $id = $_POST['id'];
    $user_type = $_POST['usertype'];
    
    
    $response  = array();
    $op = $con->query("SELECT * FROM `dmt_beneficiary` WHERE MOBILE = '$mobile' AND USER_ID='$id' AND USER_TYPE='$user_type' ORDER BY ID DESC");
    
    if($op->num_rows > 0)
    {
        while($row = $op->fetch_assoc()){
            
                $myData = $row['RESPONSE'];
                $myData1 = json_decode($myData);
                $rawData = $myData1->data;  

                array_push($response,array("bene_id"=>$rawData->bene_id,"bankid"=>$rawData->bankid,"bankname"=>$rawData->bankname,"name"=>$rawData->name,"accno"=>$rawData->accno,"ifsc"=>$rawData->ifsc,"verified"=>$rawData->verified,"banktype"=>$rawData->banktype,"paytm"=>""));
                                                                            
        }
        
        echo json_encode($response);
    }
    else{
        echo json_encode($response);
    }
    
    
    
    
}



//from server
// if(isset($_POST['mobile'])){
    
// include("../includes/fetch_data.php");
// include("../includes/main_function.php");
// $tkn = create_token();
    
//     $mobile = $_POST['mobile'];
    
// $curl = curl_init();
// curl_setopt_array($curl, [
//   CURLOPT_URL => "https://api.paysprint.in/api/v1/service/dmt/beneficiary/registerbeneficiary/fetchbeneficiary",
//   CURLOPT_RETURNTRANSFER => true,
//   CURLOPT_ENCODING => "",
//   CURLOPT_MAXREDIRS => 10,
//   CURLOPT_TIMEOUT => 30,
//   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//   CURLOPT_CUSTOMREQUEST => "POST",
//   CURLOPT_POSTFIELDS => "{\"mobile\":$mobile}",
//   CURLOPT_HTTPHEADER => [
//     "Accept: application/json",
//     "Content-Type: application/json",
//     "Authorisedkey:".$paysprint['AUTHORISED_KEY'],
//     "Token: ".$tkn
//   ],
// ]);

// $response = curl_exec($curl);
// $err = curl_error($curl);

// curl_close($curl);

// if ($err) {
//   echo "cURL Error #:" . $err;
// } else {
//   echo $response;
// }

// }


?>