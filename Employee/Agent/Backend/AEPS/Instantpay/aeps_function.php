<?php
function check_aeps_user($user_id , $user_type){
    global $con;
    global $paysprint;
    global $user;
    $user = $con->query("select * from instant_aeps_merchants where USER_ID='$user_id' and OUTID<>'' ");
     if($user->num_rows == 0){
         return $user->num_rows;
     }
     else{
         return $user->fetch_assoc();
     }
    //   return "select * from AEPS_user where USER_ID='$user_id' and USER_TYPE='$user_type'";
}
function encryptaeps($data){
      global $paysprint;

        $encryptionKey="938ac4ed3f61ceb4938ac4ed3f61ceb4";
        $ivlen = openssl_cipher_iv_length('aes-256-cbc');
        $iv = openssl_random_pseudo_bytes($ivlen);
        $ciphertext = openssl_encrypt($data,'aes-256-cbc', $encryptionKey, OPENSSL_RAW_DATA, $iv);
        $encryptedData = base64_encode($iv . $ciphertext);
        return $encryptedData;
}



function getbank(){
    global $paysprint,$usid,$con;
    
        $subuser = $con->query("select * from instant_aeps_merchants where USER_ID='$usid' and OUTID<>'' ")->fetch_assoc();
      
    $curl = curl_init();
    $token = create_token();
    curl_setopt_array($curl, array(
      CURLOPT_URL =>  "https://api.instantpay.in/fi/aeps/banks",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'GET',
      CURLOPT_HTTPHEADER => array(
        "Accept: application/json",
        "Content-Type: application/json",
        "X-Ipay-Auth-Code: 1",
        "X-Ipay-Client-Id: YWY3OTAzYzNlM2ExZTJlOVX4sAN3V5eJmLO2VUng6oE=",
        "X-Ipay-Outlet-Id: ".$subuser['OUTID'],
        "X-Ipay-Client-Secret: 16bf5dca78b6eff629416f8ddb9846be966e3dd93093807ed186b2ca3f1b61a4",
        "X-Ipay-Endpoint-Ip: 101.53.133.96",
      ),
    ));
    
    $response = curl_exec($curl);
    curl_close($curl);
    return $response;
}


function get_aeps_charge($id , $amount){
    global $con;
     $cm_pk_rw = $con->query("select * from slab_commission where COMM_PACK_ID='$id' order by ID asc");
    while($dt = $cm_pk_rw->fetch_assoc()){
        // print_r($dt);
            if($amount >= $dt['MIN_AMOUNT'] && $amount <= $dt['MAX_AMOUNT']){
                $plan_id = $dt['ID'];
                break;
            }
        }
    $plan_dt = $con->query("select * from slab_commission where ID='$plan_id'")->fetch_assoc();
    $charge = $plan_dt['COMMISSION_AMOUNT'];
    return $charge;
}


// give_aeps_com("cQ4ky8VD" , "136" , "46");
//retialer commission 
function give_aeps_com($ref_id , $user_id , $usertype){
        global $con;
    
        $time = date("Y-m-d g:i:s A");
        $user_type_rows = $con->query("select * from user_type ")->num_rows;
        $trans = $con->query("select * from aeps_transactions where REFFRENCE_ID='$ref_id'")->fetch_assoc();
        
        //fetch user and its owner distributer and master distributer
        $user = $con->query("select * from user  where ID='$user_id' and USER_TYPE='46'")->fetch_assoc();
        $ds_id = $user['OWNER_ID'];
        $ds_data =  $con->query("select * from user  where ID='$ds_id' and USER_TYPE='47'")->fetch_assoc();
        
        //fetch balance of all
        $us_main_bal = $user['MAIN_BAL'];
        $us_aeps_bal = $user['AEPS_BAL'];
        $ds_aeps_bal = $ds_data['AEPS_BAL'];
        
        //fetch commission package id of retailer
        $com_id = $user['AEPS_COMM'];
        //check slab commission package
          $cm_pk_rw = $con->query("select * from slab_commission where COMM_PACK_ID='$com_id' order by ID asc");
        //code for fetch perticuler slab for transaction amount
            while($dt = $cm_pk_rw->fetch_assoc()){
                    if($trans['AMOUNT'] >= $dt['MIN_AMOUNT'] && $trans['AMOUNT']  <= $dt['MAX_AMOUNT']){
                        $plan_id = $dt['ID'];
                        break;
                    }
                }
            // get full detail of the slab row
            $pack = $con->query("select * from slab_commission where ID='$plan_id'")->fetch_assoc();
            // print_r($pack);
        //check commision type 
        if($pack['TYPE'] == "PERCENTAGE"){
            $com = $pack['AMOUNT'];
            $charge = $pack['CHARGE'];
            $ds_com = $pack['DS_COM'];
            
            //check amount commission type
            if($pack['AMOUNT_TYPE'] == "DEBIT"){
                $com_amount = ($trans['AMOUNT']/100)*$com; // user commission
                $ds_com_amount = ($trans['AMOUNT']/100)*$ds_com; // ds commission
                
                //User Balance Managment//
                $charge_amount = ($trans['AMOUNT']/100)*$charge;
                $aepsBal = $us_aeps_bal - $charge_amount;
                $crnt_bal = $us_main_bal;
                $gst = ($com_amount/100)*$pack['GST'];
                $tds = ($com_amount/100)*$pack['TDS'];
                $givenCom = $com_amount-$gst-$tds;
                $update_bal = $crnt_bal-$givenCom;
                
                //Ds Balance Managment//
                $ds_gst = ($ds_com_amount/100)*$pack['GST'];
                $ds_tds = ($ds_com_amount/100)*$pack['TDS'];
                $ds_givenCom = $ds_com_amount-$ds_gst-$ds_tds;
                $ds_update_bal = $ds_aeps_bal-$ds_givenCom;
            }
            else{
                $com_amount = ($trans['AMOUNT']/100)*$com; // user commission
                $ds_com_amount = ($trans['AMOUNT']/100)*$ds_com; // ds commission
                
               //User Balance Managment//
                $charge_amount = ($trans['AMOUNT']/100)*$charge;
                $aepsBal = $us_aeps_bal - $charge_amount;
                $crnt_bal = $us_main_bal;
                $gst = ($com_amount/100)*$pack['GST'];
                $tds = ($com_amount/100)*$pack['TDS'];
                $givenCom = $com_amount-$gst-$tds;
                $update_bal = $crnt_bal+$givenCom;
                
                //Ds Balance Managment//
                $ds_gst = ($ds_com_amount/100)*$pack['GST'];
                $ds_tds = ($ds_com_amount/100)*$pack['TDS'];
                $ds_givenCom = $ds_com_amount-$ds_gst-$ds_tds;
                $ds_update_bal = $ds_aeps_bal+$ds_givenCom;
                
            }
        }
        else if($pack['TYPE'] == "FLAT"){
            $com = $pack['AMOUNT'];
            $charge = $pack['CHARGE'];
            $ds_com = $pack['DS_COM'];
            $ms_com = $pack['MS_COM'];
            
              if($pack['AMOUNT_TYPE'] == "DEBIT"){
                $com_amount = $com; // user commission 
                $ds_com_amount = $ds_com; // ds commission
                
                // User Balance Managment//
                $charge_amount = $charge;
                $crnt_bal = $us_main_bal - $charge_amount;
                $gst = ($com_amount/100)*$pack['GST'];
                $tds = ($com_amount/100)*$pack['TDS'];
                $givenCom = $com_amount-$gst-$tds;
                $update_bal = $crnt_bal-$givenCom;
                
                //Ds Balance Managment// 
                $ds_gst = ($ds_com_amount/100)*$pack['GST'];
                $ds_tds = ($ds_com_amount/100)*$pack['TDS'];
                $ds_givenCom = $ds_com_amount-$ds_gst-$ds_tds;
                $ds_update_bal = $ds_aeps_bal-$ds_givenCom;
              }
              else{
                $com_amount = $com; // user commission 
                $ds_com_amount = $ds_com; // ds commission
                
                // User Balance Managment//
                $charge_amount = $charge;
                $crnt_bal = $us_main_bal - $charge_amount;
                $gst = ($com_amount/100)*$pack['GST'];
                $tds = ($com_amount/100)*$pack['TDS'];
                $givenCom = $com_amount-$gst-$tds;
                $update_bal = $crnt_bal+$givenCom;
                
                //Ds Balance Managment// 
                $ds_gst = ($ds_com_amount/100)*$pack['GST'];
                $ds_tds = ($ds_com_amount/100)*$pack['TDS'];
                $ds_givenCom = $ds_com_amount-$ds_gst-$ds_tds;
                $ds_update_bal = $ds_aeps_bal+$ds_givenCom;
                
              }
        }
        else{
             // User Balance Managment//
            $com_amount = 0;
            $charge_amount = 0;
            $crnt_bal = $us_main_bal;
            $gst = 0;
            $tds = 0;
            $givenCom = 0;
            $update_bal = $crnt_bal;
            
            //Ds Balance Managment// 
            $ds_gst = 0;
            $ds_tds = 0;
            $ds_givenCom = 0;
            $ds_update_bal = $ds_aeps_bal;
        }
        
        //Inser into commission report
         $con->query("INSERT INTO `commission_report`(`SERVICE`, `REFFRENCE`, `USER_ID`, `USER_TYPE`, `AMOUNT`, `COMMISSION`,`GST` ,`TDS`, `TIME`) 
                    VALUES ('AEPS','$ref_id','$user_id','46','".$trans['AMOUNT']."','$givenCom','$gst' ,'$tds' ,'$time')");
         
         $con->query("INSERT INTO `commission_report`(`SERVICE`, `REFFRENCE`, `USER_ID`, `USER_TYPE`, `AMOUNT`, `COMMISSION`,`GST` ,`TDS`, `TIME`) 
                    VALUES ('AEPS','$ref_id','$ds_id','47','".$trans['AMOUNT']."','$ds_givenCom','$ds_gst' ,'$ds_tds' ,'$time')");
                    
                    
        // insert_allreport($user_id  ,$ref_id , "AEPS Charge" ,$us_main_bal , $crnt_bal , $charge_amount , "Debit" , "AEPS Transaction Charge");
        $con->query("update user set MAIN_BAL='$update_bal'  where ID='$user_id' ");
        insert_allreport($user_id  ,$ref_id , "AEPS Commission" ,$crnt_bal , $update_bal , $givenCom , $pack['AMOUNT_TYPE'] , "AEPS Transaction Commission" , "MAIN");
        $con->query("update user set AEPS_BAL='$ds_update_bal'  where ID='$ds_id' ");
        insert_allreport($ds_id  ,$ref_id , "AEPS Commission" ,$ds_aeps_bal , $ds_update_bal , $ds_givenCom , $pack['AMOUNT_TYPE'] , "AEPS Transaction Commission" , "MAIN");
        
}

function aadhar_com($ref_id , $user_id , $usertype){
        global $con;
    
        $time = date("Y-m-d g:i:s A");
        $user_type_rows = $con->query("select * from user_type ")->num_rows;
        $trans = $con->query("select * from aeps_transactions where REFFRENCE_ID='$ref_id'")->fetch_assoc();
        
        //fetch user and its owner distributer and master distributer
        $user = $con->query("select * from user  where ID='$user_id' and USER_TYPE='46'")->fetch_assoc();
        $ds_id = $user['OWNER_ID'];
        $ds_data =  $con->query("select * from user  where ID='$ds_id' and USER_TYPE='47'")->fetch_assoc();
        
        //fetch balance of all
        $us_main_bal = $user['MAIN_BAL'];
        $ds_aeps_bal = $ds_data['AEPS_BAL'];
        
        //fetch commission package id of retailer
        $com_id = $user['AADHAR_COMM'];
        //check slab commission package
          $cm_pk_rw = $con->query("select * from slab_commission where COMM_PACK_ID='$com_id' order by ID asc");
        //code for fetch perticuler slab for transaction amount
            while($dt = $cm_pk_rw->fetch_assoc()){
                    if($trans['AMOUNT'] >= $dt['MIN_AMOUNT'] && $trans['AMOUNT']  <= $dt['MAX_AMOUNT']){
                        $plan_id = $dt['ID'];
                        break;
                    }
                }
            // get full detail of the slab row
            $pack = $con->query("select * from slab_commission where ID='$plan_id'")->fetch_assoc();
            // print_r($pack);
        //check commision type 
        if($pack['TYPE'] == "PERCENTAGE"){
            $com = $pack['AMOUNT'];
            $charge = $pack['CHARGE'];
            $ds_com = $pack['DS_COM'];
            
            //check amount commission type
            if($pack['AMOUNT_TYPE'] == "DEBIT"){
                $com_amount = ($trans['AMOUNT']/100)*$com; // user commission
                $ds_com_amount = ($trans['AMOUNT']/100)*$ds_com; // ds commission
                
                //User Balance Managment//
                $charge_amount = ($trans['AMOUNT']/100)*$charge;
                $crnt_bal = $us_main_bal - $charge_amount;
                $gst = ($com_amount/100)*$pack['GST'];
                $tds = ($com_amount/100)*$pack['TDS'];
                $givenCom = $com_amount+$gst+$tds;
                $update_bal = $crnt_bal-$givenCom;
                
                //Ds Balance Managment//
                $ds_gst = ($ds_com_amount/100)*$pack['GST'];
                $ds_tds = ($ds_com_amount/100)*$pack['TDS'];
                $ds_givenCom = $ds_com_amount+$ds_gst+$ds_tds;
                $ds_update_bal = $ds_aeps_bal-$ds_givenCom;
            }
            else{
                $com_amount = ($trans['AMOUNT']/100)*$com; // user commission
                $ds_com_amount = ($trans['AMOUNT']/100)*$ds_com; // ds commission
                
               //User Balance Managment//
                $charge_amount = ($trans['AMOUNT']/100)*$charge;
                $crnt_bal = $us_main_bal - $charge_amount;
                $gst = ($com_amount/100)*$pack['GST'];
                $tds = ($com_amount/100)*$pack['TDS'];
                $givenCom = $com_amount+$gst+$tds;
                $update_bal = $crnt_bal+$givenCom;
                
                //Ds Balance Managment//
                $ds_gst = ($ds_com_amount/100)*$pack['GST'];
                $ds_tds = ($ds_com_amount/100)*$pack['TDS'];
                $ds_givenCom = $ds_com_amount+$ds_gst+$ds_tds;
                $ds_update_bal = $ds_aeps_bal+$ds_givenCom;
            }
        }
        else if($pack['TYPE'] == "FLAT"){
            $com = $pack['AMOUNT'];
            $charge = $pack['CHARGE'];
            $ds_com = $pack['DS_COM'];
              if($pack['AMOUNT_TYPE'] == "DEBIT"){
                $com_amount = $com; // user commission 
                $ds_com_amount = $ds_com; // ds commission 
                
                // User Balance Managment//
                $charge_amount = $charge;
                $crnt_bal = $us_main_bal - $charge_amount;
                $gst = ($com_amount/100)*$pack['GST'];
                $tds = ($com_amount/100)*$pack['TDS'];
                $givenCom = $com_amount+$gst+$tds;
                $update_bal = $crnt_bal-$givenCom;
                
                //Ds Balance Managment// 
                $ds_gst = ($ds_com_amount/100)*$pack['GST'];
                $ds_tds = ($ds_com_amount/100)*$pack['TDS'];
                $ds_givenCom = $ds_com_amount+$ds_gst+$ds_tds;
                $ds_update_bal = $ds_aeps_bal-$ds_givenCom;
                
              }
              else{
                $com_amount = $com; // user commission 
                $ds_com_amount = $ds_com; // ds commission 
                
                // User Balance Managment//
                $charge_amount = $charge;
                $crnt_bal = $us_main_bal - $charge_amount;
                $gst = ($com_amount/100)*$pack['GST'];
                $tds = ($com_amount/100)*$pack['TDS'];
                $givenCom = $com_amount+$gst+$tds;
                $update_bal = $crnt_bal+$givenCom;
                
                //Ds Balance Managment// 
                $ds_gst = ($ds_com_amount/100)*$pack['GST'];
                $ds_tds = ($ds_com_amount/100)*$pack['TDS'];
                $ds_givenCom = $ds_com_amount+$ds_gst+$ds_tds;
                $ds_update_bal = $ds_aeps_bal+$ds_givenCom;
              }
        }
        else{
             // User Balance Managment//
            $com_amount = 0;
            $charge_amount = 0;
            $crnt_bal = $us_main_bal;
            $gst = 0;
            $tds = 0;
            $givenCom = 0;
            $update_bal = $crnt_bal;
            
            //Ds Balance Managment// 
            $ds_gst = 0;
            $ds_tds = 0;
            $ds_givenCom = 0;
            $ds_update_bal = $ds_aeps_bal;
        }
        
        //Inser into commission report
         $con->query("INSERT INTO `commission_report`(`SERVICE`, `REFFRENCE`, `USER_ID`, `USER_TYPE`, `AMOUNT`, `COMMISSION`,`GST` ,`TDS`, `TIME`) 
                    VALUES ('ADHAAR_PAY','$ref_id','$user_id','46','".$trans['AMOUNT']."','$givenCom','$gst' ,'$tds' ,'$time')");
         
         $con->query("INSERT INTO `commission_report`(`SERVICE`, `REFFRENCE`, `USER_ID`, `USER_TYPE`, `AMOUNT`, `COMMISSION`,`GST` ,`TDS`, `TIME`) 
                    VALUES ('ADHAAR_PAY','$ref_id','$ds_id','47','".$trans['AMOUNT']."','$ds_givenCom','$ds_gst' ,'$ds_tds' ,'$time')");
        
        // insert_allreport($user_id  ,$ref_id , "AEPS Charge" ,$us_main_bal , $crnt_bal , $charge_amount , "Debit" , "AEPS Transaction Charge");
        $con->query("update user set MAIN_BAL='$update_bal'  where ID='$user_id' ");
        insert_allreport($user_id  ,$ref_id , "ADHAAR_PAY Commission" ,$crnt_bal , $update_bal , $givenCom , $pack['AMOUNT_TYPE'] , "ADHAAR_PAY Transaction Commission", "MAIN");
        $con->query("update user set AEPS_BAL='$ds_update_bal'  where ID='$ds_id' ");
        insert_allreport($ds_id  ,$ref_id , "ADHAAR_PAY Commission" ,$ds_aeps_bal , $ds_update_bal , $ds_givenCom , $pack['AMOUNT_TYPE'] , "ADHAAR_PAY Transaction Commission", "MAIN");
        
}




function decrypt__adhar($encryption){
    $ciphering = "AES-128-CTR";
     $decryption_iv = 'ThisIsSecretKeyForEncrytionByJisneYeBnaya!@#$%^&*()';
    $decryption_key = "WebSpidy";
    // Using openssl_decrypt() function to decrypt the data 
    $decryption = openssl_decrypt(base64_decode($encryption), $ciphering, $decryption_key, 0, $decryption_iv);
    return $decryption;
}


?>