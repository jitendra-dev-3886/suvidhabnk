<?php
session_start();
// error_reporting(E_ALL);
// ini_set("display_errors" , 1);
include("../Db/config.php");

$row = $con->query("SELECT * FROM `websetting`")->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Ticket Request</title>

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
            <h1 class="m-0">Ticket Request</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Ticket Request</li>
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
                <h3 class="card-title">Ticket Request Data Table</h3>
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
<span id="datesbtn" class="searchicon"><i class="fas fa-search"></i></span>
 </div>
 

</div>

              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
        
                  <thead>
                  <tr>
                    <th>Sr.No</th>
                    <th>Ticket Id</th>
                    <th>Member Id</th>
                    <th>Mobile</th>
                    <th>Department</th>
                    <th>Transaction No.</th>
                    <th>Transaction Date</th>
                    <th>Description</th>
                    <th>Proof</th>
                    <th>Status</th>
                    <th>Issue Date</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody id="tbcard">
                      
                      
                </tfoot>
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
        <!--Loan Approved Modal-->
 <div class="modal fade bd-example" id="transfermodal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Ticket Transfer</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <form id="transform2">
             <div>
                  <div class="form-row d-flex justify-content-around">
                    <div class="form-group col-md-12">
                        <input type="hidden" id="id_u" name="id" class="form-control" required>					
                        <label for="exampleInputEmail1">Employee Id</label>
                        <input type="text" name="empId" id="empId" class="form-control" placeholder="Enter Employee Id">
                    </div>
                    
                    <div class="form-group col-md-12">
                        <label for="exampleInputEmail1">Remark</label>
                        <input type="text" name="remark" id="remarkt" class="form-control" placeholder="Enter Remark">
                    </div>
                </div>    
                  <div class="card-footer d-flex justify-content-center">
                  <input type="hidden"  name="type" value="1">
                  <button type="button" id="transfer" class="btn btn-primary">Submit</button>
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
        <h5 class="modal-title" id="exampleModalLongTitle">Ticket Update</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
                 <div class="" id="loanTables">
         <form id="updateSt">
             <div>
                <input type="hidden" id="upd_id" name="id" class="form-control" required>					
                  <div class="form-row d-flex justify-content-around">
                    <div class="form-group col-md-12">
                        <label for="exampleInputEmail1">Select Status</label>
                        <select class="form-control" name="status" id="status">
                            <option value="Pending">Pending</option>
                            <option value="Resolve">Resolve</option>
                            <option value="Under Process">Under Process</option>
                        </select>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="exampleInputEmail1">Remark</label>
                        <input type="text" name="remark" id="remarks" class="form-control" placeholder="Enter Remark">
                    </div>
                    
                </div>    
                  <div class="card-footer d-flex justify-content-center">
                  <input type="hidden" name="update_hid" value="3">
                  <button type="button" id="update" class="btn btn-primary">Submit</button>
                </div>
             </div>
        </form>
                 </div>
      </div>
</div>
        </div>
      </div>
      
      
      
       <div class="modal fade bd-example" id="complainmodal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Complain Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div id="compbody" class="modal-body">
       
      </div>
      </div>
        </div>
      </div>
      

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
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- Page specific script -->


<script>
    $(document).ready(function(){
    // Load Table Records
     load_data(6);

    function load_data(fromd='', tod='')
    {
      $.ajax({
        url:"handler/ticket_Support.php",
        method:"POST",
        data:{formdate:fromd,todate:tod,pageid:6},
        success:function(data)
        {
          $('#tbcard').html(data);
          
     $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "order": [[ 0, 'desc']],
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
    
});

//view complain details in ticket report code here
$(document).on('click','#view_complain',function(e){
    e.preventDefault();
    var id=$(this).data("cid");
    $.ajax({
        url:"handler/ticket_Request.php",
        type: "POST",
        data: {eid:id,pageid:1},
      success:function(data)
          {
         $("#compbody").html(data);
        }
    });
   
});



     //Update Get and set on popup from function
$(document).on('click','.transfer_tic',function(e) {
    $("#complainmodal").modal("hide");
    var id = $(this).attr("data-id");
    var Empl = $(this).attr("data-empid");
    $('#id_u').val(id);
    $('#empId').val(Empl);
});

$(document).on('click','#transfer',function(e) {
    
    var data = $("#transform2").serialize();
    $.ajax({
        data: data,
        type: "POST",
        url:"handler/ticket_Request.php",
      success:function(data)
          {
          if(data == 1){
              Swal.fire({
                      icon: "success",
                      title: "Hurray!",
                      button: "Okay",
                      text: 'Ticket TransferSuccessfully.',
                    }).then(function(){ 
                      location.replace("Ticket_Request.php");
            });
                //   $('#lmodal').modal('hide');
          }else{
              popup('error' , 'OOPS..!' ,"Failed To Transfer Ticket !");
          }
        }
    });
});

        // Update Transfer

$(document).on('click','.update',function(e) {
    $("#complainmodal").modal("hide");
    var uid = $(this).data("mid");
    var status = $(this).attr("data-status");
    $('#upd_id').val(uid);
    $('#status').val(status);
});


$(document).on('click','#update',function(e) {
    var data = $("#updateSt").serialize();
    $.ajax({
        data: data,
        type: "POST",
        url:"handler/ticket_Request.php",
      success:function(data)
          {
          if(data == 1){
              Swal.fire({
                      icon: "success",
                      title: "Hurray!",
                      button: "Okay",
                      text: 'Ticket Update Successfully.',
                    }).then(function(){ 
                      location.replace("Ticket_Request.php");
            });
                //   $('#lmodal').modal('hide');
          }else{
              popup('error' , 'OOPS..!' ,"Failed To Transfer Ticket !");
          }
        }
    });
});

</script>

</body>
</html>
