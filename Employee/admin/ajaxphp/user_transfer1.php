<?php
require_once('../../Db/config.php');

if(isset($_POST['pageid']) && $_POST['pageid'] == 1){
    $rtuser = $_POST['rtuser'];
    $sql = $con->query("SELECT * FROM user WHERE ID = '$rtuser'")->fetch_assoc();
    $rtowner = $sql['OWNER_ID'];
    $rtname = $sql['FIRST_NAME'];
    
    $fetchDist = $con->query("SELECT * FROM user WHERE ID = '$rtowner'")->fetch_assoc();
    
    
    if(!empty($fetchDist)){
    echo $rtname."'s Distributor ". $fetchDist["FIRST_NAME"].' '.$fetchDist["LAST_NAME"];
    
    }else{
        echo "This user has no distributor!";
    }
}


if(isset($_POST['pageid']) && $_POST['pageid'] == 2){
    $rtuser = $_POST['rtuser'];
    $dtuser = $_POST['dtuser'];
    
    $sql = $con->query("UPDATE user SET OWNER_ID = '$dtuser' WHERE ID = '$rtuser'");
    
    if($sql){
        echo 1;
    }else{
        echo 0;
    }
}



if(isset($_POST['pageid']) && $_POST['pageid'] == 3){
    $rtuserr = $_POST['rtuserr'];
    $sql = $con->query("SELECT * FROM user WHERE ID = '$rtuserr'")->fetch_assoc();
    $rtowner = $sql['OWNER_ID'];
    $rtname = $sql['FIRST_NAME'];
    
    $fetchDist = $con->query("SELECT * FROM user WHERE ID = '$rtowner'")->fetch_assoc();
    
    
    if(!empty($fetchDist)){
    echo $rtname."'s Master Distributor ". $fetchDist["FIRST_NAME"].' '.$fetchDist["LAST_NAME"];
    
    }else{
        echo "This distributor has no Master Distributor!";
    }
}


if(isset($_POST['pageid']) && $_POST['pageid'] == 4){
    $rtuserr = $_POST['rtuserr'];
    $dtuserr = $_POST['dtuserr'];
    
    $sql = $con->query("UPDATE user SET OWNER_ID = '$dtuserr' WHERE ID = '$rtuserr'");
    
    if($sql){
        echo 1;
    }else{
        echo 0;
    }
}





?>