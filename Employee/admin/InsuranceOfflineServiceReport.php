
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Insurance Report</title>

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
   <!--Sweet Alert -->
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="hold-transition light-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
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
            <h1 class="m-0">Insurance Report</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Insurance Report</li>
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
                <h3 class="card-title">Insurance Report Data Table</h3>
              </div>
               <!--/.card-header -->
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


  <!--Loan Table Modal-->
 <div class="modal fade" id="insurance_details" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div id="idm" class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Inusrance Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div style="height: 50vh;overflow-y: auto;" class="modal-body">
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="insurancemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Approve Deatils</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div style="height: 50vh;overflow-y: auto;" class="modal-body">
       <form method="post" class="ins_Form" id="approveInsuranceForm">
             <div>
                  <div class="form-row d-flex justify-content-around">
                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">Upload Insurance Document*</label>
                        <input type="file" class="form-control" name="insdoc" id="insdoc" required> 
                    </div>
                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">RT Commission</label>
                        <input type="text" name="rt_comm" class="form-control">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">DT Commission</label>
                        <input type="text" name="dt_comm" class="form-control">
                        <input type="hidden" id="insid" name="insid">
                        <input type="hidden" id="pg" name="pageid" value="4">
                    </div>
                     <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">Remark</label>
                        <input type="text" name="remark" id="remarks" class="form-control">
                        
                    </div>
                </div>    
                  <div class="card-footer d-flex justify-content-center">
                  <input type="submit" id="Approv_btn" value="Submit" class="btn btn-primary">
                </div>
             </div>
            </form>
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
        url:"handler/insurance_report.php",
        method:"POST",
        data:{pageid:1 ,formdate:fromd,todate:tod},
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


//  $("#datesbtn").on("click",function(){
    
//     var fromd = $("#fromdate").val();
//     var tod = $("#todate").val();
        
//         $.ajax({
//             url : "handler/insurance_report.php",
//             type : "POST",
//             data : {formdate:fromd,todate:tod,pageid:5},
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
//     });


//view details modal code here

$(document).on("click","#mbtn",function(){
        var mid = $(this).data("mid");
        $.ajax({
        url:"handler/insurance_report.php",
        method:"POST",
        data:{vid:mid,pageid:2},
        success:function(data)
        {
          $('#idm .modal-body').html(data);
        }
        });
    });




// // Reject Form Insurance Request
$(document).on("click","#rejectbtn",function(e){
        e.preventDefault();
    var id = $('#rejectbtn').data("uid");
    
    $.ajax({
        url:"handler/insurance_report.php",
        method:"POST",
        data:{uid:id,status:"Rejected",pageid:3},
        success:function(data)
        {
          if(data == 1){
              Swal.fire({
                      icon: "success",
                      title: "Hurray!",
                      button: "Okay",
                      text: 'Insurance Reject Successfully.',
                    }).then(function(){ 
                     load_data();
            });
          }
          else if(data == 2){
              Swal.fire({
                      icon: "error",
                      title: "OOPS!",
                      button: "Okay",
                      text: 'Insurance already Rejected.',
                    }).then(function(){ 
                     load_data();
            });
          }
          else{
              popup('error' , 'OOPS..!' ,"Insurance Reject Unsuccessfully !");
          }
        }
      });
});


$(document).on("click","#approvbtn",function(){
    $("#insid").val($(this).data("uid"));
});

// // Approve Form Insurance Request
$("#approveInsuranceForm").submit(function(e){
  e.preventDefault();
  $.ajax({
        url:"handler/insurance_report.php",
        method:"POST",
        data:new FormData(this),
        contentType:false,
        cache:false,
        processData:false,
        success:function(data)
        {
          if(data == 1){
              Swal.fire({
                      icon: "success",
                      title: "Hurray!",
                      button: "Okay",
                      text: 'Insurance Approved Successfully.',
                    }).then(function(){ 
                        $("#insurancemodal").modal("hide");
                     load_data();
            });
                              
          }else{
              popup('error' , 'OOPS..!' ,"Insurance Approved Unsuccessfull!");
              $("#insurancemodal").modal("hide");
          }
        }
      });
   });

</script>

</body>
</html>
