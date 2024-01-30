<?php
session_start();
include("../Db/config.php");
require("include/Auth.php"); // user auth
include("Backend/Functions/all_function.php"); // for create token
include("handler/function.php");
include("Functions/all_function.php"); // create token
include("Backend/DMT/paysprint/dmt_function.php"); // dmt use
$status = "DMT";
// echo fetch_bene(filterThis($_GET['Mobile']));
// exit;
// error_reporting(E_ALL);
// ini_set("display_errors" , 1);

$row = $con->query("SELECT * FROM `websetting`")->fetch_assoc();

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title> DMT </title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  
  
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.css">
  
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
      #otp_area,#submit_btn_area,#name_area,#pin_area,#add_area {
            display: none;
        }
        
        
</style>
</head>

<body class="hold-transition light-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
          <div id="loading_ajax" style="width: 100%;height: 130%;position: absolute;top: 0;left: 0;background: #00000038; background-attachment:fixed; z-index: 22222;display: none;"></div>
   
<div class="wrapper">

  <!-- Preloader -->
  <?php
    include("include/preloader.php");
  ?>

  <!-- Navbar -->
   <?php
    include("include/NavBar.php");
  ?>
  <!-- /.navbar -->

 <?php
    include("include/SideBar.php");
 ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Domestic Money Transfer</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Domestic Money Transfer</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
        <section class="content">
       <div class="pcoded-inner-content">
                            <!-- Main-body start -->
                            <div class="main-body">
                                <div class="page-wrapper">
                                     <!-- Page body start -->
                                    <div class="page-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                    <?php
                                                    // $user_exist = check_user($id , $usertype_id);
                                                    // echo $user_exist;
                                                if(!isset($_GET['Mobile'])){
                                                        ?>
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h5>Send Cash</h5>
                                                    </div>
                                                            <h3 class='mx-auto text-center mt-5 text-capitalize'>Register New User</h3>                
                                                            <div class="card-block my-3">
                                                                        <form class="form-material" id="dmt_form" method="post">
                                                                            <div class="form-row d-flex justify-content-around">
                                                                              <div class="form-group form-primary col-md-3 " id="mobile_area">
                                                                                <input type="number" name="mobile" id="mobile" value="" class="form-control">
                                                                                <span class="form-bar"></span>
                                                                                <label class="float-label">Mobile</label>
                                                                               </div>
                                                                              <div class="form-group form-primary col-md-3 "  style="display:none" id="f_area">
                                                                                <input type="text" name="fname" id="fname" value="" class="form-control">
                                                                                <span class="form-bar"></span>
                                                                                <label class="float-label">First Name</label>
                                                                              </div>
                                                                            <div class="form-group form-primary col-md-3 "  style="display:none" id="l_area">
                                                                                <input type="text"  name="lname" id="lname" value="" class="form-control">
                                                                                <span class="form-bar"></span>
                                                                                <label class="float-label">Last Name</label>
                                                                            </div>
                                                                            <div class="form-group form-primary col-md-3 d-none"  style="display:none" id="pin_area">
                                                                               <input type="hidden" name="pincode" required id="pincode" value="143149" class="form-control">
                                                                                <span class="form-bar"></span>
                                                                                <label class="float-label">Pincode</label>
                                                                            </div>
                                                                            <div class="form-group form-primary col-md-3 d-none"  style="display:none" id="address_area">
                                                                               <input type="hidden" name="Address" required id="Address" value="Postmaster, Post Office TANGRA (BRANCH OFFICE), AMRITSAR, PUNJAB (PB), India" class="form-control">
                                                                                <span class="form-bar"></span>
                                                                                <label class="float-label">Address</label>
                                                                            </div>
                                                                            <div class="form-group form-primary col-md-3 d-none"  style="display:none" id="dob_area">
                                                                                <input type="hidden" name="dob" id="dob" required="" value="02-01-1990" class="form-control">
                                                                                <span class="form-bar"></span>
                                                                                <label class="float-label">Enter Date of Birth</label>
                                                                            </div>
                                                                            <div class="form-group form-primary col-md-3 " style="display:none" id="otp_area">
                                                                                <input type="number" name="otp" id="otp" required class="form-control">
                                                                                <span class="form-bar"></span>
                                                                                <label class="float-label">Enter OTP</label>
                                                                            </div>
                                                                        </div>
                                                                        <input type="hidden" id="str_code" name="str">
                                                                            <div class="form-row mt-4 d-flex justify-content-center">
                                                                                   <div style="display:none" class="form-group form-primary col-md-3" id="resendOtp">
                                                                                        <button type="button" class="btn waves-effect waves-light btn-primary btn-block btn-outline-primary"><i class="ti-mobile"></i>Resend OTP</button>
                                                                                    </div>
                                                                                    
                                                                                <div class="col-md-3" id="submit_btn_area" style="display:none">
                                                                                    <button type="button" id="register_user" class="btn waves-effect waves-light btn-primary btn-block btn-outline-primary" style="color:#fff"><i class="ti-mobile"></i>Register Now</button>
                                                                                </div>
                                                                                <div class="col-md-4" id="send_otp_area">
                                                                                    <button type="button" name="send_otp_btn" id="send_otp_btn" class="btn waves-effect waves-light btn-primary btn-block btn-outline-primary" style="color:#fff"><i class="far fa-paper-plane"></i>Send OTP</button>
                                                                                </div>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                        </div>
                                                        
                                                        <?php 
                                                    }else{
                                                        $remit = json_decode(getRemit($_GET['Mobile']) , true);
                                                        if($remit['data']['bank1_limit'] != 0){
                                                            $limit = $remit['data']['bank1_limit'];
                                                        }
                                                        else if($remit['data']['bank2_limit'] != 0){
                                                            $limit = $remit['data']['bank2_limit'];
                                                        }
                                                        else if($remit['data']['bank3_limit'] != 0){
                                                            $limit = $remit['data']['bank3_limit'];
                                                        }
                                                    ?>
                                                <!-- Cheaked Your Table -->
                                                <style>
                                                    .btn{
                                                        color:#fff;
                                                    }
                                                </style>
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h5>Beneficiary List</h5> <?php echo $_GET['Mobile'] ?>
                                                          <div class="col-md-4 mr-3" style="float:right;">
                                                                    <button type="submit" data-toggle="modal" data-target="#exampleModalCenter" name="add_user_type" class="btn waves-effect waves-light btn-primary btn-block btn-outline-primary"><i class="far fa-paper-plane"></i>Add Beneficiary</button>
                                                            </div>
                                                        <span> Sender Limit   <?php echo $limit; ?> </span>
                                                        <span>      </span>
                                                          
                                                    </div>
                                                    <div class="card-block table-border-style">
                                                        <div class="table-responsive">
                                                            <table class="table table-striped" id="example" class="display" style="width:100%">
                                                              <thead>
                                                                <tr>
                                                                   <th>S.No</th>
                                                                    <th>Bene ID</th>
                                                                    <th>Bank</th>
                                                                    <th>Bene Name</th>
                                                                    <th>Account NO</th>
                                                                    <th>IFSC Code</th>
                                                                    <th>Delete</th>
                                                                    <th>Verify</th>
                                                                    <th>Send</th>
                                                                </tr>
                                                              </thead>
                                                              <tbody>
                                                                  <?php
                                                                  
                                                                  $bene_rsponse = json_decode(fetch_bene(filterThis($_GET['Mobile'])));
                                                                  $bene_rs_code = $bene_rsponse->response_code;
                                                                  $bene_msg = $bene_rsponse->message;
                                                                  $data = $bene_rsponse->data;
                                                                  if($data != ""){
                                                                      $i=1;
                                                                  foreach($data as $bene_details){
                                                                      $accountno = $bene_details->accno;
                                                                      $fetchdmtbene = $con->query("SELECT * FROM `dmt_beneficiary` WHERE ACCOUNT = '$accountno'")->fetch_assoc();
                                                                      
                                                                      
                                                                      ?>
                                                                      <tr>
                                                                        <td><?php echo $i++ ?></td>
                                                                        <td><?php echo $bene_details->bene_id ?></td>
                                                                        <td><?php echo $bene_details->bankname ?></td>
                                                                        <td><?php echo $bene_details->name ?></td>
                                                                        <td><?php echo $bene_details->accno ?></td>
                                                                        <td><?php echo $bene_details->ifsc ?></td>
                                                                        <td><a onclick="delete_bene(<?php echo $bene_details->bene_id ?> , '<?php echo $bene_details->accno ?>' , <?php echo filterThis($_GET['Mobile'])?>)" href="#">Delete</a></td>
                                                                        <td>
                                                                            <?php
                                                                            if($fetchdmtbene["VERIFY_RESPONSE"] != ""){
                                                                                echo '<a><i class="fas fa-check"></i></a> Verified';
                                                                            }else{
                                                                            ?>
                                                                            <button type="button" onclick="verify_bene('<?php echo $bene_details->bene_id ?>' ,'<?php echo $bene_details->bankid ?>' ,'<?php echo $bene_details->name ?>' , '<?php echo $bene_details->accno ?>' , '<?php echo filterThis($_GET['Mobile'])?>')" class="btn waves-effect waves-light btn-primary btn-block btn-outline-primary"><i class="far fa-paper-plane"></i>Verify Bene</button>
                                                                            <?php } ?>
                                                                            </td>
                                                                            
                                                                        <td><button type="button" onclick="send_amount(<?php echo $bene_details->bene_id ?> , '<?php echo $bene_details->accno ?>' )" data-toggle="modal" data-target="#exampleModalCenter2" class="btn waves-effect waves-light btn-primary btn-block btn-outline-primary"><i class="far fa-paper-plane"></i>Send Amount</button>
                                                                      </td></tr>
                                                                      <?php
                                                                  } }else{
                                                                      echo "No data ";
                                                                  }
                                                                  ?>
                                                                  <!--<script>ale/rt('Remitter record not found.')</script>                -->
                                                             </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>

                                             <!-- Add Benificary-->
                                                <div class="modal fade" id="exampleModalCenter" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                  <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                      <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLongTitle">Add Beneficiary</h5>
                                                      </div>
                                                      
                                                        <form class="form-material" id="add_bene_form" method="post">
                                                      
                                                      <div class="modal-body">
                                                        <div class="form-row d-flex justify-content-around">
                                                            <div class="form-group form-primary col-md-6">
                                                                <input type="text" required name="bene_name" class="form-control">
                                                                <span class="form-bar"></span>
                                                                <label class="float-label">Full Name</label>
                                                            </div>
                                                                 <input type='hidden' name="senderMobile" value="<?php echo filterThis($_GET['Mobile']) ?>">
                                                            <div class="form-group form-primary col-md-6">
                                                                <input type="number"required name="bene_acc" class="form-control" onkeypress="return this.value.length < 18;" oninput="if(this.value.length>=18) { this.value = this.value.slice(0,18); }">
                                                                <span class="form-bar"></span>
                                                                <label class="float-label">Account Number</label>
                                                            </div>
                                                         </div>
                                                         
                                                        <div class="form-row d-flex justify-content-around">
                                                           <div class="form-group form-primary col-md-6">
                                                                <select name="bene_bank" required class="form-control fill">
                                                                    <option value="">Select Bank</option>
                                                                    <?php
                                                                    $list_sql = $con->query("select * from paysprint_bank_list order by BANK_NAME ASC");
                                                                    while($list_row = $list_sql->fetch_assoc()){
                                                                    echo "<option value='".$list_row['BANKID']."'>".$list_row['BANK_NAME']."</option>";
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                                <div class="form-group form-primary col-md-6">
                                                                    <input type="text" required name="bene_ifsc"  id="bene_ifsc"  class="form-control" onkeypress="return this.value.length < 11;" oninput="if(this.value.length>=11) { this.value = this.value.slice(0,11); }">
                                                                    <span class="form-bar"></span>
                                                                    <label class="float-label">IFSC Code</label>
                                                                </div>
                                                         </div>
                                                          <!--<div class="form-row d-flex justify-content-around">-->
                                                                <div class="form-row form-primary col-md-6">
                                                                    <input type="checkbox" name="verifybene"  id="verifybene" value="verifybene"  class="form-control col-1">
                                                                    <label class="pt-2 pl-1">Verify Bene</label>
                                                                </div>
                                                         <!--</div>-->
                                                         <input type="hidden" name="sendermobile" id="sendermobile" value="<?php echo filterThis($_GET['Mobile'])?>">
                                                      </div>
                                                      <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Add</button>
                                                      </div>
                                                      </form>
                                                    </div>
                                                  </div>
                                                </div>
                                             
                                             
                                             
                                             <!-- Send Amount-->
                                                <div class="modal fade" id="exampleModalCenter2" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                  <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                      <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLongTitle2">Send Amount</h5>
                                                      </div>
                                                      
                                                        <form class="form-material" id="send_amount_form" method="post">
                                                      <input type="hidden" name="bankname" id="bankname" value="<?php echo $_GET["bankname"] ?>">
                                                      <div class="modal-body">
                                                        <div class="form-row d-flex justify-content-around">
                                                            <div class="form-group form-primary col-md-6">
                                                                <input type="number" readonly required name="send_am_acc" id="send_account" class="form-control fill">
                                                                <span class="form-bar"></span>
                                                                <label class="float-label">Account Number</label>
                                                            </div>
                                                            <div class="form-group form-primary col-md-6">
                                                                <input type="text" required name="send_amount" id="send_amount" class="form-control">
                                                                <span class="form-bar"></span>
                                                                <label class="float-label">Amount</label>
                                                            </div>
                                                            <input type="hidden" name="bene_id" id="send_bene_id">
                                                            <input type="hidden" name="otpSendTime" id="otpSendTime" value="0">
                                                            <input type="hidden" name="smhash_code" id="hash_code">
                                                         </div>
                                                      </div>
                                                       <input type='hidden' name="senderMobile" value="<?php echo filterThis($_GET['Mobile']) ?>">
                                                        <div class="form-row d-flex justify-content-around">
                                                             <div class="form-group form-primary col-md-6">
                                                                <select name="txn_type" required class="form-control fill">
                                                                    <option value="" disabled selected>Txn. Type</option>
                                                                    <option value="IMPS">IMPS</option>
                                                                    <option value="NEFT">NEFT</option>
                                                                </select>
                                                            </div>
                                                               <div class="form-group form-primary col-md-6">
                                                                    <input type="password" required name="tpin" class="form-control">
                                                                    <span class="form-bar"></span>
                                                                    <label class="float-label">Enter TPin</label>
                                                                </div>
                                                          <div class="row" style="display:none;" id="amOtpArea">
                                                               <!--<div class="form-group col-12">                           -->
                                                               <!-- <label for="">Agent OTP</label>-->
                                                               <!--  <input type="number" class="form-control" name="agentOTP" id="agentOTP" placeholder="Agent OTP" onkeypress="return this.value.length < 6;" oninput="if(this.value.length>=6) { this.value = this.value.slice(0,6); }">-->
                                                               <!--</div>-->
                                                            <!--<button type="button" onclick="sendotp()" id="resendotp" class="btn btn-primary">Resend OTP</button>-->
                                                          </div>
                                                         </div>
                                                      <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                        <!--<button type="button" onclick="sendotp()" id="sendotparea" class="btn btn-primary">Send OTP</button>-->
                                                        <button type="submit" style="" id="submitBtn"  class="btn btn-primary" >Send Now</button>
                                                      </div>
                                                      </form>
                                                    </div>
                                                  </div>
                                                </div>
                                                
                                                <style>
                                                    .modal-header {
                                                        text-align: center;
                                                        display: block;
                                                    }
                                                    .modal-footer {
                                                        display: flex;
                                                        justify-content: center;
                                                    }
                                                </style>
                                                <!-- End Benificary-->
                                                
                                        <!--Service table-->
                                                <?php } ?>
                                                
                                                
                                                <!-- Service Table -->
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h5>Last 10 Transaction List</h5>
                                                        <span>My last 10 transaction</span>
                                                        <div class="card-header-right">
                                                            <!--<ul class="list-unstyled card-option">-->
                                                            <!--    <li><i class="fa fa fa-wrench open-card-option"></i></li>-->
                                                            <!--    <li><i class="fa fa-window-maximize full-card"></i></li>-->
                                                            <!--    <li><i class="fa fa-minus minimize-card"></i></li>-->
                                                            <!--    <li><i class="fa fa-refresh reload-card"></i></li>-->
                                                            <!--    <li><i class="fa fa-trash close-card"></i></li>-->
                                                            <!--</ul>-->
                                                             <?php
                                                                     $dmt_row = $con->query("select * from dmt_transactions where USER_ID='$id' and USER_TYPE='$usertype_id'  order by ID Desc")->fetch_assoc();
                                                                      $dt = json_decode($dmt_row['RESPONSE'],true);
                                                                        if($dt['response_code'] == 1){
                                                                            ?>
                                                                             <td><h6 class="text-primary">Not Refund</h6></td>
                                                                            
                                                                       <?php }else{
                                                                           ?>
                                                                             <button type ='button' onclick="refundTrans('<?php echo $dmt_row['REFFRENCE_ID'] ?>' , '<?php echo $dt->ackno ?>')" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter3" style='float: right;'>Refund</button>

                                                                      <?php }
                                                                     ?>
                                                              
 
                                                        </div>
                                                    </div>
                                                    <div class="card-block table-border-style">
                                                        <div class="table-responsive">
                                                            <table class="table table-striped" id="example" class="display" style="width:100%">
                                                              <thead>
                                                                <tr>
                                                                    <th>SL No</th>
                                                                    <th>Bene Id</th>
                                                                    <th>Account</th>
                                                                    <th>Amount</th>
                                                                    <th>Status</th>
                                                                    <!--<th>Message</th>-->
                                                                    <!--<th>Refference</th>-->
                                                                    <!--<th>Deduct</th>-->
                                                                    <th>Refrence id</th>
                                                                    <th>TimeStamp</th>
                                                                    <th>Refund</th>
                                                                    <th>Update Status</th>
                                                                </tr>
                                                              </thead>
                                                              <tbody> 
                                                              <?php
                                                                  $dmt_trans_q = $con->query("select * from dmt_transactions where USER_ID='$usid' order by ID Desc limit 10");
                                                                  while($dmt_row = $dmt_trans_q->fetch_assoc()){
                                                                  ?>
                                                                <tr>
                                                                    <td>1</td>
                                                                    <td><?php echo $dmt_row['BENE_ID'] ?></td>
                                                                    <td><?php echo $dmt_row['ACCOUNT'] ?></td>
                                                                    <td><?php echo $dmt_row['AMOUNT'] ?></td>
                                                                    <td><?php echo $dmt_row['STATUS'] ?></td>
                                                                    <?php
                                                                    $dt = json_decode($dmt_row['RESPONSE'],true);
                                                                    ?>
                                                                    <!--<td class='txn_msg'><?php // echo $dt->message?></td>-->
                                                                    <td><?php echo $dmt_row['REFFRENCE_ID'] ?></td>
                                                                    <td><?php echo $dmt_row['TIMESTAMP'] ?></td>
                                                                   <!-- <td>6289195314</td>-->
                                                                   <!-- <td>20</td>-->
                                                                   <!-- <td>Success</td>-->
                                                                   <!--<td>Your commission is not set.</td>-->
                                                                   <!-- <td>2</td>-->
                                                                   <!-- <td>18</td>-->
                                                                   <!-- <td>220</td>-->
                                                                   <!-- <td>sdfvsdfv</td>-->
                                                                   <!-- <td>20-08-2020</td>-->
                                                                     <?php
                                                                        if($dt['response_code'] == 1){
                                                                            ?>
                                                                             <td>Not Refund</td>
                                                                            
                                                                       <?php }else{
                                                                           ?>
                                                                             <td onclick="refundTrans('<?php echo $dmt_row['REFFRENCE_ID'] ?>' , '<?php echo $dt->ackno ?>')"  data-toggle="modal" data-target="#exampleModalCenter3">Refund </td>
                                                                           
                                                                           
                                                                      <?php }
                                                                     ?>
                                                                    <td onclick="check_dmt_status('<?php echo $dmt_row['REFFRENCE_ID'] ?>')">Check Status</td>
                                                               </tr>
                                                               <?php } ?>
                                                            </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    

                                             <!-- Refund transaction-->
                                                <div class="modal fade" id="exampleModalCenter3" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle3" aria-hidden="true">
                                                  <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                      <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLongTitle3">Add Beneficiary</h5>
                                                      </div>
                                                      
                                                        <form class="form-material" id="refundTrans_form" method="post">
                                                      
                                                      <div class="modal-body">
                                                        <div class="form-row d-flex justify-content-around">
                                                            <div class="form-group form-primary col-md-6">
                                                                <input type="text" required name="ref_id" id="ref_id" class="form-control fill" readonly >
                                                                <span class="form-bar"></span>
                                                                <label class="float-label">Reffrence ID</label>
                                                            </div>
                                                            <input type='hidden' name="senderMobile" value="<?php echo filterThis($_GET['Mobile']) ?>">
                                                            <input type='hidden' name="akno" id="akno" value="" required readonly>
                                                            <input type='hidden' name="refundDmt" id="refundDmt" value="" required readonly>
                                                            <div class="form-group form-primary col-md-6">
                                                                <input type="number"required name="refund_otp" class="form-control" >
                                                                <span class="form-bar"></span>
                                                                <label class="float-label">Enter OTP</label>
                                                            </div>
                                                            
                                                            <div class="form-group form-primary col-md-6">
                                                                <button type="button" class="btn btn-primary" onclick="resendRefundOTP()">Resend OTP for refund</button>
                                                            </div>
                                                         </div>
                                                      </div>
                                                      <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Submit</button>
                                                      </div>
                                                      </form>
                                                    </div>
                                                  </div>
                                                </div>
                                             
                              
                                    <form id="replace" method="post">
                                        <input type="hidden" name="bnk1"  id="bnk1"/>
                                        <input type="hidden" name="bnk2"  id="bnk2"/>
                                        <input type="hidden" name="bnk3"  id="bnk3"/>
                                        <input type="hidden" name="Mobile"  id="Mob"/>
                                    </form>
                              
                              
                                </div>
                            </div>
                               <!-- Main-body end -->
                            <div id="styleSelector">

                            </div>
                        </div>
    </section>

  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

<script>
      function GetBankIFSC(val) {
                let getbankIfsc = "getbankIfsc";
                let bankcode = val;
                $.ajax({
                    url: 'api/paysprint/dmt/register_user',
                    type: 'post',
                    data: {
                        bankcode,
                        getbankIfsc
                    },
                    success: function(data, status) {
                        // console.log(data);
                        $("#bene_ifsc").addClass("fill");
                        $("#bene_ifsc").val(data.trim());
                    },
                    error: function(err) {
                        $("#loading_ajax").hide();
                        popup('error', 'OOPS..!', "some internel error occured we are fixing it");
                    }
                })
            }
            

</script>

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="plugins/jszip/jszip.min.js"></script>
<script src="plugins/pdfmake/pdfmake.min.js"></script>
<script src="plugins/pdfmake/vfs_fonts.js"></script>
<script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>


<script src="js/DMT.js"></script>
<script src="js/Main.js"></script>


   <script>
      $(document).ready(function () {
          $('#example').DataTable();
     });
    </script>
</body>
</html>
