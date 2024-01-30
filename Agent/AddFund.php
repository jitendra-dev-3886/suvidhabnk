<?php
    error_reporting(0);

      session_start();
// error_reporting(E_ALL);
// ini_set("display_errors" , 1);
include("../Db/config.php");
require("include/Auth.php"); // user auth
include("Backend/Functions/all_function.php"); // for create token

    $rand = md5($_COOKIE["rand_num"]);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Add Fund</title>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <meta name="keywords" content="bootstrap, bootstrap admin template, admin theme, admin dashboard, dashboard template, admin template, responsive"/>
    <meta name="author" content="Codedthemes" />
    <!-- Favicon icon -->
    <!--<link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">-->
          <!--<link href="../../../img/favicon2.png" rel="icon">-->

    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700" rel="stylesheet">
    <!-- waves.css -->
    <link rel="stylesheet" href="assets/pages/waves/css/waves.min.css" type="text/css" media="all">
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap/css/bootstrap.min.css">
    <!-- themify-icons line icon -->
    <link rel="stylesheet" type="text/css" href="assets/icon/themify-icons/themify-icons.css">
    <!-- ico font -->
    <link rel="stylesheet" type="text/css" href="assets/icon/icofont/css/icofont.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" type="text/css" href="assets/icon/font-awesome/css/font-awesome.min.css">
    <!-- style.php -->
    <link rel="stylesheet" type="text/css" href="assets/css/style.php">
    <link rel="stylesheet" type="text/css" href="assets/css/jquery.mCustomScrollbar.css">
    <link rel="stylesheet" href="dist/css/adminlte.css">
  

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<style>
    .error{
      color: red;
    }
</style>
</head>

<body>
    <!-- Pre-loader start -->
       <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__wobble" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" width="150">
  </div>
    <!-- Pre-loader end -->
    <div id="pcoded" class="pcoded">
        <div class="pcoded-overlay-box"></div>
        <div class="pcoded-container navbar-wrapper">
            <!-- Top header start -->
            <?php
    include("include/NavBar.php");
  ?>
  <!-- /.navbar -->


                <!-- Top header end -->
            <div class="pcoded-main-container">
                <div class="pcoded-wrapper">
                   <!-- Sidebarlist Start -->
                    <?php
                        include("include/sidebar.php");
                    ?>
                    <!-- Sidebarlist End -->
             
                    <div class="pcoded-content">
                        <!-- Page-header start -->
                        <div class="page-header">
                            <div class="page-block">
                                <div class="row align-items-center">
                                    <div class="col-md-8">
                                        <div class="page-header-title">
                                            <h5 class="m-b-10">Add Fund</h5>
                                            <p class="m-b-0">Dear admin you can customize your service here</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <ul class="breadcrumb">
                                            <li class="breadcrumb-item">
                                                <a href="Home"> <i class="fa fa-home"></i> </a>
                                            </li>
                                            <li class="breadcrumb-item"><a href="#!">CMS Manager</a>
                                            </li>
                                            <li class="breadcrumb-item"><a href="#!">Add Fund</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Page-header end -->
                        <div class="pcoded-inner-content">
                            <!-- Main-body start -->
                            <div class="main-body">
                                <div class="page-wrapper">

                                    <!-- Page body start -->
                                    <div class="page-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                
                                                <div class="card">
                                                    <div class="card-header">
                                                         <div class="row d-flex justify-content-between">
                                                            <div class="col-3">
                                                        <h5>Add Fund</h5>
                                                    </div>
                                                     <div class="col-2">
                                                            <button type="button" class="form-control btn-primary" data-toggle="modal" data-target="#exampleModalLong" style="float:right; display:block;"> Bank Details</button>
                                                            </div>
                                                            <!-- Modal -->
                                                                <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                                                  <div class="modal-dialog " role="document">
                                                             <form method="POST" class="form-material" id="modal_form">
                                                                    <div class="modal-content">
                                                                      <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLongTitle">View Bank Detail</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                          <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                      </div>
                                                                      <div class="modal-body">
                                                                         <?php 
                                                                            $res = $con->query("SELECT * FROM `Bank_details`  where MAIN_OWNER='ADMIN' and MAIN_OWNER_ID='1' order by ID desc");
                                                                            while($row = $res->fetch_assoc()){
                                                                                
                                                                            ?>
                                                                         <div class="form-group form-primary">
                                                                              <h4 class="text-right"><?php echo $row['BANK_NAME'];?></h4>
                                                                              <span>Currrent A/C NUMBER: <?php echo $row['AC_NUMBER'];?></span><br>
                                                                              <span>IFS Code: <?php echo $row['IFSC_CODE'];?></span><br>
                                                                              <span>ACCOUNT NAME: <?php echo $row['AC_NAME'];?></span><br>
                                                                               <span>BRANCH NAME: <?php echo $row['BRANCH'];?></span><br>
                                                                               <span>PAYMENT TYPE: <?php echo $row['PAY_TYPE'];?></span>
                                                                          </div>
                                                                          <hr>
                                                                          <?php
                                                                            }
                                                                            ?>
                                                                            
                                                                          <!--<div class="form-group form-primary">
                                                                              <h3 class="text-right">UPI</h3>
                                                                              <span class="text-right">UPI ID: quickpayhub@icici</span>
                                                                          </div> -->
                                                                      </div>
                                                                   
                                                                      <div class="modal-footer">
                                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                                        <!--<button type="button" class="btn btn-primary">Save changes</button>-->
                                                                      </div>
                                                                    </div>
                                                                </form>
                                                                  </div>
                                                                </div>
                                                          <!-- Modal -->
                                                          </div>
                                                    <div class="card-block">
                                                        <!-- Row start -->
                                                        <div class="row m-b-30">
                                                            <div class="col-lg-12 col-xl-12">
                                                                <ul class="nav nav-tabs md-tabs" role="tablist">
                                                                    <li class="nav-item">
                                                                        <a class="nav-link active" data-toggle="tab" href="#home3" role="tab" aria-selected="false">Online Fund</a>
                                                                        <div class="slide"></div>
                                                                    </li>
                                                                    
                                                                    <li class="nav-item">
                                                                        <a class="nav-link" data-toggle="tab" href="#profile3" role="tab" aria-selected="false">Offline Fund</a>
                                                                        <div class="slide"></div>
                                                                    </li>
                                                                   
                                                                </ul>
                                                                <!-- Tab panes -->
                                                                <div class="tab-content card-block">
                                                                    <div class="tab-pane active" id="home3" role="tabpanel">
                                                                       <div class="card-block my-3">
                                                                            <form class="form-material razorpay-frm-payment" name="razorpay_frm_payment" id="razorpay-frm-payment" method="post">
                                                                                <div class="form-row d-flex justify-content-around">
                                                                                    
                                                                                <!-- Start Razorpay -->    
                                                                                <input type="hidden" name="merchant_order_id" id="merchant_order_id" value="<?php echo substr(str_shuffle("QqwertyuiopasdfghjklzcvbnmQWERTYUIOPASDFGHJKLZXCVBNM1234567890") , 0 ,10); ?>">
                                                                                <input type="hidden" name="language" value="EN">
                                                                                <input type="hidden" name="currency" id="currency" value="INR">
                                                                                <input type="hidden" name="billing-email" id="billing-email" value="<?php echo $user['EMAIL'] ?>">
                                                                                <input type="hidden" name="billing-phone" id="billing-phone" value="<?php echo $user['MOBILE'] ?>">
                                                                                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                                                                                <input type="hidden" name="surl" id="surl" value="api/payment_gateway/razorpay/success.php?id=<?php echo $user['ID'] ?>&token=<?php  echo $rand ?>">
                                                                                <input type="hidden" name="furl" id="furl" value="api/payment_gateway/razorpay/failed.php">
                                                                                <!-- End Razorpay -->
                                                                                    
                                                                                <div class="form-group form-primary col-md-4">
                                                                                    <input type="number" required id="amount" name="amount" class="form-control">
                                                                                    <span class="form-bar"></span>
                                                                                    <label class="float-label">Amount</label>
                                                                                </div>
                                                                                <div class="form-group form-primary col-md-4">
                                                                                    <select name="select" required class="form-control fill">
                                                                                        <!--<option value="select">Select Payment Gateway</option>-->
                                                                                        <option value="Razorpay" selected>Razorpay</option>
                                                                                        <!--<option value="Paytm">Paytm</option>-->
                                                                                        <!--<option value="Pay u Money">Pay u Money</option>-->
                                                                                    </select>
                                                                                </div>
                                                                                </div>
                                                                                <div class="form-row mt-4 d-flex justify-content-center">
                                                                                    <div class="col-md-8">
                                                                                        <!--id="razor-pay-now"-->
                                                                                        <button type="submit"  name="add_fund" id="razor-pay-now"  class="btn waves-effect waves-light btn-primary btn-block btn-outline-primary"><i class="ti-wallet"></i>Instant Add Wallet</button>
                                                                                    </div>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                    <div class="tab-pane" id="profile3" role="tabpanel">
                                                                        
                                                                        <div class="card-block my-3">
                                                                            <form class="form-material" id="main_form" method="post" enctype="multi-part/formData">
                                                                                <div class="form-row d-flex justify-content-around">
                                                                                <div class="form-group form-primary col-md-3">
                                                                                    <input type="number"  required name="amount" class="form-control">
                                                                                    <span class="form-bar"></span>
                                                                                    <label class="float-label">Amount</label>
                                                                                </div>
                                                                                <div class="form-group form-primary col-md-3">
                                                                                    <input type="file" name="recipt" class="form-control fill">
                                                                                    <span class="form-bar"></span>
                                                                                    <label class="float-label">Recipt</label>
                                                                                </div>
                                                                                 <div class="form-group form-primary col-md-3">
                                                                                    <input type="number"  name="refrenceid" class="form-control">
                                                                                    <span class="form-bar"></span>
                                                                                    <label class="float-label">Refrence Id</label>
                                                                                </div>
                                                                           
                                                                                <div class="form-group form-primary col-md-3">
                                                                                    <select name="payment_mode" required class="form-control fill">
                                                                                        <option value="" disabled selected>Select Payment options</option>
                                                                                        <option value="Bank">Bank</option>
                                                                                        <option value="NEFT">NEFT</option>
                                                                                        <option value="IMPS">IMPS</option>
                                                                                        <option value="Gpay">Gpay</option>
                                                                                        <option value="Phone pe">Phone pe</option>
                                                                                        <option value="Other">Other</option>
                                                                                    </select>
                                                                                </div>
                                                                                </div>
                                                                                <div class="form-row mt-4 d-flex justify-content-center">
                                                                                    <div class="col-md-8">
                                                                                        <button type="submit" name="ofline_bal_req" class="btn waves-effect waves-light btn-primary btn-block btn-outline-primary"><i class="ti-wallet"></i>Request Wallet</button>
                                                                                    </div>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                    
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Row end -->
                                                    </div>
                                                </div>
                                                
                                                <!-- Service Table -->
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h5>Last 10 Payment List</h5>
                                                        <span>My Last 10 payment</span>
                                                        <div class="card-header-right">
                                                            <ul class="list-unstyled card-option">
                                                                <li><i class="fa fa fa-wrench open-card-option"></i></li>
                                                                <li><i class="fa fa-window-maximize full-card"></i></li>
                                                                <li><i class="fa fa-minus minimize-card"></i></li>
                                                                <li><i class="fa fa-refresh reload-card"></i></li>
                                                                <li><i class="fa fa-trash close-card"></i></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="card-block table-border-style">
                                                        <div class="table-responsive">
                                                            <table class="table">
                                                                <thead>
                                                                    <tr>
                                                                        <th>SL No</th>
                                                                        <th>Mode</th>
                                                                        <th>Amount</th>
                                                                        <th>Opening Balance</th>
                                                                        <th>Closing Balance</th>
                                                                        <th>Status</th>
                                                                        <th>Date</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                       <?php
                                                                    $user_id = $_SESSION['id']; 
                                                                    $i = 1;
                                                                    $res = $con->query("SELECT * FROM fund where USER_ID='$user_id' order by ID desc");
                                                                 
                                                                    if($res->num_rows > 0){
                                                                        while($fund = $res->fetch_assoc()){
                                                                            ?>
                                                                            
                                                                    <tr class="">
                                                                        <th scope="row"><?php echo $i++ ?></th>
                                                                        <td><?php echo $fund['FUND_TYPE'] ?></td>
                                                                        <td><?php echo $fund['AMOUNT'] ?></td>
                                                                        <td><?php echo $fund['USER_PREVIOUS_AMOUNT'] ?></td>
                                                                        <td><?php echo $fund['USER_AFTER_AMOUNT'] ?></td> 
                                                                        <td><?php echo $fund['STATUS'] ?></td> 
                                                                        <td><?php echo $fund['DATE'] ?></td> 
                                                                     </tr>  
                                                                     
                                                                        <?php
                                                                 }
                                                                }
                                                                    
                                                                ?> 
                                                                     
                                          
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                        <!--Service table-->
                                        
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Page body end -->
                                </div>
                            </div>
                            <!-- Main-body end -->
                            <div id="styleSelector">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <!-- Required Jquery -->
    <script type="text/javascript" src="assets/Js/AddFund.js"></script>
    <script type="text/javascript" src="assets/js/jquery/jquery.min.js "></script>
    <script type="text/javascript" src="assets/js/jquery-ui/jquery-ui.min.js "></script>
    <script type="text/javascript" src="assets/js/popper.js/popper.min.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap/js/bootstrap.min.js "></script>
    <!-- waves js -->
    <script src="assets/pages/waves/js/waves.min.js"></script>
    <!-- jquery slimscroll js -->
    <script type="text/javascript" src="assets/js/jquery-slimscroll/jquery.slimscroll.js"></script>

    <!-- Custom js -->
    <script src="assets/js/pcoded.min.js"></script>
    <script src="assets/js/vertical/vertical-layout.min.js"></script>
    <script src="assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script type="text/javascript" src="assets/js/script.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
    <script type="text/javascript" src="assets/js/validation/add_fund.js"></script>
</body>

</html>
