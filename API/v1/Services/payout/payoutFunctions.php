<?php
// calculate the charge 
//retialer commission 
function calc_com($amount , $user_id , $usertype){
        global $con;
    
        $time = date("Y-m-d g:i:s A");
        //fetch user and its owner distributer and master distributer
        $user = $con->query("select * from  api_user  where ID='$user_id'  ")->fetch_assoc();

        //fetch balance of all
        $us_main_bal = $user['AEPS_BAL'];
        
        //fetch commission package id of retailer
        $com_id = $user['PAYOUT_COMM'];
        
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
        return $charge_amount;
    
}

function give_payout_com($ref_id , $user_id , $usertype){
    global $con;
  
        $time = date("Y-m-d g:i:s A");
        $trans = $con->query("select * from payout_transaction where REFFRENCE_ID='$ref_id' and APITYPE='API' ")->fetch_assoc();
        
        //fetch user and its owner distributer and master distributer
        $user = $con->query("select * from api_user  where ID='$user_id' ")->fetch_assoc();
        
        //fetch balance of all
        $us_main_bal = $user['MAIN_BAL'];
        $us_aeps_bal = $user['AEPS_BAL'];
        
        //fetch commission package id of retailer
        $com_id = $user['PAYOUT_COMM'];
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
            
            //check amount commission type
            if($pack['AMOUNT_TYPE'] == "DEBIT"){
                $com_amount = ($trans['AMOUNT']/100)*$com; // user commission
                $ds_com_amount = ($trans['AMOUNT']/100)*$ds_com; // ds commission
                $ms_com_amount = ($trans['AMOUNT']/100)*$ms_com; // ms commission
                
                //User Balance Managment//
                $charge_amount = ($trans['AMOUNT']/100)*$charge;
                $aepsBal = $us_aeps_bal - $charge_amount;
                $crnt_bal = $us_main_bal;
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
                $aepsBal = $us_aeps_bal - $charge_amount;
                $crnt_bal = $us_main_bal;
                $gst = ($com_amount/100)*$pack['GST'];
                $tds = ($com_amount/100)*$pack['TDS'];
                $givenCom = $com_amount-$gst-$tds;
                $update_bal = $crnt_bal+$givenCom;
            }
        }
        else if($pack['TYPE'] == "FLAT"){
            $com = $pack['AMOUNT'];
            $charge = $pack['CHARGE'];
            $ds_com = $pack['DS_COM'];
            $ms_com = $pack['MS_COM'];
            
              if($pack['AMOUNT_TYPE'] == "DEBIT"){
                $com_amount = $com;       // user commission 
                $ds_com_amount = $ds_com; // ds commission 
                $ms_com_amount = $ms_com; //ms commission
                
                // User Balance Managment//
                $charge_amount = $charge;
                $aepsBal = $us_aeps_bal - $charge_amount;
                $crnt_bal = $us_main_bal;
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
                $aepsBal = $us_aeps_bal - $charge_amount;
                $crnt_bal = $us_main_bal;
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
            $aepsBal =$us_aeps_bal;
            $crnt_bal = $us_main_bal;
            $gst = 0;
            $tds = 0;
            $givenCom = 0;
            $update_bal = $crnt_bal;
        }
        
        //Inser into commission report
         $con->query("INSERT INTO `commission_report`(`SERVICE`, `REFFRENCE`, `USER_ID`, `USER_TYPE`, `AMOUNT`, `COMMISSION`,`GST` ,`TDS`, `TIME` , `APITYPE` ) 
                    VALUES ('Payout Charge','$ref_id','$user_id','46','".$trans['AMOUNT']."','$charge_amount','0' ,'0' ,'$time' , 'API' )");
    
         $con->query("INSERT INTO `commission_report`(`SERVICE`, `REFFRENCE`, `USER_ID`, `USER_TYPE`, `AMOUNT`, `COMMISSION`,`GST` ,`TDS`, `TIME` , `APITYPE` ) 
                    VALUES ('Payout','$ref_id','$user_id','46','".$trans['AMOUNT']."','$givenCom','$gst' ,'$tds' ,'$time' , 'API' )");
         
        // Insert All Report
        $con->query("update api_user set AEPS_BAL='$aepsBal'  where ID='$user_id' ");
        insert_allreport($user_id  ,$ref_id , "Payout Charge" ,$us_aeps_bal , $aepsBal , $charge_amount , "Debit" , "Payout Transaction Charge", "AEPS");
        $con->query("update api_user set MAIN_BAL='$update_bal'  where ID='$user_id' ");
        insert_allreport($user_id  ,$ref_id , "Payout Commission" ,$crnt_bal , $update_bal , $givenCom , $pack['AMOUNT_TYPE'] , "Payout Transaction Commission" , "MAIN");
        
}


function revert_payout_com($ref_id , $user_id , $usertype){
    global $con;
    // echo "Payout com working \n";
$time = date("Y-m-d g:i:s A");
        $user_type_rows = $con->query("select * from user_type ")->num_rows;
        $trans = $con->query("select * from payout_transaction where REFFRENCE_ID='$ref_id' and APITYPE='API' ")->fetch_assoc();
        
        //fetch user and its owner distributer and master distributer
        $user = $con->query("select * from api_user  where ID='$user_id' ")->fetch_assoc();
        
        //fetch balance of all
        $us_main_bal = $user['MAIN_BAL'];
        $us_aeps_bal = $user['AEPS_BAL'];
        
        //fetch commission package id of retailer
        $com_id = $user['PAYOUT_COMM'];
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
            
            //check amount commission type
            if($pack['AMOUNT_TYPE'] == "DEBIT"){
                $com_amount = ($trans['AMOUNT']/100)*$com; // user commission
                
                //User Balance Managment//
                $charge_amount = ($trans['AMOUNT']/100)*$charge;
                $aepsBal = $us_aeps_bal + $charge_amount;
                $crnt_bal = $us_main_bal;
                $gst = ($com_amount/100)*$pack['GST'];
                $tds = ($com_amount/100)*$pack['TDS'];
                $givenCom = $com_amount-$gst-$tds;
                $update_bal = $crnt_bal+$givenCom;
            }
            else{
                $com_amount = ($trans['AMOUNT']/100)*$com; // user commission
                
               //User Balance Managment//
                $charge_amount = ($trans['AMOUNT']/100)*$charge;
                $aepsBal = $us_aeps_bal + $charge_amount;
                $crnt_bal = $us_main_bal;
                $gst = ($com_amount/100)*$pack['GST'];
                $tds = ($com_amount/100)*$pack['TDS'];
                $givenCom = $com_amount-$gst-$tds;
                $update_bal = $crnt_bal-$givenCom;
            }
        }
        else if($pack['TYPE'] == "FLAT"){
            $com = $pack['AMOUNT'];
            $charge = $pack['CHARGE'];
            $ds_com = $pack['DS_COM'];
            $ms_com = $pack['MS_COM'];
            
              if($pack['AMOUNT_TYPE'] == "DEBIT"){
                $com_amount = $com;       // user commission
                
                // User Balance Managment//
                $charge_amount = $charge;
                $aepsBal = $us_aeps_bal + $charge_amount;
                $crnt_bal = $us_main_bal;
                $gst = ($com_amount/100)*$pack['GST'];
                $tds = ($com_amount/100)*$pack['TDS'];
                $givenCom = $com_amount-$gst-$tds;
                $update_bal = $crnt_bal+$givenCom;
                
              }
              else{
                $com_amount = $com; // user commission
                
                // User Balance Managment//
                $charge_amount = $charge;
                $aepsBal = $us_aeps_bal + $charge_amount;
                $crnt_bal = $us_main_bal;
                $gst = ($com_amount/100)*$pack['GST'];
                $tds = ($com_amount/100)*$pack['TDS'];
                $givenCom = $com_amount-$gst-$tds;
                $update_bal = $crnt_bal-$givenCom;
              }
        }
        else{
             // User Balance Managment//
            $com_amount = 0;
            $charge_amount = 0;
            $aepsBal =$us_aeps_bal;
            $crnt_bal = $us_main_bal;
            $gst = 0;
            $tds = 0;
            $givenCom = 0;
            $update_bal = $crnt_bal;
        }
        
        //Inser into commission report
         $con->query("INSERT INTO `commission_report`(`SERVICE`, `REFFRENCE`, `USER_ID`, `USER_TYPE`, `AMOUNT`, `COMMISSION`,`GST` ,`TDS`, `TIME` , `APITYPE` ) 
                    VALUES ('Payout Refund Charge','$ref_id','$user_id','46','".$trans['AMOUNT']."','$charge_amount','0' ,'0' ,'$time' , 'API' )");
    
         $con->query("INSERT INTO `commission_report`(`SERVICE`, `REFFRENCE`, `USER_ID`, `USER_TYPE`, `AMOUNT`, `COMMISSION`,`GST` ,`TDS`, `TIME` , `APITYPE` ) 
                    VALUES ('Payout Refund','$ref_id','$user_id','46','".$trans['AMOUNT']."','$givenCom','$gst' ,'$tds' ,'$time' , 'API' )");
                    
        // Insert All Report
        $con->query("update api_user set AEPS_BAL='$aepsBal'  where ID='$user_id' ");
        insert_allreport($user_id  ,$ref_id , "Payout Refund Charge" ,$us_aeps_bal , $aepsBal , $charge_amount , "Credit" , "Payout Refund Transaction Charge", "AEPS");
        $con->query("update api_user set MAIN_BAL='$update_bal'  where ID='$user_id' ");
        insert_allreport($user_id  ,$ref_id , "Payout Refund Commission" ,$crnt_bal , $update_bal , $givenCom , "Debit" , "Payout Refund Transaction Commission" , "MAIN");
        
    // return true;
}
