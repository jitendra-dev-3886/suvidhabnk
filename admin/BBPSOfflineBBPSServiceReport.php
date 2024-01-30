<?php
session_start();
include('../Db/config.php');

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
            <h1 class="m-0">Offline BBPS Report</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Offline BBPS Report</li>
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
                <h3 class="card-title">Offline BBPS Report</h3>
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
  
  <!--Loan Table Modal-->
 <div class="modal fade bd-example" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">BBPS Offline Status Update</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
                 <div class="" id="loanTables">
         <form id="updateSt">
             <div>
                <input type="hidden" id="upd_id" name="id">	
                
                  <div class="form-row d-flex justify-content-around">
                    <div class="form-group col-md-12">
                        <label for="exampleInputEmail1">Select Status</label>
                        <select class="form-control" name="status" id="status">
                            <option value="Pending">Pending</option>
                            <option value="Sucess">Sucess</option>
                            <option value="Failed">Failed</option>
                        </select>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="exampleInputEmail1">Remark</label>
                        <input type="text" class="form-control" name="remark" id="remark">
                         
                    </div>
                    
                </div>    
                  <div class="card-footer d-flex justify-content-center">
                  <button type="button" id="update" class="btn btn-primary">Submit</button>
                </div>
             </div>
        </form>
                 </div>
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
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>

load_data();

    function load_data()
    {
    var fromd = $("#fromdate").val();
    var tod = $("#todate").val();
      $.ajax({
        url:"handler/BBPS_Report.php",
        method:"POST",
        data:{mode:"OFFLINE",pageid:1,formdate:fromd,todate:tod},
        success:function(data)
        {
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

    $(document).ready(function(){

    $(document).on('click','#bbpsstschngbtn',function() {
    var uid = $(this).data("mid");
    $('#upd_id').val(uid);
});


$("#update").click(function(){
    var id = $("#upd_id").val();
    var sts = $("#status").val();
    var rmk = $("#remark").val();
    
     $.ajax({
        url: "handler/BBPS_Report.php",
        type: "POST",
        data: {uid:id,status:sts,remark:rmk,pageid:5},
        success: function(data) {
         
         if(data == 1){
             swal.fire({
  title: "Success!",
  text: "BBPS Offline Request Update Successfully",
  icon: "success",
  button: "Ok",
}).then(function(){
    load_data();
    $("#myModal").modal("hide");
    
});
         }else{
             swal.fire({
  title: "OOPS!",
  text: "BBPS Offline Request Update Unsuccessfull..!",
  icon: "error",
  button: "Close",
});
         }
         
        }
      })
    });

    
    
//      $("#datesbtn").on("click",function(){
    
//     var fromd = $("#fromdate").val();
//     var tod = $("#todate").val();
        
//         $.ajax({
//             url : "handler/BBPS_Report.php",
//             type : "POST",
//             data : {formdate:fromd,todate:tod,mode:"OFFLINE",pageid:2},
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


    
    // $(document).on("click","#mbtn",function(){
    //     var a_id = $(this).data("aid");
    //     $.ajax({
    //     url: "ajaxphp/select_modal.php",
    //     type: "POST",
    //     data: {aid: a_id },
    //     success: function(data) {
    //       $("#mwrap").html(data);
    //     }
    //   })
    // });
    
    //  $(document).on("change","#mlimit",function() {
    //   var page_limit = $(this).val();
      
    // loadTable(page_limit);
    // });
    
    
    });
</script>
</body>
</html>
