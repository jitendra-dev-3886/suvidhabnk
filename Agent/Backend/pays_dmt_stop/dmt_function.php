<?php
// session_start();

    function fetch_bene($mobile){
          global $paysprint;

        $token = create_token();
        $curl = curl_init();
        curl_setopt_array($curl, [
          CURLOPT_URL =>  $paysprint['URL']."/api/v1/service/dmt/beneficiary/registerbeneficiary/fetchbeneficiary",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => "{\"mobile\":$mobile}",
          CURLOPT_HTTPHEADER => [
                "Accept: application/json",
                "Content-Type: application/json",
                "Authorisedkey:".$paysprint['AUTHORISED_KEY'],
                "Token: ".$token
              ],
        ]);
        
        $response = curl_exec($curl);
        $err = curl_error($curl);
        
        curl_close($curl);
        
        if ($err) {
          return "cURL Error #:" . $err;
        } else {
          return $response;
        }
    }
function check_user($user_id , $user_type){
    global $con;
    $user = $con->query("select * from dmt_user where USER_ID='$user_id' and USER_TYPE='$user_type'");
      return $user->num_rows;
    //   return "select * from dmt_user where USER_ID='$user_id' and USER_TYPE='$user_type'";
}
function get_dmt_charge($id , $amount){
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

//retialer commission 
function give_dmt_com($ref_id , $user_id , $usertype){
        global $con;
    
        $time = date("Y-m-d g:i:s A");
        $user_type_rows = $con->query("select * from user_type ")->num_rows;
        $trans = $con->query("select * from dmt_transactions where REFFRENCE_ID='$ref_id'")->fetch_assoc();
        
        //fetch user and its owner distributer and master distributer
        $user = $con->query("select * from user  where ID='$user_id' and USER_TYPE='46'")->fetch_assoc();
        $ds_id = $user['OWNER_ID'];
        $ds_data =  $con->query("select * from user  where ID='$ds_id' and USER_TYPE='47'")->fetch_assoc();
        $ms_id = $ds_data['OWNER_ID'];
        $ms_data =  $con->query("select * from user where ID='$ms_id' and USER_TYPE='48'")->fetch_assoc();
        
        //fetch balance of all
        $us_main_bal = $user['MAIN_BAL'];
        $ds_aeps_bal = $ds_data['AEPS_BAL'];
        $ms_main_bal = $ms_data['MAIN_BAL'];
        
        //fetch commission package id of retailer
        $com_id = $user['DMT_COMM'];
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
            $ms_com = $pack['MS_COM'];
            
            //check amount commission type
            if($pack['AMOUNT_TYPE'] == "DEBIT"){
                $com_amount = ($trans['AMOUNT']/100)*$com; // user commission
                $ds_com_amount = ($trans['AMOUNT']/100)*$ds_com; // ds commission
                $ms_com_amount = ($trans['AMOUNT']/100)*$ms_com; // ms commission
                
                //User Balance Managment//
                $charge_amount = ($trans['AMOUNT']/100)*$charge;
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
                $charge_amount = ($trans['AMOUNT']/100)*$charge;
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
                
                
                //Ds Balance Managment//
                $ms_gst = ($ms_com_amount/100)*$pack['GST'];
                $ms_tds = ($ms_com_amount/100)*$pack['TDS'];
                $ms_givenCom = $ms_com_amount-$ms_gst-$ms_tds;
                $ms_update_bal = $ms_main_bal+$ms_givenCom;
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
                $ms_com_amount = $ms_com; //ms commission
                
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
        // "dsopBal" => number_format($ds_aeps_bal , 2),
        // "msopBal" => number_format($ms_main_bal , 2),
        // "charge" => number_format($charge_amount , 2),
        // "clBal" => number_format($update_bal , 2),
        // "ds_clBal" => number_format($ds_update_bal , 2),
        // "ms_clBal" => number_format($ms_update_bal , 2),
        // ]);
        
        //update the user main balance
        $con->query("update user set MAIN_BAL='$update_bal'  where ID='$user_id' ");
        $con->query("update user set AEPS_BAL='$ds_update_bal'  where ID='$ds_id' ");
        $con->query("update user set MAIN_BAL='$ms_update_bal'  where ID='$ms_id' ");
        
        //Inser into commission report
         $con->query("INSERT INTO `commission_report`(`SERVICE`, `REFFRENCE`, `USER_ID`, `USER_TYPE`, `AMOUNT`, `COMMISSION`,`GST` ,`TDS`, `TIME`) 
                    VALUES ('DMT','$ref_id','$user_id','46','".$trans['AMOUNT']."','$givenCom','$gst' ,'$tds' ,'$time')");
         
         $con->query("INSERT INTO `commission_report`(`SERVICE`, `REFFRENCE`, `USER_ID`, `USER_TYPE`, `AMOUNT`, `COMMISSION`,`GST` ,`TDS`, `TIME`) 
                    VALUES ('DMT','$ref_id','$ds_id','47','".$trans['AMOUNT']."','$ds_givenCom','$ds_gst' ,'$ds_tds' ,'$time')");
        
         $con->query("INSERT INTO `commission_report`(`SERVICE`, `REFFRENCE`, `USER_ID`, `USER_TYPE`, `AMOUNT`, `COMMISSION`,`GST` ,`TDS`, `TIME`) 
                    VALUES ('DMT','$ref_id','$ms_id','48','".$trans['AMOUNT']."','$ms_givenCom','$ms_gst' ,'$ms_tds' ,'$time')");
        
        // Insert All Report
        insert_allreport($user_id  ,$ref_id , "DMT Charge" ,$us_main_bal , $crnt_bal , $charge_amount , "Debit" , "DMT Transaction Charge");
        insert_allreport($user_id  ,$ref_id , "DMT Commission" ,$crnt_bal , $update_bal , $givenCom , $pack['AMOUNT_TYPE'] , "DMT Transaction Commission");
        insert_allreport($ds_id  ,$ref_id , "DMT Commission" ,$ds_aeps_bal , $ds_update_bal , $ds_givenCom , $pack['AMOUNT_TYPE'] , "DMT Transaction Commission");
        insert_allreport($ms_id  ,$ref_id , "DMT Commission" ,$ms_main_bal , $ms_update_bal , $ms_givenCom , $pack['AMOUNT_TYPE'] , "DMT Transaction Commission");
    // return true;
}


// ds commission
function give_ds_dmt_com($ref_id , $user_id , $usertype){
        global $con;
        
        $time = date("Y-m-d g:i:s A");
        $user_type_rows = $con->query("select * from user_type ")->num_rows;
        $trans = $con->query("select * from dmt_transactions where REFFRENCE_ID='$ref_id'")->fetch_assoc();
        
        //fetch user and its owner master distributer
        $user = $con->query("select * from user  where ID='$user_id' and USER_TYPE='47'")->fetch_assoc();
        $ms_id = $user['OWNER_ID'];
        $ms_data =  $con->query("select * from user where ID='$ms_id' and USER_TYPE='48'")->fetch_assoc();
        
        //fetch balance of all
        $us_main_bal = $user['MAIN_BAL'];
        $ms_main_bal = $ms_data['MAIN_BAL'];
        
        //fetch commission package id of retailer
        $com_id = $user['DMT_COMM'];
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
            $com = $pack['DS_COM'];
            $charge = $pack['CHARGE'];
            $ms_com = $pack['MS_COM'];
            
            //check amount commission type
            if($pack['AMOUNT_TYPE'] == "DEBIT"){
                $com_amount = ($trans['AMOUNT']/100)*$com; // user commission
                $ms_com_amount = ($trans['AMOUNT']/100)*$ms_com; // ms commission
                
                //User Balance Managment//
                $charge_amount = ($trans['AMOUNT']/100)*$charge;
                $crnt_bal = $us_main_bal - $charge_amount;
                $gst = ($com_amount/100)*$pack['GST'];
                $tds = ($com_amount/100)*$pack['TDS'];
                $givenCom = $com_amount-$gst-$tds;
                $update_bal = $crnt_bal-$givenCom;
                
                //Ms Balance Managment//
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
                $charge_amount = ($trans['AMOUNT']/100)*$charge;
                $crnt_bal = $us_main_bal - $charge_amount;
                $gst = ($com_amount/100)*$pack['GST'];
                $tds = ($com_amount/100)*$pack['TDS'];
                $givenCom = $com_amount-$gst-$tds;
                $update_bal = $crnt_bal+$givenCom;
                
                //Ms Balance Managment//
                $ms_gst = ($ms_com_amount/100)*$pack['GST'];
                $ms_tds = ($ms_com_amount/100)*$pack['TDS'];
                $ms_givenCom = $ms_com_amount-$ms_gst-$ms_tds;
                $ms_update_bal = $ms_main_bal+$ms_givenCom;
            }
        }
        else if($pack['TYPE'] == "FLAT"){
            $com = $pack['DS_COM'];
            $charge = $pack['CHARGE'];
            $ms_com = $pack['MS_COM'];
            
              if($pack['AMOUNT_TYPE'] == "DEBIT"){
                $com_amount = $com; // user commission 
                $ds_com_amount = $ds_com; // ds commission 
                $ms_com_amount = $ms_com; //ms commission
                
                // User Balance Managment//
                $charge_amount = $charge;
                $crnt_bal = $us_main_bal - $charge_amount;
                $gst = ($com_amount/100)*$pack['GST'];
                $tds = ($com_amount/100)*$pack['TDS'];
                $givenCom = $com_amount-$gst-$tds;
                $update_bal = $crnt_bal-$givenCom;
                
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
                $charge_amount = $charge;
                $crnt_bal = $us_main_bal - $charge_amount;
                $gst = ($com_amount/100)*$pack['GST'];
                $tds = ($com_amount/100)*$pack['TDS'];
                $givenCom = $com_amount-$gst-$tds;
                $update_bal = $crnt_bal+$givenCom;
                
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
            $charge_amount = 0;
            $crnt_bal = $us_main_bal;
            $gst = 0;
            $tds = 0;
            $givenCom = 0;
            $update_bal = $crnt_bal;
            
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
        // "dsopBal" => number_format($ds_aeps_bal , 2),
        // "msopBal" => number_format($ms_main_bal , 2),
        // "charge" => number_format($charge_amount , 2),
        // "clBal" => number_format($update_bal , 2),
        // "ds_clBal" => number_format($ds_update_bal , 2),
        // "ms_clBal" => number_format($ms_update_bal , 2),
        // ]);
        
        //update the user main balance
        $con->query("update user set MAIN_BAL='$update_bal'  where ID='$user_id' ");
        $con->query("update user set MAIN_BAL='$ms_update_bal'  where ID='$ms_id' ");
        
        //Inser into commission report
         $con->query("INSERT INTO `commission_report`(`SERVICE`, `REFFRENCE`, `USER_ID`, `USER_TYPE`, `AMOUNT`, `COMMISSION`,`GST` ,`TDS`, `TIME`) 
                    VALUES ('DMT','$ref_id','$user_id','47','".$trans['AMOUNT']."','$givenCom','$gst' ,'$tds' ,'$time')");
         
         $con->query("INSERT INTO `commission_report`(`SERVICE`, `REFFRENCE`, `USER_ID`, `USER_TYPE`, `AMOUNT`, `COMMISSION`,`GST` ,`TDS`, `TIME`) 
                    VALUES ('DMT','$ref_id','$ms_id','48','".$trans['AMOUNT']."','$ms_givenCom','$ms_gst' ,'$ms_tds' ,'$time')");
        
        // Insert All Report
        insert_allreport($user_id  ,$ref_id , "DMT Charge" ,$us_main_bal , $crnt_bal , $charge_amount , "Debit" , "DMT Transaction Charge");
        insert_allreport($user_id  ,$ref_id , "DMT Commission" ,$crnt_bal , $update_bal , $givenCom , $pack['AMOUNT_TYPE'] , "DMT Transaction Commission");
        insert_allreport($ms_id  ,$ref_id , "DMT Commission" ,$ms_main_bal , $ms_update_bal , $ms_givenCom , $pack['AMOUNT_TYPE'] , "DMT Transaction Commission");
    // return true;
}


// ms commission
function give_ms_dmt_com($ref_id , $user_id , $usertype){
        global $con;
        $time = date("Y-m-d g:i:s A");
        $user_type_rows = $con->query("select * from user_type ")->num_rows;
        $trans = $con->query("select * from dmt_transactions where REFFRENCE_ID='$ref_id'")->fetch_assoc();
        
        //fetch user and its owner distributer and master distributer
        $user = $con->query("select * from user  where ID='$user_id' and USER_TYPE='48'")->fetch_assoc();
        
        //fetch balance of all
        $us_main_bal = $user['MAIN_BAL'];
        
        //fetch commission package id of retailer
        $com_id = $user['DMT_COMM'];
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
            $com = $pack['MS_COM'];
            $charge = $pack['CHARGE'];
            
            //check amount commission type
            if($pack['AMOUNT_TYPE'] == "DEBIT"){
                $com_amount = ($trans['AMOUNT']/100)*$com; // user commission
                $ds_com_amount = ($trans['AMOUNT']/100)*$ds_com; // ds commission
                $ms_com_amount = ($trans['AMOUNT']/100)*$ms_com; // ms commission
                
                //User Balance Managment//
                $charge_amount = ($trans['AMOUNT']/100)*$charge;
                $crnt_bal = $us_main_bal - $charge_amount;
                $gst = ($com_amount/100)*$pack['GST'];
                $tds = ($com_amount/100)*$pack['TDS'];
                $givenCom = $com_amount-$gst-$tds;
                $update_bal = $crnt_bal-$givenCom;
            }
            else{
                $com_amount = ($trans['AMOUNT']/100)*$com; // user commission
                $ds_com_amount = ($trans['AMOUNT']/100)*$ds_com; // ds commission
                $ms_com_amount = ($trans['AMOUNT']/100)*$ms_com; // ms commission
                
               //User Balance Managment//
                $charge_amount = ($trans['AMOUNT']/100)*$charge;
                $crnt_bal = $us_main_bal - $charge_amount;
                $gst = ($com_amount/100)*$pack['GST'];
                $tds = ($com_amount/100)*$pack['TDS'];
                $givenCom = $com_amount-$gst-$tds;
                $update_bal = $crnt_bal+$givenCom;
            }
        }
        else if($pack['TYPE'] == "FLAT"){
            $com = $pack['MS_COM'];
            $charge = $pack['CHARGE'];
            
              if($pack['AMOUNT_TYPE'] == "DEBIT"){
                $com_amount = $com; // user commission 
                $ds_com_amount = $ds_com; // ds commission 
                $ms_com_amount = $ms_com; //ms commission
                
                // User Balance Managment//
                $charge_amount = $charge;
                $crnt_bal = $us_main_bal - $charge_amount;
                $gst = ($com_amount/100)*$pack['GST'];
                $tds = ($com_amount/100)*$pack['TDS'];
                $givenCom = $com_amount-$gst-$tds;
                $update_bal = $crnt_bal-$givenCom;
                
              }
              else{
                $com_amount = $com; // user commission 
                $ds_com_amount = $ds_com; // ds commission 
                $ms_com_amount = $ms_com; //ms commission
                
                // User Balance Managment//
                $charge_amount = $charge;
                $crnt_bal = $us_main_bal - $charge_amount;
                $gst = ($com_amount/100)*$pack['GST'];
                $tds = ($com_amount/100)*$pack['TDS'];
                $givenCom = $com_amount-$gst-$tds;
                $update_bal = $crnt_bal+$givenCom;
                
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
        }
        //update the user main balance
        $con->query("update user set MAIN_BAL='$update_bal'  where ID='$user_id' ");
        
        //Inser into commission report
         $con->query("INSERT INTO `commission_report`(`SERVICE`, `REFFRENCE`, `USER_ID`, `USER_TYPE`, `AMOUNT`, `COMMISSION`,`GST` ,`TDS`, `TIME`) 
                    VALUES ('DMT','$ref_id','$user_id','48','".$trans['AMOUNT']."','$givenCom','$gst' ,'$tds' ,'$time')");
                    
        // Insert All Report
        insert_allreport($user_id  ,$ref_id , "DMT Charge" ,$us_main_bal , $crnt_bal , $charge_amount , "Debit" , "DMT Transaction Charge");
        insert_allreport($user_id  ,$ref_id , "DMT Commission" ,$crnt_bal , $update_bal , $givenCom , $pack['AMOUNT_TYPE'] , "DMT Transaction Commission");
    // return true;
}


?>