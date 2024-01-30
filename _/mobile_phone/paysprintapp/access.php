<?php

    include("../includes/config.php");
    
    $var = $_POST['check'];
    
    if($var == "dataforinsertion"){
        
        $row = $con->query("SELECT * FROM `paysprint_api` WHERE STATUS='ACTIVE'")->fetch_assoc(); 
            
        
        
            $myArr = array(
                "id"=>$row["ID"],
                "owner"=>$row["OWNER"],
                "ownerid"=>$row["OWNER_ID"],
                "partnerid"=>$row['PARTNER_ID'],
                "merchantcode"=>$row['MERCHANT_CODE'],
                "firm"=>$row['FIRM'],
                "jwtkey"=>$row['JWT_KEY'],
                "authorisedkey"=>$row['AUTHORISED_KEY'],
                "status"=>$row['STATUS'],
                "key"=>$row['KEY'],
                "keyiv"=>$row['KEY_IV'],
                "date"=>$row['DATE']
                );

            echo json_encode($myArr);
        
    }




?>