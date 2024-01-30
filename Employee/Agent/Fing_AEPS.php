<?php
session_start();
include("../Db/config.php");
require("include/Auth.php"); // user auth
include("Backend/Functions/all_function.php"); // for create token
include("Backend/AEPS/Fingpay/function.php"); // aeps use

$row = $con->query("SELECT * FROM `websetting`")->fetch_assoc();
// error_reporting(E_ALL);
// ini_set("display_errors" , 1);
$usdt =$user;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title> AePS | <?php echo $row['NAME'] ?> </title>

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

</head>

<body class="hold-transition light-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
       <!--<div id="loading_ajax" style="width: 100%;height: 130%;position: absolute;top: 0;left: 0;background: #00000038; background-attachment:fixed; z-index: 22222;display: none;"></div>-->
    <!--<div class="container">-->
    <!--    <div class="modal fade" id="loading_ajax" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">-->
    <!--      <div class="modal-dialog" role="document">-->
    <!--        <div class="modal-content">-->
              <!--<div class="modal-header">-->
              <!--  <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>-->
              <!--  <button type="button" class="close" data-dismiss="modal" aria-label="Close">-->
              <!--    <span aria-hidden="true">&times;</span>-->
              <!--  </button>-->
              <!--</div>-->
              <!--<div class="modal-body">-->
              <!--  <h3>Transaction in process please wait...</h3>-->
              <!--</div>-->
              <!--<div class="modal-footer">-->
              <!--  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>-->
              <!--  <button type="button" class="btn btn-primary">Save changes</button>-->
              <!--</div>-->
    <!--        </div>-->
    <!--      </div>-->
    <!--    </div>-->
    <!--</div>-->
     
<!--<div class="wrapper">-->
<!--    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#loading_ajax">Launch demo modal</button>-->
<!--</div>-->
<!--<button class="btn btn-primary" type="button" id="loading_ajax" disabled>-->
<!--  <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>-->
<!--Transaction in process please wait...-->
<!--</button>-->
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
            <h1 class="m-0">Aadhaar Enabled Payment System</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Aadhaar Enabled Payment System</li>
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
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Aadhaar Enabled Payment System</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
               <?php
                $user_exist = check_aeps_user($usid, $ustype_id);
                // echo $user_exist;
                // echo getbank();
                if ($user_exist == 0) {
                    //  echo "<script>location.replace('api/paysprint/aeps/aeps_onboard.php')</script>";
                ?>
                    <h3 class='mx-auto text-center mt-5 text-capitalize'>Your are not register for aeps yet. Please register</h3>
                    <div class="card-block my-3">
                        <form class="form-material"  id="aepsonboard_form" >
                              <div class="form-group col-md-4">
                                <label for="exampleInputEmail1">PAN Number</label>
                                <input type="text" class="form-control" name="pan" required placeholder="PAN Number" onkeypress="return this.value.length < 10;"
                                oninput="if(this.value.length>=10) { this.value = this.value.slice(0,10); }">
                              </div>
                                 <input type="hidden" id="long" name="long">
                                <input type="hidden" id="lati" name="lat">
                              
                              <div class="col-md-4">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                              </div>
                        </form>
                    </div>
                <?
                    // exit;
                } else {
                    // print_r($user);
                    // echo "select * from fing_aeps_merchant where MOBILE='".$user['MOBILE']."' and STATUS<>'' order by ID DESC limit 1";
                 $apuser = $con->query("select * from fing_aeps_merchant where MOBILE='".$usdt['MOBILE']."' and STATUS<>'' order by ID DESC limit 1")->fetch_assoc();
                 if(strtolower($apuser['STATUS']) == "pending"){
                     ?>
                     <form method = "post" id="ekyc_form" >
                       <div class="card-body">
                        <div class="form-row d-flex justify-content-around ">
                               <div class="form-group col-md-4">
                                <label for="exampleInputEmail1 allhide">Aadhaar Number</label>
                                <input type="text" class="form-control" name="aadhar" id="aadhar" placeholder="Aadhaar Number" onkeypress="return this.value.length < 14;" oninput="if(this.value.length>=14) { this.value = this.value.slice(0,14); }">
                              </div>
                              
                              <div class="form-group col-md-3 otparea allhide" style="display:none; ">
                                <label for="exampleInputEmail1">Enter OTP </label>
                                <input type="number" class="form-control"  name="otp" id="otp" placeholder="Enter OTP" >
                              </div>
                              
                         <input type="hidden" id="pkeyid" name="pkeyid">
                        <input type="hidden" id="fptid" name="fptid">
                        
                        </div>
                         <input type="hidden" id="long" name="long">
                        <input type="hidden" id="lati" name="lat">
                        <div class="form-group col-md-3" style="display:none;" id="fingerdevices">
                                <label for="exampleInputEmail1">Select Device</label>
                            <select name="fingerdevice" required id="fingerdevice" class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                <option value="">Select Device</option>
                                <option value="morpho">Morpho</option>
                                <option value="mantra" selected>mantra</option>
                                <option value="secugen">secugen</option>
                                <option value="precision">precision</option>
                                <option value="startek">startek</option>
                                <option value="nextrd">nextrd</option>
                            </select>
                        </div>
                        </div>
                    </div>
                        <!-- /.card-body -->
        
                <!--//for finger scan-->
                <input id="method" type="hidden" value="">
                <input id="info" type="hidden" value="">
                <input type="hidden" name="txtWadh" id="txtWadh">
            	<textarea style="display:none;" id="txtDeviceInfo" rows="10" cols="50"  height="1000"></textarea>
            	<textarea style="display:none;" name="fingerData" id="txtPidData" rows="20"  cols="100" height="1000"></textarea>
            	
                        <div class="card-footer d-flex justify-content-center">
                            <div class="col-md-4 allhide " id="sendotparea">
                                <button type="button" id="sendotpbtn" class="btn btn-primary">Send OTP</button>
                            </div>
                            <div class="col-md-4 allhide " id="resendotparea" style="display:none; " >
                                <button type="button" id="resendotpbtn" class="btn btn-primary">ReSend OTP</button>
                            </div>
                            
                            <div class="col-md-4 allhide otparea"  style="display:none; " >
                                <button type="button" id="validateotp" class="btn btn-primary">Submit OTP</button>
                            </div>
                            <div class="col-md-4 fingerarea " id="sendotparea"  style="display:none; " >
                                <button type="submit" id="capturefinger" class="btn btn-primary">capturefinger</button>
                            </div>
                        </div>
              </form>
                     <?php
                 }
                 else if(strtolower($apuser['STATUS']) == "active"){
                ?>
                <br>
                <br>
                      <form method = "post" id="aeps_form" >
                        <div class="card-body">
                        
                        <div class="form-row d-flex justify-content-around ">
                            <div class="form-group col-md-4">
                                <label for="exampleInputEmail1">Aadhaar Number</label>
                                <input type="text" class="form-control" name="aadhar" placeholder="Aadhaar Number" onkeypress="return this.value.length < 14;" oninput="if(this.value.length>=14) { this.value = this.value.slice(0,14); }">
                              </div>
                              <div class="form-group col-md-3">
                                <label for="exampleInputEmail1">Mobile Number</label>
                                <input type="number" class="form-control"  name="mobile" id="" placeholder="Mobile Number" onkeypress="return this.value.length < 10;" oninput="if(this.value.length>=10) { this.value = this.value.slice(0,10); }">
                              </div>
                              <div class="form-group col-md-4">
                                <label for="exampleInputEmail1">Select Bank</label>
                                <select class="form-control select2" name="bankName" style="width: 100%;">
                                    <option value="" disabled >Select Bank</option>
                                 <?php
                                    $jsn_data = json_decode(getbank(), true);
                                    // print_r();
                                    $banklist = $jsn_data['data'];
                                    foreach ($banklist as $bank) {
                                        echo '<option value="' . $bank['iinno'] . '">' . $bank['bankName'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                         <input type="hidden" id="long" name="long">
                        <input type="hidden" id="lati" name="lat">
                        <!--//for finger scan-->
                        <input id="method" type="hidden" value="">
                        <input id="info" type="hidden" value="">
                        <input type="hidden" name="txtWadh" id="txtWadh">
                    	<textarea style="display:none;" id="txtDeviceInfo" rows="10" cols="50"  height="1000"></textarea>
                    	<textarea style="display:none;" name="fingerData" id="txtPidData" rows="20"  cols="100" height="1000"></textarea>
                    	
                        <div class="form-row d-flex justify-content-around">
                         <div class="form-group col-md-3">
                              
                                <label for="exampleInputEmail1">Select Transaction</label>
                            <select name="fingerdevice" required id="fingerdevice" class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                <option value="">Select Device</option>
                                <option value="morpho">Morpho</option>
                                <option value="mantra">mantra</option>
                                <option value="secugen">secugen</option>
                                <option value="precision">precision</option>
                                <option value="startek">startek</option>
                                <option value="nextrd">nextrd</option>
                            </select>
                        </div>
                            <div class="form-group col-md-3">
                                <label for="exampleInputEmail1">Select Transaction</label>
                                <select class="form-control select2" name="transType" id="transType" onchange="get_trans(this.value)" required style="width: 100%;">
                                    <option value="BE" selected>Balance Enqiry</option>
                                    <option value="MS">Mini Statment</option>
                                    <option value="CW">Cash Withdrawal</option>
                                    <option value="M">Aadhaar Pay</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4"  id="aeps_amount_area" style="display:none;" style="display:none;">
                                <label for="exampleInputEmail1">Amount</label>
                                <input type="number" class="form-control"  name="amount" placeholder="Amount" onkeypress="return this.value.length < 10;" oninput="if(this.value.length>=10) { this.value = this.value.slice(0,10); }">
                              </div>
                        </div>
              
                    </div>
                        <!-- /.card-body -->
        
                        <div class="card-footer d-flex justify-content-center">
                          <!--<button type="submit" class="btn btn-primary" id="save">Submit</button>-->
                           <!--<div class="col-md-3">-->
                           <!--     <button type="button" class="btn btn-primary" onclick="discoverDevice()"><i class="ti-target"></i>Discover Device</button>-->
                           <!-- </div>-->
                           <!-- <div class="col-md-3">-->
                           <!--     <button type="button" class="btn btn-primary" onclick="CaptureAvdm()"><i class="ti-hand-point-up"></i>Capture Fingerprint</button>-->
                           <!-- </div>-->
                            <div class="col-md-4">
                                <button type="submit" id="BE_BTN" class="btn btn-primary">Scan & Submit</button>
                            </div>
                        </div>
                         
              </form>
                  <? } } ?>
            </div>
            <!-- /.card -->














       <!-- /.col -->
        </div>
        <!-- /.row -->
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

<script>
    function changeCom(value){
        console.log(value);
        if(value == "Cash_Withdrawal" || value == "Aadhaar_Pay"){
            $("#Amount").show();
        }
        else{
            $("#Amount").hide();
        }
    }
</script>

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

<script src="js/Fing_AEPS.js"></script>
<script src="js/Main.js"></script>
<!-- Page specific script -->
<script>
// function myFunction() {
//   alert("Transaction in process please wait...");
// }
</script>
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
