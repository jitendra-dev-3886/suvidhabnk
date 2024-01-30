<?php
    error_reporting(0);

include("../Db/config.php");
// if(!empty($_POST["cat_id"])) 
// {
//  $id=intval($_POST['cat_id']);
// $query=mysqli_query($con,"SELECT * FROM subcategory WHERE categoryid=$id");
//  echo '<option value="">Select Subcategory</option>';
//  while($row=mysqli_fetch_array($query))
//  {
// echo '<option value="'.$row['ID'].'">'.$row['SUBCATEGORY'].'</option>';
//  }
// }


if(!empty($_POST["op_id"])) 
{
    $type = $_POST['type'];
     $id=$_POST['op_id'];
         
    $query=$con->query("SELECT * FROM operatorManager WHERE SERVICEAPI='$id' and SERVICE='$type' and APISERVICENAME='OPERATOR'");
     echo '<option value="">Select Product</option>';
     while($row = $query->fetch_assoc())
     {
        echo '<option value="'.$row['PRODUCTCODE'].'">'.$row['PRODUCTNAME'].'</option>';
     }
}


// if(!empty($_POST["mr_op_id"])) 
// {
// echo '<option value="">Select State</option>';

// $op_cd = $_POST['mr_op_id'];

// $operator = $con->query("select * from switchOperator where PRODUCTNAME='$op_cd'")->fetch_assoc();
// $api_name = $operator['APICOMPANY'];
//   $query = $con->query("SELECT * FROM `rechargeApi` WHERE NAME='$api_name' and`STATUS` ='Activate'")->fetch_assoc();
//   $api_name2 = $query['NAME'];
//   $query2 = "SELECT * FROM `operatorManager` WHERE `SERVICEAPI`= '$api_name2' and `APISERVICENAME`='CIRCLE'";
//   $run2 = mysqli_query($con , $query2);
//   while($operator = mysqli_fetch_array($run2)){
//       echo'<option value="'.$operator['PRODUCTCODE'].'">'.$operator['PRODUCTNAME'].'</option>';
//     }

// }

// if(isset($_POST["ms_id"])) 
// {
// echo '<option value="">Select Distributer</option>';

// $ms_id = $_POST["ms_id"];

// $operator = $con->query("select * from distributer where OWNER='MASTERDISTRIBUTER' and MS_ID='$ms_id'");


//   while($row = $operator->fetch_assoc()){
//       echo'<option value="'.$row['ID'].'">'.$row['NAME'].'</option>';
//     }

// }


?>
