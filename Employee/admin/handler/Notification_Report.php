<?php

session_start();
require_once('../../Db/config.php');
require("../include/Auth.php");
    
    if(isset($_POST['pageid']) && $_POST['pageid'] == 2){
        
$i = 1;

 $fromdate = $_POST['formdate'];
  $todate = $_POST['todate'];

  $sql = "
SELECT * FROM notification WHERE date(DATE) BETWEEN '$fromdate' AND '$todate' ORDER BY ID DESC
";

$result = mysqli_query($con, $sql) or die("SQL Query Failed.");
$userdata = "";

  $userdata .= '<table id="example1" class="table table-bordered table-striped">
        
                  <thead>
                  <tr>
                    <th>Sr. No.</th>
                      <th>USER_TYPE </th>
                    <th>DISTRIBUTOR NAME</th>
                    <th>RETAILER NAME</th>
                    <th>EMPLOYEE ID</th>
                    <th>STATE</th>
                    <th>IMAGE</th>
                    <th>TEXT</th>
                    <th> DATE</th>
                    <th> Action</th>
                    </tr>
                  </thead>
                  <tbody>';

              while($row = mysqli_fetch_assoc($result)){
                  
             $user1 = $con->query("SELECT * FROM user WHERE ID = '{$row["DISTRIBUTOR_ID"]}'")->fetch_assoc();
             $user2 = $con->query("SELECT * FROM user WHERE ID = '{$row["RETAILER_ID"]}'")->fetch_assoc();
             $user3 = $con->query("SELECT * FROM user WHERE ID = '{$row["EMPLOYEE_ID"]}'")->fetch_assoc();
             
                  if($row["DISTRIBUTOR_ID"] == 'All Distributor'){
                  $distname = "All Distributor";
              }else{
                  $distname = $user1['FIRST_NAME'].' '.$user1['LAST_NAME'];
                  
              }
            if($row["RETAILER_ID"] == 'All Retailer'){
                  $retname = "All Retailer";
              }else{
                  $retname = $user2['FIRST_NAME'].' '.$user2['LAST_NAME'];
                  
              }
            if($row["EMPLOYEE_ID"] == 'All Employee'){
                  $empname = "All Employee";
              }else{
                  $empname = $user3['FIRST_NAME'].' '.$user3['LAST_NAME'];
                  
              }
            
            $imgpath = "assets/Notification/".$row['IMAGE'];
                    
                $userdata .= "<tr>
                    <td>".$i++."</td>
                     <td>{$row['USER_TYPE']}</td>
                    <td> {$user1['FIRST_NAME']}</td>
                    <td> {$user2['FIRST_NAME']}</td>
                    <td> {$user3['FIRST_NAME']}</td>
                    <td> {$row['STATE']}</td>
                    <td><img class='notifyimg' src='$imgpath'></td>
                    <td> {$row['TEXT']}</td>
                    <td> {$row['DATE']}</td>
                    <td>
                        <input type='button' data-mid={$row['ID']} class='btn btn-danger deletebtn' value='Delete'>
                    </td>
                  
                 </tr>";
              }
    $userdata .= " </tfoot>
                  
                </table>";
                
    echo $userdata;
}

if(isset($_POST['Select_User'])){

    $utype=$_POST['Select_User'];
    $dname=$_POST['distributor'];
    $rname=$_POST['retailer'];
    $employee=$_POST['employee'];
    $state=$_POST['state'];
 //logo images 
      $notification_image = $_FILES['image']; //input name
      $img_name = $notification_image['name'];
      $img_tmp = $notification_image['tmp_name'];
      $dest = "../assets/Notification/".$img_name;
      $text=$_POST['desc'];
        $insert="INSERT INTO `notification`(`USER_TYPE`, `DISTRIBUTOR_ID`, `RETAILER_ID`, `EMPLOYEE_ID`, `STATE`, `IMAGE`, `TEXT`) VALUES ('$utype','$dname','$rname','$employee','$state','$img_name','$text')";
        $run=mysqli_query($con,$insert);
        if($run){
             move_uploaded_file($img_tmp,$dest);
            echo 1;
        }else{
            echo 0;
        }
    }

//delete data
    if(isset($_POST['pageid']) && ($_POST['pageid']) == 11){
        $notify_id = $_POST['eid'];
       
        $deletequery = $con->query("DELETE FROM `notification` WHERE ID='$notify_id'");
        if($deletequery){
            echo 1;
        }else{
            echo 0;
        }
    }
?>