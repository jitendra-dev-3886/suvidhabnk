<?php

session_start();
require_once('../../Db/config.php');
require_once('../include/Auth.php');
$usid = $_SESSION['UsId']; 
 //-----admin Payout report-------//

    if(isset($_POST['pageid']) && $_POST['pageid'] == 3){
        $formdate = $_POST['formdate'];
        $todate = $_POST['todate'];
        $filter = "AND FILTER_DATE BETWEEN '$formdate' AND '$todate'";

$duser = $con->query("SELECT * FROM user WHERE OWNER_ID='$usid'")->fetch_assoc();

$duserid = $duser["ID"];
        $i = 1;
  $sql = "
SELECT * FROM payout_transaction WHERE USER_ID = '$duserid' $filter ORDER BY ID DESC
";

$result = mysqli_query($con, $sql) or die("SQL Query Failed.");
$userdata = "";


  $userdata .= '<table id="example1" class="table table-bordered table-striped">
        
                  <thead>
                  <tr>
                    <th>Sr. No.</th>
                    <th>Date and Time</th>
                    <th>Member Id.</th>
                    <th>Member Mobile No.</th>
                    <th>Transaction Id.</th>
                    <th>Transaction Amount</th>
                    <th>Status</th>
                    <th>Reciept</th>
                  </tr>
                  </thead>
                  <tbody>';

              while($row = mysqli_fetch_assoc($result)){
                  
             $user1 = $con->query("SELECT PARTNER_ID,MOBILE FROM user WHERE ID = '{$row["USER_ID"]}' ")->fetch_assoc();
                  
                $userdata .= "<tr>
                    <td>".$i++."</td>
                    <td>{$row['TIMESTAMP']} {$row['FILTER_DATE']}</td>
                    <td>{$user1['PARTNER_ID']}</td>
                    <td>{$user1['MOBILE']}</td>
                    <td>{$row['REFFRENCE_ID']}</td>
                    <td>{$row['AMOUNT']}</td>
                    <td>{$row['STATUS']}</td>
                    <td><a target='_blank' href='Recipt/PayoutRecipt.php?refrence_id={$row['REFFRENCE_ID']}'><i class='nav-icon fas fa-receipt'></i></a></td>
                    
                 </tr>";
              }
    $userdata .= " </tfoot>
                  
                </table>";
                

    echo $userdata;
    }
    
    
    if(isset($_POST['pageid']) && $_POST['pageid'] == 4){

 if($_POST['formdate'] != '' && $_POST['todate'] != ''){
        $formdate = $_POST['formdate'];
        $todate = $_POST['todate'];
        $filter = "AND FILTER_DATE BETWEEN '$formdate' AND '$todate'";
        }
$i = 1;
  $sql = "SELECT * FROM payout_transaction WHERE USER_ID = '$usid' $filter ORDER BY ID DESC";

$result = mysqli_query($con, $sql) or die("SQL Query Failed.");
$userdata = "";


  $userdata .= '<table id="example1" class="table table-bordered table-striped">
        
                  <thead>
                  <tr>
                    <th>Sr. No.</th>
                    <th>Date and Time</th>
                    <th>Member Id.</th>
                    <th>Member Mobile No.</th>
                    <th>Transaction Id.</th>
                    <th>Transaction Amount</th>
                    <th>Status</th>
                    <th>View Details</th>
                  </tr>
                  </thead>
                  <tbody>';

              while($row = mysqli_fetch_assoc($result)){
                  
             $user1 = $con->query("SELECT PARTNER_ID,MOBILE FROM user WHERE ID = '{$row["USER_ID"]}' ")->fetch_assoc();
                  
                $userdata .= "<tr>
                    <td>".$i++."</td>
                    <td>{$row['TIMESTAMP']} {$row['FILTER_DATE']}</td>
                    <td>{$user1['PARTNER_ID']}</td>
                    <td>{$user1['MOBILE']}</td>
                    <td>{$row['REFFRENCE_ID']}</td>
                    <td>{$row['AMOUNT']}</td>
                    <td>{$row['STATUS']}</td>
                    <td><span class='badge badge-info right' data-toggle='modal' data-target='.bd-example-modal-lg'>View Details</span></td>
                    
                 </tr>";
              }
    $userdata .= " </tfoot>
                  
                </table>";
                

    echo $userdata;
    }
    
?>