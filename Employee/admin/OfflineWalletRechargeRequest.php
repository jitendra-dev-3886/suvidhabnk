<?php
session_start();
// error_reporting(E_ALL);
// ini_set("display_errors" , 1);
include("../Db/config.php");
include("Backend/Functions/all_function.php"); // for create token

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
  
  
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.css">
</head>

<body class="hold-transition ligt-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
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
            <h1 class="m-0">Offline Wallet Recharge Request</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Offline Wallet Recharge Request</li>
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

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Offline Wallet Recharge Request Table</h3>
              </div>
<!--               <div class="row">-->
<!--              <div class="search px-4 col-md-4">-->
<!--<label>From : </label>-->
<!--<input type="date" id="fromdate" value="<?php echo date("Y-m-d") ?>" class="form-control">-->
<!--</div>-->
<!--<div class="search px-4 col-md-4">-->
<!--<label>To : </label>-->
<!--<input type="date" id="todate" value="<?php echo date("Y-m-d") ?>" class="form-control">-->
<!-- </div>-->
<!--<div class="search px-4 col-md-2">-->
<!--<span style="cursor:pointer;" id="datesbtn" class="searchicon" onclick="load_data()"><i class="fas fa-search"></i></span>-->
<!-- </div>-->
<!--</div>-->
<h2 id="loadingtext" class="px-4"></h2>
              <!-- /.card-header -->
              <div class="card-body" id="tbcard">
                
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
  <aside class="control-sidebar control-sidebar-light">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
<?php
    include("include/BottomBar.php");
 ?>
</div>

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
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- Page specific script -->


<script>
    
     load_data();

    function load_data()
    {
        $("#loadingtext").text("Wait. Loading Data");
        $.ajax({
            url:"handler/offline_wallet.php",
            method:"POST",
            data:{pageid:4},
            success:function(data)
            {
                $("#loadingtext").text("");
                $('#tbcard').html(data);
                
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
            }
        });
    }
    
    //approve data
        $(document).on("click", ".approve", function() {
            var delid = $(this).data("mid");
            var amount = $(this).data("cdid");
            var uid = $(this).data("uid");
            $.ajax({
                url: "handler/offline_wallet.php",
                type: 'POST',
                data: {
                    eid: delid,
                    pageid: 2,
                    Amount: amount,
                    UserId: uid
                },
                success: function(data) {
                    if (data == 1) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success...',
                            text: 'Successfully Approved!',
                        }).then(function() {
                            location.replace("OfflineWalletRechargeRequest.php");
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Something went wrong!',
                        }).then(function() {
                            location.replace("OfflineWalletRechargeRequest.php");
                        });
                    }
                },
            });
        });
        
        
        
        
        
    //reject data
        $(document).on("click", ".reject", function() {
            var delid = $(this).data("miid");
            $.ajax({
                url: "handler/offline_wallet.php",
                type: 'POST',
                data: {
                    eid: delid,
                    pageid: 3
                },
                success: function(data) {
                    if (data == 1) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success...',
                            text: 'Successfully Rejected!',
                        }).then(function() {
                            location.replace("OfflineWalletRechargeRequest.php");
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Something went wrong!',
                        }).then(function() {
                            location.replace("OfflineWalletRechargeRequest.php");
                        });
                    }
                },
            });
        });

    
</script>

</body>
</html>