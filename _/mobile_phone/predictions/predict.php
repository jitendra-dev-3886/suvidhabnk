<?php

$id = $_POST['user_id'];
$usertype = $_POST['user_type'];
$trans = $_POST['amount'];
$pay_type = $_POST['pay_type'];

include("../includes/config.php");
include("../includes/fetch_data.php");



if($pay_type!=""){
    
    $comm_value =  $user['DMT_COMM'];


    $cm_pk_rw = $con->query("SELECT * FROM `slab_commission` WHERE COMM_PACK_ID='$comm_value' order by ID ASC");
    while($dt = $cm_pk_rw->fetch_assoc()){
        if($trans >= $dt['MIN_AMOUNT'] && $trans  <= $dt['MAX_AMOUNT']){
            $plan_id = $dt['ID'];
            break;
        }
    }
    
    
    $pack = $con->query("select * from slab_commission where ID='$plan_id'")->fetch_assoc();
    if($pack['TYPE'] == "PERCENTAGE"){
            $com = $pack['AMOUNT'];
            $charge = $pack['CHARGE'];
            $ds_com = $pack['DS_COM'];
            $ms_com = $pack['MS_COM'];
            
            //check amount commission type
            if($pack['AMOUNT_TYPE'] == "DEBIT"){
                $com_amount = ($trans/100)*$com; // user commission
                $ds_com_amount = ($trans/100)*$ds_com; // ds commission
                $ms_com_amount = ($trans/100)*$ms_com; // ms commission
                
                //User Balance Managment//
                $charge_amount = ($trans/100)*$charge;
                $crnt_bal = $us_main_bal - $charge_amount;
                $gst = ($com_amount/100)*$pack['GST'];
                $tds = ($com_amount/100)*$pack['TDS'];
                $givenCom = $com_amount-$gst-$tds;
                $update_bal = $crnt_bal-$givenCom;
                
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
                $com_amount = ($trans/100)*$com; // user commission
                $ds_com_amount = ($trans/100)*$ds_com; // ds commission
                $ms_com_amount = ($trans/100)*$ms_com; // ms commission
                
               //User Balance Managment//
                $charge_amount = ($trans/100)*$charge;
                $crnt_bal = $us_main_bal - $charge_amount;
                $gst = ($com_amount/100)*$pack['GST'];
                $tds = ($com_amount/100)*$pack['TDS'];
                $givenCom = $com_amount-$gst-$tds;
                $update_bal = $crnt_bal+$givenCom;
                
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
                $ds_update_bal = $ds_main_bal+$ds_givenCom;
                
                //Ms Balance Managment//
                $ms_gst = ($ms_com_amount/100)*$pack['GST'];
                $ms_tds = ($ms_com_amount/100)*$pack['TDS'];
                $ms_givenCom = $ms_com_amount-$ms_gst-$ds_tds;
                $ms_update_bal = $ms_main_bal+$ms_givenCom;
                
              }
        }
    
    
    
    
    
    
    
    $commission = $com;
    
    $charge_commission = $charge-$commission;
    
    if($charge ==null && $commission==null){
    
        $rs = json_encode(array("charge"=>"0" , "commission"=>"0", "charge_commission"=>"0"));
    }
    else{

        $charge = number_format($charge, 2, '.', '');
        $commission = number_format($commission, 2, '.', '');
        $charge_commission = number_format($charge_commission, 2, '.', '');
        $rs = json_encode(array("charge"=>$charge , "commission"=>$commission, "charge_commission"=>$charge_commission));
    }
    echo $rs;
         
}



?>