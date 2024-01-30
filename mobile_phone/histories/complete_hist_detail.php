<?php
    
    
    if(isset($_POST['report_id'])){
        
      include("../includes/configuration.php");
      $report_id = $_POST['report_id'];
      $user_id = $_POST['user_id'];
      $reports = $con->query("SELECT * FROM `report` WHERE USER_ID='$user_id' AND ID='$report_id'");
      
      if($reports->num_rows > 0){
         
          $row = $reports->fetch_assoc();
          $trans_type = $row['TRANS_TYPE'];
          $ref_id = $row['REFERENCE_ID'];
          $small_value = strtolower($trans_type);
          
          

          
          if (strpos($small_value, 'aeps') !== false) {
          $detailreports = $con->query("SELECT * FROM `aeps_transactions` WHERE REFFRENCE_ID='$ref_id' AND USER_ID='$user_id'");
          
          if(trim(strtolower($row_detail['API'])) == "fingpay"){
              $transactionType = "AEPS-1";
          }else{
              $transactionType = "AEPS-2";
          }
          
          if($detailreports->num_rows > 0){
                $row_detail = $detailreports->fetch_assoc();
                $json_response = $row_detail['RESPONSE'];
                $data_check_response = $row_detail['CHECK_RESPONSE'];
                $type_response = $row_detail['TRANS_TYPE'];
                $type = strtolower($type_response);
                
                
                // $dm_m = $row_detail['MOBILE'];
                $am_m = (float)$row_detail['AMOUNT'];
                $comm_select = $con->query("SELECT * FROM `commission_report` WHERE REFFRENCE='$ref_id' AND USER_ID='$user_id'")->fetch_assoc();
                $commission_charges = $comm_select['COMMISSION'];
                if($commission_charges==""){
                    $commission_charges = "0";
                }
                
                $amount_in_word  = getIndianCurrency($am_m);
                $charges  = $commission_charges;
                $gst_no = "33BPFPA5993D1Z3";

                $valDetails = array(
                    "amount_in_word"=>strtoupper($amount_in_word),
                    "charges"=>$charges,
                    "gst_no"=>$gst_no
                );
                
            $valDetails = json_encode($valDetails);
            $myArr = array(
            "status" =>true,
            "message" =>"Details fetched",
            "response_code"=>1,
            "type_response"=>$type,
            "trans_type"=>$transactionType,
            "data_response"=>$json_response,
            "data_check_response"=>$data_check_response,
            "additional_info"=>$valDetails
            );
            echo json_encode($myArr);
                
            }else{
                     
            $myArr = array(
            "status" =>false,
            "message" =>"Failed due no such records in more detail",
            "response_code"=>999,
            "type_response"=>"",
            "trans_type"=>$transactionType,
            "data_response"=>"",
            "data_check_response"=>"",
            "additional_info"=>""
            );
            echo json_encode($myArr);
        }   
                          
            }
      
          else if (strpos($small_value, 'dmt') !== false) {
          $detailreports = $con->query("SELECT * FROM `dmt_transactions` WHERE REFFRENCE_ID='$ref_id' AND USER_ID='$user_id'");
          if($detailreports->num_rows > 0){
                $row_detail = $detailreports->fetch_assoc();
                $json_response = $row_detail['RESPONSE'];
                $data_check_response = $row_detail['CHECK_RESPONSE'];
                $type_response = $row_detail['TRANS_TYPE'];
                $type = strtolower($type_response);
                $account_no = $row_detail['ACCOUNT'];
                $dm_m = $row_detail['MOBILE'];
                $am_m = (float)$row_detail['AMOUNT'];
                
                
                $comm_select = $con->query("SELECT * FROM `commission_report` WHERE REFFRENCE='$ref_id' AND USER_ID='$user_id'")->fetch_assoc();
                $commission_charges = $comm_select['COMMISSION'];
                if($commission_charges==""){
                    $commission_charges = "0";
                }
                
                $bank_data = $con->query("SELECT * FROM `dmt_beneficiary` WHERE ACCOUNT='$account_no' AND MOBILE='$dm_m'")->fetch_assoc();
                
                $bank_info = json_decode($bank_data['RESPONSE'])->data;
                
                $bank_name = $bank_info->bankname;
                $ifsc_code = $bank_info->ifsc;
                $amount_in_word  = getIndianCurrency($am_m);
                $charges  = $row_detail['CHARGE'];;
                $gst_no = "03FAEPS3695J1Z8";
                
                
                $val_name  = json_decode($row_detail['RESPONSE'])->benename;
                if($val_name == "" || $val_name==null){
                    $val_name = "Name not avaialable";
                }
                
                
                // $dm_user_data = $con->query("SELECT * FROM `dmt_user` WHERE USER_ID='$id' AND MOBILE='$dm_m'")->fetch_assoc();
                // $m_m_f = json_decode($dm_user_data['RESPONSE'])->data->fname;
                // $m_m_l = json_decode($dm_user_data['RESPONSE'])->data->lname;
                // $val_name = $m_m_f." ".$m_m_l;
                
                
                
                
                $valDetails = array(
                        "dmt_mobile"=>$row_detail['MOBILE'],
                        "bene_id"=>$row_detail['BENE_ID'],
                        "bank_name"=>$bank_name,
                        "ifsc_code"=>$ifsc_code,
                        "amount_in_word"=>strtoupper($amount_in_word),
                        "charges"=>$charges,
                        "gst_no"=>$gst_no,
                        "bene_user_name"=>$val_name
                    );
                
                
            $valDetails = json_encode($valDetails);
            $myArr = array(
            "status" =>true,
            "message" =>"Details fetched",
            "response_code"=>1,
            "type_response"=>$type,
            "trans_type"=>"dmt",
            "data_response"=>$json_response,
            "data_check_response"=>$valDetails,
            "additional_info"=>$valDetails
            );
            echo json_encode($myArr);
                
            }
            else{
                     
            $myArr = array(
            "status" =>false,
            "message" =>"Failed due no such records in more detail",
            "response_code"=>999,
            "type_response"=>"",
            "trans_type"=>"dmt",
            "data_response"=>"",
            "data_check_response"=>"",
            "additional_info"=>""
            );
            echo json_encode($myArr);
                     
        }          
    }
    
          else if (strpos($small_value, 'upi') !== false) {
              
          $detailreports = $con->query("SELECT * FROM `upi_transactions` WHERE REFFRENCE_ID='$ref_id' AND USER_ID='$user_id'");
          
          if($detailreports->num_rows > 0){
                $row_detail = $detailreports->fetch_assoc();
                $json_response = $row_detail['RESPONSE'];
                $data_check_response = $row_detail['CHECK_RESPONSE'];
                $type_response = $row_detail['TRANS_TYPE'];
                $type = strtolower($type_response);
                $account_no = $row_detail['ACCOUNT'];
                $dm_m = $row_detail['MOBILE'];
                $am_m = (float)$row_detail['AMOUNT'];
                
                
                $comm_select = $con->query("SELECT * FROM `commission_report` WHERE REFFRENCE='$ref_id' AND USER_ID='$user_id'")->fetch_assoc();
                $commission_charges = $comm_select['COMMISSION'];
                if($commission_charges==""){
                    $commission_charges = "0";
                }
                
                
                $val_name = $row_detail['NAME'];
                $amount_in_word  = getIndianCurrency($am_m);
                $charges  = $row_detail['CHARGE'];;
                $gst_no = "Not Available";
            
                
                
                
                $valDetails = array(
                        "dmt_mobile"=>$row_detail['MOBILE'],
                        "bene_id"=>$row_detail['BENE_ID'],
                        "bank_name"=>$bank_name,
                        "ifsc_code"=>$ifsc_code,
                        "amount_in_word"=>strtoupper($amount_in_word),
                        "charges"=>$charges,
                        "gst_no"=>$gst_no,
                        "bene_user_name"=>$val_name
                    );
                
                
            $valDetails = json_encode($valDetails);
            $myArr = array(
            "status" =>true,
            "message" =>"Details fetched",
            "response_code"=>1,
            "type_response"=>$type,
            "trans_type"=>"upi",
            "data_response"=>$json_response,
            "data_check_response"=>$valDetails,
            "additional_info"=>$valDetails
            );
            echo json_encode($myArr);
                
            }
            else{
                     
            $myArr = array(
            "status" =>false,
            "message" =>"Failed due no such records in more detail",
            "response_code"=>999,
            "type_response"=>"",
            "trans_type"=>"upi",
            "data_response"=>"",
            "data_check_response"=>"",
            "additional_info"=>""
            );
            echo json_encode($myArr);
                     
        }          
    }
    
          else if (strpos($small_value, 'payout') !== false) {
          $detailreports = $con->query("SELECT * FROM `payout_transaction` WHERE REFFRENCE_ID='$ref_id' AND USER_ID='$user_id'");
          if($detailreports->num_rows > 0){
                $row_detail = $detailreports->fetch_assoc();
                $json_response = $row_detail['RESPONSE'];
                $data_check_response = $row_detail['CHECK_RESPONSE'];
                $type_response = $row_detail['TRANS_TYPE'];
                $type = strtolower($type_response);
                $am_m = (float)$row_detail['AMOUNT'];
                
                
                
                $comm_select = $con->query("SELECT * FROM `commission_report` WHERE REFFRENCE='$ref_id' AND USER_ID='$user_id'")->fetch_assoc();
                $commission_charges = $comm_select['COMMISSION'];
                if($commission_charges==""){
                    $commission_charges = "0";
                }
                
                $amount_in_word  = getIndianCurrency($am_m);
                $charges  = $commission_charges;
                $gst_no = "33BPFPA5993D1Z3";
                

                $valDetails = array(
                    "amount_in_word"=>strtoupper($amount_in_word),
                    "charges"=>$charges,
                    "gst_no"=>$gst_no
                );
                
                
                
            $myArr = array(
              "status"=>true,
              "message"=>"Details fetched",
              "response_code"=>1,
              "type_response"=>$type,
              "trans_type"=>"payout",
              "data_response"=>$json_response,
              "additional_info"=>json_encode($valDetails)
            );
            echo json_encode($myArr);
                
                
                        
                }else{
                     
            $myArr = array(
            "status" =>false,
            "message" =>"Failed due no such records in more detail",
            "response_code"=>999,
            "type_response"=>"",
            "trans_type"=>"payout",
            "data_response"=>"",
            "data_check_response"=>""
            );
            echo json_encode($myArr);
                     
        }          
    }
          
          else if (strpos($small_value, 'atm') !== false) {
          $detailreports = $con->query("SELECT * FROM `micro_atm` WHERE TXNID='$ref_id' AND USER_ID='$user_id'");
          if($detailreports->num_rows > 0){
                $row_detail = $detailreports->fetch_assoc();
                $type_response = $row_detail['TRANS_TYPE'];
                $type = strtolower($type_response);
                
            
            
                $am_m = (float)$row_detail['TRANSAMOUNT'];
                $comm_select = $con->query("SELECT * FROM `commission_report` WHERE REFFRENCE='$ref_id' AND USER_ID='$user_id'")->fetch_assoc();
                $commission_charges = $comm_select['COMMISSION'];
                if($commission_charges==""){
                    $commission_charges = "0";
                }
                
                $amount_in_word  = getIndianCurrency($am_m);
                $charges  = $commission_charges;
                $gst_no = "33BPFPA5993D1Z3";

                $valDetails = array(
                    "amount_in_word"=>strtoupper($amount_in_word),
                    "charges"=>$charges,
                    "gst_no"=>$gst_no
                );    
                
                
            $valDetails = json_encode($valDetails);
            
            $valArr = array(
            "ID" =>$row_detail['ID'],
            "USER_ID" =>$row_detail['USER_ID'],
            "USER_STATUS" =>$row_detail['USER_STATUS'],
            "STATUS"=>strtolower($row_detail['RESPONSE']),
            "TRANSAMOUNT" =>$row_detail['TRANSAMOUNT'],
            "BALAMOUNT" =>"₹ ".$row_detail['BALAMOUNT'],
            "BANKRRN" =>$row_detail['BANKRRN'],
            "TXNID" =>$row_detail['TXNID'],
            "TRANSTYPE" =>$row_detail['TRANSTYPE'],
            "CARDNUMBER" =>$row_detail['CARDNUMBER'],
            "CARDTYPE" =>$row_detail['CARDTYPE'],
            "TERMINALLD" =>$row_detail['TERMINALLD'],
            "BANKNAME" =>$row_detail['BANKNAME'],
            "DATE" =>$row_detail['DATE'],
            );
                
            $mymy = json_encode($valArr);   
                
            $myArr = array(
            "status" =>true,
            "message" =>"Details fetched",
            "response_code"=>1,
            "type_response"=>$type,
            "trans_type"=>"atm",
            "data_response"=>$mymy,
            "data_check_response"=>$valDetails,
            "additional_info"=>$valDetails
            );
            echo json_encode($myArr);
                
                
                        
                }else{
                     
            $myArr = array(
            "status" =>false,
            "message" =>"Failed due no such records in more detail",
            "response_code"=>999,
            "type_response"=>"",
            "trans_type"=>"atm",
            "data_response"=>"",
            "data_check_response"=>"",
            "additional_info"=>""
            );
            echo json_encode($myArr);
                     
                }         
            }
          
          else if (strpos($small_value, 'fund') !== false) {
          $detailreports = $con->query("SELECT * FROM `report` WHERE REFERENCE_ID='$ref_id' AND USER_ID='$user_id'");
          if($detailreports->num_rows > 0){
                $row_detail = $detailreports->fetch_assoc();
                $type_response = $row_detail['TRANS_TYPE'];
                $type = strtolower($type_response);
                
                
            $valArr = array(
            "TRANS_TYPE" =>$row_detail['TRANS_TYPE'],
            "REFERENCE_ID" =>$row_detail['REFERENCE_ID'],
            "TOKEN_ID" =>$row_detail['TOKEN_ID'],
            "PREVIOUS_AMOUNT" =>$row_detail['PREVIOUS_AMOUNT'],
            "AMOUNT" =>$row_detail['AMOUNT'],
            "AFTER_AMOUNT" =>$row_detail['AFTER_AMOUNT'],
            "FUND_TYPE" =>$row_detail['FUND_TYPE'],
            "REMARK" =>$row_detail['REMARK'],
            "STATUS" =>$row_detail['STATUS'],
            "OS" =>$row_detail['OS'],
            "DEVICE" =>$row_detail['DEVICE'],
            "LOCATION" =>$row_detail['LOCATION'],
            "TRANS_DATE" =>$row_detail['TRANS_DATE'],
            "TRANS_TIME" =>$row_detail['TRANS_TIME'],
            "MESSAGE" =>$row_detail['MESSAGE'],
            "DATE" =>$row_detail['DATE']
            );
                
             $mymy = json_encode($valArr);   
             
             
             $am_m = (float)$row_detail['AMOUNT'];
                $comm_select = $con->query("SELECT * FROM `commission_report` WHERE REFFRENCE='$ref_id' AND USER_ID='$user_id'")->fetch_assoc();
                $commission_charges = $comm_select['COMMISSION'];
                if($commission_charges==""){
                    $commission_charges = "0";
                }
                
                $amount_in_word  = getIndianCurrency($am_m);
                $charges  = $commission_charges;
                $gst_no = "33BPFPA5993D1Z3";

                $valDetails = array(
                    "amount_in_word"=>strtoupper($amount_in_word),
                    "charges"=>$charges,
                    "gst_no"=>$gst_no
                );
             
            $valDetails = json_encode($valDetails);
                
            $myArr = array(
            "status" =>true,
            "message" =>"Details fetched",
            "response_code"=>1,
            "type_response"=>$type,
            "trans_type"=>"fund",
            "data_response"=>$mymy,
            "data_check_response"=>$valDetails,
            "additional_info"=>$valDetails
            );
            echo json_encode($myArr);
                
            }else{
                     
            $myArr = array(
            "status" =>false,
            "message" =>"Failed due no such records in more details",
            "response_code"=>999,
            "type_response"=>"",
            "trans_type"=>"fund",
            "data_response"=>"",
            "data_check_response"=>"",
            "additional_info"=>""
            );
            echo json_encode($myArr);
        }   
                          
            }
            
          else if (strpos($small_value, 'pan coupon') !== false) {
          $detailreports = $con->query("SELECT * FROM `report` WHERE REFERENCE_ID='$ref_id' AND USER_ID='$user_id'");
          if($detailreports->num_rows > 0){
                $row_detail = $detailreports->fetch_assoc();
                $type_response = $row_detail['TRANS_TYPE'];
                $type = strtolower($type_response);
                
                
            $valArr = array(
            "TRANS_TYPE" =>$row_detail['TRANS_TYPE'],
            "REFERENCE_ID" =>$row_detail['REFERENCE_ID'],
            "TOKEN_ID" =>$row_detail['TOKEN_ID'],
            "PREVIOUS_AMOUNT" =>$row_detail['PREVIOUS_AMOUNT'],
            "AMOUNT" =>$row_detail['AMOUNT'],
            "AFTER_AMOUNT" =>$row_detail['AFTER_AMOUNT'],
            "FUND_TYPE" =>$row_detail['FUND_TYPE'],
            "REMARK" =>$row_detail['REMARK'],
            "STATUS" =>$row_detail['STATUS'],
            "OS" =>$row_detail['OS'],
            "DEVICE" =>$row_detail['DEVICE'],
            "LOCATION" =>$row_detail['LOCATION'],
            "TRANS_DATE" =>$row_detail['TRANS_DATE'],
            "TRANS_TIME" =>$row_detail['TRANS_TIME'],
            "MESSAGE" =>$row_detail['MESSAGE'],
            "DATE" =>$row_detail['DATE']
            );
                
             $mymy = json_encode($valArr);   
             
             
             $am_m = (float)$row_detail['AMOUNT'];
                $comm_select = $con->query("SELECT * FROM `commission_report` WHERE REFFRENCE='$ref_id' AND USER_ID='$user_id'")->fetch_assoc();
                $commission_charges = $comm_select['COMMISSION'];
                if($commission_charges==""){
                    $commission_charges = "0";
                }
                
                $amount_in_word  = getIndianCurrency($am_m);
                $charges  = $commission_charges;
                $gst_no = "33BPFPA5993D1Z3";

                $valDetails = array(
                    "amount_in_word"=>strtoupper($amount_in_word),
                    "charges"=>$charges,
                    "gst_no"=>$gst_no
                );
             
            $valDetails = json_encode($valDetails);
                
            $myArr = array(
            "status" =>true,
            "message" =>"Details fetched",
            "response_code"=>1,
            "type_response"=>$type,
            "trans_type"=>"1",
            "data_response"=>$mymy,
            "data_check_response"=>$valDetails,
            "additional_info"=>$valDetails
            );
            echo json_encode($myArr);
                
            }else{
                     
            $myArr = array(
            "status" =>false,
            "message" =>"Failed due no such records in more details",
            "response_code"=>999,
            "type_response"=>"",
            "trans_type"=>"1",
            "data_response"=>"",
            "data_check_response"=>"",
            "additional_info"=>""
            );
            echo json_encode($myArr);
        }   
                          
            }
            
          else if (strpos($small_value, 'deposit') !== false) {
          $detailreports = $con->query("SELECT * FROM `cash_deposit_transaction` WHERE REFFRENCE_ID='$ref_id' AND USER_ID='$user_id'");
          if($detailreports->num_rows > 0){
                $row_detail = $detailreports->fetch_assoc();
                $json_response = $row_detail['RESPONSE'];
                $data_check_response = $row_detail['CHECK_RESPONSE'];
                $type_response = "Cash Deposit";
                $type = strtolower($type_response);
                
                $valDetails = array(
                        "dmt_mobile"=>$row_detail['MOBILE'],
                        "bene_id"=>$row_detail['BENE_ID']
                    );
                
                
                
            $myArr = array(
            "status" =>true,
            "message" =>"Details fetched",
            "response_code"=>1,
            "type_response"=>$type,
            "trans_type"=>"deposit",
            "data_response"=>$json_response,
            "data_check_response"=>json_encode($valDetails)
            );
            echo json_encode($myArr);
                
                
                        
                }else{
                     
            $myArr = array(
            "status" =>false,
            "message" =>"Failed due no such records in more detail",
            "response_code"=>999,
            "type_response"=>"",
            "trans_type"=>"dmt",
            "data_response"=>"",
            "data_check_response"=>""
            );
            echo json_encode($myArr);
                     
        }          
    }    
            
          else if (strpos($small_value, 'recharge') !== false) {
              
          $detailreports = $con->query("SELECT * FROM `recharge_transaction` WHERE REFERENCE_ID='$ref_id' AND USER_ID='$user_id'");
          if($detailreports->num_rows > 0){
                $row_detail = $detailreports->fetch_assoc();
                $json_response = $row_detail['RESPONSE'];
                $data_check_response = $row_detail['CHECK_RESPONSE'];
                $type_response = $row_detail['TRANS_TYPE'];
                $type = strtolower($type_response);
                
                
                
                $am_m = (float)$row_detail['AMOUNT'];
                $comm_select = $con->query("SELECT * FROM `commission_report` WHERE REFFRENCE='$ref_id' AND USER_ID='$user_id'")->fetch_assoc();
                $commission_charges = $comm_select['COMMISSION'];
                if($commission_charges==""){
                    $commission_charges = "0";
                }
                
                $amount_in_word  = getIndianCurrency($am_m);
                $charges  = $commission_charges;
                $gst_no = "33BPFPA5993D1Z3";

                $valDetails = array(
                    "amount_in_word"=>strtoupper($amount_in_word),
                    "charges"=>$charges,
                    "gst_no"=>$gst_no
                );
            
            $valDetails = json_encode($valDetails);
                
            $myArr = array(
            "status" =>true,
            "message" =>"Details fetched",
            "response_code"=>1,
            "type_response"=>$type,
            "trans_type"=>"recharge",
            "data_response"=>$json_response,
            "data_check_response"=>$data_check_response,
            "additional_info"=>$valDetails
            );
            echo json_encode($myArr);
                
            }else{
                     
            $myArr = array(
            "status" =>false,
            "message" =>"Failed due no such records in more detail",
            "response_code"=>999,
            "type_response"=>"",
            "trans_type"=>"recharge",
            "data_response"=>"",
            "data_check_response"=>"",
            "additional_info"=>$valDetails
            );
            echo json_encode($myArr);
        }   
                          
            } 
            
          else if (strpos($small_value, 'lic') !== false) {
          $detailreports = $con->query("SELECT * FROM `lic_transaction` WHERE REFFRENCE_ID='$ref_id' AND USER_ID='$user_id'");
          if($detailreports->num_rows > 0){
                $row_detail = $detailreports->fetch_assoc();
                $json_response = $row_detail['RESPONSE'];
                $data_check_response = $row_detail['CHECK_RESPONSE'];
                $type_response = "LIC";
                $type = strtolower($type_response);
                
                $valDetails = array(
                        "dmt_mobile"=>$row_detail['MOBILE'],
                        "bene_id"=>$row_detail['BENE_ID']
                    );
                
                
                
            $myArr = array(
            "status" =>true,
            "message" =>"Details fetched",
            "response_code"=>1,
            "type_response"=>$type,
            "trans_type"=>"lic",
            "data_response"=>$json_response,
            "data_check_response"=>json_encode($valDetails)
            );
            echo json_encode($myArr);
                
                
                        
                }else{
                     
            $myArr = array(
            "status" =>false,
            "message" =>"Failed due no such records in more detail",
            "response_code"=>999,
            "type_response"=>"",
            "trans_type"=>"lic",
            "data_response"=>"",
            "data_check_response"=>""
            );
            echo json_encode($myArr);
                     
        }          
    }
    
          else if (strpos($small_value, 'fastag') !== false) {
          $detailreports = $con->query("SELECT * FROM `fastag_transaction` WHERE REFFRENCE_ID='$ref_id' AND USER_ID='$user_id'");
          if($detailreports->num_rows > 0){
                $row_detail = $detailreports->fetch_assoc();
                $json_response = $row_detail['RESPONSE'];
                $data_check_response = $row_detail['CHECK_RESPONSE'];
                $type_response = "FASTag";
                $type = strtolower($type_response);
                
                $valDetails = array(
                        "dmt_mobile"=>$row_detail['MOBILE'],
                        "bene_id"=>$row_detail['BENE_ID']
                    );
                
                
                
            $myArr = array(
            "status" =>true,
            "message" =>"Details fetched",
            "response_code"=>1,
            "type_response"=>$type,
            "trans_type"=>"2",
            "data_response"=>$json_response,
            "data_check_response"=>json_encode($valDetails)
            );
            echo json_encode($myArr);
                
                
                        
                }else{
                     
            $myArr = array(
            "status" =>false,
            "message" =>"Failed due no such records in more detail",
            "response_code"=>999,
            "type_response"=>"",
            "trans_type"=>"2",
            "data_response"=>"",
            "data_check_response"=>""
            );
            echo json_encode($myArr);
                     
        }          
    }
            
          else if (strpos($small_value, 'bbps') !== false) {
              
          $detailreports = $con->query("SELECT * FROM `pay_bill_api` WHERE REFFRENCE_ID='$ref_id' AND USER_ID='$user_id'");
          if($detailreports->num_rows > 0){
                $row_detail = $detailreports->fetch_assoc();
                $json_response = $row_detail['RESPONSE'];
                $data_check_response = $row_detail['CHECK_RESPONSE'];
                $type_response = "";
                $type = strtolower($type_response);
                
                
                $am_m = (float)$row_detail['AMOUNT'];
                $comm_select = $con->query("SELECT * FROM `commission_report` WHERE REFFRENCE='$ref_id' AND USER_ID='$user_id'")->fetch_assoc();
                $commission_charges = $comm_select['COMMISSION'];
                if($commission_charges==""){
                    $commission_charges = "0";
                }
                
                $amount_in_word  = getIndianCurrency($am_m);
                $charges  = $commission_charges;
                $gst_no = "33BPFPA5993D1Z3";

                $valDetails = array(
                    "amount_in_word"=>strtoupper($amount_in_word),
                    "charges"=>$charges,
                    "gst_no"=>$gst_no
                );    
                
                
            $valDetails = json_encode($valDetails);
            
            $myArr = array(
            "status" =>true,
            "message" =>"Details fetched",
            "response_code"=>1,
            "type_response"=>$type,
            "trans_type"=>"bbps",
            "data_response"=>$json_response,
            "data_check_response"=>$data_check_response,
            "additional_info"=>$valDetails
            );
            echo json_encode($myArr);
                
            }else{
                     
            $myArr = array(
            "status" =>false,
            "message" =>"Failed due no such records in more detail",
            "response_code"=>999,
            "type_response"=>"",
            "trans_type"=>"bbps",
            "data_response"=>"",
            "data_check_response"=>"",
            "additional_info"=>$valDetails
            );
            echo json_encode($myArr);
        }   
                          
            } 
      }
      else{
             $myArr = array(
            "status" =>false,
            "message" =>"Failed due no such records",
            "response_code"=>999,
            "type_response"=>"",
            "trans_type"=>"",
            "data_response"=>"",
            "data_check_response"=>"",
            "additional_info"=>$valDetails
            );
            echo json_encode($myArr);
          
      }
        
        
    
    }
    else{
            $myArr = array(
            "status" =>false,
            "message" =>"Failed due to not set",
            "response_code"=>999,
            "type_response"=>"",
            "trans_type"=>"",
            "data_response"=>"",
            "data_check_response"=>"",
            "additional_info"=>$valDetails
            );
            echo json_encode($myArr);
    }


function getIndianCurrency(float $number)
{
    $decimal = round($number - ($no = floor($number)), 2) * 100;
    $hundred = null;
    $digits_length = strlen($no);
    $i = 0;
    $str = array();
    $words = array(0 => '', 1 => 'one', 2 => 'two',
        3 => 'three', 4 => 'four', 5 => 'five', 6 => 'six',
        7 => 'seven', 8 => 'eight', 9 => 'nine',
        10 => 'ten', 11 => 'eleven', 12 => 'twelve',
        13 => 'thirteen', 14 => 'fourteen', 15 => 'fifteen',
        16 => 'sixteen', 17 => 'seventeen', 18 => 'eighteen',
        19 => 'nineteen', 20 => 'twenty', 30 => 'thirty',
        40 => 'forty', 50 => 'fifty', 60 => 'sixty',
        70 => 'seventy', 80 => 'eighty', 90 => 'ninety');
    $digits = array('', 'hundred','thousand','lakh', 'crore');
    while( $i < $digits_length ) {
        $divider = ($i == 2) ? 10 : 100;
        $number = floor($no % $divider);
        $no = floor($no / $divider);
        $i += $divider == 10 ? 1 : 2;
        if ($number) {
            $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
            $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
            $str [] = ($number < 21) ? $words[$number].' '. $digits[$counter]. $plural.' '.$hundred:$words[floor($number / 10) * 10].' '.$words[$number % 10]. ' '.$digits[$counter].$plural.' '.$hundred;
        } else $str[] = null;
    }
    $Rupees = implode('', array_reverse($str));
    $paise = ($decimal > 0) ? "." . ($words[$decimal / 10] . " " . $words[$decimal % 10]) . ' Paise' : '';
    return ($Rupees ? $Rupees . 'Rupees ' : '') . $paise;
}

?>