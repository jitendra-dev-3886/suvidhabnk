<?php

// calculate the charge 
//retialer commission 
function calc_upi_com($amount , $user_id , $usertype){
        global $con;
    
        $time = date("Y-m-d g:i:s A");
        //fetch user and its owner distributer and master distributer
        $user = $con->query("select * from user  where ID='$user_id' and USER_TYPE='46'")->fetch_assoc();

        //fetch balance of all
        $us_main_bal = $user['MAIN_BAL'];
        
        //fetch commission package id of retailer
        $com_id = $user['UPI_COMM'];
        //check slab commission package
          $cm_pk_rw = $con->query("select * from slab_commission where COMM_PACK_ID='$com_id' order by ID asc");
        //code for fetch perticuler slab for transaction amount
            while($dt = $cm_pk_rw->fetch_assoc()){
                    if($amount >= $dt['MIN_AMOUNT'] && $amount  <= $dt['MAX_AMOUNT']){
                        $plan_id = $dt['ID'];
                        break;
                    }
                }
            // get full detail of the slab row
            $pack = $con->query("select * from slab_commission where ID='$plan_id'")->fetch_assoc();
 
        //check commision type 
        if($pack['TYPE'] == "PERCENTAGE"){
            $com = $pack['AMOUNT'];
            $charge = $pack['CHARGE'];
            $ds_com = $pack['DS_COM'];
            $ms_com = $pack['MS_COM'];
            
            //check amount commission type
            if($pack['AMOUNT_TYPE'] == "DEBIT"){
                //User Balance Managment//
                $charge_amount = ($amount/100)*$charge;
            }
            else{
               //User Balance Managment//
                $charge_amount = ($amount/100)*$charge;
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
              }
              else{
                $com_amount = $com; // user commission 
                
                // User Balance Managment//
                $charge_amount = $charge;
                $crnt_bal = $us_main_bal - $charge_amount;
              }
        }
        else{
             // User Balance Managment//
            $com_amount = 0;
            $charge_amount = 0;
            
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
        
        //Inser into commission report
        //  $con->query("INSERT INTO `commission_report`(`SERVICE`, `REFFRENCE`, `USER_ID`, `USER_TYPE`, `AMOUNT`, `COMMISSION`,`GST` ,`TDS`, `TIME`) 
        //             VALUES ('UPI','$ref_id','$user_id','46','".$trans['AMOUNT']."','$givenCom','$gst' ,'$tds' ,'$time')");
         
        //  $con->query("INSERT INTO `commission_report`(`SERVICE`, `REFFRENCE`, `USER_ID`, `USER_TYPE`, `AMOUNT`, `COMMISSION`,`GST` ,`TDS`, `TIME`) 
        //             VALUES ('UPI','$ref_id','$ds_id','47','".$trans['AMOUNT']."','$ds_givenCom','$ds_gst' ,'$ds_tds' ,'$time')");
                    
        // // Insert All Report
                                                                       
        // // for charge user
        // $con->query("update user set MAIN_BAL='$crnt_bal'  where ID='$user_id' ");
        // insert_allreport($user_id  ,$ref_id , "UPI Charge" ,$us_main_bal , $crnt_bal , $charge_amount , "Debit" , "UPI Transaction Charge" , "MAIN");
        
        // // for commission user
        // $con->query("update user set MAIN_BAL='$update_bal'  where ID='$user_id' ");
        // insert_allreport($user_id  ,$ref_id , "UPI Commission" ,$crnt_bal , $update_bal , $givenCom , $pack['AMOUNT_TYPE'] , "UPI Transaction Commission" , "MAIN");
        
        // // for commission owner
        // $con->query("update user set AEPS_BAL='$ds_update_bal'  where ID='$ds_id' ");
        // insert_allreport($ds_id  ,$ref_id , "UPI Commission" ,$ds_aeps_bal , $ds_update_bal , $ds_givenCom , $pack['AMOUNT_TYPE'] , "UPI Transaction Commission" , "AEPS");
    
        return $charge_amount;
    
}


//retialer commission 
function give_upi_com($ref_id , $user_id , $usertype){
        global $con;
    
        $time = date("Y-m-d g:i:s A");
        $user_type_rows = $con->query("select * from user_type ")->num_rows;
        $trans = $con->query("select * from upi_transactions where REFFRENCE_ID='$ref_id'")->fetch_assoc();
        
        //fetch user and its owner distributer and master distributer
        $user = $con->query("select * from user  where ID='$user_id' and USER_TYPE='46'")->fetch_assoc();
        $ds_id = $user['OWNER_ID'];
        $ds_data =  $con->query("select * from user  where ID='$ds_id' and USER_TYPE='47'")->fetch_assoc();
    
        //fetch balance of all
        $us_main_bal = $user['MAIN_BAL'];
        $ds_aeps_bal = $ds_data['AEPS_BAL'];
        
        //fetch commission package id of retailer
        $com_id = $user['UPI_COMM'];
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
        
        //Inser into commission report
         $con->query("INSERT INTO `commission_report`(`SERVICE`, `REFFRENCE`, `USER_ID`, `USER_TYPE`, `AMOUNT`, `COMMISSION`,`GST` ,`TDS`, `TIME`) 
                    VALUES ('UPI','$ref_id','$user_id','46','".$trans['AMOUNT']."','$givenCom','$gst' ,'$tds' ,'$time')");
         
         $con->query("INSERT INTO `commission_report`(`SERVICE`, `REFFRENCE`, `USER_ID`, `USER_TYPE`, `AMOUNT`, `COMMISSION`,`GST` ,`TDS`, `TIME`) 
                    VALUES ('UPI','$ref_id','$ds_id','47','".$trans['AMOUNT']."','$ds_givenCom','$ds_gst' ,'$ds_tds' ,'$time')");
                    
        // Insert All Report
                                                                       
        // for charge user
        $con->query("update user set MAIN_BAL='$crnt_bal'  where ID='$user_id' ");
        insert_allreport($user_id  ,$ref_id , "UPI Charge" ,$us_main_bal , $crnt_bal , $charge_amount , "Debit" , "UPI Transaction Charge" , "MAIN");
        
        // for commission user
        $con->query("update user set MAIN_BAL='$update_bal'  where ID='$user_id' ");
        insert_allreport($user_id  ,$ref_id , "UPI Commission" ,$crnt_bal , $update_bal , $givenCom , $pack['AMOUNT_TYPE'] , "UPI Transaction Commission" , "MAIN");
        
        // for commission owner
        $con->query("update user set AEPS_BAL='$ds_update_bal'  where ID='$ds_id' ");
        insert_allreport($ds_id  ,$ref_id , "UPI Commission" ,$ds_aeps_bal , $ds_update_bal , $ds_givenCom , $pack['AMOUNT_TYPE'] , "UPI Transaction Commission" , "AEPS");
        
        
    // return true;
}



//revert commission 
function revert_upi_com($ref_id , $user_id , $usertype){
        global $con;
    
        $time = date("Y-m-d g:i:s A");
        $user_type_rows = $con->query("select * from user_type ")->num_rows;
        $trans = $con->query("select * from upi_transactions where REFFRENCE_ID='$ref_id'")->fetch_assoc();
        
        //fetch user and its owner distributer and master distributer
        $user = $con->query("select * from user  where ID='$user_id' and USER_TYPE='46'")->fetch_assoc();
        $ds_id = $user['OWNER_ID'];
        $ds_data =  $con->query("select * from user  where ID='$ds_id' and USER_TYPE='47'")->fetch_assoc();
    
        //fetch balance of all
        $us_main_bal = $user['MAIN_BAL'];
        $ds_aeps_bal = $ds_data['AEPS_BAL'];
        
        //fetch commission package id of retailer
        $com_id = $user['UPI_COMM'];
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
                $crnt_bal = $us_main_bal + $charge_amount;
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
            else{
                $com_amount = ($trans['AMOUNT']/100)*$com; // user commission
                $ds_com_amount = ($trans['AMOUNT']/100)*$ds_com; // ds commission
                $ms_com_amount = ($trans['AMOUNT']/100)*$ms_com; // ms commission
                
               //User Balance Managment//
                $charge_amount = ($trans['AMOUNT']/100)*$charge;
                $crnt_bal = $us_main_bal + $charge_amount;
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
                $crnt_bal = $us_main_bal + $charge_amount;
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
              else{
                $com_amount = $com; // user commission 
                $ds_com_amount = $ds_com; // ds commission 
                $ms_com_amount = $ms_com; //ms commission
                
                // User Balance Managment//
                $charge_amount = $charge;
                $crnt_bal = $us_main_bal + $charge_amount;
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
        
        //Inser into commission report
         $con->query("INSERT INTO `commission_report`(`SERVICE`, `REFFRENCE`, `USER_ID`, `USER_TYPE`, `AMOUNT`, `COMMISSION`,`GST` ,`TDS`, `TIME`) 
                    VALUES ('UPI Refund','$ref_id','$user_id','46','".$trans['AMOUNT']."','$givenCom','$gst' ,'$tds' ,'$time')");
         
         $con->query("INSERT INTO `commission_report`(`SERVICE`, `REFFRENCE`, `USER_ID`, `USER_TYPE`, `AMOUNT`, `COMMISSION`,`GST` ,`TDS`, `TIME`) 
                    VALUES ('UPI Refund','$ref_id','$ds_id','47','".$trans['AMOUNT']."','$ds_givenCom','$ds_gst' ,'$ds_tds' ,'$time')");
                    
        // Insert All Report
                                                                       
        // for charge user
        $con->query("update user set MAIN_BAL='$crnt_bal'  where ID='$user_id' ");
        insert_allreport($user_id  ,$ref_id , "UPI Refund Charge" ,$us_main_bal , $crnt_bal , $charge_amount , "Debit" , "UPI Refund Transaction Charge" , "MAIN");
        
        // for commission user
        $con->query("update user set MAIN_BAL='$update_bal'  where ID='$user_id' ");
        insert_allreport($user_id  ,$ref_id , "UPI Refund Commission" ,$crnt_bal , $update_bal , $givenCom , $pack['AMOUNT_TYPE'] , "UPI Refund Transaction Commission" , "MAIN");
        
        // for commission owner
        $con->query("update user set AEPS_BAL='$ds_update_bal'  where ID='$ds_id' ");
        insert_allreport($ds_id  ,$ref_id , "UPI Refund Commission" ,$ds_aeps_bal , $ds_update_bal , $ds_givenCom , $pack['AMOUNT_TYPE'] , "UPI Refund Transaction Commission" , "AEPS");
        
        
    // return true;
}

?>