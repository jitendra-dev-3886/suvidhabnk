<?php
session_start();
include("../Db/config.php");
include("include/Auth.php");

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard </title>


  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- Bootstrap4 Duallistbox -->
  <link rel="stylesheet" href="plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
  <!-- BS Stepper -->
  <link rel="stylesheet" href="plugins/bs-stepper/css/bs-stepper.min.css">
  <!-- dropzonejs -->
  <link rel="stylesheet" href="plugins/dropzone/min/dropzone.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
   <!--Sweet Alert -->
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/css/bootstrap-select.min.css">
  <style>
      input.form-control.menulist {
    width: 15px;
}
  </style>
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
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Price Set Up</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Add Device Price Quantity</li>
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
          <div class="col">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Add Device Price Quantity</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method = "post" id="addempform">
                <div class="card-body">
                
                <div class="form-row d-flex justify-content-around ">
                    
                    <div class="form-group col-md-6">
                        <label >Device Name</label>
                        <input type="text" class="form-control" id="device_name" placeholder="Enter Device Name">
                    </div>
                    
                    <div class="form-group col-md-6">
                        <label >Device Price</label>
                        <input type="text" class="form-control" id="device_price" placeholder="Enter Device Price">
                      </div>
                      
                </div>
                <div class="form-row d-flex justify-content-around">
                    
                    <div class="form-group col-md-6">
                        <label >Quantity</label>
                        <input type="text" class="form-control" id="quantity" placeholder="Enter Quantity">
                      </div>
                </div>


                
        <div class="card-footer d-flex text-center justify-content-center">
                  <button type="submit" id="emp_btn" class="btn btn-primary">Submit</button>
                </div>
            </div>
                <!-- /.card-body -->

             
            </div>
            <!-- /.card -->

  

          </div>
        
                
                </form>
          
            
                         <!-- Main Footer -->
 <?php
    include("include/BottomBar.php");
 ?>


<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Select2 -->
<script src="plugins/select2/js/select2.full.min.js"></script>
<!-- Bootstrap4 Duallistbox -->
<script src="plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
<!-- InputMask -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/inputmask/jquery.inputmask.min.js"></script>
<!-- date-range-picker -->
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- bootstrap color picker -->
<script src="plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Bootstrap Switch -->
<script src="plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<!-- BS-Stepper -->
<script src="plugins/bs-stepper/js/bs-stepper.min.js"></script>
<!-- dropzonejs -->
<script src="plugins/dropzone/min/dropzone.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- multiple dropdown -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.18/dist/js/bootstrap-select.min.js"></script>
<script src="js/state.js"></script>

<script>

    $(document).ready(function(){
        
        $("#emp_btn").click(function(e){
            e.preventDefault();
           let device_name = $("#device_name").val();
           let quantity = $("#quantity").val();
           let device_price = $("#device_price").val();

           if(device_name == ''){
               alert("Please Enter Device Name..!");
           }else if(device_price == ''){
               
               alert("Please Enter Device Price ..!");
           }else if(quantity == ''){
               
               alert("Please Enter Quantity ..!");
           }else{
               $.ajax({
                   url : "handler/Price_SetUp.php",
                   type : "POST",
                   data : {
                       quantity:quantity,
                       device_name:device_name,
                       device_price:device_price,
                       pageid:1
                   },
                   success : function(data){
                       if(data == 1){
                           Swal.fire({
                                  icon: "success",
                                  title: "Hurray!",
                                   button: "Okay",
                                  text: 'Price Set up Successfully.',
                                }).then(function(){ 
                                      $("#addempform")[0].reset();
                                   }
                                );
                       }else{
                           Swal.fire({
                                  icon: "error",
                                  title: "OOPS!",
                                   button: "Close",
                                  text: 'Price Set Up Unsuccessfull.',
                                });
                       }
                   }
               })
           }
           
          
           
        });
    });
    
    
</script>


</body>
</html>

