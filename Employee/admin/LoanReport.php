<?php
session_start();
// error_reporting(E_ALL);
// ini_set("display_errors" , 1);
include("../Db/config.php");
$rows_id = $con->query("SELECT * FROM `loan_request`")->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Loan Report</title>

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
            <h1 class="m-0">Loan Report</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Loan Report</li>
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
                <h3 class="card-title">Loan Report Data Table</h3>
              </div>
               <!--/.card-header -->
              <div class="row">
              <div class="search px-4 col-md-4">
                <label>From : </label>
                <input type="date" id="formdate" value="<?php echo date("Y-m-d") ?>" class="form-control">
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
  <!--Loan Approved Modal-->
 <div class="modal fade bd-example" id="lmodal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Loan Approved</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <form method="post"  id="app_Loan">
             <div>
                  <div class="form-row d-flex justify-content-around">
                    <div class="form-group col-md-4">
                        <input type="hidden" id="id_u" name="id" class="form-control" required>					
                        <label for="exampleInputEmail1">Approved Loan Amount</label>
                        <input type="number" name="loanAmt" id="loanAmt" class="form-control" placeholder="Enter Amount">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="exampleInputEmail1">Admin Remarks</label>
                        <input type="text" name="remarks" id="remarks" class="form-control" placeholder="Enter Remarks">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">Upload Loan Document*</label>
                        <input type="file" class="form-control" name="insdoc" id="insdoc" required> 
                    </div>
                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">RT Commission</label>
                        <input type="text" name="rt_comm" class="form-control">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">DT Commission</label>
                        <input type="text" name="dt_comm" class="form-control">
                    </div>
                </div>    
                  <div class="card-footer d-flex justify-content-center">
                  <input type="hidden" name="type" value="3">
                  <button type="submit" id="Approv_btn" class="btn btn-primary">Submit</button>
                </div>
             </div>
            </form>
  <!--==============  View Profile Modal ===================-->
    </div>
            <!-- /.card -->
</div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>

  <!--Loan reject Modal-->
 <div class="modal fade bd-example" id="rejectmodal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Loan Reject</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <form id="loanreject">
             <div>
                  <div class="form-row d-flex justify-content-around">
                    <div class="form-group col-md-4">
                        <label for="exampleInputEmail1">Admin Remarks</label>
                        <input type="text" name="rejectremarks" id="rejectremarks" class="form-control" placeholder="Enter Remarks">
                    </div>
                </div>    
                  <div class="card-footer d-flex justify-content-center">
                  <input type="hidden" name="rejectid" id="rejectid" value="">
                  <button type="button" id="rejectbtn" class="btn btn-primary">Submit</button>
                </div>
             </div>
            </form>
  <!--==============  View Profile Modal ===================-->
    </div>
            <!-- /.card -->
</div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>

  <!--Loan Table Modal-->
 <div class="modal fade bd-example" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Loan Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
                 <div class="" id="loanTables">
                
              </div>
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

function RejectLoan(val){
    $("#rejectid").val(val);
    $("#rejectmodal").modal("show");
}

    // $(document).ready(function(){
    // Load Table Records
     load_data();
     LoanLoadData();
    function load_data()
    {
    $("#loadingtext").text("Wait. Loading Data");
    var fromd = $("#formdate").val();
    var tod = $("#todate").val();
      $.ajax({
        url:"handler/loan_report.php",
        method:"POST",
        data:{pageid:6,formdate:fromd,todate:tod},
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
// // Reject Form LoanRequest
$(document).on("click","#rejectbtn",function(e){
        e.preventDefault();
        
    var adminrem = $("#rejectremarks").val();
    var id = $("#rejectid").val();
  $.ajax({
        url:"handler/loan_report.php",
        method:"POST",
        data:{uid:id,status:"Reject",pageid:7, adminrem},
        success:function(data)
        {
          if(data == 1){
              Swal.fire({
                      icon: "success",
                      title: "Hurray!",
                      button: "Okay",
                      text: 'Loan Reject Successfully.',
                    }).then(function(){ 
                      location.replace("LoanReport.php");
            });
                              
          }else{
              alert(data)
            //   popup('error' , 'OOPS..!' ,"Loan Reject Unsuccessfully !");
          }
        }
      });
});

$(document).on('click','.loan_cls',function(e) {
    var id=$(this).attr("data-id");
    var loanamt=$(this).attr("data-loanamt");
    var adminrem=$(this).attr("data-rem");
    $('#id_u').val(id);
    $('#loanAmt').val(loanamt);
    $('#remarks').val(adminrem);
});

$("#app_Loan").submit(function(e){
  e.preventDefault();
  $.ajax({
        url:"handler/loan_report.php",
        method: "POST", 
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
                      text: 'Loan Approved Successfully.',
                    }).then(function(){ 
                      location.replace("LoanReport.php");
            });
                              
          }else{
              alert(data);
            
          }
        }

});
});

    // Loan Details.
      function LoanLoadData(){
       $(document).on("click","#mbtn",function(){
              var m_id = $(this).data("mid");
            //   console.log(m_id);
          $.ajax({
            url: "handler/loan_report.php",
            method:"POST",
            data: {mid: m_id,pageid:9},
            success:function(data)
             {
                 $('#loanTables').html(data);
             }
          });
        // console.log(m_id);
        

    });
      }
      
    //   load_data();

    // function load_data()
    // {
//       $("#datesbtn").on("click",function(){
//         $("#loadingtext").text("Wait. Loading Data");
//     var fromd = $("#formdate").val();
//     var tod = $("#todate").val();
    
//         $.ajax({
//             url : "handler/loan_report.php",
//             type : "POST",
//             data : {formdate:fromd,todate:tod,pageid:5},
//             success : function(response){
//                 $("#loadingtext").text("");
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
      
    // });
</script>

</body>
</html>
