<?php
session_start();
// error_reporting(E_ALL);
// ini_set("display_errors" , 1);
include("../Db/config.php");
require("include/Auth.php"); // user auth
include("Backend/Functions/all_function.php"); // for create token
include("Backend/AEPS/Instantpay/aeps_function.php"); // aeps use

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title> AePS | PayDeer </title>

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
       <div id="loading_ajax" style="width: 100%;height: 130%;position: absolute;top: 0;left: 0;background: #00000038; background-attachment:fixed; z-index: 22222;display: none;"></div>
    
     
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__wobble" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo"  width="140">
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
                $user_exist = check_aeps_user($usid, 46);
                // echo $user_exist;
                // echo getbank();
                if ($user_exist == 0) {
                    //  echo "<script>location.replace('api/paysprint/aeps/aeps_onboard.php')</script>";
                ?>
                    <h3 class='mx-auto text-center mt-5 text-capitalize'>Your are not register for aeps yet. Please register</h3>
                            <div class="card-block my-3">
                                <form class="form-material" id='onboardForm' method="post">
                                  <div class="form-row d-flex justify-content-around ">
                                      
                                     <input type="hidden" id="long" name="long">
                                    <input type="hidden" id="lati" name="lat">
                                     <div class="form-group col-md-3">
                                        <label for="exampleInputEmail1">Aadhaar Number</label>
                                        <input type="number" class="form-control" name="regaadhar" placeholder="Aadhaar Number" onkeypress="return this.value.length < 12;" oninput="if(this.value.length>=12) { this.value = this.value.slice(0,12); }">
                                      </div>
                                     <div class="form-group col-md-3">
                                        <label for="exampleInputEmail1">Pan Number</label>
                                        <input type="text" class="form-control" name="regpan" placeholder="Pan Number" onkeypress="return this.value.length < 10;" oninput="if(this.value.length>=10) { this.value = this.value.slice(0,10); }">
                                      </div>
                                      <div class="form-group col-md-3">
                                        <label for="exampleInputEmail1">Mobile Number</label>
                                        <input type="number" class="form-control"  name="regmobile" id="" placeholder="Mobile Number" onkeypress="return this.value.length < 10;" oninput="if(this.value.length>=10) { this.value = this.value.slice(0,10); }">
                                      </div>
                                      <div class="form-group col-md-3">
                                        <label for="exampleInputEmail1">Email </label>
                                        <input type="email" class="form-control"  name="regemail" id="" placeholder="Email" onkeypress="return this.value.length < 30;" oninput="if(this.value.length>=30) { this.value = this.value.slice(0,30); }">
                                      </div>
                                    </div>
                                <div class="card-footer d-flex justify-content-center">
                                    <div class="col-md-4">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                 
                        </form>
                    </div>
                            <div class="card-block my-3">
                                <form class="form-material" id='onboardOTPForm' style="display:none;" method="post">
                                  <div class="form-row d-flex justify-content-around ">
                                      
                                     <input type="hidden" id="otpReferenceID" name="otpReferenceID">
                                    <input type="hidden" id="hash" name="hash">
                                    
                                      <div class="form-group col-md-3">
                                        <label for="exampleInputEmail1">Enter OTP </label>
                                        <input type="number" class="form-control"  name="regotp" id="" placeholder="Enter OTP" onkeypress="return this.value.length < 10;" oninput="if(this.value.length>=10) { this.value = this.value.slice(0,10); }">
                                      </div>
                                    </div>
                                <div class="card-footer d-flex justify-content-center">
                                    <div class="col-md-4">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                <?
                    // exit;
                } else {
                    
                ?>
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
                        <label for="exampleInputEmail1">Select Transaction</label>
                        <select class="form-control select2" name="bankName" style="width: 100%;">
                            <option value="" disabled >Select Bank</option>
                         <?php
                            $jsn_data = json_decode(getbank(), true);
                            // print_r();
                            $banklist = $jsn_data['data'];
                            foreach ($banklist as $bank) {
                                echo '<option value="' . $bank['iin'] . '">' . $bank['name'] . '</option>';
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
              <? } ?>
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

<script src="js/AEPS_2.js"></script>
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
