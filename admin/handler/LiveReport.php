<?php
session_start();
require_once('../../Db/config.php');


if(isset($_POST['pageid']) && $_POST['pageid'] == 1){

    $fromdate = $_POST['fromdate'];
    $todate = $_POST['todate'];
$i = 1;

$sql = "SELECT * FROM `report` ORDER BY `ID` DESC LIMIT 100";
$result = mysqli_query($con, $sql) or die("SQL Query Failed.");
$userdata = "";

$userdata .= '<table id="example1" class="table table-bordered table-striped">
        
                  <thead>
                  <tr>
                    <th>S.No</th>
                    <th>Name </th>
                    <th>Mobile </th>
                    <th>Transaction Type</th>
                    <th>Reference ID</th>
                    <th>Opening Balance </th>
                    <th>Amount</th>
                    <th>Closeing Balance</th>
                    <th>Fund type</th>
                    <th>Api Name</th>
                    <th>Remark</th>
                    <th> Trans Date</th> 
                    <th> Trans Time</th>
                    <th>Messages</th>
                    <th>Api Response</th>
                  </tr>
                  </thead>
                  <tbody>';
              while($row = mysqli_fetch_assoc($result)){
                   $Us_id=$row['USER_ID'];
                   $refId=$row['REFERENCE_ID'];
                //   $trans_type=$row['TRANS_TYPE']='Recharge';
                          
                    $user_Data = $con->query("SELECT * FROM `user` WHERE ID='$Us_id'")->fetch_assoc();
                    $rc_data = $con->query("SELECT * FROM `recharge_transaction` WHERE `REFERENCE_ID`='$refId'")->fetch_assoc();
                    $op = explode(",",$rc_data['OPERATOR']);
                    $op_list = $op['0'];
                    $long_code =$rc_data['LONG_CODE'];
                    $ApiHit = $con->query("SELECT * FROM `API_HITLOG` WHERE (USER_ID='$Us_id' || USER_ID='SMS') ORDER BY ID DESC LIMIT 2")->fetch_assoc();
                    
                    $serch = $con->query("SELECT * FROM switchOperator WHERE LONGCODE='$long_code'")->fetch_assoc();
                    $serchApi = $serch['APICOMPANY'];
                    
                    $rc_api = $con->query("SELECT * FROM `rechargeApi` WHERE ID='$serchApi'")->fetch_assoc();
                    $api_name= $rc_api['NAME'];
                    $selected = "";
                    if($row['TRANS_TYPE'] == 'Recharge'){
                        $selected = $rc_api['NAME'];
                    }else if($row['TRANS_TYPE'] !== 'FundTransfer'){
                        $selected = "paysprint";
                    }
                  
                $userdata .= "<tr>
                    <td>".$i++."</td>
                    <td>{$user_Data['FIRST_NAME']}  {$user_Data['LAST_NAME']}</td>
                    <td>{$user_Data['MOBILE']}</td>
                    <td>{$row['TRANS_TYPE']}</td>
                    <td>{$row['REFERENCE_ID']}</td>
                    <td>{$row['PREVIOUS_AMOUNT']}</td>
                    <td>{$row['AMOUNT']}</td>
                    <td>{$row['AFTER_AMOUNT']}</td>
                    <td>{$row['FUND_TYPE']}</td>
                     <td>{$selected}</td>
                    <td>{$row['REMARK']}</td>
                    <td>{$row['TRANS_DATE']}</td>
                    <td>{$row['TRANS_TIME']}</td>
                    <td>{$row['MESSAGE']}</td>
                    <td>{$ApiHit['RESPONSE_LOG']}</td>
                 </tr>";
  
              }
    $userdata .= " </tfoot>
                  
                </table>";
                
               
    echo $userdata;
}

?>