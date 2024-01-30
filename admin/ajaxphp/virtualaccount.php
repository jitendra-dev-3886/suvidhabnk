<?php

session_start();
require_once('../../Db/config.php');

 //-----admin Virtual Account report-------//

    if(isset($_POST['pageid']) && $_POST['pageid'] == 3){
        $i = 1;
        
    $fromdate = $_POST['formdate'];
    $todate = $_POST['todate'];
    
// SELECT * FROM virtual_acc_transactions WHERE FILTER_DATE BETWEEN '{$fromdate}' AND '{$todate}' ORDER BY ID DESC
 $sql = "
SELECT * FROM virtual_acc_transactions  ORDER BY ID DESC
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
                    <th>Amount</th>
                    <th>Email</th>
                    <th>UTR</th>
                    <th>Mode</th>
                    <th>Remitter Name</th>
                    <th>R. A/C No.</th>
                    <th>R. IFSC Code</th>
                    <th>V. A/C No</th>
                    <th>Status</th>
                  </tr>
                  </thead>
                  <tbody>';

              while($row = mysqli_fetch_assoc($result)){
                  
             $user1 = $con->query("SELECT PARTNER_ID,MOBILE FROM user WHERE ID = '{$row["USER_ID"]}' ")->fetch_assoc();
                  
                  $response_data = json_decode($row['RESPONSE'],true);
                  
                $userdata .= "<tr>
                    <td>".$i++."</td>
                    <td>{$row['FILTER_DATE']} {$row['TIMESTAMP']}</td>
                    <td>{$user1['PARTNER_ID']}</td>
                    <td>{$user1['MOBILE']}</td>
                    <td>{$row['REF_ID']}</td>
                    <td>{$row['AMOUNT']}</td>
                    <td>{$response_data['email']}</td>
                    <td>{$response_data['utr']}</td>
                    <td>{$response_data['transferType']}</td>
                    <td>{$response_data['remitterName']}</td>
                    <td>{$response_data['remitterAccount']}</td>
                    <td>{$response_data['remitterIfsc']}</td>
                    <td>{$response_data['vAccountNumber']}</td>
                    <td>{$row['STATUS']}</td>
                    
                 </tr>";
              }
    $userdata .= " </tfoot>
                  
                </table>";
                

    echo $userdata;
    }
    
?>