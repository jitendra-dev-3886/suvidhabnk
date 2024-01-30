<?php
ob_start();

session_start();
include("../../Db/config.php");
include("../include/Auth.php");
include("../../security/userInformation.php");

$str_rand=rand();
$reftype = md5($str_rand);

$token_id = $_SESSION['token_id'];
$id = $_SESSION['UsId'];

if(isset($_POST['fund_transfer']))
{
// user data
$user_id = $_POST['user_id'];
$amount = $_POST['amount'];
$wallet_type = $_POST['wallet_type'];
$fund_type = $_POST['fund_type'];
$remark = $_POST['remark'];

//  Outside Details While Transaction
date_default_timezone_set('Asia/kolkata');    
$timezone = date_default_timezone_get();    

$trans_date = date("Y-m-d");
$trans_time = date("h:i:sA");
$lon = $_POST['long'];
$lat = $_POST['lati'];
$map_location = "https://maps.googleapis.com/maps/api/staticmap?center=".$latlon."&zoom=14&size=400x300&sensor=false&key=YOUR_KEY";

$ip_address = UserInfo::get_ip();
$browser = UserInfo::get_browser();
$os = UserInfo::get_os();
$device = UserInfo::get_device();
$ch=curl_init();
curl_setopt($ch,CURLOPT_URL,"http://ip-api.com/json");
curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
$result=curl_exec($ch);
$result=json_decode($result);

$country =  $result->country;
$region =  $result->regionName;
$city =    $result->city;
$zip =     $result->zip;
$api_ip_address = $result->query;
$isp = $result->isp;
$org = $result->org;



// fetch user data
$user = $con->query("SELECT * FROM `user` WHERE ID='$user_id' and US_STATUS='ACTIVE'")->fetch_assoc();
$user_main_bal = $user['MAIN_BAL'];
$user_aeps_bal = $user['AEPS_BAL'];

// fetch admin data
$admin = $con->query("SELECT * FROM `admin` WHERE ID='1' and US_STATUS='ACTIVE'")->fetch_assoc();
$admin_main_bal = $admin['MAIN_BAL'];
$admin_aeps_bal = $admin['AEPS_BAL'];

// AEPS BALANCE TRANSACTION
if($wallet_type == "AEPS_BAL"){
if($fund_type == "Credit"){
$deduct_admin_bal =  $admin_aeps_bal - $amount;
$add_user_bal =  $user_aeps_bal + $amount;
if($deduct_admin_bal > 0){
$update_fund_report = $con->query("INSERT INTO `fund_transfer`(`MAIN_OWNER`, `MAIN_OWNER_ID`, `TOKEN_ID`, `OWNER_ID`, `USER_ID`, `USER_PREVIOUS_AMOUNT`, `AMOUNT`, 
`USER_AFTER_AMOUNT`, `FUND_TYPE`, `OWNER_PREVIOUS_AMOUNT`, `OWNER_AFTER_AMOUNT`, `REMARK`, `STATUS`, `IP_ADDRESS`, `BROWSER`, `OS`, `DEVICE`, `LOCATION`, `TRANS_DATE`, `TRANS_TIME`, 
`COUNTRY`, `STATE`, `CITY`, `ZIP`, `LATTITUDE`, `LONGITUDE`, `API_IP`, `INTERNET_ISP`, `INTERNET_ORG`, `MESSAGE`) 

VALUES ('ADMIN','1','$token_id','1','$user_id','$user_aeps_bal','$amount','$add_user_bal','Credit','$admin_aeps_bal','$deduct_admin_bal','$remark','Success','$ip_address','$browser','$os','$device','$map_location','$trans_date','$trans_time','$country','$region','$city','$zip','$lat','$lon','$api_ip_address','$isp','$org','Credit User AePS Bal Successfully')");
$update_user_wallet = $con->query("UPDATE `user` SET `AEPS_BAL`='$add_user_bal' WHERE ID='$user_id'");
$update_admin_wallet = $con->query("UPDATE `admin` SET `AEPS_BAL`='$deduct_admin_bal' WHERE ID='$id'");

// Report Aeps Credit
$fun_report=$con->query("INSERT INTO `report`(`OWNER`, `OWNER_ID`, `TRANS_TYPE`, `REFERENCE_ID`, `TOKEN_ID`, `USER_ID`, `TRANSFER_USER_ID`, `PREVIOUS_AMOUNT`, 
`AMOUNT`, `AFTER_AMOUNT`, `FUND_TYPE`, `REMARK`, `STATUS`, `IP_ADDRESS`, `BROWSER`, `OS`, `DEVICE`, `LOCATION`, 
`TRANS_DATE`, `TRANS_TIME`, `COUNTRY`, `STATE`, `CITY`, `ZIP`, `LATTITUDE`, `LONGITUDE`, `API_IP`, `INTERNET_ISP`, `INTERNET_ORG`, `MESSAGE`)
VALUES ('ADMIN','1','FundTransfer','$reftype','$token_id','','$user_id','$user_aeps_bal','$amount','$add_user_bal','Credit','$remark','Success','$ip_address','$browser','$os','$device','$map_location','$trans_date','$trans_time',
'$trans_time','$region','$city','$zip','$lat','$lon','$api_ip_address','$isp','$org','Credit User AePS Bal Successfully')");

echo'<script>location.replace("../fund_transfer.php?&msg=successfully&desc=Seccessfully Aeps Amount is Credited")</script>';

}else{
echo'<script>location.replace("../fund_transfer.php?&error=OOPS&desc=Your wallet is low")</script>';

}
}elseif($fund_type == "Debit"){
$deduct_user_bal =  $user_aeps_bal - $amount;
$add_admin_bal =  $admin_aeps_bal + $amount;
if($deduct_user_bal > 0){
$update_fund_report = $con->query("INSERT INTO `fund_transfer`(`MAIN_OWNER`, `MAIN_OWNER_ID`, `TOKEN_ID`, `OWNER_ID`, `USER_ID`, `USER_PREVIOUS_AMOUNT`, `AMOUNT`, `USER_AFTER_AMOUNT`, `FUND_TYPE`, `OWNER_PREVIOUS_AMOUNT`, `OWNER_AFTER_AMOUNT`, `REMARK`, `STATUS`, `IP_ADDRESS`, `BROWSER`, `OS`, `DEVICE`, `LOCATION`, `TRANS_DATE`, `TRANS_TIME`, `COUNTRY`, `STATE`, `CITY`, `ZIP`, `LATTITUDE`, `LONGITUDE`, `API_IP`, `INTERNET_ISP`, `INTERNET_ORG`, `MESSAGE`) 
VALUES ('ADMIN','1','$token_id','1','$user_id','$user_aeps_bal','$amount','$deduct_user_bal','Debit','$admin_aeps_bal','$add_admin_bal','$remark','Success','$ip_address','$browser','$os','$device','$map_location','$trans_date','$trans_time','$country','$region','$city','$zip','$lat','$lon','$api_ip_address','$isp','$org','Debit User AePS Bal Successfully')");
$update_user_wallet = $con->query("UPDATE `user` SET `AEPS_BAL`='$deduct_user_bal' WHERE ID='$user_id'");
$update_admin_wallet = $con->query("UPDATE `admin` SET `AEPS_BAL`='$add_admin_bal' WHERE ID='$id'");


// Report Aeps Debit
$fun_report=$con->query("INSERT INTO `report`(`OWNER`, `OWNER_ID`, `TRANS_TYPE`, `REFERENCE_ID`, `TOKEN_ID`, `USER_ID`, `TRANSFER_USER_ID`, `PREVIOUS_AMOUNT`, 
`AMOUNT`, `AFTER_AMOUNT`, `FUND_TYPE`, `REMARK`, `STATUS`, `IP_ADDRESS`, `BROWSER`, `OS`, `DEVICE`, `LOCATION`, 
`TRANS_DATE`, `TRANS_TIME`, `COUNTRY`, `STATE`, `CITY`, `ZIP`, `LATTITUDE`, `LONGITUDE`, `API_IP`, `INTERNET_ISP`, `INTERNET_ORG`, `MESSAGE`)
VALUES ('ADMIN','1','FundTransfer','$reftype','$token_id','','$user_id','$user_aeps_bal','$amount','$deduct_user_bal','Debit','$remark','Success','$ip_address','$browser','$os','$device','$map_location','$trans_date','$trans_time',
'$trans_time','$region','$city','$zip','$lat','$lon','$api_ip_address','$isp','$org','Debit User AePS Bal Successfully')");

echo'<script>location.replace("../fund_transfer.php?&msg=successfully&desc=Successfully Aeps Amount is Debited")</script>';

}else{
echo'<script>location.replace("../fund_transfer.php?&error=OOPS&desc=User wallet is low")</script>';

}
}else{
$update_fund_report = $con->query("INSERT INTO `fund_transfer`(`MAIN_OWNER`, `MAIN_OWNER_ID`, `TOKEN_ID`, `OWNER_ID`, `USER_ID`, `USER_PREVIOUS_AMOUNT`, `AMOUNT`, `USER_AFTER_AMOUNT`, `FUND_TYPE`, `OWNER_PREVIOUS_AMOUNT`, `OWNER_AFTER_AMOUNT`, `REMARK`, `STATUS`, `IP_ADDRESS`, `BROWSER`, `OS`, `DEVICE`, `LOCATION`, `TRANS_DATE`, `TRANS_TIME`, `COUNTRY`, `STATE`, `CITY`, `ZIP`, `LATTITUDE`, `LONGITUDE`, `API_IP`, `INTERNET_ISP`, `INTERNET_ORG`, `MESSAGE`)
VALUES ('ADMIN','1','$token_id','1','$user_id','$user_aeps_bal','$amount','$user_aeps_bal','Not Seleted Wallet Type','$admin_aeps_bal','$admin_main_bal','Failed Transaction','Failed','$ip_address','$browser','$os','$device','$map_location','$trans_date','$trans_time','$country','$region','$city','$zip','$lat','$lon','$api_ip_address','$isp','$org','illegal Transaction')");
echo'<script>location.replace("../fund_transfer.php?&error=Failed&desc=Sorry This is illegal Transaction")</script>';


}
}
// MAIN BALANCE TRANSACTION
elseif($wallet_type == "MAIN_BAL"){
if($fund_type == "Credit"){
$deduct_admin_bal =  $admin_main_bal - $amount;
$add_user_bal =  $user_main_bal + $amount;
if($deduct_admin_bal > 0){
$update_fund_report = $con->query("INSERT INTO `fund_transfer`(`MAIN_OWNER`, `MAIN_OWNER_ID`, `TOKEN_ID`, `OWNER_ID`, `USER_ID`, `USER_PREVIOUS_AMOUNT`, `AMOUNT`, `USER_AFTER_AMOUNT`, `FUND_TYPE`, `OWNER_PREVIOUS_AMOUNT`, `OWNER_AFTER_AMOUNT`, `REMARK`, `STATUS`, `IP_ADDRESS`, `BROWSER`, `OS`, `DEVICE`, `LOCATION`, `TRANS_DATE`, `TRANS_TIME`, `COUNTRY`, `STATE`, `CITY`, `ZIP`, `LATTITUDE`, `LONGITUDE`, `API_IP`, `INTERNET_ISP`, `INTERNET_ORG`, `MESSAGE`) 
VALUES ('ADMIN','1','$token_id','1','$user_id','$user_main_bal','$amount','$add_user_bal','Credit','$admin_main_bal','$deduct_admin_bal','$remark','Success','$ip_address','$browser','$os','$device','$map_location','$trans_date','$trans_time','$country','$region','$city','$zip','$lat','$lon','$api_ip_address','$isp','$org','Credit User Main Bal Successfully')");
$update_user_wallet = $con->query("UPDATE `user` SET `MAIN_BAL`='$add_user_bal' WHERE ID='$user_id'");

$update_admin_wallet = $con->query("UPDATE `admin` SET `MAIN_BAL`='$deduct_admin_bal' WHERE ID='$id'");

$fun_report=$con->query("INSERT INTO `report`(`OWNER`, `OWNER_ID`, `TRANS_TYPE`, `REFERENCE_ID`, `TOKEN_ID`, `USER_ID`, `TRANSFER_USER_ID`, `PREVIOUS_AMOUNT`, 
`AMOUNT`, `AFTER_AMOUNT`, `FUND_TYPE`, `REMARK`, `STATUS`, `IP_ADDRESS`, `BROWSER`, `OS`, `DEVICE`, `LOCATION`, 
`TRANS_DATE`, `TRANS_TIME`, `COUNTRY`, `STATE`, `CITY`, `ZIP`, `LATTITUDE`, `LONGITUDE`, `API_IP`, `INTERNET_ISP`, `INTERNET_ORG`, `MESSAGE`)
VALUES ('ADMIN','1','FundTransfer','$reftype','$token_id','','$user_id','$user_main_bal','$amount','$add_user_bal','Credit','$remark','Success','$ip_address','$browser','$os','$device','$map_location','$trans_date','$trans_time',
'$trans_time','$region','$city','$zip','$lat','$lon','$api_ip_address','$isp','$org','Credit User Main Bal Successfully')");

echo'<script>location.replace("../fund_transfer.php?&msg=successfully&desc=Successfully MAIN Amount is Credited")</script>';

}else{
echo'<script>location.replace("../fund_transfer.php?&error=OOPS&desc=Your wallet is low")</script>';

}
}elseif($fund_type == "Debit"){
$deduct_user_bal =  $user_main_bal - $amount;
$add_admin_bal =  $admin_main_bal + $amount;
if($deduct_user_bal > 0){
$update_fund_report = $con->query("INSERT INTO `fund_transfer`(`MAIN_OWNER`, `MAIN_OWNER_ID`, `TOKEN_ID`, `OWNER_ID`, `USER_ID`, `USER_PREVIOUS_AMOUNT`, `AMOUNT`, `USER_AFTER_AMOUNT`, `FUND_TYPE`, `OWNER_PREVIOUS_AMOUNT`, `OWNER_AFTER_AMOUNT`, `REMARK`, `STATUS`, `IP_ADDRESS`, `BROWSER`, `OS`, `DEVICE`, `LOCATION`, `TRANS_DATE`, `TRANS_TIME`, `COUNTRY`, `STATE`, `CITY`, `ZIP`, `LATTITUDE`, `LONGITUDE`, `API_IP`, `INTERNET_ISP`, `INTERNET_ORG`, `MESSAGE`) 
VALUES ('ADMIN','1','$token_id','1','$user_id','$user_main_bal','$amount','$deduct_user_bal','Debit','$admin_main_bal','$add_admin_bal','$remark','Success','$ip_address','$browser','$os','$device','$map_location','$trans_date','$trans_time','$country','$region','$city','$zip','$lat','$lon','$api_ip_address','$isp','$org','Debit User AePS Bal Successfully')");
$update_user_wallet = $con->query("UPDATE `user` SET `MAIN_BAL`='$deduct_user_bal' WHERE ID='$user_id'");

$update_admin_wallet = $con->query("UPDATE `admin` SET `MAIN_BAL`='$add_admin_bal' WHERE ID='$id'");

$fun_report=$con->query("INSERT INTO `report`(`OWNER`, `OWNER_ID`, `TRANS_TYPE`, `REFERENCE_ID`, `TOKEN_ID`, `USER_ID`, `TRANSFER_USER_ID`, `PREVIOUS_AMOUNT`, 
`AMOUNT`, `AFTER_AMOUNT`, `FUND_TYPE`, `REMARK`, `STATUS`, `IP_ADDRESS`, `BROWSER`, `OS`, `DEVICE`, `LOCATION`, 
`TRANS_DATE`, `TRANS_TIME`, `COUNTRY`, `STATE`, `CITY`, `ZIP`, `LATTITUDE`, `LONGITUDE`, `API_IP`, `INTERNET_ISP`, `INTERNET_ORG`, `MESSAGE`)
VALUES ('ADMIN','1','FundTransfer','$reftype','$token_id','','$user_id','$user_main_bal','$amount','$deduct_user_bal','Debit','$remark','Success','$ip_address','$browser','$os','$device','$map_location','$trans_date','$trans_time',
'$trans_time','$region','$city','$zip','$lat','$lon','$api_ip_address','$isp','$org','Debit User Main Bal Successfully')");

echo'<script>location.replace("../fund_transfer.php?&msg=successfully&desc=Successfully MAIN Amount is Debited")</script>';


}else{

echo'<script>location.replace("../fund_transfer.php?&error=OOPS&desc=User wallet is low")</script>';

}
}else{
$update_fund_report = $con->query("INSERT INTO `fund_transfer`(`MAIN_OWNER`, `MAIN_OWNER_ID`, `TOKEN_ID`, `OWNER_ID`, `USER_ID`, `USER_PREVIOUS_AMOUNT`, `AMOUNT`, `USER_AFTER_AMOUNT`, `FUND_TYPE`, `OWNER_PREVIOUS_AMOUNT`, `OWNER_AFTER_AMOUNT`, `REMARK`, `STATUS`, `IP_ADDRESS`, `BROWSER`, `OS`, `DEVICE`, `LOCATION`, `TRANS_DATE`, `TRANS_TIME`, `COUNTRY`, `STATE`, `CITY`, `ZIP`, `LATTITUDE`, `LONGITUDE`, `API_IP`, `INTERNET_ISP`, `INTERNET_ORG`, `MESSAGE`)VALUES ('ADMIN','1','$token_id','1','$user_id','$user_aeps_bal','$amount','$user_aeps_bal','Not Seleted Wallet Type','$admin_main_bal','$admin_main_bal','Failed Transaction','Failed','$ip_address','$browser','$os','$device','$map_location','$trans_date','$trans_time','$country','$region','$city','$zip','$lat','$lon','$api_ip_address','$isp','$org','illegal Transaction')");

echo'<script>location.replace("../fund_transfer.php?&error=Failed&desc=Sorry This is illegal Transaction")</script>';

}
}else{
$update_fund_report = $con->query("INSERT INTO `fund_transfer`(`MAIN_OWNER`, `MAIN_OWNER_ID`, `TOKEN_ID`, `OWNER_ID`, `USER_ID`, `USER_PREVIOUS_AMOUNT`, `AMOUNT`, `USER_AFTER_AMOUNT`, `FUND_TYPE`, `OWNER_PREVIOUS_AMOUNT`, `OWNER_AFTER_AMOUNT`, `REMARK`, `STATUS`, `IP_ADDRESS`, `BROWSER`, `OS`, `DEVICE`, `LOCATION`, `TRANS_DATE`, `TRANS_TIME`, `COUNTRY`, `STATE`, `CITY`, `ZIP`, `LATTITUDE`, `LONGITUDE`, `API_IP`, `INTERNET_ISP`, `INTERNET_ORG`, `MESSAGE`) VALUES ('ADMIN','1','$token_id','1','$user_id','$user_aeps_bal','$amount','$user_aeps_bal','Not Seleted Wallet Type','$admin_main_bal','$admin_main_bal','Failed Transaction','Failed','$ip_address','$browser','$os','$device','$map_location','$trans_date','$trans_time','$country','$region','$city','$zip','$lat','$lon','$api_ip_address','$isp','$org','illegal Transaction')");

echo'<script>location.replace("../fund_transfer.php?&error=Failed&desc=Sorry This is illegal Transaction")</script>';

}
// END TRANSACTION

}








//   ofline transaction of admin

if(isset($_POST['ofline_bal_req']))
{
// user data
$amount = $_POST['amount'];
$wallet_type = $_POST['wallet_type'];
$fund_type = $_POST['fund_type'];
$remark = $_POST['remark'];

//  Outside Details While Transaction
date_default_timezone_set('Asia/kolkata');    
$timezone = date_default_timezone_get();    

$trans_date = date("Y-m-d");
$trans_time = date("h:i:sA");
$lon = $_POST['long'];
$lat = $_POST['lati'];
$map_location = "https://maps.googleapis.com/maps/api/staticmap?center=".$latlon."&zoom=14&size=400x300&sensor=false&key=YOUR_KEY";

$ip_address = UserInfo::get_ip();
$browser = UserInfo::get_browser();
$os = UserInfo::get_os();
$device = UserInfo::get_device();
$ch=curl_init();
curl_setopt($ch,CURLOPT_URL,"http://ip-api.com/json");
curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
$result=curl_exec($ch);
$result=json_decode($result);

$country =  $result->country;
$region =  $result->regionName;
$city =    $result->city;
$zip =     $result->zip;
$api_ip_address = $result->query;
$isp = $result->isp;
$org = $result->org;

// fetch admin data
$admin = $con->query("SELECT * FROM `admin` WHERE ID='$id' and US_STATUS='ACTIVE'")->fetch_assoc();
$admin_main_bal = $admin['MAIN_BAL'];
$admin_aeps_bal = $admin['AEPS_BAL'];

// AEPS BALANCE TRANSACTION
if($wallet_type == "AEPS_BAL"){
if($fund_type == "Credit"){
$update_admin_bal =  $admin_aeps_bal + $amount;
$update_fund_report = $con->query("INSERT INTO `fund`(`MAIN_OWNER`, `MAIN_OWNER_ID`, `OWNER_ID`, `USER_ID`, `REFFRENCE_ID`, `AMOUNT`, `WALLET_TYPE`, `FUND_TYPE`, `REMARK`, `STATUS` , `DATE`) 
VALUES ('ADMIN','1','1','ADMIN','ofline_admin786','$amount','$wallet_type','Ofline Credit','$remark','Success' , '".date("Y-m-d")."')");

$update_admin_wallet = $con->query("UPDATE `admin` SET `AEPS_BAL`='$update_admin_bal' WHERE ID='$id'");
echo'<script>location.replace("../add_fund.php?&msg=successfully&desc=Seccessfully Aeps Amount is Credited")</script>';

}elseif($fund_type == "Debit"){
$update_admin_bal =  $admin_aeps_bal - $amount;
$update_fund_report = $con->query("INSERT INTO `fund`(`MAIN_OWNER`, `MAIN_OWNER_ID`, `OWNER_ID`, `USER_ID`, `REFFRENCE_ID`, `AMOUNT`, `WALLET_TYPE`,`FUND_TYPE`, `REMARK`, `STATUS` , `DATE`) VALUES ('ADMIN','1','1','ADMIN','ofline_admin786','$amount','$wallet_type','Ofline Debit','$remark','Success' , '".date("Y-m-d")."')");
$update_admin_wallet = $con->query("UPDATE `admin` SET `AEPS_BAL`='$update_admin_bal' WHERE ID='$id'");
echo'<script>location.replace("../add_fund.php?&msg=successfully&desc=Seccessfully Aeps Amount is Debited")</script>';

}else{
$update_fund_report = $con->query("INSERT INTO `fund`(`MAIN_OWNER`, `MAIN_OWNER_ID`, `OWNER_ID`, `USER_ID`, `REFFRENCE_ID`, `AMOUNT`, `WALLET_TYPE`,`FUND_TYPE`, `REMARK`, `STATUS` , `DATE`) VALUES ('ADMIN','1','1','ADMIN','ofline_admin786','$admin_aeps_bal','$wallet_type','Ofline Credit','$remark','Failed')");
echo'<script>location.replace("../add_fund.php?&error=Failed&desc=Sorry This is illegal Transaction")</script>';

}
}
// MAIN BALANCE TRANSACTION
else if($wallet_type == "MAIN_BAL"){
if($fund_type == "Credit"){
$update_admin_bal =  $admin_main_bal + $amount;
$update_fund_report = $con->query("INSERT INTO `fund`(`MAIN_OWNER`, `MAIN_OWNER_ID`, `OWNER_ID`, `USER_ID`, `REFFRENCE_ID`, `AMOUNT`, `WALLET_TYPE`,`FUND_TYPE`, `REMARK`, `STATUS` , `DATE`) VALUES ('ADMIN','1','1','ADMIN','ofline_admin786','$amount', '$wallet_type','Ofline Credit','$remark','Success' , '".date("Y-m-d")."')");
$update_admin_wallet = $con->query("UPDATE `admin` SET `MAIN_BAL`='$update_admin_bal' WHERE ID='$id'");
echo'<script>location.replace("../add_fund.php?&msg=successfully&desc=Seccessfully Main Balance Amount is Credited")</script>';

}elseif($fund_type == "Debit"){
$update_admin_bal =  $admin_main_bal - $amount;
$update_fund_report = $con->query("INSERT INTO `fund`(`MAIN_OWNER`, `MAIN_OWNER_ID`, `OWNER_ID`, `USER_ID`, `REFFRENCE_ID`, `AMOUNT`, `WALLET_TYPE`,`FUND_TYPE`, `REMARK`, `STATUS` , `DATE`) VALUES ('ADMIN','1','1','ADMIN','ofline_admin786','$amount', '$wallet_type','Ofline Debit','$remark','Success' , '".date("Y-m-d")."')");
$update_admin_wallet = $con->query("UPDATE `admin` SET `MAIN_BAL`='$update_admin_bal' WHERE ID='$id'");
echo'<script>location.replace("../add_fund.php?&msg=successfully&desc=Seccessfully Main Balance Amount is Debited")</script>';


}else{
$update_fund_report = $con->query("INSERT INTO `fund`(`MAIN_OWNER`, `MAIN_OWNER_ID`, `OWNER_ID`, `USER_ID`, `REFFRENCE_ID`, `AMOUNT`, `WALLET_TYPE`,`FUND_TYPE`, `REMARK`, `STATUS` , `DATE`) VALUES ('ADMIN','1','1','ADMIN','ofline_admin786','$amount '$wallet_type',Ofline Debit','$remark','Failed')");

echo'<script>location.replace("../add_fund.php?&error=Failed&desc=Sorry This is illegal Transaction")</script>';

}
}else{
$update_fund_report = $con->query("INSERT INTO `fund`(`MAIN_OWNER`, `MAIN_OWNER_ID`, `OWNER_ID`, `USER_ID`, `REFFRENCE_ID`, `AMOUNT`, `WALLET_TYPE`,`FUND_TYPE`, `REMARK`, `STATUS` , `DATE`) VALUES ('ADMIN','1','1','ADMIN','ofline_admin786','$admin_main_bal','illegal Transaction','$remark','Rejected')");
echo'<script>location.replace("../add_fund.php?&error=Failed&desc=Sorry This is illegal Transaction")</script>';

}
// END TRANSACTION

}




?>  