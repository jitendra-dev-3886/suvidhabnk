<?php
include("config.php");
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>PayDeer | Dashboard </title>

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
            <h1>Add New Employee</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Add New Employee</li>
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
          <div class="col-md-8">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Add New Employee</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method = "post" id="addempform">
                <div class="card-body">
                
                <div class="form-row d-flex justify-content-around ">
                    
                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">Select Department</label>
                        <select class="form-control select2" name="department" style="width: 100%;">
                            
                        <?php
                        $department = $conn->query("SELECT * FROM department order by ID desc");
                         while($department_data = $department->fetch_assoc()){
                        ?>

                        <option value="<?php echo $department_data['ID']?> "> <?php echo $department_data['NAME']?> </option>
                         <?php 
                         }
                         ?>
                            
                        </select>
                    </div>
                      <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">Employee ID</label>
                        <input type="text" class="form-control" name="emp_id" placeholder="Working Type">
                      </div>
                </div>
                <div class="form-row d-flex justify-content-around">
                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">Desgination</label>
                        <input type="text" class="form-control" name="desgination" placeholder="Working Type">
                      </div>
                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">Employee Name</label>
                        <input type="text" class="form-control" name="emp_name" placeholder="Working Criteria">
                      </div>
                </div>
                <div class="form-row d-flex justify-content-around">
                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">Office Number </label>
                        <input type="text" class="form-control" name="office_num" placeholder="Reporting To">
                      </div>
                      <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">Personal Number </label>
                        <input type="text" class="form-control" name="personal_num" placeholder="Reporting To">
                      </div>
                </div>
                
                <div class="form-row d-flex justify-content-around">
                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">Personal Email ID</label>
                        <input type="text" class="form-control" name="personal_email" placeholder="Working Criteria">
                      </div>
                      <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">Office Email ID</label>
                        <input type="text" class="form-control" name="office_email" placeholder="Reporting To">
                    </div>
                </div>
                
                <div class="form-row d-flex justify-content-around">
                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">Working State </label>
                        <select class="select2" multiple="multiple" name="working_state" data-placeholder="Select a State" style="width: 100%;">
                            <option value ="albama">Alabama</option>
                            <option>Alaska</option>
                            <option>California</option>
                            <option>Delaware</option>
                            <option>Tennessee</option>
                            <option>Texas</option>
                            <option>Washington</option>
                          </select>
                      </div>
                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">Working City </label>
                        <select class="select2" multiple="multiple" name="working_city" data-placeholder="Select a State" style="width: 100%;">
                            <option value ="albama">Alabama</option>
                            <option>Alaska</option>
                            <option>California</option>
                            <option>Delaware</option>
                            <option>Tennessee</option>
                            <option>Texas</option>
                            <option>Washington</option>
                          </select>
                      </div>
                </div>
                
                <div class="form-row d-flex justify-content-around">
                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">Working Block </label>
                        <select class="select2" multiple="multiple" name="working_block" data-placeholder="Select a State" style="width: 100%;">
                            <option value ="albama">Alabama</option>
                            <option>Alaska</option>
                            <option>California</option>
                            <option>Delaware</option>
                            <option>Tennessee</option>
                            <option>Texas</option>
                            <option>Washington</option>
                          </select>
                      </div>
                    <!--<div class="form-group col-md-6">-->
                    <!--    <label for="exampleInputEmail1">Working City </label>-->
                    <!--    <input type="text" class="form-control" placeholder="Working City">-->
                    <!--</div>-->
                </div>
                
                <!--<div class="form-row d-flex justify-content-around">-->
                <!--    <div class="form-group col-md-6">-->
                <!--        <label for="exampleInputEmail1">Working Block </label>-->
                <!--        <select class="select2" multiple="multiple" data-placeholder="Select a State" style="width: 100%;">-->
                <!--            <option>Alabama</option>-->
                <!--            <option>Alaska</option>-->
                <!--            <option>California</option>-->
                <!--            <option>Delaware</option>-->
                <!--            <option>Tennessee</option>-->
                <!--            <option>Texas</option>-->
                <!--            <option>Washington</option>-->
                <!--          </select>-->
                <!--      </div>-->
                <!--    <div class="form-group col-md-6">-->
                <!--        <label for="exampleInputEmail1">Working City </label>-->
                <!--        <input type="text" class="form-control" placeholder="Working City">-->
                <!--    </div>-->
                <!--</div>-->
                <div class="form-row d-flex justify-content-around">
                    <div class="form-group col-md-12">
                        <label for="exampleInputEmail1">Residence Address </label>
                        <input type="text" class="form-control" name="residence_address" placeholder="">
                    </div>
                </div>
                
                 <div class="form-row d-flex justify-content-around">
                    <div class="form-group col-md-4">
                        <label for="exampleInputEmail1">State </label>
                         <select class="form-control select2" name="state" style="width: 100%;">
                            <option selected="selected">Alabama</option>
                            <option value ="Alaska">Alaska</option>
                            <option>California</option>
                            <option>Delaware</option>
                            <option>Tennessee</option>
                            <option>Texas</option>
                            <option>Washington</option>
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="exampleInputEmail1">City </label>
                         <select class="form-control select2" name="city" style="width: 100%;">
                            <option selected="selected">Alabama</option>
                            <option value = "Alaska">Alaska</option>
                            <option>California</option>
                            <option>Delaware</option>
                            <option>Tennessee</option>
                            <option>Texas</option>
                            <option>Washington</option>
                        </select>
                    </div>
                     <div class="form-group col-md-3">
                        <label for="exampleInputEmail1">Pin Code</label>
                         <select class="form-control select2" name="pincode" style="width: 100%;">
                            <option selected="selected">712222</option>
                            <option value = "823003">823003</option>
                            <option>823003</option>
                            <option>823003</option>
                            <option>823003</option>
                        </select>
                    </div>
                </div>
      
            </div>
                <!-- /.card-body -->

                <div class="card-footer d-flex justify-content-center">
                  <button type="submit" id="emp_btn" class="btn btn-primary">Add Employee</button>
                </div>
              </form>
            </div>
            <!-- /.card -->

  

          </div>
          <!--/.col (left) -->
          <div class="col-md-4">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Menu Managment</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form>
                <div class="card-body">
                
                    <div class="sidebar mt-1" style="overflow-y: auto;">



      <!-- Sidebar Menu -->
      <nav class="mt-1">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

          <li class="nav-header">
               <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox1" value="option1">
                  <label for="customCheckbox1" class="custom-control-label"> MEMBER MANAGMENT</label>
                </div>
              </p>
         </li>
         
          <li class="nav-header">
               <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox2" value="option2"'>
                  <label for="customCheckbox2" class="custom-control-label"> MEMBER </label>
                </div>
              </p>
         </li>
         
          <div id="checkboxes">
          <li class="nav-item">
            <a href="#" class="nav-link">
             <p>
                <div class="custom-control custom-checkbox">
                    <input class="custom-control-inputt" type="checkbox" name="" value="distributorrequest" id="customCheckbox3" value="option3">
                  <label for="customCheckbox3" class=""> <i class="far fa-circle nav-icon"></i> Member List</label>
                  
                </div>
              </p>
            </a>
          </li>
          
          <li class="nav-item">
            <a href="#" class="nav-link">
             <p>
                <div class="custom-control custom-checkbox">
                    <input class="custom-control-inputt" type="checkbox" name="" value="distributorrequest" id="customCheckbox4" value="option4">
                  <label for="customCheckbox4" class=""> <i class="far fa-circle nav-icon"></i> Retailer Verification</label>
                  
                </div>
              </p>
            </a>
          </li>
          
          
          <li class="nav-item">
            <a href="#" class="nav-link">
             <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-inputt" type="checkbox" name="" value="distributorrequest" id="customCheckbox5" value="option5">
                  <label for="customCheckbox5" class=""> <i class="far fa-circle nav-icon"></i> Distributor Request</label>
                </div>
              </p>
            </a>
          </li>
          
          <li class="nav-item">
            <a href="#" class="nav-link">
             <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-inputt" type="checkbox" name="" value="websitesignuprequests" id="customCheckbox6" value="option6">
                  <label for="customCheckbox6" class=""> <i class="far fa-circle nav-icon"></i> Website Signup Requests</label>
                </div>
              </p>
            </a>
          </li>
          </div>
          
          
          <li class="nav-header">
               <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox7" value="option7"'>
                  <label for="customCheckbox7" class="custom-control-label"> Employee Managment</label>
                </div>
              </p>
         </li>
         <div id="checkboxes1">
          <li class="nav-item">
            <a href="#" class="nav-link">
                <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input-example2" type="checkbox" id="customCheckbox8" value="option8">
                  <label for="customCheckbox8" class=""> <i class="nav-icon fas fa-fingerprint"></i> Add Employee</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
                <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input-example2" type="checkbox" id="customCheckbox9" value="option9">
                  <label for="customCheckbox9" class=""> <i class="nav-icon fas fa-fingerprint"></i> Employee List</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
                <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input-example2" type="checkbox" id="customCheckbox10" value="option10">
                  <label for="customCheckbox10" class=""> <i class="nav-icon fas fa-fingerprint"></i> Add Department</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
                <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input-example2" type="checkbox" id="customCheckbox11" value="option11">
                  <label for="customCheckbox11" class=""> <i class="nav-icon fas fa-fingerprint"></i> Department List</label>
                </div>
              </p>
            </a>
          </li>
          </div>
          
          
          <li class="nav-header">
               <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox12" value="option12"'>
                  <label for="customCheckbox12" class="custom-control-label"> Wallet Managment</label>
                </div>
              </p>
         </li>
         <div id="checkboxes2">
          <li class="nav-item">
            <a href="#" class="nav-link">
              <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input-example3" type="checkbox" id="customCheckbox13" value="option13">
                  <label for="customCheckbox13" class=""> <i class="nav-icon fas fa-fingerprint"></i> Main Wallet Report</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input-example3" type="checkbox" id="customCheckbox14" value="option14">
                  <label for="customCheckbox14" class=""> <i class="nav-icon fas fa-fingerprint"></i> AePs Wallet Report</label>
                </div>
              </p>
            </a>
          </li>
          </div>
        
         <li class="nav-header">
               <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox15" value="option15">
                  <label for="customCheckbox15" class="custom-control-label"> ACCOUNT MANAGMENT</label>
                </div>
              </p>
         </li>
         <li class="nav-header">
               <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox16" value="option16">
                  <label for="customCheckbox16" class="custom-control-label"> Agent Fund Transfer</label>
                </div>
              </p>
         </li>
          
          <li class="nav-item">
            <a href="#" class="nav-link">
              <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox17" value="option17">
                  <label for="customCheckbox17" class="custom-control-label"> <i class="nav-icon fas fa-fingerprint"></i> Main Wallet</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox18" value="option18">
                  <label for="customCheckbox18" class="custom-control-label"> <i class="nav-icon fas fa-fingerprint"></i> AePs Wallet</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-header">
               <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox19" value="option19">
                  <label for="customCheckbox19" class="custom-control-label"> Fund Transfer Report</label>
                </div>
              </p>
         </li>
          
          <li class="nav-item">
            <a href="#" class="nav-link">
              <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox20" value="option20">
                  <label for="customCheckbox20" class="custom-control-label"> <i class="nav-icon fas fa-fingerprint"></i> Main Wallet</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox21" value="option21">
                  <label for="customCheckbox21" class="custom-control-label"> <i class="nav-icon fas fa-fingerprint"></i> AePs Wallet</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-header">
               <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox22" value="option22">
                  <label for="customCheckbox22" class="custom-control-label"> Agent Transaction Report</label>
                </div>
              </p>
         </li>
          
          <li class="nav-item">
            <a href="#" class="nav-link">
              <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox23" value="option23">
                  <label for="customCheckbox23" class="custom-control-label"> <i class="nav-icon fas fa-fingerprint"></i> Main Wallet</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox24" value="option24">
                  <label for="customCheckbox24" class="custom-control-label"> <i class="nav-icon fas fa-fingerprint"></i> AePs Wallet</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
                <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox25" value="option25">
                  <label for="customCheckbox25" class="custom-control-label"><i class="nav-icon fas fa-fingerprint"></i>  All Commission Report</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
                <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox26" value="option26">
                  <label for="customCheckbox26" class="custom-control-label"><i class="nav-icon fas fa-fingerprint"></i>  P & L Report</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
                <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox27" value="option27">
                  <label for="customCheckbox27" class="custom-control-label"><i class="nav-icon fas fa-fingerprint"></i>  Invoices</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
                <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox28" value="option28">
                  <label for="customCheckbox28" class="custom-control-label"><i class="nav-icon fas fa-fingerprint"></i>  TDS Report</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
                <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox29" value="option29">
                  <label for="customCheckbox29" class="custom-control-label"><i class="nav-icon fas fa-fingerprint"></i>  GST Report</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-header">
               <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox30" value="option30">
                  <label for="customCheckbox30" class="custom-control-label"> Reseller Accounts</label>
                </div>
              </p>
         </li>
         <li class="nav-header">
               <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox31" value="option31">
                  <label for="customCheckbox31" class="custom-control-label"> Reseller</label>
                </div>
              </p>
         </li>
          <li class="nav-header">
               <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox32" value="option32">
                  <label for="customCheckbox32" class="custom-control-label"> Fund Transfer</label>
                </div>
              </p>
         </li>
          
          <li class="nav-item">
            <a href="#" class="nav-link">
                <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox33" value="option33">
                  <label for="customCheckbox33" class="custom-control-label"><i class="nav-icon fas fa-fingerprint"></i>  Main Wallet</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
                <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox34" value="option34">
                  <label for="customCheckbox34" class="custom-control-label"><i class="nav-icon fas fa-fingerprint"></i>  AePs Wallet</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-header">
               <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox35" value="option35">
                  <label for="customCheckbox35" class="custom-control-label"> Fund Transfer Report</label>
                </div>
              </p>
         </li>
          
          <li class="nav-item">
            <a href="#" class="nav-link">
                <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox36" value="option36">
                  <label for="customCheckbox36" class="custom-control-label"><i class="nav-icon fas fa-fingerprint"></i>  Main Wallet</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
                <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox37" value="option37">
                  <label for="customCheckbox37" class="custom-control-label"><i class="nav-icon fas fa-fingerprint"></i>  AePs Wallet</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-header">
               <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox38" value="option38">
                  <label for="customCheckbox38" class="custom-control-label"> Transaction Report</label>
                </div>
              </p>
         </li>
          
          <li class="nav-item">
            <a href="#" class="nav-link">
                <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox39" value="option39">
                  <label for="customCheckbox39" class="custom-control-label"><i class="nav-icon fas fa-fingerprint"></i>  Main Wallet</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
                <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox40" value="option40">
                  <label for="customCheckbox40" class="custom-control-label"><i class="nav-icon fas fa-fingerprint"></i>  AePs Wallet</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-header">
               <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox41" value="option41">
                  <label for="customCheckbox41" class="custom-control-label"> Reseller Agent</label>
                </div>
              </p>
         </li>
          <li class="nav-header">
               <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox42" value="option42">
                  <label for="customCheckbox42" class="custom-control-label"> Fund Transfer</label>
                </div>
              </p>
         </li>
          
          <li class="nav-item">
            <a href="#" class="nav-link">
                <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox43" value="option43">
                  <label for="customCheckbox43" class="custom-control-label"><i class="nav-icon fas fa-fingerprint"></i>  Main Wallet</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
                <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox44" value="option44">
                  <label for="customCheckbox44" class="custom-control-label"><i class="nav-icon fas fa-fingerprint"></i>  AePs Wallet</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-header">
               <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox45" value="option45">
                  <label for="customCheckbox45" class="custom-control-label"> Fund Transfer Report</label>
                </div>
              </p>
         </li>
          
          <li class="nav-item">
            <a href="#" class="nav-link">
                <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox46" value="option46">
                  <label for="customCheckbox46" class="custom-control-label"><i class="nav-icon fas fa-fingerprint"></i>  Main Wallet</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
                <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox47" value="option47">
                  <label for="customCheckbox47" class="custom-control-label"><i class="nav-icon fas fa-fingerprint"></i>  AePs Wallet</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-header">
               <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox48" value="option48">
                  <label for="customCheckbox48" class="custom-control-label"> Transaction Report</label>
                </div>
              </p>
         </li>
          
          <li class="nav-item">
            <a href="#" class="nav-link">
                <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox49" value="option49">
                  <label for="customCheckbox49" class="custom-control-label"><i class="nav-icon fas fa-fingerprint"></i>  Main Wallet</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
                <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox50" value="option50">
                  <label for="customCheckbox50" class="custom-control-label"><i class="nav-icon fas fa-fingerprint"></i>  AePs Wallet</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
                <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox51" value="option51">
                  <label for="customCheckbox51" class="custom-control-label"><i class="nav-icon fas fa-fingerprint"></i>  All Commission Report</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
                <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox52" value="option52">
                  <label for="customCheckbox52" class="custom-control-label"><i class="nav-icon fas fa-fingerprint"></i>  P & L Report</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
                <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox53" value="option53">
                  <label for="customCheckbox53" class="custom-control-label"><i class="nav-icon fas fa-fingerprint"></i>  Invoices</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
                <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox54" value="option54">
                  <label for="customCheckbox54" class="custom-control-label"><i class="nav-icon fas fa-fingerprint"></i>  TDS Report</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
                <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox55" value="option55">
                  <label for="customCheckbox55" class="custom-control-label"><i class="nav-icon fas fa-fingerprint"></i>  GST Report</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-header"> 
              <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox56" value="option56">
                  <label for="customCheckbox56" class="custom-control-label"> SERVICE MANAGMENT</label>
                </div>
              </p>
          </li>
          <li class="nav-header"> 
              <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox57" value="option57">
                  <label for="customCheckbox57" class="custom-control-label"> AePs Services</label>
                </div>
              </p>
          </li>
          <li class="nav-header"> 
              <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox58" value="option58">
                  <label for="customCheckbox58" class="custom-control-label"> AePs</label>
                </div>
              </p>
          </li>
          
          <li class="nav-item">
            <a href="#" class="nav-link">
              <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox59" value="option59">
                  <label for="customCheckbox59" class="custom-control-label"><i class="nav-icon fas fa-fingerprint"></i> AePs Report</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox60" value="option60">
                  <label for="customCheckbox60" class="custom-control-label"><i class="nav-icon fas fa-fingerprint"></i> Commission Setup</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox61" value="option61">
                  <label for="customCheckbox61" class="custom-control-label"><i class="nav-icon fas fa-fingerprint"></i> AePs Server Setup</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-header"> 
              <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox62" value="option62">
                  <label for="customCheckbox62" class="custom-control-label"> Mini Statement</label>
                </div>
              </p>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox63" value="option63">
                  <label for="customCheckbox63" class="custom-control-label"><i class="nav-icon fas fa-fingerprint"></i> Mini Statement Commission Setup</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-header"> 
              <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox64" value="option64">
                  <label for="customCheckbox64" class="custom-control-label"> AdharPay</label>
                </div>
              </p>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox65" value="option65">
                  <label for="customCheckbox65" class="custom-control-label"><i class="nav-icon fas fa-fingerprint"></i> AdharPay Report</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox66" value="option66">
                  <label for="customCheckbox66" class="custom-control-label"><i class="nav-icon fas fa-fingerprint"></i> Commission Setup</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox67" value="option67">
                  <label for="customCheckbox67" class="custom-control-label"><i class="nav-icon fas fa-fingerprint"></i> AdharPay Server Setup</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-header"> 
              <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox68" value="option68">
                  <label for="customCheckbox68" class="custom-control-label"> Cash Deposite</label>
                </div>
              </p>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox69" value="option69">
                  <label for="customCheckbox69" class="custom-control-label"><i class="nav-icon fas fa-fingerprint"></i> Cash Deposite Report</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox70" value="option70">
                  <label for="customCheckbox70" class="custom-control-label"><i class="nav-icon fas fa-fingerprint"></i> Commission Setup</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox71" value="option71">
                  <label for="customCheckbox71" class="custom-control-label"><i class="nav-icon fas fa-fingerprint"></i> Server Setup</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-header"> 
              <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox72" value="option72">
                  <label for="customCheckbox72" class="custom-control-label"> M-ATM</label>
                </div>
              </p>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox73" value="option73">
                  <label for="customCheckbox73" class="custom-control-label"><i class="nav-icon fas fa-fingerprint"></i> Purchase Request</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox74" value="option74">
                  <label for="customCheckbox74" class="custom-control-label"><i class="nav-icon fas fa-fingerprint"></i> M-ATM Price Setup</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox75" value="option75">
                  <label for="customCheckbox75" class="custom-control-label"><i class="nav-icon fas fa-fingerprint"></i> M-ATM Report</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox76" value="option76">
                  <label for="customCheckbox76" class="custom-control-label"><i class="nav-icon fas fa-fingerprint"></i> Commission Setup</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox77" value="option77">
                  <label for="customCheckbox77" class="custom-control-label"><i class="nav-icon fas fa-fingerprint"></i> M-ATM Server Setup</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-header"> 
              <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox78" value="option78">
                  <label for="customCheckbox78" class="custom-control-label"> Money Transfer</label>
                </div>
              </p>
          </li>
          <li class="nav-header"> 
              <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox79" value="option79">
                  <label for="customCheckbox79" class="custom-control-label"> DMT</label>
                </div>
              </p>
          </li>
          
          <li class="nav-item">
            <a href="#" class="nav-link">
              <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox80" value="option80">
                  <label for="customCheckbox80" class="custom-control-label"><i class="nav-icon fas fa-fingerprint"></i> DMT Report</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox81" value="option81">
                  <label for="customCheckbox81" class="custom-control-label"><i class="nav-icon fas fa-fingerprint"></i> DMT Charge Setup</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox82" value="option82">
                  <label for="customCheckbox82" class="custom-control-label"><i class="nav-icon fas fa-fingerprint"></i> DMT Server Setup</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-header"> 
              <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox83" value="option83">
                  <label for="customCheckbox83" class="custom-control-label"> X-DMT</label>
                </div>
              </p>
          </li>
          
          <li class="nav-item">
            <a href="#" class="nav-link">
              <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox84" value="option84">
                  <label for="customCheckbox84" class="custom-control-label"><i class="nav-icon fas fa-fingerprint"></i> X-DMT Report</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox85" value="option85">
                  <label for="customCheckbox85" class="custom-control-label"><i class="nav-icon fas fa-fingerprint"></i> X-DMT Charge Setup</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox86" value="option86">
                  <label for="customCheckbox86" class="custom-control-label"><i class="nav-icon fas fa-fingerprint"></i> X-DMT Server Setup</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-header"> 
              <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox87" value="option87">
                  <label for="customCheckbox87" class="custom-control-label"> UPI</label>
                </div>
              </p>
          </li>
          
          <li class="nav-item">
            <a href="#" class="nav-link">
              <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox88" value="option88">
                  <label for="customCheckbox88" class="custom-control-label"><i class="nav-icon fas fa-fingerprint"></i> UPI Report</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox89" value="option89">
                  <label for="customCheckbox89" class="custom-control-label"><i class="nav-icon fas fa-fingerprint"></i> UPI Commission Setup</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox90" value="option90">
                  <label for="customCheckbox90" class="custom-control-label"><i class="nav-icon fas fa-fingerprint"></i> UPI Server Setup</label>
                </div>
              </p>
            </a>
          </li>
          
          
          
         <li class="nav-header"> 
              <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox91" value="option92">
                  <label for="customCheckbox92" class="custom-control-label"> Recharge Services</label>
                </div>
              </p>
          </li>
          <li class="nav-header"> 
              <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox93" value="option93">
                  <label for="customCheckbox93" class="custom-control-label"> Recharge</label>
                </div>
              </p>
          </li>
          
          <li class="nav-item">
            <a href="#" class="nav-link">
             <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox94" value="option94">
                  <label for="customCheckbox94" class="custom-control-label"><i class="nav-icon fas fa-mobile-alt"></i> Recharge Report</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
             <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox95" value="option95">
                  <label for="customCheckbox95" class="custom-control-label"><i class="nav-icon fas fa-mobile-alt"></i> Commission Setup</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
             <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox96" value="option96">
                  <label for="customCheckbox96" class="custom-control-label"><i class="nav-icon fas fa-mobile-alt"></i> Recharge Server Setup</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-header"> 
              <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox97" value="option97">
                  <label for="customCheckbox97" class="custom-control-label"> DTH</label>
                </div>
              </p>
          </li>
          
          <li class="nav-item">
            <a href="#" class="nav-link">
             <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox98" value="option98">
                  <label for="customCheckbox98" class="custom-control-label"><i class="nav-icon fas fa-mobile-alt"></i> DTH Report</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
             <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox99" value="option99">
                  <label for="customCheckbox99" class="custom-control-label"><i class="nav-icon fas fa-mobile-alt"></i> DTH Setup</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
             <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox100" value="option100">
                  <label for="customCheckbox100" class="custom-control-label"><i class="nav-icon fas fa-mobile-alt"></i> DTH Server Setup</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-header"> 
              <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox101" value="option101">
                  <label for="customCheckbox101" class="custom-control-label"> Landline</label>
                </div>
              </p>
          </li>
          
          <li class="nav-item">
            <a href="#" class="nav-link">
             <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox102" value="option102">
                  <label for="customCheckbox102" class="custom-control-label"><i class="nav-icon fas fa-mobile-alt"></i> Landline Report</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
             <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox103" value="option103">
                  <label for="customCheckbox103" class="custom-control-label"><i class="nav-icon fas fa-mobile-alt"></i> Landline Commission Setup</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
             <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox104" value="option104">
                  <label for="customCheckbox104" class="custom-control-label"><i class="nav-icon fas fa-mobile-alt"></i> Landline Server Setup</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-header"> 
              <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox105" value="option105">
                  <label for="customCheckbox105" class="custom-control-label"> Data Card</label>
                </div>
              </p>
          </li>
          
          <li class="nav-item">
            <a href="#" class="nav-link">
             <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox106" value="option106">
                  <label for="customCheckbox106" class="custom-control-label"><i class="nav-icon fas fa-mobile-alt"></i> Data Card Report</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
             <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox107" value="option107">
                  <label for="customCheckbox107" class="custom-control-label"><i class="nav-icon fas fa-mobile-alt"></i> Data Card Commission Setup</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
             <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox108" value="option108">
                  <label for="customCheckbox108" class="custom-control-label"><i class="nav-icon fas fa-mobile-alt"></i> Data Card Server Setup</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-header"> 
              <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox109" value="option109">
                  <label for="customCheckbox109" class="custom-control-label"> Payout</label>
                </div>
              </p>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
                <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox110" value="option110">
                  <label for="customCheckbox110" class="custom-control-label"><i class="nav-icon fas fa-university"></i> Payout Report</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
                <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox111" value="option111">
                  <label for="customCheckbox111" class="custom-control-label"><i class="nav-icon fas fa-university"></i> Payout Charge Setup</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
                <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox112" value="option112">
                  <label for="customCheckbox112" class="custom-control-label"><i class="nav-icon fas fa-university"></i> Payout Server Setup</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-header"> 
              <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox113" value="option113">
                  <label for="customCheckbox113" class="custom-control-label"> Loan/Finance (Offline)</label>
                </div>
              </p>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
                <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox114" value="option114">
                  <label for="customCheckbox114" class="custom-control-label"><i class="nav-icon fas fa-university"></i> Application Request</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
                <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox115" value="option115">
                  <label for="customCheckbox115" class="custom-control-label"><i class="nav-icon fas fa-university"></i> Loan Report</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
                <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox116" value="option116">
                  <label for="customCheckbox116" class="custom-control-label"><i class="nav-icon fas fa-university"></i> Loan Commission Setup</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox117" value="option117">
                  <label for="customCheckbox117" class="custom-control-label"><i class="nav-icon far fa-credit-card"></i> Server Setup</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-header"> 
              <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox118" value="option118">
                  <label for="customCheckbox118" class="custom-control-label"> Insurance (Offline)</label>
                </div>
              </p>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
                <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox119" value="option119">
                  <label for="customCheckbox119" class="custom-control-label"><i class="nav-icon fas fa-university"></i> Application Request</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
                <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox120" value="option120">
                  <label for="customCheckbox120" class="custom-control-label"><i class="nav-icon fas fa-university"></i> Report</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
                <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox121" value="option121">
                  <label for="customCheckbox121" class="custom-control-label"><i class="nav-icon fas fa-university"></i> Commission Setup</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox122" value="option122">
                  <label for="customCheckbox122" class="custom-control-label"><i class="nav-icon far fa-credit-card"></i> Server Setup</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-header"> 
              <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox123" value="option123">
                  <label for="customCheckbox123" class="custom-control-label"> E-Tax Services (Offline)</label>
                </div>
              </p>
          </li>
          <li class="nav-header"> 
              <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox124" value="option124">
                  <label for="customCheckbox124" class="custom-control-label"> Pan Card</label>
                </div>
              </p>
          </li>
          
          <li class="nav-item">
            <a href="#" class="nav-link">
                <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox125" value="option125">
                  <label for="customCheckbox125" class="custom-control-label"><i class="nav-icon fas fa-university"></i> Report</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
                <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox126" value="option126">
                  <label for="customCheckbox126" class="custom-control-label"><i class="nav-icon fas fa-university"></i> Coupon Request</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox127" value="option127">
                  <label for="customCheckbox127" class="custom-control-label"><i class="nav-icon far fa-credit-card"></i> Commission Setup</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
                <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox128" value="option128">
                  <label for="customCheckbox128" class="custom-control-label"><i class="nav-icon far fa-credit-card"></i> Server Setup</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-header"> 
              <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox129" value="option129">
                  <label for="customCheckbox129" class="custom-control-label"> GST</label>
                </div>
              </p>
          </li>
          
          <li class="nav-item">
            <a href="#" class="nav-link">
                <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox130" value="option130">
                  <label for="customCheckbox130" class="custom-control-label"><i class="nav-icon fas fa-university"></i> Report</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
                <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox131" value="option131">
                  <label for="customCheckbox131" class="custom-control-label"><i class="nav-icon fas fa-university"></i> Coupon Request</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox132" value="option132">
                  <label for="customCheckbox132" class="custom-control-label"><i class="nav-icon far fa-credit-card"></i> Commission Setup</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
                <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox133" value="option133">
                  <label for="customCheckbox133" class="custom-control-label"><i class="nav-icon far fa-credit-card"></i> Server Setup</label>
                </div>
              </p>
            </a>
          </li>
          
          
          <li class="nav-header"> 
              <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox134" value="option134">
                  <label for="customCheckbox134" class="custom-control-label"> Compamy Registration</label>
                </div>
              </p>
          </li>
          
          <li class="nav-item">
            <a href="#" class="nav-link">
                <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox135" value="option135">
                  <label for="customCheckbox135" class="custom-control-label"><i class="nav-icon fas fa-university"></i> Report</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
                <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox136" value="option136">
                  <label for="customCheckbox136" class="custom-control-label"><i class="nav-icon fas fa-university"></i> Coupon Request</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox137" value="option137">
                  <label for="customCheckbox137" class="custom-control-label"><i class="nav-icon far fa-credit-card"></i> Commission Setup</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
                <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox138" value="option138">
                  <label for="customCheckbox138" class="custom-control-label"><i class="nav-icon far fa-credit-card"></i> Server Setup</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-header"> 
              <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox138" value="option138">
                  <label for="customCheckbox138" class="custom-control-label"> TDS</label>
                </div>
              </p>
          </li>
          
          <li class="nav-item">
            <a href="#" class="nav-link">
                <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox139" value="option139">
                  <label for="customCheckbox139" class="custom-control-label"><i class="nav-icon fas fa-university"></i> Report</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
                <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox140" value="option140">
                  <label for="customCheckbox140" class="custom-control-label"><i class="nav-icon fas fa-university"></i> Coupon Request</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox141" value="option141">
                  <label for="customCheckbox141" class="custom-control-label"><i class="nav-icon far fa-credit-card"></i> Commission Setup</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
                <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox142" value="option142">
                  <label for="customCheckbox142" class="custom-control-label"><i class="nav-icon far fa-credit-card"></i> Server Setup</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-header"> 
              <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox143" value="option143">
                  <label for="customCheckbox143" class="custom-control-label"> ITR</label>
                </div>
              </p>
          </li>
          
          <li class="nav-item">
            <a href="#" class="nav-link">
                <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox144" value="option144">
                  <label for="customCheckbox144" class="custom-control-label"><i class="nav-icon fas fa-university"></i> Report</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
                <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox145" value="option145">
                  <label for="customCheckbox145" class="custom-control-label"><i class="nav-icon fas fa-university"></i> Coupon Request</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox146" value="option146">
                  <label for="customCheckbox146" class="custom-control-label"><i class="nav-icon far fa-credit-card"></i> Commission Setup</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
                <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox147" value="option147">
                  <label for="customCheckbox147" class="custom-control-label"><i class="nav-icon far fa-credit-card"></i> Server Setup</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-header"> 
              <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox148" value="option148">
                  <label for="customCheckbox148" class="custom-control-label"> DSC</label>
                </div>
              </p>
          </li>
          
          <li class="nav-item">
            <a href="#" class="nav-link">
                <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox149" value="option149">
                  <label for="customCheckbox149" class="custom-control-label"><i class="nav-icon fas fa-university"></i> Report</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
                <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox150" value="option150">
                  <label for="customCheckbox150" class="custom-control-label"><i class="nav-icon fas fa-university"></i> Coupon Request</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox151" value="option151">
                  <label for="customCheckbox151" class="custom-control-label"><i class="nav-icon far fa-credit-card"></i> Commission Setup</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
                <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox152" value="option152">
                  <label for="customCheckbox152" class="custom-control-label"><i class="nav-icon far fa-credit-card"></i> Server Setup</label>
                </div>
              </p>
            </a>
          </li>
          
         <li class="nav-header"> 
              <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox153" value="option153">
                  <label for="customCheckbox153" class="custom-control-label"> Account Opening</label>
                </div>
              </p>
          </li>
          <li class="nav-header"> 
              <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox154" value="option154">
                  <label for="customCheckbox154" class="custom-control-label"> Axis Bank</label>
                </div>
              </p>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
                <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox155" value="option155">
                  <label for="customCheckbox155" class="custom-control-label"><i class="nav-icon fas fa-university"></i> Axis Bank Report</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
                <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox156" value="option156">
                  <label for="customCheckbox156" class="custom-control-label"><i class="nav-icon fas fa-university"></i> Commission Setup</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
                <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox157" value="option157">
                  <label for="customCheckbox158" class="custom-control-label"><i class="nav-icon far fa-credit-card"></i> Server Setup</label>
                </div>
              </p>
            </a>
          </li>
          
          
          <li class="nav-header"> 
              <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox158" value="option158">
                  <label for="customCheckbox158" class="custom-control-label"> BBPS</label>
                </div>
              </p>
          </li>
          <li class="nav-header"> 
              <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox159" value="option159">
                  <label for="customCheckbox159" class="custom-control-label"> Online BBPS</label>
                </div>
              </p>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
                <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox160" value="option160">
                  <label for="customCheckbox160" class="custom-control-label"><i class="nav-icon fas fa-university"></i> BBPS Report</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
                <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox161" value="option161">
                  <label for="customCheckbox161" class="custom-control-label"><i class="nav-icon fas fa-university"></i> Commission Setup</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
                <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox162" value="option162">
                  <label for="customCheckbox162" class="custom-control-label"><i class="nav-icon far fa-credit-card"></i> BBPS Server Setup</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-header"> 
              <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox163" value="option163">
                  <label for="customCheckbox163" class="custom-control-label"> Offline BBPS</label>
                </div>
              </p>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
                <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox164" value="option164">
                  <label for="customCheckbox164" class="custom-control-label"><i class="nav-icon fas fa-university"></i> BBPS Report</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
                <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox165" value="option165">
                  <label for="customCheckbox165" class="custom-control-label"><i class="nav-icon fas fa-university"></i> Commission Setup</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-header"> 
              <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox166" value="option166">
                  <label for="customCheckbox166" class="custom-control-label"> Broadband</label>
                </div>
              </p>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
                <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox167" value="option167">
                  <label for="customCheckbox167" class="custom-control-label"><i class="nav-icon fas fa-university"></i> Report</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
                <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox168" value="option168">
                  <label for="customCheckbox168" class="custom-control-label"><i class="nav-icon fas fa-university"></i> Commission Setup</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
                <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox169" value="option169">
                  <label for="customCheckbox169" class="custom-control-label"><i class="nav-icon far fa-credit-card"></i> Server Setup</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-header"> 
              <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox170" value="option170">
                  <label for="customCheckbox170" class="custom-control-label"> Electricity</label>
                </div>
              </p>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
                <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox171" value="option171">
                  <label for="customCheckbox171" class="custom-control-label"><i class="nav-icon fas fa-university"></i> Report</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
                <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox172" value="option172">
                  <label for="customCheckbox172" class="custom-control-label"><i class="nav-icon fas fa-university"></i> Commission Setup</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
                <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox173" value="option173">
                  <label for="customCheckbox173" class="custom-control-label"><i class="nav-icon far fa-credit-card"></i> Server Setup</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-header"> 
              <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox174" value="option174">
                  <label for="customCheckbox174" class="custom-control-label"> Water Bill Payment</label>
                </div>
              </p>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
                <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox175" value="option175">
                  <label for="customCheckbox175" class="custom-control-label"><i class="nav-icon fas fa-university"></i> Report</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
                <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox176" value="option176">
                  <label for="customCheckbox176" class="custom-control-label"><i class="nav-icon fas fa-university"></i> Commission Setup</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
                <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox177" value="option177">
                  <label for="customCheckbox177" class="custom-control-label"><i class="nav-icon far fa-credit-card"></i> Server Setup</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-header"> 
              <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox178" value="option178">
                  <label for="customCheckbox178" class="custom-control-label"> LIC Bill Payment</label>
                </div>
              </p>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
                <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox179" value="option179">
                  <label for="customCheckbox179" class="custom-control-label"><i class="nav-icon fas fa-university"></i> Payment Report</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
                <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox180" value="option180">
                  <label for="customCheckbox180" class="custom-control-label"><i class="nav-icon fas fa-university"></i> Commission Setup</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
                <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox181" value="option181">
                  <label for="customCheckbox181" class="custom-control-label"><i class="nav-icon far fa-credit-card"></i> Server Setup</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-header"> 
              <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox182" value="option182">
                  <label for="customCheckbox182" class="custom-control-label"> EMI Payment</label>
                </div>
              </p>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
                <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox183" value="option183">
                  <label for="customCheckbox183" class="custom-control-label"><i class="nav-icon fas fa-university"></i> EMI Payment Report</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
                <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox184" value="option184">
                  <label for="customCheckbox184" class="custom-control-label"><i class="nav-icon fas fa-university"></i> Commission Setup</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
                <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox185" value="option185">
                  <label for="customCheckbox185" class="custom-control-label"><i class="nav-icon far fa-credit-card"></i> Server Setup</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-header"> 
              <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox186" value="option186">
                  <label for="customCheckbox186" class="custom-control-label"> GAS Payment</label>
                </div>
              </p>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
                <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox187" value="option187">
                  <label for="customCheckbox187" class="custom-control-label"><i class="nav-icon fas fa-university"></i> Report</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
                <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox188" value="option188">
                  <label for="customCheckbox188" class="custom-control-label"><i class="nav-icon fas fa-university"></i> Commission Setup</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
                <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox189" value="option189">
                  <label for="customCheckbox189" class="custom-control-label"><i class="nav-icon far fa-credit-card"></i> Server Setup</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-header"> 
              <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox190" value="option190">
                  <label for="customCheckbox190" class="custom-control-label"> Credit Card Bill Payment</label>
                </div>
              </p>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
                <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox191" value="option191">
                  <label for="customCheckbox191" class="custom-control-label"><i class="nav-icon fas fa-university"></i> Requset Page</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
                <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox192" value="option192">
                  <label for="customCheckbox192" class="custom-control-label"><i class="nav-icon fas fa-university"></i> Report</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
                <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox193" value="option193">
                  <label for="customCheckbox193" class="custom-control-label"><i class="nav-icon fas fa-university"></i> Commission Setup</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
                <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox194" value="option194">
                  <label for="customCheckbox194" class="custom-control-label"><i class="nav-icon far fa-credit-card"></i> Server Setup</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-header"> 
              <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox195" value="option195">
                  <label for="customCheckbox195" class="custom-control-label"> Rent On Credit Card</label>
                </div>
              </p>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
                <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox196" value="option196">
                  <label for="customCheckbox196" class="custom-control-label"><i class="nav-icon fas fa-university"></i> Request Page</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
                <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox197" value="option197">
                  <label for="customCheckbox197" class="custom-control-label"><i class="nav-icon fas fa-university"></i> Report</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
                <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox198" value="option198">
                  <label for="customCheckbox198" class="custom-control-label"><i class="nav-icon fas fa-university"></i> Commission Setup</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
                <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox199" value="option199">
                  <label for="customCheckbox199" class="custom-control-label"><i class="nav-icon far fa-credit-card"></i> Server Setup</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-header"> 
              <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox200" value="option200">
                  <label for="customCheckbox200" class="custom-control-label"> FasTag</label>
                </div>
              </p>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
                <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox201" value="option201">
                  <label for="customCheckbox201" class="custom-control-label"><i class="nav-icon fas fa-university"></i> Report</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
                <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox202" value="option202">
                  <label for="customCheckbox202" class="custom-control-label"><i class="nav-icon fas fa-university"></i> Commission Setup</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
                <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox203" value="option203">
                  <label for="customCheckbox203" class="custom-control-label"><i class="nav-icon far fa-credit-card"></i> Server Setup</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-header"> 
              <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox204" value="option204">
                  <label for="customCheckbox204" class="custom-control-label"> Ticket Booking</label>
                </div>
              </p>
          </li>
          <li class="nav-header"> 
              <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox205" value="option205">
                  <label for="customCheckbox205" class="custom-control-label"> Bus</label>
                </div>
              </p>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
                <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox206" value="option206">
                  <label for="customCheckbox206" class="custom-control-label"><i class="nav-icon fas fa-university"></i> Request Page</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
                <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox207" value="option207">
                  <label for="customCheckbox207" class="custom-control-label"><i class="nav-icon fas fa-university"></i> Report</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
                <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox208" value="option208">
                  <label for="customCheckbox208" class="custom-control-label"><i class="nav-icon far fa-credit-card"></i> Commission Setup</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
                <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox209" value="option209">
                  <label for="customCheckbox209" class="custom-control-label"><i class="nav-icon far fa-credit-card"></i> Server Setup</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-header"> 
              <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox210" value="option210">
                  <label for="customCheckbox210" class="custom-control-label"> Flight</label>
                </div>
              </p>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
                <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox211" value="option211">
                  <label for="customCheckbox211" class="custom-control-label"><i class="nav-icon fas fa-university"></i> Request Page</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
                <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox212" value="option212">
                  <label for="customCheckbox212" class="custom-control-label"><i class="nav-icon fas fa-university"></i> Report</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
                <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox213" value="option213">
                  <label for="customCheckbox213" class="custom-control-label"><i class="nav-icon far fa-credit-card"></i> Commission Setup</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
                <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox214" value="option214">
                  <label for="customCheckbox214" class="custom-control-label"><i class="nav-icon far fa-credit-card"></i> Server Setup</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-header"> 
              <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox215" value="option215">
                  <label for="customCheckbox215" class="custom-control-label"> Train</label>
                </div>
              </p>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
                <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox216" value="option216">
                  <label for="customCheckbox216" class="custom-control-label"><i class="nav-icon fas fa-university"></i> Request Page</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
                <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox217" value="option217">
                  <label for="customCheckbox217" class="custom-control-label"><i class="nav-icon fas fa-university"></i> Report</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
                <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox218" value="option218">
                  <label for="customCheckbox218" class="custom-control-label"><i class="nav-icon far fa-credit-card"></i> Commission Setup</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
                <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox219" value="option219">
                  <label for="customCheckbox219" class="custom-control-label"><i class="nav-icon far fa-credit-card"></i> Server Setup</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-header"> 
              <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox220" value="option220">
                  <label for="customCheckbox220" class="custom-control-label"> Hotel</label>
                </div>
              </p>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
                <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox221" value="option221">
                  <label for="customCheckbox221" class="custom-control-label"><i class="nav-icon fas fa-university"></i> Request Page</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
                <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox222" value="option222">
                  <label for="customCheckbox222" class="custom-control-label"><i class="nav-icon fas fa-university"></i> Report</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
                <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox223" value="option223">
                  <label for="customCheckbox223" class="custom-control-label"><i class="nav-icon far fa-credit-card"></i> Commission Setup</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
                <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox224" value="option224">
                  <label for="customCheckbox224" class="custom-control-label"><i class="nav-icon far fa-credit-card"></i> Server Setup</label>
                </div>
              </p>
            </a>
          </li>
          
          
          
          
            <li class="nav-header">
               <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox225" value="option225">
                  <label for="customCheckbox225" class="custom-control-label"> SOFTWARE MANAGMENT</label>
                </div>
              </p>
           </li>
         <li class="nav-header">
               <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox226" value="option226">
                  <label for="customCheckbox226" class="custom-control-label"> Service &amp; Server</label>
                </div>
              </p>
           </li>
          
          <li class="nav-item">
              <a href="#" class="nav-link">
               <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox227" value="option227">
                  <label for="customCheckbox227" class="custom-control-label"> <i class="nav-icon fas fa-fingerprint"></i> Manage Server</label>
                </div>
              </p>
           </a>
          </li>
          <li class="nav-item">
              <a href="#" class="nav-link">
               <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox228" value="option228">
                  <label for="customCheckbox228" class="custom-control-label"> <i class="nav-icon fas fa-fingerprint"></i> Manage Service</label>
                </div>
              </p>
           </a>
          </li>
          <li class="nav-header">
               <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox229" value="option229">
                  <label for="customCheckbox229" class="custom-control-label"> Website Managment</label>
                </div>
              </p>
           </li>
          
          <li class="nav-item">
              <a href="#" class="nav-link">
               <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox230" value="option230">
                  <label for="customCheckbox230" class="custom-control-label"> <i class="nav-icon fas fa-fingerprint"></i> Home</label>
                </div>
              </p>
           </a>
          </li>
          <li class="nav-item">
              <a href="#" class="nav-link">
               <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox231" value="option231">
                  <label for="customCheckbox231" class="custom-control-label"> <i class="nav-icon fas fa-fingerprint"></i> About</label>
                </div>
              </p>
           </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
               <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox232" value="option232">
                  <label for="customCheckbox232" class="custom-control-label"><i class="nav-icon fas fa-columns"></i> service</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-item">
              <a href="#" class="nav-link">
               <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox233" value="option233">
                  <label for="customCheckbox233" class="custom-control-label"> <i class="nav-icon fas fa-fingerprint"></i> Contact</label>
                </div>
              </p>
           </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
               <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox234" value="option234">
                  <label for="customCheckbox234" class="custom-control-label"><i class="nav-icon fas fa-columns"></i> Websettings</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-header">
               <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox235" value="option235">
                  <label for="customCheckbox235" class="custom-control-label"> Slider Managment </label>
                </div>
              </p>
           </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
                <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox236" value="option236">
                  <label for="customCheckbox236" class="custom-control-label"><i class="nav-icon far fa-envelope"></i> Website Slider </label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
                <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox237" value="option237">
                  <label for="customCheckbox237" class="custom-control-label"><i class="nav-icon far fa-envelope"></i> Application Slider</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-header">
               <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox238" value="option238">
                  <label for="customCheckbox238" class="custom-control-label"> Promo Code</label>
                </div>
              </p>
           </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
                <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox239" value="option239">
                  <label for="customCheckbox239" class="custom-control-label"><i class="nav-icon far fa-envelope"></i> Create Promo Code</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
                <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox240" value="option240">
                  <label for="customCheckbox240" class="custom-control-label"><i class="nav-icon far fa-envelope"></i> Promo Code List</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
                <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox241" value="option241">
                  <label for="customCheckbox241" class="custom-control-label"> <i class="nav-icon fas fa-gifts"></i> Uses Report of Promo Code</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-header">
               <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox242" value="option242">
                  <label for="customCheckbox242" class="custom-control-label"> API HIT LOG</label>
                </div>
              </p>
           </li>
           
          <li class="nav-header">
               <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox243" value="option243">
                  <label for="customCheckbox243" class="custom-control-label"> Activity</label>
                </div>
              </p>
           </li>
          
          <li class="nav-item">
            <a href="#" class="nav-link">
                 <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox244" value="option244">
                  <label for="customCheckbox244" class="custom-control-label"><i class="nav-icon fas fa-chart-pie"></i> Member Verification</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
                 <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox244" value="option244">
                  <label for="customCheckbox244" class="custom-control-label"><i class="nav-icon fas fa-chart-pie"></i> Commission Setup</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
                 <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox245" value="option245">
                  <label for="customCheckbox245" class="custom-control-label"><i class="nav-icon fas fa-chart-pie"></i> Server Setup</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
                 <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox246" value="option246">
                  <label for="customCheckbox246" class="custom-control-label"><i class="nav-icon fas fa-chart-pie"></i> Ofline Request</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-header">
               <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox247" value="option247">
                  <label for="customCheckbox247" class="custom-control-label"> Target / Task Managment</label>
                </div>
              </p>
           </li>
          
          <li class="nav-item">
            <a href="#" class="nav-link">
                 <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox248" value="option248">
                  <label for="customCheckbox248" class="custom-control-label"><i class="nav-icon fas fa-chart-pie"></i> Set New Target</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
                 <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox249" value="option249">
                  <label for="customCheckbox249" class="custom-control-label"><i class="nav-icon fas fa-chart-pie"></i> Target Reports</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
                 <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox250" value="option250">
                  <label for="customCheckbox250" class="custom-control-label"><i class="nav-icon fas fa-chart-pie"></i> Target Working Report</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
                 <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox251" value="option251">
                  <label for="customCheckbox251" class="custom-control-label"><i class="nav-icon fas fa-chart-pie"></i> Task Report</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
               <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox252" value="option252">
                  <label for="customCheckbox252" class="custom-control-label"><i class="nav-icon fas fa-chart-pie"></i>  Task Working Report </label>
                </div>
              </p>
            </a>
          </li>
          
        <li class="nav-header">
              <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox253" value="option253">
                  <label for="customCheckbox253" class="custom-control-label">CUSTOMER SUPPORT</label>
                </div>
              </p>
        </li>
        <li class="nav-header">
              <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox254" value="option254">
                  <label for="customCheckbox254" class="custom-control-label">CUSTOMER SUPPORT</label>
                </div>
              </p>
        </li>
        
          <li class="nav-item">
            <a href="#" class="nav-link">
                 <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox255" value="option255">
                  <label for="customCheckbox255" class="custom-control-label"><i class="nav-icon fas fa-headset"></i>  New Ticket Rice</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
                 <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox256" value="option256">
                  <label for="customCheckbox256" class="custom-control-label"><i class="nav-icon fas fa-headset"></i>  All Ticket Report</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-header">
              <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox257" value="option257">
                  <label for="customCheckbox257" class="custom-control-label">Notification &amp; News</label>
                </div>
              </p>
        </li>
        
          <li class="nav-item">
            <a href="#" class="nav-link">
                 <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox258" value="option258">
                  <label for="customCheckbox258" class="custom-control-label"><i class="nav-icon fas fa-headset"></i>  Notification</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
                 <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox259" value="option259">
                  <label for="customCheckbox259" class="custom-control-label"><i class="nav-icon fas fa-headset"></i>  News</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-header">
              <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox260" value="option260">
                  <label for="customCheckbox260" class="custom-control-label">RESELLER MANAGMENT</label>
                </div>
              </p>
        </li>
        <li class="nav-header">
              <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox261" value="option261">
                  <label for="customCheckbox261" class="custom-control-label">RESELLER MANAGMENT</label>
                </div>
              </p>
        </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
                 <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox262" value="option262">
                  <label for="customCheckbox262" class="custom-control-label"><i class="nav-icon fas fa-headset"></i>  Add Member</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
                 <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox263" value="option263">
                  <label for="customCheckbox263" class="custom-control-label"><i class="nav-icon fas fa-headset"></i>  Member List</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox264" value="option264">
                  <label for="customCheckbox264" class="custom-control-label"><i class="nav-icon far fa-envelope"></i> Manager Service</label>
                </div>
              </p>
            </a>
          </li>
        <li class="nav-item">
            <a href="#" class="nav-link">
                 <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox265" value="option265">
                  <label for="customCheckbox265" class="custom-control-label"><i class="nav-icon fas fa-headset"></i>  Manage Service Server</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-header">
            <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox266" value="option266">
                  <label for="customCheckbox266" class="custom-control-label"><i class="nav-icon far fa-envelope"></i> Ressler Wallet</label>
                </div>
              </p>
        </li>
         
         
          <li class="nav-item">
            <a href="#" class="nav-link">
                <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox267" value="option267">
                  <label for="customCheckbox267" class="custom-control-label"> <i class="nav-icon fas fa-users"></i>  Main Wallet</label>
                </div>
              </p>
            </a>
          </li>
          
          <li class="nav-item">
            <a href="#" class="nav-link">
                
             <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox268" value="option268">
                  <label for="customCheckbox268" class="custom-control-label"><i class="nav-icon fas fa-users"></i> AePs Wallet</label>
                </div>
              </p>        
            </a>
          </li>
          <li class="nav-header">
            <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox269" value="option269">
                  <label for="customCheckbox269" class="custom-control-label"><i class="nav-icon far fa-envelope"></i> Reseller's Agents</label>
                </div>
              </p>
        </li>
         
         
          <li class="nav-item">
            <a href="#" class="nav-link">
                <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox270" value="option270">
                  <label for="customCheckbox270" class="custom-control-label"> <i class="nav-icon fas fa-users"></i>  Member List</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-header">
            <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox271" value="option271">
                  <label for="customCheckbox271" class="custom-control-label"><i class="nav-icon far fa-envelope"></i> Wallet</label>
                </div>
              </p>
        </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
                
             <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox272" value="option272">
                  <label for="customCheckbox272" class="custom-control-label"><i class="nav-icon fas fa-users"></i> Main Wallet</label>
                </div>
              </p>        
            </a>
          </li>
          
          <li class="nav-item">
            <a href="#" class="nav-link">
              <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox273" value="option273">
                  <label for="customCheckbox273" class="custom-control-label"><i class="nav-icon fas fa-users"></i> AePs Wallet</label>
                </div>
              </p>
            </a>
          </li>
          <li class="nav-header">
            <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox274" value="option274">
                  <label for="customCheckbox274" class="custom-control-label"><i class="nav-icon far fa-envelope"></i> Main Wallet Report</label>
                </div>
              </p>
        </li>
        <li class="nav-header">
            <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox275" value="option275">
                  <label for="customCheckbox275" class="custom-control-label"><i class="nav-icon far fa-envelope"></i> Reseller's Agent</label>
                </div>
              </p>
        </li>
        <li class="nav-header">
            <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox276" value="option276">
                  <label for="customCheckbox276" class="custom-control-label"><i class="nav-icon far fa-envelope"></i> Manually Fund Report</label>
                </div>
              </p>
        </li>
        <li class="nav-header">
            <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox277" value="option277">
                  <label for="customCheckbox277" class="custom-control-label"><i class="nav-icon far fa-envelope"></i> All AePs Wallet Report</label>
                </div>
              </p>
        </li>
        <li class="nav-header">
            <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox278" value="option278">
                  <label for="customCheckbox278" class="custom-control-label"><i class="nav-icon far fa-envelope"></i> All Main Wallet Report</label>
                </div>
              </p>
        </li>
        <li class="nav-header">
            <p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox279" value="option279">
                  <label for="customCheckbox279" class="custom-control-label"><i class="nav-icon far fa-envelope"></i> P &amp; L Report</label>
                </div>
              </p>
        </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
      
                </div>
                <!-- /.card-body -->

                <div class="card-footer d-flex justify-content-center">
                  <input type="submit" id="save_value" value="Save">
                </div>
              </form>
            </div>
            <!-- /.card -->

  

          </div>
          <!-- right column -->
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


<!--State / Distric / Block Filter -->
<script>
var stateObject = {
"India": { "Delhi": ["new Delhi", "North Delhi"],
"Kerala": ["Thiruvananthapuram", "Palakkad"],
"Goa": ["North Goa", "South Goa"],
},
"Australia": {
"South Australia": ["Dunstan", "Mitchell"],
"Victoria": ["Altona", "Euroa"]
}, "Canada": {
"Alberta": ["Acadia", "Bighorn"],
"Columbia": ["Washington", ""]
},
}
window.onload = function () {
var countySel = document.getElementById("countySel"),
stateSel = document.getElementById("stateSel"),
districtSel = document.getElementById("districtSel");
for (var country in stateObject) {
countySel.options[countySel.options.length] = new Option(country, country);
}
countySel.onchange = function () {
stateSel.length = 1; // remove all options bar first
districtSel.length = 1; // remove all options bar first
if (this.selectedIndex < 1) return; // done
for (var state in stateObject[this.value]) {
stateSel.options[stateSel.options.length] = new Option(state, state);
}
}
countySel.onchange(); // reset in case page is reloaded
stateSel.onchange = function () {
districtSel.length = 1; // remove all options bar first
if (this.selectedIndex < 1) return; // done
var district = stateObject[countySel.value][this.value];
for (var i = 0; i < district.length; i++) {
districtSel.options[districtSel.options.length] = new Option(district[i], district[i]);
}
}
}
</script>
<!--State / Distric / Block Filter -->

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

<!-- Page specific script -->
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date picker
    $('#reservationdate').datetimepicker({
        format: 'L'
    });

    //Date and time picker
    $('#reservationdatetime').datetimepicker({ icons: { time: 'far fa-clock' } });

    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({
      timePicker: true,
      timePickerIncrement: 30,
      locale: {
        format: 'MM/DD/YYYY hh:mm A'
      }
    })
    //Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )

    //Timepicker
    $('#timepicker').datetimepicker({
      format: 'LT'
    })

    //Bootstrap Duallistbox
    $('.duallistbox').bootstrapDualListbox()

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    $('.my-colorpicker2').on('colorpickerChange', function(event) {
      $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
    })

    $("input[data-bootstrap-switch]").each(function(){
      $(this).bootstrapSwitch('state', $(this).prop('checked'));
    })

  })
  // BS-Stepper Init
  document.addEventListener('DOMContentLoaded', function () {
    window.stepper = new Stepper(document.querySelector('.bs-stepper'))
  })

  // DropzoneJS Demo Code Start
  Dropzone.autoDiscover = false

  // Get the template HTML and remove it from the doumenthe template HTML and remove it from the doument
  var previewNode = document.querySelector("#template")
  previewNode.id = ""
  var previewTemplate = previewNode.parentNode.innerHTML
  previewNode.parentNode.removeChild(previewNode)

  var myDropzone = new Dropzone(document.body, { // Make the whole body a dropzone
    url: "/target-url", // Set the url
    thumbnailWidth: 80,
    thumbnailHeight: 80,
    parallelUploads: 20,
    previewTemplate: previewTemplate,
    autoQueue: false, // Make sure the files aren't queued until manually added
    previewsContainer: "#previews", // Define the container to display the previews
    clickable: ".fileinput-button" // Define the element that should be used as click trigger to select files.
  })

  myDropzone.on("addedfile", function(file) {
    // Hookup the start button
    file.previewElement.querySelector(".start").onclick = function() { myDropzone.enqueueFile(file) }
  })

  // Update the total progress bar
  myDropzone.on("totaluploadprogress", function(progress) {
    document.querySelector("#total-progress .progress-bar").style.width = progress + "%"
  })

  myDropzone.on("sending", function(file) {
    // Show the total progress bar when upload starts
    document.querySelector("#total-progress").style.opacity = "1"
    // And disable the start button
    file.previewElement.querySelector(".start").setAttribute("disabled", "disabled")
  })

  // Hide the total progress bar when nothing's uploading anymore
  myDropzone.on("queuecomplete", function(progress) {
    document.querySelector("#total-progress").style.opacity = "0"
  })

  // Setup the buttons for all transfers
  // The "add files" button doesn't need to be setup because the config
  // `clickable` has already been specified.
  document.querySelector("#actions .start").onclick = function() {
    myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED))
  }
  document.querySelector("#actions .cancel").onclick = function() {
    myDropzone.removeAllFiles(true)
  }
  // DropzoneJS Demo Code End
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous"></script>
  <script type="text/javascript" src="js/jquery.js"></script>
<script>
  $(document).ready(function(){
          $("#emp_btn").click(function(e){
              e.preventDefault();
              
             
                   $.ajax({
                  url : "addemp.php",
                  type : "POST",
                  data : $("#addempform").serialize(),
                  success : function(data){
                      alert(data);
                  }
              });
              
              
              
          });
      
     
  });  
  
    
</script>
<script>
$('#save_value').click(function () {
var val = [];
    $(':checkbox:checked').each(function (i){
        val[i] = $(this).val();
});
$.ajax({
   type:"POST",
   url:"data.php",
   data:{
       value:val
   },
   success:function (data){
       console.log(data);
   }
});
});
$(document).ready(function () {
$('#customCheckbox2').click(function () {
$('.custom-control-inputt').prop('checked',$(this).prop('checked'));
});
});
</script>



<script>
$('#save_value').click(function () {
var val = [];
    
$(':checkbox:checked').each(function (i){
        val[i] = $(this).val();
});
Alert(val);
});
$(document).ready(function () {
$('#customCheckbox7').click(function () {
$('.custom-control-input-example2').prop('checked',$(this).prop('checked'));
});
});
</script>



<script>
$('#save_value').click(function () {
var val = [];
    
$(':checkbox:checked').each(function (i){
        val[i] = $(this).val();
});
Alert(val);
});
$(document).ready(function () {
$('#customCheckbox12').click(function () {
$('.custom-control-input-example3').prop('checked',$(this).prop('checked'));
});
});
</script>
</body>
</html>
