<?php
session_start();
require_once ('../../Db/config.php');
require ("../include/Auth.php");

$id = $_SESSION['UsId'];

if (isset($_POST['pageid']) && $_POST['pageid'] == 4)
{
    $fromdate = $_POST['formdate'];
    $todate = $_POST['todate'];

    $i = 1;
    
   
    
    $sql = "SELECT * FROM wallet_cashfree WHERE USER_ID = '$id' AND date(TRANSACTION_TIME) between '$fromdate' and '$todate' ORDER BY ID DESC";
    // echo $sql;

    $result = mysqli_query($con, $sql);
    $userdata = "";

    $userdata .= '<table id="example1" class="table table-bordered table-striped">
        
                  <thead>
                  <tr>
                     <th>Sr. No</th>
                        <th>USER ID</th>
                        <th>NAME</th>
                        <th>MOBILE</th>
                        <th>EMAIL</th>
                        <th>ORDER ID</th>
                        <th>PREVIOUS BALANACE</th>
                        <th>ORDER AMOUNT</th>
                        <th>CLOSING BALANACE</th>
                        <th>ORDER NOTE</th>
                        <th>REFERENCEID</th>
                        <th>TRANSACTION STATUS</th>
                        <th>PAYMENT MODE</th>
                        <th>MESSAGE</th>
                        <th>TRANSACTION TIME</th>
                        <th>TRANSACTION INITIATE TIME</th>
                  </tr>
                  </thead>
                  <tbody>';

             while ($row = mysqli_fetch_assoc($result))
    {
        $userdata .= "<tr>
                    <td>" . $i++ . "</td>
                    <td>{$row['USER_ID']}</td>
                    <td>{$row['NAME']}</td>
                    <td>{$row['MOBILE']}</td>
                    <td>{$row['EMAIL']}</td>
                    <td>{$row['ORDER_ID']}</td>
                    <td>{$row['PREVIOUS_BALANACE']}</td>
                    <td>{$row['ORDER_AMOUNT']}</td>
                    <td>{$row['CLOSING_BALANACE']}</td>
                    <td>{$row['ORDER_NOTE']}</td>
                    <td>{$row['REFERENCE_ID']}</td>
                    <td>{$row['TRANSACTION_STATUS']}</td>
                    <td>{$row['PAYMENT_MODE']}</td>
                    <td>{$row['MESSAGE']}</td>
                    <td>{$row['TRANSACTION_TIME']}</td>
                    <td>{$row['CURRENTT_TIMESTAMP']}</td>
                 </tr>";
    }
    $userdata .= " </tfoot>
                  
                </table>";

    echo $userdata;

}

