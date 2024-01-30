<?php
// fetch User Data 
// session_start();
// if(!isset($_SESSION['id']) || $_SESSION['token_id']=="0"){
//     header("location:../../../login.php");
// }


// $id = $_SESSION['id']; 
$id = "1"; 
$admin = $con->query("SELECT * FROM `admin` WHERE ID='$id'")->fetch_assoc(); 

// fetch user profile credential
$profile = $con->query("SELECT * FROM `admin_profile` WHERE USER_ID='$id'")->fetch_assoc();


// fetch paysprint credential
$paysprint = $con->query("SELECT * FROM `paysprint_api` WHERE ID='1' and STATUS='ACTIVE'")->fetch_assoc();

?>