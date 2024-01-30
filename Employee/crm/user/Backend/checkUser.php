<?php
include('../includes/config.php');
include('allFunctions.php');

    extract($_POST);
    if($type==1)
    {
        
        
        $password = $password;
        $query = $con->query("select * FROM user WHERE EMAIL='$email' AND PASSWORD='$password' AND STATUS='Active' ORDER BY ID DESC LIMIT 1");
        $row = $query->num_rows;
        
        
        if($row > 0)        
        {
            
            $row = $query->fetch_assoc();         

                
          $token = encrypt_token(json_encode(["ID" => $row['ID'] , "Timestamp" => date("Ymdgis") , "UniqeId" => mt_rand(9999 , 9999999)]));
           
          //update the token
       
           
          $update =  $con->query("UPDATE user SET TOKEN = '$token'
                    WHERE EMAIL='$email' AND PASSWORD='$password' ");
                   
            if($update)
            {echo json_encode(["message"=>"Login Successfull", "token"=>$token, "response_code"=>1, "status"=>true]);}
            
            else{echo json_encode(["message"=>"Login Failed", "token"=>$token, "response_code"=>0, "status"=>false]);}
            
            
                
            }
        else{
            
        echo json_encode(["message"=>"Login Failed", "token"=>$token, "response_code"=>2, "status"=>false]);
            
        }
        
  }
        

?>