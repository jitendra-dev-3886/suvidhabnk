<?php
session_start();
include("../../../../Db/config.php");
require("../../../include/Auth.php");


if(isset($_POST['getReport'])){

 $i = 1;
  
  $sql = "SELECT * FROM virtual_acc_transactions WHERE USER_ID = '$usid' ORDER BY ID DESC";

$result = mysqli_query($con, $sql) or die("SQL Query Failed.");
$userdata = "";

  $userdata .= '<table id="example1" class="table table-bordered table-striped">
        
                  <thead>
                  <tr>
                    <th>Sr. No.</th>
                    <th>Date and Time</th>
                    <th>Member Id.</th>
                    <th>Transaction Id.</th>
                    <th>Transaction Amount</th>
                    <th>UTR</th>
                    <th>Status</th>
                    <th>Recipt</th>
                  </tr>
                  </thead>
                  <tbody>';

              while($row = mysqli_fetch_assoc($result)){
                 
                $userdata .= "<tr>
                    <td>".$i++."</td>
                    <td>{$row['TIMESTAMP']}</td>
                    <td>{$user['PARTNER_ID']}</td>
                    <td>{$row['REF_ID']}</td>
                    <td>{$row['AMOUNT']}</td>
                    <td>{$row['UTR']}</td>
                    <td>{$row['STATUS']}</td>
                    <td><a target='_blank' href='##Recipt/AePsRecipt.php?refrence_id={$row['REFFRENCE_ID']}'><i class='nav-icon fas fa-receipt'></i></a></td>
                    
                 </tr>";
              }
    $userdata .= " </tfoot>
                  
                </table>";
                
               
    echo $userdata;
}
    
    