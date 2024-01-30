<?php
session_start();
require_once('../../Db/config.php');
require("../include/Auth.php");
$id = $_SESSION['UsId'];

// M-ATM report start here
    
    if(isset($_POST['pageid']) && $_POST['pageid'] == 2){
        $fromdate = $_POST['formdate'];
    $todate = $_POST['todate'];
        
 $i = 1;        

  
  $sql = "SELECT * FROM `micro_atm` WHERE USER_ID = '$id' AND date(DATE) between '$fromdate' and '$todate' ORDER BY ID DESC";
//   $sql = "SELECT * FROM `micro_atm` WHERE date(DATE) between '$fromdate' and '$todate' ORDER BY ID DESC";
//   $sql = "SELECT * FROM m_atm WHERE date(DATE) between '$fromdate' and '$todate' ORDER BY ID DESC";

$result = mysqli_query($con, $sql) or die("SQL Query Failed.");
$userdata = "";


  $userdata .= '<table id="example1" class="table table-bordered table-striped">
        
                  <thead>
                  <tr>
                    <th>Sr. No.</th>
                    <th>Member ID</th>
                    <th>Member Name</th>
                    <th>Mobile No</th>
                    
                    <th>Opening Balance</th>
                    <th>Transaction Amount</th>
                    
                    <th>Closing Balance</th>
                    <th>Balance Amount</th>
                    <th>Transaction ID</th>
                    <th>Transaction Type</th>
                    <th>Card Number</th>
                    <th>Card Type</th>
                    <th>Bank Name</th>
                    
                    <th>Staus</th>
                    <th>Date</th>
                  </tr>
                  </thead>
                  <tbody>';

              while($res = mysqli_fetch_assoc($result)){
                    $sql1 = $con->query("SELECT * FROM `user` WHERE ID = '$id'")->fetch_assoc();
                    $name = $sql1['FIRST_NAME']." ".$sql1['LAST_NAME'];
                    $txnid=$res['TXNID'];
                    $sql2 = $con->query("SELECT * FROM `report` WHERE REFERENCE_ID = '$txnid'")->fetch_assoc();
                    
                    
                    $res_ponse=$res['RESPONSE'];
                    if($res_ponse=='1'){
                        $resp_onse="Success";
                    }else{
                        $resp_onse="Pending";
                    }
                    
                    
                $userdata .= "<tr>
                    <td>".$i++."</td>
                    <td>{$res['USER_ID']}</td>
                    <td>$name</td>
                    <td>{$sql1['MOBILE']}</td>
                    <td>{$sql2['PREVIOUS_AMOUNT']}</td>
                    <td>{$res['TRANSAMOUNT']}</td>
                    <td>{$sql2['AFTER_AMOUNT']}</td>
                    <td>{$res['BALAMOUNT']}</td>
                    <td>{$res['TXNID']}</td>
                    <td>{$res['TRANSTYPE']}</td>
                    <td>{$res['CARDNUMBER']}</td>
                    <td>{$res['CARDTYPE']}</td>
                    <td>{$res['BANKNAME']}</td>
                    <td>$resp_onse</td>
                    <td>{$res['DATE']}</td>
                 </tr>";
              }
    $userdata .= " </tfoot>
                  
                </table>";
                
             
    

    echo $userdata;
        
    }
?>
