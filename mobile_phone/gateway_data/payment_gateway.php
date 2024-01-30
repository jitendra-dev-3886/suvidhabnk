<?php

    if(isset($_POST['gateway'])){
    // if($data =="samar"){
        include("../includes/config.php");
        
        $mysql_qry = "select * FROM razorpay_details";
        $result = mysqli_query($con ,$mysql_qry);
        $row = mysqli_fetch_array($result);
        
        if(mysqli_num_rows($result) > 0) {
            $myArr = array(
                "status" =>true,
                "message" =>"Fetch Successful",
                "razor_pay"=>[
                "api_key"=>$row["API_KEY"],
                "name"=>$row["NAME"],
                "description"=>$row["DESCRIPTION"],
                "image"=>$row['IMAGES'],
                "currency"=>$row['CURRENCY'],
                "amount"=>$row['AMOUNT'],
                "date"=>$row['DATE']
                ]
                
                );
            echo json_encode($myArr);
        }
        else{
            
                $myArr = array(
                "status" =>false,
                "message" =>"Fetch Failed",
                "razor_pay"=>[
                "api_key"=>null,
                "name"=>null,
                "description"=>null,
                "image"=>null,
                "currency"=>null,
                "amount"=>null,
                "date"=>null
                ]
                
                );
            echo json_encode($myArr);
            
        }
        
    }





?>