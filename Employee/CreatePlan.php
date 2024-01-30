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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    
  
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<!--Sweet Alert -->
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Create Subscription Plan</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="https://paydeer.in/">Home</a></li>
              <li class="breadcrumb-item active">Add Subscription Plan</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Create Subscription Plan</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method = "post" id="subsplan_form" name="submit_form">
                <div class="card-body">
                
                <div class="form-row d-flex justify-content-around ">
                    <div class="form-group col-md-4">
                        <label for="exampleInputEmail1">Plan Name</label>
                        <input type="text" class="form-control" name="planname" id="planname" placeholder="Enter Plan Name" required>
                      </div>
                      
                      <div class="form-group col-md-4">
                        <label for="exampleInputEmail1">Plan Amount (INR)</label>
                        <input type="number" class="form-control" name="planamount" id="planamount" placeholder="Enter Plan Amount" required>
                      </div>
                      
                      <div class="form-group col-md-4">
                        <label for="exampleInputEmail1">Interval Type</label>
                        <select class="form-control" id="intervaltype" name="intervaltype" required>
                    <option selected disabled value="0">--Select--</option>
                    <option value="month">Monthly </option>
                    <option value="week">Weekly </option>
                    <option value="day">Daily </option>
                    <option value="year">Yearly </option>
                  </select>
                      </div>
                      
                      <div class="form-group col-md-4">
                        <label for="exampleInputEmail1">Intervals</label>
                        <input type="number" class="form-control" id="interval" name="interval" placeholder="Eg. 1month type 1,2Month type 2" required />
                    
                      </div>
                      
                      <div class="form-group col-md-8">
                        <label for="exampleInputEmail1">Description</label>
                        <input type="text" class="form-control" name="description" id="description" placeholder="Enter about this plan..." required>
                      </div>
                </div>
                
            </div>
                <!-- /.card-body -->
                <div class="card-footer d-flex justify-content-center">
                  <button type="submit" class="btn btn-primary" id="planbtn">Create Plan</button>
                </div>
              </form>
               <div id="response"></div>  
            </div>
            <!-- /.card -->

  

          </div>
          <!--/.col (left) -->
          <!-- right column -->
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous"></script>
  <script type="text/javascript" src="js/jquery.js"></script>
  
<script>
  $(document).ready(function(){
//  add subscription plan...

     $("#subsplan_form").submit(function(e){
         e.preventDefault();
         
             $("#loading_ajax").show();
             
             $.ajax({
                 url:'Backend/Subscription/cashfree/subscription_plan.php',
                 type:'POST',
                 data: new FormData(this),
                 processData:false,
                 contentType:false,
                 success:function(data, status){
                     $("#loading_ajax").hide();
                     let rslt = JSON.parse(data);
                      let rs_code = rslt.response_code; 
                      let msg = rslt.msg; 
                      if(rs_code == 1){
                       Swal.fire({
                                  icon: "success",
                                  title: "Congratulation!",
                                   button: "Okay",
                                  text: msg,
                                }) .then(function(){ 
                                       $("#subsplan_form")[0].reset();
                                   });
                        
                      } 
                      else if(rs_code == 3){
                         Swal.fire({
                                  icon: "error",
                                  title: "OPPS!!",
                                   button: "Close",
                                  text: msg,
                                });
                      }else if(rs_code == 5){
                          Swal.fire({
                                  icon: "error",
                                  title: "OPPS!!",
                                   button: "Close",
                                  text: msg,
                                });
                      }
                    
                 },
                 error:function(err){
                     $("#loading_ajax").hide();
                     Swal.fire({
                                  icon: "error",
                                  title: "OPPS!!",
                                   button: "Close",
                                  text: 'Some internal error occured we are fixing it!',
                                });
                 }
             });
     }); 
     
  });  
  
    
</script>


</body>
</html>
