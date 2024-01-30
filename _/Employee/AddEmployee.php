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
   <!--Sweet Alert -->
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/css/bootstrap-select.min.css">
  <style>
      input.form-control.menulist {
    width: 15px;
}
  </style>
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
                        <label >Select Department</label>
                        <select class="form-control select2" id="department" style="width: 100%;">
                            <option selected disabled>--Select--</option>
                        <?php
                        $department = $con->query("SELECT * FROM department order by ID desc");
                         while($department_data = $department->fetch_assoc()){
                        ?>

                        <option value="<?php echo $department_data['ID']?> "> <?php echo $department_data['NAME']?> </option>
                         <?php 
                         }
                         ?>
                            
                        </select>
                    </div>
                    
                    <div class="form-group col-md-6">
                        <label >Reporting Manager</label>
                        <input type="text" class="form-control" id="reporting_manager" placeholder="Enter Reporting Manager">
                      </div>
                      
                </div>
                <div class="form-row d-flex justify-content-around">
                    
                    <div class="form-group col-md-6">
                        <label >Employee Name</label>
                        <input type="text" class="form-control" id="emp_name" placeholder="Enter Employee Name">
                      </div>
                      
                      <div class="form-group col-md-6">
                        <label >Mobile Number </label>
                        <input type="text" class="form-control" id="number" placeholder="Enter Mobile Number">
                      </div>
                </div>
                <div class="form-row d-flex justify-content-around">
                      <div class="form-group col-md-12">
                        <label >Email Id</label>
                        <input type="text" class="form-control" id="email" placeholder="Enter Email Id">
                      </div>
                </div>
                
                <div class="form-row d-flex justify-content-around">
                    <div class="form-group col-md-12">
                        <label >Address </label>
                        <input type="text" class="form-control" id="residence_address" placeholder="Address..">
                    </div>
                </div>
               
               
                 <div class="form-row d-flex justify-content-around">
                    <div class="form-group col-md-4">
                        <label >State </label>
                        <select class='selectpicker state' onchange="showdistrict(this.value)" aria-label="Default select example" name="state" id="state" style="width: 200px;" data-live-search="true">
                                    <option value="Andhra Pradesh">Andhra Pradesh</option>
                                    <option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
                                    <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                                    <option value="Assam">Assam</option>
                                    <option value="Bihar">Bihar</option>
                                    <option value="Chandigarh">Chandigarh</option>
                                    <option value="Chhattisgarh">Chhattisgarh</option>
                                    <option value="Dadar and Nagar Haveli">Dadar and Nagar Haveli</option>
                                    <option value="Daman and Diu">Daman and Diu</option>
                                    <option value="Delhi">Delhi</option>
                                    <option value="Lakshadweep">Lakshadweep</option>
                                    <option value="Puducherry">Puducherry</option>
                                    <option value="Goa">Goa</option>
                                    <option value="Gujarat">Gujarat</option>
                                    <option value="Haryana">Haryana</option>
                                    <option value="Himachal Pradesh">Himachal Pradesh</option>
                                    <option value="Jammu and Kashmir">Jammu and Kashmir</option>
                                    <option value="Jharkhand">Jharkhand</option>
                                    <option value="Karnataka">Karnataka</option>
                                    <option value="Kerala">Kerala</option>
                                    <option value="Madhya Pradesh">Madhya Pradesh</option>
                                    <option value="Maharashtra">Maharashtra</option>
                                    <option value="Manipur">Manipur</option>
                                    <option value="Meghalaya">Meghalaya</option>
                                    <option value="Mizoram">Mizoram</option>
                                    <option value="Nagaland">Nagaland</option>
                                    <option value="Odisha">Odisha</option>
                                    <option value="Punjab">Punjab</option>
                                    <option value="Rajasthan">Rajasthan</option>
                                    <option value="Sikkim">Sikkim</option>
                                    <option value="Tamil Nadu">Tamil Nadu</option>
                                    <option value="Telangana">Telangana</option>
                                    <option value="Tripura">Tripura</option>
                                    <option value="Uttar Pradesh">Uttar Pradesh</option>
                                    <option value="Uttarakhand">Uttarakhand</option>
                                    <option value="West Bengal">West Bengal</option>
                                </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label>District</label>
                          <select class='selectpicker dist' onchange="showblock(this.value)" aria-label="Default select example" id="dist" style="width: 200px;" name="district"  data-live-search="true" >
                                      
                             </select>
                    </div>
                    
                     <div class="form-group col-md-4">
                        <label >Block</label>
                        <select class='selectpicker block' aria-label="Default select example" id="blk_Cont" style="width: 200px;" name="block"  data-live-search="true" >
                                    
                        </select>
                      </div>
                      
                </div>
                
                 <hr>
                
                 <div class="form-row d-flex justify-content-around">
                      
                         <div class="form-group col-md-4">
                        <label >Looking State </label>
                          <select class='selectpicker lstate' data-actions-box="true" onchange="showdistrict(this.value)" multiple aria-label="Default select example" name="lstate" id="lstate" style="width: 200px;" data-live-search="true">
                                    <option value="Andhra Pradesh">Andhra Pradesh</option>
                                    <option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
                                    <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                                    <option value="Assam">Assam</option>
                                    <option value="Bihar">Bihar</option>
                                    <option value="Chandigarh">Chandigarh</option>
                                    <option value="Chhattisgarh">Chhattisgarh</option>
                                    <option value="Dadar and Nagar Haveli">Dadar and Nagar Haveli</option>
                                    <option value="Daman and Diu">Daman and Diu</option>
                                    <option value="Delhi">Delhi</option>
                                    <option value="Lakshadweep">Lakshadweep</option>
                                    <option value="Puducherry">Puducherry</option>
                                    <option value="Goa">Goa</option>
                                    <option value="Gujarat">Gujarat</option>
                                    <option value="Haryana">Haryana</option>
                                    <option value="Himachal Pradesh">Himachal Pradesh</option>
                                    <option value="Jammu and Kashmir">Jammu and Kashmir</option>
                                    <option value="Jharkhand">Jharkhand</option>
                                    <option value="Karnataka">Karnataka</option>
                                    <option value="Kerala">Kerala</option>
                                    <option value="Madhya Pradesh">Madhya Pradesh</option>
                                    <option value="Maharashtra">Maharashtra</option>
                                    <option value="Manipur">Manipur</option>
                                    <option value="Meghalaya">Meghalaya</option>
                                    <option value="Mizoram">Mizoram</option>
                                    <option value="Nagaland">Nagaland</option>
                                    <option value="Odisha">Odisha</option>
                                    <option value="Punjab">Punjab</option>
                                    <option value="Rajasthan">Rajasthan</option>
                                    <option value="Sikkim">Sikkim</option>
                                    <option value="Tamil Nadu">Tamil Nadu</option>
                                    <option value="Telangana">Telangana</option>
                                    <option value="Tripura">Tripura</option>
                                    <option value="Uttar Pradesh">Uttar Pradesh</option>
                                    <option value="Uttarakhand">Uttarakhand</option>
                                    <option value="West Bengal">West Bengal</option>
                                </select>
                    </div>
                      
                      <div class="form-group col-md-4">
                        <label>Looking District</label>
                         <select class='selectpicker ldist' data-actions-box="true" onchange="showblock(this.value)" multiple aria-label="Default select example" id="ldist" style="width: 200px;" name="ldistrict"  data-live-search="true" >
                                      
                             </select>
                    </div>
                    
                    <div class="form-group col-md-4">
                        <label>Looking Block</label>
                        <select class='selectpicker lblock' data-actions-box="true" multiple aria-label="Default select example" id="lblock" style="width: 200px;" name="lblock"  data-live-search="true" >
                                    
                        </select>
                      </div>
                     
                     </div>
                
                
      
            </div>
                <!-- /.card-body -->

             
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
            
                <div class="card-body" style="height: 590px;overflow-y: auto;">
                 
              <p>
                   <i class="nav-icon fas fa-users"></i>
                Member
              </p>
               <div class="row" style="display: flex;flex-direction: column;">
                   
            <div class="form-check">
            <input type="checkbox" class="form-check-input menulist"  value="Member Transfer"><label class="form-check-label" for="flexCheckChecked"> Member Transfer</label>
            </div><br>
            <div class="form-check">
            <input type="checkbox" class="form-check-input menulist"  value="Member List"><label class="form-check-label" for="flexCheckChecked"> Member List</label>
            </div><br>
            <div class="form-check">
            <input type="checkbox" class="form-check-input menulist"  value="Retailer Verification"><label class="form-check-label" for="flexCheckChecked"> Retailer Verification</label>
            </div><br>
            <div class="form-check">
            <input type="checkbox" class="form-check-input menulist"  value="Distributor Request"><label class="form-check-label" for="flexCheckChecked">Distributor Request</label>
            </div><br>
            <div class="form-check">
            <input type="checkbox" class="form-check-input menulist"  value="Meeting"><label class="form-check-label" for="flexCheckChecked">Meeting</label>
            </div><br>
            
               </div>
               
               <p>
                <i class="nav-icon fas fa-fingerprint"></i>
                Employee Managment
              </p>
              
               <div class="row" style="display: flex;flex-direction: column;">
                   
            <div class="form-check">
            <input type="checkbox" class="form-check-input menulist"  value="Add Employee"><label class="form-check-label" for="flexCheckChecked">Add Employee</label>
            </div><br>
            <div class="form-check">
            <input type="checkbox" class="form-check-input menulist"  value="Employee List"><label class="form-check-label" for="flexCheckChecked"> Employee List</label>
            </div><br>
            <div class="form-check">
            <input type="checkbox" class="form-check-input menulist"  value="Add Department"><label class="form-check-label" for="flexCheckChecked">Add Department</label>
            </div><br>
            <div class="form-check">
            <input type="checkbox" class="form-check-input menulist"  value="Department List"><label class="form-check-label" for="flexCheckChecked">Department List</label>
            </div><br>
            
            
               </div>
               
                <p>
                <i class="nav-icon fas fa-users"></i>
                Wallet Managment
              </p>
              
               <div class="row" style="display: flex;flex-direction: column;">
                   
            <div class="form-check">
            <input type="checkbox" class="form-check-input menulist"  value="Main Wallet Report"><label class="form-check-label" for="flexCheckChecked">Main Wallet Report</label>
            </div><br>
            <div class="form-check">
            <input type="checkbox" class="form-check-input menulist"  value="Aeps Wallet Report"><label class="form-check-label" for="flexCheckChecked">Aeps Wallet Report</label>
            </div><br>
            
               </div>
               
                <p>
                <i class="nav-icon fas fa-users"></i>
                ACCOUNT MANAGMENT
              </p>
              
               <div class="row" style="display: flex;flex-direction: column;">

            <div class="form-check">
            <input type="checkbox" class="form-check-input menulist"  value="Agent Fund Transfer"><label class="form-check-label" for="flexCheckChecked">Agent Fund Transfer</label>
            </div><br>
            
            <div class="form-check">
            <input type="checkbox" class="form-check-input menulist"  value="Agent Fund Transfer Aeps Wallet Report"><label class="form-check-label" for="flexCheckChecked">Fund Transfer Report</label>
            </div><br>
            
            <div class="form-check">
            <input type="checkbox" class="form-check-input menulist"  value="Agent Transaction Report Aeps Wallet"><label class="form-check-label" for="flexCheckChecked">Agent Transaction Report</label>
            </div><br>
            
            <div class="form-check">
            <input type="checkbox" class="form-check-input menulist"  value="P & L Report"><label class="form-check-label" for="flexCheckChecked">P & L Report</label>
            </div><br>
            <div class="form-check">
            <input type="checkbox" class="form-check-input menulist"  value="Invoices"><label class="form-check-label" for="flexCheckChecked">Invoices</label>
            </div><br>
            <div class="form-check">
            <input type="checkbox" class="form-check-input menulist"  value="TDS Report"><label class="form-check-label" for="flexCheckChecked">TDS Report</label>
            </div><br>
            <div class="form-check">
            <input type="checkbox" class="form-check-input menulist"  value="Sales GST Report"><label class="form-check-label" for="flexCheckChecked">Sales GST Report</label>
            </div><br>
            
               </div>
               
               <p>
                <i class="nav-icon fas fa-users"></i>
                Reseller Accounts
              </p>
              
               <div class="row" style="display: flex;flex-direction: column;">
              <p><i class="nav-icon fas fa-fingerprint"></i> Reseller</p>
              
            <div class="form-check">
            <input type="checkbox" class="form-check-input menulist"  value="Reseller Fund Transfer"><label class="form-check-label" for="flexCheckChecked">Fund Transfer</label>
            </div><br>
            <div class="form-check">
            <input type="checkbox" class="form-check-input menulist"  value="Reseller Fund Transfer Report"><label class="form-check-label" for="flexCheckChecked">Fund Transfer Report</label>
            </div><br>
            <div class="form-check">
            <input type="checkbox" class="form-check-input menulist"  value="Reseller Transaction Report"><label class="form-check-label" for="flexCheckChecked">Transaction Report</label>
            </div><br>
            
            
            
            <p><i class="nav-icon fas fa-fingerprint"></i>Reseller Agent</p>
              
            <div class="form-check">
            <input type="checkbox" class="form-check-input menulist"  value="Reseller Agent Fund Transfer"><label class="form-check-label" for="flexCheckChecked">Fund Transfer</label>
            </div><br>
            <div class="form-check">
            <input type="checkbox" class="form-check-input menulist"  value="Reseller Agent Fund Transfer Report"><label class="form-check-label" for="flexCheckChecked">Fund Transfer Report</label>
            </div><br>
            <div class="form-check">
            <input type="checkbox" class="form-check-input menulist"  value="Reseller Agent Transaction Report"><label class="form-check-label" for="flexCheckChecked">Transaction Report</label>
            </div><br>
            
            <div class="form-check">
            <input type="checkbox" class="form-check-input menulist"  value="Reseller P & L Report"><label class="form-check-label" for="flexCheckChecked">P & L Report</label>
            </div><br>
            <div class="form-check">
            <input type="checkbox" class="form-check-input menulist"  value="Reseller Invoices"><label class="form-check-label" for="flexCheckChecked">Invoices</label>
            </div><br>
            <div class="form-check">
            <input type="checkbox" class="form-check-input menulist"  value="Reseller TDS Report"><label class="form-check-label" for="flexCheckChecked">TDS Report</label>
            </div><br>
            <div class="form-check">
            <input type="checkbox" class="form-check-input menulist"  value="Reseller Sales GST Report"><label class="form-check-label" for="flexCheckChecked">Sales GST Report</label>
            </div><br>
            </div>
               
               
              <p>
                <i class="nav-icon fas fa-users"></i>
                SERVICE MANAGMENT
              </p> 
               
                <p><i class="nav-icon fas fa-fingerprint"></i> Aeps Service<i class="fas fa-angle-left bottom"></i></p> 
              
            
            <div class="form-check">
            <input type="checkbox" class="form-check-input menulist"  value="AePs - Cash Withdraw"><label class="form-check-label" for="flexCheckChecked">AePs - Cash Withdraw</label>
            </div><br>
            <div class="form-check">
            <input type="checkbox" class="form-check-input menulist"  value="Mini Statement"><label class="form-check-label" for="flexCheckChecked">Mini Statement</label>
            </div><br>
            <div class="form-check">
            <input type="checkbox" class="form-check-input menulist"  value="AdharPay"><label class="form-check-label" for="flexCheckChecked">AdharPay</label>
            </div><br>
            <div class="form-check">
            <input type="checkbox" class="form-check-input menulist"  value="Balance Enquery"><label class="form-check-label" for="flexCheckChecked">Balance Enquery</label>
            </div><br>
            <div class="form-check">
            <input type="checkbox" class="form-check-input menulist"  value="Cash Deposit"><label class="form-check-label" for="flexCheckChecked">Cash Deposit</label>
            </div><br>
            <div class="form-check">
            <input type="checkbox" class="form-check-input menulist"  value="Reseller Agent Transaction Aeps Wallet Report"><label class="form-check-label" for="flexCheckChecked">M-ATM</label>
            </div><br>
            
            
            <p> <i class="nav-icon fas fa-exchange-alt"></i>Money Transfer<i class="fas fa-angle-left bottom"></i></p> 
              
            
            <div class="form-check">
            <input type="checkbox" class="form-check-input menulist"  value="DMT"><label class="form-check-label" for="flexCheckChecked">DMT</label>
            </div><br>
            <div class="form-check">
            <input type="checkbox" class="form-check-input menulist"  value="X-DMT"><label class="form-check-label" for="flexCheckChecked">X-DMT</label>
            </div><br>
            <div class="form-check">
            <input type="checkbox" class="form-check-input menulist"  value="UPI"><label class="form-check-label" for="flexCheckChecked">UPI</label>
            </div><br>
            
            
             <p><i class="nav-icon fas fa-mobile-alt"></i> Recharge Service<i class="fas fa-angle-left bottom"></i></p> 
              
            
            <div class="form-check">
            <input type="checkbox" class="form-check-input menulist"  value="Recharge"><label class="form-check-label" for="flexCheckChecked">Recharge</label>
            </div><br>
            <div class="form-check">
            <input type="checkbox" class="form-check-input menulist"  value="DTH"><label class="form-check-label" for="flexCheckChecked">DTH</label>
            </div><br>
            <div class="form-check">
            <input type="checkbox" class="form-check-input menulist"  value="Landline"><label class="form-check-label" for="flexCheckChecked">Landline</label>
            </div><br>
            <div class="form-check">
            <input type="checkbox" class="form-check-input menulist"  value="Data Card"><label class="form-check-label" for="flexCheckChecked">Data Card</label>
            </div><br>
            
            
            
            <div class="form-check">
            <input type="checkbox" class="form-check-input menulist"  value="Payout"><label class="form-check-label" for="flexCheckChecked"> Payout<i class="nav-icon fas fa-university"></i></label>
            </div><br>
            
             <div class="form-check">
            <input type="checkbox" class="form-check-input menulist"  value="Loan/Finance(Offline)"><label class="form-check-label" for="flexCheckChecked"> Loan/Finance (Offline)<i class="nav-icon far fa-credit-card"></i></label>
            </div><br>
            
             <div class="form-check">
            <input type="checkbox" class="form-check-input menulist"  value="Insurance (Offline)"><label class="form-check-label" for="flexCheckChecked"> Insurance (Offline)<i class="nav-icon far fa-credit-card"></i></label>
            </div><br>
            
            <p><i class="nav-icon fas fa-building"></i> E-Tax Services (Offline)<i class="fas fa-angle-left bottom"></i></p> 
              
            
            <div class="form-check">
            <input type="checkbox" class="form-check-input menulist"  value="Pan Card"><label class="form-check-label" for="flexCheckChecked">Pan Card</label>
            </div><br>
            <div class="form-check">
            <input type="checkbox" class="form-check-input menulist"  value="GST"><label class="form-check-label" for="flexCheckChecked">GST</label>
            </div><br>
            <div class="form-check">
            <input type="checkbox" class="form-check-input menulist"  value="Compamy Registration"><label class="form-check-label" for="flexCheckChecked">Compamy Registration</label>
            </div><br>
            <div class="form-check">
            <input type="checkbox" class="form-check-input menulist"  value="TDS"><label class="form-check-label" for="flexCheckChecked">TDS</label>
            </div><br>
            <div class="form-check">
            <input type="checkbox" class="form-check-input menulist"  value="ITR"><label class="form-check-label" for="flexCheckChecked">ITR</label>
            </div><br>
            <div class="form-check">
            <input type="checkbox" class="form-check-input menulist"  value="DSC"><label class="form-check-label" for="flexCheckChecked">DSC</label>
            </div><br>
            
            
            <p><i class="nav-icon fas fa-building"></i> Account Opening<i class="fas fa-angle-left bottom"></i></p> 
              
            <div class="form-check">
            <input type="checkbox" class="form-check-input menulist"  value="Axis Bank"><label class="form-check-label" for="flexCheckChecked">Axis Bank</label>
            </div><br>
            
            
            <p><i class="nav-icon far fa-lightbulb"></i> BBPS<i class="fas fa-angle-left bottom"></i></p> 
              
            
            <div class="form-check">
            <input type="checkbox" class="form-check-input menulist"  value="Online BBPS"><label class="form-check-label" for="flexCheckChecked">Online BBPS</label>
            </div><br>
            <div class="form-check">
            <input type="checkbox" class="form-check-input menulist"  value="Offline BBPS"><label class="form-check-label" for="flexCheckChecked">Offline BBPS</label>
            </div><br>
            <div class="form-check">
            <input type="checkbox" class="form-check-input menulist"  value="Broadband"><label class="form-check-label" for="flexCheckChecked">Broadband</label>
            </div><br>
            <div class="form-check">
            <input type="checkbox" class="form-check-input menulist"  value="Electricity"><label class="form-check-label" for="flexCheckChecked">Electricity</label>
            </div><br>
            <div class="form-check">
            <input type="checkbox" class="form-check-input menulist"  value="Water Bill Payment"><label class="form-check-label" for="flexCheckChecked">Water Bill Payment</label>
            </div><br>
            <div class="form-check">
            <input type="checkbox" class="form-check-input menulist"  value="LIC Bill Payment"><label class="form-check-label" for="flexCheckChecked">LIC Bill Payment</label>
            </div><br>
            <div class="form-check">
            <input type="checkbox" class="form-check-input menulist"  value="EMI Payment"><label class="form-check-label" for="flexCheckChecked">EMI Payment</label>
            </div><br>
            <div class="form-check">
            <input type="checkbox" class="form-check-input menulist"  value="GAS Payment"><label class="form-check-label" for="flexCheckChecked">GAS Payment</label>
            </div><br>
            <div class="form-check">
            <input type="checkbox" class="form-check-input menulist"  value="Credit Card Bill Payment"><label class="form-check-label" for="flexCheckChecked">Credit Card Bill Payment</label>
            </div><br>
            <div class="form-check">
            <input type="checkbox" class="form-check-input menulist"  value="Rent On Credit Card"><label class="form-check-label" for="flexCheckChecked">Rent On Credit Card</label>
            </div><br>
            <div class="form-check">
            <input type="checkbox" class="form-check-input menulist"  value="FasTag"><label class="form-check-label" for="flexCheckChecked">FasTag</label>
            </div><br>
            <div class="form-check">
            <input type="checkbox" class="form-check-input menulist"  value="Ticket Booking"><label class="form-check-label" for="flexCheckChecked">Ticket Booking</label>
            </div><br>
               
               <p>
                SOFTWARE MANAGMENT
              </p>
              
              <div class="form-check">
            <input type="checkbox" class="form-check-input menulist"  value="Service & Server"><label class="form-check-label" for="flexCheckChecked">Service & Server</label>
            </div><br>
            <div class="form-check">
            <input type="checkbox" class="form-check-input menulist"  value="Website Managment"><label class="form-check-label" for="flexCheckChecked">Website Managment</label>
            </div><br>
            <div class="form-check">
            <input type="checkbox" class="form-check-input menulist"  value="Slider Managment"><label class="form-check-label" for="flexCheckChecked">Slider Managment</label>
            </div><br>
            <div class="form-check">
            <input type="checkbox" class="form-check-input menulist"  value="Promo Code"><label class="form-check-label" for="flexCheckChecked">Promo Code</label>
            </div><br>
            <div class="form-check">
            <input type="checkbox" class="form-check-input menulist"  value="Subscription"><label class="form-check-label" for="flexCheckChecked">Subscription</label>
            </div><br>
            <div class="form-check">
            <input type="checkbox" class="form-check-input menulist"  value="API HIT LOG"><label class="form-check-label" for="flexCheckChecked">API HIT LOG</label>
            </div><br>
            <div class="form-check">
            <input type="checkbox" class="form-check-input menulist"  value="Activity"><label class="form-check-label" for="flexCheckChecked">Activity</label>
            </div><br>
            <div class="form-check">
            <input type="checkbox" class="form-check-input menulist"  value="Target / Task Managment"><label class="form-check-label" for="flexCheckChecked">Target / Task Managment</label>
            </div><br>
            
             <p>
                CUSTOMER SUPPORT
              </p>
            
             <div class="form-check">
            <input type="checkbox" class="form-check-input menulist"  value="Customer Support"><label class="form-check-label" for="flexCheckChecked">Customer Support</label>
            </div><br>
            <div class="form-check">
            <input type="checkbox" class="form-check-input menulist"  value="Notification & News"><label class="form-check-label" for="flexCheckChecked">Notification & News</label>
            </div><br>
            
            
             <p>
                RESELLER MANAGMENT
              </p>
            
             <div class="form-check">
            <input type="checkbox" class="form-check-input menulist"  value="Reseller Managment"><label class="form-check-label" for="flexCheckChecked">Reseller Managment</label>
            </div><br>
            <div class="form-check">
            <input type="checkbox" class="form-check-input menulist"  value="Reseller Wallet"><label class="form-check-label" for="flexCheckChecked">Reseller Wallet</label>
            </div><br>
            <div class="form-check">
            <input type="checkbox" class="form-check-input menulist"  value="Reseller's Agents"><label class="form-check-label" for="flexCheckChecked">Reseller's Agents</label>
            </div><br>
           
               
      </div>
     </div>
    </div> 
                    <div class="card-footer d-flex text-center justify-content-center">
                  <button type="submit" id="emp_btn" class="btn btn-primary">Add Employee</button>
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

function showblock(value){
    
     $.ajax({
        type: "POST",
        url: "../crm/admin/Backend/showBlock.php",
        data: { pageid : 2,
                myarr : value},
        success: function (data) {
                $('.selectpicker').selectpicker();
                if(data)
                {
               $("#blk_Cont").html(`${data}`);
               $('#blk_Cont').selectpicker('refresh');
               $("#lblock").append(`${data}`);
               $('#lblock').selectpicker('refresh');
                }

        }
      });
   }
   
   
   function showdistrict(value){
     $.ajax({
        type: "POST",
        url: "../crm/admin/Backend/showBlock.php",
        data: { pageid : 3,
                statearray : value},
        success: function (data) {
                $('.selectpicker').selectpicker();
                if(data)
                {
               $("#dist").html(`${data}`);
               $('#dist').selectpicker('refresh');
               $("#ldist").append(`${data}`);
               $('#ldist').selectpicker('refresh');
                }

        }
      });
   }


    $(document).ready(function(){
        
        $("#emp_btn").click(function(e){
            e.preventDefault();
           let department = $("#department").val();
           let employee_name = $("#emp_name").val();
           let emp_mobile = $("#number").val();
           let emp_email = $("#email").val();
           let emp_address = $("#residence_address").val();
           let emp_state = $("#state").val();
           let emp_district = $("#dist").val();
           let reporting_manager = $("#reporting_manager").val();
           let emp_block = $("#blk_Cont").val();
           let emp_id = $("#emp_id").val();
           let menulist = [];
           let allstate = [];
           let alldist = [];
           let allblock = [];
           
           $(".menulist").each(function(){
               if($(this).is(":checked")){
                   menulist.push($(this).val());
               }
           });
           
           menulist = menulist.toString();
           
        //   all state
           $('#lstate option:selected').each(function() {
            allstate.push($(this).val());
            });
            
        //   all district
            $('#ldist option:selected').each(function() {
            alldist.push($(this).val());
            });
        //   all block
            $('#lblock option:selected').each(function() {
            allblock.push($(this).val());
            });
           
           menulist = menulist.toString();
           allstate = allstate.toString();
           alldist = alldist.toString();
           allblock = allblock.toString();
        
           if(department == ''){
               alert("Please Select Department ..!");
           }else if(employee_name == ''){
               
               alert("Please Enter Employee Name ..!");
           }else if(emp_mobile == ''){
               
               alert("Please Enter Employee Mobile Number ..!");
           }else if(emp_email == ''){
               
               alert("Please Enter Employee Email ..!");
           }else if(emp_address == ''){
               
               alert("Please Enter Employee Address ..!");
           }else if(emp_state == ''){
               
               alert("Please Select State ..!");
           }else if(emp_district == ''){
               
               alert("Please Select District ..!");
           }else if(reporting_manager == ''){
               
               alert("Please Enter Reporting Manager Name ..!");
           }else if(emp_block == ''){
               
               alert("Please Enter Block ..!");
           }else if(menulist == ''){
               
               alert("Please Select Atleast One Sidebar Menu Item ..!");
           }else{
               $.ajax({
                   url : "addemp.php",
                   type : "POST",
                   data : {
                       name:employee_name,
                       emp_department:department,
                       r_manager:reporting_manager,
                       mobile:emp_mobile,
                       email:emp_email,
                       address:emp_address,
                       district:emp_district,
                       state:emp_state,
                       block:emp_block,
                       ldist:alldist,
                       lstate:allstate,
                       lblock:allblock,
                       sidebarmenu:menulist,
                       pageid:1
                   },
                   success : function(data){
                       if(data == 1){
                           Swal.fire({
                                  icon: "success",
                                  title: "Hurray!",
                                   button: "Okay",
                                  text: 'Employee Add Successfully.',
                                }).then(function(){ 
                                      $("#addempform")[0].reset();
                                   }
                                );
                       }else{
                           Swal.fire({
                                  icon: "error",
                                  title: "OOPS!",
                                   button: "Close",
                                  text: 'Employee Add Unsuccessfull.',
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

