<?php
include('../includes/config.php');
include('allFunctions.php');

    extract($_POST);
    if($type==1)
    {
        
        $password =  md5($password);
        $query = $con->query("select * FROM admin WHERE EMAIL='$email' AND PASSWORD='$password' ");
        $row = $query->num_rows;
        
        if($row > 0)        
        {
            
            $row = $query->fetch_assoc();         
            $tokenData = json_encode([
                    
                    "id"=>$row['ID'],
                    "mobile"=>$row['MOBILE'],
                    "tokenId"=>2312
                ]);
                
          $token =  encrypt_token($tokenData);    
           
          //update the token
       
           
          $update =  $con->query("UPDATE admin SET TOKEN = '$token'
                    WHERE EMAIL='$email' AND PASSWORD='$password' ");
                   
             if($update)
            {
                echo json_encode(["message"=>"Login Successfull", "token"=>$token, "response_code"=>1, "status"=>true,"Token"=>$token,"id"=>$row['ID'] ]);
            }
            
            else{echo json_encode(["message"=>"Login Failed", "token"=>$token, "response_code"=>0, "status"=>false]);}
            
            
            
        }
        else{
            
        echo json_encode(["message"=>"Login Failed", "token"=>$token, "response_code"=>2, "status"=>false]);
            
        }
        
  }
        

?>