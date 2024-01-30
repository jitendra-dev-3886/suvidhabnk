<?php

include("../includes/config.php");
include("API_Functions.php");
$api = new API_Functions();



// $circle = $_POST['region'];
// $op = $_POST['op'];   
// $response = $api->roffer_plan_simple($op,$circle);
// $result = json_decode($response,true);
// $FULLTT = $result['records']['FULLTT'];
// $TOPUP = $result['records']['TOPUP'];
// $Dataplan = $result['records']['3G/4G'];
// $RateCutter = $result['records']['RATE CUTTER'];
// $R2G = $result['records']['2G'];
// $SMS = $result['records']['SMS'];
// $COMBO = $result['records']['COMBO'];



if(isset($_POST['mobile_r']))
{
    $num = $_POST['num'];
    $op = $_POST['op'];
    $user_id = $_POST['user_id'];
    $password = $_POST['password'];
    
    $op_data = $con->query("select * from switchOperator where LONGCODE='$op' ")->fetch_assoc();
    $r_off_code = $op_data['roffer'];
    
    // $response = $api->roffer_plan_simple($r_off_code,"Gujrat");
    echo $response = $api->roffer_plan_roffer($r_off_code, $num);

 }


//dth Browse plan
if(isset($_POST['dth_rOffer']))
{
//   $num = "02536150467";
//     $op = "17";
//     $r_off_code = "Dish TV";
//     echo $response = $api->dth_plan($r_off_code, $num);
    $user_id = $_POST['user_id'];
    $password = $_POST['password'];
    $num = $_POST['num'];
    $op = $_POST['dth_op'];
    $op_data = $con->query("select * from switchOperator where LONGCODE='$op' ")->fetch_assoc();
    $r_off_code = $op_data['roffer'];
    echo $response = $api->dth_plan_roffer($r_off_code, $num);

}


// customer info
if(isset($_POST['dth_customer_info']))
{
//     $num = "02536150467";
//     $op = "17";
    
    $num = $_POST['num'];
    $op = $_POST['op'];
    
    
    $op_data = $con->query("select * from switchOperator where LONGCODE='$op' ")->fetch_assoc();
    
    // $r_off_code = "Dishtv";
    
    $r_off_code = $op_data['roffer'];
    
    $req_url = "https://www.mplan.in/api/Dthinfo.php?apikey=f70282f82296bb8737399a3433e232bc&offer=roffer&tel=$num&operator=$r_off_code";
     $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => $req_url,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
         CURLOPT_HTTPHEADER => array(
                'Authorization: Basic TU0wMDA5MDA6Z2o5MGZ2YiNAJQ=='
              ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
         $result = json_decode($response);
      $rc = $result->records;
      $status = $result->status;
      $myRc = json_decode($result);
     if($status != 0){
            $myVal = array(
                    "code"=>$status,
                    "offers"=>$rc,
                    "message"=>"Success"
                );
            echo json_encode($myVal);
      }else{
                $myVal = array(
                    "code"=>$status,
                    "offers"=>null,
                    "message"=>"Failed"
                );
            echo json_encode($myVal);
      }  
}
?>