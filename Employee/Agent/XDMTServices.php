<?php
session_start();
include("../Db/config.php");
require("include/Auth.php"); // user auth
include("Backend/Functions/all_function.php"); // for create token
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title> XDMT </title>

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
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__wobble" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" width="140">
  </div>

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
            <h1 class="m-0">Express Domestic Money Transfer</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Express Domestic Money Transfer</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
        <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <!-- /.card -->
            <?php
                // $user_exist = check_user($id , $usertype_id);
                // echo $user_exist;
                if (!isset($_GET['Mobile'])) {
            ?>
                 <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">New Register User</h3>
                      </div>
                    <div class="card-block my-3">
                        <form class="form-material" id="dmt_form" method="post">
                            <input type="hidden" name="otpSendTime" id="otpSendTime" value="0">
                            <div class="form-row d-flex justify-content-around">
                                <div class="form-group form-primary col-md-3" id="name_area">
                                    <label class="float-label">Name</label>
                                    <input type="text" name="name" id="name" value="" class="form-control">
                                    <span class="form-bar"></span>
                                </div>
                                <div class="form-group form-primary col-md-4" id="mobile_area">
                                    <label class="float-label">Mobile</label>
                                    <input type="number" name="mobile" id="mobile" value="" class="form-control">
                                    <span class="form-bar"></span>
                                </div>
                                <div class="form-group form-primary col-md-4" id="add_area">
                                    <label class="float-label">Address</label>
                                    <input type="text" name="address" id="address" value="" maxlength="100" class="form-control">
                                    <span class="form-bar"></span>
                                </div>
                              </div>
                                
                                <div class="form-row d-flex justify-content-around">
                                <div class="form-group form-primary col-md-4" id="pin_area">
                                    <label class="float-label">Pincode</label>
                                    <input type="number" name="pincode" id="pincode" value="" maxlength="6" class="form-control">
                                    <span class="form-bar"></span>
                                </div>
                                <!--<div class="form-row mt-5 d-flex justify-content-center">-->
                                    <div class="form-group form-primary col-md-4" id="otp_area">
                                        <label class="float-label">Enter OTP</label>
                                        <input type="text" name="otp" id="otp" class="form-control">
                                        <span class="form-bar"></span>
                                    </div>
                                   
                                <!--</div>-->
                            </div>
                            <input type="hidden" id="hash_code" name="hash_code">
                            <div class="form-row mt-4 d-flex justify-content-center">
                                 <!--<div style="display:none" class="form-group form-primary col-md-3" id="resendOtp">-->
                                 <!--       <button type="button" class="btn btn-primary">Resend OTP</button>-->
                                 <!--   </div>-->
                                <div class="col-md-3" id="submit_btn_area">
                                    <button type="button" id="register_user" class="btn btn-primary">Submit</button>
                                </div>
                                <div class="col-md-4" id="send_otp_area">
                                    <button type="button" name="send_otp_btn" id="send_otp_btn" class="btn btn-primary">Proceed</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                  <?php
        } else {
        ?>
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Express Domestic Money Transfer</h3>
                
                <div class="col-md-4 " style="float:right;">
                     <button type="submit" data-toggle="modal" data-target="#AddBeneModalCenter"class="btn btn-primary">Add Beneficiary</button>
              </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
     
                  <thead>
                  <tr>
                    <th>SL No.</th>
                    <th>Beneficiary ID</th>
                    <th>Name</th>
                    <th>Account No.</th>
                    <!--<th>Email</th>-->
                    <th>IFSC Code</th>
                    <th>Delete</th>
                    <th>Verify</th>
                    <th>Transfer</th>
                  </tr>
                  </thead>
                  <tbody>

                  <?php
                      $bene = $con->query("select * from cashfree_beneficiary where US_ID='$usid' and REMIT_MOBILE='".filterVal($_GET['Mobile'])."'  order by ID Desc");
                    //   echo "select * from cashfree_beneficiary where US_ID='$usid' and REMIT_MOBILE='".filterVal($_GET['Mobile'])."'  order by ID Desc";
                      $i=1;
                      while($beneDetail = $bene->fetch_assoc()){
                      ?>
                          <tr>
                            <td><?php echo $i++ ?></td>
                            <td><?php echo $beneDetail['BENEID'] ?></td>
                            <td><?php echo $beneDetail['NAME'] ?></td>
                            <td><?php echo $beneDetail['ACCOUNT'] ?></td>
                            <td><?php echo $beneDetail['IFSC'] ?></td>
                            <td><a onclick="delete_bene('<?php echo $beneDetail['BENEID'] ?>')" href="#">Delete</a></td>
                            <td><button type="button" onclick="verify_bene('<?php echo $beneDetail['BENEID'] ?>')" class="btn btn-primary">Verify Bene</button>
                            <td><button type="button" onclick="send_amount('<?php echo $beneDetail['BENEID'] ?>' ,'<?php echo $beneDetail['ACCOUNT'] ?>' ,'<?php echo $beneDetail['IFSC'] ?>' ,'<?php echo $beneDetail['NAME'] ?>','<?php echo $beneDetail['MOBILE'] ?>' )" data-toggle="modal" data-target="#sendAmModalCenter" class="btn btn-primary">Send Amount</button>
                          </td></tr>
                          <?php
                      }
                      ?>
                
                  </tfoot>
                  
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
              <?php
                    }
                ?>
            
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
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
                                                        </div>
                                                    </div>
                                                    <div class="card-block table-border-style">
                                                        <div class="table-responsive">
                                                            <table class="table table-striped">
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
                                                                    <th>Update Status</th>
                                                                    <th>Refund</th>
                                                                </tr>
                                                              </thead>
                                                              <tbody> 
                                                              <?php
                                                                  $dmt_trans_q = $con->query("select * from xdmt_transactions where USER_ID='$usid' order by ID Desc");
                                                                  while($dmt_row = $dmt_trans_q->fetch_assoc()){
                                                                  ?>
                                                                <tr>
                                                                    <td>1</td>
                                                                    <td><?php echo $dmt_row['BENE_ID'] ?></td>
                                                                    <td><?php echo $dmt_row['ACCOUNT'] ?></td>
                                                                    <td><?php echo $dmt_row['AMOUNT'] ?></td>
                                                                    <td><?php echo $dmt_row['STATUS'] ?></td>
                                                                    <?php
                                                                    $dt = json_decode($dmt_row['RESPONSE']);
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
                                                                    <td onclick="check_dmt_status('<?php echo $dmt_row['REFFRENCE_ID'] ?>')">Check Status</td>
                                                                    <td onclick="refundTrans('<?php echo $dmt_row['REFFRENCE_ID'] ?>' , '<?php echo $dt->ackno ?>')"  data-toggle="modal" data-target="#exampleModalCenter3">Refund </td>
                                                               </tr>
                                                               <?php } ?>
                                                            </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
      </div>
      <!-- /.container-fluid -->
    </section>

    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!--========= Add BENE Modal =========-->
<!-- Modal -->
<div class="modal fade" id="AddBeneModalCenter" tabindex="-1" role="dialog" aria-labelledby="AddBeneModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="AddBeneModalLongTitle">Add Beneficiary</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <form class="form-material" id="add_bene_form" autocomplete="off" method="post">
          <div class="modal-body">
            <div class="form-row d-flex justify-content-around">
                <div class="form-group form-primary col-md-6">
                    <label class="float-label">Full Name</label>
                    <input type="text" required name="beneName" autocomplete="off" class="form-control">
                    <span class="form-bar"></span>
                </div>
                <div class="form-group form-primary col-md-6">
                    <label class="float-label">Mobile </label>
                    <input type="number"required name="beneMobile" autocomplete="off" class="form-control">
                    <span class="form-bar"></span>
                </div>
             </div>
                    <input type="hidden" value="info@paydeer.app" required name="beneEmail" class="form-control">
                    <input type="hidden" required value="A108 Adam Street, New York, NY 535022" name="beneAdd" class="form-control">
            <div class="form-row d-flexjustify-content-around">
                <div class="form-group form-primary col-md-6">
                    <label class="float-label">Account Number</label>
                    <input type="number"required name="beneAcc" autocomplete="off" class="form-control" >
                    <span class="form-bar"></span>
                </div>
                 <div class="form-group form-primary col-md-6">
                    <label class="float-label">IFSC Code</label>
                    <input type="text" required name="beneIFSC" autocomplete="off" class="form-control" >
                    <span class="form-bar"></span>
                </div>
             </div>
                <input type="hidden" required name="remitMobile" value="<?php echo filterVal($_GET['Mobile']) ?>">

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
      </form>
    </div>
  </div>
</div>
  <!--========= ADD BENE Modal =========-->
  

  <!--========= Transfer Modal =========-->
<!-- Modal -->
<div class="modal fade" id="sendAmModalCenter" tabindex="-1" role="dialog" aria-labelledby="sendAmModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="sendAmModalLongTitle">Send Amount</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="send_amount_form" autocomplete="off">
            <div class="form-row d-flex justify-content-center">
              <div class="col-10">
                <div class="form-group">
                    <label for="">Benificiary ID : <span id="showbeneid"></span></label>
                    <br>
                    <label for="">Name : <span id="showbenename"></span></label>
                    <br>
                    <label for="">Account Number : <span id="showbeneacc"></span></label>
                    <label for="">IFSC Code : <span id="showbeneifsc"></span></label>
                     <br>
                    <label for="">Mobile : <span id="showbenemobile"></span></label>
                     <br>
                     
                    <input type="hidden" required name="remitter_mobile" value="<?php echo filterVal($_GET['Mobile']) ?>">
                    <input type="hidden" name="bene_id" id="beneId">
                    <input type="hidden" name="otpSendTime" id="otpSendTime" value="0">
                    <input type="hidden" name="send_am_acc" id="send_am_acc">
                    <input type="hidden" name="sendbeneMobile" id="sendbeneMobile">
                    <input type="hidden" name="smhash_code" id="hash_code">
                    
                    <label for="">Enter Amount</label>
                     <input type="number" class="form-control" name="send_amount" id="send_amount" placeholder="Enter Amount" onkeypress="return this.value.length < 5;" oninput="if(this.value.length>=5) { this.value = this.value.slice(0,5); }">
                  </div> 
                  
                  <div class="row" style="display:none;" id="amOtpArea">
                       <div class="form-group col-12">                           
                        <label for="">Agent OTP</label>
                         <input type="number" class="form-control" name="agentOTP" id="agentOTP" placeholder="Agent OTP" onkeypress="return this.value.length < 6;" oninput="if(this.value.length>=6) { this.value = this.value.slice(0,6); }">
                       </div>
                      
                <button type="button" onclick="sendamountotp()" id="resendotp" class="btn btn-primary">Resend OTP</button>
                  </div>
              </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" onclick="sendamountotp()" id="sendotparea" class="btn btn-primary">Send OTP</button>
        <button style="display:none;" id="submitBtn" type="submit" class="btn btn-primary">Submit </button>
      </div>
        </form>
    </div>
  </div>
</div>
  <!--========= Transfer Modal =========-->
  
  <!-- Main Footer -->
<?php
    include("include/BottomBar.php");
 ?>
</div>
<!-- ./wrapper -->

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


<script src="js/XDMT.js"></script>
<script src="js/Main.js"></script>


<!-- Page specific script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
</body>
</html>
