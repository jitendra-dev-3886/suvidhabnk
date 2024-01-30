<?php

    
    //insert $op data in Column = LONG_CODE in recharge_transaction and pay_bill_api table's colum... in website recharge and bbps scripting...
    
    //everything is done for mobile scripting... 
    // ..now for every new recharge name and logo will be shown
    
    include("../includes/config.php");
    include("../includes/imagepaths.php");
    
    $user_id = $user['ID'];
    $user_type_id = $user['USER_TYPE'];

    $result = $_POST['result'];
    $indexing = $_POST['indexing'];
    $howmuch = "100";
    $id = $_POST['id'];
    $response  = array();
    
    $transtype = $_POST['transType'];
    $fromDate = $_POST['fromDate'];
    $toDate = $_POST['toDate'];
    
    $transactionType = "";
    
    if($fromDate!="" && $toDate!=""){
        $dateCondition .= " AND DATE BETWEEN '$fromDate%' AND '$toDate%' ";
    }
    
    if($indexing=="0"){
        $allreports = $con->query("SELECT * FROM `report` WHERE USER_ID='$user_id' ".$dateCondition." ORDER BY ID DESC LIMIT $indexing, $howmuch");
    }
    else{
        $allreports = $con->query("SELECT * FROM `report` WHERE USER_ID='$user_id' ".$dateCondition." AND ID <'$id' ORDER BY ID DESC LIMIT $indexing, $howmuch");
    }

        if($allreports->num_rows > 0){
        //loop untill all is fetched
        while($row = $allreports->fetch_assoc()){
            
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
                $cause = "transaction";
                if (strpos($small_value, 'commission') !== false) {
                    $cause = "commission";
                }
                else if (strpos($small_value, 'charge') !== false){
                    $cause = "charge";
                }
                else{
                    $cause = "transaction";
                }
                
                if($amount==null || $amount == 0){
                    $amount_in_word  = "Zero";
                }
                else{
                    $amount_in_word  = getIndianCurrency($amount);
                }
                
                if ((strpos($small_value, 'verify') !== false) || (strpos($small_value, 'verification') !== false)) {
                    $status = "Success";
                    $op_id= $payment_type;
                    $onMobile = "Unvailable";
                    $operator_name = "Unavailable";
                }
                
                
                $user_select = $con->query("SELECT MOBILE FROM `user` WHERE ID='$re_user_id'")->fetch_assoc();
                $user_mobile = $user_select['MOBILE'];
                
                $comm_select = $con->query("SELECT * FROM `commission_report` WHERE REFFRENCE='$txn_id' AND USER_ID='$user_id'")->fetch_assoc();
                $commission_amount = $comm_select['COMMISSION'];
                
                $tds = $comm_select['TDS'];
                $gst = $comm_select['GST'];
                
                if($commission_amount=="" || $commission_amount==null){
                    $commission_amount="0";
                }
                
                if($tds=="" || $tds==null){
                    $tds="0";
                }
                
                if($gst=="" || $gst==null){
                  $gst = "0";
                }
            
            if (strpos($transtype, 'A') !== false) {//Aeps only Starts
                
            if (strpos($small_value, 'aeps') !== false) {
                $transactionType = "AEPS";
                    $detailreports = $con->query("SELECT * FROM `aeps_transactions` WHERE REFFRENCE_ID='$txn_id' ORDER BY ID DESC LIMIT 1");
                    if($detailreports->num_rows > 0){
                        $row_detail = $detailreports->fetch_assoc();
                        //$op_id = $row_detail['MOBILE'];
                        
                        if(trim(strtolower($row_detail['API'])) == "fingpay"){
                            $transactionType = "AEPS-1";
                        }else{
                            $transactionType = "AEPS-2";
                        }
                        
                        $op_id = $row_detail['TRANS_TYPE'];
                        if($op_id=="M"){
                            $op_id="Aadhar Pay";
                        }
                        else if($op_id=="MS"){
                            $op_id="Mini Statement";
                        }
                        else if($op_id=="CW"){
                            $op_id="Cash Withdraw";
                        }
                        else if($op_id=="BE"){
                            $op_id="Balance Enquiry";
                        }
                        
                        $savedAadhar = $row_detail['ADHAAR_NUM'];
                        $json_response_raw = json_decode($row_detail['RESPONSE']);
                        $operator_name = "AEPS";
                        $logo = $aepsImagePath;
                        
                        $onMobile = $row_detail['MOBILE'];
                        
                        $detstat = strtolower($row_detail['STATUS']);
                        
                        if (strpos($detstat, 'success') !== false) {
                            $status ="Success";
                        }
                        else if (strpos($detstat, 'pending') !== false) {
                            $status ="Pending";
                        }
                        else if (strpos($detstat, 'fail') !== false) {
                            $status ="Failed";
                        }
                        else{
                            $status ="Failed";
                        }
                    }
                
                
                
                    if($result =="success"){
                        //success selection push
                        if($status =="Success"){
                            
                            array_push($response,array("amount_in_word"=>strtoupper($amount_in_word),"cause"=>$cause,"id"=>$index_id,"amount_earlier"=>"₹ ".$amount_earlier,"amount_left"=>"₹ ".$amount_left,"txn_id"=>$txn_id,"payment_type"=>$payment_type,"date"=>$date,"amount"=>"₹ ".$amount,"status"=>$status,"user_mobile"=>$user_mobile,"commission_amount"=>"₹ ".$commission_amount,"logo"=>$logo,"onMobile"=>$onMobile,"operator_name"=>$operator_name,"op_id"=>$op_id,"tds"=>"₹ ".$tds,"gst"=>"₹ ".$gst));
                        }
            
                    }
                    else if($result=="failed"){
                    
                    //failed selection push
                    
                        if($status =="Failed"){
                            
                            array_push($response,array("amount_in_word"=>strtoupper($amount_in_word),"cause"=>$cause,"id"=>$index_id,"amount_earlier"=>"₹ ".$amount_earlier,"amount_left"=>"₹ ".$amount_left,"txn_id"=>$txn_id,"payment_type"=>$payment_type,"date"=>$date,"amount"=>"₹ ".$amount,"status"=>$status,"user_mobile"=>$user_mobile,"commission_amount"=>"₹ ".$commission_amount,"logo"=>$logo,"onMobile"=>$onMobile,"operator_name"=>$operator_name,"op_id"=>$op_id,"tds"=>"₹ ".$tds,"gst"=>"₹ ".$gst));
                        }
                    
                    
                    }
                 else{
                    //status not selected so all push
                            
                            array_push($response,array("amount_in_word"=>strtoupper($amount_in_word),"cause"=>$cause, "id"=>$index_id,"amount_earlier"=>"₹ ".$amount_earlier,"amount_left"=>"₹ ".$amount_left,"txn_id"=>$txn_id,"payment_type"=>$payment_type,"date"=>$date,"amount"=>"₹ ".$amount,"status"=>$status,"user_mobile"=>$user_mobile,"commission_amount"=>"₹ ".$commission_amount,"logo"=>$logo,"onMobile"=>$onMobile,"operator_name"=>$operator_name,"op_id"=>$op_id,"tds"=>"₹ ".$tds,"gst"=>"₹ ".$gst));
                    
                    }
                
                
                    }      
            
                }//aeps only Ends
            
            if (strpos($transtype, 'R') !== false) {//Aeps only Starts
                
            if (strpos($small_value, 'recharge') !== false) {
                    $transactionType = "RECHARGE";
                    $detailreports = $con->query("SELECT * FROM `recharge_transaction` WHERE REFERENCE_ID='$txn_id' ORDER BY ID DESC LIMIT 1");
                    if($detailreports->num_rows > 0){
                        $row_detail = $detailreports->fetch_assoc();
                        $op_id = $row_detail['LONG_CODE'];
                        $onMobile = $row_detail['MOBILE'];
                        $json_response_raw = json_decode($row_detail['RESPONSE']);
                        $json_response = json_decode($row_detail['RESPONSE']); 
                        $check = json_decode($row_detail['CHECK_RESPONSE']); 
                        $image_select = $con->query("SELECT * FROM `switchOperator` WHERE LONGCODE='$op_id' AND (SERVICETYPE = 'Prepaid' OR SERVICETYPE = 'Dth')")->fetch_assoc();
                        $logo = $opImagePath.$image_select['LOGO'];
                        $operator_name = $image_select['PRODUCTNAME'];
                        $op_id = "Recharge";
                        $code = trim($json_response_raw->response_code);
                        $stat = $json_response_raw->status;
                        
                        $detstat = strtolower($row_detail['STATUS']);
                    
                    
                        if (strpos($detstat, 'success') !== false) {
                            $status ="Success";
                        }
                        else if (strpos($detstat, 'pending') !== false) {
                            $status ="Pending";
                        }
                        else if (strpos($detstat, 'fail') !== false) {
                            $status ="Failed";
                        }
                        else{
                            $status ="Failed";
                        }
                        
                        if($check->status==true && $check->response_code==1){
                            $status ="Refunded";
                        }
                        
                        
                    }
                
                
                
                    if($result =="success"){
                        //success selection push
                        if($status =="Success"){
                            
                            array_push($response,array("amount_in_word"=>strtoupper($amount_in_word),"cause"=>$cause, "id"=>$index_id,"amount_earlier"=>"₹ ".$amount_earlier,"amount_left"=>"₹ ".$amount_left,"txn_id"=>$txn_id,"payment_type"=>$payment_type,"date"=>$date,"amount"=>"₹ ".$amount,"status"=>$status,"user_mobile"=>$user_mobile,"commission_amount"=>"₹ ".$commission_amount,"logo"=>$logo,"onMobile"=>$onMobile,"operator_name"=>$operator_name,"op_id"=>$op_id,"tds"=>"₹ ".$tds,"gst"=>"₹ ".$gst));
                        }
            
                    }
                    else if($result=="failed"){
                    
                    //failed selection push
                    
                        if($status =="Failed"){
                           
                            array_push($response,array("amount_in_word"=>strtoupper($amount_in_word),"cause"=>$cause, "id"=>$index_id,"amount_earlier"=>"₹ ".$amount_earlier,"amount_left"=>"₹ ".$amount_left,"txn_id"=>$txn_id,"payment_type"=>$payment_type,"date"=>$date,"amount"=>"₹ ".$amount,"status"=>$status,"user_mobile"=>$user_mobile,"commission_amount"=>"₹ ".$commission_amount,"logo"=>$logo,"onMobile"=>$onMobile,"operator_name"=>$operator_name,"op_id"=>$op_id,"tds"=>"₹ ".$tds,"gst"=>"₹ ".$gst));
                        }
                    
                    
                    }
                 else{
                    //status not selected so all push
                            
                            array_push($response,array("amount_in_word"=>strtoupper($amount_in_word),"cause"=>$cause, "id"=>$index_id,"amount_earlier"=>"₹ ".$amount_earlier,"amount_left"=>"₹ ".$amount_left,"txn_id"=>$txn_id,"payment_type"=>$payment_type,"date"=>$date,"amount"=>"₹ ".$amount,"status"=>$status,"user_mobile"=>$user_mobile,"commission_amount"=>"₹ ".$commission_amount,"logo"=>$logo,"onMobile"=>$onMobile,"operator_name"=>$operator_name,"op_id"=>$op_id,"tds"=>"₹ ".$tds,"gst"=>"₹ ".$gst));
                    
                    }
                
                
                    }      
            
                }//recharges only Ends
            
            if (strpos($transtype, 'B') !== false) {//Aeps only Starts
                
            if (strpos($small_value, 'bbps') !== false) {
                
                    $transactionType = "BBPS";
                    $detailreports = $con->query("SELECT * FROM `pay_bill_api` WHERE REFFRENCE_ID='$txn_id' ORDER BY ID DESC LIMIT 1");
                    if($detailreports->num_rows > 0){
                        $row_detail = $detailreports->fetch_assoc();
                        $op_id = $row_detail['LONG_CODE'];
                        $onMobile = $row_detail['CA_NUM'];
                        $json_response_raw = json_decode($row_detail['RESPONSE']);
                        $json_response = json_decode($row_detail['RESPONSE']); 
                        $image_select = $con->query("SELECT * FROM `switchOperator` WHERE LONGCODE='$op_id' AND (SERVICETYPE <>'Prepaid' AND SERVICETYPE <>'DTH') ")->fetch_assoc();
                        $logo = $opImagePath.$image_select['LOGO'];
                        $operator_name = $image_select['PRODUCTNAME'];
                        $code = trim($json_response_raw->response_code);
                        $stat = $json_response_raw->status;
                        $detstat = strtolower($row_detail['STATUS']);
                        
                        if (strpos($detstat, 'success') !== false) {
                            $status ="Success";
                        }
                        else if (strpos($detstat, 'pending') !== false) {
                            $status ="Pending";
                        }
                        else if (strpos($detstat, 'fail') !== false) {
                            $status ="Failed";
                        }
                        else{
                            $status ="Failed";
                        }
                    }
                
                
                
                    if($result =="success"){
                        //success selection push
                        if($status =="Success"){
                            
                            array_push($response,array("amount_in_word"=>strtoupper($amount_in_word),"cause"=>$cause, "id"=>$index_id,"amount_earlier"=>"₹ ".$amount_earlier,"amount_left"=>"₹ ".$amount_left,"txn_id"=>$txn_id,"payment_type"=>$payment_type,"date"=>$date,"amount"=>"₹ ".$amount,"status"=>$status,"user_mobile"=>$user_mobile,"commission_amount"=>"₹ ".$commission_amount,"logo"=>$logo,"onMobile"=>$onMobile,"operator_name"=>$operator_name,"op_id"=>$op_id,"tds"=>"₹ ".$tds,"gst"=>"₹ ".$gst));
                        }
            
                    }
                    else if($result=="failed"){
                    
                    //failed selection push
                    
                        if($status =="Failed"){
                            
                            array_push($response,array("amount_in_word"=>strtoupper($amount_in_word),"cause"=>$cause, "id"=>$index_id,"amount_earlier"=>"₹ ".$amount_earlier,"amount_left"=>"₹ ".$amount_left,"txn_id"=>$txn_id,"payment_type"=>$payment_type,"date"=>$date,"amount"=>"₹ ".$amount,"status"=>$status,"user_mobile"=>$user_mobile,"commission_amount"=>"₹ ".$commission_amount,"logo"=>$logo,"onMobile"=>$onMobile,"operator_name"=>$operator_name,"op_id"=>$op_id,"tds"=>"₹ ".$tds,"gst"=>"₹ ".$gst));
                        }
                    
                    
                    }
                 else{
                    //status not selected so all push
                            
                            array_push($response,array("amount_in_word"=>strtoupper($amount_in_word),"cause"=>$cause, "id"=>$index_id,"amount_earlier"=>"₹ ".$amount_earlier,"amount_left"=>"₹ ".$amount_left,"txn_id"=>$txn_id,"payment_type"=>$payment_type,"date"=>$date,"amount"=>"₹ ".$amount,"status"=>$status,"user_mobile"=>$user_mobile,"commission_amount"=>"₹ ".$commission_amount,"logo"=>$logo,"onMobile"=>$onMobile,"operator_name"=>$operator_name,"op_id"=>$op_id,"tds"=>"₹ ".$tds,"gst"=>"₹ ".$gst));
                    
                    }
                
                
                    }      
            
                }//bbps only Ends
            
            if (strpos($transtype, 'P') !== false) {//
                
            if (strpos($small_value, 'payout') !== false) {
                    $transactionType = "PAYOUT";
                    $detailreports = $con->query("SELECT * FROM `payout_transaction` WHERE REFFRENCE_ID='$txn_id' ORDER BY ID DESC LIMIT 1");
                    if($detailreports->num_rows > 0){
                        $row_detail = $detailreports->fetch_assoc();
                        // $op_id = $row_detail['TRANS_TYPE'];
                        $op_id = "Transaction";
                        $onMobile = $row_detail['ACCOUNT'];
                        $j_response = $row_detail['RESPONSE'];
                        $json_response_raw = json_decode($row_detail['RESPONSE']);
                        /*$json_response = json_decode($row_detail['RESPONSE']); 
                        $image_select = $con->query("SELECT * FROM `operator_list` WHERE OPERATOR_CODE='$op_id'")->fetch_assoc();
                        $logo = $opImagePath.$image_select['LOGO'];
                        $operator_name = $image_select['NAME'];*/
                        $operator_name = "Payout";
                        $logo = $payoutImagePath;
                        $code = trim($json_response_raw->response_code);
                        $stat = $json_response_raw->status;
                        $resp_status = strtolower($row_detail['STATUS']);
                        if(strpos($resp_status, 'success') !== false){
                            $status ="Success";
                        }
                        else if(strpos($resp_status, 'pending') !== false){
                            $status ="Pending";
                        }
                        else if(strpos($resp_status, 'accepted') !== false){
                            $status ="Pending";
                        }
                        else{
                            $status ="Failed";
                        }
                        
                        
                        if($gst=="0"){
                            $gst=($amount/100)*18;
                        }
                        // $gst = "sbjbsajkfbjkds";
                    }
                    
                    
                     if($result =="success"){
                        //success selection push
                        if($status =="Success"){
                            
                            array_push($response,array("amount_in_word"=>strtoupper($amount_in_word),"cause"=>$cause, "id"=>$index_id,"amount_earlier"=>"₹ ".$amount_earlier,"amount_left"=>"₹ ".$amount_left,"txn_id"=>$txn_id,"payment_type"=>$payment_type,"date"=>$date,"amount"=>"₹ ".$amount,"status"=>$status,"user_mobile"=>$user_mobile,"commission_amount"=>"₹ ".$commission_amount,"logo"=>$logo,"onMobile"=>$onMobile,"operator_name"=>$operator_name,"op_id"=>$op_id,"tds"=>"₹ ".$tds,"gst"=>"₹ ".$gst));
                        }
            
                    }
                    else if($result=="failed"){
                    
                    //failed selection push
                    
                        if($status =="Failed"){
                            
                            array_push($response,array("amount_in_word"=>strtoupper($amount_in_word),"cause"=>$cause, "id"=>$index_id,"amount_earlier"=>"₹ ".$amount_earlier,"amount_left"=>"₹ ".$amount_left,"txn_id"=>$txn_id,"payment_type"=>$payment_type,"date"=>$date,"amount"=>"₹ ".$amount,"status"=>$status,"user_mobile"=>$user_mobile,"commission_amount"=>"₹ ".$commission_amount,"logo"=>$logo,"onMobile"=>$onMobile,"operator_name"=>$operator_name,"op_id"=>$op_id,"tds"=>"₹ ".$tds,"gst"=>"₹ ".$gst));
                        }
                    
                    
                    }
                 else{
                    //status not selected so all push
                            
                            array_push($response,array("amount_in_word"=>strtoupper($amount_in_word),"cause"=>$cause, "id"=>$index_id,"amount_earlier"=>"₹ ".$amount_earlier,"amount_left"=>"₹ ".$amount_left,"txn_id"=>$txn_id,"payment_type"=>$payment_type,"date"=>$date,"amount"=>"₹ ".$amount,"status"=>$status,"user_mobile"=>$user_mobile,"commission_amount"=>"₹ ".$commission_amount,"logo"=>$logo,"onMobile"=>$onMobile,"operator_name"=>$operator_name,"op_id"=>$op_id,"tds"=>"₹ ".$tds,"gst"=>"₹ ".$gst));
                    
                    }
                                     
                }  
            
            }//payouts only Ends
            
            if (strpos($transtype, 'C') !== false) {//
                
            if (strpos($small_value, 'deposit') !== false) {
                    $transactionType = "DEPOSIT";
                    $detailreports = $con->query("SELECT * FROM `cash_deposit_transaction` WHERE REFFRENCE_ID='$txn_id' ORDER BY ID DESC LIMIT 1");
                    if($detailreports->num_rows > 0){
                        $row_detail = $detailreports->fetch_assoc();
                        $onMobile = $row_detail['ACC_NUM'];
                        $json_response_raw = json_decode($row_detail['RESPONSE']);
                        $json_response = json_decode($row_detail['RESPONSE']); 
                        $op_id = $json_response->mobile; 
                        /*$image_select = $con->query("SELECT * FROM `operator_list` WHERE OPERATOR_CODE='$op_id'")->fetch_assoc();
                        $logo = $opImagePath.$image_select['LOGO'];
                        $operator_name = $image_select['NAME'];*/
                        $operator_name = "Cash Deposit";
                        $logo = $dmtImagePath;
                        $resp_status = strtolower($row_detail['STATUS']);
                        if((strpos($resp_status, 'success') !== false) || (strpos($resp_status, 'sucess') !== false)){
                            $status ="Success";
                        }
                        else if(strpos($resp_status, 'pending') !== false){
                            $status ="Pending";
                        }
                        else if(strpos($resp_status, 'refund') !== false){
                            $status ="Refunded";
                        }
                        else{
                            $status ="Failed";
                        }
                        
                        
                    }
                
                
                
                    if($result =="success"){
                        //success selection push
                        if($status =="Success"){
                            array_push($response,array("id"=>$index_id,"amount_earlier"=>"₹ ".$amount_earlier,"amount_left"=>"₹ ".$amount_left,"txn_id"=>$txn_id,"payment_type"=>$payment_type,"date"=>$date,"amount"=>"₹ ".$amount,"status"=>$status,"user_mobile"=>$user_mobile,"commission_amount"=>"₹ ".$commission_amount,"logo"=>$logo,"onMobile"=>$onMobile,"operator_name"=>$operator_name,"op_id"=>$op_id,"tds"=>"₹ ".$tds,"gst"=>"₹ ".$gst));
                        }
            
                    }
                    else if($result=="failed"){
                    
                    //failed selection push
                    
                        if($status =="Failed"){
                            array_push($response,array("id"=>$index_id,"amount_earlier"=>"₹ ".$amount_earlier,"amount_left"=>"₹ ".$amount_left,"txn_id"=>$txn_id,"payment_type"=>$payment_type,"date"=>$date,"amount"=>"₹ ".$amount,"status"=>$status,"user_mobile"=>$user_mobile,"commission_amount"=>"₹ ".$commission_amount,"logo"=>$logo,"onMobile"=>$onMobile,"operator_name"=>$operator_name,"op_id"=>$op_id,"tds"=>"₹ ".$tds,"gst"=>"₹ ".$gst));
                        }
                    
                    
                    }
                 else{
                    //status not selected so all push
                            array_push($response,array("id"=>$index_id,"amount_earlier"=>"₹ ".$amount_earlier,"amount_left"=>"₹ ".$amount_left,"txn_id"=>$txn_id,"payment_type"=>$payment_type,"date"=>$date,"amount"=>"₹ ".$amount,"status"=>$status,"user_mobile"=>$user_mobile,"commission_amount"=>"₹ ".$commission_amount,"logo"=>$logo,"onMobile"=>$onMobile,"operator_name"=>$operator_name,"op_id"=>$op_id,"tds"=>"₹ ".$tds,"gst"=>"₹ ".$gst));
                    
                    }
                
                
                    }      
            
                }//cash deposit only Ends
            
            if (strpos($transtype, 'D') !== false) {//Aeps only Starts
                
            if (strpos($small_value, 'dmt') !== false) {
                if (strpos($small_value, 'xdmt') !== false) {
                    $transactionType = "XDMT";
                    $detailreports = $con->query("SELECT * FROM `xdmt_transactions` WHERE REFFRENCE_ID='$txn_id' ORDER BY ID DESC LIMIT 1");   
                }
                else{
                    $transactionType = "DMT";
                    $detailreports = $con->query("SELECT * FROM `dmt_transactions` WHERE REFFRENCE_ID='$txn_id' ORDER BY ID DESC LIMIT 1");
                }
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
                        $logo = $dmtImagePath;
                        $code = $json_response->response_code;
                        $stat = $json_response->status;
                        
                        $innerStatus = strtolower($row_detail['STATUS']);
                        
                        if (strpos($innerStatus, 'success') !== false){
                            $status ="Success";
                        }
                        else if (strpos($innerStatus, 'accepted') !== false){
                            $status ="Pending";
                        }
                        else if (strpos($innerStatus, 'pending') !== false){
                            $status ="Pending";
                        }
                        else if (strpos($innerStatus, 'refund') !== false && strpos($innerStatus, 'fail') == false){
                            $status ="Pending";
                        }
                        else{
                            $status ="Failed";
                        }
                        
            
                    
                        
                    }
                
                
                
                    if($result =="success"){
                        //success selection push
                        if($status =="Success"){
                            
                            array_push($response,array("amount_in_word"=>strtoupper($amount_in_word),"cause"=>$cause, "id"=>$index_id,"amount_earlier"=>"₹ ".$amount_earlier,"amount_left"=>"₹ ".$amount_left,"txn_id"=>$txn_id,"payment_type"=>$payment_type,"date"=>$date,"amount"=>"₹ ".$amount,"status"=>$status,"user_mobile"=>$user_mobile,"commission_amount"=>"₹ ".$commission_amount,"logo"=>$logo,"onMobile"=>$onMobile,"operator_name"=>$operator_name,"op_id"=>$op_id,"tds"=>"₹ ".$tds,"gst"=>"₹ ".$gst));
                        }
            
                    }
                    else if($result=="failed"){
                    
                    //failed selection push
                    
                        if($status =="Failed"){
                            
                            array_push($response,array("amount_in_word"=>strtoupper($amount_in_word),"cause"=>$cause, "id"=>$index_id,"amount_earlier"=>"₹ ".$amount_earlier,"amount_left"=>"₹ ".$amount_left,"txn_id"=>$txn_id,"payment_type"=>$payment_type,"date"=>$date,"amount"=>"₹ ".$amount,"status"=>$status,"user_mobile"=>$user_mobile,"commission_amount"=>"₹ ".$commission_amount,"logo"=>$logo,"onMobile"=>$onMobile,"operator_name"=>$operator_name,"op_id"=>$op_id,"tds"=>"₹ ".$tds,"gst"=>"₹ ".$gst));
                        }
                    
                    
                    }
                 else{
                    //status not selected so all push
                            
                            array_push($response,array("amount_in_word"=>strtoupper($amount_in_word),"cause"=>$cause, "id"=>$index_id,"amount_earlier"=>"₹ ".$amount_earlier,"amount_left"=>"₹ ".$amount_left,"txn_id"=>$txn_id,"payment_type"=>$payment_type,"date"=>$date,"amount"=>"₹ ".$amount,"status"=>$status,"user_mobile"=>$user_mobile,"commission_amount"=>"₹ ".$commission_amount,"logo"=>$logo,"onMobile"=>$onMobile,"operator_name"=>$operator_name,"op_id"=>$op_id,"tds"=>"₹ ".$tds,"gst"=>"₹ ".$gst));
                    
                    }
                
                
                    }      
            
                }//dmt only Ends
                
            if (strpos($transtype, '5') !== false) {
             if (strpos($small_value, 'cms') !== false) {
                 
                 $transactionType = "CMS";
                 
                    $detailreports = $con->query("SELECT * FROM `cms_transaction` WHERE REFFRENCE_ID='$txn_id' AND US_ID='$user_id'");
                    if($detailreports->num_rows > 0){
                        $row_detail = $detailreports->fetch_assoc();
                        $op_id = $row_detail['BENE_ID']; //Beneficiary Id// 
                        $onMobile = $row_detail['ACCOUNT'];
                        $j_response = $row_detail['RESPONSE'];
                        $json_response_com = $row_detail['COM_RESPONSE'];
                        $logo = $cmsImagePath;
                        $operator_name = "CMS";
                        
                        if($j_response!=null || $j_response!=""){
                             $status ="Success";   
                        }
                        else{
                            $status ="Failed";
                        }
                        
                        
                  if($result =="success"){
                        //success selection push
                        if($status =="Success"){
                            
                            array_push($response,array("amount_in_word"=>strtoupper($amount_in_word),"cause"=>$cause, "id"=>$index_id,"amount_earlier"=>"₹ ".$amount_earlier,"amount_left"=>"₹ ".$amount_left,"txn_id"=>$txn_id,"payment_type"=>$payment_type,"date"=>$date,"amount"=>"₹ ".$amount,"status"=>$status,"user_mobile"=>$user_mobile,"commission_amount"=>"₹ ".$commission_amount,"logo"=>$logo,"onMobile"=>$onMobile,"operator_name"=>$operator_name,"op_id"=>$op_id,"tds"=>"₹ ".$tds,"gst"=>"₹ ".$gst));
                        }
            
                    }
                    else if($result=="failed"){
                    
                    //failed selection push
                    
                        if($status =="Failed"){
                            
                            array_push($response,array("amount_in_word"=>strtoupper($amount_in_word),"cause"=>$cause, "id"=>$index_id,"amount_earlier"=>"₹ ".$amount_earlier,"amount_left"=>"₹ ".$amount_left,"txn_id"=>$txn_id,"payment_type"=>$payment_type,"date"=>$date,"amount"=>"₹ ".$amount,"status"=>$status,"user_mobile"=>$user_mobile,"commission_amount"=>"₹ ".$commission_amount,"logo"=>$logo,"onMobile"=>$onMobile,"operator_name"=>$operator_name,"op_id"=>$op_id,"tds"=>"₹ ".$tds,"gst"=>"₹ ".$gst));
                        }
                    
                    
                    }
                 else{
                    //status not selected so all push
                            
                            array_push($response,array("amount_in_word"=>strtoupper($amount_in_word),"cause"=>$cause, "id"=>$index_id,"amount_earlier"=>"₹ ".$amount_earlier,"amount_left"=>"₹ ".$amount_left,"txn_id"=>$txn_id,"payment_type"=>$payment_type,"date"=>$date,"amount"=>"₹ ".$amount,"status"=>$status,"user_mobile"=>$user_mobile,"commission_amount"=>"₹ ".$commission_amount,"logo"=>$logo,"onMobile"=>$onMobile,"operator_name"=>$operator_name,"op_id"=>$op_id,"tds"=>"₹ ".$tds,"gst"=>"₹ ".$gst));
                    
                    }
                    
                        
                    }
                                     
                }   
            }
                
            if (strpos($transtype, '6') !== false) {
                
                if (strpos($small_value, 'payment') !== false) {
                    $transactionType = "PAYMENTGATEWAY";
                    $detailreports = $con->query("SELECT * FROM `payment_gatweay` WHERE REFFRENCE_ID='$txn_id' AND US_ID='$user_id'");
                    if($detailreports->num_rows > 0){
                        $row_detail = $detailreports->fetch_assoc();
                        $op_id = $row_detail['BENE_ID']; //Beneficiary Id// 
                        $onMobile = $row_detail['ACCOUNT'];
                        $j_response = $row_detail['RESPONSE'];
                        $json_response_com = $row_detail['COM_RESPONSE'];
                        $logo = $cmsImagePath;
                        $operator_name = "CMS";
                        
                        if($j_response!=null || $j_response!=""){
                             $status ="Success";   
                        }
                        else{
                            $status ="Failed";
                        }
                        
                        
                if($result =="success"){
                        //success selection push
                        if($status =="Success"){
                            
                            array_push($response,array("amount_in_word"=>strtoupper($amount_in_word),"cause"=>$cause, "id"=>$index_id,"amount_earlier"=>"₹ ".$amount_earlier,"amount_left"=>"₹ ".$amount_left,"txn_id"=>$txn_id,"payment_type"=>$payment_type,"date"=>$date,"amount"=>"₹ ".$amount,"status"=>$status,"user_mobile"=>$user_mobile,"commission_amount"=>"₹ ".$commission_amount,"logo"=>$logo,"onMobile"=>$onMobile,"operator_name"=>$operator_name,"op_id"=>$op_id,"tds"=>"₹ ".$tds,"gst"=>"₹ ".$gst));
                        }
            
                    }
                else if($result=="failed"){
                    
                        //failed selection push
                        if($status =="Failed"){
                            
                            array_push($response,array("amount_in_word"=>strtoupper($amount_in_word),"cause"=>$cause, "id"=>$index_id,"amount_earlier"=>"₹ ".$amount_earlier,"amount_left"=>"₹ ".$amount_left,"txn_id"=>$txn_id,"payment_type"=>$payment_type,"date"=>$date,"amount"=>"₹ ".$amount,"status"=>$status,"user_mobile"=>$user_mobile,"commission_amount"=>"₹ ".$commission_amount,"logo"=>$logo,"onMobile"=>$onMobile,"operator_name"=>$operator_name,"op_id"=>$op_id,"tds"=>"₹ ".$tds,"gst"=>"₹ ".$gst));
                        }
                    
                    
                    }
                 else{
                        //status not selected so all push
                            
                            array_push($response,array("amount_in_word"=>strtoupper($amount_in_word),"cause"=>$cause, "id"=>$index_id,"amount_earlier"=>"₹ ".$amount_earlier,"amount_left"=>"₹ ".$amount_left,"txn_id"=>$txn_id,"payment_type"=>$payment_type,"date"=>$date,"amount"=>"₹ ".$amount,"status"=>$status,"user_mobile"=>$user_mobile,"commission_amount"=>"₹ ".$commission_amount,"logo"=>$logo,"onMobile"=>$onMobile,"operator_name"=>$operator_name,"op_id"=>$op_id,"tds"=>"₹ ".$tds,"gst"=>"₹ ".$gst));
                    
                    }
                        
                    }
                                     
                }   
            }    
                
            if (strpos($transtype, '2') !== false) {//
                
            if (strpos($small_value, 'fastag') !== false) {
                $transactionType = "FASTAG";
                    $detailreports = $con->query("SELECT * FROM `fastag_transaction` WHERE REFFRENCE_ID='$txn_id' ORDER BY ID DESC LIMIT 1");
                    if($detailreports->num_rows > 0){
                        $row_detail = $detailreports->fetch_assoc();
                        $onMobile = $row_detail['CA_NUM'];
                        $json_response_raw = json_decode($row_detail['RESPONSE']);
                        $json_response = json_decode($row_detail['RESPONSE']); 
                        $json_send = json_decode($row_detail['SEND_DATA']); 
                        $op_id = $json_send->operator;  
                        $image_select = $con->query("SELECT * FROM `switchOperator` WHERE LONGCODE='$op_id'")->fetch_assoc();
                        $logo = $opImagePath.$image_select['LOGO'];
                        $op_id = $image_select['PRODUCTNAME'];
                        $operator_name = "FastAg";
                        // $logo = $dmtImagePath;
                        $resp_status = strtolower($row_detail['STATUS']);
                        if((strpos($resp_status, 'success') !== false) || (strpos($resp_status, 'sucess') !== false)){
                            $status ="Success";
                        }
                        else if(strpos($resp_status, 'pending') !== false){
                            $status ="Pending";
                        }
                        else if(strpos($resp_status, 'refund') !== false){
                            $status ="Refunded";
                        }
                        else{
                            $status ="Failed";
                        }
                        
                        
                    }
                
                
                
                    if($result =="success"){
                        //success selection push
                        if($status =="Success"){
                            array_push($response,array("amount_in_word"=>strtoupper($amount_in_word),"transactionType"=>$transactionType, "cause"=>$cause, "id"=>$index_id, "amount_earlier"=>"₹ ".$amount_earlier,"amount_left"=>"₹ ".$amount_left,"txn_id"=>$txn_id,"payment_type"=>$payment_type,"date"=>$date,"amount"=>"₹ ".$amount,"status"=>$status,"user_mobile"=>$user_mobile,"commission_amount"=>"₹ ".$commission_amount,"logo"=>$logo,"onMobile"=>$onMobile,"operator_name"=>$operator_name,"op_id"=>$op_id,"tds"=>"₹ ".$tds,"gst"=>"₹ ".$gst));
                        }
            
                    }
                    else if($result=="failed"){
                    
                    //failed selection push
                    
                        if($status =="Failed"){
                            array_push($response,array("amount_in_word"=>strtoupper($amount_in_word),"transactionType"=>$transactionType, "cause"=>$cause, "id"=>$index_id, "amount_earlier"=>"₹ ".$amount_earlier,"amount_left"=>"₹ ".$amount_left,"txn_id"=>$txn_id,"payment_type"=>$payment_type,"date"=>$date,"amount"=>"₹ ".$amount,"status"=>$status,"user_mobile"=>$user_mobile,"commission_amount"=>"₹ ".$commission_amount,"logo"=>$logo,"onMobile"=>$onMobile,"operator_name"=>$operator_name,"op_id"=>$op_id,"tds"=>"₹ ".$tds,"gst"=>"₹ ".$gst));
                        }
                    
                    
                    }
                 else{
                    //status not selected so all push
                            array_push($response,array("amount_in_word"=>strtoupper($amount_in_word),"transactionType"=>$transactionType, "cause"=>$cause, "id"=>$index_id, "amount_earlier"=>"₹ ".$amount_earlier,"amount_left"=>"₹ ".$amount_left,"txn_id"=>$txn_id,"payment_type"=>$payment_type,"date"=>$date,"amount"=>"₹ ".$amount,"status"=>$status,"user_mobile"=>$user_mobile,"commission_amount"=>"₹ ".$commission_amount,"logo"=>$logo,"onMobile"=>$onMobile,"operator_name"=>$operator_name,"op_id"=>$op_id,"tds"=>"₹ ".$tds,"gst"=>"₹ ".$gst));
                    
                    }
                
                
                    }      
            
                }//Fastag only Ends
                
            if (strpos($transtype, 'L') !== false) {//
                
            if (strpos($small_value, 'lic') !== false) {
                $transactionType = "LIC";
                    $detailreports = $con->query("SELECT * FROM `lic_transaction` WHERE REFFRENCE_ID='$txn_id' ORDER BY ID DESC LIMIT 1");
                    if($detailreports->num_rows > 0){
                        $row_detail = $detailreports->fetch_assoc();
                        $json_response_raw = json_decode($row_detail['SEND_DATA']);
                        $json_response = json_decode($row_detail['RESPONSE']); 
                        $op_id = ""; 
                        $onMobile = $json_response_raw->canumber;
                        /*$image_select = $con->query("SELECT * FROM `switchOperator` WHERE LONGCODE='$op_id'")->fetch_assoc();
                        $logo = $opImagePath.$image_select['LOGO'];
                        $operator_name = $image_select['PRODUCTNAME'];*/
                        $operator_name = "LIC";
                        $logo = $dmtImagePath;
                        $resp_status = strtolower($row_detail['STATUS']);
                        if((strpos($resp_status, 'success') !== false) || (strpos($resp_status, 'sucess') !== false)){
                            $status ="Success";
                        }
                        else if(strpos($resp_status, 'pending') !== false){
                            $status ="Pending";
                        }
                        else{
                            $status ="Failed";
                        }
                    }
                
                
                
                    if($result =="success"){
                        //success selection push
                        if($status =="Success"){
                            array_push($response,array("amount_in_word"=>strtoupper($amount_in_word),"transactionType"=>$transactionType, "cause"=>$cause, "id"=>$index_id, "amount_earlier"=>"₹ ".$amount_earlier,"amount_left"=>"₹ ".$amount_left,"txn_id"=>$txn_id,"payment_type"=>$payment_type,"date"=>$date,"amount"=>"₹ ".$amount,"status"=>$status,"user_mobile"=>$user_mobile,"commission_amount"=>"₹ ".$commission_amount,"logo"=>$logo,"onMobile"=>$onMobile,"operator_name"=>$operator_name,"op_id"=>$op_id,"tds"=>"₹ ".$tds,"gst"=>"₹ ".$gst));
                        }
            
                    }
                    else if($result=="failed"){
                    
                    //failed selection push
                    
                        if($status =="Failed"){
                            array_push($response,array("amount_in_word"=>strtoupper($amount_in_word),"transactionType"=>$transactionType, "cause"=>$cause, "id"=>$index_id, "amount_earlier"=>"₹ ".$amount_earlier,"amount_left"=>"₹ ".$amount_left,"txn_id"=>$txn_id,"payment_type"=>$payment_type,"date"=>$date,"amount"=>"₹ ".$amount,"status"=>$status,"user_mobile"=>$user_mobile,"commission_amount"=>"₹ ".$commission_amount,"logo"=>$logo,"onMobile"=>$onMobile,"operator_name"=>$operator_name,"op_id"=>$op_id,"tds"=>"₹ ".$tds,"gst"=>"₹ ".$gst));
                        }
                    
                    
                    }
                 else{
                    //status not selected so all push
                            array_push($response,array("amount_in_word"=>strtoupper($amount_in_word),"transactionType"=>$transactionType, "cause"=>$cause, "id"=>$index_id, "amount_earlier"=>"₹ ".$amount_earlier,"amount_left"=>"₹ ".$amount_left,"txn_id"=>$txn_id,"payment_type"=>$payment_type,"date"=>$date,"amount"=>"₹ ".$amount,"status"=>$status,"user_mobile"=>$user_mobile,"commission_amount"=>"₹ ".$commission_amount,"logo"=>$logo,"onMobile"=>$onMobile,"operator_name"=>$operator_name,"op_id"=>$op_id,"tds"=>"₹ ".$tds,"gst"=>"₹ ".$gst));
                    
                    }
                
                
                    }      
            
                }//lic deposit only Ends
                
            if (strpos($transtype, 'M') !== false) {//Aeps only Starts
                
            if (strpos($small_value, 'atm') !== false) {
                $transactionType = "ATM";
                
                    $detailreports = $con->query("SELECT * FROM `micro_atm` WHERE TXNID='$txn_id' ORDER BY ID DESC LIMIT 1");
                    if($detailreports->num_rows > 0){
                        $row_detail = $detailreports->fetch_assoc();
                        $op_id = $row_detail['BANKRRN'];
                        $onMobile = $row_detail['CARDNUMBER'];
                        $onResponseV = strtolower($row_detail['RESPONSE']);
                        /*$json_response_raw = json_decode($row_detail['RESPONSE']);
                        $json_response = json_decode($row_detail['RESPONSE']); 
                        $image_select = $con->query("SELECT * FROM `operator_list` WHERE OPERATOR_CODE='$op_id'")->fetch_assoc();
                        $logo = $opImagePath.$image_select['LOGO'];
                        $operator_name = $image_select['NAME'];*/
                        $operator_name = $row_detail['BANKNAME'];
                        $logo = $atmImagePath;
                        if($onResponseV=="1"){
                            $status ="Success";
                        }
                        else if($onResponseV==1){
                            $status ="Success";
                        }
                        else{
                            $status ="Failed";
                        }
                    }
                
                
                
                    if($result =="success"){
                        //success selection push
                        if($status =="Success"){
                            
                            array_push($response,array("amount_in_word"=>strtoupper($amount_in_word),"cause"=>$cause, "id"=>$index_id,"amount_earlier"=>"₹ ".$amount_earlier,"amount_left"=>"₹ ".$amount_left,"txn_id"=>$txn_id,"payment_type"=>$payment_type,"date"=>$date,"amount"=>"₹ ".$amount,"status"=>$status,"user_mobile"=>$user_mobile,"commission_amount"=>"₹ ".$commission_amount,"logo"=>$logo,"onMobile"=>$onMobile,"operator_name"=>$operator_name,"op_id"=>$op_id,"tds"=>"₹ ".$tds,"gst"=>"₹ ".$gst));
                        }
            
                    }
                    else if($result=="failed"){
                    
                    //failed selection push
                    
                        if($status =="Failed"){
                            
                            array_push($response,array("amount_in_word"=>strtoupper($amount_in_word),"cause"=>$cause, "id"=>$index_id,"amount_earlier"=>"₹ ".$amount_earlier,"amount_left"=>"₹ ".$amount_left,"txn_id"=>$txn_id,"payment_type"=>$payment_type,"date"=>$date,"amount"=>"₹ ".$amount,"status"=>$status,"user_mobile"=>$user_mobile,"commission_amount"=>"₹ ".$commission_amount,"logo"=>$logo,"onMobile"=>$onMobile,"operator_name"=>$operator_name,"op_id"=>$op_id,"tds"=>"₹ ".$tds,"gst"=>"₹ ".$gst));
                        }
                    
                    
                    }
                 else{
                    //status not selected so all push
                            
                            array_push($response,array("amount_in_word"=>strtoupper($amount_in_word),"cause"=>$cause, "id"=>$index_id,"amount_earlier"=>"₹ ".$amount_earlier,"amount_left"=>"₹ ".$amount_left,"txn_id"=>$txn_id,"payment_type"=>$payment_type,"date"=>$date,"amount"=>"₹ ".$amount,"status"=>$status,"user_mobile"=>$user_mobile,"commission_amount"=>"₹ ".$commission_amount,"logo"=>$logo,"onMobile"=>$onMobile,"operator_name"=>$operator_name,"op_id"=>$op_id,"tds"=>"₹ ".$tds,"gst"=>"₹ ".$gst));
                    
                    }
                
                
                    }      
            
                }//micro-atm only Ends
            
            if (strpos($transtype, 'F') !== false) {//fund only Starts
                
            if (strpos($small_value, 'fund') !== false) {
                $transactionType = "FUND";
                
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
                        $logo = $fundImagePath;

                        if($amount_earlier!=$amount_left){
                            $status ="Success";
                        }
                        else{
                            $status ="Failed";
                        }
                    }
                
                
                
                    if($result =="success"){
                        //success selection push
                        if($status =="Success"){
                            
                            array_push($response,array("amount_in_word"=>strtoupper($amount_in_word),"cause"=>$cause, "id"=>$index_id,"amount_earlier"=>"₹ ".$amount_earlier,"amount_left"=>"₹ ".$amount_left,"txn_id"=>$txn_id,"payment_type"=>$payment_type,"date"=>$date,"amount"=>"₹ ".$amount,"status"=>$status,"user_mobile"=>$user_mobile,"commission_amount"=>"₹ ".$commission_amount,"logo"=>$logo,"onMobile"=>$onMobile,"operator_name"=>$operator_name,"op_id"=>$op_id,"tds"=>"₹ ".$tds,"gst"=>"₹ ".$gst));
                        }
            
                    }
                    else if($result=="failed"){
                    
                    //failed selection push
                    
                        if($status =="Failed"){
                            
                            array_push($response,array("amount_in_word"=>strtoupper($amount_in_word),"cause"=>$cause, "id"=>$index_id,"amount_earlier"=>"₹ ".$amount_earlier,"amount_left"=>"₹ ".$amount_left,"txn_id"=>$txn_id,"payment_type"=>$payment_type,"date"=>$date,"amount"=>"₹ ".$amount,"status"=>$status,"user_mobile"=>$user_mobile,"commission_amount"=>"₹ ".$commission_amount,"logo"=>$logo,"onMobile"=>$onMobile,"operator_name"=>$operator_name,"op_id"=>$op_id,"tds"=>"₹ ".$tds,"gst"=>"₹ ".$gst));
                        }
                    
                    
                    }
                 else{
                    //status not selected so all push
                           
                    array_push($response,array("amount_in_word"=>strtoupper($amount_in_word),"cause"=>$cause, "id"=>$index_id,"amount_earlier"=>"₹ ".$amount_earlier,"amount_left"=>"₹ ".$amount_left,"txn_id"=>$txn_id,"payment_type"=>$payment_type,"date"=>$date,"amount"=>"₹ ".$amount,"status"=>$status,"user_mobile"=>$user_mobile,"commission_amount"=>"₹ ".$commission_amount,"logo"=>$logo,"onMobile"=>$onMobile,"operator_name"=>$operator_name,"op_id"=>$op_id,"tds"=>"₹ ".$tds,"gst"=>"₹ ".$gst));
                    
                    }
                
                
                    }      
            
                }//fund only Ends
                
            if (strpos($transtype, 'I') !== false) {//fund only Starts
                
            if (strpos($small_value, 'insurance') !== false) {
                $transactionType = "INSURANCE";
                
                    $detailreports = $con->query("SELECT * FROM `vehicle_registration` WHERE REFERENCE_ID='$txn_id' ORDER BY ID DESC LIMIT 1");
                    if($detailreports->num_rows > 0){
                        $row_detail = $detailreports->fetch_assoc();
                        $op_id = $row_detail['TRANS_TYPE'];
                        $onMobile = $row_detail['REMARK'];
                        /*$json_response_raw = json_decode($row_detail['RESPONSE']);
                        $json_response = json_decode($row_detail['RESPONSE']); 
                        $image_select = $con->query("SELECT * FROM `operator_list` WHERE OPERATOR_CODE='$op_id'")->fetch_assoc();
                        $logo = $opImagePath.$image_select['LOGO'];
                        $operator_name = $image_select['NAME'];*/
                        $operator_name = "Vehicle Insurance";
                        $logo = $insuranceImagePath;

                        if($amount_earlier!=$amount_left){
                            $status ="Success";
                        }
                        else{
                            $status ="Failed";
                        }
                    }
                
                
                
                    if($result =="success"){
                        //success selection push
                        if($status =="Success"){
                            
                            array_push($response,array("amount_in_word"=>strtoupper($amount_in_word),"cause"=>$cause, "id"=>$index_id,"amount_earlier"=>"₹ ".$amount_earlier,"amount_left"=>"₹ ".$amount_left,"txn_id"=>$txn_id,"payment_type"=>$payment_type,"date"=>$date,"amount"=>"₹ ".$amount,"status"=>$status,"user_mobile"=>$user_mobile,"commission_amount"=>"₹ ".$commission_amount,"logo"=>$logo,"onMobile"=>$onMobile,"operator_name"=>$operator_name,"op_id"=>$op_id,"tds"=>"₹ ".$tds,"gst"=>"₹ ".$gst));
                        }
            
                    }
                    else if($result=="failed"){
                    
                    //failed selection push
                    
                        if($status =="Failed"){
                            
                            array_push($response,array("amount_in_word"=>strtoupper($amount_in_word),"cause"=>$cause, "id"=>$index_id,"amount_earlier"=>"₹ ".$amount_earlier,"amount_left"=>"₹ ".$amount_left,"txn_id"=>$txn_id,"payment_type"=>$payment_type,"date"=>$date,"amount"=>"₹ ".$amount,"status"=>$status,"user_mobile"=>$user_mobile,"commission_amount"=>"₹ ".$commission_amount,"logo"=>$logo,"onMobile"=>$onMobile,"operator_name"=>$operator_name,"op_id"=>$op_id,"tds"=>"₹ ".$tds,"gst"=>"₹ ".$gst));
                        }
                    
                    
                    }
                 else{
                    //status not selected so all push
                           
                    array_push($response,array("amount_in_word"=>strtoupper($amount_in_word),"cause"=>$cause, "id"=>$index_id,"amount_earlier"=>"₹ ".$amount_earlier,"amount_left"=>"₹ ".$amount_left,"txn_id"=>$txn_id,"payment_type"=>$payment_type,"date"=>$date,"amount"=>"₹ ".$amount,"status"=>$status,"user_mobile"=>$user_mobile,"commission_amount"=>"₹ ".$commission_amount,"logo"=>$logo,"onMobile"=>$onMobile,"operator_name"=>$operator_name,"op_id"=>$op_id,"tds"=>"₹ ".$tds,"gst"=>"₹ ".$gst));
                    
                    }
                
                
                    }      
            
                }//insurance only Ends    
            
            if (strpos($transtype, '1') !== false) {//fund only Starts
                
            if (strpos($small_value, 'pan') !== false) {
                $transactionType = "PAN";
                
                
                    /**
                    $detailreports = $con->query("SELECT * FROM `pan_transaction` WHERE TRANSACTION_ID='$txn_id' ORDER BY ID DESC LIMIT 1");
                    if($detailreports->num_rows > 0){
                        $row_detail = $detailreports->fetch_assoc();
                        $op_id = "Coupon Request";
                        $onMobile = $row_detail['NUMBER_OF_COUPON']." Coupon";
                        $j_response = $row_detail['RESPONSE'];
                        $operator_name = "Pan Coupon Request";
                        $logo = $panImagePath;

                        $status = $row_detail['STATUS'];
                        
                        if($status == "Requested"){
                            $status = "Pending";
                        }
                    }
                    **/
                
                    $transactionType = "PAN";
                    $detailreports = $con->query("SELECT * FROM `pan_coupen` WHERE OD_ID='$txn_id' AND USID='$user_id'");
                    if($detailreports->num_rows > 0){
                        $row_detail = $detailreports->fetch_assoc();
                        $op_id = "Coupon Request";
                        $onMobile = $row_detail['NUM']." Coupon";
                        $j_response = $row_detail['RESPONSE'];
                        $operator_name = "Pan Coupon Request";
                        $logo = $panImagePath;

                        $status = $row_detail['STATUS'];
                        if($status == "Requested"){
                            $status = "Pending";
                        }
                    }
                
                
                    if($result =="success"){
                        //success selection push
                        if($status =="Success"){
                            
                            array_push($response,array("amount_in_word"=>strtoupper($amount_in_word),"cause"=>$cause, "id"=>$index_id,"amount_earlier"=>"₹ ".$amount_earlier,"amount_left"=>"₹ ".$amount_left,"txn_id"=>$txn_id,"payment_type"=>$payment_type,"date"=>$date,"amount"=>"₹ ".$amount,"status"=>$status,"user_mobile"=>$user_mobile,"commission_amount"=>"₹ ".$commission_amount,"logo"=>$logo,"onMobile"=>$onMobile,"operator_name"=>$operator_name,"op_id"=>$op_id,"tds"=>"₹ ".$tds,"gst"=>"₹ ".$gst));
                        }
            
                    }
                    else if($result=="failed"){
                    
                    //failed selection push
                    
                        if($status =="Failed"){
                            
                            array_push($response,array("amount_in_word"=>strtoupper($amount_in_word),"cause"=>$cause, "id"=>$index_id,"amount_earlier"=>"₹ ".$amount_earlier,"amount_left"=>"₹ ".$amount_left,"txn_id"=>$txn_id,"payment_type"=>$payment_type,"date"=>$date,"amount"=>"₹ ".$amount,"status"=>$status,"user_mobile"=>$user_mobile,"commission_amount"=>"₹ ".$commission_amount,"logo"=>$logo,"onMobile"=>$onMobile,"operator_name"=>$operator_name,"op_id"=>$op_id,"tds"=>"₹ ".$tds,"gst"=>"₹ ".$gst));
                        }
                    
                    
                    }
                 else{
                    //status not selected so all push
                           
                    array_push($response,array("amount_in_word"=>strtoupper($amount_in_word),"cause"=>$cause, "id"=>$index_id,"amount_earlier"=>"₹ ".$amount_earlier,"amount_left"=>"₹ ".$amount_left,"txn_id"=>$txn_id,"payment_type"=>$payment_type,"date"=>$date,"amount"=>"₹ ".$amount,"status"=>$status,"user_mobile"=>$user_mobile,"commission_amount"=>"₹ ".$commission_amount,"logo"=>$logo,"onMobile"=>$onMobile,"operator_name"=>$operator_name,"op_id"=>$op_id,"tds"=>"₹ ".$tds,"gst"=>"₹ ".$gst));
                    
                    }
                
                
                    }      
            
                }//insurance only Ends   
            
            //last if nothing is selected
            if ($transtype=="") {
                
                if(strpos($small_value, 'recharge') !== false) {
                        
                    $transactionType = "RECHARGE";    
                    $detailreports = $con->query("SELECT * FROM `recharge_transaction` WHERE REFERENCE_ID='$txn_id' ORDER BY ID DESC LIMIT 1");
                    if($detailreports->num_rows > 0){
                        $row_detail = $detailreports->fetch_assoc();
                        $op_id = $row_detail['LONG_CODE'];
                        $onMobile = $row_detail['MOBILE'];
                        $json_response_raw = json_decode($row_detail['RESPONSE']);
                        $json_response = json_decode($row_detail['RESPONSE']); 
                        $check = json_decode($row_detail['CHECK_RESPONSE']); 
                        $image_select = $con->query("SELECT * FROM `switchOperator` WHERE LONGCODE='$op_id' AND (SERVICETYPE = 'Prepaid' OR SERVICETYPE = 'Dth')")->fetch_assoc();
                        $logo = $opImagePath.$image_select['LOGO'];
                        $operator_name = $image_select['PRODUCTNAME'];
                        $op_id = "Recharge";
                        $operator_name = $image_select['PRODUCTNAME'];
                        $code = trim($json_response_raw->response_code);
                        $stat = $json_response_raw->status;
                        
                        
                        $detstat = strtolower($row_detail['STATUS']);

                        if (strpos($detstat, 'success') !== false) {
                            $status ="Success";
                        }
                        else if (strpos($detstat, 'pending') !== false) {
                            $status ="Pending";
                        }
                        else if (strpos($detstat, 'fail') !== false) {
                            $status ="Failed";
                        }
                        else if (strpos($detstat, 'refund') !== false) {
                            $status ="Refunded";
                        }
                        else{
                            $status ="Failed";
                        }
                        
                    }
                                     
                }
                
                if (strpos($small_value, 'bbps') !== false) {
                    $transactionType = "BBPS";
                    $detailreports = $con->query("SELECT * FROM `pay_bill_api` WHERE REFFRENCE_ID='$txn_id' ORDER BY ID DESC LIMIT 1");
                    if($detailreports->num_rows > 0){
                        $row_detail = $detailreports->fetch_assoc();
                        $op_id = $row_detail['LONG_CODE'];
                        $onMobile = $row_detail['CA_NUM'];
                        $j_response = $row_detail['RESPONSE'];
                        $json_response_raw = json_decode($row_detail['RESPONSE']);
                        $json_response = json_decode($row_detail['RESPONSE']); 
                        $image_select = $con->query("SELECT * FROM `switchOperator` WHERE LONGCODE='$op_id' AND (SERVICETYPE <>'Prepaid' AND SERVICETYPE <>'DTH') ")->fetch_assoc();
                        $logo = $opImagePath.$image_select['LOGO'];
                        $operator_name = $image_select['PRODUCTNAME'];
                        $code = $json_response_raw->response_code;
                        $stat = $json_response_raw->status;
                        $innerStatus = strtolower($row_detail['STATUS']);
                        
                        if (strpos($innerStatus, 'success') !== false){
                            $status ="Success";
                        }
                        else if (strpos($innerStatus, 'pending') !== false){
                            $status ="Pending";
                        }
                        else if (strpos($innerStatus, 'refund') !== false && strpos($innerStatus, 'fail') == false){
                            $status ="Pending";
                        }
                        else{
                            $status ="Failed";
                        }
                    }
                                     
                }
                
                if (strpos($small_value, 'dmt') !== false) {
                    
                if (strpos($small_value, 'xdmt') !== false) {
                    $transactionType = "XDMT";
                    $detailreports = $con->query("SELECT * FROM `xdmt_transactions` WHERE REFFRENCE_ID='$txn_id' ORDER BY ID DESC LIMIT 1");   
                }
                else{
                    $transactionType = "DMT";
                    $detailreports = $con->query("SELECT * FROM `dmt_transactions` WHERE REFFRENCE_ID='$txn_id' ORDER BY ID DESC LIMIT 1");
                }
                    
                    if($detailreports->num_rows > 0){
                        $row_detail = $detailreports->fetch_assoc();
                        $op_id = $row_detail['BENE_ID']; //Beneficiary Id// 
                        $onMobile = $row_detail['ACCOUNT'];
                        $j_response = $row_detail['RESPONSE'];
                        $json_response_raw = json_decode($row_detail['RESPONSE']);
                        $json_response = json_decode($row_detail['RESPONSE']); 
                        /*$image_select = $con->query("SELECT * FROM `operator_list` WHERE OPERATOR_CODE='$op_id'")->fetch_assoc();
                        $logo = $opImagePath.$image_select['LOGO'];
                        $operator_name = $image_select['NAME'];*/
                        $logo = $dmtImagePath;
                        $operator_name = "DMT";
                        $code = $json_response->response_code;
                        $stat = $json_response->status;
                        $innerStatus = strtolower($row_detail['STATUS']);
                        
                        if (strpos($innerStatus, 'success') !== false){
                            $status ="Success";
                        }
                        else if (strpos($innerStatus, 'accepted') !== false){
                            $status ="Pending";
                        }
                        else if (strpos($innerStatus, 'pending') !== false){
                            $status ="Pending";
                        }
                        else if (strpos($innerStatus, 'refund') !== false && strpos($innerStatus, 'fail') == false){
                            $status ="Pending";
                        }
                        else{
                            $status ="Failed";
                        }
                    }
                                     
                }
                
                if (strpos($small_value, 'upi') !== false) {
                    
                    $transactionType = "UPI";
                    $detailreports = $con->query("SELECT * FROM `upi_transactions` WHERE REFFRENCE_ID='$txn_id' ORDER BY ID DESC LIMIT 1");
                    
                    if($detailreports->num_rows > 0){
                        $row_detail = $detailreports->fetch_assoc();
                        $op_id = $row_detail['MOBILE']; //Beneficiary Id// 
                        $onMobile = $row_detail['UPI_ID'];
                        $j_response = $row_detail['RESPONSE'];
                        $json_response_raw = json_decode($row_detail['RESPONSE']);
                        $json_response = json_decode($row_detail['RESPONSE']); 
                        /*$image_select = $con->query("SELECT * FROM `operator_list` WHERE OPERATOR_CODE='$op_id'")->fetch_assoc();
                        $logo = $opImagePath.$image_select['LOGO'];
                        $operator_name = $image_select['NAME'];*/
                        $logo = $dmtImagePath;
                        $operator_name = "UPI";
                        $innerStatus = strtolower($row_detail['STATUS']);
                        
                        if (strpos($innerStatus, 'success') !== false){
                            $status ="Success";
                        }
                        else if (strpos($innerStatus, 'process') !== false){
                            $status ="Success";
                        }
                        else if (strpos($innerStatus, 'accepted') !== false){
                            $status ="Pending";
                        }
                        else if (strpos($innerStatus, 'pending') !== false){
                            $status ="Pending";
                        }
                        else if (strpos($innerStatus, 'refund') !== false && strpos($innerStatus, 'fail') == false){
                            $status ="Refunded";
                        }
                        else{
                            $status ="Failed";
                        }
                    }
                                     
                }
                
                if (strpos($small_value, 'cms') !== false) {
                    $transactionType = "CMS";
                    $detailreports = $con->query("SELECT * FROM `cms_transaction` WHERE REFFRENCE_ID='$txn_id' AND US_ID='$user_id'");
                    if($detailreports->num_rows > 0){
                        $row_detail = $detailreports->fetch_assoc();
                        $op_id = $row_detail['BENE_ID']; //Beneficiary Id// 
                        $onMobile = $row_detail['ACCOUNT'];
                        $j_response = $row_detail['RESPONSE'];
                        $json_response_com = $row_detail['COM_RESPONSE'];
                        $logo = $cmsImagePath;
                        $operator_name = "CMS";
                        
                        if($j_response!=null || $j_response!=""){
                             $status ="Success";   
                        }
                        else{
                            $status ="Failed";
                        }

                    }
                                     
                }
                
                if (strpos($small_value, 'payment') !== false) {
                    $transactionType = "PAYMENTGATEWAY";
                    $detailreports = $con->query("SELECT * FROM `payment_gatweay` WHERE REFFRENCE_ID='$txn_id' AND US_ID='$user_id'");
                    if($detailreports->num_rows > 0){
                        $row_detail = $detailreports->fetch_assoc();
                        $op_id = $row_detail['BENE_ID']; //Beneficiary Id// 
                        $onMobile = $row_detail['ACCOUNT'];
                        $j_response = $row_detail['RESPONSE'];
                        $json_response_com = $row_detail['COM_RESPONSE'];
                        $logo = $cmsImagePath;
                        $operator_name = "CMS";
                        
                        if($j_response!=null || $j_response!=""){
                             $status ="Success";   
                        }
                        else{
                            $status ="Failed";
                        }
                    }
                                     
                }
                
                if (strpos($small_value, 'payout') !== false) {
                    
                    $transactionType = "PAYOUT";
                    $detailreports = $con->query("SELECT * FROM `payout_transaction` WHERE REFFRENCE_ID='$txn_id' ");
                    if($detailreports->num_rows > 0){
                        $row_detail = $detailreports->fetch_assoc();
                        
                        $op_id = "Transaction";
                        $onMobile = $row_detail['ACCOUNT'];
                        $j_response = $row_detail['RESPONSE'];
                        $json_response_raw = json_decode($row_detail['RESPONSE']);
                        /*$json_response = json_decode($row_detail['RESPONSE']); 
                        $image_select = $con->query("SELECT * FROM `operator_list` WHERE OPERATOR_CODE='$op_id'")->fetch_assoc();
                        $logo = $opImagePath.$image_select['LOGO'];
                        $operator_name = $image_select['NAME'];*/
                        $operator_name = "Payout";
                        $logo = $payoutImagePath;
                        $code = trim($json_response_raw->response_code);
                        $stat = $json_response_raw->status;
                        $resp_status = strtolower($row_detail['STATUS']);
                        if((strpos($resp_status, 'success') !== false) || (strpos($resp_status, 'sucess') !== false)){
                            $status ="Success";
                        }
                        else if(strpos($resp_status, 'pending') !== false){
                            $status ="Pending";
                        }
                        else if(strpos($resp_status, 'accepted') !== false){
                            $status ="Pending";
                        }
                        else if(strpos($resp_status, 'refund') !== false){
                            $status ="Refunded";
                        }
                        else{
                            $status ="Failed";
                        }
                        
                        
                        if($gst=="0"){
                            $gst= ($amount/100)*18;
                        }
                        
                        // $gst = "sbjbsajkfbjkds";
                    }
                                     
                }
                
                if (strpos($small_value, 'aeps') !== false) {
                    $transactionType = "AEPS";
                    $detailreports = $con->query("SELECT * FROM `aeps_transactions` WHERE REFFRENCE_ID='$txn_id' ORDER BY ID DESC LIMIT 1");
                    if($detailreports->num_rows > 0){
                        $row_detail = $detailreports->fetch_assoc();
                        $op_id = $row_detail['TRANS_TYPE'];
                        
                        if(trim(strtolower($row_detail['API'])) == "fingpay"){
                            $transactionType = "AEPS-1";
                        }else{
                            $transactionType = "AEPS-2";
                        }
                        
                        
                        
                        if($op_id=="M"){
                            $op_id="Aadhar Pay";
                        }
                        else if($op_id=="MS"){
                            $op_id="Mini Statement";
                        }
                        else if($op_id=="CW"){
                            $op_id="Cash Withdraw";
                        }
                        else if($op_id=="BE"){
                            $op_id="Balance Enquiry";
                        }
                        
                        $savedAadhar = $row_detail['MOBILE'];
                        $j_response = $row_detail['RESPONSE'];
                        $json_response_raw = json_decode($row_detail['RESPONSE']);
                        $operator_name = "AEPS";
                        $logo = $aepsImagePath;

                        $onMobile = $row_detail['MOBILE'];
                        
                        $innerStatus = strtolower($row_detail['STATUS']);
                        
                        if (strpos($innerStatus, 'success') !== false){
                            $status ="Success";
                        }
                        else if (strpos($innerStatus, 'pending') !== false){
                            $status ="Pending";
                        }
                        else if (strpos($innerStatus, 'refund') !== false && strpos($innerStatus, 'fail') == false){
                            $status ="Pending";
                        }
                        else{
                            $status ="Failed";
                        }
                    }
                                     
                }
                
                if (strpos($small_value, 'atm') !== false) {
                    $transactionType = "ATM";
                    $detailreports = $con->query("SELECT * FROM `micro_atm` WHERE TXNID='$txn_id' ORDER BY ID DESC LIMIT 1");
                    if($detailreports->num_rows > 0){
                        $row_detail = $detailreports->fetch_assoc();
                        $op_id = $row_detail['BANKRRN'];
                        $onMobile = $row_detail['CARDNUMBER'];
                        $res_val = strtolower($row_detail['RESPONSE']);
                        $j_response = $row_detail['RESPONSE'];
                        /*$json_response_raw = json_decode($row_detail['RESPONSE']);
                        $json_response = json_decode($row_detail['RESPONSE']); 
                        $image_select = $con->query("SELECT * FROM `operator_list` WHERE OPERATOR_CODE='$op_id'")->fetch_assoc();
                        $logo = $opImagePath.$image_select['LOGO'];
                        $operator_name = $image_select['NAME'];*/
                        $operator_name = $row_detail['BANKNAME'];
                        $logo = $atmImagePath;
                        if($res_val=="1"){
                            $status ="Success";
                        }
                        else if($res_val==1){
                            $status ="Success";
                        }
                        else{
                            $status ="Failed";
                        }
                    }
                                     
                }
                
                if (strpos($small_value, 'deposit') !== false) {
                    $transactionType = "DEPOSIT";
                    $detailreports = $con->query("SELECT * FROM `cash_deposit_transaction` WHERE REFFRENCE_ID='$txn_id' ORDER BY ID DESC LIMIT 1");
                    if($detailreports->num_rows > 0){
                        $row_detail = $detailreports->fetch_assoc();
                        $onMobile = $row_detail['ACC_NUM'];
                        $json_response_raw = json_decode($row_detail['RESPONSE']);
                        $json_response = json_decode($row_detail['RESPONSE']); 
                        $op_id = $json_response->mobile; 
                        /*$image_select = $con->query("SELECT * FROM `operator_list` WHERE OPERATOR_CODE='$op_id'")->fetch_assoc();
                        $logo = $opImagePath.$image_select['LOGO'];
                        $operator_name = $image_select['NAME'];*/
                        $operator_name = "Cash Deposit";
                        $logo = $dmtImagePath;
                        $resp_status = strtolower($row_detail['STATUS']);
                        if((strpos($resp_status, 'success') !== false) || (strpos($resp_status, 'sucess') !== false)){
                            $status ="Success";
                        }
                        else if(strpos($resp_status, 'pending') !== false){
                            $status ="Pending";
                        }
                        else if(strpos($resp_status, 'refund') !== false){
                            $status ="Refunded";
                        }
                        else{
                            $status ="Failed";
                        }
                        
                        
                    }
                
                } 
                
                if (strpos($small_value, 'fund') !== false) {
                        $transactionType = "FUND";
                    $detailreports = $con->query("SELECT * FROM `report` WHERE REFERENCE_ID='$txn_id' AND USER_ID='$user_id'");
                    if($detailreports->num_rows > 0){
                        $row_detail = $detailreports->fetch_assoc();
                        $op_id = $row_detail['TRANS_TYPE'];
                        $onMobile = $row_detail['REMARK'];
                        $j_response = $row_detail['RESPONSE'];
                        /*$json_response_raw = json_decode($row_detail['RESPONSE']);
                        $json_response = json_decode($row_detail['RESPONSE']); 
                        $image_select = $con->query("SELECT * FROM `operator_list` WHERE OPERATOR_CODE='$op_id'")->fetch_assoc();
                        $logo = $opImagePath.$image_select['LOGO'];
                        $operator_name = $image_select['NAME'];*/
                        $operator_name = "Fund Transfer";
                        $logo = $fundImagePath;
                        if($amount_earlier!=$amount_left){
                            $status ="Success";
                        }
                        else{
                            $status ="Failed";
                        }
                    }
                                     
                }
                
                if (strpos($small_value, 'fastag') !== false) {
                    $transactionType = "FASTAG";
                    $detailreports = $con->query("SELECT * FROM `fastag_transaction` WHERE REFFRENCE_ID='$txn_id' ORDER BY ID DESC LIMIT 1");
                    if($detailreports->num_rows > 0){
                        $row_detail = $detailreports->fetch_assoc();
                        $onMobile = $row_detail['CA_NUM'];
                        $json_response_raw = json_decode($row_detail['RESPONSE']);
                        $json_response = json_decode($row_detail['RESPONSE']); 
                        $json_send = json_decode($row_detail['SEND_DATA']); 
                        $op_id = $json_send->operator;  
                        $image_select = $con->query("SELECT * FROM `switchOperator` WHERE LONGCODE='$op_id'")->fetch_assoc();
                        $logo = $opImagePath.$image_select['LOGO'];
                        $op_id = $image_select['PRODUCTNAME'];
                        $operator_name = "FastAg";
                        // $logo = $dmtImagePath;
                        $resp_status = strtolower($row_detail['STATUS']);
                        if((strpos($resp_status, 'success') !== false) || (strpos($resp_status, 'sucess') !== false)){
                            $status ="Success";
                        }
                        else if(strpos($resp_status, 'pending') !== false){
                            $status ="Pending";
                        }
                        else if(strpos($resp_status, 'refund') !== false){
                            $status ="Refunded";
                        }
                        else{
                            $status ="Failed";
                        }
                        
                        
                    }
                
                }
                
                if (strpos($small_value, 'lic') !== false) {
                
                $transactionType = "LIC";
                    $detailreports = $con->query("SELECT * FROM `lic_transaction` WHERE REFFRENCE_ID='$txn_id' ORDER BY ID DESC LIMIT 1");
                    if($detailreports->num_rows > 0){
                        $row_detail = $detailreports->fetch_assoc();
                        $json_response_raw = json_decode($row_detail['SEND_DATA']);
                        $json_response = json_decode($row_detail['RESPONSE']); 
                        $op_id = ""; 
                        $onMobile = $json_response_raw->canumber;
                        $operator_name = "LIC";
                        $logo = $dmtImagePath;
                        $resp_status = strtolower($row_detail['STATUS']);
                        if((strpos($resp_status, 'success') !== false) || (strpos($resp_status, 'sucess') !== false)){
                            $status ="Success";
                        }
                        else if(strpos($resp_status, 'pending') !== false){
                            $status ="Pending";
                        }
                        else{
                            $status ="Failed";
                        }
                    }
                }
                
                if (strpos($small_value, 'pan coupon') !== false) {
                    
                    $transactionType = "PAN";
                    $detailreports = $con->query("SELECT * FROM `pan_transaction` WHERE TRANSACTION_ID='$txn_id' ORDER BY ID DESC LIMIT 1");
                    if($detailreports->num_rows > 0){
                        $row_detail = $detailreports->fetch_assoc();
                        $op_id = "Coupon Request";
                        $onMobile = $row_detail['NUMBER_OF_COUPON']." Coupon";
                        $j_response = $row_detail['RESPONSE'];
                        /*$json_response_raw = json_decode($row_detail['RESPONSE']);
                        $json_response = json_decode($row_detail['RESPONSE']); 
                        $image_select = $con->query("SELECT * FROM `operator_list` WHERE OPERATOR_CODE='$op_id'")->fetch_assoc();
                        $logo = $opImagePath.$image_select['LOGO'];
                        $operator_name = $image_select['NAME'];*/
                        $operator_name = "Pan Coupon Request";
                        $logo = $panImagePath;

                        $status = $row_detail['STATUS'];
                        
                        if($status == "Requested"){
                            $status = "Pending";
                        }
                    }
                                     
                }
                
                if (strpos($small_value, 'pan') !== false) {
                    
                    $transactionType = "PAN";
                    $detailreports = $con->query("SELECT * FROM `pan_coupen` WHERE OD_ID='$txn_id' AND USID='$user_id'");
                    if($detailreports->num_rows > 0){
                        $row_detail = $detailreports->fetch_assoc();
                        $op_id = "Coupon Request";
                        $onMobile = $row_detail['NUM']." Coupon";
                        $j_response = $row_detail['RESPONSE'];
                        $operator_name = "Pan Coupon Request";
                        $logo = $panImagePath;

                        $status = $row_detail['STATUS'];
                        if($status == "Requested"){
                            $status = "Pending";
                        }
                    }
                                     
                }
                
                
                if($j_response==null){
                    $j_response = "";
                }
                
                //status condition
                if($result =="success"){
                        //success selection push
                        if($status =="Success"){
                            
                            array_push($response,array("amount_in_word"=>strtoupper($amount_in_word),"transactionType"=>$transactionType, "cause"=>$cause, "id"=>$index_id,"amount_earlier"=>"₹ ".$amount_earlier,"amount_left"=>"₹ ".$amount_left,"txn_id"=>$txn_id,"payment_type"=>$payment_type,"date"=>$date,"amount"=>"₹ ".$amount,"status"=>$status,"user_mobile"=>$user_mobile,"commission_amount"=>"₹ ".$commission_amount,"logo"=>$logo,"onMobile"=>$onMobile,"operator_name"=>$operator_name,"op_id"=>$op_id,"tds"=>"₹ ".$tds,"gst"=>"₹ ".$gst));
                        }
            
                    }
                    else if($result=="failed"){
                    
                    //failed selection push
                    
                        if($status =="Failed"){
                            
                            array_push($response,array("amount_in_word"=>strtoupper($amount_in_word),"transactionType"=>$transactionType, "cause"=>$cause, "id"=>$index_id,"amount_earlier"=>"₹ ".$amount_earlier,"amount_left"=>"₹ ".$amount_left,"txn_id"=>$txn_id,"payment_type"=>$payment_type,"date"=>$date,"amount"=>"₹ ".$amount,"status"=>$status,"user_mobile"=>$user_mobile,"commission_amount"=>"₹ ".$commission_amount,"logo"=>$logo,"onMobile"=>$onMobile,"operator_name"=>$operator_name,"op_id"=>$op_id,"tds"=>"₹ ".$tds,"gst"=>"₹ ".$gst));
                        }
                    
                    
                    }
                 else{
                    //status not selected so all push
                     
                    array_push($response,array("amount_in_word"=>strtoupper($amount_in_word),"transactionType"=>$transactionType, "cause"=>$cause, "id"=>$index_id,"amount_earlier"=>"₹ ".$amount_earlier,"amount_left"=>"₹ ".$amount_left,"txn_id"=>$txn_id,"payment_type"=>$payment_type,"date"=>$date,"amount"=>"₹ ".$amount,"status"=>$status,"user_mobile"=>$user_mobile,"commission_amount"=>"₹ ".$commission_amount,"logo"=>$logo,"onMobile"=>$onMobile,"operator_name"=>$operator_name,"op_id"=>$op_id,"tds"=>"₹ ".$tds,"gst"=>"₹ ".$gst));
                    
                    }
            

            }
         
         
         //last line to push   
        }
        
        echo json_encode($response);
    }    
    else{
        echo json_encode($response);
    }


function decrypt__adhar($encryption){
    $ciphering = "AES-128-CTR";
     $decryption_iv = 'ThisIsSecretKeyForEncrytionByJisneYeBnaya!@#$%^&*()';
    $decryption_key = "WebSpidy";
    // Using openssl_decrypt() function to decrypt the data 
    $decryption = openssl_decrypt(base64_decode($encryption), $ciphering, $decryption_key, 0, $decryption_iv);
    return $decryption;
}


function getIndianCurrency($mynum)
{
    $number = (float)$mynum;
    
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