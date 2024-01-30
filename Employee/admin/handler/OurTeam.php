<?php

session_start();
require_once('../../Db/config.php');
require("../include/Auth.php");
    
    if(isset($_POST['pageid']) && $_POST['pageid'] == 2){
        
$i = 1;

 $fromdate = $_POST['formdate'];
  $todate = $_POST['todate'];

  $sql = "
SELECT * FROM team WHERE `TYPE`='TEAM' AND date(DATE) BETWEEN '$fromdate' AND '$todate' ORDER BY ID DESC
";

$result = mysqli_query($con, $sql) or die("SQL Query Failed.");
$userdata = "";

  $userdata .= '<table id="example1" class="table table-bordered table-striped">
        
                  <thead>
                  <tr>
                    <th>Sr. No.</th>
                    <th>Image </th>
                    <th>Name</th>
                    <th>Position</th>
                    <th>Date</th>
                    <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>';

              while($row = mysqli_fetch_assoc($result)){
            
            $imgpath = "assets/Team/".$row['PROFILE_PIC'];
                    
                $userdata .= "<tr>
                    <td>".$i++."</td>
                    <td><img class='notifyimg' src='$imgpath'></td>
                     <td>{$row['NAME']}</td>
                    <td> {$row['POSITION']}</td>
                    <td> {$row['DATE']}</td>
                    <td><button type='submit' class='btn btn-sm btn-warning edit-btn' data-eid='{$row['ID']}'>Edit</button> &nbsp; <br> <br> <button type='button' class='btn btn-sm btn-danger delete-btn' data-id='{$row['ID']}'>Delete</button>
                   
                    </tr>";
              }
    $userdata .= " </tfoot>
                  
                </table>";
                
    echo $userdata;
}

if(isset($_FILES['image'])){

 //logo images 
      $team_image = $_FILES['image']; //input name
      $img_name = $team_image['name'];
      $img_tmp = $team_image['tmp_name'];
      $dest = "../assets/Team/".$img_name;
      $type=$_POST['type'];
      $position=$_POST['position'];
      $name=$_POST['DistributorNAME'];
    $state=$_POST['state'];
    $district=$_POST['district'];
    $block=$_POST['block'];
    $village=$_POST['village'];
      $mobile=$_POST['mobile_num'];
        $insert="INSERT INTO `team`(`TYPE`, `PROFILE_PIC`, `NAME`,`POSITION`, `STATE`, `DISTRICT`, `BLOCK`, `VILLAGE`, `MOBILE_NUMBER`) VALUES ('$type','$img_name','$name','$position','$state','$district','$block','$village','$mobile')";
        $run=mysqli_query($con,$insert);
        if($run){
             move_uploaded_file($img_tmp,$dest);
            echo 1;
        }else{
            echo 0;
        }
    }
    
    // update code
  if(isset($_POST['id']) && $_POST['id'] == 9){
   $team_image = $_FILES['uimage']; //input name
      $img_name = $team_image['name'];
      $img_tmp = $team_image['tmp_name'];
      $dest = "../assets/Team/".$img_name;
$uid=$_POST['updateid'];
$update_name=$_POST['team_member'];
$update_sta=$_POST['state'];
$update_dist=$_POST['district'];
$update_blo=$_POST['block'];
$update_villa=$_POST['village'];

$sql ="UPDATE `team` SET `PROFILE_PIC`='$img_name',`NAME`='$update_name',`STATE`='$update_sta',`DISTRICT`='$update_dist',`BLOCK`='$update_blo',`VILLAGE`='$update_villa' WHERE ID='$uid'";
$run = mysqli_query($con,$sql);
if($run){
    move_uploaded_file($img_tmp,$dest);
    echo 1;
}else{
    echo 0;
}

}
?>