<?php
session_start();
require_once('../../Db/config.php');
include("function.php");

include("../Backend/Userinfo/getuserinfo.php");
include("../Backend/Functions/all_function.php");
include("../Backend/Auth/userdata.php");


date_default_timezone_set("Asia/Calcutta");   //India time (GMT+5:30)
 $issueDate =  date('d-m-Y H:i:s');

if(isset($_POST['department'])){

$department= filterThis($_POST['department']); 
$subject=filterThis($_POST['trans_no']);
$desc =filterThis($_POST['desc']);
$transaction_id = filterThis($_POST['transaction_id']);
$txndate = filterThis($_POST['txndate']);
$ticket_id = mt_rand(10000, 99999);

//Subject has been replaced with transaction id as per asked by paydeer

$dir='../dist/img/TicketRise';
mkdir($dir);	
		// adhaarfront 2 upload
$image2 = $_FILES['proof'];
$proof = $image2['name'];
$img_extenion1 = pathinfo($proof , PATHINFO_EXTENSION);
$img_tmp2 = $image2['tmp_name'];
$dest2 = "$dir/". $proof;

// $array = array("jpg" , "jpeg" , "png", "pdf");
// if(in_array($img_extenion1 , $array)){

		$sql_ticket =$con->query("INSERT INTO `ticket`(`USER_ID`,`TICKET_ID`, `EMPLOYEE_ID`, `DEPARTMENT`, `TRANSACTION_ID`, `TRANSACTION_DATE`, `DESCRIPTION`, `PROOF`, `REMARK`, `STATUS`, `ISSUE_DATE`) VALUES
		('$usid','$ticket_id','Admin','$department','$transaction_id','$txndate','$desc','$proof','','Pending','$issueDate')");
		

// 		$sql_ticket =$con->query("INSERT INTO `ticket`(`USER_ID`, `EMPLOYEE_ID`, `DEPARTMENT`, `TRANSACTION_ID`, `TRANSACTION_DATE`, `DESCRIPTION`, `PROOF`, `STATUS`, `ISSUE_DATE`,`ACTION_DATE`) 
// 		VALUES ('$usid','','$department','$transaction_id','$txndate','$desc','$proof','Pending','$issueDate','')");
		
		if($sql_ticket){
		    move_uploaded_file($img_tmp2, $dest2);
            echo json_encode(["status"->true,"response_code"=>1,"message"=>"Succesfully Submitted"]);
		} 
		else {
			   echo json_encode(["status"->false,"response_code"=>5,"message"=>"Something went wrong, ask admin to fix."]);
  		 }
		
// 	}else{
//         echo json_encode(["status"->false,"response_code"=>3,"message"=>"File Extention only JPG,JPEG,PNG,PDF..!"]);
//     }

}

?>