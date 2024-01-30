<?php
session_start();
require_once('../../Db/config.php');


if(isset($_POST['pageid']) && $_POST['pageid'] == 1){

    $fromdate = $_POST['fromdate'];
    $todate = $_POST['todate'];
$i = 1;

$sql = "SELECT * FROM `API_HITLOG` WHERE date(DATE) between '$fromdate' and '$todate' ORDER BY `ID` DESC LIMIT 100";
$result = mysqli_query($con, $sql) or die("SQL Query Failed.");
$userdata = "";

$userdata .= '<table id="example1" class="table table-bordered table-striped">
        
                  <thead>
                  <tr>
                    <th>Sl No</th>
                    <th>Member</th>
                    <th>Service</th>
                    <th>Transaction Id</th>
                    <th>Request Log</th>
                    <th>Response Log</th>
                    <th>Date</th>
                  </tr>
                  </thead>
                  <tbody>';
              while($row = mysqli_fetch_assoc($result)){
                   $Us_id=$row['USER_ID'];
                   $transid=$row['ID'];
                   $user_Data = $con->query("SELECT * FROM `user` WHERE ID='$Us_id' ORDER BY ID DESC")->fetch_assoc();
  
                $userdata .= "<tr>
                    <td>".$i++."</td>
                    <td>{$user_Data['FIRST_NAME']} {$user_Data['MOBILE']}</td>
                    <td>{$row['SEVICE']}</td>
                    <td>{$row['TRANSACTION_ID']}</td>
                    <td>{$row['REQUEST_LOG']}</td>
                    <td>{$row['RESPONSE_LOG']}</td>
                    <td>{$row['DATE']}</td>
                 </tr>";
  
              }
    $userdata .= " </tfoot>
                  
                </table>";
                
               
    echo $userdata;
}

?>