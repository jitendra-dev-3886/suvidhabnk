<?php

    include("../includes/config.php");
    include("../includes/imagepaths.php");

    $user_id =  $_POST['user_id'];
    $user_type = $_POST['user_type'];

    $response  = array();
    $allreports = $con->query("SELECT * FROM `report` WHERE USER_ID='$user_id' ORDER BY ID DESC");
    if($allreports->num_rows > 0)
    {
        //loop untill all is fetched
        while($row = $allreports->fetch_assoc()){
                //data of row
                $index_id = $row['ID'];
                $re_user_id =$row['USER_ID']; 
                $amount_earlier = $row['PREVIOUS_AMOUNT'];
                $amount_left = $row['AFTER_AMOUNT'];
                $txn_id = $row['REFERENCE_ID'];
                $date = $row['DATE'];
                $amount = $row['AMOUNT'];
                $payment_type = $row['TRANS_TYPE'];
                $op_id = "";
                $onMobile = "";
                $logo = "";
                $operator_name = "";
                $user_mobile = "";
                $commission_amount = "";
                $status = "Pending";
                $json_response = "";
                $small_value = strtolower($payment_type);
                
                $user_select = $con->query("SELECT MOBILE FROM `user` WHERE ID='$re_user_id'")->fetch_assoc();
                $user_mobile = $user_select['MOBILE'];
                
                $comm_select = $con->query("SELECT * FROM `commission_report` WHERE REFFRENCE='$txn_id'")->fetch_assoc();
                $commission_amount = $comm_select['COMMISSION'];
                
                
                if(strpos($small_value, 'recharge') !== false) {
                    $detailreports = $con->query("SELECT * FROM `recharge_transaction` WHERE REFERENCE_ID='$txn_id'");
                    if($detailreports->num_rows > 0){
                        $row_detail = $detailreports->fetch_assoc();
                        $op_id = $row_detail['OPERATOR'];
                        $onMobile = $row_detail['MOBILE'];
                        $json_response_raw = json_decode($row_detail['RESPONSE']);
                        $json_response = json_decode($row_detail['RESPONSE']); 
                        $image_select = $con->query("SELECT * FROM `operator_list` WHERE OPERATOR_CODE='$op_id'")->fetch_assoc();
                        $logo = $opImagePath.$image_select['LOGO'];
                        $operator_name = $image_select['NAME'];
                        $code = trim($json_response_raw->response_code);
                        $stat = $json_response_raw->status;
                        if($stat == true && ($code==1 || $code==3)){
                            $status ="Success";
                        }else{
                            $status ="Failed";
                        }
                    }
                                     
                }
                
                    if (strpos($small_value, 'bbps') !== false) {
                    $detailreports = $con->query("SELECT * FROM `pay_bill_api` WHERE REFFRENCE_ID='$txn_id'");
                    if($detailreports->num_rows > 0){
                        $row_detail = $detailreports->fetch_assoc();
                        $op_id = $row_detail['OPERATOR'];
                        $onMobile = $row_detail['CA_NUM'];
                        $json_response_raw = json_decode($row_detail['RESPONSE']);
                        $json_response = json_decode($row_detail['RESPONSE']); 
                        $image_select = $con->query("SELECT * FROM `operator_list` WHERE OPERATOR_CODE='$op_id'")->fetch_assoc();
                        $logo = $opImagePath.$image_select['LOGO'];
                        $operator_name = $image_select['NAME'];
                        $code = trim($json_response_raw->response_code);
                        $stat = $json_response_raw->status;
                        if($stat == true && $code==1){
                            $status ="Success";
                        }
                        if($stat == true && $code==0){
                            $status ="Pending";
                        }
                        else{
                            $status ="Failed";
                        }
                    }
                                     
                }
                
                 if (strpos($small_value, 'dmt') !== false) {
                    $detailreports = $con->query("SELECT * FROM `dmt_transactions` WHERE REFFRENCE_ID='$txn_id'");
                    if($detailreports->num_rows > 0){
                        $row_detail = $detailreports->fetch_assoc();
                        $op_id = $row_detail['BENE_ID']; //Beneficiary Id// 
                        $onMobile = $row_detail['ACCOUNT'];
                        $json_response_raw = json_decode($row_detail['RESPONSE']);
                        $json_response = json_decode($row_detail['RESPONSE']); 
                        /*$image_select = $con->query("SELECT * FROM `operator_list` WHERE OPERATOR_CODE='$op_id'")->fetch_assoc();
                        $logo = $opImagePath.$image_select['LOGO'];
                        $operator_name = $image_select['NAME'];*/
                        $operator_name = "DMT";
                        $code = trim($json_response_raw->response_code);
                        $stat = $json_response_raw->status;
                        if($stat == true && $code==1){
                            $status ="Success";
                        }
                        if($stat == true && $code==2){
                            $status ="Pending";
                        }
                        else{
                            $status ="Failed";
                        }
                    }
                                     
                }
                
                
                    if (strpos($small_value, 'aeps') !== false) {
                    $detailreports = $con->query("SELECT * FROM `aeps_transactions` WHERE REFFRENCE_ID='$txn_id'");
                    if($detailreports->num_rows > 0){
                        $row_detail = $detailreports->fetch_assoc();
                        $op_id = $row_detail['MOBILE'];
                        $onMobile = $row_detail['ADHAAR_NUM'];
                        $json_response_raw = json_decode($row_detail['RESPONSE']);
                        /*$json_response = json_decode($row_detail['RESPONSE']); 
                        $image_select = $con->query("SELECT * FROM `operator_list` WHERE OPERATOR_CODE='$op_id'")->fetch_assoc();
                        $logo = $opImagePath.$image_select['LOGO'];
                        $operator_name = $image_select['NAME'];*/
                        $operator_name = "AEPS";
                        $code = trim($json_response_raw->response_code);
                        $stat = $json_response_raw->status;
                        if($stat == true && $code==1){
                            $status ="Success";
                        }
                        else{
                            $status ="Failed";
                        }
                    }
                                     
                }
                
                if (strpos($small_value, 'atm') !== false) {
                    $detailreports = $con->query("SELECT * FROM `micro_atm` WHERE TXNID='$txn_id'");
                    if($detailreports->num_rows > 0){
                        $row_detail = $detailreports->fetch_assoc();
                        $op_id = $row_detail['BANKRRN'];
                        $onMobile = $row_detail['CARDNUMBER'];
                        $onResponseV = $row_details['RESPONSE'];
                        /*$json_response_raw = json_decode($row_detail['RESPONSE']);
                        $json_response = json_decode($row_detail['RESPONSE']); 
                        $image_select = $con->query("SELECT * FROM `operator_list` WHERE OPERATOR_CODE='$op_id'")->fetch_assoc();
                        $logo = $opImagePath.$image_select['LOGO'];
                        $operator_name = $image_select['NAME'];*/
                        $operator_name = $row_detail['BANKNAME'];
                        //$code = trim($json_response_raw->response_code);
                        //$stat = $json_response_raw->status;
                        $code = 0;
                        if($onResponseV!=null){
                            $code = (int)$onResponseV;
                        }
                        if($code==1){
                            $status ="Success";
                        }
                        else{
                            $status ="Failed";
                        }
                    }
                                     
                }
                
                
                    if (strpos($small_value, 'fund') !== false) {
                    $detailreports = $con->query("SELECT * FROM `report` WHERE REFERENCE_ID='$txn_id' AND USER_ID='$user_id'");
                    if($detailreports->num_rows > 0){
                        $row_detail = $detailreports->fetch_assoc();
                        $op_id = $row_detail['TRANS_TYPE'];
                        $onMobile = $row_detail['REMARK'];
                        /*$json_response_raw = json_decode($row_detail['RESPONSE']);
                        $json_response = json_decode($row_detail['RESPONSE']); 
                        $image_select = $con->query("SELECT * FROM `operator_list` WHERE OPERATOR_CODE='$op_id'")->fetch_assoc();
                        $logo = $opImagePath.$image_select['LOGO'];
                        $operator_name = $image_select['NAME'];*/
                        $operator_name = "Fund Transfer";

                        if($amount_earlier!=$amount_left){
                            $status ="Success";
                        }
                        else{
                            $status ="Failed";
                        }
                    }
                                     
                }
                
                
             array_push($response,array("id"=>$index_id,"amount_earlier"=>$amount_earlier,"amount_left"=>$amount_left,"txn_id"=>$txn_id,"payment_type"=>$payment_type,"date"=>$date,"amount"=>$amount,"status"=>$status,"user_mobile"=>$user_mobile,"commission_amount"=>$commission_amount,"logo"=>$logo,"onMobile"=>$onMobile,"operator_name"=>$operator_name,"op_id"=>$op_id));
        }
        echo json_encode($response);
    }
    else{
        echo json_encode($response);
    }



?>