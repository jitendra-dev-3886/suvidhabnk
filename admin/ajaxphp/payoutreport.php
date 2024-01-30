<?php

session_start();
require_once('../../Db/config.php');

 //-----admin Payout report-------//

    if(isset($_POST['pageid']) && $_POST['pageid'] == 3){
        $i = 1;
        
    $fromdate = $_POST['formdate'];
    $todate = $_POST['todate'];
    
 $sql = "
SELECT * FROM payout_transaction WHERE FILTER_DATE BETWEEN '{$fromdate}' AND '{$todate}' ORDER BY ID DESC
";
  
$result = mysqli_query($con, $sql) or die("SQL Query Failed.");
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
                    <th>Reciept</th>
                  </tr>
                  </thead>
                  <tbody>';

              while($row = mysqli_fetch_assoc($result)){
                  
             $user1 = $con->query("SELECT PARTNER_ID,MOBILE FROM user WHERE ID = '{$row["USER_ID"]}' ")->fetch_assoc();
                  
                $userdata .= "<tr>
                    <td>".$i++."</td>
                    <td>{$row['FILTER_DATE']} {$row['TIMESTAMP']}</td>
                    <td>{$user1['PARTNER_ID']}</td>
                    <td>{$user1['MOBILE']}</td>
                    <td>{$row['REFFRENCE_ID']}</td>
                    <td>{$row['AMOUNT']}</td>
                    <td>{$row['STATUS']}</td>
                   <td><a target='_blank' href='Recipt/PayoutRecipt.php?refrence_id={$row['REFFRENCE_ID']}'><i class='nav-icon fas fa-receipt'></i></a></td>
                    
                 </tr>";
              }
    $userdata .= " </tfoot>
                  
                </table>";
                

    echo $userdata;
    }
    

    
 if(isset($_POST['pageid']) && $_POST['pageid'] = 4){
     $fromdate = $_POST['formdate'];
    $todate = $_POST['todate'];
    
    $i = 1;
   $type = $_POST["type"];
  
  $sql = "SELECT * FROM special_payout_transaction  ORDER BY id DESC";


$result = mysqli_query($con, $sql) or die("SQL Query Failed.");
$userdata = "";


  $userdata .= '<table id="example" class="table table-bordered table-striped">
        
                  <thead>
                  <tr>
                        <th>Sr. No.</th>
                        <th>Date and Time</th>
                        <th>Member Id.</th>
                        <th>Member Mobile No.</th>
                        <th>Full Name</th>
                        <th>Account</th>
                        <th>IFSC</th>
                        <th>Amount</th>
                        <th>Transaction id</th> 
                        <th>Status</th> 
                        <th>UTR</th> 
                        <th>TimeStamp</th>
                        <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>';

              while($row = mysqli_fetch_assoc($result)){
                $us_id = $row['user_id'];
                  $user = $con->query("SELECT * FROM `user` Where ID='$us_id'")->fetch_assoc();
                   $pusers = $con->query("select * from `special_payout` where user_id='$us_id' order by ID desc")->fetch_assoc();
                    $bankName = $pusers['bankName'];
                    $accNumber = $pusers['acc'];
                    $ifsc = $pusers['ifsc'];
                    
                $userdata .= "<tr>
                    <td>".$i++."</td>
                    <td>{$row['trans_date']} {$row['trans_time']}</td>
                    <td>{$user['PARTNER_ID']}</td>
                    <td>{$user['MOBILE']}</td>
                    <td>{$bankName}</td>
                    <td>{$accNumber}</td>
                    <td>{$ifsc}</td>
                    <td>{$row['amount']}</td>
                    <td>{$row['transaction_id']}</td>
                    <td>{$row['status']}</td>
                    <td>{$row['utr']}</td>
                    <td>{$row['trans_date']} - {$row['trans_time']}</td>
                    <td>{$row['action_date']}</td>

                 </tr>";
              }
    $userdata .= " </tfoot>
                  
                </table>";
                
              
    echo $userdata;
        
        
    }

    
if(isset($_POST['pageid']) && $_POST['pageid'] == 5){
         $fromdate = $_POST['formdate'];
        $todate = $_POST['todate'];
        
        $i = 1;
       $type = $_POST["type"];
  
  $sql = "SELECT * FROM special_payout_transaction  ORDER BY id DESC";


$result = mysqli_query($con, $sql) or die("SQL Query Failed.");
$userdata = "";


  $userdata .= '<table id="example" class="table table-bordered table-striped">
        
                  <thead>
                  <tr>
                        <th>Sr. No.</th>
                        <th>Date and Time</th>
                        <th>Member Id.</th>
                        <th>Member Mobile No.</th>
                        <th>Full Name</th>
                        <th>Account</th>
                        <th>IFSC</th>
                        <th>Amount</th>
                        <th>Transaction id</th> 
                        <th>Status</th> 
                        <th>UTR</th> 
                        <th>TimeStamp</th>
                        <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>';

              while($row = mysqli_fetch_assoc($result)){
                $us_id = $row['user_id'];
                  $user = $con->query("SELECT * FROM `user` Where ID='$us_id'")->fetch_assoc();
                   $pusers = $con->query("select * from `special_payout` where user_id='$us_id' order by ID desc")->fetch_assoc();
                    $bankName = $pusers['bankName'];
                    $accNumber = $pusers['acc'];
                    $ifsc = $pusers['ifsc'];
                    
                $userdata .= "<tr>
                    <td>".$i++."</td>
                    <td>{$row['trans_date']} {$row['trans_time']}</td>
                    <td>{$user['PARTNER_ID']}</td>
                    <td>{$user['MOBILE']}</td>
                    <td>{$bankName}</td>
                    <td>{$accNumber}</td>
                    <td>{$ifsc}</td>
                    <td>{$row['amount']}</td>
                    <td>{$row['transaction_id']}</td>
                    <td>{$row['status']}</td>
                    <td>{$row['utr']}</td>
                    <td>{$row['trans_date']} - {$row['trans_time']}</td>
                    <td>{$row['action_date']}</td>

                 </tr>";
              }
    $userdata .= " </tfoot>
                  
                </table>";
                
              
    echo $userdata;
        
        
    }
    
    
if(isset($_POST['pageidd']) && $_POST['pageidd'] == 6){
         $fromdate = $_POST['formdate'];
        $todate = $_POST['todate'];
        
        $i = 1;
       $type = $_POST["type"];
  
  $sql = "SELECT * FROM special_payout_transaction  ORDER BY id DESC";


$result = mysqli_query($con, $sql) or die("SQL Query Failed.");
$userdata = "";


  $userdata .= '<table id="example" class="table table-bordered table-striped">
        
                  <thead>
                  <tr>
                        <th>Sr. No.</th>
                        <th>Date and Time</th>
                        <th>Member Id.</th>
                        <th>Member Mobile No.</th>
                        <th>Full Name</th>
                        <th>Account</th>
                        <th>IFSC</th>
                        <th>Amount</th>
                        <th>Transaction id</th> 
                        <th>Status</th> 
                        <th>UTR</th> 
                        <th>TimeStamp</th>
                        <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>';

              while($row = mysqli_fetch_assoc($result)){
                $us_id = $row['user_id'];
                  $user = $con->query("SELECT * FROM `user` Where ID='$us_id'")->fetch_assoc();
                   $pusers = $con->query("select * from `special_payout` where user_id='$us_id' order by ID desc")->fetch_assoc();
                    $bankName = $pusers['bankName'];
                    $accNumber = $pusers['acc'];
                    $ifsc = $pusers['ifsc'];
                    
                $userdata .= "<tr>
                    <td>".$i++."</td>
                    <td>{$row['trans_date']} {$row['trans_time']}</td>
                    <td>{$user['PARTNER_ID']}</td>
                    <td>{$user['MOBILE']}</td>
                    <td>{$bankName}</td>
                    <td>{$accNumber}</td>
                    <td>{$ifsc}</td>
                    <td>{$row['amount']}</td>
                    <td>{$row['transaction_id']}</td>
                    <td>{$row['status']}</td>
                    <td>{$row['utr_no']}</td>
                    <td>{$row['trans_date']} - {$row['trans_time']}</td>
                    <td><button type='button' data-cid='{$row['id']}' class='btn btn-primary remark' data-toggle='modal' data-target='#exampleModal'>
  EDIT
</button></a></td>

                 </tr>";
              }
    $userdata .= " </tfoot>
                  
                </table>";
                
              
    echo $userdata;
        
        
    };

if (isset($_POST['pageidd'])&& ($_POST['pageidd']==301)){
    $xid =$_POST['xid'];
    
    $output = "";
    
    $output .= "
            <div id='edit_modal'>
            <form  id='edit_modal'>
            <div class='form-group col-md-12'>
            <input type='hidden' id='update_id' value='$xid'>
       
            <div class='form-group col-md-12'>
                 <input name='comment' id='comment' placeholder='write upto dated utr'>
            </div>
            
            <div class='modal-footer'>
                <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
                <button type='button' class='btn btn-primary update1' id='update1' data-dismiss='modal'>Save changes</button>
            </div>
            </form>
            </div>";

        echo $output;
};


if(isset($_POST['pageidd']) && $_POST['pageidd']==1046){
    $pid=$_POST['up_id'];
    $pcomment=$_POST['comment'];
    $smg = "Processing Success";
    $sql = $con->query("UPDATE special_payout_transaction SET utr_no='$pcomment',status='$smg' WHERE id='$pid'");
    //echo "UPDATE special_payout_transaction SET utr_no='$pcomment' WHERE id='$pid'";
    if($sql){
        echo 1;
    }else{
        echo 0;
    }
}

?>