<?php
session_start();
require_once('../../Db/config.php');
require("../include/Auth.php");


if(isset($_POST['selectservice'])){

$selectservice=$_POST['selectservice'];
$lname=$_POST['lastname'];
$serviceapi=$_POST['serviceapi'];
$productname=$_POST['productname'];
$productcode=$_POST['productcode'];
$type=$_POST['type'];
$status=$_POST['status'];

    $sql="INSERT INTO `operatorManager`(`SERVICE`, `SERVICEAPI`, `BACKUPAPI`, `PRODUCTNAME`, `PRODUCTCODE`, `APISERVICENAME`, `STATUS`) VALUES ('$selectservice', '$serviceapi', '','$productname','$productcode','$type','$status')";
    $run=mysqli_query($con,$sql);
    if($run){
        echo 1;
    }else{
        echo 0;
    }
}





if(isset($_POST['pageid']) && $_POST['pageid'] == 3){
        $i = 1;
        
    $fromdate = $_POST['formdate'];
    $todate = $_POST['todate'];
    
 $sql = "
SELECT * FROM operatorManager WHERE date(DATE_TIME) BETWEEN '{$fromdate}' AND '{$todate}' ORDER BY ID DESC
";
  
$result = mysqli_query($con, $sql) or die("SQL Query Failed.");
$userdata = "";


  $userdata .= '<table id="example1" class="table table-bordered table-striped">
        
                  <thead>
                  <tr>
                    <th>Sr. No.</th>
                    <th>SERVICE</th>
                    <th>SERVICE API</th>
                    <th>PRODUCT NAME</th>
                    <th>PRODUCT CODE</th>
                    <th>API SERVICE NAME</th>
                    <th>STATUS</th>
                    <th>Action</th>
                    <th>DATE_TIME</th>
                  </tr>
                  </thead>
                  <tbody>';

              while($row = mysqli_fetch_assoc($result)){
                  
             $user1 = $con->query("SELECT * FROM service_manager WHERE ID = '{$row['SERVICE']}' ")->fetch_assoc();
             $user2 = $con->query("SELECT * FROM rechargeApi WHERE ID = '{$row['SERVICEAPI']}' ")->fetch_assoc();
                  
                $userdata .= "<tr>
                    <td>".$i++."</td>
                    <td>{$user1['SERVICE']}</td>
                    <td>{$user2['NAME']}</td>
                    <td>{$row['PRODUCTNAME']}</td>
                    <td>{$row['PRODUCTCODE']}</td>
                    <td>{$row['APISERVICENAME']}</td>
                    <td>{$row['STATUS']}</td>
                    <td><a href='Operator_edit?edit_id={$row['ID']}'><i class='fas fa-edit edit_btn' style='font-size:20px;' data-mid='{$row['ID']}'></i></a>&nbsp;&nbsp;&nbsp;<i class='fas fa-trash deletebtn' data-toggle='modal' data-target='#deleteEmployeeModal' data-id='{$row['ID']}' style='font-size:20px;'></i></a></td>
                    <td>{$row['DATE_TIME']}</td>

                 </tr>";
              }
    $userdata .= " </tfoot>
                  
                </table>";
                

    echo $userdata;
    }
    
    
    
    
    
//delete Operator record
if(isset($_POST['delid']) ==3){
    $userid=$_POST['eid'];
    $deletequery ="DELETE FROM `operatorManager` WHERE ID='$userid'";
    $run=mysqli_query($con,$deletequery);
    if($run){
        echo 1;
    }else{
        echo 0;
    }
}
    
  
  
  
  
  
// Update Operator    

if(isset($_POST['uniqid']) == 7){

$op_manager_id=$_POST['op_manager'];
$selectservice=$_POST['selectservicee'];
$serviceapi=$_POST['serviceapi'];
$productname=$_POST['productname'];
$productcode=$_POST['productcode'];
$type=$_POST['type'];
$status=$_POST['status'];

    $sql="UPDATE `operatorManager` SET `SERVICE`='$selectservice',`SERVICEAPI`='$serviceapi',`BACKUPAPI`='',`PRODUCTNAME`='$productname',`PRODUCTCODE`='$productcode',`APISERVICENAME`='$type',`STATUS`='$status' WHERE `ID`='$op_manager_id'";
    $run=mysqli_query($con,$sql);
    if($run){
        echo 1;
    }else{
        echo 0;
    }
}

    
?>