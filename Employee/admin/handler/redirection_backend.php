<?php

session_start();
require_once('../../Db/config.php');
require("../include/Auth.php");
    
    if(isset($_POST['pageid']) && $_POST['pageid'] == 2){
        
$i = 1;

 $fromdate = $_POST['formdate'];
  $todate = $_POST['todate'];

  $sql = "
SELECT * FROM redirection_link WHERE date(DATE) BETWEEN '$fromdate' AND '$todate' ORDER BY ID DESC
";

$result = mysqli_query($con, $sql) or die("SQL Query Failed.");
$userdata = "";

  $userdata .= '<table id="example1" class="table table-bordered table-striped">
        
                  <thead>
                  <tr>
                    <th>Sr. No.</th>
                    <th>SOURCE URL</th>
                    <th>MATCH</th>
                    <th>WHEN MATCHED</th>
                    <th>HTTP CODE</th>
                    <th>LOGGED IN</th>
                    <th>LOGGED OUT</th>
                    <th>DATE</th>
                    <th>ACTION</th>
                  </tr>
                  </thead>
                  <tbody>';

              while($row = mysqli_fetch_assoc($result)){
                  
            $imgpath = "assets/Blog/".$row['IMAGE'];
                    
                $userdata .= "<tr>
                    <td>".$i++."</td>
                     <td>{$row['SOURCE_URL']}</td>
                     <td>{$row['MATCH']}</td>
                    <td> {$row['WHEN_MATCHED']}</td>
                    <td>{$row['HTTP_CODE']}</td>
                    <td> {$row['LOGGED_IN']}</td>
                    <td> {$row['LOGGED_OUT']}</td>
                    <td> {$row['DATE']}</td>
                    <td><a href='Edit_redirection.php?id={$row['ID']}' class='btn btn-sm btn-warning edit-btn'>Edit</a> &nbsp; <br> <br> <button type='button' class='btn btn-sm btn-danger delete-btn' data-id='{$row['ID']}'>Delete</button></td>
                   </tr>";
              }
    $userdata .= " </tfoot>
                  
                </table>";
                
    echo $userdata;
}


// insert code 
if(isset($_POST['source'])){
          $source=$_POST['source'];
          $match=$_POST['match'];
          $when_matched=$_POST['when_matched'];
          $http=$_POST['http'];
          $log_in=$_POST['log_in'];
          $log_out=$_POST['log_out'];

  
        $insert="INSERT INTO `redirection_link`(`SOURCE_URL`, `MATCH`, `WHEN_MATCHED`, `HTTP_CODE`, `LOGGED_IN`,`LOGGED_OUT`) VALUES ('$source','$match','$when_matched','$http','$log_in','$log_out')";
        $run=mysqli_query($con,$insert);
        if($run){
            echo 1;
        }else{
            echo 0;
        }
    }
    
    // update code
if(isset($_POST['id']) && $_POST['id'] == 9){
$uid=$_POST['updateid'];
$update_source=$_POST['update_source'];
$upate_match=$_POST['upate_match'];
$update_when_matched=$_POST['update_when_matched'];
$update_http=$_POST['update_http'];
$update_log_in=$_POST['update_log_in'];
$update_log_out=$_POST['update_log_out'];



$sql ="UPDATE `redirection_link` SET `SOURCE_URL`='$update_source' , `MATCH`='$upate_match',`WHEN_MATCHED`='$update_when_matched',`HTTP_CODE`='$update_http' ,`LOGGED_IN`='$update_log_in' ,`LOGGED_OUT`='$update_log_out' WHERE ID='$uid'";
$run = mysqli_query($con,$sql);


if($run){
    echo 1;
}else{
    echo 0;
}

}
?>