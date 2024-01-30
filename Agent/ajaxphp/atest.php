<?php
session_start();
require_once('../../Db/config.php');

$id=$_SESSION['UsId'];
$i = 1;
$res = $con->query("SELECT * FROM `aeps_transactions` WHERE USER_ID = '$id'") or die('sql query failed');

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
                    
                   while($row = $res->fetch_assoc()){    
                  $userdata .= "<tr>
                    <td>< $i++ </td>
                    <td>< {$row['TIMESTAMP']}.' '.{$row['FILTER_DATE']}</td>
                    <td>< {$user['PARTNER_ID']}</td>
                    <td>< {$row['MOBILE']}</td>
                    <td>< {$row['REFFRENCE_ID']}</td>
                    <td>< {$row['AMOUNT']}</td>
                    <td>< {$row['STATUS']}</td>
                    <td><span class='badge badge-info right' data-toggle='modal' data-target='.bd-example-modal-lg'>View Details</span></td>
	                </tr>";
                   }
               
                 $userdata .= '</tbody>
                </table>';
                
    echo $userdata;
?>