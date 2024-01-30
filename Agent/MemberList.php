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
            <h1 class="m-0">Member List</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Member List</li>
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
                <h3 class="card-title">Member List Data Table</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    
                    <?php
                    
                    include("config.php");
                  
                  $sql = "SELECT * FROM user";
                  
                  $result = $conn->query($sql);
                  
                  if(mysqli_num_rows($result) > 0){
                    
                    
                    
                    ?>
                  <thead>
                  <tr>
                    <th>Member ID</th>
                    <th>Full Name</th>
                    <th>Mobile</th>
                    <th>Type</th>
                    <th>Owner</th>
                    <th>Profile</th>
                    <th>Status</th>
                  </tr>
                  </thead>
                  <tbody>
                      <?php
                      
                      while($row = mysqli_fetch_assoc($result)){
                      
                      ?>
                  <tr>
                    <td><?php echo $row['ID'] ?></td>
                    <td><?php echo $row['FIRST_NAME'].' '.$row['LAST_NAME'] ?></td>
                    <td><?php echo $row['MOBILE'] ?></td>
                    <td><?php echo $row['USER_TYPE'] ?></td>
                    <td><?php echo $row['OWNER_ID'] ?></td>
                    <td><span class="badge badge-info right" data-toggle="modal" data-target=".bd-example-modal-lg" ><?php $row['ID'] ?>View Profile</span></td>
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
             <?php
//               include("config.php");
//              $query = "SELECT * FROM user";
// $query_run = mysqli_query($conn, $query);
// if(mysqli_num_rows($query_run) > 0)
// {
// foreach($query_run as $row)
// {
?>
             
            
            <div class="row">
                <!--left data-->
                <div class="col-9">
                    <div class="form-row">
                      <div class="form-group col-md-4">
                      <label for="inputEmail4">Member ID : <?php echo $row['ID'] ?></label>
                    </div>
                    <div class="form-group col-md-3">
                      <select >
                          <option>Select Status</option>
                          <option value="<?php echo $row['US_STATUS'] ?>" selected><?php echo $row['US_STATUS'] ?></option>
                          <option value="Active">Active</option>
                          <option value="Deactive">Deactive</option>
                      </select>
                    </div>
                    </div>
                    <div class="form-row">
                      <div class="form-group col-md-4">
                      <label for="inputEmail4">Subscription Plan Name</label>
                    </div>
                    <div class="form-group col-md-3">
                      <select >
                          <option>Plan 1</option>
                          <option>Plan 2</option>
                          <option>Plan 3</option>
                      </select>
                    </div>
                      <div class="form-group col-md-5">
                      <label for="inputEmail4">Validity: ( Remaining Days)</label>
                    </div>
                    </div>
                    <div class="form-row">
                      <div class="form-group col-md-4">
                      <label for="inputEmail4">Member ID: <?php echo $row['ID'] ?></label>
                    </div>
                      <div class="form-group col-md-5">
                      <label for="inputEmail4">Member Type : </label>
                    </div>
                    </div>
                    <div class="form-row">
                      <div class="form-group col-md-4">
                      <label for="inputEmail4">Mobile : <?php echo $row['MOBILE'] ?></label>
                    </div>
                      <div class="form-group col-md-5">
                         <label for="inputEmail4">Email ID: <?php echo $row['EMAIL'] ?></label>
                      </div>
                    </div>
                    <div class="form-row">
                      <div class="form-group col-md-8">
                      <label for="inputEmail4">Member Owner : </label>
                    </div>
                    </div>
                    <label><u>Permanent Address</u></label>
                    <div class="form-row">
                      <div class="form-group col-md-12">
                        <label for="inputEmail4">Full Address : <?php echo $row['ADDRESS'] ?></label>
                      </div>
                      <div class="form-group col-md-4">
                      <label for="inputEmail4">State : <?php echo $row['STATE'] ?></label>
                    </div>
                      <div class="form-group col-md-4">
                        <label for="inputEmail4">City : <?php echo $row['CITY'] ?></label>
                      </div>
                      <div class="form-group col-md-4">
                        <label for="inputEmail4">Pin Code : <?php echo $row['PIN'] ?></label>
                      </div>
                       
                    </div>
                    <label><u>Office Address</u></label>
                    <div class="form-row">
                      <div class="form-group col-md-12">
                        <label for="inputEmail4">Full Address : <?php echo $row['ADDRESS'] ?></label>
                      </div>
                      <div class="form-group col-md-4">
                      <label for="inputEmail4">State : <?php echo $row['STATE'] ?></label>
                    </div>
                      <div class="form-group col-md-4">
                        <label for="inputEmail4">City : <?php echo $row['CITY'] ?></label>
                      </div>
                      <div class="form-group col-md-4">
                        <label for="inputEmail4">Pin Code : <?php echo $row['PIN'] ?></label>
                      </div>
                      
                    </div>
                    
                    
                </div>
                
                <!--right data-->
                <div class="col-md-3">
                 <img src="dist/img/user.png" class="rounded mx-auto d-block">
                <br>
              <label class="text-center">Profile Picture</label>
              <label class="text-center">Joining Date : <br> <?php echo $row['DATE'] ?></label>
              <label class="text-danger text-center">Virtual Account Details </label>
            </div>
            </div> 
             
         <div class="row">
             <div class="col-12">
               <div class="form-row d-flex justify-content-between ">
                <div class="form-group col-md-4">
                  <label >Aadhar Number : <?php echo $row['ADHAAR'] ?></label>
                </div>
                <div class="form-group col-md-4">
                  <label >PAN Number : <?php echo $row['PAN'] ?></label>
                </div>
                <div class="form-group col-md-4">
                  <label >GST Number : <?php echo $row[''] ?></label>
                </div>
              </div>
          </div>
             
         </div>     
             
         <div class="row">
             <div class="col-12">
               <div class="form-row d-flex justify-content-between ">
                <div class="form-group col-md-3">
                  <a class="badge badge-info right" >Download Aadhar</a>
                </div>
                <div class="form-group col-md-3">
                  <a class="badge badge-info right" >Download E-Stamp</a>
                </div>
                <div class="form-group col-md-3">
                  <a class="badge badge-info right" >Download PAN</a>
                </div>
                <div class="form-group col-md-3">
                  <label class="badge badge-info right" >View Video KYC</label>
                </div>
                </div>
              </div>
          </div>     
             
         <div class="row">
             <label><u>Bank Account Details</u></label>
             <div class="col-12">
               <div class="form-row d-flex justify-content-between ">
                <div class="form-group col-md-3">
                  <label >Account Holder Name</label>
                  <input type="text" Placeholder="" class="form-control">
                </div>
                <div class="form-group col-md-3">
                   <label >Account Number</label>
                   <input type="number" Placeholder="" class="form-control">
                </div>
                <div class="form-group col-md-3">
                  <label >IFSC Code</label>
                   <input type="text" Placeholder="" class="form-control">
                </div>
                <div class="form-group col-md-3">
                  <label >Bank Name</label>
                   <input type="text" Placeholder="" class="form-control">
                </div>
                </div>
              </div>
          </div>     
             
             
         <div class="row">
             <label><u>Services</u> 
             --
            <span>OFF</span>
            <label class="switch">
              <input type="checkbox" checked>
              <span class="slider round"></span>
            </label>
            <span>ON</span>
            
            </label>
             <div class="col-12">
               <div class="form-row d-flex justify-content-between ">
                <div class="form-group col-md-3">
                  <label >AePs</label>
                   -
                   <span>OFF</span>
                    <label class="switch">
                      <input type="checkbox" checked>
                      <span class="slider round"></span>
                    </label>
                    <span>ON</span>
                </div>
                <div class="form-group col-md-3">
                   <label >DMT</label>
                    -
                   <span>OFF</span>
                    <label class="switch">
                      <input type="checkbox" checked>
                      <span class="slider round"></span>
                    </label>
                    <span>ON</span>
                </div>
                <div class="form-group col-md-3">
                  <label >X-DMT</label>
                   -
                   <span>OFF</span>
                    <label class="switch">
                      <input type="checkbox" checked>
                      <span class="slider round"></span>
                    </label>
                    <span>ON</span>
                </div>
                <div class="form-group col-md-3">
                  <label >Payout</label>
                   -
                   <span>OFF</span>
                    <label class="switch">
                      <input type="checkbox" checked>
                      <span class="slider round"></span>
                    </label>
                    <span>ON</span>
                </div>
                <div class="form-group col-md-3">
                  <label >Virtual Account</label>
                   -
                   <span>OFF</span>
                    <label class="switch">
                      <input type="checkbox" checked>
                      <span class="slider round"></span>
                    </label>
                    <span>ON</span>
                </div>
                </div>
              </div>
          </div> 
          
         <div class="row">
             <label><u>Commission Setup</u></label>
             <div class="col-12">
               <div class="form-row d-flex justify-content-between ">
                <div class="form-group col-md-4">
                  <label >AePs</label>
                   -
                  <select >
                      <option>Commission 1</option>
                      <option>Commission 2</option>
                      <option>Commission 3</option>
                  </select>
                </div>
                <div class="form-group col-md-4">
                  <label >DMT</label>
                   -
                  <select >
                      <option>Commission 1</option>
                      <option>Commission 2</option>
                      <option>Commission 3</option>
                  </select>
                </div>
                <div class="form-group col-md-4">
                  <label >Electric Bill</label>
                   -
                  <select >
                      <option>Commission 1</option>
                      <option>Commission 2</option>
                      <option>Commission 3</option>
                  </select>
                </div>
                
                </div>
              </div>
          </div>     
<?php
// }}
// else
// {
// echo "No Record Found";
//}
?>

        </form>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary">Activity</button>
        <button type="button" class="btn btn-primary">Update</button>
      </div>
    </div>
  </div>
</div>
  <!--==============  View Profile Modal ===================-->


                    <td><?php echo $row['US_STATUS'] ?></td>
                 </tr>
                 <?php } ?>
                 
                  </tfoot>
                  <?php } ?>
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
