<?php
session_start();
include("../Db/config.php");
require("include/Auth.php"); // user auth
// include("Backend/Functions/all_function.php"); // for create token

$row = $con->query("SELECT * FROM `websetting`")->fetch_assoc();

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Main Wallet Report </title>

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
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>

<body class="hold-transition dark-light sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
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
            <h1 class="m-0">Fund Transfer Report Main Wallet</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Fund Transfer Report Main Wallet</li>
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
                <h3 class="card-title">Main Wallet Report</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                  <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    
                    <th>Member ID</th>
                    <th>Member Name </th>
                    <th>Member Mobile No </th>

                    <th>Total Debit</th>
                    <th>Total Credit</th>
                    <th>Balance</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php
                    $debitrep = $con->query("select SUM(AMOUNT) from report where FUND_TYPE='debit' and USER_ID='$usid' and WALLET='MAIN' ")->fetch_assoc();
                    $creditrep = $con->query("select SUM(AMOUNT) from report where FUND_TYPE='credit' and USER_ID='$usid' and WALLET='MAIN' ")->fetch_assoc();
                     $memeberid = $con->query("SELECT * FROM user WHERE ID = '$usid'")->fetch_assoc();
                    ?>
                    <tr>
                        
                        <td><?php echo $memeberid["PARTNER_ID"]; ?></td>
                        <td><?php echo $user['FIRST_NAME']." ".$user['LAST_NAME'] ?></td>
                        <td><?php echo $user['MOBILE'] ?></td>
                        <td><?php echo number_format(($debitrep['SUM(AMOUNT)'] == "") ? 0:$debitrep['SUM(AMOUNT)'] , 2);   ?></td>
                        <td><?php echo number_format(($creditrep['SUM(AMOUNT)'] == "") ? 0:$creditrep['SUM(AMOUNT)'], 2);   ?></td>
                        <td><?php echo number_format($user['MAIN_BAL'] , 2) ?></td>
                        <td><a class="btn btn-primary" href="WalletReport?type=MAIN" target="_blank">View Details </a></td>
                    </tr>
                  </tbody> 
                </table>
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
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
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
<script>

  $(document).ready(function () {
         
      //display code
      function getdata()
      {
          $.ajax({
              url: "handler/FundTransferReport.php",
              type: "POST",
              data : {id:1},
              success: function (data) {
               $("#agentfundtransfer").html(data);
              }
          });
      }
      
      getdata();
 });

</script>
</body>
</html>
