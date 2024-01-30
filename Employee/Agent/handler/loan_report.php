<?php
session_start();
require_once('../../Db/config.php');
require("../include/Auth.php");

$id = $_SESSION['UsId'];

if(isset($_POST['pageid']) && $_POST['pageid'] == 6){
        $fromdate = $_POST['formdate'];
        $todate = $_POST['todate'];
 $i = 1;
  
  $sql = "
SELECT * FROM `loan_request` WHERE USER_ID='$id' AND date(DATE) between '$fromdate' and '$todate' ORDER BY ID DESC
";

$result = mysqli_query($con, $sql) or die("SQL Query Failed.");
$userdata = "";


  $userdata .= '<table id="example1" class="table table-bordered table-striped">
        
                  <thead>
                  <tr>
                    <th>Sr. No.</th>
                    <th>Customer Name</th>
                    <th>Mobile No.</th>
                    <th>Profession</th>
                    <th>Income</th>
                    <th>RequiredLoan</th>
                    <th>ApprovededLoan</th>
                    <th>Status</th>
                    <th>Remarks</th>
                    <th>Date</th>
                    <th>Recipt</th>
                    <th>ActionDate</th>
                  </tr>
                  </thead>
                  <tbody>';

              while($row = mysqli_fetch_assoc($result)){
                  
                  if($row['ACTION_DATE'] == null){
                      $actiondate = "Date Not Available";
                  }else{
                       $actiondate = $row['ACTION_DATE'];
                  }
                  
                   if($row['RECIPT'] == ""){
                     $img = "Not Available";
                 }
                 else{
                     $img = "<a href='../../admin/assets/loan_document/{$row['RECIPT']}' download><span class='badge badge-info right' style='cursor:pointer;' >Download Image</span></a>";
                 }
                $userdata .= "<tr>
                    <td>".$i++."</td>
                    <td>{$row['CUSTOMER_NAME']}</td>
                    <td>{$row['MOBILE_NO']}</td>
                    <td>{$row['PROFESSION']}</td>
                    <td>{$row['INCOME']}</td>
                    <td>{$row['REQUIRE_LOAN']}</td>
                    <td>{$row['APPROVED_LOAN_AMT']}</td>
                    <td>{$row['STATUS']}</td>
                    <td>{$row['ADMIN_REMARK']}</td>
                    <td>{$row['DATE']}</td>
                    <td>{$img}</td>
                    <td> $actiondate</td>
                 </tr>";
              }
    $userdata .= " </tfoot>
                  
                </table>";
                
               
    echo $userdata;
}
  ?>