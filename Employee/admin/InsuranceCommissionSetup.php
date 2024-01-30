<?php
include("../Db/config.php");
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
  
  
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>

<body class="hold-transition light-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__wobble" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
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
            <h1 class="m-0">Insurance Commission</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Insurance Commission</li>
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
                <h3 class="card-title">Insurance Commission Setup</h3>
              </div>
              <!-- /.card-header -->
                <?php 
                 $res=$con->query("SELECT * FROM `insurance_coupon` WHERE ID='1'")->fetch_assoc();
                ?>
                <div class="card-body">
                 <form id="setE-TaxInsurance" name="setE-TaxInsurance">
                  <div class="form-row d-flex justify-content-around ">
                     <div class="form-group col-md-3">
                        <label for="exampleInputEmail1">Charge</label>
                        <input type="text" class="form-control" id="charge" name="charge" value="<?php echo $res['CHARGE'] ?>">
                      </div>
                     <div class="form-group col-md-2">
                        <label for="exampleInputEmail1">RT Commission</label>
                        <input type="text" class="form-control" id="rt_comm" name="rt_comm" value="<?php echo $res['RT_COMM'] ?>">
                      </div>
                      <div class="form-group col-md-2">
                        <label for="exampleInputEmail1">DT Commission</label>
                        <input type="text" class="form-control" id="dt_comm" name="dt_comm" value="<?php echo $res['DT_COMM'] ?>">
                      </div>
                     <div class="form-group col-md-2">
                        <label for="exampleInputEmail1">GST</label>
                        <input type="number" class="form-control" id="tds" name="tds" value="<?php echo $res['TDS'] ?>">
                      </div>
                     <div class="form-group col-md-2">
                        <label for="exampleInputEmail1">TDS</label>
                        <input type="number" class="form-control" id="gst" name="gst" value="<?php echo $res['GST'] ?>">
                      </div>
                </div>

                     
                </div>
                <div class="card-footer d-flex justify-content-center">
                  <input type="hidden" value="1" name="set_Insurance"/>    
                  <button type="button" id="InsuranceCommSetup" class="btn btn-primary">Update Commission Package</button>
                </div>
                </form>
                </div>
                  <!-- /.card-body -->
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

  <!--==============  View Profile Modal ===================-->

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
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- Page specific script -->
<script>
  $(document).ready(function(){
          $("#InsuranceCommSetup").click(function(e){
              e.preventDefault();
                 $.ajax({
                  url : "handler/SetE-TaxServicespanComm.php",
                  type : "POST",
                  data : $("#setE-TaxInsurance").serialize()+'&pageid=1',
                  success : function(data)
                      {
                      if(data == 1){
                          Swal.fire({
                                  icon: "success",
                                  title: "Hurray!",
                                  button: "Okay",
                                  text: 'Insurance Commision Add Successfully.',
                                }).then(function(){ 
                                  location.replace("InsuranceCommissionSetup.php");
                        });
                               
                      }else{
                         Swal.fire({
                                  icon: "error",
                                  title: "OOPS!",
                                  button: "Close",
                                  text: 'Insurance Commision Add Unsuccessfull...!',
                                });
                      }
                    }
                  
                    //   alert(data);

              });
          });
      });  
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
