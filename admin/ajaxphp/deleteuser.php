<?php

session_start();
require_once('../../Db/config.php');
require("../include/Auth.php");

if(isset($_POST['pageid']) && $_POST['pageid'] == 0){
    
    $id = $_POST["did"];
    
    $sql = $con->query("DELETE FROM user WHERE ID = '$id'");
    
    if($sql){
        echo 1;
    }else{
        echo 0;
    }
}
 ?>