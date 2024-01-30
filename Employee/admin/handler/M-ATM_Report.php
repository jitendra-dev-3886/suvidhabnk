<?php
session_start();
require_once('../../Db/config.php');
require("../include/Auth.php");
$id = $_SESSION['UsId'];

// M-ATM Report start here

    if(isset($_POST['pageid']) && $_POST['pageid'] == 1){
        $fromdate = $_POST['formdate'];
    $todate = $_POST['todate'];
        
 $i = 1;        

  
  $sql = "SELECT * FROM micro_atm WHERE date(DATE) between '$fromdate' and '$todate' ORDER BY ID DESC";
//   $sql = "SELECT * FROM m_atm WHERE date(DATE) between '$fromdate' and '$todate' ORDER BY ID DESC";
    
$result = mysqli_query($con, $sql) or die("SQL Query Failed.");
$userdata = "";


  $userdata .= '<table id="example1" class="table table-bordered table-striped">
        
                  <thead>
                  <tr>
                    <th>Sr. No.</th>
                    <th>Member ID</th>
                    <th>Member Name</th>
                    <th>Mobile No</th>
                    <th>Transaction Amount</th>
                    <th>Balance Amount</th>
                    <th>Transaction ID</th>
                    <th>Transaction Type</th>
                    <th>Card Number</th>
                    <th>Card Type</th>
                    <th>Bank Name</th>
                    <th>Date</th>
                  </tr>
                  </thead>
                  <tbody>';

              while($row = mysqli_fetch_assoc($result)){
                  $user = $con->query("SELECT * FROM `user`")->fetch_assoc();
                $name = $user['FIRST_NAME']." ".$user['LAST_NAME'];
                $userdata .= "<tr>
                    <td>".$i++."</td>
                    <td>{$res['USER_ID']}</td>
                    <td>$name</td>
                    <td>{$user['MOBILE']}</td>
                    <td>{$res['TRANSAMOUNT']}</td>
                    <td>{$res['BALAMOUNT']}</td>
                    <td>{$res['TXNID']}</td>
                    <td>{$res['TRANSTYPE']}</td>
                    <td>{$res['CARDNUMBER']}</td>
                    <td>{$res['CARDTYPE']}</td>
                    <td>{$res['BANKNAME']}</td>
                    <td>{$res['DATE']}</td>
                 </tr>";
              }
    $userdata .= " </tfoot>
                  
                </table>";
                
             
    

    echo $userdata;
        
    }



// M-ATM Request Report start here
    
    if(isset($_POST['pageid']) && $_POST['pageid'] == 2){
        $fromdate = $_POST['formdate'];
    $todate = $_POST['todate'];
        
 $i = 1;        

  
  $sql = "SELECT * FROM m_atm WHERE date(DATE) between '$fromdate' and '$todate' ORDER BY ID DESC";
//   $sql = "SELECT * FROM m_atm WHERE date(DATE) between '$fromdate' and '$todate' ORDER BY ID DESC";

$result = mysqli_query($con, $sql) or die("SQL Query Failed.");
$userdata = "";


  $userdata .= '<table id="example1" class="table table-bordered table-striped">
        
                  <thead>
                  <tr>
                     <th>Sr. No.</th>
                    <th>Device Name</th>
                    <th>Quantity</th>
                    <th>Status</th>
                    <th>Date & Time</th>
                    <th>Edit Action</th>
                    <th>Delete Action</th>
                  </tr>
                  </thead>
                  <tbody>';

              while($row = mysqli_fetch_assoc($result)){
                 
                $userdata .= "<tr>
                    <td>".$i++."</td>
                    <td>".$row['DEVICE_NAME']."</td>
                    <td>".$row['QUANTITY']."</td>
                    <td>{$row['STATUS']}</td>
                    <td>{$row['DATE']}</td>
                    <td><input type='button' data-mid='{$row['ID']}' class='btn btn-warning edit_btn' value='Edit'></td>
                    <td><input type='button' class='btn btn-danger deletebtn' data-id='{$row['ID']}'  value='Delete'></td>
                 </tr>";
              }
    $userdata .= " </tfoot>
                  
                </table>";
                
             
    

    echo $userdata;
        
    }
    
    
    
    
 ///delete user record
if(isset($_POST['pageid']) && $_POST['pageid'] == 3){
    $userid=$_POST['eid'];
    $deletequery ="DELETE FROM `m_atm` WHERE id='$userid'";
    $run=mysqli_query($con,$deletequery);
    if($run){
        echo 1;
    }else{
        echo 0;
    }
}   
 
 
 
 
//  update code
 if(isset($_POST['id']) && $_POST['id'] == 7){
$upid= $_POST['updates_id'];
$upstatus= $_POST['update_status'];
  $update_query="UPDATE `m_atm` SET `STATUS`='$upstatus' WHERE ID='$upid'";
  
  if($update_query){
      echo 1;
  }else{
      echo 0;
  }
   $runs=mysqli_query($con,$update_query);

}
   
?>
