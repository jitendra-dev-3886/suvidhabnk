<?php

session_start();
require_once('../../Db/config.php');
require("../include/Auth.php");

if(isset($_POST['pageid']) && $_POST['pageid'] == 0){

  
  $sql = "SELECT * FROM `user` where US_STATUS='Active' ORDER BY `ID` DESC";

$result = mysqli_query($con, $sql) or die("SQL Query Failed.");
$userdata = "";


  $userdata .= '<table id="example1" class="table table-bordered table-striped">
        
                  <thead>
                  <tr>
                    <th>Member ID</th>
                    <th>Full Name</th>
                    <th>Mobile</th>
                    <th>Email</th>
                    <th>Type</th>
                    <th>Owner</th>
                    <th>Profile</th>
                    <th>Status</th>
                    <th>Owner ID</th>
                    <th>City </th>
                    <th>Pincode</th>
                    <th>Joining Date</th>
                    <th>Password</th>
                    <th>Main Bal</th>
                    <th>AePs Bal</th>
                    <th>Pan</th>
                    <th>Aadhaar</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>';

              while($row = mysqli_fetch_assoc($result)){
                  $ownerid = $row["OWNER_ID"];
                  $USid = $row["ID"];
                  $usertype = $con->query("SELECT * FROM user_type WHERE ID = '{$row['USER_TYPE']}'")->fetch_assoc();
                  $userowner = $con->query("SELECT * FROM user WHERE ID = '$ownerid'")->fetch_assoc();
                  $userprofile = $con->query("SELECT * FROM `user_profile` WHERE USER_ID = '$USid'")->fetch_assoc();
                  
                  if($userowner != ""){
                        $ownername = $userowner["FIRST_NAME"].' '.$userowner["LAST_NAME"];
                    }else{
                         $ownername = "Admin";
                    }
                  
                $userdata .= "<tr>
                    <td>{$row['PARTNER_ID']}</td>
                    <td>{$row['FIRST_NAME']} {$row['LAST_NAME']}</td>
                    <td>{$row['MOBILE']}</td>
                    <td>{$row['EMAIL']}</td>
                    <td>{$usertype['NAME']}</td>
                    <td>$ownername</td>
                    <td><span class='badge badge-info right' id='mbtn' style='cursor:pointer;' data-mid='{$row['ID']}' data-toggle='modal' data-target='.bd-example-modal-lg'>View Profile</span></td>
                    <!--<td><a href='ViewMemberProfile.php?mid={$row['ID']}' target='_blank' class='badge badge-info right' id='mbtn' style='cursor:pointer;'>View Profile</a></td>-->
                    <td>{$row['US_STATUS']}</td>
                    
                    <td>{$userowner['PARTNER_ID']}</td>
                    <td>{$row['CITY']}</td>
                    <td>{$row['PIN']}</td>
                    <td>{$row['DATE']}</td>
                    <td>{$row['PASSWORD']}</td>
                    <td>{$row['MAIN_BAL']}</td>
                    <td>{$row['AEPS_BAL']}</td>
                    <td>{$userprofile['PAN_CARD_NO']}</td>
                    <td>{$userprofile['AADHAR_CARD_NO']}</td>
                    <td>
                        <input type='button' data-mid={$row['ID']} class='btn btn-primary edit_btn' value='Edit'>
                        <input type='button' data-mid={$row['ID']} class='btn btn-danger deletebtn' value='Delete'>
                    </td>
                 </tr>";
              }
    $userdata .= " </tfoot>
                  
                </table>";
                
    echo $userdata;
    
    
    }
if(isset($_POST['pageid']) && $_POST['pageid'] == 33){

  
  $sql = "SELECT * FROM `user` where US_STATUS='Active' ORDER BY `ID` DESC";

$result = mysqli_query($con, $sql) or die("SQL Query Failed.");
$userdata = "";


  $userdata .= '<table id="example1" class="table table-bordered table-striped">
        
                  <thead>
                  <tr>
                    <th>Member ID</th>
                    <th>Full Name</th>
                    <th>Mobile</th>
                    <th>Email</th>
                    <th>MAIN BALANCE</th>
                    <th>AEPS BALANCE</th>
                    <th>Type</th>
                    <th>Owner</th>
                    <th>Status</th>
                    <th>Owner ID</th>
                    <th>City </th>
                    <th>Pincode</th>
                    <th>Joining Date</th>
                  </tr>
                  </thead>
                  <tbody>';
                    // <th>Subscription</th>
                    // <th>Pan</th>
                    // <th>Aadhaar</th>
                    // <th>Remaining Days</th>
                    // <th>Action</th>
                    // <th>Profile</th>

              while($row = mysqli_fetch_assoc($result)){
                  $ownerid = $row["OWNER_ID"];
                  $usertype = $con->query("SELECT * FROM user_type WHERE ID = '{$row['USER_TYPE']}'")->fetch_assoc();
                  $userowner = $con->query("SELECT * FROM user WHERE ID = '$ownerid'")->fetch_assoc();
                  
                  if($userowner != ""){
                        $ownername = $userowner["FIRST_NAME"].' '.$userowner["LAST_NAME"];
                    }else{
                         $ownername = "Admin";
                    }
                  
                $userdata .= "<tr>
                    <td>{$row['PARTNER_ID']}</td>
                    <td>{$row['FIRST_NAME']} {$row['LAST_NAME']}</td>
                    <td>{$row['MOBILE']}</td>
                    <td>{$row['EMAIL']}</td>
                    <td>{$row['MAIN_BAL']}</td>
                    <td>{$row['AEPS_BAL']}</td>
                    <td>{$usertype['NAME']}</td>
                    <td>$ownername</td>
                    <td>{$row['US_STATUS']}</td>
                    
                    <td>{$userowner['PARTNER_ID']}</td>
                    <td>{$row['CITY']}</td>
                    <td>{$row['PIN']}</td>
                    <td>{$row['DATE']}</td>
                 </tr>";
                    // <td>{$row['SUBSCRIPTION']}</td>
                    // <td>{$row['ADHAAR']}</td>
                    // <td>{$row['PAN']}</td>
                    // <td>{$row['']}</td>
                    // <td>
                    //     <input type='button' data-mid={$row['ID']} class='btn btn-primary edit_btn' value='Edit'>
                    //     <input type='button' data-mid={$row['ID']} class='btn btn-danger deletebtn' value='Delete'>
                    // </td>
                    // <td><span class='badge badge-info right' id='mbtn' style='cursor:pointer;' data-mid='{$row['ID']}' data-toggle='modal' data-target='.bd-example-modal-lg'>View Profile</span></td>
              }
    $userdata .= " </tfoot>
                  
                </table>";
                
    echo $userdata;
    
    
    }
    
    //delete user
    
    if(isset($_POST['pageid']) && ($_POST['pageid']) == 11){
        $userid = $_POST['eid'];
       
        $deletequery = $con->query("DELETE FROM `user` WHERE ID='$userid'");
        if($deletequery){
            echo 1;
            // echo 'alert ("Deleted")';
        }else{
            echo 0;
            // echo 'alert("Not Deleted")';
        }
    }
    
    // edit user data
    
    if(isset($_POST['pageiddd']) && ($_POST['pageiddd']) == 12){
        $xid = $_POST['sid'];
        $sql = $con->query("SELECT * FROM `user` WHERE `ID`='$xid'");
        $output = "";
        if(mysqli_num_rows($sql) > 0 ){
            while ($row = mysqli_fetch_assoc($sql)){
                $output .= "<div id='edit_data'>
                    <form>
                        <div class='form-group'>
                            <input type='hidden' id='update_id' value='$xid'>
                            <label>First Name</label>
                            <input type = 'text' name = 'update_fname' id = 'update_fname' class = 'form-control' value = '{$row['FIRST_NAME']}'>
                        </div>
                        <div class='form-group'>
                            <label>Last Name</label>
                            <input type = 'text' name = 'update_lname' id = 'update_lname' class = 'form-control' value = '{$row['LAST_NAME']}'>
                        </div>
                        <div class='form-group'>
                            <label>Update_Mobile</label>
                            <input type = 'number' name = 'update_mobile' id = 'update_mobile' class = 'form-control' value = '{$row['MOBILE']}'>
                        </div>
                        <div class='form-group'>
                            <label>Update_Email</label>
                            <input type = 'email' name = 'update_email' id = 'update_email' class = 'form-control' value = '{$row['EMAIL']}'>
                        </div>
                        <div class='form-group'>
                            <label>Update_Address</label>
                            <input type = 'text' name = 'update_address' id = 'update_address' class = 'form-control' value = '{$row['ADDRESS']}'>
                        </div>
                        <div class='form-group'>
                            <label>Update_City</label>
                            <input type = 'text' name = 'update_city' id = 'update_city' class = 'form-control' value = '{$row['CITY']}'>
                        </div>
                        <div class='form-group'>
                            <label>Update_State</label>
                            <input type = 'text' name = 'update_state' id = 'update_state' class = 'form-control' value = '{$row['STATE']}'>
                        </div>
                        <div class='form-group'>
                            <label>Update_Pincode</label>
                            <input type = 'number' name = 'update_pincode' id = 'update_pincode' class = 'form-control' value = '{$row['PIN']}'>
                        </div>
                        <div class='modal-footer'>
                            <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
                            <button type='button' class='btn btn-primary updatebtn' id='updatebtn' data-dismiss='modal'>Save changes</button>
                        </div>
                    </form>
                </div>";
                mysqli_close($con);
                echo $output;
            }
        }else{
            echo "No record found";
        }
    }
    
    //Update Query
    if(isset($_POST['pageid']) && ($_POST['pageid']) == 13){
        $upid = $_POST['updates_id'];
        $upfname = $_POST['update_fname'];
        $uplname = $_POST['update_lname'];
        $upmobile = $_POST['update_mobile'];
        $upemail = $_POST['update_email'];
        $upaddress = $_POST['update_address'];
        $upcity = $_POST['update_city'];
        $upstate = $_POST['update_state'];
        $uppincode = $_POST['update_pincode'];

        $update_query = $con->query("UPDATE `user` SET `FIRST_NAME`='$upfname',`LAST_NAME`='$uplname',`MOBILE`='$upmobile',`EMAIL`='$upemail',`ADDRESS`='$upaddress',`CITY`='$upcity',`STATE`='$upstate',`PIN`='$uppincode' WHERE `ID` = '$upid'");
        if ($update_query){
            echo 1;
        }else{
            echo 0;
        }
    }
    
    
   // Distributor list for inactive user 
   
   
   if(isset($_POST['pageid']) && $_POST['pageid'] == 9){

  
  $sql = "
SELECT * FROM user WHERE USER_TYPE = '47' AND US_STATUS = 'Deactive' ORDER BY ID DESC
";

$result = mysqli_query($con, $sql) or die("SQL Query Failed.");
$userdata = "";


  $userdata .= '<table id="example1" class="table table-bordered table-striped">
        
                  <thead>
                  <tr>
                    <th>Member ID</th>
                    <th>Full Name</th>
                    <th>Mobile</th>
                    <th>Email</th>
                    <th>Owner</th>
                    <th>Profile</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>';

              while($row = mysqli_fetch_assoc($result)){
                  $ownerid = $row["OWNER_ID"];
                  $usertype = $con->query("SELECT * FROM user_type WHERE ID = '{$row['USER_TYPE']}'")->fetch_assoc();
                  $userowner = $con->query("SELECT * FROM user WHERE ID = '$ownerid'")->fetch_assoc();
                  
                  if($userowner != ""){
        $ownername = $userowner["FIRST_NAME"].' '.$userowner["LAST_NAME"];
    }else{
         $ownername = "Admin";
    }
                  
                $userdata .= "<tr>
                    <td>{$row['PARTNER_ID']}</td>
                    <td>{$row['FIRST_NAME']} {$row['LAST_NAME']}</td>
                    <td>{$row['MOBILE']}</td>
                    <td>{$row['EMAIL']}</td>
                    <td>$ownername</td>
                    <td><span class='badge badge-info right' id='mbtn' style='cursor:pointer;' data-mid='{$row['ID']}' data-toggle='modal' data-target='.bd-example-modal-lg'>View Profile</span></td>
                    <td>{$row['US_STATUS']}</td>
                    <td><button type='button' data-did='{$row['ID']}' id='dtdelbtn' class='btn btn-danger'><i class='fas fa-trash'></i></button></td>
                 </tr>";
              }
    $userdata .= " </tfoot>
                  
                </table>";
                
    echo $userdata;
    
    
    }
    
    
    
     // Retailer list for inactive user 
   
   
   if(isset($_POST['type']) && $_POST['type'] == "rtverify"){

  
  $sql = "
SELECT * FROM user WHERE  US_STATUS = 'Deactive' ORDER BY ID DESC
";

$result = mysqli_query($con, $sql) or die("SQL Query Failed.");
$userdata = "";


  $userdata .= '<table id="example1" class="table table-bordered table-striped">
        
                  <thead>
                  <tr>
                    <th>Member ID</th>
                    <th>Full Name</th>
                    <th>Mobile</th>
                    <th>Email</th>
                    <th>Owner</th>
                    <th>Profile</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>';

              while($row = mysqli_fetch_assoc($result)){
                  $ownerid = $row["OWNER_ID"];
                  $usertype = $con->query("SELECT * FROM user_type WHERE ID = '{$row['USER_TYPE']}'")->fetch_assoc();
                  $userowner = $con->query("SELECT * FROM user WHERE ID = '$ownerid'")->fetch_assoc();
                  
                  if($userowner != ""){
        $ownername = $userowner["FIRST_NAME"].' '.$userowner["LAST_NAME"];
    }else{
         $ownername = "Admin";
    }
                  
                $userdata .= "<tr>
                    <td>{$row['PARTNER_ID']}</td>
                    <td>{$row['FIRST_NAME']} {$row['LAST_NAME']}</td>
                    <td>{$row['MOBILE']}</td>
                    <td>{$row['EMAIL']}</td>
                    <td>$ownername</td>
                    <td><span class='badge badge-info right' id='mbtn' style='cursor:pointer;' data-mid='{$row['ID']}' data-toggle='modal' data-target='.bd-example-modal-lg'>View Profile</span></td>
                    <td>{$row['US_STATUS']}</td>
                    <td><button type='button' data-rid='{$row['ID']}' id='rtdelbtn' class='btn btn-danger'><i class='fas fa-trash'></i></button></td>
                 </tr>";
              }
    $userdata .= " </tfoot>
                  
                </table>";
                
    echo $userdata;
    
    
    }
    
    
    
    //-----admin UPI report-------//
    
    if(isset($_POST['type']) && $_POST['type'] == "UPI"){
        
$i = 1;
 $fromdate = $_POST['formdate'];
    $todate = $_POST['todate'];
    
  $sql = "
SELECT * FROM upi_transactions WHERE FILTER_DATE BETWEEN '{$fromdate}' AND '{$todate}' ORDER BY ID DESC
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
                    <th>Member Name</th>
                    <th>UPI Id</th>
                    <th>Transaction Id.</th>
                    <th>Transaction Amount</th>
                    <th>API</th>
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
                    <td> {$row['FILTER_DATE']}</td>
                    <td> {$row['TIMESTAMP']}</td>
                    <td>{$user1['PARTNER_ID']}</td>
                    <td>{$user1['MOBILE']}</td>
                    <td>{$row['NAME']}</td>
                    <td>{$row['UPI_ID']}</td>
                    <td>{$row['REFFRENCE_ID']}</td>
                    <td>{$row['AMOUNT']}</td>
                    <td>{$row['APINAME']}</td>
                    <td>{$row['STATUS']}</td>
                    <td><a target='_blank' href='Recipt/UPIRecipt.php?refrence_id={$row['REFFRENCE_ID']}'><i class='nav-icon fas fa-receipt'></i></a></td>
                    
                 </tr>";
              }
    $userdata .= " </tfoot>
                  
                </table>";
                
    echo $userdata;
}
    
    
    
    
    //-----admin aeps report-------//
    
    if(isset($_POST['pageid']) && $_POST['pageid'] == 1){
  
    $fromdate = $_POST['formdate'];
    $todate = $_POST['todate'];
    
  $sql = "
SELECT * FROM aeps_transactions WHERE TRANS_TYPE = 'CW' AND FILTER_DATE BETWEEN '{$fromdate}' AND '{$todate}' ORDER BY ID DESC
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
                    <th>Transaction Id.</th>
                    <th>Transaction Amount</th>
                    <th>Status</th>
                    <th>Msg</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>';
$i=1;
              while($row = mysqli_fetch_assoc($result)){
                  
             $user1 = $con->query("SELECT PARTNER_ID FROM user WHERE ID = '{$row["USER_ID"]}'")->fetch_assoc();
                  $st = explode("," , $row['STATUS']);
                $userdata .= "<tr>
                    <td>".$i++."</td>
                    <td>{$row['FILTER_DATE']}</td>
                    <td> {$row['TIMESTAMP']}</td>
                    <td>{$user1['PARTNER_ID']}</td>
                    <td>{$row['MOBILE']}</td>
                    <td>{$row['REFFRENCE_ID']}</td>
                    <td>{$row['AMOUNT']}</td>
                    <td>{$st[0]}</td>
                    <td>{$st[1]}</td>
                    <td><a target='_blank' href='Recipt/AePsRecipt.php?refrence_id={$row['REFFRENCE_ID']}&type=CW'  class='p-0'><i class='nav-icon fas fa-receipt'></i></a>
                   <a  href='javascript::void' class='modal-xl p-0 apiHitLogs' type='button' name='Api_Hit_Log' data-mid='{$row['REFFRENCE_ID']}' aria-label='Api Hit Log' title='Api Hit Log' data-toggle='modal' data-target='#exampleModal'><i class='nav-icon fas fa-question-circle text-warning'></i></a></td>
                    
                 </tr>";
                //   <a  href='javascript::void' class='p-0' type='button' name='refresh' aria-label='Check Status' title='Check Status'><i class='fa fa-sync'></i></a>
              }
    $userdata .= " </tfoot>
                  
                </table>";
              

    echo $userdata;
}


// api hit logs 
if(isset($_POST['pageid']) && $_POST['pageid'] == 23){
    
    $id = $_POST['mid'];
    
    $output = "";
    // $aepsId=$con->query("SELECT * FROM aeps_transactions ID='$id'")->fetch_assoc();
    // $aeps_refId=$aepsId['REFFRENCE_ID'];
    // // echo $aeps_refId;
    $apiHit = $con->query("SELECT * FROM `API_HITLOG` WHERE TRANSACTION_ID='$id' ORDER BY ID DESC LIMIT 1")->fetch_assoc();
    
    //   while($rowHit = mysqli_fetch_assoc($apiHit)){
          
    $output .= "
     <form >
      <h3>Request Log:</h3> 
        <div class='alert alert-primary' role='alert' id='' style='overflow:auto'>
          {$apiHit['REQUEST_LOG']}
        </div>
        
        <h3>Response Log</h3>
        <div class='alert alert-success' role='alert' id='' style='overflow:auto'>
          {$apiHit['RESPONSE_LOG']}
        </div>
      <div class='modal-footer'>
        <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
        <button type='button' class='btn btn-primary'>Save changes</button>
      </div>
      </form>
    ";
    //   }
    echo $output;
    
}


// Aeps Ministatement Report 


if(isset($_POST['pageid']) && $_POST['pageid'] == 5){
   $fromdate = $_POST['formdate'];
    $todate = $_POST['todate'];
  $sql = "
SELECT * FROM aeps_transactions WHERE TRANS_TYPE = 'MS' AND FILTER_DATE BETWEEN '{$fromdate}' AND '{$todate}' ORDER BY ID DESC
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
                    <th>Transaction Id.</th>
                     <th>Status</th>
                    <th>Msg</th>
                    <th>Recipt</th>
                  </tr>
                  </thead>
                  <tbody>';
$i=1;
              while($row = mysqli_fetch_assoc($result)){
                  
             $user1 = $con->query("SELECT PARTNER_ID FROM user WHERE ID = '{$row["USER_ID"]}'")->fetch_assoc();
                    $st = explode("," , $row['STATUS']);
                $userdata .= "<tr>
                    <td>".$i++."</td>
                     <td>{$row['FILTER_DATE']}</td>
                    <td> {$row['TIMESTAMP']}</td>
                    <td>{$user1['PARTNER_ID']}</td>
                    <td>{$row['MOBILE']}</td>
                    <td>{$row['REFFRENCE_ID']}</td>
                     <td>{$st[0]}</td>
                    <td>{$st[1]}</td>
                    <td><a target='_blank' href='Recipt/AePsMinistatment.php?refrence_id={$row['REFFRENCE_ID']}&type=MS'><i class='nav-icon fas fa-receipt'></i></a></td>
                    
                 </tr>";
              }
    $userdata .= " </tfoot>
                  
                </table>";
              

    echo $userdata;
}



// Aeps Balance Enquery Report code here


if(isset($_POST['pageid']) && $_POST['pageid'] == 6){
  
  $fromdate = $_POST['formdate'];
    $todate = $_POST['todate'];
    
  $sql = "
SELECT * FROM aeps_transactions WHERE TRANS_TYPE = 'BE' AND FILTER_DATE BETWEEN '{$fromdate}' AND '{$todate}' ORDER BY ID DESC
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
                    <th>Transaction Id.</th>
                     <th>Status</th>
                    <th>Msg</th>
                    <th>Recipt</th>
                  </tr>
                  </thead>
                  <tbody>';
$i=1;
              while($row = mysqli_fetch_assoc($result)){
                  
             $user1 = $con->query("SELECT PARTNER_ID FROM user WHERE ID = '{$row["USER_ID"]}'")->fetch_assoc();
                    $st = explode("," , $row['STATUS']);
                $userdata .= "<tr>
                    <td>".$i++."</td>
                     <td>{$row['FILTER_DATE']}</td>
                    <td> {$row['TIMESTAMP']}</td>
                    <td>{$user1['PARTNER_ID']}</td>
                    <td>{$row['MOBILE']}</td>
                    <td>{$row['REFFRENCE_ID']}</td>
                     <td>{$st[0]}</td>
                    <td>{$st[1]}</td>
                    <td><a target='_blank' href='Recipt/AePsRecipt.php?refrence_id={$row['REFFRENCE_ID']}&type=BE'><i class='nav-icon fas fa-receipt'></i></a></td>
                    
                 </tr>";
              }
    $userdata .= " </tfoot>
                  
                </table>";
              

    echo $userdata;
}
    
    
    
     //-----admin DMT report-------//
    
    if(isset($_POST['pageid']) && $_POST['pageid'] == 2){
        
$i = 1;

 $fromdate = $_POST['formdate'];
    $todate = $_POST['todate'];

  $sql = "
SELECT * FROM dmt_transactions WHERE date(TIMESTAMP) BETWEEN '$fromdate' AND '$todate' ORDER BY ID DESC
";

$result = mysqli_query($con, $sql) or die("SQL Query Failed.");
$userdata = "";

  $userdata .= '<table id="example1" class="table table-bordered table-striped">
        
                  <thead>
                  <tr>
                    <th>Sr. No.</th>
                      <th>Name</th>
                      <th>Beneficiary Name</th>
                      <th>Date </th>
                    <th>Time </th>
                    <th>Account Number</th>
                    <th>utr</th>
                    <th>balance</th>
                    <th>customercharge</th>
                    <th>gst</th>
                    <th>tds</th>
                    <th>netcommission</th>
                    <th>Member Id.</th>
                    <th>Member Mobile No.</th>
                    <th>Transaction Id.</th>
                    <th>Transaction Amount</th>
                     <th>Status</th>
                    <th>Recipt</th>
                    <th>API</th>
                  </tr>
                  </thead>
                  <tbody>';

              while($row = mysqli_fetch_assoc($result)){
                  
             $user1 = $con->query("SELECT * FROM user WHERE ID = {$row['USER_ID']}")->fetch_assoc();
             $username=$user1['FIRST_NAME']." ".$user1['LAST_NAME'];
             $response=$row['RESPONSE'];
             $response_dec=json_decode($response,true);
             $respon_bene_name=$response_dec['benename'];
             
                    $st = explode("," , $row['STATUS']);
                $userdata .= "<tr>
                    <td>".$i++."</td>
                     <td>$username</td>
                     <td>$respon_bene_name</td>
                     <td>{$row['FILTER_DATE']}</td>
                    <td> {$row['TIMESTAMP']}</td>
                    <td> {$response_dec['account_number']}</td>
                    <td> {$response_dec['utr']}</td>
                    <td> {$response_dec['balance']}</td>
                    <td> {$response_dec['customercharge']}</td>
                    <td> {$response_dec['gst']}</td>
                    <td> {$response_dec['tds']}</td>
                    <td> {$response_dec['netcommission']}</td>
                    <td>{$user1['PARTNER_ID']}</td>
                    <td>{$row['MOBILE']}</td>
                    <td>{$row['REFFRENCE_ID']}</td>
                    <td>{$row['AMOUNT']}</td>
                      <td>{$st[0]}</td>
                    <td><a target='_blank' href='Recipt/DMTRecipt.php?refrence_id={$row['REFFRENCE_ID']}'><i class='nav-icon fas fa-receipt'></i></a></td>
                    <td>{$row['APINAME']}</td>
                    
                 </tr>";
              }
    $userdata .= " </tfoot>
                  
                </table>";
                
    echo $userdata;
}


//Recharge report code here........
    
    if(isset($_POST['pageid']) && $_POST['pageid'] == 4){
        
        $i = 1;

 $fromdate = $_POST['formdate'];
    $todate = $_POST['todate'];
    
 $sql = "
SELECT * FROM recharge_transaction WHERE SERVICE = 'Prepaid' AND FILTER_DATE BETWEEN '$fromdate' AND '{$todate}' ORDER BY ID DESC
";

$result = mysqli_query($con, $sql) or die("SQL Query Failed.");
$userdata = "";


  $userdata .= '<table id="example1" class="table table-bordered table-striped">
        
                  <thead>
                  <tr>
                       <th>SL No</th>
                        <th>Mobile</th>
                        <th>Operator</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Message</th>
                        <th>Refrence id</th>
                        <th>Operator id</th>
                          <th>Date </th>
                        <th>Time </th>
                        <th>Recipt</th>
                  </tr>
                  </thead>
                  <tbody>';

              while($row = mysqli_fetch_assoc($result)){
                    $op = explode(",", $row['OPERATOR']);
                    $st = explode(",", $row['STATUS']);
                $userdata .= "<tr>
                    <td>".$i++."</td>
                    <td>{$row['MOBILE']}</td>
                    <td>{$op[0]}</td>
                    <td>{$row['AMOUNT']}</td>
                    <td>{$st[0]}</td>
                    <td>{$st[1]}</td>
                    <td>{$row['REFERENCE_ID']}</td>
                    <td>{$row['OPERATOR_ID']}</td>
                     <td>{$row['FILTER_DATE']}</td>
                    <td> {$row['TIMESTAMP']}</td>
                    <td><a target='_blank' href='Recipt/RechargeRecipt.php?refrence_id={$row['REFERENCE_ID']}'><i class='nav-icon fas fa-receipt'></i></a></td>
                    
                 </tr>";
              }
    $userdata .= " </tfoot>
                  
                </table>";
                
    echo $userdata;
        
        
    }
    
//Recharge DTH report code here........
    
    if(isset($_POST['pageid']) && $_POST['pageid'] == 10){
        
        $i = 1;

 $fromdate = $_POST['formdate'];
    $todate = $_POST['todate'];
    
//  $sql = "SELECT * FROM recharge_transaction WHERE SERVICE = 'DTH' AND FILTER_DATE BETWEEN '{$fromdate}' AND '{$todate}' ORDER BY ID DESC";
 $sql = "SELECT * FROM recharge_transaction WHERE SERVICE = 'DTH' ORDER BY ID DESC";

$result = mysqli_query($con, $sql) or die("SQL Query Failed.");
$userdata = "";


  $userdata .= '<table id="example1" class="table table-bordered table-striped">
        
                  <thead>
                  <tr>
                        <th>SL No</th>
                        <th>Date</th>
                        <th>User</th>
                        <th>Transaction Details</th>
                        <th>Api</th>
                        <th>Status</th>
                        <th>Old Amount</th>
                        <th>Amount</th>
                        <th>New Amount </th>
                        <th>Recipt</th>
                  </tr>
                  </thead>
                  <tbody>';

              while($row = mysqli_fetch_assoc($result)){
                    $op = explode(",", $row['OPERATOR']);
                     $rc_id= $op['1'];
                     $opid = $op['0'];
                    $st = explode(",", $row['STATUS']);
                    $service_id= $row['SERVICE'];
                    $user_id = $row['USER_ID'];
                    $refid = $row['REFERENCE_ID'];
                    $user= $con->query("SELECT * FROM `user` WHERE ID='$user_id'")->fetch_assoc();
                    $service = $con->query("SELECT * FROM `service_manager` WHERE `ID`='10'")->fetch_assoc(); 
                    $report = $con->query("SELECT * FROM `report` WHERE `REFERENCE_ID`='$refid'")->fetch_assoc(); 
                    // $rechargeApi = $con->query("SELECT * FROM `rechargeApi` WHERE ID='$rc_id'")->fetch_assoc(); 
                    $all_service=$service['SERVICE'];
                    $mb = $row['MOBILE'];
                    $status = $row['STATUS'];
                    $opid = $op['0'];
                    $amount =$report['AMOUNT'];

                $userdata .= "<tr>
                    <td>".$i++."</td>
                    <td>{$row['TIMESTAMP']} {$row['FILTER_DATE']}</td>
                    <td>{$user['PARTNER_ID']} {$user['FIRST_NAME']} {$user['LAST_NAME']} {$user['MOBILE']}</td>
                    <td><span>Recharge - $mb ($all_service)</span> <span>Ref. No.:</span>'$refid '/' $opid $status {$report['DEVICE']} {$report['IP_ADDRESS']}</td>
                    <td>{$rc_id}</td>
                    <td>{$st['0']}</td>
                    <td>{$report['PREVIOUS_AMOUNT']}</td>
                    <td><span class='text'>$amount</span></td>
                    <td>{$report['AFTER_AMOUNT']}</td>
                    <td><a target='_blank' href='Recipt/RechargeRecipt.php?refrence_id={$row['REFERENCE_ID']}'><i class='nav-icon fas fa-receipt'></i></a></td>
                    
                 </tr>";
              }
    $userdata .= " </tfoot>
                  
                </table>";
                
    echo $userdata;
        
        
    }
    
    
     //X-DMT report code here
    
    if(isset($_POST['pageid']) && $_POST['pageid'] == 7){
 $i = 1;        

$fromdate = $_POST['formdate'];
    $todate = $_POST['todate'];

  $sql = "
SELECT * FROM xdmt_transactions WHERE date(TIMESTAMP) BETWEEN '{$fromdate}' AND '{$todate}' ORDER BY ID DESC
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
                    <th>Transaction Id.</th>
                    <th>Transaction Amount</th>
                    <th>Status</th>
                    <th>Recipt</th>
                  </tr>
                  </thead>
                  <tbody>';

              while($row = mysqli_fetch_assoc($result)){
                  
                   $user1 = $con->query("SELECT PARTNER_ID FROM user WHERE ID = {$row['USER_ID']}")->fetch_assoc();
                 
                $userdata .= "<tr>
                    <td>".$i++."</td>
                     <td>{$row['FILTER_DATE']}</td>
                    <td> {$row['TIMESTAMP']}</td>
                    <td>{$user1['PARTNER_ID']}</td>
                    <td>{$row['MOBILE']}</td>
                    <td>{$row['REFFRENCE_ID']}</td>
                    <td>{$row['AMOUNT']}</td>
                    <td>{$row['STATUS']}</td>
                    <td><a target='_blank' href='Recipt/DMTRecipt.php?refrence_id={$row['REFFRENCE_ID']}'><i class='nav-icon fas fa-receipt'></i></a></td>
                    
                 </tr>";
              }
    $userdata .= " </tfoot>
                  
                </table>";
                
             
    

    echo $userdata;
        
    }
    
    
    // Aeps Adhaarpay Report code here


if(isset($_POST['pageid']) && $_POST['pageid'] == 8){
  
  $fromdate = $_POST['formdate'];
    $todate = $_POST['todate'];
    
  $sql = "
SELECT * FROM aeps_transactions WHERE TRANS_TYPE = 'M' AND FILTER_DATE BETWEEN '{$fromdate}' AND '{$todate}' ORDER BY ID DESC
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
                    <th>Transaction Id.</th>
                    <th>Amount.</th>
                    <th>Status</th>
                    <th>Msg</th>
                    <th>Recipt</th>
                  </tr>
                  </thead>
                  <tbody>';
$i=1;
              while($row = mysqli_fetch_assoc($result)){
                  
             $user1 = $con->query("SELECT PARTNER_ID FROM user WHERE ID = '{$row["USER_ID"]}'")->fetch_assoc();
                    $st = explode("," , $row['STATUS']);
                $userdata .= "<tr>
                    <td>".$i++."</td>
                     <td>{$row['FILTER_DATE']}</td>
                    <td> {$row['TIMESTAMP']}</td>
                    <td>{$user1['PARTNER_ID']}</td>
                    <td>{$row['MOBILE']}</td>
                    <td>{$row['REFFRENCE_ID']}</td>
                    <td>{$row['AMOUNT']}</td>
                      <td>{$st[0]}</td>
                    <td>{$st[1]}</td>
                    <td><a target='_blank' href='Recipt/AePsRecipt.php?refrence_id={$row['REFFRENCE_ID']}&type=M'><i class='nav-icon fas fa-receipt'></i></a></td>
                    
                 </tr>";
              }
    $userdata .= " </tfoot>
                  
                </table>";
              

    echo $userdata;
}
    
    
    
    
    
?>