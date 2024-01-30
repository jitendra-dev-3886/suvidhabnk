<?php

    include("../includes/config.php");
    
        $mobile= $_POST['mobile'];
        
        
    if($mobile == ""){
        $mobile ="893424u3ncdv";
    }
        
      
    
        $mysql_qry = "select * FROM user WHERE MOBILE ='$mobile'";
        $result = mysqli_query($con ,$mysql_qry);
        if(mysqli_num_rows($result) > 0) {
            
            $row = mysqli_fetch_array($result);
            
            $select_id = $row['ID'];
            
            
            
            
        $usertype_id = $row['USER_TYPE'];
        $user_type = $con->query("SELECT * FROM `user_type` WHERE ID='$usertype_id' and STATUS='ACTIVE'")->fetch_assoc(); 
            
            $usertypename =  $user_type['NAME'];
            

            $myArr = array(
                "status" =>true,
                "message" =>"User found.",
                "user"=>[
                "email"=>$row["EMAIL"],
                "mobile"=>$row["MOBILE"],
                "password"=>"",
                "name"=>$row['FIRST_NAME'],
                "lastname"=>$row['LAST_NAME'],
                "ownerid"=>$row['MAIN_OWNER_ID'],
                "ownerstatus"=>$row['MAIN_OWNER'],
                "userstatus"=>$row['USER_TYPE'],
                "token"=>"",
                "id"=>$row['ID'],
                "mainbalance"=>"",
                "aepsbalance"=>"",
                "userstatusname"=>$usertypename 
                ]
                );

            echo json_encode($myArr);
        }
        else{ 
                $myArr = array(
                "status" =>false,
                "message" =>"User not found.",
                "user"=>[
                "email"=>null,
                "mobile"=>null,
                "password"=>null
                ,"name"=>null,
                "userStatus"=>null,
                "token"=>null,
                "id"=>null,
                "mainBalance"=>null,
                "aepsBalance"=>null,
                "ownerStatus"=>null,
                "ownerId"=>null,
                "lastName"=>null
                ]
                );

            echo json_encode($myArr);
        }
        
        
?>