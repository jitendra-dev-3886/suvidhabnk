<?php

include("../../Db/config.php");
include("Backend/Functions/all_function.php");

$i = 1;

if(isset($_POST['pageid']) && $_POST['pageid'] == 1){

;
$d_name = $_POST['device_name'];
$d_price = $_POST['device_price'];
$d_quantity = $_POST['quantity'];

$result = $con->query("INSERT INTO `admin_price_setup`(`DEVICE_NAME`, `DEVICE_PRICE`, `QUANTITY`) VALUES ('$d_name','$d_price','$d_quantity')");

if($result){
    echo 1;
}else{
     echo 0;
}

}

?>