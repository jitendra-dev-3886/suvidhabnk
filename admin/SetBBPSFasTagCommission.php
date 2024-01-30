<?php
include("../Db/config.php");

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
            <h1 class="m-0">Fastag Commission Setup</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Fastag Services Fastag Commission Setup</li>
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
                <h3 class="card-title">Fastag Commission Setup</h3>
              </div>
              <!-- /.card-header -->
                <?php 
                  $packid = $_GET['pack_id'];
                ?>
                <div class="card-body">
                <form method="POST" id="Fastag_Form">
                <div class="form-row d-flex justify-content-around ">
                    <input type="hidden" name="packId" value="<?php echo $packid; ?>">
                     <div class="form-group col-md-3">
                        <label for="exampleInputEmail1">Starting Range</label>
                        <input type="number" name="start_range" id="start_range" class="form-control" placeholder="Starting Range">
                      </div>
                     <div class="form-group col-md-3">
                        <label for="exampleInputEmail1">End Range</label>
                        <input type="number" name="end_range" id="end_range" class="form-control" placeholder="End Range">
                      </div>
                     <div class="form-group col-md-3">
                        <label for="exampleInputEmail1">Rtailer Commission</label>
                        <input type="number" name="retailer_comm" id="retailer_comm" class="form-control" placeholder="Rtailer Commission">
                      </div>
                    <div class="form-group col-md-3">
                        <label for="exampleInputEmail1">Distributor Commission</label>
                        <input type="number" name="distributor_comm" id="distributor_comm" class="form-control" placeholder="Distributor Commission">
                      </div>
                </div>
                <div class="form-row d-flex justify-content-around ">
                     <div class="form-group col-md-4">
                        <label for="exampleInputEmail1">GST</label>
                        <input type="number" name="gst" id="gst" class="form-control" placeholder="GST">
                      </div>
                     <div class="form-group col-md-4">
                        <label for="exampleInputEmail1">TDS</label>
                        <input type="number" name="tds" id="tds" class="form-control" placeholder="TDS">
                      </div>
                      
                  <div class="form-group col-md-4">
                        <label for="exampleInputEmail1">Charges</label>
                        <input type="number" name="charges" id="charges" class="form-control" placeholder="Charges">
                   </div>
                   
                </div>
                <div class="form-row d-flex justify-content-around ">
                    <div class="form-group col-md-5">
                        <label for="exampleInputEmail1">Select Ammount Type</label>
                         <select name="amount_type" id="amount_type" class="form-control select2" >
                            <option value="CREDIT">Credit</option>
                            <option value="DEBIT">Debit</option>
                         </select>
                    </div>
                    <div class="form-group col-md-5">
                        <label for="exampleInputEmail1">Select Commission Type</label>
                        <select class="form-control select2" name="comm_type" id="comm_type" >
                            <option selected value="FLAT">Flat</option>
                            <option  value="PERCENTAGE">Percentage</option>
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
                  <tbody>
                      <?php
                         $i=1;
                         $com_pack_id= $_GET['pack_id'];
                         $res= $con->query("SELECT * FROM `slab_commission` WHERE COMM_PACK_ID ='$com_pack_id' ORDER BY ID DESC");
                         if($res->num_rows >0){
                             while($setFastag = $res->fetch_assoc()){
                      
                      ?>
                  <tr>
                    <td><?php echo $i++; ?></td>
                    <td><?php echo $setFastag['MIN_AMOUNT']; ?></td>
                    <td><?php echo $setFastag['MAX_AMOUNT']; ?></td>
                    <td><?php echo $setFastag['AMOUNT']; ?></td>
                    <td><?php echo $setFastag['DS_COM']; ?></td>
                    <td><?php echo $setFastag['GST']; ?></td>
                    <td><?php echo $setFastag['TDS']; ?></td>
                    <td><?php echo $setFastag['TYPE']; ?></td>
                    <td><?php echo $setFastag['DATE']; ?></td>
                    <td><?php echo $setFastag['MAIN_OWNER']; ?></td>
                    
                    <td><a href="#" name="button" onclick = "deletedata(<?php echo $setFastag['ID']; ?>);"><i class="fas fa-trash"></i></i></a></i></td>

                  </tr>
                  </tbody>
                  <?php
                  
                     }
                             
                         }
                             ?>
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
    </section>

    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 
  
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
                     url:"handler/fastag_commSetup.php",  
                     method:"POST",  
                     data:$('#Fastag_Form').serialize()+"&pageid=1",  
                     success:function(data){  
                          $('form').trigger("reset");  
                          $('#response').fadeIn().html(data);  
                          setTimeout(function(){  
                               $('#response').fadeOut("slow");  
                          }, 5000);  
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
            url: 'handler/fastag_commSetup.php',
            // Method
            type: 'POST',
            data: {
              // Get value
              ID: ID,
              action: "delete",
              pageid:2
            },
            success:function(response){
              // Response is the output of action file
              if(response == 1){
                alert("Data Deleted Successfully");
                document.getElementById(ID).style.display = "none";
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
