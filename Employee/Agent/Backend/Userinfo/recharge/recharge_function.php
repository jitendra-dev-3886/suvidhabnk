<?php
// error_reporting(E_ALL);
// include("../../../../connection/config.php");
// ini_set("display_errors" , 1);
function fetch_operator(){
      global $paysprint;
      global $con;
      $base_url = "https://api.paysprint.in";

$curl = curl_init();
$tkn = create_token(); // declared in dmt function service page'
curl_setopt_array($curl, [
  CURLOPT_URL => "$base_url/api/v1/service/recharge/recharge/getoperator",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => [
    "Accept: application/json",
    "Content-Type: application/json",
    "Authorisedkey:".$paysprint['AUTHORISED_KEY'],
    "Token: ".$tkn
  ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);
// $op_response = json_decode($response);
//  $op_data = $op_response->data;
// foreach($op_data as $op_details){
// $con->query("INSERT INTO `operator_list`(`OPERATOR_CODE`, `NAME`, `SERVICE`) VALUES ('".$op_details->id."','".$op_details->name."','".$op_details->category."')");
// }
curl_close($curl);
    return $response;
}
// give_com("wEoLBGVcMs" , 2 , 28);
function give_com($ref_id , $user_id , $usertype ,$opId){
        global $con;
        $time = date("Y-m-d g:i:s A");
        $user_type_rows = $con->query("select * from user_type ")->num_rows;
        $rch = $con->query("select * from recharge_transaction where REFERENCE_ID='$ref_id'")->fetch_assoc();
        $user = $con->query("select * from user  where ID='$user_id' and USER_TYPE='$usertype'")->fetch_assoc();
        $owner = $user['OWNER_ID'];
        $crnt_bal = $user['MAIN_BAL'];
        $com = $user['RC_COMM'];
        $op_ar = explode("," , $rch['OPERATOR']);
        $pack = $con->query("select * from operator_comm where PACKAGE_ID='$com' and OP_ID='$opId' ")->fetch_assoc();
        
        //check commision type 
        if($pack['TYPE'] == "PERCENTAGE"){
            $com = $pack['AMOUNT'];
            if($pack['AMOUNT_TYPE'] == "DEBIT"){
                $com_amount = ($rch['AMOUNT']/100)*$com;
                $update_bal = $crnt_bal-$com_amount;
            }
            else{
                $com_amount = ($rch['AMOUNT']/100)*$com;
                $update_bal = $crnt_bal+$com_amount;
            }
        }
        else if($pack['TYPE'] == "FLAT"){
              $com = $pack['AMOUNT'];
              if($pack['AMOUNT_TYPE'] == "DEBIT"){
                $com_amount = $com;
                $update_bal = $crnt_bal-$com;
              }
              else{
                $com_amount = $com;
                $update_bal = $crnt_bal+$com;
              }
        }
        else{
            $com_amount = 0;
            $update_bal = $crnt_bal;
        }
        
        // print_r($pack);
        $con->query("update user set MAIN_BAL='$update_bal'  where ID='$user_id' and USER_TYPE='$usertype'");
         $con->query("INSERT INTO `commission_report`(`SERVICE`, `REFFRENCE`, `USER_ID`, `USER_TYPE`, `AMOUNT`, `COMMISSION`, `TIME`) VALUES ('Recharge','$ref_id','$user_id','$usertype','".$rch['AMOUNT']."','$com_amount','$time')");
        insert_allreport($user_id  ,$ref_id , "Recharge Commission" , $crnt_bal  , $update_bal , $com_amount , $pack['AMOUNT_TYPE'] , "Recharge Transaction Commission");
        // echo "<pre>";
        // print_r($user);
        // echo "<br>";

        if(strtolower($owner) != "admin"){
        // echo "<br>";
            $i = 1;
            while($user_type_rows >= $i){
            // echo "work";
                $i++;
                     $user2 = $con->query("select * from user  where ID='$owner'")->fetch_assoc();
                    $owner2 = $user2['OWNER_ID'];
                    $us_type = $user2['USER_TYPE'];
                    // echo $owner2; 
                    $crnt_bal2 = $user2['MAIN_BAL'];
                    $com2 = $user2['RC_COMM'];
                    
                    $pack2 = $con->query("select * from operator_comm where PACKAGE_ID='$com2' and OP_ID='$opId' ")->fetch_assoc();
                    // $com2 = $pack2['PERCENTAGE'];
                    // $com_amount2 = ($rch['AMOUNT']/100)*$com2;
                    // $update_bal2 = $crnt_bal2+$com_amount2;
                    //check commision type 
                        if($pack2['TYPE'] == "PERCENTAGE"){
                            $com2 = $pack2['AMOUNT'];
                            if($pack2['AMOUNT_TYPE'] == "DEBIT"){
                                $com_amount2 = ($rch['AMOUNT']/100)*$com2;
                                $update_bal2 = $crnt_bal2-$com_amount2;
                            }
                            else{
                                $com_amount2 = ($rch['AMOUNT']/100)*$com2;
                                $update_bal2 = $crnt_bal2+$com_amount2;
                            }
                        }
                        else if($pack2['TYPE'] == "FLAT"){
                              $com2 = $pack2['AMOUNT'];
                              if($pack2['AMOUNT_TYPE'] == "DEBIT"){
                                $com_amount2 = $com2;
                                $update_bal2 = $crnt_bal2-$com2;
                              }
                              else{
                                $com_amount2 = $com2;
                                $update_bal2 = $crnt_bal2+$com2;
                              }
                        }
                        else{
                            $com_amount2 = 0;
                            $update_bal2 = $crnt_bal2;
                        }
                    $con->query("update user set MAIN_BAL='$update_bal2'  where ID='$owner'");
                    $con->query("INSERT INTO `commission_report`(`SERVICE`, `REFFRENCE`, `USER_ID`, `USER_TYPE`, `AMOUNT`, `COMMISSION`, `TIME`) VALUES ('Recharge','$ref_id','$owner','$us_type','".$rch['AMOUNT']."','$com_amount2','$time')");
                    insert_allreport($owner  ,$ref_id , "Recharge Commission" , $crnt_bal2  , $update_bal2 , $com_amount2 ,  $pack2['AMOUNT_TYPE'] , "Recharge Transaction Commission");
                    // print_r($user2);
                    if(strtolower($owner2) == "admin"){
                        break;
                    }
            }
        }
    
    // return true;
}

function deduct_com($ref_id , $user_id , $usertype){
    global $con;
$time = date("Y-m-d g:i:s A");
        $user_type_rows = $con->query("select * from user_type ")->num_rows;
        $rch = $con->query("select * from recharge_transaction where REFERENCE_ID='$ref_id'")->fetch_assoc();
        $user = $con->query("select * from user  where ID='$user_id' and USER_TYPE='$usertype'")->fetch_assoc();
        $owner = $user['OWNER_ID'];
        $crnt_bal = $user['MAIN_BAL'];
        $com = $user['RC_COMM'];
        $pack = $con->query("select * from operator_comm where PACKAGE_ID='$com' and OP_ID='".$rch['OPERATOR']."' ")->fetch_assoc();
        $com = $pack['PERCENTAGE'];
        
        $com_amount = ($rch['AMOUNT']/100)*$com;
        $update_bal = $crnt_bal-$com_amount;
        $con->query("update user set MAIN_BAL='$update_bal'  where ID='$user_id' and USER_TYPE='$usertype'");
         $con->query("INSERT INTO `commission_report`(`SERVICE`, `REFFRENCE`, `USER_ID`, `USER_TYPE`, `AMOUNT`, `COMMISSION`, `TIME`) VALUES ('Recharge','$ref_id','$user_id','$usertype','".$rch['AMOUNT']."','$com_amount','$time')");
        insert_allreport($user_id  ,$ref_id , "Recharge Failed Commission" , $crnt_bal  , $update_bal , $com_amount , "Debit" , "Recharge Failed Transaction Commission");
        // echo "<pre>";
        // print_r($user);
        // echo "<br>";

        if(strtolower($owner) != "admin"){
        // echo "<br>";
            $i = 1;
            while($user_type_rows >= $i){
            // echo "work";
                $i++;
                     $user2 = $con->query("select * from user  where ID='$owner'")->fetch_assoc();
                    $owner2 = $user2['OWNER_ID'];
                    $us_type = $user2['USER_TYPE'];
                    // echo $owner2; 
                    $crnt_bal2 = $user2['MAIN_BAL'];
                    $com2 = $user2['RC_COMM'];
                    
                    $pack2 = $con->query("select * from operator_comm where PACKAGE_ID='$com2' and OP_ID='".$rch['OPERATOR']."' ")->fetch_assoc();
                    $com2 = $pack2['PERCENTAGE'];
                    $com_amount2 = ($rch['AMOUNT']/100)*$com2;
                    $update_bal2 = $crnt_bal2-$com_amount2;
                    $con->query("update user set MAIN_BAL='$update_bal2'  where ID='$owner'");
                    $con->query("INSERT INTO `commission_report`(`SERVICE`, `REFFRENCE`, `USER_ID`, `USER_TYPE`, `AMOUNT`, `COMMISSION`, `TIME`) VALUES ('Recharge','$ref_id','$owner','$us_type','".$rch['AMOUNT']."','$com_amount2','$time')");
                    insert_allreport($owner  ,$ref_id , "Recharge Failed Commission" , $crnt_bal2  , $update_bal2 , $com_amount2 , "Debit" , "Recharge Failed Transaction Commission");
                    // print_r($user2);
                    if(strtolower($owner2) == "admin"){
                        break;
                    }
            }
        }
    
    // return true;
}






?>