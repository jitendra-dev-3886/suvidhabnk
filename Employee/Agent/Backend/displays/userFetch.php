<?php

    include("../../../Db/config.php");
    include("../Userinfo/getuserinfo.php");
    include("../Functions/all_function.php");
    include("../Auth/userdata.php");
    include("../../../mobile_phone/includes/imagepaths.php");
    
    if($_POST['help_support'] == "help_support"){
        
        $qry=$con->query("SELECT * FROM `contact_support` WHERE ID='1'")->fetch_assoc();
    
        echo json_encode([
                "email"=>$qry['EMAIL'],
                "mobile"=>$qry['PHONE']
            ]);
            exit;
    }
    
    if($_POST['fetch_all']=="fetch_all"){
        
        $userData = [
                "email"=>$user["EMAIL"],
                "mobile"=>$user["MOBILE"],
                "password"=>$user["PASSWORD"],
                "name"=>$user['FIRST_NAME'],
                "lastname"=>$user['LAST_NAME'],
                "ownerid"=>$user['MAIN_OWNER_ID'],
                "ownerstatus"=>$user['MAIN_OWNER'],
                "userstatus"=>$user['USER_TYPE'],
                "token"=>$user['TOKEN_ID'],
                "id"=>$user['ID'],
                "mainbalance"=>number_format($user['MAIN_BAL'], 1, '.', ''),
                "aepsbalance"=>number_format($user['AEPS_BAL'], 1, '.', ''),
                "pin"=>$user['PIN'],
                "address"=>$user['ADDRESS'],
                "us_status"=>$user['US_STATUS']
        ];
        $profile['PROFILE_IMG'] = $dpPath.'/'.$profile['PROFILE_IMG'];
        $recieveable = ["user"=>$userData, "userProfile"=>$profile];
        echo json_encode(["message"=>"Success", "response_code"=>1, "status"=>true, "receivableData"=>$recieveable]);
    }
    
    
    if(isset($_POST['fingpay'])){
        if(!empty($fingpayMerchant)){
            $fingpayMerchant['SUPERMERCHANT'] = "969";
        }
        
        
        $toBoard = [
          'toBoard'=>empty($fingpayMerchant),
          'api_cred'=>null,
          'merchant_cred'=>$fingpayMerchant,
        ];
        echo json_encode($toBoard);
    }
    
    
    
    if($_POST['paysprint_cred']=="paysprint_cred"){
        
        $user_mobile = $user['MOBILE'];
    
        $mysql_qry = "select * FROM aeps_merchant WHERE MOBILE ='$user_mobile' and STATUS='1'";
        $result = mysqli_query($con ,$mysql_qry);
        if(mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_array($result);
                
                $myArr = array(
                "result" =>true,
                "message" =>"Access Granted",
                "ref_no" =>$row['REF_NO'],
                "txn_id" =>$row['TXN_ID'],
                "status" =>$row['STATUS'],
                "partnerid" =>$row['PARTNERID'],
                "merchantcode" =>$row['MERCHANTCODE'],
                "isicicikyc" =>$row['IS_ICICI_KYC'],
                "timestamp" =>$row['TIMESTAMP'],
                "owner" =>$row['OWNER'],
                "ownerid"=>$row['OWNER_ID'],
                "api_firm"=>$paysprint['FIRM'],
                "api_jwt"=>$paysprint['JWT_KEY'],
                "api_mechant_code"=>$paysprint['MERCHANT_CODE'],
                "api_partner_id"=>$paysprint['PARTNER_ID']
                );
        

            echo json_encode(["message"=>"Success", "response_code"=>1, "status"=>true, "receivableData"=>$myArr]);
            exit;
        }
        else{
            
            $myArr = array(
                "result" =>false,
                "message" =>"Not Granted",
                "ref_no" =>"",
                "txn_id" =>"",
                "status" =>"",
                "partnerid" =>"",
                "merchantcode" =>"",
                "isicicikyc" =>"",
                "timestamp" =>"",
                "owner" =>"",
                "ownerid"=>"",
                "api_firm"=>$paysprint['FIRM'],
                "api_jwt"=>$paysprint['JWT_KEY'],
                "api_mechant_code"=>$paysprint['MERCHANT_CODE'],
                "api_partner_id"=>$paysprint['PARTNER_ID']
                );
        
             $recieveable = ["user"=>$userData, "userProfile"=>$profile];
            echo json_encode(["message"=>"Success", "response_code"=>1, "status"=>true, "receivableData"=>$myArr]);
            exit;
            
        }
        
    }
    
    
    if($_POST['fetchBeneficiary']=="fetchBeneficiary"){
        
        extract($_POST);
        
        $response = array();
        
        $op = $con->query("select * FROM cashfree_beneficiary WHERE REMIT_MOBILE='$remitMobile' ORDER BY ID DESC");
        // $op = $con->query("select * FROM cashfree_beneficiary WHERE US_ID='$usid' and REMIT_MOBILE='$remitMobile' ORDER BY ID DESC");
        if($op->num_rows > 0)
        {
         while($row = $op->fetch_assoc()){

            $res = $row['VERIFY_RESPONSE'];
            $rspns = json_decode($res , true);
            $benename = $rspns['result']['bankTransfer']['beneName'];
            $bankrrn = $rspns['result']['bankTransfer']['bankRRN'];
            $active = $rspns['result']['active'];
            $mobileMatch = $rspns['result']['mobileMatch'];
            $nameMatch = $rspns['result']['nameMatch'];
            
            if($bankrrn!="" && $active!=""){
                $isVerified = true;
            }
            else{
                $isVerified = false;
            }
            array_push($response,array("ID"=>$row["ID"],"NAME"=>$row['NAME'],"EMAIL"=>$row['EMAIL'],"MOBILE"=>$row['MOBILE'],"ACCOUNT"=>$row['ACCOUNT'],"IFSC"=>$row['IFSC'],"ADDRESS"=>$row['ADDRESS'],"BENEID"=>$row['BENEID'],"DATE"=>$row['DATE'],"isVerified"=>$isVerified));

         }
             echo json_encode(["message"=>"Success", "response_code"=>1, "status"=>true, "receivableData"=>$response]);
        }
        else{
            
            echo json_encode(["message"=>"No Records", "response_code"=>2, "status"=>false]);
        }    
        
    }
    
    
    if(isset($_POST['pan_agent'])){
        
        $qry=$con->query("SELECT * FROM `pan_agent` WHERE US_ID='$usid' ORDER BY ID DESC LIMIT 1")->fetch_assoc();
        if($qry == null){
            $status = 5; 
        }
        else if(strtolower($qry['STATUS']) =="approved"){
            $status = 1;
        }
        else if(strtolower($qry['STATUS']) =="success"){
            $status = 1;
        }
        else if(strtolower($qry['STATUS']) =="pending"){
            $status = 2;
        }
        else if(strtolower($qry['STATUS']) =="rejected"){
            $status = 3;
        }
        else{
           $status = 5; 
        }
    
        
        $toBoard = [
          'toBoard'=>empty($toBoard),
          'status'=>$status,
          'merchant_cred'=>$qry,
        ];
        echo json_encode($toBoard);
    }
    
    
    
    if($_POST['panCouponData']=="panCouponData"){
        
        
        $op = $con->query("SELECT * FROM `pan_coupon` WHERE ID='1'");
        if($op->num_rows > 0)
        {
             $qry=$con->query("SELECT * FROM `pan_coupon` WHERE ID='1'")->fetch_assoc();
             echo json_encode(["message"=>"Success, Information fetched", "response_code"=>1, "status"=>true, "receivableData"=>$qry]);
        }
        else{
            
            echo json_encode(["message"=>"No Data, Ask Admin to provide pan information.", "response_code"=>2, "status"=>false]);
        }    
    }
    
    
    
    if($_POST['vehicleHistory']=="vehicleHistory"){
        
        extract($_POST);

        $response = array();
        
        $op = $con->query("select * FROM vehicle_registration WHERE USER_ID='$usid' and INSURANCE_TYPE='$insurance_type' and VEHICLE_NUMBER LIKE '%$vnum%' ORDER BY ID DESC ");
        if($op->num_rows > 0)
        {
         while($row = $op->fetch_assoc()){
            
            if($row['RESPONSE_DATA']== null || $row['RESPONSE_DATA'] ==""){
                $res = null;
            }
            else{
                $res = json_decode($row['RESPONSE_DATA']);  
            }
        
            array_push($response,array("RESPONSE_DATA"=>$res,"ID"=>$row["ID"],"INSURANCE_TYPE"=>$row['INSURANCE_TYPE'],"VEHICLE_OWNER"=>$row['VEHICLE_OWNER'],"WHATSAPP_NUMBER"=>$row['WHATSAPP_NUMBER'],"VEHICLE_NUMBER"=>$row['VEHICLE_NUMBER'],"INSURANCE_DOC"=>$row['INSURANCE_DOC'],"RT_COMM"=>$row['RT_COMM'],"DT_COMM"=>$row['DT_COMM'],"STATUS"=>$row['STATUS'],"REQUEST_DATE"=>$row['REQUEST_DATE'],"FILTER_DATE"=>$row['FILTER_DATE']));

         }
             echo json_encode(["message"=>"Success", "response_code"=>1, "status"=>true, "receivableData"=>$response]);
        }
        else{
            
            echo json_encode(["message"=>"No Records", "response_code"=>2, "status"=>false]);
        }    
        
    }
    
    
    if($_POST['etaxHistory']=="etaxHistory"){
        
        extract($_POST);

        $response = array();
        
        $op = $con->query("select * FROM etax WHERE USER_ID='$usid' and TYPE ='$type' and MOBILE LIKE '%$mobile%' ORDER BY ID DESC ");
        if($op->num_rows > 0)
        {
         while($row = $op->fetch_assoc()){
        
            array_push($response,array("ID"=>$row["ID"],"USER_ID"=>$row['USER_ID'],"NAME"=>$row['NAME'],"MOBILE"=>$row['MOBILE'],"TYPE"=>$row['TYPE'],"REFERENCE_ID"=>$row['REFERENCE_ID'],"STATUS"=>$row['STATUS'],"DATE"=>$row['DATE']));

         }
             echo json_encode(["message"=>"Success", "response_code"=>1, "status"=>true, "receivableData"=>$response]);
        }
        else{
            
            echo json_encode(["message"=>"No Records", "response_code"=>2, "status"=>false]);
        }    
        
    }
    
    
    if($_POST['loanHistory']=="loanHistory"){
        
        extract($_POST);

        
        $response = array();
        
        $op = $con->query("select * FROM loan_request WHERE USER_ID='$usid' and LOAN_TYPE='$loan_type' and MOBILE_NO LIKE '%$mnum%' ORDER BY ID DESC ");
        if($op->num_rows > 0)
        {
         while($row = $op->fetch_assoc()){
            
            array_push($response,array("ID"=>$row["ID"],"LOAN_TYPE"=>$row['LOAN_TYPE'],"CUSTOMER_NAME"=>$row['CUSTOMER_NAME'],
            
            "MOBILE_NO"=>$row['MOBILE_NO'],"PROFESSION"=>$row['PROFESSION'],"INCOME"=>$row['INCOME'],"REQUIRE_LOAN"=>$row['REQUIRE_LOAN'],
            "APPROVED_LOAN_AMT"=>$row['APPROVED_LOAN_AMT'],"AADHAR_CARD_FRONT"=>$row['AADHAR_CARD_FRONT'],
            "AADHAR_CARD_BACK"=>$row['AADHAR_CARD_BACK'],"PAN_CARD"=>$row['PAN_CARD'],
            "SALARY_SLIP"=>$row['SALARY_SLIP'],"BANK_STATEMENT"=>$row['BANK_STATEMENT'],
            "ITR"=>$row['ITR'],"USER_REMARK"=>$row['USER_REMARK'],"ADMIN_REMARK"=>$row['ADMIN_REMARK'],"REQUEST_DATE"=>$row['REQUEST_DATE'],
            "RESPONSE_DATE"=>$row['RESPONSE_DATE'],"STATUS"=>$row['STATUS'],"RT_COMM"=>$row['RT_COMM'],"DT_COMM"=>$row['DT_COMM'],"DATE"=>$row['DATE']
            ));

         }
             echo json_encode(["message"=>"Success", "response_code"=>1, "status"=>true, "receivableData"=>$response]);
        }
        else{
            
            echo json_encode(["message"=>"No Records", "response_code"=>2, "status"=>false]);
        }    
        
    }
    
    
    
    if($_POST['panTransactions']=="panTransactions"){
        
        extract($_POST);

        
        $response = array();
        
        $op = $con->query("select * FROM pan_transaction WHERE USER_ID='$usid' AND TRANSACTION_ID LIKE '%$transaction_id%' ORDER BY ID DESC LIMIT 5000");
        if($op->num_rows > 0)
        {
         while($row = $op->fetch_assoc()){
            
            array_push($response,array("TRANSACTION_ID"=>$row['TRANSACTION_ID'],"ID"=>$row["ID"],"USER_ID"=>$row['USER_ID'],"NUMBER_OF_COUPON"=>$row['NUMBER_OF_COUPON'],"AMOUNT"=>$row['AMOUNT'],"RT_COMM"=>$row['RT_COMM'],"DT_COMM"=>$row['DT_COMM'],"STATUS"=>$row['STATUS'],"DATE"=>$row['DATE']));

         }
             echo json_encode(["message"=>"Success", "response_code"=>1, "status"=>true, "receivableData"=>$response]);
        }
        else{
            
            echo json_encode(["message"=>"No Records", "response_code"=>2, "status"=>false]);
        }    
        
    }
    
    if($_POST['ticketHistory']=="ticketHistory"){
        
        extract($_POST);

        
        $response = array();
        
        $op = $con->query("select * FROM ticket WHERE USER_ID='$usid' AND TRANSACTION_ID LIKE '%$transaction_id%' ORDER BY ID DESC LIMIT 5000");
        if($op->num_rows > 0)
        {
         while($row = $op->fetch_assoc()){
            
            array_push($response,array("EMPLOYEE_ID"=>$row['EMPLOYEE_ID'],"ID"=>$row["ID"],"USER_ID"=>$row['USER_ID'],"DEPARTMENT"=>$row['DEPARTMENT'],"TRANSACTION_ID"=>$row['TRANSACTION_ID'],"DESCRIPTION"=>$row['DESCRIPTION'],"PROOF"=>$row['PROOF'],"REMARK"=>$row['REMARK'],"STATUS"=>$row['STATUS'],"ISSUE_DATE"=>$row['ISSUE_DATE'],"ACTION_DATE"=>$row['ACTION_DATE']));

         }
             echo json_encode(["message"=>"Success", "response_code"=>1, "status"=>true, "receivableData"=>$response]);
        }
        else{
            
            echo json_encode(["message"=>"No Records", "response_code"=>2, "status"=>false]);
        }    
        
    }
    
    
    
    if(isset($_POST['panCoupons'])){
        
        extract($_POST);

        
        $response = array();
        
        $op = $con->query("select * FROM pan_coupen WHERE USID='$usid' AND OD_ID LIKE '%$transaction_id%' ORDER BY ID DESC LIMIT 5000");
        if($op->num_rows > 0)
        {
         while($row = $op->fetch_assoc()){
            
            array_push($response, $row);

         }
             echo json_encode(["message"=>"Success", "response_code"=>1, "status"=>true, "receivableData"=>$response]);
        }
        else{
            
            echo json_encode(["message"=>"No Records", "response_code"=>2, "status"=>false]);
        }    
        
    }
    
    
    
    if($_POST['requestedHistory']=="requestedHistory"){
        
        extract($_POST);

        
        $response = array();
        
        $op = $con->query("select * FROM fund WHERE USER_ID='$usid' AND REFFRENCE_ID LIKE '%$trans_id%' ORDER BY ID DESC LIMIT 5000");
        if($op->num_rows > 0)
        {
         while($row = $op->fetch_assoc()){
            
            array_push($response,array("AMOUNT"=>$row['AMOUNT'],"ID"=>$row["ID"],"USER_ID"=>$row['USER_ID'],"TRANSACTION_ID"=>$row['REFFRENCE_ID'],"PAYMENT_MODE"=>$row['PAYMENT_MODE'],"REMARK"=>$row['REMARK'],"STATUS"=>$row['STATUS'],"DATE"=>$row['DATE'],"FUND_TYPE"=>$row['FUND_TYPE']));

         }
             echo json_encode(["message"=>"Success", "response_code"=>1, "status"=>true, "receivableData"=>$response]);
        }
        else{
            
            echo json_encode(["message"=>"No Records", "response_code"=>2, "status"=>false]);
        }    
        
    }
    
    
    
    if($_POST['payout_account_disp']=="payout_account_disp"){
        
        $mysql_qry = "SELECT * FROM payout_users WHERE US_ID ='$usid' AND STATUS ='Success' ORDER BY ID DESC LIMIT 1";
        $result = mysqli_query($con ,$mysql_qry);
        if(mysqli_num_rows($result) > 0) {
            
            $row = mysqli_fetch_array($result);
            echo json_encode(["message"=>"Success", "response_code"=>1, "status"=>true, "receivableData"=>$row]);
        }
        else{
            
            echo json_encode(["message"=>"Payout Account Doesn't Exist, Contact Admin", "response_code"=>2, "status"=>false]);
        } 
      
    }
    
    
    if($_POST['virtual_account_disp']=="virtual_account_disp"){
        
        $mysql_qry = "SELECT * FROM virtual_account WHERE USER_ID ='$usid' ORDER BY ID DESC LIMIT 1";
        $result = mysqli_query($con ,$mysql_qry);
        if(mysqli_num_rows($result) > 0) {
            
            $row = mysqli_fetch_array($result);
            echo json_encode(["message"=>"Success", "response_code"=>1, "status"=>true, "receivableData"=>$row]);
        }
        else{
            echo json_encode(["message"=>"Virtual Account Doesn't Exist, Contact Admin", "response_code"=>2, "status"=>false]);
        } 
      
    }
    
    
    if($_POST['pdmt_history']=="pdmt_history"){
        
        $mb = $_POST['remitter_mobile'];
        
        $mysql_qry = "SELECT * FROM dmt_transactions WHERE USER_ID ='$usid' AND MOBILE ='$mb' AND APINAME ='CASHFREE' ORDER BY ID DESC";
        $result = mysqli_query($con ,$mysql_qry);
        if(mysqli_num_rows($result) > 0) {
            
            $row = mysqli_fetch_all($result, MYSQLI_ASSOC);
            echo json_encode(["message"=>"Success", "response_code"=>1, "status"=>true, "receivableData"=>$row]);
        }
        else{
            echo json_encode(["message"=>"No Records", "response_code"=>2, "status"=>false]);
        } 
      
    }
    
    if($_POST['pxdmt_history']=="pxdmt_history"){
        
        $mb = $_POST['remitter_mobile'];
        
        $mysql_qry = "SELECT * FROM xdmt_transactions WHERE USER_ID ='$usid' AND MOBILE ='$mb' AND APINAME ='CASHFREE' ORDER BY ID DESC";
        $result = mysqli_query($con ,$mysql_qry);
        if(mysqli_num_rows($result) > 0) {
            
            $row = mysqli_fetch_all($result, MYSQLI_ASSOC);
            echo json_encode(["message"=>"Success", "response_code"=>1, "status"=>true, "receivableData"=>$row]);
        }
        else{
            echo json_encode(["message"=>"No Transaction Found", "response_code"=>2, "status"=>false]);
        }
    }
    
    if(isset($_POST['COMPANY'])){
         $op = $con->query("select * FROM `serversetup` WHERE ID='1' LIMIT 1");
         $row = $op->fetch_assoc();
         if($row==null || $row ==""){
             echo json_encode(["message"=>"Ask Admin to provide SERVERSETUP DATA", "response_code"=>2, "status"=>false]);
             exit;
         }
         else{
             echo json_encode(["message"=>"Success", "response_code"=>1, "status"=>true, "receivableData"=>$row]);
             exit;
         }
    }
    
    if(isset($_POST['INSTANTPAY_EXISTENCE'])){
        $mysql_qry = "select * FROM instant_aeps_merchants WHERE USER_ID ='$usid' AND OUTID <>'' ORDER BY ID DESC LIMIT 1";
        $result = mysqli_query($con ,$mysql_qry);
        if(mysqli_num_rows($result) > 0) {
            echo json_encode(["message"=>"Success", "response_code"=>1, "status"=>true]);
            exit;
        }
        else{
            echo json_encode(["message"=>"No, Onboarding done, yet.", "response_code"=>2, "status"=>false]);
            exit;
        }
        
    }

?>