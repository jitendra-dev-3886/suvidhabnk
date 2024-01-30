<?php

    include("../includes/config.php");
    
    $mobile= $_POST['mobile'];
    $password = $_POST['password'];
    
        $mysql_qry = "select * FROM user WHERE MOBILE ='$mobile' AND PASSWORD = '$password'";
        $result = mysqli_query($con ,$mysql_qry);
        if(mysqli_num_rows($result) > 0) {
            
            $row = mysqli_fetch_array($result);
            $tokenGenerated = generateRandomString();
            
            $select_id = $row['ID'];
            
            $sql = "UPDATE user SET TOKEN_ID='$tokenGenerated' WHERE ID='$select_id'";
            mysqli_query($con, $sql);
            
            
            
        $usertype_id = $row['USER_TYPE'];
        $user_type = $con->query("SELECT * FROM `user_type` WHERE ID='$usertype_id' and STATUS='ACTIVE'")->fetch_assoc(); 
            
            $usertypename =  $user_type['NAME'];
            
            $mainbalance = $row['MAIN_BAL'];
            $aepsbalance = $row['AEPS_BAL'];
            $mainbalance =   number_format($mainbalance, 1, '.', '');
            $aepsbalance =   number_format($aepsbalance, 1, '.', '');

        
            $myArr = array(
                "status" =>true,
                "message" =>"Login Successful",
                "user"=>[
                "email"=>$row["EMAIL"],
                "mobile"=>$row["MOBILE"],
                "password"=>$row["PASSWORD"],
                "name"=>$row['FIRST_NAME'],
                "lastname"=>$row['LAST_NAME'],
                "ownerid"=>$row['MAIN_OWNER_ID'],
                "ownerstatus"=>$row['MAIN_OWNER'],
                "userstatus"=>$row['USER_TYPE'],
                "token"=>$tokenGenerated,
                "id"=>$row['ID'],
                "mainbalance"=>$mainbalance,
                "aepsbalance"=>$aepsbalance,
                "userstatusname"=>$usertypename,
                "pin"=>$row['PIN'],
                "address"=>$row['ADDRESS']
                ]
                );

            echo json_encode($myArr);
        }
        else{ 
                $myArr = array(
                "status" =>false,
                "message" =>"Login Failed",
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
                "lastName"=>null,
                "pin"=>null,
                "address"=>null
                ]
                );

            echo json_encode($myArr);
        }
        
function generateRandomString() {
    $length = 20;
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

?>
