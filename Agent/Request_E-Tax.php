<?php
session_start();
// error_reporting(E_ALL);
// ini_set("display_errors" , 1);
include("../Db/config.php");
require("include/Auth.php"); // user auth
$etxtype = $_GET["type"];

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>E-Tax</title>

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
  

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!--<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />-->


    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body class="hold-transition light-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
       <div id="loading_ajax" style="width: 100%;height: 130%;position: absolute;top: 0;left: 0;background: #00000038; background-attachment:fixed; z-index: 22222;display: none;"></div>
      
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__wobble" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" width="150">
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
            <h1 class="m-0">New TicketRise </h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">TicketRise</li>
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
                <h3 class="card-title">Fill E-Tax Form</h3>
               
              </div>
              
              <!-- /.card-header -->
              <!-- form start -->
                <div class="card-body">
        <div class="container">
           
            <div class="row d-flex justify-content-center">
                <div class="col-md-12">
                    <div class="wizard">
                        <form id="etaxform" class="TicketRise_form" method="post">
                            <div class="tab-content">
                                <div class="row d-flex justify-content-center">
                                        <div class="col-md-3 mt-2" >
                                            <div class="form-group">
                                                <label>Selecte E-Tax</label>
                                                <select class="form-control" name="type" id="type">
                                                    <option value="">Select  E-Tax</option>
                                                    <?php if($etxtype == 'GST'){ ?>
                                                    <option selected value="GST">GST Registration</option>
                                                    <?php }else if($etxtype == 'TDS'){ ?>
                                                    <option selected value="TDS">TDS Retrun</option>
                                                    <?php }else if($etxtype == 'ITR'){ ?>
                                                    <option selected value="ITR">ITR Retrun</option>
                                                    <?php }else if($etxtype == 'Compamy'){ ?>
                                                    <option selected value="Company Registration">Company Registration</option>
                                                    <?php }else{ ?>
                                                    <option selected value="DSC">DSC Certificate</option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mt-2">
                                            <div class="form-group">
                                                 <label>Full Name</label>
                                                <input type="text" class="form-control" name="name" id="name"  placeholder="Full Name" autocomplete="off" />
                                            </div>
                                        </div>
                                        <div class="col-md-4 mt-2">
                                            <div class="form-group">
                                                 <label>Mobile Number</label>
                                                <input type="number" class="form-control" name="mobile" id="mobile"  placeholder="Mobile Number" autocomplete="off" />
                                                <input type="hidden" name="pageid" value="1" />
                                            </div>
                                        </div>
                                     
                                    </div>
                            </div>
                              <div class="card-footer d-flex justify-content-center">
                                    <div class="col-md-4">
                                        <input type="submit" class="btn btn-primary" id="etaxbtn" value="Submit">
                                    </div>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div> 
                <!--</div>-->
               </div>
                <!-- /.card-body -->

          
                

            </div>
            <!-- /.card -->
          </div>
       
        </div>
        <!-- /.row -->
        
      </div>
      <!-- /.container-fluid -->
    </section>

    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
  <!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="etaxotpmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Send an OTP on this number..!</h5>
        <button type="button" style="background:none;border:none;" class="btn-close" data-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
      </div>
      <div class="modal-body">
     <form method="post" id="etaxotpform">
         <div class="mb-3">
  <label for="formGroupExampleInput" class="form-label">Enter OTP here</label>
  <input type="hidden" id="etaxoldotp">
  <input type="hidden" id="etaxname">
  <input type="hidden" id="etaxmobile">
  <input type="hidden" id="etaxtype">
  <input type="number" class="form-control" id="etaxotp" placeholder="OTP">
  <button type="button" style="background: none;color: #276569;border: none;" id="retaxotpbtn" class="btn btn-primary">Resend OTP</button><span style="color: #276569;font-weight:700;" class="countdown"></span>
</div>
<p class="error-text mt-2 text-danger"></p>
     </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" id="etaxotpbtn" class="btn btn-primary">Submit E-tax</button>
      </div>
    </div>
  </div>
</div>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
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
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>


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
					  	$('#retaxotpbtn').css("display","block");
					  } 
					  timer2 = minutes + ':' + seconds;
					}, 1000);

				}

    $(document).ready(function(){
        
        $("#retaxotpbtn").click(function(e){
        
        $.ajax({
                url: "Backend/Etax/main.php",
                type: "POST",
                data: $("#etaxform").serialize(),
                beforeSend: function(xhr) {xhr.setRequestHeader('Token', localStorage.getItem('Token'));},
                success: function(data) {
                    let rslt = JSON.parse(data);
                    let rscode = rslt.response_code;
                    let message = rslt.message;
                    let otp = rslt.otp;
                    
                    if (rscode == 1) {
                        $("#etaxname").val($("#name").val());
                        $("#etaxmobile").val($("#mobile").val());
                        $("#etaxtype").val($("#type").val());
                        $("#etaxoldotp").val(otp);
                        
                        Swal.fire({
                    icon: "success",
                    title: "Hurray!",
                    button: "Okay",
                    text: "Resend OTP Send Successfully..!",
                }).then(function(){
                    timer();
                    $('#retaxotpbtn').css("display","none");
                });
                
                    }else{
                        
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
        
        
        
        $("#etaxform").submit(function(e) {
            e.preventDefault();
            
            $.ajax({
                url: "Backend/Etax/main.php",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function(xhr) {xhr.setRequestHeader('Token', localStorage.getItem('Token'));},
                success: function(data) {
                    let rslt = JSON.parse(data);
                    let rscode = rslt.response_code;
                    let message = rslt.message;
                    let otp = rslt.otp;

                    if (rscode == 1) {
                        $("#etaxname").val($("#name").val());
                        $("#etaxmobile").val($("#mobile").val());
                        $("#etaxtype").val($("#type").val());
                        $("#etaxoldotp").val(otp);
                        
                        Swal.fire({
                    icon: "success",
                    title: "Hurray!",
                    button: "Okay",
                    text: message,
                }).then(function(){
                    $('#retaxotpbtn').css("display","none");
                     $("#etaxotpmodal").modal("show");
                     timer();
                });
                        
                       
                        $("#etaxotpbtn").click(function(){

                            var otp = $("#etaxotp").val();
                            var name = $("#etaxname").val();
                            var mobile = $("#etaxmobile").val();
                            var type = $("#etaxtype").val();
                            var otphash = $("#etaxoldotp").val();

                            if (otp == ''){
                                $(".error-text").html("OTP field empty ! Please Enter OTP");
                            }else {

                                $.ajax({
                                    url: "Backend/Etax/main.php",
                                    type: "POST",
                                    data: {
                                        name,
                                        mobile,
                                        type,
                                        otp,
                                        otphash,
                                        applyEtax:"applyEtax"
                                    },
                                    beforeSend: function(xhr) {
                                        xhr.setRequestHeader('Token', localStorage.getItem('Token'));
                                    },
                                    success: function(data) {
                                        var res = JSON.parse(data);

                                        if (res.response_code == 1) {
                                            $("#etaxotpmodal").modal("hide");
                                            Swal.fire({
                                                icon: "success",
                                                title: "Hurray!",
                                                button: "Okay",
                                                text: res.message,
                                            }).then(function() {

                                                $("#etaxform")[0].reset();
                                            });
                                        } else {
                                            Swal.fire({
                                                icon: "error",
                                                title: "OOPS!",
                                                button: "Close",
                                                text: res.message,
                                            })
                                        }
                                    }
                                });

                            }
                        });

                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "OOPS!",
                            button: "Close",
                            text: message,
                        });
                    }
                },
            });

        });

    }); </script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
</body>
</html>
