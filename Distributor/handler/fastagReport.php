<?php
session_start();
require_once('../../Db/config.php');
require("../include/Auth.php");
 $usid = $_SESSION['UsId'];

if(isset($_POST['pageid']) && $_POST['pageid'] == 0){
    $fromdate = $_POST['formdate'];
    $todate = $_POST['todate'];

$duser = $con->query("SELECT * FROM user WHERE OWNER_ID='$usid'")->fetch_assoc();

$duserid = $duser["ID"];

 $i = 1;

  $sql = "
SELECT * FROM fastag_transaction WHERE USER_ID = '$duserid' AND date(DATE) between '$fromdate' and '$todate' ORDER BY ID DESC";


$result = mysqli_query($con, $sql) or die("SQL Query Failed.");
$userdata = "";


  $userdata .= '<table id="example1" class="table table-bordered table-striped">
        
                  <thead>
                  <tr>
                    <th>Sr. No.</th>
                    <th>Date and Time</th>
                    <th>Oprator Name</th>
                    <th>Amount</th>
                    <th>Operator Id</th>
                    <th>Refference Id</th>
                    <th>Status</th>
                  </tr>
                  </thead>
                  <tbody>';

              while($row = mysqli_fetch_assoc($result)){
                 
                $userdata .= "<tr>
                    <td>".$i++."</td>
                    <td>{$row['DATE']}</td>
                    <td>{$row['OP_NAME']}</td>
                    <td>{$row['AMOUNT']}</td>
                    <td>{$row['OPERATORID']}</td>
                    <td>{$row['REFFRENCE_ID']}</td>
                    <td>{$row['STATUS']}</td>
                   
                 </tr>";
              }
    $userdata .= " </tfoot>
                  
                </table>";
                

    echo $userdata;
}
?>