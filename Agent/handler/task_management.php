<?php

session_start();
require_once('../../Db/config.php');
require("../include/Auth.php");
$id = $_SESSION['UsId'];
    
    if(isset($_POST['pageid']) && $_POST['pageid'] == 2){
        
$i = 1;

 $fromdate = $_POST['formdate'];
  $todate = $_POST['todate'];

  $sql = "
SELECT * FROM TASK_MANAGEMENT WHERE date(DATE) BETWEEN '$fromdate' AND '$todate' AND EMPLOYEE_ID = '$id' ORDER BY ID DESC
";

$result = mysqli_query($con, $sql) or die("SQL Query Failed.");
$userdata = "";

  $userdata .= '<table id="example1" class="table table-bordered table-striped">
        
                  <thead>
                  <tr>
                    <th>Sr. No.</th>
                    <th>Employee ID</th>
                    <th>Employee Name</th>
                    <th>Task</th>
                    <th>Status</th>
                    <th>Remark</th>
                    <th>Date & Time</th>
                    <th>Action Date & Time</th>
                    <th>Edit Action</th>
                    </tr>
                  </thead>
                  <tbody>';

              while($row = mysqli_fetch_assoc($result)){
              
              
             $user1 = $con->query("SELECT * FROM user WHERE ID = '{$row["EMPLOYEE_ID"]}'")->fetch_assoc();
                $userdata .= "<tr>
                    <td>".$i++."</td>
                    <td>{$row['EMPLOYEE_ID']}</td>
                    <td>{$user1['FIRST_NAME']} {$user1['LAST_NAME']}</td>
                    <td>{$row['TASK']}</td>
                    <td>{$row['STATUS']}</td>
                    <td>{$row['REMARKS']}</td>
                    <td> {$row['DATE']}</td>
                    <td> {$row['ACTION_DATE']}</td>
                    <td>      <input type='button' data-mid='{$row['ID']}' 
                class='btn btn-warning edit_btn' value='Edit'>
                    
                 </tr>";
              }
    $userdata .= " </tfoot>
                  
                </table>";
                
    echo $userdata;
}


// update


// UPDATE QUERY

if(isset($_POST['id']) && $_POST['id'] == 7){
$upid= $_POST['updates_id'];
$upstatus= $_POST['update_status'];
$upremark =$_POST['update_remark'];
$date = date('y-m-d h:i:s');

  $update_query="UPDATE `TASK_MANAGEMENT` SET `STATUS`='$upstatus',`REMARKS`='$upremark',`ACTION_DATE`='$date' WHERE ID='$upid'";
  
  if($update_query){
      echo 1;
  }else{
      echo 0;
  }
   $runs=mysqli_query($con,$update_query);

}






?>