<?php                         
include("../Db/config.php");

$packid = $_GET['rid'];
$row = $con->query("SELECT * FROM `websetting`")->fetch_assoc();
$slabsql=$con->query("SELECT * FROM `slab_commission` WHERE ID='$packid'")->fetch_assoc();?>
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
            <h1 class="m-0">BBPS Offline Commission Setup</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">BBPS Offline Services Commission Setup</li>
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
                <h3 class="card-title">BBPS Offline Commission Setup</h3>
              </div>
              <!-- /.card-header -->
                <?php 
                  $packid = $_GET['pack_id'];
                ?>
                <div class="card-body">
                <form method="POST" id="Aeps_Form">
                <div class="form-row d-flex justify-content-around ">
                    <input type="hidden" name="packId" value="<?php echo $slabsql['ID']?>">
                     <div class="form-group col-md-3">
                        <label for="exampleInputEmail1">Starting Range</label>
                        <input type="number" name="start_range" id="start_range" class="form-control" placeholder="Starting Range" value="<?php echo $slabsql['MIN_AMOUNT']?>">
                      </div>
                     <div class="form-group col-md-3">
                        <label for="exampleInputEmail1">End Range</label>
                        <input type="number" name="end_range" id="end_range" class="form-control" placeholder="End Range" value="<?php echo $slabsql['MAX_AMOUNT']?>">
                      </div>
                     <div class="form-group col-md-3">
                        <label for="exampleInputEmail1">Rtailer Commission</label>
                        <input type="number" name="retailer_comm" id="retailer_comm" class="form-control" placeholder="Rtailer Commission" value="<?php echo $slabsql['AMOUNT']?>">
                      </div>
                    <div class="form-group col-md-3">
                        <label for="exampleInputEmail1">Distributor Commission</label>
                        <input type="number" name="distributor_comm" id="distributor_comm" class="form-control" placeholder="Distributor Commission" value="<?php echo $slabsql['DS_COM']?>">
                      </div>
                </div>
                <div class="form-row d-flex justify-content-around ">
                     <div class="form-group col-md-4">
                        <label for="exampleInputEmail1">GST</label>
                        <input type="number" name="gst" id="gst" class="form-control" placeholder="GST"  value="<?php echo $slabsql['GST']?>">
                      </div>
                     <div class="form-group col-md-4">
                        <label for="exampleInputEmail1">TDS</label>
                        <input type="number" name="tds" id="tds" class="form-control" placeholder="TDS"  value="<?php echo $slabsql['TDS']?>">
                      </div>
                      
                  <div class="form-group col-md-4">
                        <label for="exampleInputEmail1">Charges</label>
                        <input type="number" name="charges" id="charges" class="form-control" placeholder="Charges" value="<?php echo $slabsql['CHARGE']?>">
                   </div>
                   
                </div>
                <div class="form-row d-flex justify-content-around ">
                    <div class="form-group col-md-5">
                        <label for="exampleInputEmail1">Select Ammount Type</label>
                         <select name="amount_type" id="amount_type" class="form-control select2">
    <option value="CREDIT"<?php if ($slabsql['AMOUNT_TYPE'] == 'CREDIT') echo ' selected'; ?>>Credit</option>
    <option value="DEBIT"<?php if ($slabsql['AMOUNT_TYPE'] == 'DEBIT') echo ' selected'; ?>>Debit</option>
</select>
                    </div>
                    <div class="form-group col-md-5">
                        <label for="exampleInputEmail1">Select Commission Type</label>
                       <select class="form-control select2" name="comm_type" id="comm_type">
                                 <option value="FLAT"<?php if ($slabsql['TYPE'] == 'FLAT') echo ' selected'; ?>>Flat</option>
                           <option value="PERCENTAGE"<?php if ($slabsql['TYPE'] == 'PERCENTAGE') echo ' selected'; ?>>Percentage</option>
                       </select>
                    </div>
                </div>  
                      
                </div>
                <div class="card-footer d-flex justify-content-center">
                  <button type="submit" name="setCom" id="setCom" class="btn btn-primary">Set Commission Setup</button>
                </div>
                </form>
                               <div id="response"></div>  

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
  <!--========= Edit Modal =========-->
  
  <!--========= Transfer Modal =========-->
<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Transfer Request (For Approval)</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
            <div class="form-row d-flex justify-content-center">
              <div class="col-10">
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Transfer To : Employee's Mobile Number</label>
                       <input type="number" class="form-control" placeholder="Employee's Mobile Number" onkeypress="return this.value.length < 10;" oninput="if(this.value.length>=10) { this.value = this.value.slice(0,10); }">
                    <label for="exampleFormControlTextarea1">Details : Employee Name. Position : </label>
                  </div>
              </div>
          </div>
          <div class="form-row d-flex justify-content-center">
              <div class="col-10">
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Remark</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                  </div>
              </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Transfer Now</button>
      </div>
    </div>
  </div>
</div>
  <!--========= Transfer Modal =========-->
  
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
      $('#setCom').click(function(e){ 
          e.preventDefault()
           var startRange = $('#start_range').val();  
           var endRange = $('#end_range').val();  
           var retailerComm = $('#retailer_comm').val();  
           var distributorComm = $('#distributor_comm').val();  
           var Gst = $('#gst').val();  
           var Tds = $('#tds').val();  
           var Commtype = $('#comm_type').val(); 
           if(startRange == "" || endRange == "" || retailerComm == "" || distributorComm == "" || Gst == "" || Tds == "" || Commtype == "" )  
           {  
                $('#response').html('<h4 class="text-danger">All Fields are required</h4>');  
           }  
           else  
           {  
                $.ajax({  
                     url:"handler/SetBBPSOfflineCommission1.php",  
                     method:"POST",  
                     data:$('#Aeps_Form').serialize(),  
                     success:function(data){  
                         if(data==1){
                             alert("SetBBPSOfflineBBPSCommission Update")  ;
           location.reload();

                         }
                         else{
                             alert("Failed to Create SetBBPSOfflineBBPSCommission");  
            //   location.reload();
                         }
                     }   
                });  
           }  
      });  
 });  
 </script>  

<script type="text/javascript">
      // Function
      
      function deletedata(ID){
        $(document).ready(function(){
            
            if (confirm("Are you want to delete this")) {
            
          $.ajax({
            // Action
            url: 'handler/SetBBPSOfflineCommission.php',
            // Method
            type: 'POST',
            data: {
              // Get value
              ID: ID,
              action: "delete"
            },
            success:function(response){
              // Response is the output of action file
              if(response == 1){
                alert("Data Deleted Successfully");
               location.reload();
              }
              else if(response == 0){
                alert("Data Cannot Be Deleted");
              }
            }
          });
            }
        });
      }
        
      
</script>


</body>
</html>
