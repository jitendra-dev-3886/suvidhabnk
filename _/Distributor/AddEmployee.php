<?php
session_start();
include("include/Connection/config.php");
include("include/FetchData/adminData.php");
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
        <!--<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">-->

        <!--  <li class="nav-header">-->
        <!--       <p>-->
        <!--        <div class="custom-control custom-checkbox">-->
        <!--          <input class="custom-control-input" type="checkbox" id="customCheckbox1" value="option1">-->
        <!--          <label for="customCheckbox1" class="custom-control-label"> MEMBER MANAGMENT</label>-->
        <!--        </div>-->
        <!--      </p>-->
        <!-- </li>-->
         
        <!--  <li class="nav-header">-->
        <!--       <p>-->
        <!--        <div class="custom-control custom-checkbox">-->
        <!--          <input class="custom-control-input" type="checkbox" id="customCheckbox2" value="option2">-->
        <!--          <label for="customCheckbox2" class="custom-control-label"> MEMBER </label>-->
        <!--        </div>-->
        <!--      </p>-->
        <!-- </li>-->
         
        <!--  <div id="checkboxes">-->
        <!--  <li class="nav-item">-->
        <!--    <a href="#" class="nav-link">-->
        <!--     <p>-->
        <!--        <div class="custom-control custom-checkbox">-->
        <!--            <input class="custom-control-inputt" type="checkbox" name="" value="distributorrequest" id="customCheckbox3" value="option3">-->
        <!--          <label for="customCheckbox3" class=""> <i class="far fa-circle nav-icon"></i> Member List</label>-->
                  
        <!--        </div>-->
        <!--      </p>-->
        <!--    </a>-->
        <!--  </li>-->
          
        <!--  <li class="nav-item">-->
        <!--    <a href="#" class="nav-link">-->
        <!--     <p>-->
        <!--        <div class="custom-control custom-checkbox">-->
        <!--            <input class="custom-control-inputt" type="checkbox" name="" value="distributorrequest" id="customCheckbox4" value="option4">-->
        <!--          <label for="customCheckbox4" class=""> <i class="far fa-circle nav-icon"></i> Retailer Verification</label>-->
                  
        <!--        </div>-->
        <!--      </p>-->
        <!--    </a>-->
        <!--  </li>-->
          
          
        <!--  <li class="nav-item">-->
        <!--    <a href="#" class="nav-link">-->
        <!--     <p>-->
        <!--        <div class="custom-control custom-checkbox">-->
        <!--          <input class="custom-control-inputt" type="checkbox" name="" value="distributorrequest" id="customCheckbox5" value="option5">-->
        <!--          <label for="customCheckbox5" class=""> <i class="far fa-circle nav-icon"></i> Distributor Request</label>-->
        <!--        </div>-->
        <!--      </p>-->
        <!--    </a>-->
        <!--  </li>-->
          
        <!--  <li class="nav-item">-->
        <!--    <a href="#" class="nav-link">-->
        <!--     <p>-->
        <!--        <div class="custom-control custom-checkbox">-->
        <!--          <input class="custom-control-inputt" type="checkbox" name="" value="websitesignuprequests" id="customCheckbox6" value="option6">-->
        <!--          <label for="customCheckbox6" class=""> <i class="far fa-circle nav-icon"></i> Website Signup Requests</label>-->
        <!--        </div>-->
        <!--      </p>-->
        <!--    </a>-->
        <!--  </li>-->
        <!--  </div>-->
          
        <!--<div id="checkboxes">-->
        <!-- <li class="nav-item">-->
        <!--    <a href="#" class="nav-link">-->
        <!--      <p>-->
        <!--        <div class="custom-control custom-checkbox">-->
        <!--          <input class="custom-control-input" type="checkbox" id="customCheckbox2" value="option2">-->
        <!--          <label for="customCheckbox2" class="custom-control-label"> MEMBER  <i class="fas fa-angle-left right">  </i></label>-->
        <!--        </div>-->
        <!--      </p>-->
        <!--    </a>-->
        <!--    <ul class="nav nav-treeview">-->
           
        <!--      <li class="nav-item">-->
        <!--        <a href="AddMember.php" class="nav-link">-->
        <!--          <div class="custom-control custom-checkbox">-->
        <!--            <input class="custom-control-inputt" type="checkbox" name="" value="distributorrequest" id="customCheckbox3" value="option3">-->
        <!--          <label for="customCheckbox3" class=""> <i class="far fa-circle nav-icon"></i> Member List</label>-->
        <!--        </div>-->
        <!--        </a>-->
        <!--      </li>-->
        <!--      <li class="nav-item">-->
        <!--        <a href="MemberList.php" class="nav-link">-->
        <!--        <div class="custom-control custom-checkbox">-->
        <!--            <input class="custom-control-inputt" type="checkbox" name="" value="distributorrequest" id="customCheckbox4" value="option4">-->
        <!--          <label for="customCheckbox4" class=""> <i class="far fa-circle nav-icon"></i> Retailer Verification</label>-->
        <!--        </div>-->
        <!--        </a>-->
        <!--      </li>-->
        <!--      <li class="nav-item">-->
        <!--        <a href="RetailerVerificationRequest.php" class="nav-link">-->
        <!--           <div class="custom-control custom-checkbox">-->
        <!--          <input class="custom-control-inputt" type="checkbox" name="" value="distributorrequest" id="customCheckbox5" value="option5">-->
        <!--          <label for="customCheckbox5" class=""> <i class="far fa-circle nav-icon"></i> Distributor Request</label>-->
        <!--        </div>-->
        <!--        </a>-->
        <!--      </li>-->
        <!--      <li class="nav-item">-->
        <!--        <a href="DistributorVerificationRequest.php" class="nav-link">-->
        <!--        <div class="custom-control custom-checkbox">-->
        <!--          <input class="custom-control-inputt" type="checkbox" name="" value="websitesignuprequests" id="customCheckbox6" value="option6">-->
        <!--          <label for="customCheckbox6" class=""> <i class="far fa-circle nav-icon"></i> Website Signup Requests</label>-->
        <!--        </div>-->
        <!--        </a>-->
        <!--      </li>-->
        <!--    </ul>-->
        <!--  </li>-->
        <!--</div>-->
          
        <!--  <li class="nav-header">-->
        <!--       <p>-->
        <!--        <div class="custom-control custom-checkbox">-->
        <!--          <input class="custom-control-input" type="checkbox" id="customCheckbox7" value="option7">-->
        <!--          <label for="customCheckbox7" class="custom-control-label"> Employee Managment</label>-->
        <!--        </div>-->
        <!--      </p>-->
        <!-- </li>-->
        <!-- <div id="checkboxes1">-->
        <!--  <li class="nav-item">-->
        <!--    <a href="#" class="nav-link">-->
        <!--        <p>-->
        <!--        <div class="custom-control custom-checkbox">-->
        <!--          <input class="custom-control-input-example2" type="checkbox" id="customCheckbox8" value="option8">-->
        <!--          <label for="customCheckbox8" class=""> <i class="nav-icon fas fa-fingerprint"></i> Add Employee</label>-->
        <!--        </div>-->
        <!--      </p>-->
        <!--    </a>-->
        <!--  </li>-->
        <!--  <li class="nav-item">-->
        <!--    <a href="#" class="nav-link">-->
        <!--        <p>-->
        <!--        <div class="custom-control custom-checkbox">-->
        <!--          <input class="custom-control-input-example2" type="checkbox" id="customCheckbox9" value="option9">-->
        <!--          <label for="customCheckbox9" class=""> <i class="nav-icon fas fa-fingerprint"></i> Employee List</label>-->
        <!--        </div>-->
        <!--      </p>-->
        <!--    </a>-->
        <!--  </li>-->
        <!--  <li class="nav-item">-->
        <!--    <a href="#" class="nav-link">-->
        <!--        <p>-->
        <!--        <div class="custom-control custom-checkbox">-->
        <!--          <input class="custom-control-input-example2" type="checkbox" id="customCheckbox10" value="option10">-->
        <!--          <label for="customCheckbox10" class=""> <i class="nav-icon fas fa-fingerprint"></i> Add Department</label>-->
        <!--        </div>-->
        <!--      </p>-->
        <!--    </a>-->
        <!--  </li>-->
        <!--  <li class="nav-item">-->
        <!--    <a href="#" class="nav-link">-->
        <!--        <p>-->
        <!--        <div class="custom-control custom-checkbox">-->
        <!--          <input class="custom-control-input-example2" type="checkbox" id="customCheckbox11" value="option11">-->
        <!--          <label for="customCheckbox11" class=""> <i class="nav-icon fas fa-fingerprint"></i> Department List</label>-->
        <!--        </div>-->
        <!--      </p>-->
        <!--    </a>-->
        <!--  </li>-->
        <!--  </div>-->
          
          
        <!--  <li class="nav-header">-->
        <!--       <p>-->
        <!--        <div class="custom-control custom-checkbox">-->
        <!--          <input class="custom-control-input" type="checkbox" id="customCheckbox12" value="option12">-->
        <!--          <label for="customCheckbox12" class="custom-control-label"> Wallet Managment</label>-->
        <!--        </div>-->
        <!--      </p>-->
        <!-- </li>-->
        <!-- <div id="checkboxes2">-->
        <!--  <li class="nav-item">-->
        <!--    <a href="#" class="nav-link">-->
        <!--      <p>-->
        <!--        <div class="custom-control custom-checkbox">-->
        <!--          <input class="custom-control-input-example3" type="checkbox" id="customCheckbox13" value="option13">-->
        <!--          <label for="customCheckbox13" class=""> <i class="nav-icon fas fa-fingerprint"></i> Main Wallet Report</label>-->
        <!--        </div>-->
        <!--      </p>-->
        <!--    </a>-->
        <!--  </li>-->
        <!--  <li class="nav-item">-->
        <!--    <a href="#" class="nav-link">-->
        <!--      <p>-->
        <!--        <div class="custom-control custom-checkbox">-->
        <!--          <input class="custom-control-input-example3" type="checkbox" id="customCheckbox14" value="option14">-->
        <!--          <label for="customCheckbox14" class=""> <i class="nav-icon fas fa-fingerprint"></i> AePs Wallet Report</label>-->
        <!--        </div>-->
        <!--      </p>-->
        <!--    </a>-->
        <!--  </li>-->
        <!--  </div>-->
        
        <!-- <li class="nav-header">-->
        <!--       <p>-->
        <!--        <div class="custom-control custom-checkbox">-->
        <!--          <input class="custom-control-input" type="checkbox" id="customCheckbox15" value="option15">-->
        <!--          <label for="customCheckbox15" class="custom-control-label"> ACCOUNT MANAGMENT</label>-->
        <!--        </div>-->
        <!--      </p>-->
        <!-- </li>-->
        <!-- <li class="nav-header">-->
        <!--       <p>-->
        <!--        <div class="custom-control custom-checkbox">-->
        <!--          <input class="custom-control-input" type="checkbox" id="customCheckbox16" value="option16">-->
        <!--          <label for="customCheckbox16" class="custom-control-label"> Agent Fund Transfer</label>-->
        <!--        </div>-->
        <!--      </p>-->
        <!-- </li>-->
          
        <!--  <li class="nav-item">-->
        <!--    <a href="#" class="nav-link">-->
        <!--      <p>-->
        <!--        <div class="custom-control custom-checkbox">-->
        <!--          <input class="custom-control-input" type="checkbox" id="customCheckbox17" value="option17">-->
        <!--          <label for="customCheckbox17" class="custom-control-label"> <i class="nav-icon fas fa-fingerprint"></i> Main Wallet</label>-->
        <!--        </div>-->
        <!--      </p>-->
        <!--    </a>-->
        <!--  </li>-->
        <!--  <li class="nav-item">-->
        <!--    <a href="#" class="nav-link">-->
        <!--      <p>-->
        <!--        <div class="custom-control custom-checkbox">-->
        <!--          <input class="custom-control-input" type="checkbox" id="customCheckbox18" value="option18">-->
        <!--          <label for="customCheckbox18" class="custom-control-label"> <i class="nav-icon fas fa-fingerprint"></i> AePs Wallet</label>-->
        <!--        </div>-->
        <!--      </p>-->
        <!--    </a>-->
        <!--  </li>-->
        <!--  <li class="nav-header">-->
        <!--       <p>-->
        <!--        <div class="custom-control custom-checkbox">-->
        <!--          <input class="custom-control-input" type="checkbox" id="customCheckbox19" value="option19">-->
        <!--          <label for="customCheckbox19" class="custom-control-label"> Fund Transfer Report</label>-->
        <!--        </div>-->
        <!--      </p>-->
        <!-- </li>-->
          
        <!--  <li class="nav-item">-->
        <!--    <a href="#" class="nav-link">-->
        <!--      <p>-->
        <!--        <div class="custom-control custom-checkbox">-->
        <!--          <input class="custom-control-input" type="checkbox" id="customCheckbox20" value="option20">-->
        <!--          <label for="customCheckbox20" class="custom-control-label"> <i class="nav-icon fas fa-fingerprint"></i> Main Wallet</label>-->
        <!--        </div>-->
        <!--      </p>-->
        <!--    </a>-->
        <!--  </li>-->
        <!--  <li class="nav-item">-->
        <!--    <a href="#" class="nav-link">-->
        <!--      <p>-->
        <!--        <div class="custom-control custom-checkbox">-->
        <!--          <input class="custom-control-input" type="checkbox" id="customCheckbox21" value="option21">-->
        <!--          <label for="customCheckbox21" class="custom-control-label"> <i class="nav-icon fas fa-fingerprint"></i> AePs Wallet</label>-->
        <!--        </div>-->
        <!--      </p>-->
        <!--    </a>-->
        <!--  </li>-->
        <!--  <li class="nav-header">-->
        <!--       <p>-->
        <!--        <div class="custom-control custom-checkbox">-->
        <!--          <input class="custom-control-input" type="checkbox" id="customCheckbox22" value="option22">-->
        <!--          <label for="customCheckbox22" class="custom-control-label"> Agent Transaction Report</label>-->
        <!--        </div>-->
        <!--      </p>-->
        <!-- </li>-->
          
        <!--  <li class="nav-item">-->
        <!--    <a href="#" class="nav-link">-->
        <!--      <p>-->
        <!--        <div class="custom-control custom-checkbox">-->
        <!--          <input class="custom-control-input" type="checkbox" id="customCheckbox23" value="option23">-->
        <!--          <label for="customCheckbox23" class="custom-control-label"> <i class="nav-icon fas fa-fingerprint"></i> Main Wallet</label>-->
        <!--        </div>-->
        <!--      </p>-->
        <!--    </a>-->
        <!--  </li>-->
        <!--  <li class="nav-item">-->
        <!--    <a href="#" class="nav-link">-->
        <!--      <p>-->
        <!--        <div class="custom-control custom-checkbox">-->
        <!--          <input class="custom-control-input" type="checkbox" id="customCheckbox24" value="option24">-->
        <!--          <label for="customCheckbox24" class="custom-control-label"> <i class="nav-icon fas fa-fingerprint"></i> AePs Wallet</label>-->
        <!--        </div>-->
        <!--      </p>-->
        <!--    </a>-->
        <!--  </li>-->
        <!--  <li class="nav-item">-->
        <!--    <a href="#" class="nav-link">-->
        <!--        <p>-->
        <!--        <div class="custom-control custom-checkbox">-->
        <!--          <input class="custom-control-input" type="checkbox" id="customCheckbox25" value="option25">-->
        <!--          <label for="customCheckbox25" class="custom-control-label"><i class="nav-icon fas fa-fingerprint"></i>  All Commission Report</label>-->
        <!--        </div>-->
        <!--      </p>-->
        <!--    </a>-->
        <!--  </li>-->
        <!--  <li class="nav-item">-->
        <!--    <a href="#" class="nav-link">-->
        <!--        <p>-->
        <!--        <div class="custom-control custom-checkbox">-->
        <!--          <input class="custom-control-input" type="checkbox" id="customCheckbox26" value="option26">-->
        <!--          <label for="customCheckbox26" class="custom-control-label"><i class="nav-icon fas fa-fingerprint"></i>  P & L Report</label>-->
        <!--        </div>-->
        <!--      </p>-->
        <!--    </a>-->
        <!--  </li>-->
        <!--  <li class="nav-item">-->
        <!--    <a href="#" class="nav-link">-->
        <!--        <p>-->
        <!--        <div class="custom-control custom-checkbox">-->
        <!--          <input class="custom-control-input" type="checkbox" id="customCheckbox27" value="option27">-->
        <!--          <label for="customCheckbox27" class="custom-control-label"><i class="nav-icon fas fa-fingerprint"></i>  Invoices</label>-->
        <!--        </div>-->
        <!--      </p>-->
        <!--    </a>-->
        <!--  </li>-->
        <!--  <li class="nav-item">-->
        <!--    <a href="#" class="nav-link">-->
        <!--        <p>-->
        <!--        <div class="custom-control custom-checkbox">-->
        <!--          <input class="custom-control-input" type="checkbox" id="customCheckbox28" value="option28">-->
        <!--          <label for="customCheckbox28" class="custom-control-label"><i class="nav-icon fas fa-fingerprint"></i>  TDS Report</label>-->
        <!--        </div>-->
        <!--      </p>-->
        <!--    </a>-->
        <!--  </li>-->
        <!--  <li class="nav-item">-->
        <!--    <a href="#" class="nav-link">-->
        <!--        <p>-->
        <!--        <div class="custom-control custom-checkbox">-->
        <!--          <input class="custom-control-input" type="checkbox" id="customCheckbox29" value="option29">-->
        <!--          <label for="customCheckbox29" class="custom-control-label"><i class="nav-icon fas fa-fingerprint"></i>  GST Report</label>-->
        <!--        </div>-->
        <!--      </p>-->
        <!--    </a>-->
        <!--  </li>-->
        <!--  <li class="nav-header">-->
        <!--       <p>-->
        <!--        <div class="custom-control custom-checkbox">-->
        <!--          <input class="custom-control-input" type="checkbox" id="customCheckbox30" value="option30">-->
        <!--          <label for="customCheckbox30" class="custom-control-label"> Reseller Accounts</label>-->
        <!--        </div>-->
        <!--      </p>-->
        <!-- </li>-->
        <!-- <li class="nav-header">-->
        <!--       <p>-->
        <!--        <div class="custom-control custom-checkbox">-->
        <!--          <input class="custom-control-input" type="checkbox" id="customCheckbox31" value="option31">-->
        <!--          <label for="customCheckbox31" class="custom-control-label"> Reseller</label>-->
        <!--        </div>-->
        <!--      </p>-->
        <!-- </li>-->
        <!--  <li class="nav-header">-->
        <!--       <p>-->
        <!--        <div class="custom-control custom-checkbox">-->
        <!--          <input class="custom-control-input" type="checkbox" id="customCheckbox32" value="option32">-->
        <!--          <label for="customCheckbox32" class="custom-control-label"> Fund Transfer</label>-->
        <!--        </div>-->
        <!--      </p>-->
        <!-- </li>-->
          
        <!--  <li class="nav-item">-->
        <!--    <a href="#" class="nav-link">-->
        <!--        <p>-->
        <!--        <div class="custom-control custom-checkbox">-->
        <!--          <input class="custom-control-input" type="checkbox" id="customCheckbox33" value="option33">-->
        <!--          <label for="customCheckbox33" class="custom-control-label"><i class="nav-icon fas fa-fingerprint"></i>  Main Wallet</label>-->
        <!--        </div>-->
        <!--      </p>-->
        <!--    </a>-->
        <!--  </li>-->
        <!--  <li class="nav-item">-->
        <!--    <a href="#" class="nav-link">-->
        <!--        <p>-->
        <!--        <div class="custom-control custom-checkbox">-->
        <!--          <input class="custom-control-input" type="checkbox" id="customCheckbox34" value="option34">-->
        <!--          <label for="customCheckbox34" class="custom-control-label"><i class="nav-icon fas fa-fingerprint"></i>  AePs Wallet</label>-->
        <!--        </div>-->
        <!--      </p>-->
        <!--    </a>-->
        <!--  </li>-->
        <!--  <li class="nav-header">-->
        <!--       <p>-->
        <!--        <div class="custom-control custom-checkbox">-->
        <!--          <input class="custom-control-input" type="checkbox" id="customCheckbox35" value="option35">-->
        <!--          <label for="customCheckbox35" class="custom-control-label"> Fund Transfer Report</label>-->
        <!--        </div>-->
        <!--      </p>-->
        <!-- </li>-->
          
        <!--  <li class="nav-item">-->
        <!--    <a href="#" class="nav-link">-->
        <!--        <p>-->
        <!--        <div class="custom-control custom-checkbox">-->
        <!--          <input class="custom-control-input" type="checkbox" id="customCheckbox36" value="option36">-->
        <!--          <label for="customCheckbox36" class="custom-control-label"><i class="nav-icon fas fa-fingerprint"></i>  Main Wallet</label>-->
        <!--        </div>-->
        <!--      </p>-->
        <!--    </a>-->
        <!--  </li>-->
        <!--  <li class="nav-item">-->
        <!--    <a href="#" class="nav-link">-->
        <!--        <p>-->
        <!--        <div class="custom-control custom-checkbox">-->
        <!--          <input class="custom-control-input" type="checkbox" id="customCheckbox37" value="option37">-->
        <!--          <label for="customCheckbox37" class="custom-control-label"><i class="nav-icon fas fa-fingerprint"></i>  AePs Wallet</label>-->
        <!--        </div>-->
        <!--      </p>-->
        <!--    </a>-->
        <!--  </li>-->
        <!--  <li class="nav-header">-->
        <!--       <p>-->
        <!--        <div class="custom-control custom-checkbox">-->
        <!--          <input class="custom-control-input" type="checkbox" id="customCheckbox38" value="option38">-->
        <!--          <label for="customCheckbox38" class="custom-control-label"> Transaction Report</label>-->
        <!--        </div>-->
        <!--      </p>-->
        <!-- </li>-->
          
        <!--  <li class="nav-item">-->
        <!--    <a href="#" class="nav-link">-->
        <!--        <p>-->
        <!--        <div class="custom-control custom-checkbox">-->
        <!--          <input class="custom-control-input" type="checkbox" id="customCheckbox39" value="option39">-->
        <!--          <label for="customCheckbox39" class="custom-control-label"><i class="nav-icon fas fa-fingerprint"></i>  Main Wallet</label>-->
        <!--        </div>-->
        <!--      </p>-->
        <!--    </a>-->
        <!--  </li>-->
        <!--  <li class="nav-item">-->
        <!--    <a href="#" class="nav-link">-->
        <!--        <p>-->
        <!--        <div class="custom-control custom-checkbox">-->
        <!--          <input class="custom-control-input" type="checkbox" id="customCheckbox40" value="option40">-->
        <!--          <label for="customCheckbox40" class="custom-control-label"><i class="nav-icon fas fa-fingerprint"></i>  AePs Wallet</label>-->
        <!--        </div>-->
        <!--      </p>-->
        <!--    </a>-->
        <!--  </li>-->
        <!--  <li class="nav-header">-->
        <!--       <p>-->
        <!--        <div class="custom-control custom-checkbox">-->
        <!--          <input class="custom-control-input" type="checkbox" id="customCheckbox41" value="option41">-->
        <!--          <label for="customCheckbox41" class="custom-control-label"> Reseller Agent</label>-->
        <!--        </div>-->
        <!--      </p>-->
        <!-- </li>-->
        <!--  <li class="nav-header">-->
        <!--       <p>-->
        <!--        <div class="custom-control custom-checkbox">-->
        <!--          <input class="custom-control-input" type="checkbox" id="customCheckbox42" value="option42">-->
        <!--          <label for="customCheckbox42" class="custom-control-label"> Fund Transfer</label>-->
        <!--        </div>-->
        <!--      </p>-->
        <!-- </li>-->
          
        <!--  <li class="nav-item">-->
        <!--    <a href="#" class="nav-link">-->
        <!--        <p>-->
        <!--        <div class="custom-control custom-checkbox">-->
        <!--          <input class="custom-control-input" type="checkbox" id="customCheckbox43" value="option43">-->
        <!--          <label for="customCheckbox43" class="custom-control-label"><i class="nav-icon fas fa-fingerprint"></i>  Main Wallet</label>-->
        <!--        </div>-->
        <!--      </p>-->
        <!--    </a>-->
        <!--  </li>-->
        <!--  <li class="nav-item">-->
        <!--    <a href="#" class="nav-link">-->
        <!--        <p>-->
        <!--        <div class="custom-control custom-checkbox">-->
        <!--          <input class="custom-control-input" type="checkbox" id="customCheckbox44" value="option44">-->
        <!--          <label for="customCheckbox44" class="custom-control-label"><i class="nav-icon fas fa-fingerprint"></i>  AePs Wallet</label>-->
        <!--        </div>-->
        <!--      </p>-->
        <!--    </a>-->
        <!--  </li>-->
        <!--  <li class="nav-header">-->
        <!--       <p>-->
        <!--        <div class="custom-control custom-checkbox">-->
        <!--          <input class="custom-control-input" type="checkbox" id="customCheckbox45" value="option45">-->
        <!--          <label for="customCheckbox45" class="custom-control-label"> Fund Transfer Report</label>-->
        <!--        </div>-->
        <!--      </p>-->
        <!-- </li>-->
          
        <!--  <li class="nav-item">-->
        <!--    <a href="#" class="nav-link">-->
        <!--        <p>-->
        <!--        <div class="custom-control custom-checkbox">-->
        <!--          <input class="custom-control-input" type="checkbox" id="customCheckbox46" value="option46">-->
        <!--          <label for="customCheckbox46" class="custom-control-label"><i class="nav-icon fas fa-fingerprint"></i>  Main Wallet</label>-->
        <!--        </div>-->
        <!--      </p>-->
        <!--    </a>-->
        <!--  </li>-->
        <!--  <li class="nav-item">-->
        <!--    <a href="#" class="nav-link">-->
        <!--        <p>-->
        <!--        <div class="custom-control custom-checkbox">-->
        <!--          <input class="custom-control-input" type="checkbox" id="customCheckbox47" value="option47">-->
        <!--          <label for="customCheckbox47" class="custom-control-label"><i class="nav-icon fas fa-fingerprint"></i>  AePs Wallet</label>-->
        <!--        </div>-->
        <!--      </p>-->
        <!--    </a>-->
        <!--  </li>-->
        <!--  <li class="nav-header">-->
        <!--       <p>-->
        <!--        <div class="custom-control custom-checkbox">-->
        <!--          <input class="custom-control-input" type="checkbox" id="customCheckbox48" value="option48">-->
        <!--          <label for="customCheckbox48" class="custom-control-label"> Transaction Report</label>-->
        <!--        </div>-->
        <!--      </p>-->
        <!-- </li>-->
          
        <!--  <li class="nav-item">-->
        <!--    <a href="#" class="nav-link">-->
        <!--        <p>-->
        <!--        <div class="custom-control custom-checkbox">-->
        <!--          <input class="custom-control-input" type="checkbox" id="customCheckbox49" value="option49">-->
        <!--          <label for="customCheckbox49" class="custom-control-label"><i class="nav-icon fas fa-fingerprint"></i>  Main Wallet</label>-->
        <!--        </div>-->
        <!--      </p>-->
        <!--    </a>-->
        <!--  </li>-->
        <!--  <li class="nav-item">-->
        <!--    <a href="#" class="nav-link">-->
        <!--        <p>-->
        <!--        <div class="custom-control custom-checkbox">-->
        <!--          <input class="custom-control-input" type="checkbox" id="customCheckbox50" value="option50">-->
        <!--          <label for="customCheckbox50" class="custom-control-label"><i class="nav-icon fas fa-fingerprint"></i>  AePs Wallet</label>-->
        <!--        </div>-->
        <!--      </p>-->
        <!--    </a>-->
        <!--  </li>-->
        <!--  <li class="nav-item">-->
        <!--    <a href="#" class="nav-link">-->
        <!--        <p>-->
        <!--        <div class="custom-control custom-checkbox">-->
        <!--          <input class="custom-control-input" type="checkbox" id="customCheckbox51" value="option51">-->
        <!--          <label for="customCheckbox51" class="custom-control-label"><i class="nav-icon fas fa-fingerprint"></i>  All Commission Report</label>-->
        <!--        </div>-->
        <!--      </p>-->
        <!--    </a>-->
        <!--  </li>-->
        <!--  <li class="nav-item">-->
        <!--    <a href="#" class="nav-link">-->
        <!--        <p>-->
        <!--        <div class="custom-control custom-checkbox">-->
        <!--          <input class="custom-control-input" type="checkbox" id="customCheckbox52" value="option52">-->
        <!--          <label for="customCheckbox52" class="custom-control-label"><i class="nav-icon fas fa-fingerprint"></i>  P & L Report</label>-->
        <!--        </div>-->
        <!--      </p>-->
        <!--    </a>-->
        <!--  </li>-->
        <!--  <li class="nav-item">-->
        <!--    <a href="#" class="nav-link">-->
        <!--        <p>-->
        <!--        <div class="custom-control custom-checkbox">-->
        <!--          <input class="custom-control-input" type="checkbox" id="customCheckbox53" value="option53">-->
        <!--          <label for="customCheckbox53" class="custom-control-label"><i class="nav-icon fas fa-fingerprint"></i>  Invoices</label>-->
        <!--        </div>-->
        <!--      </p>-->
        <!--    </a>-->
        <!--  </li>-->
        <!--  <li class="nav-item">-->
        <!--    <a href="#" class="nav-link">-->
        <!--        <p>-->
        <!--        <div class="custom-control custom-checkbox">-->
        <!--          <input class="custom-control-input" type="checkbox" id="customCheckbox54" value="option54">-->
        <!--          <label for="customCheckbox54" class="custom-control-label"><i class="nav-icon fas fa-fingerprint"></i>  TDS Report</label>-->
        <!--        </div>-->
        <!--      </p>-->
        <!--    </a>-->
        <!--  </li>-->
        <!--  <li class="nav-item">-->
        <!--    <a href="#" class="nav-link">-->
        <!--        <p>-->
        <!--        <div class="custom-control custom-checkbox">-->
        <!--          <input class="custom-control-input" type="checkbox" id="customCheckbox55" value="option55">-->
        <!--          <label for="customCheckbox55" class="custom-control-label"><i class="nav-icon fas fa-fingerprint"></i>  GST Report</label>-->
        <!--        </div>-->
        <!--      </p>-->
        <!--    </a>-->
        <!--  </li>-->
        <!--  <li class="nav-header"> -->
        <!--      <p>-->
        <!--        <div class="custom-control custom-checkbox">-->
        <!--          <input class="custom-control-input" type="checkbox" id="customCheckbox56" value="option56">-->
        <!--          <label for="customCheckbox56" class="custom-control-label"> SERVICE MANAGMENT</label>-->
        <!--        </div>-->
        <!--      </p>-->
        <!--  </li>-->
        <!--  <li class="nav-header"> -->
        <!--      <p>-->
        <!--        <div class="custom-control custom-checkbox">-->
        <!--          <input class="custom-control-input" type="checkbox" id="customCheckbox57" value="option57">-->
        <!--          <label for="customCheckbox57" class="custom-control-label"> AePs Services</label>-->
        <!--        </div>-->
        <!--      </p>-->
        <!--  </li>-->
        <!--  <li class="nav-header"> -->
        <!--      <p>-->
        <!--        <div class="custom-control custom-checkbox">-->
        <!--          <input class="custom-control-input" type="checkbox" id="customCheckbox58" value="option58">-->
        <!--          <label for="customCheckbox58" class="custom-control-label"> AePs</label>-->
        <!--        </div>-->
        <!--      </p>-->
        <!--  </li>-->
          
        <!--  <li class="nav-item">-->
        <!--    <a href="#" class="nav-link">-->
        <!--      <p>-->
        <!--        <div class="custom-control custom-checkbox">-->
        <!--          <input class="custom-control-input" type="checkbox" id="customCheckbox59" value="option59">-->
        <!--          <label for="customCheckbox59" class="custom-control-label"><i class="nav-icon fas fa-fingerprint"></i> AePs Report</label>-->
        <!--        </div>-->
        <!--      </p>-->
        <!--    </a>-->
        <!--  </li>-->
        <!--  <li class="nav-item">-->
        <!--    <a href="#" class="nav-link">-->
        <!--      <p>-->
        <!--        <div class="custom-control custom-checkbox">-->
        <!--          <input class="custom-control-input" type="checkbox" id="customCheckbox60" value="option60">-->
        <!--          <label for="customCheckbox60" class="custom-control-label"><i class="nav-icon fas fa-fingerprint"></i> Commission Setup</label>-->
        <!--        </div>-->
        <!--      </p>-->
        <!--    </a>-->
        <!--  </li>-->
        <!--  <li class="nav-item">-->
        <!--    <a href="#" class="nav-link">-->
        <!--      <p>-->
        <!--        <div class="custom-control custom-checkbox">-->
        <!--          <input class="custom-control-input" type="checkbox" id="customCheckbox61" value="option61">-->
        <!--          <label for="customCheckbox61" class="custom-control-label"><i class="nav-icon fas fa-fingerprint"></i> AePs Server Setup</label>-->
        <!--        </div>-->
        <!--      </p>-->
        <!--    </a>-->
        <!--  </li>-->
        <!--  <li class="nav-header"> -->
        <!--      <p>-->
        <!--        <div class="custom-control custom-checkbox">-->
        <!--          <input class="custom-control-input" type="checkbox" id="customCheckbox62" value="option62">-->
        <!--          <label for="customCheckbox62" class="custom-control-label"> Mini Statement</label>-->
        <!--        </div>-->
        <!--      </p>-->
        <!--  <%2