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
    <!--delete confirm modal -->
<div id="deleteEmployeeModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form>
				<div class="modal-header">						
					<h4 class="modal-title">Delete Record</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				</div>
				<div class="modal-body">
					<input type="hidden" id="id_d" name="id" class="form-control">					
					<p>Are You Sure you want to Delete Record?</p>
					<!--<p class="text-warning"><small>This action cannot be undone.</small></p>-->
				</div>
				<div class="modal-footer">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
					<button type="button" class="btn btn-danger" data-dismiss="modal"  id="delete">Delete</button>
				</div>
			</form>
		</div>
	</div>
</div>


<!--Update Modal-->
<div class="modal fade" id="update_user_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Update Operator</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body" >
            <div id='edit_modal'> 

            </div>
        </div>
       
      </div>
    </div>
  </div>
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
            <h1 class="m-0">Operator Manager</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Operator Manager</li>
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
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Operator Manager</h3>
              </div>
              <div class="card-body">
              <!--<div class="card-block my-3">-->
                                                        <form id="add_data">
                                                            <div class="form-row d-flex justify-content-around">
                                                                <div class="form-group form-primary col-md-3">
                                                                    <label>Select Service</label>
                                                                    <select name="selectservice" required class="form-control">
                                                                        <option value="" selected disabled>Select Service</option>
                                                                         <?php
                                                                $query = "SELECT * FROM service_manager order by ID asc";
                                                                $run = mysqli_query($con , $query);
                                              
                                                                while($row = mysqli_fetch_array($run)){
                                                        
                                                                echo "<option value='".$row['ID']."'>".$row['SERVICE']."</option>>";
                                                                 }
                                                                    ?>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group form-primary col-md-3">
                                                                    <label>Service Api</label>
                                                                    <select name="serviceapi" required class="form-control ">
                                                                        <option value="select">Select Service Api</option>
                                                                         <?php
                                                                $query = "SELECT * FROM rechargeApi order by ID asc";
                                                                $run = mysqli_query($con , $query);
                                              
                                                                while($row = mysqli_fetch_array($run)){
                                                        
                                                                echo "<option value='".$row['ID']."'>".$row['NAME']."</option>>";
                                                                 }
                                                                ?>
                                                                    </select>
                                                                </div>
                                                                <!--<div class="form-group form-primary col-md-3">-->
                                                                <!--    <select name="backupapi" class="form-control">-->
                                                                <!--        <option value="select">Select Backup Api</option>-->
                                                                <!--        <option value="service 1">service Api 1</option>-->
                                                                <!--        <option value="service 2">service Api 2</option>-->
                                                                <!--    </select>-->
                                                                <!--</div>-->
                                                                <div class="form-group form-primary col-md-3">
                                                                    <label class="float-label">Product Name</label>
                                                                    <input type="text" name="productname" required class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="form-row d-flex justify-content-around">
                                                                <div class="form-group form-primary col-md-3">
                                                                    <label>Input Product Code from api doc</label>
                                                                    <input type="text" name="productcode"required  class="form-control">
                                                                    
                                                                </div>
                                                                <div class="form-group form-primary col-md-3">
                                                                    <label>Type</label>
                                                                    <select name="type" required class="form-control ">
                                                                        <option value="" disabled selected>Select Type</option>
                                                                        <option value="operator">Operator</option>
                                                                        <option value="circle">Circle</option>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group form-primary col-md-3">
                                                                    <label>Status</label>
                                                                    <select name="status" required class="form-control ">
                                                                        <option value="" disabled selected>Select Status</option>
                                                                        <option value="Active">Active</option>
                                                                        <option value="Deactive">De-Active</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-row mt-4 d-flex justify-content-center">
                                                                <div class="col-md-8" style="margin-left: 50%;">
                                                                    <button  type="submit" name="save" id="save" class="btn btn-primary"><i class="ti-panel"></i>Add Operator</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    <!--</div>-->
                
              </div>
        </div>
        </div>
        
            
          <div class="col-12">
            <!-- /.card -->

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Operators</h3>
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


 <style>
     .switch {
  position: relative;
  display: inline-block;
  width: 40px;
  height: 17px;
}

.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 13px;
  width: 13px;
  left: 0px;
  bottom: 2px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
 </style> 
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
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
        url:"handler/Operator_Manager.php",
        method:"POST",
        data:{pageid:3,formdate:fromd,todate:tod},
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
      "ordering": false,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
        }
      });
    }
</script>
<script>
    
    $('#save').click(function(e){

e.preventDefault();
  $.ajax({
     url:"handler/Operator_Manager.php",
     type:'POST',
     data :$("#add_data").serialize(),
     success: function(data){
       if(data == 1){
          //  alert("Data Inserted");
          //  $('#add_data')[0].reset();
          Swal.fire({
            icon: 'success',
            title: 'Success...',
            text: 'Successfully Created!',
          }).then (function(){
           location.replace('OperatorManager.php');
          });
       }else{
          //  alert("Failed to Add");
        Swal.fire({
          icon: 'error',
          title: 'Oops...',
          text: 'Something went wrong!',
        }).then (function(){
           location.replace('OperatorManager.php');
          });
       }
         load_data();
     },
 });

})
    
    
</script>
  
  
  
  
<script>
// delete function 

$(document).on("click", ".deletebtn", function() { 
    var id=$(this).attr("data-id");
    $('#id_d').val(id);
  });



// Delete Code

  $("#delete").click(function(){ 
    // alert("Delete")

    // var delid = $(this).data("id");
    // console.log(delid);
    $.ajax({
            url:"handler/Operator_Manager.php",
            type:"POST",
            data:{eid:$("#id_d").val(),delid:3},
            success:function(data){
                if(data == 1){
                    // alert("Success");
                    Swal.fire({
            icon: 'success',
            title: 'Success...',
            text: 'Deleted Successful!',
          }).then (function(){
           location.replace('OperatorManager.php');
          });
          }else{
            Swal.fire({
          icon: 'error',
          title: 'Oops...',
          text: 'Something went wrong!',
        }).then (function(){
           location.replace('OperatorManager.php');
          });
          }
                load_data();
            }
        });

})






// edit record

$(document).on("click", ".edit_btn",function(){
  // alert("btn worked");
  // open modal
  $('#update_user_modal').modal("show");

  var edit_id = $(this).data("mid");
  // console.log(edit_id)
  $.ajax({
     url:"Edit_Operator.php",
     type:'POST',
     data :{pageid:9,sid:edit_id},
     success: function(data){
        $('#edit_modal').html(data); 
        // alert(data);
     },
 });
});

// update

$(document).on("click", "#update",function(){
  // alert("btn worked");
  var up_id = $("#update_id").val();
  var upate_service = $("#upate_service").val();
  var update_serviceapi = $("#update_serviceapi").val();
  var update_backup = $("#update_backup").val();
  var update_pro_code = $("#update_pro_code").val();
  var update_api_ser_name = $("#update_api_ser_name").val();
  var update_status = $("#update_status").val();
  var update_pro_name = $("#update_pro_name").val();

 
  $.ajax({
     url:"operator_update.php",
     type:'POST',
     data :{id:7,updates_id:up_id,upate_service:upate_service,update_serviceapi:update_serviceapi,update_backup:update_backup,update_pro_name:update_pro_name,update_pro_code:update_pro_code,update_api_ser_name:update_api_ser_name,update_status:update_status},
     success: function(data){
         if(data == 1){
          //  alert("Update Data Successfully");
          Swal.fire({
            icon: 'success',
            title: 'Success...',
            text: 'Data Update Successfully!',
          }).then (function(){
           location.replace('OperatorManager.php');
          });
          }else{
            Swal.fire({
          icon: 'error',
          title: 'Oops...',
          text: 'Something went wrong!',
        }).then (function(){
           location.replace('OperatorManager.php');
          });
          }
          //  load_data();
         

     },
 });
})

</script>


</body>
</html>
