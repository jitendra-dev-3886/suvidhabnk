<?php
session_start();
include("../Db/config.php");

if(!isset($_GET["type"])){
$mode = $_GET["mode"];
}else{
$type = $_GET["type"];
}

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
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
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
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><?php echo $type.$mode ?> LIC Report</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active"><?php echo $type .$mode ?> Report</li>
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
                <h3 class="card-title"><?php echo $type.$mode ?> LIC Payment Report Data</h3>
              </div>
              <!-- /.card-header -->
              
              <div class="row">
              <div class="search px-4 col-md-4">
                <label>From : </label>
                <input type="date" id="fromdate" value="<?php echo date("Y-m-d") ?>" class="form-control">
                </div>
                <div class="search px-4 col-md-4">
                <label>To : </label>
                <input type="date" id="todate" value="<?php echo date("Y-m-d") ?>" class="form-control">
                 </div>
                <div class="search px-4 col-md-2">
                <span id="datesbtn" class="searchicon" onclick="load_data()"><i class="fas fa-search"></i></span>
                 </div>
                </div>
                <h2 id="loadingtext" class="px-4"></h2>
              
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
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->


<!--========= Edit Modal =========-->
  
  <div class="modal fade" id="exampleModaleditcompany" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Edit</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
            <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <!-- /.card -->
            <div class="card">
<div class="card-body">
                
                <div class="form-row d-flex justify-content-around ">
                    
                      <div class="form-group col-md-10">
                        <label for="exampleInputEmail1">Name</label>
                        <input type="text" class="form-control" placeholder="Name">
                      </div>
                      <div class="form-group col-md-10">
                        <label for="exampleInputEmail1">agent id.</label>
                        <input type="text" class="form-control" placeholder="agent id.">
                      </div>
                      <div class="form-group col-md-10">
                        <label for="exampleInputEmail1">agent mobile no.</label>
                        <input type="text" class="form-control" placeholder="agent mobile no.">
                      </div>
                </div>
                </div>
                <div class="card-footer d-flex justify-content-center">
                  <button class="btn btn-primary" type="submit" onclick="bootstrapAlert()">Transaction</button>
                </div>
                </div>
            
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
        </form>
      </div>
      <div class="modal-footer">
        
      </div>
    </div>
  </div>
</div>
  <!--========= Company Edit Modal =========-->

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
    // $(document).ready(function(){
    // Load Table Records
     load_data();

    function load_data()
    {
        $("#loadingtext").text("Wait. Loading Data");
         var fromd = $("#fromdate").val();
    var tod = $("#todate").val();
      $.ajax({
        url:"handler/LIC_Report.php",
        method:"POST",
        data:{category:"<?php echo $type ?>",mode:"<?php echo $mode ?>",pageid:1,formdate:fromd,todate:tod},
        success:function(data)
        {
          $("#loadingtext").text("");
          $('#tbcard').html(data);
          
           $("#example1").DataTable({
      "responsive": true, "lengthChange": true, "autoWidth": false,
        pageLength: 5,
        lengthMenu: [5, 10, 20, 50, 100, 200, 500,1000],
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": false,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
        }
      });
    }
    
    
//      $("#datesbtn").on("click",function(){
    
//     var fromd = $("#fromdate").val();
//     var tod = $("#todate").val();
        
//         $.ajax({
//             url : "handler/BBPS_Report.php",
//             type : "POST",
//             data : {formdate:fromd,todate:tod,category:"<?php echo $type ?>",mode:"<?php echo $mode ?>",pageid:2},
//             success : function(response){
//                 $('#tbcard').html(response);
                
//                 $("#example1").DataTable({
//       "responsive": true, "lengthChange": false, "autoWidth": false,
//       "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
//     }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
//     $('#example2').DataTable({
//       "paging": true,
//       "lengthChange": false,
//       "searching": false,
//       "ordering": true,
//       "info": true,
//       "autoWidth": false,
//       "responsive": true,
//     });
//             }
//         });
    
// });

    
    
//     });
</script>
</body>
</html>
