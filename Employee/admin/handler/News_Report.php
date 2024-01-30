<?php

session_start();
require_once('../../Db/config.php');
require("../include/Auth.php");
    
    if(isset($_POST['pageid']) && $_POST['pageid'] == 2){
        
$i = 1;

 $fromdate = $_POST['formdate'];
  $todate = $_POST['todate'];

  $sql = "
SELECT * FROM news WHERE date(DATE) BETWEEN '$fromdate' AND '$todate' ORDER BY ID DESC
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
                    <th>EMPLOYEE NAME</th>
                    <th>Date & Time</th>
                    <th>NEWS TEXT</th>
                    <th>From Date</th>
                    <th>To Date</th>
                    <th>Edit Action</th>
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
                    
                $userdata .= "<tr>
                    <td>".$i++."</td>
                     <td>{$row['USER_TYPE']}</td>
                    <td>$distname</td>
                    <td>$retname</td>
                    <td>$empname</td>
                    <td> {$row['DATE']}</td>
                    <td> {$row['NEWS_TEXT']}</td>
                    <td> {$row['FROM_DATE']}</td>
                    <td> {$row['TO_DATE']}</td>
                    <td>      <input type='button' data-mid='{$row['ID']}' 
                class='btn btn-warning edit_btn' value='Edit'>
                    
                    
                 </tr>";
              }
    $userdata .= " </tfoot>
                  
                </table>";
                
    echo $userdata;
}

if(isset($_POST['d_type'])){

    $utype=$_POST['d_type'];
   $dname=$_POST['distributor'];
    $rname=$_POST['retailer'];
    $employee=$_POST['employee'];
    $news=$_POST['desc'];
    $fromdate=$_POST['fromdate1'];
    $todate=$_POST['todate1'];
        $insert="INSERT INTO `news`(`USER_TYPE`, `DISTRIBUTOR_ID`, `RETAILER_ID`, `EMPLOYEE_ID`, `NEWS_TEXT`, `FROM_DATE`, `TO_DATE`) VALUES ('$utype','$dname','$rname','$employee','$news','$fromdate','$todate')";
        $run=mysqli_query($con,$insert);
        if($run){
            echo 1;
        }else{
            echo 0;
        }
    }
    
// UPDATE

if(isset($_POST['id']) && $_POST['id'] == 7){
$upid= $_POST['updates_id'];
$uptype= $_POST['update_user_type'];
$updistributor =$_POST['update_distributer_name'];
$upretailer =$_POST['update_retailer_name'];
$upemployee =$_POST['update_employee_name'];
$upfromdate =$_POST['update_from_date'];
$uptodate =$_POST['update_to_date'];
$upnewstext =$_POST['update_news_text'];
// $date = date('y-m-d h:i:s');

  $update_query="UPDATE `news` SET `USER_TYPE`='$uptype',`DISTRIBUTOR_ID`='$updistributor',`RETAILER_ID`='$upretailer',`EMPLOYEE_ID`='$upemployee',`FROM_DATE`='$upfromdate',`TO_DATE`='$uptodate',`NEWS_TEXT`='$upnewstext' WHERE ID='$upid'";
  
  if($update_query){
      echo 1;
  }else{
      echo 0;
  }
   $runs=mysqli_query($con,$update_query);

}


?>