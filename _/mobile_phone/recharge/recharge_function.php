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


// new commission
// give_com("Mjk5xutIGP" , 2 , 46);
function give_com($ref_id , $user_id , $usertype){
    global $con;
        $time = date("Y-m-d g:i:s A");
        $user_type_rows = $con->query("select * from user_type ")->num_rows;
        $trans = $con->query("select * from recharge_transaction where REFERENCE_ID='$ref_id'")->fetch_assoc();
       
       //fetch user and its owner distributer and master distributer
        $user = $con->query("select * from user  where ID='$user_id' and USER_TYPE='46'")->fetch_assoc();
        $ds_id = $user['OWNER_ID'];
        $ds_data =  $con->query("select * from user  where ID='$ds_id' and USER_TYPE='47'")->fetch_assoc();
        $ms_id = $ds_data['OWNER_ID'];
        $ms_data =  $con->query("select * from user  where ID='$ms_id' and USER_TYPE='48'")->fetch_assoc();
        
        //fetch balance of all
        $us_main_bal = $user['MAIN_BAL'];
        $ds_main_bal = $ds_data['MAIN_BAL'];
        $ms_main_bal = $ms_data['MAIN_BAL'];
        
        $com = $user['RC_COMM'];
        $pack = $con->query("select * from operator_comm where PACKAGE_ID='$com' and OP_ID='".$trans['LONG_CODE']."' ")->fetch_assoc();
        $com_type = $pack['TYPE'];
        
        
                       //check commision type 
                        if($pack['TYPE'] == "PERCENTAGE"){
                           $com = $pack['AMOUNT'];
                            $ds_com = $pack['DS_COM'];
                            $ms_com = $pack['MS_COM'];
                            //check amount commission type
                            if($pack['AMOUNT_TYPE'] == "DEBIT"){
                                $com_amount = ($trans['AMOUNT']/100)*$com; // user commission
                                $ds_com_amount = ($trans['AMOUNT']/100)*$ds_com; // ds commission
                                $ms_com_amount = ($trans['AMOUNT']/100)*$ms_com; // ms commission
                                
                                 //User Balance Managment//
                                $gst = ($com_amount/100)*$pack['GST'];
                                $tds = ($com_amount/100)*$pack['TDS'];
                                $givenCom = $com_amount-$gst-$tds;
                                $update_bal = $us_main_bal-$givenCom;
                                
                                //Ds Balance Managment//
                                $ds_gst = ($ds_com_amount/100)*$pack['GST'];
                                $ds_tds = ($ds_com_amount/100)*$pack['TDS'];
                                $ds_givenCom = $ds_com_amount-$ds_gst-$ds_tds;
                                $ds_update_bal = $ds_main_bal-$ds_givenCom;
                                
                                
                                //Ds Balance Managment//
                                $ms_gst = ($ms_com_amount/100)*$pack['GST'];
                                $ms_tds = ($ms_com_amount/100)*$pack['TDS'];
                                $ms_givenCom = $ms_com_amount-$ms_gst-$ms_tds;
                                $ms_update_bal = $ms_main_bal-$ms_givenCom;
                
                            }
                            else{
                                $com_amount = ($trans['AMOUNT']/100)*$com; // user commission
                                $ds_com_amount = ($trans['AMOUNT']/100)*$ds_com; // ds commission
                                $ms_com_amount = ($trans['AMOUNT']/100)*$ms_com; // ms commission
                                
                                 //User Balance Managment//
                                $gst = ($com_amount/100)*$pack['GST'];
                                $tds = ($com_amount/100)*$pack['TDS'];
                                $givenCom = $com_amount-$gst-$tds;
                                $update_bal = $us_main_bal+$givenCom;
                                
                                  //Ds Balance Managment//
                                $ds_gst = ($ds_com_amount/100)*$pack['GST'];
                                $ds_tds = ($ds_com_amount/100)*$pack['TDS'];
                                $ds_givenCom = $ds_com_amount-$ds_gst-$ds_tds;
                                $ds_update_bal = $ds_main_bal+$ds_givenCom;
                                
                                
                                //Ds Balance Managment//
                                $ms_gst = ($ms_com_amount/100)*$pack['GST'];
                                $ms_tds = ($ms_com_amount/100)*$pack['TDS'];
                                $ms_givenCom = $ms_com_amount-$ms_gst-$ms_tds;
                                $ms_update_bal = $ms_main_bal+$ms_givenCom;
                            }
                        }
                        else if($pack['TYPE'] == "FLAT"){
                              $com = $pack['AMOUNT'];
                              $ds_com = $pack['DS_COM'];
                              $ms_com = $pack['MS_COM'];
                              
                              if($pack['AMOUNT_TYPE'] == "DEBIT"){
                               $com_amount = $com; // user commission 
                                $ds_com_amount = $ds_com; // ds commission 
                                $ms_com_amount = $ms_com; //ms commission
                                
                                // User Balance Managment//
                                $gst = ($com_amount/100)*$pack['GST'];
                                $tds = ($com_amount/100)*$pack['TDS'];
                                $givenCom = $com_amount-$gst-$tds;
                                $update_bal = $us_main_bal-$givenCom;
                                
                                //Ds Balance Managment// 
                                $ds_gst = ($ds_com_amount/100)*$pack['GST'];
                                $ds_tds = ($ds_com_amount/100)*$pack['TDS'];
                                $ds_givenCom = $ds_com_amount-$ds_gst-$ds_tds;
                                $ds_update_bal = $ds_main_bal-$ds_givenCom;
                                
                                //Ms Balance Managment//
                                $ms_gst = ($ms_com_amount/100)*$pack['GST'];
                                $ms_tds = ($ms_com_amount/100)*$pack['TDS'];
                                $ms_givenCom = $ms_com_amount-$ms_gst-$ds_tds;
                                $ms_update_bal = $ms_main_bal-$ms_givenCom;
                                
                              }
                              else{
                               $com_amount = $com; // user commission 
                               $ds_com_amount = $ds_com; // ds commission 
                               $ms_com_amount = $ms_com; //ms commission
                
                                 // User Balance Managment//
                                $gst = ($com_amount/100)*$pack['GST'];
                                $tds = ($com_amount/100)*$pack['TDS'];
                                $givenCom = $com_amount-$gst-$tds;
                                $update_bal = $us_main_bal+$givenCom;
                                
                               //Ds Balance Managment// 
                                $ds_gst = ($ds_com_amount/100)*$pack['GST'];
                                $ds_tds = ($ds_com_amount/100)*$pack['TDS'];
                                $ds_givenCom = $ds_com_amount-$ds_gst-$ds_tds;
                                $ds_update_bal = $ds_main_bal+$ds_givenCom;
                                
                                //Ms Balance Managment//
                                $ms_gst = ($ms_com_amount/100)*$pack['GST'];
                                $ms_tds = ($ms_com_amount/100)*$pack['TDS'];
                                $ms_givenCom = $ms_com_amount-$ms_gst-$ds_tds;
                                $ms_update_bal = $ms_main_bal+$ms_givenCom;
                              }
                        }
                        else{
                           // User Balance Managment//
                            $com_amount = 0;
                            $gst = 0;
                            $tds = 0;
                            $givenCom = 0;
                            $update_bal = $us_main_bal;
                            
                            //Ds Balance Managment// 
                            $ds_gst = 0;
                            $ds_tds = 0;
                            $ds_givenCom = 0;
                            $ds_update_bal = $ds_main_bal;
                            
                            //Ms Balance Managment//
                            $ms_gst = 0;
                            $ms_tds = 0;
                            $ms_givenCom = 0;
                            $ms_update_bal = $ms_main_bal;
                        }
                        
                        
       // below is all required parameter to check any calculation error. Uncomment the below to check and confirm the values.
        
        // echo json_encode([
        // "com"=> number_format($givenCom , 2),
        // "ds_com"=> number_format($ds_givenCom , 2),
        // "ms_com"=> number_format($ms_givenCom  , 2),
        // "gst" => number_format($gst, 2),
        // "tds" => number_format($tds  , 2),
        // "ds_gst"=> number_format($ds_gst , 2),
        // "ds_tds"=> number_format($ds_tds , 2),
        // "ms_gst"=> number_format($ms_gst , 2),
        // "ms_tds"=> number_format($ms_tds , 2),
        // "opBal" => number_format($us_main_bal , 2),
        // "dsopBal" => number_format($ds_main_bal , 2),
        // "msopBal" => number_format($ms_main_bal , 2),
        // "charge" => number_format($charge_amount , 2),
        // "clBal" => number_format($update_bal , 2),
        // "ds_clBal" => number_format($ds_update_bal , 2),
        // "ms_clBal" => number_format($ms_update_bal , 2),
        // ]);
        // exit;
       
        //update the user main balance
        $con->query("update user set MAIN_BAL='$update_bal'  where ID='$user_id' ");
        $con->query("update user set MAIN_BAL='$ds_update_bal'  where ID='$ds_id' ");
        $con->query("update user set MAIN_BAL='$ms_update_bal'  where ID='$ms_id' ");
        
        //Inser into commission report
         $con->query("INSERT INTO `commission_report`(`SERVICE`, `REFFRENCE`, `USER_ID`, `USER_TYPE`, `AMOUNT`, `COMMISSION`,`GST` ,`TDS`, `TIME`) 
                    VALUES ('Recharge','$ref_id','$user_id','46','".$trans['AMOUNT']."','$givenCom','$gst' ,'$tds' ,'$time')");
         
         $con->query("INSERT INTO `commission_report`(`SERVICE`, `REFFRENCE`, `USER_ID`, `USER_TYPE`, `AMOUNT`, `COMMISSION`,`GST` ,`TDS`, `TIME`) 
                    VALUES ('Recharge','$ref_id','$ds_id','47','".$trans['AMOUNT']."','$ds_givenCom','$ds_gst' ,'$ds_tds' ,'$time')");
        
         $con->query("INSERT INTO `commission_report`(`SERVICE`, `REFFRENCE`, `USER_ID`, `USER_TYPE`, `AMOUNT`, `COMMISSION`,`GST` ,`TDS`, `TIME`) 
                    VALUES ('Recharge','$ref_id','$ms_id','48','".$trans['AMOUNT']."','$ms_givenCom','$ms_gst' ,'$ms_tds' ,'$time')");
        
        // Insert All Report
        // insert_allreport($user_id  ,$ref_id , "Recharge Charge" ,$us_main_bal , $crnt_bal , $charge_amount , "Debit" , "Recharge Transaction Charge");
        insert_allreport($user_id  ,$ref_id , "Recharge Commission" ,$us_main_bal , $update_bal , $givenCom , $pack['AMOUNT_TYPE'] , "Recharge Transaction Commission", $ip_address, $device);
        insert_allreport($ds_id  ,$ref_id , "Recharge Commission" ,$ds_main_bal , $ds_update_bal , $ds_givenCom , $pack['AMOUNT_TYPE'] , "Recharge Transaction Commission", $ip_address, $device);
        insert_allreport($ms_id  ,$ref_id , "Recharge Commission" ,$ms_main_bal , $ms_update_bal , $ms_givenCom , $pack['AMOUNT_TYPE'] , "Recharge Transaction Commission",  $ip_address, $device);
        
    // return true;
}
// new commission

// give_com("wEoLBGVcMs" , 2 , 28);
// function give_com($ref_id , $user_id , $usertype, $ip_address, $device){
//     global $con;
// $time = date("Y-m-d g:i:s A");
//         $user_type_rows = $con->query("select * from user_type ")->num_rows;
//         $trans = $con->query("select * from recharge_transaction where REFERENCE_ID='$ref_id'")->fetch_assoc();
//         $user = $con->query("select * from user  where ID='$user_id' and USER_TYPE='$usertype'")->fetch_assoc();
//         $owner = $user['OWNER_ID'];
//         $crnt_bal = $user['MAIN_BAL'];
//         $com = $user['RC_COMM'];
//         $op_ar = explode("," , $trans['OPERATOR']);
//         $pack = $con->query("select * from operator_comm where PACKAGE_ID='$com' and OP_NAME='".$op_ar[0]."' ")->fetch_assoc();
//         $com_type = $pack['TYPE'];
        
        
//               //check commision type 
//                         if($pack['TYPE'] == "PERCENTAGE"){
//                             $com = $pack['AMOUNT'];
//                             //check amount commission type
//                             if($pack['AMOUNT_TYPE'] == "DEBIT"){
//                                 $com_amount = ($trans['AMOUNT']/100)*$com;
//                                 $gst = ($com_amount/100)*$pack['GST'];
//                                 $tds = ($com_amount/100)*$pack['TDS'];
//                                 $givenCom = $com_amount-$gst-$tds;
//                                 $update_bal = $crnt_bal-$givenCom;
//                             }
//                             else{
//                                 $com_amount = ($trans['AMOUNT']/100)*$com;
//                                 $gst = ($com_amount/100)*$pack['GST'];
//                                 $tds = ($com_amount/100)*$pack['TDS'];
//                                 $givenCom = $com_amount-$gst-$tds;
//                                 $update_bal = $crnt_bal+$givenCom;
//                             }
//                         }
//                         else if($pack['TYPE'] == "FLAT"){
//                               $com = $pack['AMOUNT'];
//                               if($pack['AMOUNT_TYPE'] == "DEBIT"){
//                                 $com_amount = $com;
//                                 $gst = ($com_amount/100)*$pack['GST'];
//                                 $tds = ($com_amount/100)*$pack['TDS'];
//                                 $givenCom = $com_amount-$gst-$tds;
//                                 $update_bal = $crnt_bal-$givenCom;
//                               }
//                               else{
//                                 $com_amount = $com;
//                                 $gst = ($com_amount/100)*$pack['GST'];
//                                 $tds = ($com_amount/100)*$pack['TDS'];
//                                 $givenCom = $com_amount-$gst-$tds;
//                                 $update_bal = $crnt_bal+$givenCom;
//                               }
//                         }
//                         else{
//                             $com_amount = 0;
//                             $gst = 0;
//                             $tds = 0;
//                             $givenCom = 0;
//                             $update_bal = $crnt_bal;
//                         }
        
//         // $com_amount = ($trans['AMOUNT']/100)*$com;
//         // $update_bal = $crnt_bal+$com_amount;
        
//         // print_r($pack);
//         $con->query("update user set MAIN_BAL='$update_bal'  where ID='$user_id' and USER_TYPE='$usertype'");
        
         
//         $con->query("INSERT INTO `commission_report`(`SERVICE`, `REFFRENCE`, `USER_ID`, `USER_TYPE`, `AMOUNT`, `COMMISSION`, `GST`, `TDS`, `TIME`) VALUES ('Recharge','$ref_id','$owner','$us_type','".$trans['AMOUNT']."','$givenCom','$gst','$tds','$time')");
                   
                   
//         // $con->query("INSERT INTO `commission_report`(`SERVICE`, `REFFRENCE`, `USER_ID`, `USER_TYPE`, `AMOUNT`, `COMMISSION`, `TIME`) VALUES ('Recharge','$ref_id','$user_id','$usertype','".$trans['AMOUNT']."','$com_amount','$time')");
         
         
//         insert_allreport($user_id  ,$ref_id , "Recharge Commission" , $crnt_bal  , $update_bal , $com_amount , "Credit" , "Recharge Transaction Commission", $ip_address, $device);
//         // echo "<pre>";
//         // print_r($user);
//         // echo "<br>";

//         if(strtolower($owner) != "admin"){
//         // echo "<br>";
//             $i = 1;
//             while($user_type_rows >= $i){
//             // echo "work";
//                 $i++;
//                      $user2 = $con->query("select * from user  where ID='$owner'")->fetch_assoc();
//                     $owner2 = $user2['OWNER_ID'];
//                     $us_type = $user2['USER_TYPE'];
//                     // echo $owner2; 
//                     $crnt_bal2 = $user2['MAIN_BAL'];
//                     $com2 = $user2['RC_COMM'];
                    
//                     $pack2 = $con->query("select * from operator_comm where PACKAGE_ID='$com2' and OP_ID='".$trans['OPERATOR']."' ")->fetch_assoc();
//                     $com2 = $pack2['TYPE'];
                   
                   
//                   //check commision type 
//                         if($pack['TYPE'] == "PERCENTAGE"){
//                             $com = $pack['AMOUNT'];
//                             //check amount commission type
//                             if($pack['AMOUNT_TYPE'] == "DEBIT"){
//                                 $com_amount = ($trans['AMOUNT']/100)*$com;
//                                 $gst = ($com_amount/100)*$pack['GST'];
//                                 $tds = ($com_amount/100)*$pack['TDS'];
//                                 $givenCom = $com_amount-$gst-$tds;
//                                 $update_bal = $crnt_bal-$givenCom;
//                             }
//                             else{
//                                 $com_amount = ($trans['AMOUNT']/100)*$com;
//                                 $gst = ($com_amount/100)*$pack['GST'];
//                                 $tds = ($com_amount/100)*$pack['TDS'];
//                                 $givenCom = $com_amount-$gst-$tds;
//                                 $update_bal = $crnt_bal+$givenCom;
//                             }
//                         }
//                         else if($pack['TYPE'] == "FLAT"){
//                               $com = $pack['AMOUNT'];
//                               if($pack['AMOUNT_TYPE'] == "DEBIT"){
//                                 $com_amount = $com;
//                                 $gst = ($com_amount/100)*$pack['GST'];
//                                 $tds = ($com_amount/100)*$pack['TDS'];
//                                 $givenCom = $com_amount-$gst-$tds;
//                                 $update_bal = $crnt_bal-$givenCom;
//                               }
//                               else{
//                                 $com_amount = $com;
//                                 $gst = ($com_amount/100)*$pack['GST'];
//                                 $tds = ($com_amount/100)*$pack['TDS'];
//                                 $givenCom = $com_amount-$gst-$tds;
//                                 $update_bal = $crnt_bal+$givenCom;
//                               }
//                         }
//                         else{
//                             $com_amount = 0;
//                             $gst = 0;
//                             $tds = 0;
//                             $givenCom = 0;
//                             $update_bal = $crnt_bal;
//                         }
                    
                    
//                     // $com_amount2 = ($trans['AMOUNT']/100)*$com2;
//                     // $update_bal2 = $crnt_bal2+$com_amount2;
                    
                    
                    
                    
//                     $con->query("update user set MAIN_BAL='$update_bal'  where ID='$owner'");
                    
//                     $con->query("INSERT INTO `commission_report`(`SERVICE`, `REFFRENCE`, `USER_ID`, `USER_TYPE`, `AMOUNT`, `COMMISSION`, `GST`, `TDS`, `TIME`) VALUES ('Recharge','$ref_id','$owner','$us_type','".$trans['AMOUNT']."','$givenCom','$gst','$tds','$time')");
                   
//                     // $con->query("INSERT INTO `commission_report`(`SERVICE`, `REFFRENCE`, `USER_ID`, `USER_TYPE`, `AMOUNT`, `COMMISSION`, `TIME`) VALUES ('Recharge','$ref_id','$owner','$us_type','".$trans['AMOUNT']."','$com_amount','$time')");
                    
                    
//                     insert_allreport($owner, $ref_id , "Recharge Commission" , $crnt_bal2  , $update_bal , $givenCom , "Credit" , "Recharge Transaction Commission", $ip_address, $device);
//                     // print_r($user2);
//                     if(strtolower($owner2) == "admin"){
//                         break;
//                     }
//             }
//         }
    
//     // return true;
// }


function deduct_com($ref_id , $user_id , $usertype, $ip_address, $device){
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
        insert_allreport($user_id  ,$ref_id , "Recharge Failed Commission" , $crnt_bal  , $update_bal , $com_amount , "Debit" , "Recharge Failed Transaction Commission", $ip_address, $device);
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
                    insert_allreport($owner  ,$ref_id , "Recharge Failed Commission" , $crnt_bal2  , $update_bal2 , $com_amount2 , "Debit" , "Recharge Failed Transaction Commission", $ip_address, $device);
                    // print_r($user2);
                    if(strtolower($owner2) == "admin"){
                        break;
                    }
            }
        }
    
    // return true;
}






?>