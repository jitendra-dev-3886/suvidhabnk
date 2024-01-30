<?php
include("../Db/config.php");
session_start();
$my_id = $_SESSION["UsId"];
$user = $con->query("SELECT * FROM `user` WHERE ID='$my_id'")->fetch_assoc();

$row = $con->query("SELECT * FROM `websetting`")->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo $row['NAME']?> | Dashboard </title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  
  <style>
  
  .mat-clr-stat-card .card-block .mat-icon {
    position: absolute;
    top: 50%;
    left: 50%;
    -webkit-transform: translate(-50%, -50%);
    transform: translate(-50%, -50%);
    
    font-size:24px;
}

.mat-clr-stat-card {
    overflow: hidden;
}
.card {
    border-radius: 5px;
    box-shadow: 0 1px 20px 0 rgb(69 90 100 / 18%);
    border: none;
    margin-bottom: 30px;
    transition: all 0.3s ease-in-out;
}
      
      .icons_section {
    padding: 10px 0;
    background: #fff;
    border-radius: 5px;
}

.miconsec {
    display: flex;
    flex-direction: column;
    align-items: center;
    margin-bottom: 50px;
}

.serviceicon {
    background: #00adff45;
    border-radius: 50%;
    padding: 16px;
    margin-bottom: 20px;
}

       #otpbox{
           display:none;
       }
      
       #changepassbox{
          display:none;
      }
      
      #tpinotpnbox{
          display:none;
      }
      
      #ctpinbox{
          display:none;
      }
      #cahngempinbox{
          display:none;
      }
      #cmpinotpbox{
          display:none;
      }
      


  </style>
  
</head>
<body class="hold-transition light-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
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
      <!--<div class="container-fluid">-->
      <!--  <div class="row mb-2">-->
      <!--    <div class="col-sm-6">-->
            <!--<h1 class="m-0">Dashboard v2</h1>-->
      <!--    </div><!-- /.col -->
      <!--    <div class="col-sm-6">-->
      <!--      <ol class="breadcrumb float-sm-right">-->
      <!--        <li class="breadcrumb-item"><a href="#">Home</a></li>-->
      <!--        <li class="breadcrumb-item active">Dashboard </li>-->
      <!--      </ol>-->
      <!--    </div><!-- /.col -->
      <!--  </div><!-- /.row -->
      <!--</div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content" style=" margin-top: 4%;">
      <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
          <div class="col-12 col-sm-6 col-md-3">
              <a href="WalletReport?type=MAIN">
                  <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-wallet"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Main Wallet</span>
                <span class="info-box-number">
                  ₹ <?php echo $user['MAIN_BAL'] ?>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            </a>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
              <a href="WalletReport?type=AEPS">
                    <div class="info-box mb-3">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-wallet"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Commission Wallet</span>
                <span class="info-box-number">₹ <?php echo $user['AEPS_BAL'] ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            </a>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Today Earing</span>
                <span class="info-box-number">₹0</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Today Buisness</span>
                <span class="info-box-number">0</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

        <!---->
              
        <!---->

        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title">Change mPIN</h5>

                <!--<div class="card-tools">-->
                <!--  <button type="button" class="btn btn-tool" data-card-widget="collapse">-->
                <!--    <i class="fas fa-minus"></i>-->
                <!--  </button>-->
                <!--  <div class="btn-group">-->
                <!--    <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown">-->
                <!--      <i class="fas fa-filter"></i>-->
                <!--    </button>-->
                <!--    <div class="dropdown-menu dropdown-menu-right" role="menu">-->
                <!--      <a href="#" class="dropdown-item">Today</a>-->
                <!--      <a href="#" class="dropdown-item">Weekly</a>-->
                <!--      <a href="#" class="dropdown-item">Monthly</a>-->
                <!--      <a href="#" class="dropdown-item">Yearly</a>-->
                <!--      <a class="dropdown-divider"></a>-->
                <!--      <a href="#" class="dropdown-item">Customer Date</a>-->
                <!--    </div>-->
                <!--  </div>-->
                <!--  <button type="button" class="btn btn-tool" data-card-widget="remove">-->
                <!--    <i class="fas fa-times"></i>-->
                <!--  </button>-->
                <!--</div>-->
              </div>
              <!-- /.card-header -->
              <div class="card-body">
               <!--    <div class="row leadcol" >-->
               <!--     <div class="col-lg-2 col-md-4 col-sm-6">-->
               <!--       <a href="All_Report">-->
               <!--         <div class="card mat-clr-stat-card text-white blue">-->
               <!--             <div class="card-block">-->
               <!--                 <div class="row">-->
               <!--                     <div class="col-3 text-center" style="background:#fff;">-->
               <!--                         <i class="fas fa-file-alt mat-icon f-24 " style="color:#d35400;"></i>-->
               <!--                     </div>-->
               <!--                     <div class="col-9 cst-cont bg-c-blue" style="background:#d35400;">-->
                                       
               <!--                         <p class="m-b-0">Transaction</p>-->
                                        
               <!--                          <h5>History</h5>-->
               <!--                     </div>-->
               <!--                 </div>-->
               <!--             </div>-->
               <!--         </div>-->
                        
               <!--      </a>-->
               <!--     </div>-->
               <!--     <div class="col-lg-2 col-md-4 col-sm-6">-->
               <!--      <a href="All_Report">-->
               <!--         <div class="card mat-clr-stat-card text-white blue">-->
               <!--             <div class="card-block">-->
               <!--                 <div class="row">-->
               <!--                     <div class="col-4 text-center bg-c-blue" style="background:#fff;">-->
               <!--                         <i class="fas fa-user mat-icon f-24 " style="color:#c0392b;"></i>-->
               <!--                     </div>-->
               <!--                     <div class="col-8 cst-cont " style="background:#c0392b;">-->
                                       
               <!--                         <p class="m-b-0">Account</p>-->
                                        
               <!--                          <h5>Ledger</h5>-->
               <!--                     </div>-->
               <!--                 </div>-->
               <!--             </div>-->
               <!--         </div>-->
               <!--      </a>-->
               <!--     </div>-->
               <!--     <div class="col-lg-2 col-md-4 col-sm-6">-->
               <!--       <a href="Parchase_history">-->
               <!--         <div class="card mat-clr-stat-card text-white blue">-->
               <!--             <div class="card-block">-->
               <!--                 <div class="row">-->
               <!--                     <div class="col-4 text-center bg-c-blue" style="background:#fff;">-->
               <!--                         <i class="fas fa-history mat-icon f-24 " style="color:#27ae60;"></i>-->
               <!--                     </div>-->
               <!--                     <div class="col-8 cst-cont " style="background:#27ae60;">-->
                                       
               <!--                         <p class="m-b-0">Parchase</p>-->
                                        
               <!--                          <h5>History</h5>-->
               <!--                     </div>-->
               <!--                 </div>-->
               <!--             </div>-->
               <!--         </div>-->
                        
               <!--       </a>-->
               <!--     </div>-->
                 
               <!--     <div class="col-lg-2 col-md-4 col-sm-6">-->
               <!--       <a href="Fund_Report">-->
               <!--         <div class="card mat-clr-stat-card text-white blue">-->
               <!--             <div class="card-block">-->
               <!--                 <div class="row">-->
               <!--                     <div class="col-3 text-center bg-c-blue" style="background:#fff;">-->
               <!--                         <i class="fas fa-trophy mat-icon f-24" style="color:#e1b12c;"></i>-->
               <!--                     </div>-->
               <!--                     <div class="col-9 cst-cont" style="background:#e1b12c;">-->
                                       
               <!--                         <p class="m-b-0">Sales</p>-->
                                        
               <!--                          <h5>Summary</h5>-->
               <!--                     </div>-->
               <!--                 </div>-->
               <!--             </div>-->
               <!--         </div>-->
               <!--      </a>-->
               <!--     </div>-->
               <!--     <div class="col-lg-2 col-md-4 col-sm-6">-->
               <!--       <a href="Day_book">-->
               <!--         <div class="card mat-clr-stat-card text-white blue">-->
               <!--             <div class="card-block">-->
               <!--                 <div class="row">-->
               <!--                     <div class="col-4 text-center bg-c-blue" style="background:#fff;">-->
               <!--                         <i class="fas fa-book mat-icon f-24" style="color:#8e44ad;"></i>-->
               <!--                     </div>-->
               <!--                     <div class="col-8 cst-cont" style="background:#8e44ad;">-->
                                       
               <!--                         <p class="m-b-0">Day</p>-->
                                        
               <!--                          <h5>Book</h5>-->
               <!--                     </div>-->
               <!--                 </div>-->
               <!--             </div>-->
               <!--         </div>-->
               <!--      </a>-->
               <!--     </div>-->
               <!--     <div class="col-lg-2 col-md-4 col-sm-6">-->
               <!--       <a href="AddFund">-->
               <!--         <div class="card mat-clr-stat-card text-white blue">-->
               <!--             <div class="card-block">-->
               <!--                 <div class="row">-->
               <!--                     <div class="col-4 text-center bg-c-blue"  style="background:#fff;">-->
               <!--                         <i class="fas fa-chart-bar mat-icon f-24"  style="color:#2980b9;"></i>-->
               <!--                     </div>-->
               <!--                     <div class="col-8 cst-cont"  style="background:#2980b9;">-->
                                       
               <!--                         <p class="m-b-0">Fund</p>-->
                                        
               <!--                          <h5>Request</h5>-->
               <!--                     </div>-->
               <!--                 </div>-->
               <!--             </div>-->
               <!--         </div>-->
               <!--      </a>-->
               <!--     </div>-->
                    
               <!--</div>-->
                   <div class="row icons_section">
                       
                       <?php
                       $tpinuser = $con->query("SELECT * FROM `tpin` WHERE `USER_ID` = '$my_id' AND STATUS = 'active'")->fetch_assoc();
                       
                       if(!empty($tpinuser)){
                       
                       ?>
                       <div id="tpinbox" class="col-md-6 m-auto">
     
      <p class="login-box-msg text-secoundary">Your mPIN was already created, if you want to change it, click on the button below we send OTP on your registered mobile number and email id.</p>
      <p style="font-weight:700;" class="error login-box-msg text-danger"></p>

      <form id="tpinform" method="post" autocomplete="off">
          <input type="hidden" id="cuserid" value="<?php echo $my_id ?>">
        <div class="row">
           <div class="col-12 mt-2">
            <button  type="button" id="tpinchangebtn" class="btn btn-primary btn-block">change mPIN</button>
          </div>
          
        </div>
      </form>

      </div> 
      
      <?php
                       }else{
      ?>
                       
                       
                       <div id="stpinotpnbox" class="col-md-6 m-auto">
      <p class="login-box-msg text-success" style="font-size:1rem;font-weight:600;color:#276569;" id="stpinotp_msg">
          
           Your mPIN is not created, you must first create your mPIN.Click this button to send OTP on your registered mobile number
      
      </p>
      <p style="font-weight:700;" class="error login-box-msg text-danger"></p>

      <form method="post" autocomplete="off">
          <input type="hidden" id="otpuid" value="<?php echo $my_id ?>">
        <div class="row">
           <div class="col-12 mt-2">
            <button  type="button" id="stpinotpbtn" class="btn btn-primary btn-block">Send OTP</button>
          </div>
          
        </div>
      </form>

      </div>  
      
      
       <div id="tpinotpnbox" class="col-md-6 m-auto">
      <p class="login-box-msg text-success" style="font-size:1rem;font-weight:600;color:#276569;" id="tpinotp_msg">
          
           OTP Send
      
      </p>
      <p style="font-weight:700;" class="error login-box-msg text-danger"></p>

      <form id="tpinotp_form" method="post" autocomplete="off">
          
          <div class="input-group">
          <input type="number" name="tpinotp" id="tpinotp" class="form-control" placeholder="Enter OTP">
          <input type="hidden" id="ajaxotp" class="form-control">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        
        <button type="button" style="background: none;color: #276569;border: none;" id="tpinrotp" class="btn btn-primary">Resend OTP</button><span style="color: #276569;font-weight:700;" class="countdown"></span>
         
         
        <div class="row">
           <div class="col-12 mt-2">
            <button  type="button" id="tpinotpbtn" class="btn btn-primary btn-block">Submit</button>
          </div>
          
        </div>
      </form>

      </div>  
                       
                       
                       
                        <div id="ctpinbox" class="col-md-6 m-auto">
      <p class="login-box-msg text-success" style="font-size:1rem;font-weight:600;color:#276569;">
          
           Create your mPIN
      
      </p>
      <p style="font-weight:700;" class="error login-box-msg text-danger"></p>
      <p style="font-weight:700;" class="login-box-msg text-success" id="success"></p>

      <form id="sotp_form" method="post" autocomplete="off">
         
          <div class="input-group mb-3">
          <input type="number" name="otp" id="tpin" class="form-control" placeholder="Enter mPIN">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="number" name="otp" id="ctpin" class="form-control" placeholder="Confirm mPIN">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="row">
           <div class="col-12 mt-2">
            <button  type="button" id="ctipnbtn" class="btn btn-primary btn-block">Submit</button>
          </div>
          
        </div>
      </form>

      </div>  
      
      <?php } ?>
                        
                                        
                                        
                         <div id="cmpinotpbox" class="col-md-6 m-auto">
      <p class="login-box-msg text-success" style="font-size:1.3rem;font-weight:600;" id="otp_msg">We send OTP on your registered mobile number </p>
     <p style="font-weight:700;" class="error login-box-msg text-danger"></p>
      <form id="otp_form" method="post" autocomplete="off">
           
        <div class="input-group">
          <input type="number" name="otp" id="cmpinotp" class="form-control" placeholder="Enter OTP">
          <input type="hidden" id="userotp" class="form-control">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <button type="button" style="background: none;color: #276569;border: none;" id="cmpinrotpbtn" class="btn btn-primary">Resend OTP</button><span style="color: #276569;font-weight:700;" class="countdown"></span>
       
        <div class="row">
           <div class="col-12 mt-2">
            <button  type="button" id="cmpinotpbtn" class="btn btn-primary btn-block">Submit</button>
          </div>
          
        </div>
      </form>

      </div>  
      
      <div id="cahngempinbox" class="col-md-6 m-auto">
      <p class="login-box-msg text-success">Change Your mPIN </p>
      <p style="font-weight:700;" class="error login-box-msg text-danger"></p>
      <p style="font-weight:700;" class="login-box-msg text-success" id="success"></p>

      <form id="changempin_form" method="post" autocomplete="off">
           
        <div class="input-group mb-3">
          <input type="password" id="ompin" class="form-control" placeholder="Current mPIN">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        
         <div class="input-group mb-3">
             
             <input type="password"  id="nmpin" class="form-control" placeholder="New mPIN">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
       </div>
        <div class="row">
           <div class="col-12 mt-2">
            <button  type="button" id="cmpinbtn" class="btn btn-primary btn-block">Change</button>
          </div>
          
        </div>
      </form>

      </div>
                                        
               </div>
              </div>
              <!-- ./card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-light">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
 <?php
    include("include/BottomBar.php");
 ?>
 
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="plugins/raphael/raphael.min.js"></script>
<script src="plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="plugins/jquery-mapael/maps/usa_states.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>

<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard2.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<script>

function timer(){

					var timer2 = "02:00";
					var interval = setInterval(function() {


					  var timer = timer2.split(':');
					  //by parsing integer, I avoid all extra string processing
					  var minutes = parseInt(timer[0], 10);
					  var seconds = parseInt(timer[1], 10);
					  --seconds;
					  minutes = (seconds < 0) ? --minutes : minutes;
					  
					  seconds = (seconds < 0) ? 59 : seconds;
					  seconds = (seconds < 10) ? '0' + seconds : seconds;
					  //minutes = (minutes < 10) ?  minutes : minutes;
					  $('.countdown').html("Resend otp in:  <b class='text-primary'>"+ minutes + ':' + seconds + " seconds </b>");
					  //if (minutes < 0) clearInterval(interval);
					  if ((seconds <= 0) && (minutes <= 0)){
					  	clearInterval(interval);
					  	$('.countdown').html('');
					  	$('#cmpinrotpbtn,#tpinrotp').css("display","block");
					  } 
					  timer2 = minutes + ':' + seconds;
					}, 1000);

				}
    
    $(document).ready(function() {

	//mpin create js code

	$("#stpinotpbtn").click(function() {
		$("#stpinotpbtn").html("Please Wait...");
		var uid = $("#otpuid").val();
		$.ajax({
			url: "Backend/Login/change_mpin.php",
			method: "POST",
			data: {
				id: uid,
				pid: 1
			},
			success: function(response){
			   
				let rslt = JSON.parse(response);
				if (rslt.response_code == 1) {
					$("#stpinotpbtn").html("Submit");
					$("#ajaxotp").val(rslt.otp);
					$("#stpinotpnbox").hide();
					$("#tpinotpnbox").show();
					$(".error").hide();
				} else if (rslt.response_code == 3){
					$(".error").show();
					$(".error").html("Something went wrong OTP not send on this number !");
				}

			}
		});

	});


// 	 Create Mpin Resend OTP
	
	$("#tpinrotp").click(function() {
		var uid = $("#otpuid").val();
		$.ajax({
			url: "Backend/Login/change_mpin.php",
			method: "POST",
			data: {
				id: uid,
				pid: 1
			},
			success: function(response){
			   
				let rslt = JSON.parse(response);
				if (rslt.response_code == 1) {
					$("#ajaxotp").val(rslt.otp);
					$(".error").hide();
					Swal.fire({
                    icon: "success",
                    title: "Hurray!",
                    button: "Okay",
                    text: "Resend OTP Send Successfully..!",
                }).then(function(){
                    timer();
                    $('#tpinrotp').css("display","none");
                });
				} else if (rslt.response_code == 3){
				 Swal.fire({
                    icon: "error",
                    title: "OOPS!",
                    button: "Close",
                    text: "Resend OTP Send Unsuccessfull..!",
                });
				}

			}
		});

	});

	$("#tpinotpbtn").click(function() {
		$("#tpinotpbtn").html("Please Wait...");
		var totp = $("#tpinotp").val();
		var aotp = $("#ajaxotp").val();

		if (totp != "") {
			$.ajax({
				url: "Backend/Login/change_mpin.php",
				method: "POST",
				data: {
					tpinotp: totp,
					ajaxotp : aotp,
					pid: 2
				},
				success: function(response) {

					let rslt = JSON.parse(response);
					if (rslt.response_code == 1) {
						$("#tpinotpbtn").html("Submit");
						$("#tpinotpnbox").hide();
						$("#ctpinbox").show();
						$(".error").hide();
					} else if (rslt.response_code == 3){
						$(".error").show();
						$(".error").html("Wrong OTP Please Enter Valid OTP !");
					}

				}
			});


		} else {
			$(".error").html("Please Enter OTP !");
		}
	});


	$("#ctipnbtn").click(function() {
		$("#ctipnbtn").html("Please Wait...");
		var tpin = $("#tpin").val();
		var ctpin = $("#ctpin").val();

		if (tpin == ctpin) {

			$.ajax({
				url: "Backend/Login/change_mpin.php",
				method: "POST",
				data: {
					utpin: tpin,
					uctpin: ctpin,
					pid: 3
				},
				success: function(response) {

					let rslt = JSON.parse(response);
					if (rslt.response_code == 1) {
						$("#ctipnbtn").html("Submit");
						$("#success").show();
						$("#success").html("Your mPIN has been created <a href='<?php echo $row['DOMAIN']?>/Agent/'>Go to Dashboard</a>");
						$(".error").hide();
					} else if (rslt.response_code == 3){
						$("#success").hide();
						$(".error").show();
						$(".error").html("Something went wrong contact to admin !");
					}


				}
			});

		} else {
			$(".error").html("mPIN Does Not Matched !");
		}

	});



	//change mPIN js code 

	$("#tpinchangebtn").click(function() {
		$("#tpinchangebtn").html("Please Wait...");
		var uid = $("#cuserid").val();
		$.ajax({
			url: "Backend/Login/change_mpin.php",
			method: "POST",
			data: {
				id: uid,
				pid: 4
			},
			success: function(response) {

				let rslt = JSON.parse(response);
				if (rslt.response_code == 1) {
					$("#tpinchangebtn").html("Submit");
					$("#userotp").val(rslt.otp);
					$("#tpinbox").hide();
					$("#cmpinotpbox").show();
					$(".error").hide();
				} else if (rslt.response_code == 3) {
					$(".error").show();
					$(".error").html("Something went wrong OTP not send on this number !");
				}

			}
		});

	});
	
	
	// 	Change Mpin Resend OTP

$("#cmpinrotpbtn").click(function() {
		var uid = $("#cuserid").val();
		$.ajax({
			url: "Backend/Login/change_mpin.php",
			method: "POST",
			data: {
				id: uid,
				pid: 4
			},
			success: function(response){
			   
				let rslt = JSON.parse(response);
				if (rslt.response_code == 1) {
					$("#userotp").val(rslt.otp);
					$(".error").hide();
					Swal.fire({
                    icon: "success",
                    title: "Hurray!",
                    button: "Okay",
                    text: "Resend OTP Send Successfully..!",
                }).then(function(){
                    timer();
                    $('#cmpinrotpbtn').css("display","none");
                });
				} else if (rslt.response_code == 3){
				 Swal.fire({
                    icon: "error",
                    title: "OOPS!",
                    button: "Close",
                    text: "Resend OTP Send Unsuccessfull..!",
                });
				}

			}
		});

	});


	$("#cmpinotpbtn").click(function() {
	    $("#cmpinotpbtn").html("Please Wait...");
		var cmpinotp = $("#cmpinotp").val();
		var uotp = $("#userotp").val();

		if (cmpinotp != "") {
			$.ajax({
				url: "Backend/Login/change_mpin.php",
				method: "POST",
				data: {
					cmotp: cmpinotp,
					userotp: uotp,
					pid: 5
				},
				success: function(response) {

					let rslt = JSON.parse(response);
					if (rslt.response_code == 1) {
						$("#cmpinotpbtn").html("Submit");
						$("#cmpinotpbox").hide();
						$("#cahngempinbox").show();
						$(".error").hide();
					} else if (rslt.response_code == 3) {
						$(".error").show();
						$(".error").html("Wrong OTP Please Enter Valid OTP !");
					}

				}
			});


		} else {
			$(".error").html("Please Enter OTP !");
		}
	});


	$("#cmpinbtn").click(function() {
		$("#cmpinbtn").html("Please Wait...");
		var ompin = $("#ompin").val();
		var nmpin = $("#nmpin").val();

		$.ajax({
			url: "Backend/Login/change_mpin.php",
			method: "POST",
			data: {
				crrntmin: ompin,
				newmpin: nmpin,
				pid: 6
			},
			success: function(response) {

				let rslt = JSON.parse(response);
				if (rslt.response_code == 1) {
					$("#cmpinbtn").html("Submit");
					$("#success").show();
					$("#success").html("Your mPIN has been changed <a href='<?php echo $row['DOMAIN']?>/Agent/'>Go to Dashboard</a>");
					$(".error").hide();
				} else if (rslt.response_code == 3) {
					$("#success").hide();
					$(".error").show();
					$(".error").html("Current mPIN was worng ! Plaese Enter Correct mPIN");
				}


			}
		});

	});

});
</script>


</body>
</html>
