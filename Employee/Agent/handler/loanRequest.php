<?php
session_start();
require_once('../../Db/config.php');
include("function.php");
include("../Backend/Userinfo/getuserinfo.php");
include("../Backend/Functions/all_function.php");
include("../Backend/Auth/userdata.php");


date_default_timezone_set("Asia/Calcutta");   //India time (GMT+5:30)
 $reqDate =  date('d-m-Y H:i:s');

	if(isset($_POST['loan_amt'])){

		$cname=filterThis($_POST['cname']);
		$mob=filterThis($_POST['mob']);
// 		$otp=$_POST['otp'];
		$loantype=filterThis($_POST['loantype']);
		$profession=filterThis($_POST['profession']);
		$income=filterThis($_POST['income']);
		$loan_amt=filterThis($_POST['loan_amt']);
		$employment = filterThis($_POST['employment']); 

$dir='../dist/img/Loan_Img';
mkdir($dir);	
		// adhaarfront 2 upload
$image2 = $_FILES['adharf'];
$adharf = $image2['name'];
$img_extenion1 = pathinfo($adharf , PATHINFO_EXTENSION);
$img_tmp2 = $image2['tmp_name'];
$dest2 = "$dir/". $adharf;

// adhaarback 3 upload
$image3 = $_FILES['adharb'];
$adharb = $image3['name'];
$img_extenion2 = pathinfo($adharb , PATHINFO_EXTENSION);
$img_tmp3 = $image3['tmp_name'];
$dest3 = "$dir/" . $adharb;

// pan  upload
$image4 = $_FILES['pan'];
$pan = $image4['name'];
$img_extenion3 = pathinfo($pan , PATHINFO_EXTENSION);
$img_tmp4 = $image4['tmp_name'];
$dest4 = "$dir/" . $pan;

// salaryslip  upload
$image5 = $_FILES['salaryslip'];
$salaryslip = $image5['name'];
$img_extenion4 = pathinfo($salaryslip , PATHINFO_EXTENSION);
$img_tmp5 = $image5['tmp_name'];
$dest5 = "$dir/". $salaryslip;

// bankstmt  upload
$image6 = $_FILES['bankstmt'];
$bankstmt = $image6['name'];
$img_extenion5 = pathinfo($bankstmt , PATHINFO_EXTENSION);
$img_tmp6 = $image6['tmp_name'];
$dest6 = "$dir/" . $bankstmt;

// last_itr upload
$image7 = $_FILES['last_itr'];
$last_itr = $image7['name'];
$img_extenion6 = pathinfo($last_itr , PATHINFO_EXTENSION);
$img_tmp7 = $image7['tmp_name'];
$dest7 = "$dir/" . $last_itr;

// $array = array("jpg"  , "jpeg" , "png", "pdf");
// if(in_array($img_extenion1 , $array) && in_array($img_extenion2 , $array) && in_array($img_extenion3 , $array) && in_array($img_extenion4 , $array) && in_array($img_extenion5 , $array) && in_array($img_extenion6 , $array) ){

		$sql_loan = "INSERT INTO `loan_request`(`USER_ID`, `LOAN_TYPE`, `CUSTOMER_NAME`, `MOBILE_NO`, `PROFESSION`, `INCOME`, `REQUIRE_LOAN`,`APPROVED_LOAN_AMT`, `AADHAR_CARD_FRONT`, `AADHAR_CARD_BACK`, 
`PAN_CARD`, `SALARY_SLIP`, `BANK_STATEMENT`, `ITR`, `USER_REMARK`, `ADMIN_REMARK`, `REQUEST_DATE`, `RESPONSE_DATE`, `STATUS`, `RT_COMM`, `DT_COMM`, `EMPLOYMENT_TYPE`) 
VALUES ('$usid','$loantype','$cname','$mob','$profession','$income','$loan_amt','','$adharf','$adharb','$pan','$salaryslip','$bankstmt','$last_itr','','','$reqDate','','Pending','','','$employment')";
// 		echo $sql_loan; die();
		if (mysqli_query($con, $sql_loan)) {
		    
		    move_uploaded_file($img_tmp2, $dest2);
            move_uploaded_file($img_tmp3, $dest3);
            move_uploaded_file($img_tmp4, $dest4);
            move_uploaded_file($img_tmp5, $dest5);
            move_uploaded_file($img_tmp6, $dest6);
            move_uploaded_file($img_tmp7, $dest7);
            
            echo json_encode(["status"->true,"response_code"=>1,"message"=>"Succesfully applied"]);
		} 
		else {
			   echo json_encode(["status"->false,"response_code"=>5,"message"=>"Something went wrong, ask admin to fix."]);
  		 }
		
// 	}else{
//         echo json_encode(["status"->false,"response_code"=>3,"message"=>"Invalid Details"]);
//     }

}

?>