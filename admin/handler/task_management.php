<?php

session_start();
require_once('../../Db/config.php');
require("../include/Auth.php");
    
    if(isset($_POST['pageid']) && $_POST['pageid'] == 2){
        
$i = 1;

 $fromdate = $_POST['formdate'];
  $todate = $_POST['todate'];

  $sql = "
SELECT * FROM TASK_MANAGEMENT WHERE date(DATE) BETWEEN '$fromdate' AND '$todate' ORDER BY ID DESC
";

$result = mysqli_query($con, $sql) or die("SQL Query Failed.");
$userdata = "";

  $userdata .= '<table id="example1" class="table table-bordered table-striped">
        
                  <thead>
                  <tr>
                    <th>Sr. No.</th>
                    <th>Employee ID</th>
                    <th>Employee Mobile Number</th>
                    <th>Employee Name</th>
                    <th>Task</th>
                    <th>Status</th>
                    <th>Remark</th>
                    <th>Rich Text</th>
                    <th>Date & Time</th>
                    <th>Action Date & Time</th>
                    <th>Edit Action</th>
                    <th>Delete Action</th>
                    </tr>
                  </thead>
                  <tbody>';

              while($row = mysqli_fetch_assoc($result)){
              
              
             $user1 = $con->query("SELECT * FROM user WHERE MOBILE = '{$row["MOBILE"]}'")->fetch_assoc();
                $userdata .= "<tr>
                    <td>".$i++."</td>
                    <td>{$user1['ID']}</td>
                    <td>{$row['MOBILE']}</td>
                    <td>{$user1['FIRST_NAME']} {$user1['LAST_NAME']}</td>
                    <td>{$row['TASK']}</td>
                    <td>{$row['STATUS']}</td>
                    <td>{$row['REMARKS']}</td>
                    <td>{$row['RICH_TEXT']}</td>
                    <td> {$row['DATE']}</td>
                    <td> {$row['ACTION_DATE']}</td>
                    <td><a href='Edit_Task.php?id={$row['ID']}' class='btn btn-sm btn-warning edit-btn'>Edit</a></td>
                    <td><input type='button' class='btn btn-danger deletebtn' data-id='{$row['ID']}'  value='Delete'></td>
                    
                 </tr>";
              }
    $userdata .= " </tfoot>
                  
                </table>";
                
    echo $userdata;
}

if(isset($_POST['name'])){

    $mobile=$_POST['name'];
   $task=$_POST['desc'];
   $rich=$_POST['richtext'];
    $status=Pending;
        $insert="INSERT INTO `TASK_MANAGEMENT`(`MOBILE`, `TASK`, `STATUS`,`RICH_TEXT`) VALUES ('$mobile','$task','$status','$rich')";
        $run=mysqli_query($con,$insert);
        if($run){
            echo 1;
        }else{
            echo 0;
        }
    }
    
    
    


// UPDATE QUERY

if(isset($_POST['id']) && $_POST['id'] == 7){
$upid= $_POST['updateid'];
$uptask= $_POST['update_task'];
$upstatus= $_POST['update_status'];
$upremark =$_POST['update_remark'];
$update_richtext=$_POST['richtext'];
$date = date('y-m-d h:i:s');

  $update_query="UPDATE `TASK_MANAGEMENT` SET `TASK`='$uptask', `STATUS`='$upstatus',`REMARKS`='$upremark',`RICH_TEXT`='$update_richtext' WHERE ID='$upid'";
  $runs=mysqli_query($con,$update_query);
  if($runs){
      echo 1;
  }else{
      echo 0;
  }
}




    
    
///delete user record
if(isset($_POST['pageid']) && $_POST['pageid'] ==3){
    $userid=$_POST['eid'];
    $deletequery ="DELETE FROM `TASK_MANAGEMENT` WHERE `ID` = '$userid'";
    $run=mysqli_query($con,$deletequery);
    if($run){
        echo 1;
    }else{
        echo 0;
    }
}


?>