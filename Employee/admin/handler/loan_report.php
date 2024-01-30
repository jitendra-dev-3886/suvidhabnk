<?php
session_start();
require_once('../../Db/config.php');
require("../include/Auth.php");
date_default_timezone_set("Asia/Kolkata");

include("../Backend/Userinfo/getuserinfo.php");
include("../Backend/Functions/all_function.php");



$id = $_SESSION['UsId'];


if(isset($_POST['pageid']) && $_POST['pageid'] == 5){

 $i = 1;
   $fromdate = $_POST['formdate'];
    $todate = $_POST['todate'];

  $sql = "SELECT * FROM `loan_request` WHERE date(DATE) BETWEEN '{$fromdate}' AND '{$todate}'";

$result = mysqli_query($con, $sql) or die("SQL Query Failed.");
$userdata = "";


  $userdata .= '<table id="example1" class="table table-bordered table-striped">
        
                  <thead>
                  <tr>
                    <th>Sr. No.</th>
                    <th>Date</th>
                    <th>Member Id</th>
                    <th>Member Mobile No.</th>
                    <th>Loan Type</th>
                    <th>Customer Name</th>
                    <th>Mobile Number</th>
                    <th>View Details</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>';

              while($row = mysqli_fetch_assoc($result)){
                   $Us_id=$row['USER_ID'];
                   $loanid=$row['ID'];
                   $user_Data = $con->query("SELECT * FROM `user` WHERE ID='$Us_id'")->fetch_assoc();
  
                $userdata .= "<tr>
                    <td>".$i++."</td>
                    <td>{$row['DATE']}</td>
                    <td>{$user_Data['PARTNER_ID']}</td>
                    <td>{$user_Data['MOBILE']}</td>
                    <td>{$row['LOAN_TYPE']}</td>
                    <td>{$row['CUSTOMER_NAME']}</td>
                    <td>{$row['MOBILE_NO']}</td>
                    <td><span class='badge badge-info right' style='cursor:pointer;' id='mbtn' data-mid='{$loanid}'  data-toggle='modal' data-target='#myModal' data-dismiss='modal'>View Details</span></td>
                    <td>";
                    if($row["STATUS"] == 'Pending'){
                    $userdata .= "<span id='resbtn'><input type='button' class='btn-primary loan_cls' data-id='{$row['ID']}' data-loanamt='{$row['APPROVED_LOAN_AMT']}' data-rem='{$row['ADMIN_REMARK']}'  id='approvbtn' value='Approve' data-toggle='modal' data-target='#lmodal'/><input type='button' onclick='RejectLoan({$row['ID']})' class='btn-danger rejects' value='Reject'/></span>";
                    }else{
                         $userdata .= "<span id='resbtn'>{$row['STATUS']}</span>";
                    }
                   $userdata .= "</td>
                 </tr>";
              }
    $userdata .= " </tfoot>
                  
                </table>";
                
               
    echo $userdata;
}


if(isset($_POST['pageid']) && $_POST['pageid'] == 6){
    $fromdate = $_POST['formdate'];
    $todate = $_POST['todate'];

 $i = 1;
  

  $sql = "SELECT * FROM `loan_request` WHERE date(DATE) BETWEEN '$fromdate' AND '$todate' ORDER BY ID DESC"; 

$result = mysqli_query($con, $sql) or die("SQL Query Failed.");
$userdata = "";


  $userdata .= '<table id="example1" class="table table-bordered table-striped">
        
                  <thead>
                  <tr>
                    <th>Sr. No.</th>
                    <th>Date</th>
                    <th>Member Id</th>
                    <th>Member Mobile No.</th>
                    <th>Loan Type</th>
                    <th>Customer Name</th>
                    <th>Mobile Number</th>
                    <th>Status</th>
                    <th>Remark</th>
                    <th>View Details</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>';

              while($row = mysqli_fetch_assoc($result)){
                   $Us_id=$row['USER_ID'];
                   $loanid=$row['ID'];
                   $user_Data = $con->query("SELECT * FROM `user` WHERE ID='$Us_id'")->fetch_assoc();
  
                $userdata .= "<tr>
                    <td>".$i++."</td>
                    <td>{$row['DATE']}</td>
                    <td>{$user_Data['PARTNER_ID']}</td>
                    <td>{$user_Data['MOBILE']}</td>
                    <td>{$row['LOAN_TYPE']}</td>
                    <td>{$row['CUSTOMER_NAME']}</td>
                    <td>{$row['MOBILE_NO']}</td>
                    <td>{$row['STATUS']}</td>
                    <td>{$row['ADMIN_REMARK']}</td>
                    <td><span class='badge badge-info right' style='cursor:pointer;' id='mbtn' data-mid='{$loanid}'  data-toggle='modal' data-target='#myModal' data-dismiss='modal'>View Details</span></td>
                    <td>";
                    if($row["STATUS"] == 'Pending'){
                    $userdata .= "<span id='resbtn'><input type='button' class='btn-primary loan_cls' data-id='{$row['ID']}' data-loanamt='{$row['APPROVED_LOAN_AMT']}' data-rem='{$row['ADMIN_REMARK']}'  id='approvbtn' value='Approve' data-toggle='modal' data-target='#lmodal'/><input type='button' onclick='RejectLoan({$row['ID']})' class='btn-danger rejects' value='Reject'/></span>";
                    }else{
                         $userdata .= "<span id='resbtn'>{$row['STATUS']}</span>";
                    }
                   $userdata .= "</td>
                 </tr>";
              }
    $userdata .= " </tfoot>
                  
                </table>";
                
               
    echo $userdata;
}

if(isset($_POST['pageid']) && $_POST['pageid'] == 7){
      
             $status =$_POST['status'];
             $userid =$_POST['uid'];
             $adminrem =$_POST['adminrem'];
             $actiondate = date("d-m-Y h:i:s A");
             
            //  echo "UPDATE `loan_request` SET  `STATUS`='$status' , `ADMIN_REMARK`='$adminrem' WHERE ID='$userid'"; die();
             $query2 = $con->query("UPDATE `loan_request` SET  `STATUS`='$status' , `ADMIN_REMARK`='$adminrem',`ACTION_DATE`='$actiondate' WHERE ID='$userid'");
             if($query2){
              echo 1;
             }else{
                  echo 0;
              }
              
}

if(isset($_POST['type']) == 3){

             $userid =$_POST['id'];
             $loan_amt =$_POST['loanAmt'];
             $rem=$_POST['remarks'];
             
             $rtcomm =$_POST['rt_comm'];
             $dtcomm =$_POST['dt_comm'];
             
             $image2 = $_FILES['insdoc'];
             $insdoc = $image2['name'];
             $img_tmp2 = $image2['tmp_name'];
             $dist = "../assets/loan_document/".$insdoc;
              $actiondate = date("d-m-Y h:i:s A");
             
             $txn = $con->query("select * from loan_request where ID='$userid'")->fetch_assoc();
             
          $query2 = $con->query("UPDATE `loan_request` SET  `APPROVED_LOAN_AMT`='$loan_amt',`ADMIN_REMARK`='$rem',`ACTION_DATE`='$actiondate',`STATUS`='Approved',`RECIPT`='$insdoc'  WHERE ID='$userid'");
             
             if($query2){
                 
               move_uploaded_file($img_tmp2,$dist);
              
             $usdt = $con->query("select * from user where ID='".$txn['USER_ID']."' ")->fetch_assoc();
             $usupdtbal = $usdt['MAIN_BAL'] + $rtcomm;
             $con->query("update user set MAIN_BAL='$usupdtbal' where ID='".$txn['USER_ID']."'");
              insert_allreport($txn['USER_ID']  , "LOAN".$userid , "LOAN Approved" , $usdt['MAIN_BAL']  , $usupdtbal , $rtcomm , "Credit" , "LOAN Transaction", "MAIN");
                 $ds_id = $usdt['OWNER_ID'];
                $ds_data =  $con->query("select * from user  where ID='$ds_id' and USER_TYPE='47'")->fetch_assoc();
             $usupdtbal = $ds_data['MAIN_BAL'] + $dtcomm;
             $con->query("update user set MAIN_BAL='$usupdtbal' where ID='$ds_id'");
              insert_allreport($ds_id  , "LOAN".$userid , "LOAN Approved" ,  $ds_data['MAIN_BAL']  , $usupdtbal , $dtcomm , "Credit" , "LOAN Transaction", "MAIN");
              echo 1;
             }else{
                  echo 0;
              }
}



if(isset($_POST['pageid']) && $_POST['pageid'] == 9){
$mid =$_POST['mid'];

$rows = $con->query("SELECT * FROM `loan_request` WHERE ID='$mid'")->fetch_assoc();

$userdata = '';
    
$userdata .="

<div class='row'>
                <div class='col-12'>
                    <div class='form-row'>
                        <div class='form-group col-md-4'>
                          <label for='inputEmail4'>Profession : {$rows['PROFESSION']} </label>
                        </div>
                        <div class='form-group col-md-4'>
                          <label for='inputEmail4'> Income : {$rows['INCOME']} </label>
                        </div>
                        <div class='form-group col-md-4'>
                          <label for='inputEmail4'>Required Loan : {$rows['REQUIRE_LOAN']}</label>
                       </div>
                    </div>
                </div>
                 <div class='col-12'>
                    <div class='form-row'>
                      <div class='form-group col-md-4'>
                         <label for='inputEmail4'>Approved Loan Ammount : {$rows['APPROVED_LOAN_AMT']}</label>
                      </div>
                       <div class='form-group col-md-4'>
                         <label for='inputEmail4'>Aadhar Card Front : <a download target ='_blank' href='/Agent/dist/img/Loan_Img/{$rows['AADHAR_CARD_FRONT']}'>Download</a></label>
                      </div>
                      <div class='form-group col-md-4'>
                         <label for='inputEmail4'>Aadhar Card Back : <a download target ='_blank' href='/Agent/dist/img/Loan_Img/{$rows['AADHAR_CARD_BACK']}'>Download</a></label>
                      </div>
                     </div> 
                 </div>
                 
                    <div class='col-12'>
                      <div class='form-row'>
                     
                      </div> 
                   </div>
                    <div class='col-12'>
                      <div class='form-row'>
                       <div class='form-group col-md-4'>
                          <label for='inputEmail4'>Pan : <a download target ='_blank' href='/Agent/dist/img/Loan_Img/{$rows['PAN_CARD']}'>Download</a></label>
                    </div>
                    <div class='form-group col-md-4'>
                        <label for='inputEmail4'>Salary Slip : <a download target ='_blank' href='/Agent/dist/img/Loan_Img/{$rows['SALARY_SLIP']}'>Download</a></label>
                    </div>
                     <div class='form-group col-md-4'>
                        <label for='inputEmail4'>BANK_STATEMENT : <a download target ='_blank' href='/Agent/dist/img/Loan_Img/{$rows['BANK_STATEMENT']}'>Download</a></label>
                      </div>
                      </div> 
                   </div>
                    <div class='col-12'>
                      <div class='form-row'>
                       <div class='form-group col-md-4'>
                          <label for='inputEmail4'>ITR : <a download target ='_blank' href='/Agent/dist/img/Loan_Img/{$rows['ITR']}'>Download</a></label>
                       </div>
                      <div class='form-group col-md-4'>
                        <label for='inputEmail4'>Request Date : {$rows['REQUEST_DATE']}</label>
                      </div>
                     <div class='form-group col-md-4'>
                        <label for='inputEmail4'>Status : {$rows['STATUS']}</label>
                      </div>
                      
                      </div> 
                   </div>";
  $userdata .= "</div>";
  
   
    echo $userdata;
}

  ?>