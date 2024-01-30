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

<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
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
            <h1 class="m-0">Pan Card Commission</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Pan Card Commission</li>
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
                <h3 class="card-title">Pan Card Commission Setup</h3>
              </div>
              <!-- /.card-header -->
                <?php 
                 $res=$con->query("SELECT * FROM `pan_charge` WHERE ID='1'")->fetch_assoc();
                ?>
                <div class="card-body">
                 <form id="setE-TaxPan" name="setE-TaxPan">
                  <div class="form-row d-flex justify-content-around ">
                     <div class="form-group col-md-3">
                        <label for="exampleInputEmail1">E Coupon Price</label>
                        <input type="text" class="form-control" id="coupon_price" name="coupon_price" value="<?php echo $res['E_PAN'] ?>">
                      </div>
                     <div class="form-group col-md-3">
                        <label for="exampleInputEmail1">P Coupon Price</label>
                        <input type="text" class="form-control" id="coupon_price" name="coupon_price2" value="<?php echo $res['P_PAN'] ?>">
                      </div>
                     <div class="form-group col-md-2">
                        <label for="exampleInputEmail1">DS Commission</label>
                        <input type="text" class="form-control" id="ds_comm" name="ds_comm" value="<?php echo $res['DS_COM'] ?>">
                      </div>
                      <div class="form-group col-md-2">
                        <label for="exampleInputEmail1">MS Commission</label>
                        <input type="text" class="form-control" id="ms_comm" name="ms_comm" value="<?php echo $res['MS_COM'] ?>">
                      </div>
                </div>

                     
                </div>
                <div class="card-footer d-flex justify-content-center">
                  <input type="hidden" value="1" name="set_pan"/>    
                  <button type="button" id="PanCommSetup" class="btn btn-primary">Update Commission Package</button>
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
          $("#PanCommSetup").click(function(e){
              e.preventDefault();
                 $.ajax({
                  url : "handler/SetE-TaxServicespanComm.php",
                  type : "POST",
                  data : $("#setE-TaxPan").serialize(),
                  success : function(data)
                      {
                      if(data == 1){
                          Swal.fire({
                                  icon: "success",
                                  title: "Hurray!",
                                  button: "Okay",
                                  text: 'Pan Commision Add Successfully.',
                                }).then(function(){ 
                                  location.replace("SetE-TaxServicesPanCardCommission.php");
                        });
                                $("#setE-TaxPan")[0].reset();
                      }else{
                          popup('error' , 'OOPS..!' ,"Pan Commision Failed !");
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
