<?php
session_start();
include("../Db/config.php");

if(isset($_POST['updatetype'])){
    extract($_POST);
    if($con->query("update service_status set `DMT`='$dmt',`AEPS`='$aeps',`BBPS`='$bbps',`RECHARGE`='$recharge',`PAN`='$pan',`PAYOUT`='$payout',`UPI`='$upi' ,`XDMT`='$xdmt',`INSURANCE`='$insurance' where ID=1")){
        echo "<script>alert('Updated')</script>";
    }else{
        echo "<script>alert('Error')</script>";
    }
}

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
            <h1 class="m-0">Services Manage</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Services Manage</li>
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
                <h3 class="card-title">Service Report Data Table</h3>
              </div>
              <!-- /.card-header -->
              <?php $srst = $con->query("select * from service_status where ID='1'")->fetch_assoc(); ?>
              <div class="card-body">
               <form method="post">
              <table id="example1" class="table table-bordered table-striped">
               <thead>
                  <tr>
                     <th>Service Name</th>
                     <th>Server Name</th>
                     <th>Shift Area</th>
                  </tr>
               </thead>
               <tbody>
                  <tr>
                     <td>Aeps</td>
                     <td>
                         <label>Select Server</label>
                         <select>
                             <option value="PaySprint">PaySprint</option>
                             <option value="PayTm">PayTm</option>
                         </select>
                        
                     </td>
                     <td><input type="text" width="50"></td>
                  </tr>
                  <tr>
                     <td>DMT</td>
                     <td>
                         <label>Select Server</label>
                         <select>
                             <option value="Cashfree">Cashfree</option>
                             <option value="PaySprint">PaySprint</option>
                         </select>
                    </td>
                     <td><input type="text" width="50"></td>
                  </tr>
                  <tr>
                     <td>X-DMT</td>
                     <td>
                         <label>Select Server</label>
                         <select>
                             <option value="Cashfree">Cashfree</option>
                         </select>
                    </td>
                     <td><input type="text" width="50"></td>
                  </tr>
                  <tr>
                     <td>Payout</td>
                     <td>
                         <label>Select Server</label>
                         <select>
                             <option value="Cashfree">Cashfree</option>
                             <option value="PaySprint">PaySprint</option>
                         </select>
                    </td>
                     <td><input type="text" width="50"></td>
                  </tr>
                  <tr>
                     <td>BBPS</td>
                     <td>
                         <label>Select Server</label>
                         <select>
                             <option value="PaySprint">PaySprint</option>
                         </select>
                    </td>
                     <td><input type="text" width="50"></td>
                  </tr>
                  <tr>
                     <td>M-ATM</td>
                     <td>
                         <label>Select Server</label>
                         <select>
                             <option value="PaySprint">PaySprint</option>
                             <option value="ICICI">ICICI</option>
                         </select>
                    </td>
                     <td><input type="text" width="50"></td>
                  </tr>
               
               </tbody>
            </table>
            <button type="submit" name="updatetype" class="btn btn-primary">Update</button>
                  </form>
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
  <!--==============  View Profile Modal ===================-->

<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Member Profile</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <form>
             
            
             
             
         <div class="row">
             <label><u>Details</u></label>
             <div class="col-12">
               <div class="form-row d-flex justify-content-between ">
                <div class="form-group col-md-4">
                  <label >Name</label>
                  <input type="text" Placeholder="" class="form-control">
                </div>
                
                <div class="form-group col-md-4">
                  <label >Agent Id.</label>
                   <input type="text" Placeholder="" class="form-control">
                </div>
                <div class="form-group col-md-4">
                  <label >Agent Mobile No.</label>
                   <input type="text" Placeholder="" class="form-control">
                </div>
                
                </div>
              </div>
              <div class="col-12">
               <div class="form-row d-flex justify-content-between ">
                <div class="form-group col-md-4">
                  <label >Message 1</label>
                  
                </div>
                <div class="form-group col-md-12">
                <div class="alert alert-primary" role="alert">This is a primary alert—check it out!</div>
                </div>
                </div>
              </div>
              <div class="col-12">
               <div class="form-row d-flex justify-content-between ">
                <div class="form-group col-md-4">
                  <label >Message 2</label>
                  
                </div>
                <div class="form-group col-md-12">
                <div class="alert alert-success" role="alert">This is a success alert—check it out!</div>
                </div>
                
                </div>
              </div>
          </div>     
             
             
         
            
 
        </form>
        </div>
        
    </div>
  </div>
</div>
  <!--==============  View Profile Modal ===================-->
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
