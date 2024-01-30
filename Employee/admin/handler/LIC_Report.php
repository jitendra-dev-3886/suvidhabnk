<?php

session_start();
require_once('../../Db/config.php');
require("../include/Auth.php");
include("../Backend/Userinfo/getuserinfo.php");
include("../Backend/Functions/all_function.php");
 
  if(isset($_POST['pageid']) && $_POST['pageid'] == 1){
        
$i = 1;
$mode = $_POST["mode"];
$type = $_POST["category"];

if($mode != ''){
    $whr = "AND MODE='$mode'";
}else if($type != ''){
    $whr = "AND CATEGORY='$type'";
    
}else{
    $whr = "";
    
}

  $sql = "SELECT * FROM lic_transaction WHERE MODE='$mode' AND STATUS = 'Pending' ORDER BY ID DESC";

$result = mysqli_query($con, $sql) or die("SQL Query Failed.");
$userdata = "";

  $userdata .= '<table id="example1" class="table table-bordered table-striped">
        
                  <thead>
                  <tr>
                    <th>Sr. No.</th>
                    <th>Date & Time </th>
                    <th>Member Id.</th>
                    <th>Member Mobile No.</th>
                    <th>CA Number</th>
                    <th>Transaction Id.</th>
                    <th>Amount</th>
                    <th>Email</th>x
                    <th>Cell NO</th>
                    <th>Due Date</th>
                    <th>Status</th>
                    <th>Recipt</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>';

              while($row = mysqli_fetch_assoc($result)){
                  
             $user1 = $con->query("SELECT PARTNER_ID,MOBILE FROM user WHERE ID = '{$row["USER_ID"]}'")->fetch_assoc();
             
             

             $response_data = json_decode($row['SEND_DATA'],true);
                $userdata .= "<tr>
                    <td>".$i++."</td>
                    <td> {$row['FILTER_DATE']}</td>
                    <td>{$user1['PARTNER_ID']}</td>
                    <td>{$user1['MOBILE']}</td>
                    <td>{$row['CA_NUM']}</td>
                    <td>{$row['REFFRENCE_ID']}</td>
                    <td>{$row['AMOUNT']}</td>
                    <td>{$response_data['ad1']}</td>
                    <td>{$response_data['bill_fetch']['cellNumber']}</td>
                    <td>{$response_data['bill_fetch']['dueDate']}</td>
                    <td>{$row['STATUS']}</td>
                    <td><a target='_blank' href='Recipt/Lic_reciept.php?refrence_id={$row['REFFRENCE_ID']}'><i class='nav-icon fas fa-receipt'></i></a></td>
                    <td><button type='button' class='btn btn-primary' data-mid='{$row['ID']}' data-toggle='modal' data-target='#myModal' id='bbpsstschngbtn'>Update</button></td>
                    
                 </tr>";
              }
    $userdata .= " </tfoot>
                  
                </table>";
                
    echo $userdata;
}




if(isset($_POST['pageid']) && $_POST['pageid'] == 2){
    
    $fromdate = $_POST['formdate'];
    $todate = $_POST['todate'];
    $mode = $_POST["mode"];

 $i = 1;

  $sql = "
SELECT * FROM lic_transaction WHERE USER_ID='$usid' $whr AND date(TIMESTAMP) BETWEEN '{$fromdate}' AND '{$todate}'
";


$result = mysqli_query($con, $sql) or die("SQL Query Failed.");
$userdata = "";


 $userdata .= '<table id="example1" class="table table-bordered table-striped">
        
                  <thead>
                  <tr>
                    <th>Sr. No.</th>
                    <th>Date </th>
                    <th>Member Id.</th>
                    <th>Member Mobile No.</th>
                    <th>Category</th>
                    <th>Operator</th>
                    <th>Operator Id</th>
                    <th>Transaction Id.</th>
                    <th>Transaction Amount</th>
                    <th>Status</th>
                    <th>Recipt</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>';

              while($row = mysqli_fetch_assoc($result)){
                  
             $user1 = $con->query("SELECT PARTNER_ID FROM user WHERE ID = {$row['USER_ID']}")->fetch_assoc();
                    $st = explode("," , $row['STATUS']);
                $userdata .= "<tr>
                    <td>".$i++."</td>
                    <td> {$row['TIMESTAMP']}</td>
                    <td>{$user1['PARTNER_ID']}</td>
                    <td>{$user1['MOBILE']}</td>
                    <td>{$row['CATEGORY']}</td>
                    <td>{$row['OP_NAME']}</td>
                    <td>{$row['OPERATORID']}</td>
                    <td>{$row['REFFRENCE_ID']}</td>
                    <td>{$row['AMOUNT']}</td>
                    <td>{$row['STATUS']}</td>
                    <td><a target='_blank' href='Recipt/Lic_reciept.php?refrence_id={$row['REFFRENCE_ID']}'><i class='nav-icon fas fa-receipt'></i></a></td>
                    <td><button type='button' class='btn btn-primary' data-mid='{$row['ID']}' data-toggle='modal' data-target='#myModal' id='bbpsstschngbtn'>Update</button></td>

                 </tr>";
              }
    $userdata .= " </tfoot>
                  
                </table>";
                
              

    echo $userdata;
}


if(isset($_POST['pageid']) && $_POST['pageid'] == 5){
        
$action_date = date("Y-m-d h:i:s A");
$id = $_POST["uid"];
$status = $_POST["status"];
$remark = $_POST["remark"];

$sqlquery = $con->query("UPDATE lic_transaction SET STATUS='$status',REMARK='$remark',ACTION_DATE='$action_date' WHERE ID = '$id'");

if($sqlquery){
    
     $pandt = $con->query("select * from lic_transaction where ID='$id'")->fetch_assoc();
      if($status == "Failed"){
         $usdt = $con->query("select * from user where ID='".$pandt["USER_ID"]."'")->fetch_assoc();
         $usupdtbal = $usdt['MAIN_BAL'] + $pandt['AMOUNT'];
         $con->query("update user set MAIN_BAL='$usupdtbal' where ID='".$pandt["USER_ID"]."'");
          insert_allreport($pandt['USER_ID']  ,$pandt['REFFRENCE_ID'] , "LIC OFFLINE Refund" , $usdt['MAIN_BAL']  , $usupdtbal , $pandt['AMOUNT'] , "Credit" , "LIC OFFLINE Refund Transaction", "MAIN");
          
     }
         
    echo 1;
}else{
    echo 0;
}

  
}



    
 ?>