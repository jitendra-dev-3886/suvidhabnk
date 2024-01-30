<?php

        include("../includes/config.php");
    
        $mobile = $_POST['mobile'];
        
        // $mobile = "9417286031";
        
        
        $mysql_qry = "select * FROM aeps_merchant WHERE MOBILE ='$mobile' and STATUS='Active'";
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
                "ownerid"=>$row['OWNER_ID']
                );

            echo json_encode($myArr);
        }
        else{
            
                $myArr = array(
                "result" =>false,
                "message" =>"User has no boarding data on server.",
                "ref_no" =>"",
                "txn_id" =>"",
                "status" =>"",
                "partnerid" =>"",
                "merchantcode" =>"",
                "isicicikyc" =>"",
                "timestamp" =>"",
                "owner" =>"",
                "ownerid"=>""
                );
            echo json_encode($myArr);
            
        }


?>