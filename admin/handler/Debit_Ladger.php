<?php
session_start();
require_once('../../Db/config.php');


if(isset($_POST['pageid']) && $_POST['pageid'] == 1){

    $fromdate = $_POST['fromdate'];
    $todate = $_POST['todate'];
$i = 1;

$sql = "SELECT * FROM `report` WHERE date(DATE) between '$fromdate' and '$todate' AND FUND_TYPE='Debit' ORDER BY `ID` DESC";
// $sql = "SELECT * FROM `report` WHERE FUND_TYPE='Debit' ORDER BY `ID` DESC LIMIT 15";
$result = mysqli_query($con, $sql) or die("SQL Query Failed.");
$userdata = "";

$userdata .= '<table id="example1" class="table table-bordered table-striped">
        
                  <thead>
                  <tr>
                    <th>Sl No</th>
                    <th>USER NAME</th>
                    <th>TRANS TYPE</th>
                    <th>Transaction Id</th>
                    <th>PREVIOUS AMOUNT</th>
                    <th>AMOUNT</th>
                    <th>AFTER_AMOUNT</th>
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
                    <td>{$row['TRANS_TYPE']}</td>
                    <td>{$row['REFERENCE_ID']}</td>
                    <td>{$row['PREVIOUS_AMOUNT']}</td>
                    <td>{$row['AMOUNT']}</td>
                    <td>{$row['AFTER_AMOUNT']}</td>
                    <td>{$row['DATE']}</td>
                 </tr>";
  
              }
    $userdata .= " </tfoot>
                  
                </table>";
                
               
    echo $userdata;
}

?>