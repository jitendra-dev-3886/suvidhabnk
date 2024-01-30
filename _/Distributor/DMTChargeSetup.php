<?php
include("../Db/config.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>PayDeer | Dashboard </title>

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
            <h1 class="m-0">DMT Charge Setup</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">DMTCharge Setup</li>
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
                <h3 class="card-title">DMT Charge Setup</h3>
              </div>
              <!-- /.card-header -->
                <?php 
                  $packid = $_GET['pack_id'];
                ?>
                <div class="card-body">
                <form method="POST" id="Dmt_Form">
                <div class="form-row d-flex justify-content-around ">
                    <input type="hidden" id="packid" name="packId" value="<?php echo $packid; ?>">
                     <div class="form-group col-md-3">
                        <label for="exampleInputEmail1">Starting Range</label>
                        <input type="text" name="start_range" id="start_range" class="form-control" placeholder="Starting Range" required>
                      </div>
                     <div class="form-group col-md-3">
                        <label for="exampleInputEmail1">End Range</label>
                        <input type="text" name="end_range" id="end_range" class="form-control" placeholder="End Range" required>
                      </div>
                       <div class="form-group col-md-3">
                        <label for="exampleInputEmail1">Charges</label>
                        <input type="text" name="charges" id="charges" class="form-control" placeholder="Charges">
                      </div>
                     <div class="form-group col-md-3">
                        <label for="exampleInputEmail1">Rtailer Commission</label>
                        <input type="text" name="retailer_comm" id="retailer_comm" class="form-control" placeholder="Rtailer Commission" required>
                      </div>
                </div>
                <div class="form-row d-flex justify-content-around ">
                     <div class="form-group col-md-3">
                        <label for="exampleInputEmail1">Distributor Commission</label>
                        <input type="text" name="distributor_comm" id="distributor_comm" class="form-control" placeholder="Distributor Commission" required>
                      </div>
                     <div class="form-group col-md-2">
                        <label for="exampleInputEmail1">GST</label>
                        <input type="text" name="gst" id="gst" class="form-control" placeholder="GST" required>
                      </div>
                     <div class="form-group col-md-2">
                        <label for="exampleInputEmail1">TDS</label>
                        <input type="text" name="tds" id="tds" class="form-control" placeholder="TDS" required>
                      </div>
                      
                    <div class="form-group col-md-3">
                         <label for="exampleInputEmail1">Select Ammount Type</label>
                         <select name="amount_type" id="amount_type" class="form-control" required>
                            <option value="CREDIT">Credit</option>
                            <option value="DEBIT">Debit</option>
                         </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="exampleInputEmail1">Select Commission Type</label>
                        <select class="form-control select2" name="comm_type" id="comm_type" required>
                            <option selected value="FLAT">Flat</option>
                            <option  value="PERCENTAGE">Percentage</option>
                        </select>
                    </div>
                </div>
                </div>
                <div class="card-footer d-flex justify-content-center">
                  <button type="submit" name="dmtCom" id="dmtCom" class="btn btn-primary">Set Commission Setup</button>
                </div>
                </form>
                  <div id="response"></div>  

                </div>
                  <!-- /.card-body -->

             <div class="card">
            <div class="card-header">
                <h3 class="card-title">Commission package Name</h3>
              </div>
              <!-- /.card-header -->
              
              <div class="card-body">
                    
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>SL No</th>
                    <th>Starting Range</th>
                    <th>Ending Range</th>
                    <th>Charges</th>
                    <th>Retailer Commission</th>
                    <th>Distributor Commission</th>
                    <th>GST</th>
                    <th>TDS</th>
                    <th>Commission Type</th>
                    <th>Created Date</th>
                    <th>Created By</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                   <tbody id="DMT_tab">
               
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              
               
            </div>
            	<!-- Delete Modal HTML -->
            <div id="deleteEmployeeModal" class="modal fade">
            	<div class="modal-dialog">
            		<div class="modal-content">
            			<form>
            				<div class="modal-header">						
            					<h4 class="modal-title">Delete DMT Charge Setup</h4>
            					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            				</div>
            				<div class="modal-body">
            					<input type="hidden" id="id_d" name="id" class="form-control">					
            					<p>Are you sure you want to delete this?</p>
            				</div>
            				<div class="modal-footer">
            					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
            					<button type="button" class="btn btn-danger" id="delete">Delete</button>
            				</div>
            			</form>
            		</div>
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
  
  <!--========= Edit Modal =========-->
<!-- Modal -->
<div class="modal fade" id="exampleModaledit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">Select Commission Type</label>
                        <select class="form-control select2" style="width: 100%;">
                            <option selected="selected">Company</option>
                            <option>Agent</option>
                            </select>
                    </div>
                      <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">Name</label>
                        <input type="text" class="form-control" placeholder="Name">
                      </div>
                </div>
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

<script>
    function changeCom(value){
        console.log(value);
        if(value == "company"){
            $("#companyNameDiv").show();
        }
        else{
            $("#companyNameDiv").hide();
        }
    }
</script>
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
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- Page specific script -->

 <script>  
 $(document).ready(function(){  
       //  display...
    
          function loadData()
             {
               var packid = $("#packid").val();
               
                $.ajax({
                url: "handler/DMTChargeSetup.php",
                type: "POST",
                data : {pid:packid,id:1},
                success: function(data){
                    $("#DMT_tab").html(data);
                }
            });
            
            // console.log($("#packid").val());
          }
          loadData();
          
     
      $('#dmtCom').click(function(e){ 
          
          if($('#Dmt_Form')[0].checkValidity()){
          
          e.preventDefault()
          
          var startRange = $('#start_range').val();  
          var endRange = $('#end_range').val();  
          var charges = $('#charges').val();  
          var retailerComm = $('#retailer_comm').val();  
          var distributorComm = $('#distributor_comm').val();  
          var Gst = $('#gst').val();  
          var Tds = $('#tds').val();  
          var Commtype = $('#comm_type').val(); 
          var amount_type = $('#amount_type').val(); 

        //   if(startRange == "" || endRange == "" || charges == "" || retailerComm == "" || distributorComm == "" || Gst == "" || Tds == "" || Commtype == "" || amount_type == "" )  
        //   {  
        //         $('#response').html('<h4 class="text-danger">All Fields are required</h4>');  
        //   }  
        //   else  
        //   {  
                $.ajax({  
                     url:"handler/DMTChargeSetup.php",  
                     method:"POST",  
                     data:$('#Dmt_Form').serialize(),  
                     success:function(data){  
                          $('form').trigger("reset");  
                          $('#response').fadeIn().html(data);  
                          setTimeout(function(){  
                               $('#response').fadeOut("slow");  
                          }, 5000);  
                                    loadData();
                     }  
                });  
        //   }
          }
      });  
 });
 
   //delete function    
$(document).on("click", ".delete", function() { 
    var id=$(this).attr("data-id");
    $('#id_d').val(id);
    
});

$("#delete").click(function(){ 
    $.ajax({
        url: "handler/DMTChargeSetup.php",
        type: "POST",
        cache: false,
        data:{
            type:3,
            id: $("#id_d").val()
        },
        success: function(dataResult){
                $('#deleteEmployeeModal').modal('hide');
                // location.reload();						
               
        loadData();
        }

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
