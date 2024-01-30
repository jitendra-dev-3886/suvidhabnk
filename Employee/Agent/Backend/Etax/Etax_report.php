<?php
session_start();
include("../../../Db/config.php");

$id = $_SESSION['UsId'];


$EtaxType = $_GET['type'];
$fromdate = $_POST['formdate'];
        $todate = $_POST['todate'];
$i = 1;
$sql = "SELECT * FROM `etax` WHERE TYPE='$EtaxType' AND USER_ID='$id' AND date(DATE) between '$fromdate' and '$todate' ORDER BY ID DESC";
$result = mysqli_query($con, $sql) or die("SQL Query Failed.");
$userdata = "";

$userdata .= '<table id="example1" class="table table-bordered table-striped">
        
                  <thead>
                  <tr>
                    <th>Sl No</th>
                    <th>NAME</th>
                    <th>Mobile</th>
                    <th>TYPE</th>
                    <th>Refrence Id</th>
                    <th>REMARK</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Action Date</th>
                  </tr>
                  </thead>
                  <tbody>';
              while($row = mysqli_fetch_assoc($result)){
                   $Us_id=$row['USER_ID'];
                   $transid=$row['ID'];
                   $user_Data = $con->query("SELECT * FROM `user` WHERE ID='$Us_id' ORDER BY ID DESC")->fetch_assoc();
  
                $userdata .= "<tr>
                    <td>".$i++."</td>
                    <td>{$row['NAME']}</td>
                    <td>{$row['MOBILE']}</td>
                    <td>{$row['TYPE']}</td>
                    <td>{$row['REFERENCE_ID']}</td>
                    <td>{$row['REMARK']}</td>
                    <td>{$row['STATUS']}</td>
                    <td>{$row['DATE']}</td>
                    <td>{$row['ACTION_DATE']}</td>
                 </tr>";
  
              }
    $userdata .= " </tfoot>
                  
                </table>";
                
               
    echo $userdata;

?>