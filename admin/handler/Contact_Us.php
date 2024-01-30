<?php
session_start();
// include("../config.php");
require_once('../../Db/config.php');


      //  Display Code

if(isset($_POST['id']) && $_POST['id'] == 1){
    
    
// $query = "SELECT * FROM `contact` ORDER BY ID DESC";
// $query_run = mysqli_query($con,$query);

$i = 1;

$fromdate = $_POST['formdate'];
  $todate = $_POST['todate'];
  
  $sql = "SELECT * FROM `contact` WHERE date(DATE) BETWEEN '$fromdate' AND '$todate'  ORDER BY ID DESC";
$result = mysqli_query($con, $sql) or die("SQL Query Failed.");
    //   $res = $con->query("SELECT * FROM `contact` WHERE date(DATE) BETWEEN '$fromdate' AND '$todate' AND ID = '$id' ORDER BY ID DESC");
$output = "";

  $output .= '<table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>SL No</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Description</th>
                    <th>Message</th>
                    <th>Date</th>
                  </tr>
                  </thead>
                  <tbody> 
                ';
    while($row = $result->fetch_assoc()){
    
    $output .= "<tr>
    
    <td>".$i++."</td>
    <td>{$row['FULLNAME']}</td>
    <td>{$row['EMAIL']}</td>
    <td>{$row['DESCRIPTION']}</td>
    <td>{$row['MESSAGE']}</td>
    <td>{$row['DATE']}</td>
    </tr>";
    
    }
    $output .="</tfoot>
           </table>";
    echo $output;
}


if(isset($_POST['idd']) && $_POST['idd'] == 1){
    $mobile1=$_POST['mobile1'];
    $email1=$_POST['email1'];
    $address1=$_POST['address1'];
    // echo $email1;
    // echo $mobile1;
    $date=date('Y-m-d H:i:s');
    // echo $date;
    $sql12=$con->query("UPDATE `company_contact` SET `MOBILE`='$mobile1',`EMAIL`='$email1', `ADDRESS`='$address1',`DATE_TIME`='$date' WHERE ID='1'");
    // echo "UPDATE `company_contact` SET `MOBILE`='$mobile1',`EMAIL`='$email1' WHERE ID='1'";
    if($sql12){
        echo 1;
    }else{
        echo 2;
    }
}    


 ?>