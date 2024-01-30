<?php
include('allFunctions.php');
include('../includes/config.php');

$Token = $_POST['Token'];

$id = $_POST['pageid'];

if($Token=='')
{
 $dat = array("status"=>false);
                    echo json_encode($dat);
}
    else
    {
           $data = decrypt_token($Token);
            $jtData = json_decode($data,true);
        
            $user_id = $jtData['ID'];
        
            $res = $con->query("SELECT * FROM user WHERE ID='$user_id' AND TOKEN='$Token' ");
            if(mysqli_num_rows($res)<1)
            {
                   $dat = array("status"=>false);
                    echo json_encode($dat);
            }
            else
            {
                $row = $res->fetch_assoc();
                $dat = array("status"=>true,"name"=>$row['FULL_NAME']);
                echo json_encode($dat);


            }     
        
        
        
    }
    

  
    
    ?>