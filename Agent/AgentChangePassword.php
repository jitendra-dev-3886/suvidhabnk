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
  <title>Dashboard </title>

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
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title">Change Password</h5>

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
                       
                       
                        <div id="sotpbox" class="col-md-6 m-auto">
      <p class="login-box-msg text-success" style="font-size:1.5rem;font-weight:600;" id="otp_msg"> click this button, We will send a OTP to your registred mobile number</p>
      <p style="font-weight:700;" class="error login-box-msg text-danger"></p>

      <form id="sotp_form" method="post" autocomplete="off">
          <input type="hidden" id="cuserid" value="<?php echo $my_id ?>">
        <div class="row">
           <div class="col-12 mt-2">
            <button  type="button" id="sotpbtn" class="btn btn-primary btn-block">Send OTP</button>
          </div>
          
        </div>
      </form>

      </div>  
                                        
                                        
                         <div id="otpbox" class="col-md-6 m-auto">
      <p class="login-box-msg text-success" style="font-size:1.3rem;font-weight:600;" id="otp_msg">We send OTP on this number </p>
     <p style="font-weight:700;" class="error login-box-msg text-danger"></p>
      <form id="otp_form" method="post" autocomplete="off">
           
        <div class="input-group">
          <input type="number" name="otp" id="otp" class="form-control" placeholder="Enter OTP">
            <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
          <button type="button" style="background: none;color: #276569;border: none;" id="cpassrotpbtn" class="btn btn-primary">Resend OTP</button><span style="color: #276569;font-weight:700;" class="countdown"></span>
       
        <div class="row">
           <div class="col-12 mt-2">
            <button  type="button" id="otpbtn" class="btn btn-primary btn-block">Submit</button>
          </div>
          
        </div>
      </form>

      </div>  
      
      <div id="changepassbox" class="col-md-6 m-auto">
      <p class="login-box-msg text-success" id="otp_msg">Change Your Password </p>
      <p style="font-weight:700;" class="error login-box-msg text-danger"></p>
      <p style="font-weight:700;" class="login-box-msg text-success" id="success"></p>

      <form id="changepass_form" method="post" autocomplete="off">
           
        <div class="input-group mb-3">
          <input type="text" id="opass" class="form-control" placeholder="Current Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        
         <div class="input-group mb-3">
             
             <input type="text"  id="npass" class="form-control" placeholder="New Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
       </div>
        <div class="row">
           <div class="col-12 mt-2">
            <button  type="button" id="changepassbtn" class="btn btn-primary btn-block">Change</button>
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
					  	$('#cpassrotpbtn').css("display","block");
					  } 
					  timer2 = minutes + ':' + seconds;
					}, 1000);

				}
    
    $(document).ready(function(){
        
        $("#sotpbtn").click(function(){
             $("#sotpbtn").html("Please Wait...");
             var uid = $("#cuserid").val();
                $.ajax({
                url : "Backend/Login/change_pass.php",
                method : "POST",
                data : {id:uid,pid:1},
                success : function(response){
                    
                     let rslt = JSON.parse(response);
                    if(rslt.response_code == 1){
                    $("#sotpbtn").html("Submit");
                     $("#sotpbox").hide();
                     $("#otpbox").show();
                      $(".error").hide();
                    }else if(rslt.response_code == 3){
                         $(".error").show();
                         $(".error").html("Something went wrong OTP not send on this number !");
                    }
                  
                }
            });
                 
        });
        
        
        // 	Change Pass Resend OTP

$("#cpassrotpbtn").click(function() {
		 var uid = $("#cuserid").val();
                $.ajax({
                url : "Backend/Login/change_pass.php",
                method : "POST",
                data : {id:uid,pid:1},
                success : function(response){
			   
				let rslt = JSON.parse(response);
				if (rslt.response_code == 1) {
					Swal.fire({
                    icon: "success",
                    title: "Hurray!",
                    button: "Okay",
                    text: "Resend OTP Send Successfully..!",
                }).then(function(){
                    timer();
                    $('#cpassrotpbtn').css("display","none");
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
        
    
     $("#otpbtn").click(function(){
             var otp = $("#otp").val();
             
             if(otp != ""){
                $.ajax({
                url : "Backend/Login/change_pass.php",
                method : "POST",
                data : {uotp:otp,pid:2},
                success : function(response){
                    
                     let rslt = JSON.parse(response);
                    if(rslt.response_code == 1){
                    $("#cpassbtn").html("Submit");
                     $("#otpbox").hide();
                     $("#changepassbox").show();
                      $(".error").hide();
                    }else if(rslt.response_code == 3){
                         $(".error").show();
                         $(".error").html("Wrong OTP Please Enter Valid OTP !");
                    }
                  
                }
            });
                 
           
             }else{
                 $(".error").html("Please Enter OTP !");
             }
        });
        
        
         $("#changepassbtn").click(function(){
             var cpass = $("#opass").val();
             var npass = $("#npass").val();
            
                $.ajax({
                url : "Backend/Login/change_pass.php",
                method : "POST",
                data : {crrntpass:cpass,newpass:npass,pid:3},
                success : function(response){
                    
                     let rslt = JSON.parse(response);
                    if(rslt.response_code == 1){
                    $("#cpassbtn").html("Submit");
                     $("#success").show();
                     $("#success").html("Your Password has been changed <a href='<?php echo $row['DOMAIN'] ?>/Agent/'>Go to Dashboard</a>");
                      $(".error").hide();
                    }else if(rslt.response_code == 3){
                        $("#success").hide();
                         $(".error").show();
                         $(".error").html("Current Password was worng ! Plaese Enter Correct Password");
                    }
                    
                   
                }
            });
                 
        });
        
    });
    
</script>


</body>
</html>
