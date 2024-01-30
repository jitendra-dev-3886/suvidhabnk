<?php

session_start();
require_once('../../Db/config.php');

    extract($_POST);
    
    $csql=$con->query("UPDATE user SET API_ACCESS='$selectedOption' WHERE ID='$userr_id'");
    
    if($csql){
        echo 200;
    }
    else{
        echo 500;
    }

