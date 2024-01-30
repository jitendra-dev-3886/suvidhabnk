<?php
session_start();
include("include/Auth.php");
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
            <h1 class="m-0">BBPS EMI Payment Commission Setup</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">BBPS EMI Payment Commission Setup</li>
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
                <h3 class="card-title">AePs Commission Setup</h3>
              </div>
              <!-- /.card-header -->
              
                <div class="card-body">
                
                <div class="form-row d-flex justify-content-around ">
                    <div class="form-group col-md-3">
                        <label for="exampleInputEmail1">Select Commission Type</label>
                        <select class="form-control select2"  onchange="changeCom(this.value)" style="width: 100%;">
                            <option selected value="agent">Agent</option>
                            <option value="company">Company</option>
                        </select>
                    </div>
                    <div class="form-group col-md-4" id="companyNameDiv" style="display:none">
                        <label for="exampleInputEmail1">Select Company Name Type</label>
                        <select class="form-control select2">
                            <option value="Paysprint">Paysprint</option>
                            <option value="Paytm">Paytm</option>
                            <option value="other">other</option>
                        </select>
                    </div>
                      <div class="form-group col-md-4">
                        <label for="exampleInputEmail1">Name</label>
                        <input type="text" class="form-control" placeholder="Name">
                      </div>
                </div>
                </div>
                <div class="card-footer d-flex justify-content-center">
                  <button type="submit" class="btn btn-primary">Set Commission Setup</button>
                </div>
                </div>
                  <!-- /.card-body -->

             <div class="card">
            <div class="card-header">
                <h3 class="card-title">Commission type : Agent</h3>
              </div>
              <!-- /.card-header -->
              
              <div class="card-body">
                    
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>SL No</th>
                    <th>Commission Type</th>
                    <th>Name</th>
                    <th>Created Date</th>
                    <th>Setup Commission</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr>
                    <td>1</td>
                    <td>Company</td>
                    <td>Diwali Offer</td>
                    <td>22-01-2021</td>
                    <td><a href="SetBBPSEMIPaymentCommission.php" class="badge badge-info right">Go For Setup</a></td>
                    <td>
                        <i class="fas fa-edit" data-toggle="modal" data-target="#exampleModaledit"></i>
                        &nbsp;  &nbsp; <i class="fas fa-trash"></i>
                    </td>
                  </tr>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>SL No</th>
                    <th>Commission Type</th>
                    <th>Name</th>
                    <th>Created Date</th>
                    <th>Setup Commission</th>
                    <th>Action</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
              
               
            </div>

             <div class="card">
            <div class="card-header">
                <h3 class="card-title">Commission type : Company</h3>
              </div>
              <!-- /.card-header -->
              
              <div class="card-body">
                    
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>SL No</th>
                    <th>Commission Type</th>
                    <th>Company Name</th>
                    <th>Name</th>
                    <th>Created Date</th>
                    <th>Setup Commission</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr>
                    <td>1</td>
                    <td>Company</td>
                    <td>Diwali Offer</td>
                    <td>22-01-2021</td>
                    <td><span class="badge badge-info right">Go For Setup</span></td>
                    <td>
                        <i class="fas fa-edit" data-toggle="modal" data-target="#exampleModaleditcompany"></i>
                        &nbsp;  &nbsp; <i class="fas fa-trash"></i>
                    </td>
                  </tr>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>SL No</th>
                    <th>Commission Type</th>
                    <th>Name</th>
                    <th>Created Date</th>
                    <th>Setup Commission</th>
                    <th>Action</th>
                  </tr>
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
    </section>

    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
  <!--========= Agent Edit Modal =========-->
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
                      <div class="card-footer d-flex justify-content-center">
                  <button type="submit" class="btn btn-primary">Submit</button>
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
  
  <!--========= Company Edit Modal =========-->
<!-- Modal -->
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
                    <div class="form-group col-md-3">
                        <label for="exampleInputEmail1">Select Commission Type</label>
                        <select class="form-control select2"  onchange="changeCom(this.value)" style="width: 100%;">
                            <option selected value="agent">Agent</option>
                            <option value="company">Company</option>
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="exampleInputEmail1">Select Company Name Type</label>
                        <select class="form-control select2">
                            <option value="Paysprint">Paysprint</option>
                            <option value="Paytm">Paytm</option>
                            <option value="other">other</option>
                        </select>
                    </div>
                      <div class="form-group col-md-4">
                        <label for="exampleInputEmail1">Name</label>
                        <input type="text" class="form-control" placeholder="Name">
                      </div>
                </div>
                </div>
                <div class="card-footer d-flex justify-content-center">
                  <button type="submit" class="btn btn-primary">Set Commission Setup</button>
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
                <!--left data-->
                <div class="col-9">
                    <div class="form-row">
                      <div class="form-group col-md-4">
                      <label for="inputEmail4">Member ID : Status</label>
                    </div>
                    <div class="form-group col-md-3">
                      <select >
                          <option>Select Status</option>
                          <option>Active</option>
                          <option>Deactive</option>
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
                      <label for="inputEmail4">Member ID:</label>
                    </div>
                      <div class="form-group col-md-5">
                      <label for="inputEmail4">Member Type:</label>
                    </div>
                    </div>
                    <div class="form-row">
                      <div class="form-group col-md-4">
                      <label for="inputEmail4">Mobile:</label>
                    </div>
                      <div class="form-group col-md-5">
                         <label for="inputEmail4">Email ID:</label>
                      </div>
                    </div>
                    <div class="form-row">
                      <div class="form-group col-md-8">
                      <label for="inputEmail4">Member Owner:</label>
                    </div>
                    </div>
                    <label><u>Permanent Address</u></label>
                    <div class="form-row">
                      <div class="form-group col-md-12">
                        <label for="inputEmail4">Full Address:</label>
                      </div>
                      <div class="form-group col-md-4">
                      <label for="inputEmail4">State:</label>
                    </div>
                      <div class="form-group col-md-4">
                        <label for="inputEmail4">City:</label>
                      </div>
                      <div class="form-group col-md-4">
                        <label for="inputEmail4">Pin Code:</label>
                      </div>
                       
                    </div>
                    <label><u>Office Address</u></label>
                    <div class="form-row">
                      <div class="form-group col-md-12">
                        <label for="inputEmail4">Full Address:</label>
                      </div>
                      <div class="form-group col-md-4">
                      <label for="inputEmail4">State:</label>
                    </div>
                      <div class="form-group col-md-4">
                        <label for="inputEmail4">City:</label>
                      </div>
                      <div class="form-group col-md-4">
                        <label for="inputEmail4">Pin Code:</label>
                      </div>
                      
                    </div>
                    
                    
                </div>
                
                <!--right data-->
                <div class="col-md-3">
                 <img src="dist/img/user.png">
                <br>
              <label >Profile Picture</label>
              <label >Joining Date</label>
              <label class="text-danger text-center">Virtual Account Details </label>
            </div>
            </div> 
             
         <div class="row">
             <div class="col-12">
               <div class="form-row d-flex justify-content-between ">
                <div class="form-group col-md-4">
                  <label for="inputCity">Aadhar Number :</label>
                </div>
                <div class="form-group col-md-4">
                  <label for="inputCity">PAN Number :</label>
                </div>
                <div class="form-group col-md-4">
                  <label for="inputCity">GST Number :</label>
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
                  <label for="inputCity">Account Holder Name</label>
                  <input type="text" Placeholder="" class="form-control">
                </div>
                <div class="form-group col-md-3">
                   <label for="inputCity">Account Number</label>
                   <input type="number" Placeholder="" class="form-control">
                </div>
                <div class="form-group col-md-3">
                  <label for="inputCity">IFSC Code</label>
                   <input type="text" Placeholder="" class="form-control">
                </div>
                <div class="form-group col-md-3">
                  <label for="inputCity">Bank Name</label>
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
                  <label for="inputCity">AePs</label>
                   -
                   <span>OFF</span>
                    <label class="switch">
                      <input type="checkbox" checked>
                      <span class="slider round"></span>
                    </label>
                    <span>ON</span>
                </div>
                <div class="form-group col-md-3">
                   <label for="inputCity">DMT</label>
                    -
                   <span>OFF</span>
                    <label class="switch">
                      <input type="checkbox" checked>
                      <span class="slider round"></span>
                    </label>
                    <span>ON</span>
                </div>
                <div class="form-group col-md-3">
                  <label for="inputCity">X-DMT</label>
                   -
                   <span>OFF</span>
                    <label class="switch">
                      <input type="checkbox" checked>
                      <span class="slider round"></span>
                    </label>
                    <span>ON</span>
                </div>
                <div class="form-group col-md-3">
                  <label for="inputCity">Payout</label>
                   -
                   <span>OFF</span>
                    <label class="switch">
                      <input type="checkbox" checked>
                      <span class="slider round"></span>
                    </label>
                    <span>ON</span>
                </div>
                <div class="form-group col-md-3">
                  <label for="inputCity">Virtual Account</label>
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
                  <label for="inputCity">AePs</label>
                   -
                  <select >
                      <option>Commission 1</option>
                      <option>Commission 2</option>
                      <option>Commission 3</option>
                  </select>
                </div>
                <div class="form-group col-md-4">
                  <label for="inputCity">DMT</label>
                   -
                  <select >
                      <option>Commission 1</option>
                      <option>Commission 2</option>
                      <option>Commission 3</option>
                  </select>
                </div>
                <div class="form-group col-md-4">
                  <label for="inputCity">Electric Bill</label>
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
 
        </form>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary">Activity</button>
        <button type="button" class="btn btn-primary">Update</button>
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
