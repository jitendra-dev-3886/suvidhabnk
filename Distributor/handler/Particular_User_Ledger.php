<?php

session_start();
require_once('../../Db/config.php');
require("../include/Auth.php");

if(isset($_POST['pageid']) && $_POST['pageid'] == 0){
$userr_idd=$_POST['userr_idd'];
  
  $sql = "SELECT * FROM `report` where `USER_ID`='$userr_idd' ORDER BY `ID` DESC";

$result = mysqli_query($con, $sql) or die("SQL Query Failed.");
$userdata = "";


  $userdata .= '<table id="example1" class="table table-bordered table-striped">
        
                  <thead>
                  <tr>
                    <th>Transaction Type</th>
                    <th>Reference ID</th>
                    <th>Number</th>
                    <th>Operator</th>
                    <th>Previous Amount</th>
                    <th>Amount</th>
                    <th>After Amount</th>
                    <th>Fund Type</th>
                    <th>Wallet type</th>
                    <th>Date & Time</th>
                    <th>Api Response</th>
                  </tr>
                  </thead>
                  <tbody>';

              while($row = mysqli_fetch_assoc($result)){
                  $transaction_type = $row['TRANS_TYPE'];
                  $refid=$row['REFERENCE_ID'];
                  
                  if($transaction_type=='Recharge' || $transaction_type='Recharge Commission' || $transaction_type='Recharge Main Wallet'){
               
               $recharge_table_query=$con->query("SELECT * FROM `recharge_transaction` WHERE `REFERENCE_ID`='$refid'")->fetch_assoc();
               $mobilee=$recharge_table_query['MOBILE'];
               $api_response=$recharge_table_query['RESPONSE'];
               $m_operator=$recharge_table_query['OPERATOR'];
               $statusss=$recharge_table_query['STATUS'];
                  }
                  
                  
                  else if($transaction_type=='DMT' || $transaction_type=='DMT Commission' || $transaction_type=='DMT Charge'){
                      $recharge_table_query=$con->query("SELECT * FROM `dmt_transactions` WHERE `REFFRENCE_ID`='$refid'")->fetch_assoc();
            //   $mobilee=$recharge_table_query['MOBILE'];
               $mobilee=$recharge_table_query['MOBILE'];
               $api_response=$recharge_table_query['RESPONSE'];
               $m_operator=$recharge_table_query['OPERATOR'];
               $statusss=$recharge_table_query['STATUS'];
               
                  }
                  else if($transaction_type=='AEPS' || $transaction_type=='AEPS Commission' || $transaction_type='Aeps MS Commission'){
                      $recharge_table_query=$con->query("SELECT * FROM `aeps_transactions` WHERE `REFFRENCE_ID`='$refid'")->fetch_assoc();
               $mobilee=$recharge_table_query['MOBILE'];
               $api_response=$recharge_table_query['RESPONSE'];
               $m_operator=$recharge_table_query['OPERATOR'];
               $statusss=$recharge_table_query['STATUS'];
                  }
                  else{
                      $m_operator='1';
                  }
                $userdata .= "<tr>
                    <td>{$row['TRANS_TYPE']}</td>
                    <td>{$row['REFERENCE_ID']}</td>
                    <td>$mobilee</td>
                    <td>$m_operator</td>
                    <td>{$row['PREVIOUS_AMOUNT']}</td>
                    <td>{$row['AMOUNT']}</td>
                    <td>{$row['AFTER_AMOUNT']}</td>
                    <td>{$row['FUND_TYPE']}</td>
                    <td>{$row['WALLET']}</td>
                    <td>{$row['DATE']}</td>
                    <td>$api_response</td>
                 </tr>";
                        // <input type='button' data-mid={$row['ID']} class='btn btn-success showledger' value='Show Full Ledger'>
              }
    $userdata .= " </tfoot>
                  
                </table>";
                
    echo $userdata;
    
    
    }

    
?>