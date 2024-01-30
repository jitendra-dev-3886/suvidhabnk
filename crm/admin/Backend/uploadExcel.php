<?php
include('../includes/config.php');


if(isset($_FILES['uploadfile']['name'])){
    
      $today = date("d/m/Y");
     
    $type = $_POST['type'];

$uploadfile=$_FILES['uploadfile']['tmp_name'];

require 'PHPExcel/Classes/PHPExcel.php';
require_once 'PHPExcel/Classes/PHPExcel/IOFactory.php';

$i=0;
$objExcel=PHPExcel_IOFactory::load($uploadfile);
foreach($objExcel->getWorksheetIterator() as $worksheet)
{ 
  $i=$i+1; 

     $highestrow=$worksheet->getHighestRow();

	for($row=2;$row<$highestrow;$row++)
	{
		$Name=$worksheet->getCellByColumnAndRow(1,$row)->getValue();
		$Mobile=$worksheet->getCellByColumnAndRow(2,$row)->getValue();
		$Email=$worksheet->getCellByColumnAndRow(3,$row)->getValue();
		$State=$worksheet->getCellByColumnAndRow(4,$row)->getValue();
		$Dist =$worksheet->getCellByColumnAndRow(5,$row)->getValue();
		$Block=$worksheet->getCellByColumnAndRow(6,$row)->getValue();
		$Status=$worksheet->getCellByColumnAndRow(7,$row)->getValue();
		$Edt_Lead=$worksheet->getCellByColumnAndRow(8,$row)->getValue();
		$LeadHistory=$worksheet->getCellByColumnAndRow(9,$row)->getValue();
		$remark=$worksheet->getCellByColumnAndRow(10,$row)->getValue();

		if($Mobile!='')
		{
		    $res = $con->query("INSERT INTO `lead`(`USER_ID`,`NAME`, `MOBILE`, `EMAIL`, `STATE`, `DISTRICT`, `BLOCK`, `ADDRESS`, `STATUS`, `REMARK`,`FILTER_DATE`) 
		    VALUES ('$type','$Name','$Mobile','$Email','$State','$Dist','$Block','','$Status','$remark','$today')");
			
		  //   echo "INSERT INTO `lead`(`USER_ID`,`NAME`, `MOBILE`, `EMAIL`, `STATE`, `DISTRICT`, `BLOCK`, `ADDRESS`, `STATUS`, `REMARK`) 
		  //  VALUES ('$type','$Name','$Mobile','$Email','$State','$Dist','$Block','$Status','$remark')";
		  //  exit();
		}
	}

    
    
}

echo $i;

// $dat = array("status"=>$i,"type"=>$type);
// echo json_encode($dat); 


}
?>