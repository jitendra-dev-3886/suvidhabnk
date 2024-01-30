<?php
session_start();
require_once('../../Db/config.php');
require("../include/Auth.php");

$id = $_SESSION['UsId'];

if(isset($_POST['pageid']) && $_POST['pageid'] == "ticketreport"){

$fromdate = $_POST['formdate'];
$todate = $_POST['todate'];
 $i = 1;
  
  $sql = "SELECT * FROM `ticket` WHERE USER_ID='$id' AND TRANSACTION_DATE BETWEEN '$fromdate' AND '$todate' ORDER BY ID DESC";

$result = mysqli_query($con, $sql) or die("SQL Query Failed.");
$userdata = "";


  $userdata .= '<table id="example1" class="table table-bordered table-striped">
        
                  <thead>
                  <tr>
                    <th>Sr. No</th>
                    <th>Ticket Id</th>
                    <th>Department</th>
                    <th>Transaction No.</th>
                    <th>Transaction Date</th>
                    <th>Description</th>
                    <th>Proof</th>
                    <th>Status</th>
                    <th>Issue Date</th>
                    <th>Action Date</th>
                    <th>Remark</th>
                  </tr>
                  </thead>
                  <tbody>';
              while($row = mysqli_fetch_assoc($result)){
                 
                $userdata .= "<tr>
                    <td>".$i++."</td>
                    <td>{$row['TICKET_ID']}</td>
                    <td>{$row['DEPARTMENT']}</td>
                    <td>{$row['TRANSACTION_ID']}</td>
                    <td>{$row['TRANSACTION_DATE']}</td>
                    <td>{$row['DESCRIPTION']}</td>
                    <td>";
                    
                    if($row['PROOF']==''){ 
                        $userdata .= "Not Uploaded";
                    }else{
                        
                        $userdata .= "<a href='/Agent/dist/img/TicketRise/{$row['PROOF']}' class='btn btn-sm btn-primary' download>Download</a>"; 
                        
                        
                    } 
                    
                    $userdata .= "</td>
                    <td>{$row['STATUS']}</td>
                    <td>{$row['ISSUE_DATE']}</td>
                    <td>{$row['ACTION_DATE']}</td>
                    <td>{$row['REMARK']}</td>
                 </tr>";
              }
    $userdata .= " </tfoot>
                  
                </table>";
                
               
    echo $userdata;
}
  ?>