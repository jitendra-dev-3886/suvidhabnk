<?php
include('allFunctions.php');
include('../includes/config.php');

$Token = $_POST['Token'];

if($Token=='')
{
    
   $dat = array("status"=>false);
        echo json_encode($dat);
}
else
    {
    
    $data = decrypt_token($Token);
    $jtData = json_decode($data,true);

    $user_id = $jtData['id'];

    $res = $con->query("SELECT * FROM admin WHERE ID='$user_id' AND TOKEN='$Token' ");
    if(mysqli_num_rows($res)<1)
    {
        $dat = array("status"=>false);
        echo json_encode($dat);    }
    else
    {
        $dat = array("status"=>true,"id"=>$user_id);
        echo json_encode($dat);
    }    
        
        
    }
    

  
    
    ?>