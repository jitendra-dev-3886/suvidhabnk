<?php
include('allFunctions.php');
include('../includes/config.php');


function checkUser($Token)
{

if($Token=='') 
{
    
    return 0;

}
else
        {
           $data = decrypt_token($Token);
            $jtData = json_decode($data,true);
        
            $user_id = $jtData['id'];
        
            $res = $con->query("SELECT * FROM user WHERE ID='$user_id' AND TOKEN='$Token' ");
            if(mysqli_num_rows($res)<1)
            {
                return 0;
            }
            else
            {                    
                return 1;
            }
    
        }   
    } 
?>