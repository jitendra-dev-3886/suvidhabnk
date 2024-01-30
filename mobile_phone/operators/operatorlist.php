<?php

    include("../includes/configuration.php");
    include("../includes/imagepaths.php");
    
    $operator_type = $_POST['operator'];
    
    
    // $operator_type = "Prepaid";
    $response  = array();

    
 //fetch operator
    $op = $con->query("SELECT * FROM `switchOperator` WHERE SERVICETYPE='$operator_type'");
    
    if($op->num_rows > 0)
    {
        while($row = $op->fetch_assoc()){
            
             array_push($response,array("id"=>$row["ID"],"operatorcode"=>$row['LONGCODE'],"name"=>$row['PRODUCTNAME'],"service"=>$row['SERVICETYPE'],"com"=>null,"logo"=>$opImagePath.'/'.$row['LOGO']));
            //array_push($response,array("id"=>$row["ID"],"operatorcode"=>$row['LONGCODE'],"name"=>$row['PRODUCTNAME'],"service"=>$row['SERVICETYPE'],"com"=>$row['COM'],"logo"=>$opImagePath.$row['LOGO']));
                                                                            
        }
        
        echo json_encode($response);
    }
    else{
        echo json_encode($response);
    }




?>