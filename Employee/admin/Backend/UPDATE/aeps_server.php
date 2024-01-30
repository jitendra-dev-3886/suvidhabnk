<?php
session_start();
ini_set("display_errors" , 1);
include("../../../Db/config.php");


if(isset($_POST['service'])){
    $ser = $_POST['service'];
    if($ser != ""){
        if($con->query("update serversetup set AEPS='$ser' where ID='1' ")){
            echo 200;
        }
        else{
            echo 500;
        }
    }
}


?>