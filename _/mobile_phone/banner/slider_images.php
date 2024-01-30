<?php

include("../includes/configuration.php");
include("../includes/imagepaths.php");
    
    $user_type = $_POST['user_type'];
    $response  = array();
    $op = $con->query("SELECT * FROM `slider`");
    if($op->num_rows > 0)
    {
        while($row = $op->fetch_assoc()){
            
             array_push($response,array("images"=>$bannerImagePath.$row['IMAGE'],"link"=>""));
                                                    
        }
        
        echo json_encode($response);
    }
    else{
        
    }



?>