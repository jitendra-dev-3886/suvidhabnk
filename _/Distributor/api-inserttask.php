<?php
	include 'config.php';
	extract($_POST);
	if(isset($_POST['TASKTYPE']) && ($_POST['TASKNAME']) && ($_POST['ANOTHERMOBILENO']) && ($_POST['ENTERTASK'])){
	    
	     //$pdf=$_FILES['pdf']['name'];
          //$pdf_type=$_FILES['pdf']['type'];
          //$pdf_size=$_FILES['pdf']['size'];
          //$pdf_tem_loc=$_FILES['pdf']['tmp_name'];
          //$pdf_store="admin/pdf/".$pdf;

          //move_uploaded_file($pdf_tem_loc,$pdf_store);

          
	    
	$sql = "INSERT INTO `task`( `TASKTYPE`,`TASKNAME`,`ANOTHERMOBILENO`,`ENTERTASK`) VALUES ('$TASKTYPE','$TASKNAME','$ANOTHERMOBILENO','$ENTERTASK')";
	}
	if(mysqli_query($conn, $sql)){
	    echo "this is working ";
	}
	else{
	    echo "something went wrong in query";
	}

?>