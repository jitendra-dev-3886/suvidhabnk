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

  $duser = $con->query("SELECT * FROM user WHERE OWNER_ID='$id' ORDER BY ID DESC")->fetch_assoc();

$duserid = $duser["ID"];

  $sql = "SELECT * FROM micro_atm WHERE USER_ID = '$duserid' AND date(DATE) between '$fromdate' and '$todate' ORDER BY ID DESC";

$result = mysqli_query($con, $sql) or die("SQL Query Failed.");
$userdata = "";


  $userdata .= '<table id="example1" class="table table-bordered table-striped">
        
                  <thead>
                  <tr>
                    <th>Sr. No.</th>
                    <th>Member ID</th>
                    <th>Member Name</th>
                    <th>Mobile No</th>
                    <th>Transaction Amount</th>
                    <th>Balance Amount</th>
                    <th>Transaction ID</th>
                    <th>Transaction Type</th>
                    <th>Card Number</th>
                    <th>Card Type</th>
                    <th>Bank Name</th>
                    <th>Date</th>
                  </tr>
                  </thead>
                  <tbody>';

              while($row = mysqli_fetch_assoc($result)){
                 $name = $duser['FIRST_NAME']." ".$duser['LAST_NAME'];
                $userdata .= "<tr>
                    <td>".$i++."</td>
                    <td>{$res['USER_ID']}</td>
                    <td>$name</td>
                    <td>{$duser['MOBILE']}</td>
                    <td>{$res['TRANSAMOUNT']}</td>
                    <td>{$res['BALAMOUNT']}</td>
                    <td>{$res['TXNID']}</td>
                    <td>{$res['TRANSTYPE']}</td>
                    <td>{$res['CARDNUMBER']}</td>
                    <td>{$res['CARDTYPE']}</td>
                    <td>{$res['BANKNAME']}</td>
                    <td>{$res['DATE']}</td>
                 </tr>";
              }
    $userdata .= " </tfoot>
                  
                </table>";
                
             
    

    echo $userdata;
        
    }
?>
