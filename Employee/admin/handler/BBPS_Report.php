<?php

session_start();
require_once('../../Db/config.php');
require("../include/Auth.php");
include("../Backend/Userinfo/getuserinfo.php");
include("../Backend/Functions/all_function.php");
include("../../Agent/Backend/BBPS/Paysprint/bbps_function.php");

 
if(isset($_POST['pageid']) && $_POST['pageid'] == 0){
        
$i = 1;
$mode = $_POST["mode"];

  $sql = "
SELECT * FROM pay_bill_api WHERE MODE='$mode' AND STATUS = 'Pending' ORDER BY ID DESC
";

$result = mysqli_query($con, $sql) or die("SQL Query Failed.");
$userdata = "";

  $userdata .= '<table id="example1" class="table table-bordered table-striped">
        
                  <thead>
                  <tr>
                    <th>Sr. No.</th>
                    <th>Date </th>
                    <th>Time </th>
                    <th>Member Id.</th>
                    <th>Member Mobile No.</th>
                    <th>Category</th>
                    <th>Operator</th>
                    <th>CA Number</th>
                    <th>Operator Id</th>
                    <th>Transaction Id.</th>
                    <th>Transaction Amount</th>
                    <th>Status</th>
                     <th>Remark</th>
                    <th>Action date</th>
                    <th>Recipt</th>
                    <th>Action</th>
                   
                  </tr>
                  </thead>
                  <tbody>';

              while($row = mysqli_fetch_assoc($result)){
                  
             $user1 = $con->query("SELECT PARTNER_ID,MOBILE FROM user WHERE ID = {$row['USER_ID']}")->fetch_assoc();

                    $st = explode("," , $row['STATUS']);
                $userdata .= "<tr>
                    <td>".$i++."</td>
                    <td> {$row['FILTER_DATE']}</td>
                    <td> {$row['TIMESTAMP']}</td>
                    <td>{$user1['PARTNER_ID']}</td>
                    <td>{$user1['MOBILE']}</td>
                    <td>{$row['CATEGORY']}</td>
                    <td>{$row['OP_NAME']}</td>
                    <td>{$row['CA_NUM']}</td>
                    <td>{$row['OPERATORID']}</td>
                    <td>{$row['REFFRENCE_ID']}</td>
                    <td>{$row['AMOUNT']}</td>
                    <td>{$row['STATUS']}</td>
                     <td>{$row['REMARK']}</td>
                    <td>{$row['ACTION_DATE']}</td>
                    <td><a target='_blank' href='Recipt/BBPSReciept.php?refrence_id={$row['REFFRENCE_ID']}'><i class='nav-icon fas fa-receipt'></i></a></td>
                    <td><button type='button' class='btn btn-primary' data-mid='{$row['ID']}' data-toggle='modal' data-target='#myModal' id='bbpsstschngbtn'>Update</button></td>
                  
                    </tr>";
              }
    $userdata .= " </tfoot>
                  
                </table>";
                
    echo $userdata;
}


  if(isset($_POST['pageid']) && $_POST['pageid'] == 1){
      $fromdate = $_POST['formdate'];
    $todate = $_POST['todate'];
        
$i = 1;
$mode = $_POST["mode"];

  $sql = "
SELECT * FROM pay_bill_api WHERE MODE='$mode' AND STATUS != 'Pending' AND FILTER_DATE BETWEEN '$fromdate' AND '$todate' ORDER BY ID DESC
";

$result = mysqli_query($con, $sql) or die("SQL Query Failed.");
$userdata = "";

  $userdata .= '<table id="example1" class="table table-bordered table-striped">
        
                  <thead>
                  <tr>
                    <th>Sr. No.</th>
                    <th>Date </th>
                    <th>Time </th>
                    <th>Member Id.</th>
                    <th>Member Mobile No.</th>
                    <th>Category</th>
                    <th>Operator</th>
                    <th>CA Number</th>
                    <th>Operator Id</th>
                    <th>Transaction Id.</th>
                    <th>Transaction Amount</th>
                    <th>Status</th>
                    <th>Remark</th>
                    <th>Action date</th>
                    <th>Recipt</th>
                    <th>Complain</th>
                  </tr>
                  </thead>
                  <tbody>';

              while($row = mysqli_fetch_assoc($result)){
                  
             $user1 = $con->query("SELECT PARTNER_ID,MOBILE FROM user WHERE ID = {$row['USER_ID']}")->fetch_assoc();

            
            

            if($row['COMPLAIN'] != "NO"){
                $cmpl = $con->query("select * from bbps_complains where REF_ID='".$row['REFFRENCE_ID']."' ")->fetch_assoc();
                if(strtolower($cmpl['STATUS']) == "pending"){
                    $complain = "<td><a type='button' class='btn btn-primary' onclick='checkComplain(\"".$cmpl['COMPLAIN_ID']."\")' >Update Complain (Comp ID : {$cmpl['COMPLAIN_ID']}) </button></td>";
                }
                else{
                    $complain = "<td><a type='button' class='btn btn-primary' onclick='checkComplain(\"".$cmpl['COMPLAIN_ID']."\")' >Check Complain Status (Comp ID : {$cmpl['COMPLAIN_ID']}) </button></td>";
                }
            }
            else{
                $complain = "<td><a type='button' onclick='showmodalcomplain(\"".$row['REFFRENCE_ID']."\" , \"".$row['OPERATORID']."\")' class='btn btn-primary' >Do Complain</button></td>";
            }

                    $st = explode("," , $row['STATUS']);
                $userdata .= "<tr>
                    <td>".$i++."</td>
                    <td> {$row['FILTER_DATE']}</td>
                    <td> {$row['TIMESTAMP']}</td>
                    <td>{$user1['PARTNER_ID']}</td>
                    <td>{$user1['MOBILE']}</td>
                    <td>{$row['CATEGORY']}</td>
                    <td>{$row['OP_NAME']}</td>
                    <td>{$row['CA_NUM']}</td>
                    <td>{$row['OPERATORID']}</td>
                    <td>{$row['REFFRENCE_ID']}</td>
                    <td>{$row['AMOUNT']}</td>
                    <td>{$row['STATUS']}</td>
                    <td>{$row['REMARK']}</td>
                    <td>{$row['ACTION_DATE']}</td>
                    <td><a target='_blank' href='Recipt/BBPSReciept.php?refrence_id={$row['REFFRENCE_ID']}'><i class='nav-icon fas fa-receipt'></i></a></td>
                      $complain
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
SELECT * FROM pay_bill_api WHERE MODE='$mode' AND FILTER_DATE BETWEEN '{$fromdate}' AND '{$todate}'
";


$result = mysqli_query($con, $sql) or die("SQL Query Failed.");
$userdata = "";


 $userdata .= '<table id="example1" class="table table-bordered table-striped">
        
                  <thead>
                  <tr>
                    <th>Sr. No.</th>
                    <th>Date </th>
                    <th>Time </th>
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
                    <td> {$row['FILTER_DATE']}</td>
                    <td> {$row['TIMESTAMP']}</td>
                    <td>{$user1['PARTNER_ID']}</td>
                    <td>{$user1['MOBILE']}</td>
                    <td>{$row['CATEGORY']}</td>
                    <td>{$row['OP_NAME']}</td>
                    <td>{$row['OPERATORID']}</td>
                    <td>{$row['REFFRENCE_ID']}</td>
                    <td>{$row['AMOUNT']}</td>
                    <td>{$row['STATUS']}</td>
                    <td><a target='_blank' href='Recipt/BBPSReciept.php?refrence_id={$row['REFFRENCE_ID']}'><i class='nav-icon fas fa-receipt'></i></a></td>
                    <td><button type='button' class='btn btn-primary' data-mid='{$row['ID']}' data-toggle='modal' data-target='#myModal' id='bbpsstschngbtn'>Update</button></td>
                    
                 </tr>";
              }
    $userdata .= " </tfoot>
                  
                </table>";
                
              

    echo $userdata;
}


if(isset($_POST['pageid']) && $_POST['pageid'] == 3){
        
$i = 1;
$cat = $_POST["category"];

  $sql = "
SELECT * FROM pay_bill_api WHERE CATEGORY='$cat' ORDER BY ID DESC
";

$result = mysqli_query($con, $sql) or die("SQL Query Failed.");
$userdata = "";

  $userdata .= '<table id="example1" class="table table-bordered table-striped">
        
                  <thead>
                  <tr>
                    <th>Sr. No.</th>
                    <th>Date </th>
                    <th>Time </th>
                    <th>Member Id.</th>
                    <th>Member Mobile No.</th>
                    <th>Category</th>
                    <th>Operator</th>
                    <th>Operator Id</th>
                    <th>Transaction Id.</th>
                    <th>Transaction Amount</th>
                    <th>Status</th>
                    <th>Recipt</th>
                  </tr>
                  </thead>
                  <tbody>';

              while($row = mysqli_fetch_assoc($result)){
                  
             $user1 = $con->query("SELECT PARTNER_ID FROM user WHERE ID = {$row['USER_ID']}")->fetch_assoc();
                    $st = explode("," , $row['STATUS']);
                $userdata .= "<tr>
                    <td>".$i++."</td>
                    <td>{$row['FILTER_DATE']}</td>
                    <td>{$row['TIMESTAMP']}</td>
                    <td>{$user1['PARTNER_ID']}</td>
                    <td>{$user1['MOBILE']}</td>
                    <td>{$row['CATEGORY']}</td>
                    <td>{$row['OP_NAME']}</td>
                    <td>{$row['OPERATORID']}</td>
                    <td>{$row['REFFRENCE_ID']}</td>
                    <td>{$row['AMOUNT']}</td>
                    <td>{$row['STATUS']}</td>
                    <td><a target='_blank' href='Recipt/BBPSReciept.php?refrence_id={$row['REFFRENCE_ID']}'><i class='nav-icon fas fa-receipt'></i></a></td>
                    
                 </tr>";
              }
    $userdata .= " </tfoot>
                  
                </table>";
                
    echo $userdata;
}


if(isset($_POST['pageid']) && $_POST['pageid'] == 4){
    
    $fromdate = $_POST['formdate'];
    $todate = $_POST['todate'];
    $cat = $_POST["category"];

 $i = 1;

  $sql = "
SELECT * FROM pay_bill_api WHERE CATEGORY='$cat' AND date(TIMESTAMP) BETWEEN '{$fromdate}' AND '{$todate}'
";


$result = mysqli_query($con, $sql) or die("SQL Query Failed.");
$userdata = "";


 $userdata .= '<table id="example1" class="table table-bordered table-striped">
        
                  <thead>
                  <tr>
                    <th>Sr. No.</th>
                    <th>Date </th>
                    <th>Time </th>
                    <th>Member Id.</th>
                    <th>Member Mobile No.</th>
                    <th>Category</th>
                    <th>Operator</th>
                    <th>Operator Id</th>
                    <th>Transaction Id.</th>
                    <th>Transaction Amount</th>
                    <th>Status</th>
                    <th>Recipt</th>
                  </tr>
                  </thead>
                  <tbody>';

              while($row = mysqli_fetch_assoc($result)){
                  
             $user1 = $con->query("SELECT PARTNER_ID FROM user WHERE ID = {$row['USER_ID']}")->fetch_assoc();
                    $st = explode("," , $row['STATUS']);
                $userdata .= "<tr>
                    <td>".$i++."</td>
                    <td>{$row['FILTER_DATE']}</td>
                    <td>{$row['TIMESTAMP']}</td>
                    <td>{$user1['PARTNER_ID']}</td>
                    <td>{$user1['MOBILE']}</td>
                    <td>{$row['CATEGORY']}</td>
                    <td>{$row['OP_NAME']}</td>
                    <td>{$row['OPERATORID']}</td>
                    <td>{$row['REFFRENCE_ID']}</td>
                    <td>{$row['AMOUNT']}</td>
                    <td>{$row['STATUS']}</td>
                    <td><a target='_blank' href='Recipt/BBPSReciept.php?refrence_id={$row['REFFRENCE_ID']}'><i class='nav-icon fas fa-receipt'></i></a></td>
                    
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

$pandt = $con->query("select * from pay_bill_api where ID='$id'")->fetch_assoc();
if(strtolower($pandt['STATUS']) != "pending"){
    echo json_encode(array("status"=>false,"response_code"=>  500 , "message"=>"Status already checked."));
     exit;
}

$sqlquery = $con->query("UPDATE pay_bill_api SET STATUS='$status',REMARK='$remark',ACTION_DATE='$action_date' WHERE ID = '$id'");

if($sqlquery){
    
      if($status == "Failed"){
         $usdt = $con->query("select * from user where ID='".$pandt['USER_ID']."' ")->fetch_assoc();
         $usupdtbal = $usdt['MAIN_BAL'] + $pandt['AMOUNT'];
         $con->query("update user set MAIN_BAL='$usupdtbal' where ID='".$pandt['USER_ID']."'");
          insert_allreport($pandt['USER_ID']  ,$pandt['REFFRENCE_ID'] , "BBPS OFFLINE Refund" , $usdt['MAIN_BAL']  , $usupdtbal , $pandt['AMOUNT'] , "Credit" , "BBPS OFFLINE Refund Transaction", "MAIN");
     }
     else{
         give_bbps_com($pandt['REFFRENCE_ID'] , $pandt['USER_ID'] , 46 , strtoupper(str_replace(" " , "" , $pandt['CATEGORY'])));
     }
     
    echo 1;
    
}else{
    
    echo 0;
}

  
}

    
 ?>