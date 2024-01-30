<?php

session_start();
include("../../Db/config.php");


if (isset($_POST['pageid']) && $_POST['pageid'] ==4){
    
    $sql = "SELECT * FROM fund WHERE STATUS='Pending' order by ID desc";
// echo $sql;

    $result = mysqli_query($con, $sql);
    $userdata = "";

    $userdata .= '<table id="example1" class="table table-bordered table-striped">
        
                  <thead>
                  <tr>
                        <th>SL No</th>
                        <th>Date</th>
                        <th>Member ID</th>
                        <th>Ref Id</th>
                        <th>Amount</th>
                        <th>Fund Type</th>
                        <th>Status</th>
                        <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>';
$i=1;
    while ($row = mysqli_fetch_assoc($result))
    {
        $userdata .= "<tr>
                    <td>" . $i++ . "</td>
                     <td>{$row['DATE']}</td>  
                    <td>{$row['USER_ID']}</td>
                    <td>{$row['REFFRENCE_ID']}</td>
                    <td>{$row['AMOUNT']}</td>
                    <td>{$row['FUND_TYPE']}</td>
                    <td>{$row['STATUS']}</td>
                    <td>
                        <input type='button' data-mid='{$row['ID']}' data-cdid='{$row['AMOUNT']}' data-uid='{$row['USER_ID']}' class='btn btn-sm btn-success approve' value='Approve'>
                        <input type='button' data-miid='{$row['ID']}' class='btn btn-sm btn-danger mt-2 reject' value='Reject'>
                    </td>
                 </tr>";
    }
    $userdata .= " </tfoot>
                  
                </table>";


    echo $userdata;

}

if(isset($_POST['pageid']) && ($_POST['pageid']) == 2){
        $userid = $_POST['eid'];
        $amount = $_POST['Amount'];
        $user_id = $_POST['UserId'];
       
        $updatequery = $con->query("UPDATE `fund` SET STATUS='Approve' WHERE ID='$userid'");
        $main = $con->query("SELECT * FROM `user` WHERE ID = $user_id")->fetch_assoc();;
        $bal = $main['MAIN_BAL']+$amount;
        $update = $con->query("UPDATE `user` SET MAIN_BAL='$bal' WHERE ID='$user_id'");
        // $update_report= $con->query("UPDATE `report` SET `OWNER`='Admin',`OWNER_ID`=1,`TRANS_TYPE`='Offline Wallet',`REFERENCE_ID`=[value-5],`TOKEN_ID`=[value-6],`USER_ID`=[value-7],`TRANSFER_USER_ID`=[value-8],`PREVIOUS_AMOUNT`=[value-9],`AMOUNT`=[value-10],`AFTER_AMOUNT`=[value-11],`FUND_TYPE`=[value-12],`WALLET`=[value-13],`REMARK`=[value-14],`STATUS`=[value-15],`IP_ADDRESS`=[value-16],`BROWSER`=[value-17],`OS`=[value-18],`DEVICE`=[value-19],`LOCATION`=[value-20],`TRANS_DATE`=[value-21],`TRANS_TIME`=[value-22],`COUNTRY`=[value-23],`STATE`=[value-24],`CITY`=[value-25],`ZIP`=[value-26],`LATTITUDE`=[value-27],`LONGITUDE`=[value-28],`API_IP`=[value-29],`INTERNET_ISP`=[value-30],`INTERNET_ORG`=[value-31],`MESSAGE`=[value-32],`DATE`=[value-33],`ALL_MAIN`=[value-34],`ALL_AEPS`=[value-35],`APITYPE`=[value-36] WHERE ID='$user_id'");
        
        if($updatequery){
            echo 1;
        }else{
            echo 0;
        }
    }
    
if(isset($_POST['pageid']) && ($_POST['pageid']) == 3){
        $userid = $_POST['eid'];
       
        $updatequery = $con->query("UPDATE `fund` SET STATUS='Reject' WHERE ID='$userid'");
        if($updatequery){
            echo 1;
        }else{
            echo 0;
        }
    }

if (isset($_POST['pageid']) && $_POST['pageid'] == 5){
    
    $sql = "SELECT * FROM fund WHERE STATUS!='Pending' order by ID desc";
// echo $sql;

    $result = mysqli_query($con, $sql);
    $userdata = "";

    $userdata .= '<table id="example1" class="table table-bordered table-striped">
        
                  <thead>
                  <tr>
                        <th>SL No</th>
                        <th>Date</th>
                        <th>Member ID</th>
                        <th>Ref Id</th>
                        <th>Amount</th>
                        <th>Fund Type</th>
                        <th>Status</th>
                  </tr>
                  </thead>
                  <tbody>';
$i=1;
    while ($row = mysqli_fetch_assoc($result))
    {
        $userdata .= "<tr>
                    <td>" . $i++ . "</td>
                     <td>{$row['DATE']}</td>  
                    <td>{$row['USER_ID']}</td>
                    <td>{$row['REFFRENCE_ID']}</td>
                    <td>{$row['AMOUNT']}</td>
                    <td>{$row['FUND_TYPE']}</td>
                    <td>{$row['STATUS']}</td>
                </tr>";
    }
    $userdata .= " </tfoot>
                  
                </table>";


    echo $userdata;

}

?>
