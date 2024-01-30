<?php
session_start();
// error_reporting(E_ALL);
// ini_set("display_errors" , 1);
include("../Db/config.php");
require("include/Auth.php"); // user auth


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>WalletTransfer</title>

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
            <h1 class="m-0">WalletTransfer </h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">WalletTransfer</li>
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
                <h3 class="card-title">Request WalletTransfer</h3>
               
              </div>
              <!-- /.card-header -->
              <!-- form start -->
                <div class="card-body">
        <div class="container">
           
            <div class="row d-flex justify-content-center">
                <div class="col-md-12">
                    <div class="wizard">
                        
                        <form id="walletForm">
                            <div class="tab-content" id="main_form">
                                <div class="tab-pane active" role="tabpanel" id="step1">
                                    <h3 class="text-center text-primary">WalletTransfer</h3>
                                     <hr>
                                    <div class="row">
                                        <div class="col-md-4 mt-3">
                                            <h4 class="text-primary">WalletTransfer </h4>
                                        </div>
                                        <div class="col-md-4 mt-2" style="display:none;">
                                          
                                        </div>
                                        <div class="col-md-4 mt-2">
                                            <div class="form-group">
                                                <input type="number" class="form-control" name="aeps_to_main" id="aeps_to_main" placeholder="Enter Amount Request" autocomplete="off" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                              <div class="card-footer d-flex justify-content-center">
                                    <div class="col-md-4">
                                        <button type="submit" class="btn btn-primary" name="walletEx" id="walletEx">Request</button>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script>
// step1
$(document).ready(function () {
             $("#walletEx").click(function(e){
              e.preventDefault();
            //   alert("Clicked me");
                 $.ajax({
                  url : "../mobile_phone/add_fund/exchange_fund.php",
                  type : "POST",
                  data : $("#walletForm").serialize(),
                  success : function(data){
                      alert(data);
                      $('#walletForm')[0].reset();
                  }
              });
              
              
          });
});

</script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>

<script src="dist/js/demo.js"></script>


</body>
</html>
