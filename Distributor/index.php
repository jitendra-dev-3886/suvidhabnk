<?php
session_start();
include("../Db/config.php");
include("include/Auth.php");
$my_id = $_SESSION["UsId"];
$date = date("Y-m-d");
$myuser = $con->query("SELECT * FROM `user` WHERE ID='$my_id'")->fetch_assoc();
$user_type = $myuser['USER_TYPE'];
$tearn = $con->query("SELECT FORMAT(IFNULL(SUM(COMMISSION),0),2)earn FROM `commission_report` WHERE `USER_ID` = '$my_id' AND DATE(`TIME`) = '$date'")->fetch_assoc();
$tbusiness = $con->query("SELECT FORMAT(IFNULL(SUM(AMOUNT),0),2)amt FROM `commission_report` WHERE `USER_ID` = '$my_id' AND DATE(`TIME`) = '$date'")->fetch_assoc();

if(isset($_GET['logout'])){
    session_destroy();
    header("location:../Agent/Login.php");
}

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
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  
  <style>
  
  .mat-clr-stat-card .card-block .mat-icon {
    position: absolute;
    top: 50%;
    left: 50%;
    -webkit-transform: translate(-50%, -50%);
    transform: translate(-50%, -50%);
    
    font-size:24px;
}

.mat-clr-stat-card {
    overflow: hidden;
}
.card {
    border-radius: 5px;
    box-shadow: 0 1px 20px 0 rgb(69 90 100 / 18%);
    border: none;
    margin-bottom: 30px;
    transition: all 0.3s ease-in-out;
}
      
      .icons_section {
    padding: 50px 0;
    padding-bottom: 0;
    margin: 20px 0 40px 0;
    background: #fff;
    border-radius: 5px;
}

.miconsec {
    display: flex;
    flex-direction: column;
    align-items: center;
    margin-bottom: 50px;
}

.serviceicon {
    background: #00adff45;
    border-radius: 50%;
    padding: 16px;
    margin-bottom: 20px;
}
  </style>
  
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
      <!--<div class="container-fluid">-->
      <!--  <div class="row mb-2">-->
      <!--    <div class="col-sm-6">-->
            <!--<h1 class="m-0">Dashboard v2</h1>-->
      <!--    </div><!-- /.col -->
      <!--    <div class="col-sm-6">-->
      <!--      <ol class="breadcrumb float-sm-right">-->
      <!--        <li class="breadcrumb-item"><a href="#">Home</a></li>-->
      <!--        <li class="breadcrumb-item active">Dashboard </li>-->
      <!--      </ol>-->
      <!--    </div><!-- /.col -->
      <!--  </div><!-- /.row -->
      <!--</div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content" style=" margin-top: 4%;">
      <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
          <div class="col-12 col-sm-6 col-md-3">
              <a href="WalletReport?type=MAIN">
                  <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-wallet"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Main Wallet</span>
                <span class="info-box-number">
                  ₹ <?php echo number_format((float)$user['MAIN_BAL'], 2, '.', '');    ?>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            </a>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
              <a href="WalletReport?type=AEPS">
                    <div class="info-box mb-3">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-wallet"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Commission Wallet</span>
                <span class="info-box-number">₹ <?php echo number_format((float)$user['AEPS_BAL'], 2, '.', ''); ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            </a>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Today Earing</span>
                <span class="info-box-number">₹ <?php echo $tearn["earn"]; ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Today Buisness</span>
                <span class="info-box-number">₹ <?php echo $tbusiness["amt"]; ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

        <!---->
              
        <!---->

        <!--<div class="row">-->
        <!--  <div class="col-md-12">-->
        <!--    <div class="card">-->
        <!--      <div class="card-header">-->
        <!--        <h5 class="card-title">Our Services</h5>-->

                <!--<div class="card-tools">-->
                <!--  <button type="button" class="btn btn-tool" data-card-widget="collapse">-->
                <!--    <i class="fas fa-minus"></i>-->
                <!--  </button>-->
                <!--  <div class="btn-group">-->
                <!--    <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown">-->
                <!--      <i class="fas fa-filter"></i>-->
                <!--    </button>-->
                <!--    <div class="dropdown-menu dropdown-menu-right" role="menu">-->
                <!--      <a href="#" class="dropdown-item">Today</a>-->
                <!--      <a href="#" class="dropdown-item">Weekly</a>-->
                <!--      <a href="#" class="dropdown-item">Monthly</a>-->
                <!--      <a href="#" class="dropdown-item">Yearly</a>-->
                <!--      <a class="dropdown-divider"></a>-->
                <!--      <a href="#" class="dropdown-item">Customer Date</a>-->
                <!--    </div>-->
                <!--  </div>-->
                <!--  <button type="button" class="btn btn-tool" data-card-widget="remove">-->
                <!--    <i class="fas fa-times"></i>-->
                <!--  </button>-->
                <!--</div>-->
        <!--      </div>-->
              <!-- /.card-header -->
        <!--      <div class="card-body">-->
               <!--    <div class="row leadcol" >-->
               <!--     <div class="col-lg-2 col-md-4 col-sm-6">-->
               <!--       <a href="All_Report">-->
               <!--         <div class="card mat-clr-stat-card text-white blue">-->
               <!--             <div class="card-block">-->
               <!--                 <div class="row">-->
               <!--                     <div class="col-3 text-center" style="background:#fff;">-->
               <!--                         <i class="fas fa-file-alt mat-icon f-24 " style="color:#d35400;"></i>-->
               <!--                     </div>-->
               <!--                     <div class="col-9 cst-cont bg-c-blue" style="background:#d35400;">-->
                                       
               <!--                         <p class="m-b-0">Transaction</p>-->
                                        
               <!--                          <h5>History</h5>-->
               <!--                     </div>-->
               <!--                 </div>-->
               <!--             </div>-->
               <!--         </div>-->
                        
               <!--      </a>-->
               <!--     </div>-->
               <!--     <div class="col-lg-2 col-md-4 col-sm-6">-->
               <!--      <a href="All_Report">-->
               <!--         <div class="card mat-clr-stat-card text-white blue">-->
               <!--             <div class="card-block">-->
               <!--                 <div class="row">-->
               <!--                     <div class="col-4 text-center bg-c-blue" style="background:#fff;">-->
               <!--                         <i class="fas fa-user mat-icon f-24 " style="color:#c0392b;"></i>-->
               <!--                     </div>-->
               <!--                     <div class="col-8 cst-cont " style="background:#c0392b;">-->
                                       
               <!--                         <p class="m-b-0">Account</p>-->
                                        
               <!--                          <h5>Ledger</h5>-->
               <!--                     </div>-->
               <!--                 </div>-->
               <!--             </div>-->
               <!--         </div>-->
               <!--      </a>-->
               <!--     </div>-->
               <!--     <div class="col-lg-2 col-md-4 col-sm-6">-->
               <!--       <a href="Parchase_history">-->
               <!--         <div class="card mat-clr-stat-card text-white blue">-->
               <!--             <div class="card-block">-->
               <!--                 <div class="row">-->
               <!--                     <div class="col-4 text-center bg-c-blue" style="background:#fff;">-->
               <!--                         <i class="fas fa-history mat-icon f-24 " style="color:#27ae60;"></i>-->
               <!--                     </div>-->
               <!--                     <div class="col-8 cst-cont " style="background:#27ae60;">-->
                                       
               <!--                         <p class="m-b-0">Parchase</p>-->
                                        
               <!--                          <h5>History</h5>-->
               <!--                     </div>-->
               <!--                 </div>-->
               <!--             </div>-->
               <!--         </div>-->
                        
               <!--       </a>-->
               <!--     </div>-->
                 
               <!--     <div class="col-lg-2 col-md-4 col-sm-6">-->
               <!--       <a href="Fund_Report">-->
               <!--         <div class="card mat-clr-stat-card text-white blue">-->
               <!--             <div class="card-block">-->
               <!--                 <div class="row">-->
               <!--                     <div class="col-3 text-center bg-c-blue" style="background:#fff;">-->
               <!--                         <i class="fas fa-trophy mat-icon f-24" style="color:#e1b12c;"></i>-->
               <!--                     </div>-->
               <!--                     <div class="col-9 cst-cont" style="background:#e1b12c;">-->
                                       
               <!--                         <p class="m-b-0">Sales</p>-->
                                        
               <!--                          <h5>Summary</h5>-->
               <!--                     </div>-->
               <!--                 </div>-->
               <!--             </div>-->
               <!--         </div>-->
               <!--      </a>-->
               <!--     </div>-->
               <!--     <div class="col-lg-2 col-md-4 col-sm-6">-->
               <!--       <a href="Day_book">-->
               <!--         <div class="card mat-clr-stat-card text-white blue">-->
               <!--             <div class="card-block">-->
               <!--                 <div class="row">-->
               <!--                     <div class="col-4 text-center bg-c-blue" style="background:#fff;">-->
               <!--                         <i class="fas fa-book mat-icon f-24" style="color:#8e44ad;"></i>-->
               <!--                     </div>-->
               <!--                     <div class="col-8 cst-cont" style="background:#8e44ad;">-->
                                       
               <!--                         <p class="m-b-0">Day</p>-->
                                        
               <!--                          <h5>Book</h5>-->
               <!--                     </div>-->
               <!--                 </div>-->
               <!--             </div>-->
               <!--         </div>-->
               <!--      </a>-->
               <!--     </div>-->
               <!--     <div class="col-lg-2 col-md-4 col-sm-6">-->
               <!--       <a href="AddFund">-->
               <!--         <div class="card mat-clr-stat-card text-white blue">-->
               <!--             <div class="card-block">-->
               <!--                 <div class="row">-->
               <!--                     <div class="col-4 text-center bg-c-blue"  style="background:#fff;">-->
               <!--                         <i class="fas fa-chart-bar mat-icon f-24"  style="color:#2980b9;"></i>-->
               <!--                     </div>-->
               <!--                     <div class="col-8 cst-cont"  style="background:#2980b9;">-->
                                       
               <!--                         <p class="m-b-0">Fund</p>-->
                                        
               <!--                          <h5>Request</h5>-->
               <!--                     </div>-->
               <!--                 </div>-->
               <!--             </div>-->
               <!--         </div>-->
               <!--      </a>-->
               <!--     </div>-->
                    
               <!--</div>-->
               
               
        <!--         <?php if($user["US_STATUS"] == 'Active'){ ?>-->
                 
        <!--         <div class="row icons_section">-->
                                        
                                        
        <!--                                <div class="col-md-2 col-sm-3 col-xs-3 miconsec">-->
        <!--                                    <a href="MoneyTransferDMTReport.php">-->
        <!--                                    <div class="serviceicon">-->
        <!--                                        <img width="40px" src="assets/icons/money_transfer.svg" />-->
        <!--                                    </div>-->
        <!--                                    </a>-->
                                            
        <!--                                     <a href="MoneyTransferDMTReport.php">-->
        <!--                                    <div class="servicename">-->
        <!--                                        <h6>Money Transfer</h6>-->
        <!--                                    </div>-->
        <!--                                     </a>-->
        <!--                                </div>-->
                                        
        <!--                                <div class="col-md-2 col-sm-3 col-xs-3 miconsec">-->
        <!--                                    <a href="MoneyTransferXDMTReport.php">-->
        <!--                                    <div class="serviceicon">-->
        <!--                                        <img width="40px" src="assets/icons/money_transfer.svg" />-->
        <!--                                    </div>-->
        <!--                                    </a>-->
                                            
        <!--                                     <a href="MoneyTransferXDMTReport.php">-->
        <!--                                    <div class="servicename">-->
        <!--                                        <h6>X-DMT</h6>-->
        <!--                                    </div>-->
        <!--                                     </a>-->
        <!--                                </div>-->
        <!--                                <div class="col-md-2 col-sm-3 col-xs-3 miconsec">-->
        <!--                                    <a href="#">-->
        <!--                                    <div class="serviceicon">-->
        <!--                                        <img width="40px" src="assets/icons/money_transfer.svg" />-->
        <!--                                    </div>-->
        <!--                                    </a>-->
                                            
        <!--                                     <a href="#">-->
        <!--                                    <div class="servicename">-->
        <!--                                        <h6>UPI Transfer</h6>-->
        <!--                                    </div>-->
        <!--                                     </a>-->
        <!--                                </div>-->
                                      
        <!--                                <div class="col-md-2 col-sm-3 col-xs-3 miconsec">-->
                                            
        <!--                                    <a href="PayoutServiceReport.php">-->
        <!--                                    <div class="serviceicon">-->
        <!--                                        <img width="40px" src="assets/icons/taxes.svg" />-->
        <!--                                    </div>-->
        <!--                                    </a>-->
                                            
        <!--                                    <a href="PayoutServiceReport.php">-->
        <!--                                    <div class="servicename">-->
        <!--                                        <h6>Payout</h6>-->
        <!--                                    </div>-->
        <!--                                     </a>-->
        <!--                                </div>-->
                                        
        <!--                                <div class="col-md-2 col-sm-3 col-xs-3 miconsec">-->
                                            
        <!--                                    <a href="AePsServiceReport.php">-->
        <!--                                    <div class="serviceicon">-->
        <!--                                        <img width="40px" src="assets/icons/aeps.svg" />-->
        <!--                                    </div>-->
        <!--                                    </a>-->
                                            
        <!--                                    <a href="AePsServiceReport.php">-->
        <!--                                    <div class="servicename">-->
        <!--                                        <h6>AEPS</h6>-->
        <!--                                    </div>-->
        <!--                                     </a>-->
        <!--                                </div>-->
                                        
        <!--                                <div class="col-md-2 col-sm-3 col-xs-3 miconsec">-->
                                            
        <!--                                    <a href="RechargeServicesRechargeReport.php">-->
        <!--                                    <div class="serviceicon">-->
        <!--                                        <img width="40px" src="assets/icons/mobile.svg" />-->
        <!--                                    </div>-->
                                            
        <!--                                    </a>-->
                                            
                                            
        <!--                                    <a href="RechargeServicesRechargeReport.php">-->
        <!--                                    <div class="servicename">-->
        <!--                                        <h6>Recharges</h6>-->
        <!--                                    </div>-->
                                            
        <!--                                     </a>-->
        <!--                                </div>-->
                               
                                        
                                    
                                        
        <!--                                 <div class="col-md-2 col-sm-3 col-xs-3 miconsec">-->
        <!--                                    <a href="BBPSCategoryReport.php?type=Electricity&mode=ONLINE" class="nav-link"> -->
        <!--                                    <div class="serviceicon">-->
        <!--                                        <img width="40px" src="assets/icons/electricity.svg" />-->
        <!--                                    </div>-->
        <!--                                    </a>-->
                                            
        <!--                                    <a href="BBPSCategoryReport.php?type=Electricity&mode=ONLINE" class="nav-link">-->
        <!--                                    <div class="servicename">-->
        <!--                                        <h6>Electricity</h6>-->
        <!--                                    </div>-->
        <!--                                     </a>-->
        <!--                                </div>-->
                                        
        <!--                                <div class="col-md-2 col-sm-3 col-xs-3 miconsec">-->
        <!--                                    <a href="BBPSCategoryReport.php?type=Water&mode=ONLINE" class="nav-link">-->
        <!--                                    <div class="serviceicon">-->
        <!--                                        <img width="40px" src="assets/icons/water.svg" />-->
        <!--                                    </div>-->
        <!--                                    </a>-->
                                            
        <!--                                    <a href="BBPSCategoryReport.php?type=Water&mode=ONLINE" class="nav-link">-->
        <!--                                    <div class="servicename">-->
        <!--                                        <h6>Water</h6>-->
        <!--                                    </div>-->
        <!--                                     </a>-->
        <!--                                </div>-->
                                        
                                
        <!--                                <div class="col-md-2 col-sm-3 col-xs-3 miconsec">-->
                                            
        <!--                                     <a href="BBPSFasTagServiceReport.php" class="nav-link">-->
        <!--                                    <div class="serviceicon">-->
        <!--                                        <img width="40px" src="assets/icons/toll.svg" />-->
        <!--                                    </div>-->
        <!--                                    </a>-->
                                            
        <!--                                     <a href="BBPSFasTagServiceReport.php" class="nav-link">-->
        <!--                                    <div class="servicename">-->
        <!--                                        <h6>Fastag</h6>-->
        <!--                                    </div>-->
        <!--                                    </a>-->
        <!--                                </div>-->
            
                                        
                                        
                                        
        <!--                                 <div class="col-md-2 col-sm-3 col-xs-3 miconsec">-->
                                            
        <!--                                    <a href="Etax_report.php?type=Pancard" class="nav-link">-->
        <!--                                    <div class="serviceicon">-->
        <!--                                        <img width="40px" src="assets/icons/pancard.svg" />-->
        <!--                                    </div>-->
        <!--                                    </a>-->
                                            
        <!--                                   <a href="Etax_report.php?type=Pancard" class="nav-link">-->
        <!--                                    <div class="servicename">-->
        <!--                                        <h6>Pan Card</h6>-->
        <!--                                    </div>-->
        <!--                                    </a>-->
        <!--                                </div>-->
                                        
                                        
        <!--                                 <div class="col-md-2 col-sm-3 col-xs-3 miconsec">-->
                                            
        <!--                                    <a href="#!" data-toggle="modal" data-target="#exampleModalCenterC" class="nav-link">-->
        <!--                                    <div class="serviceicon">-->
        <!--                                        <img width="40px" src="assets/icons/pancard.svg" />-->
        <!--                                    </div>-->
        <!--                                    </a>-->
                                            
        <!--                                   <a href="#!" data-toggle="modal" data-target="#exampleModalCenterC" class="nav-link">-->
        <!--                                    <div class="servicename">-->
        <!--                                        <h6>Account Opening</h6>-->
        <!--                                    </div>-->
        <!--                                    </a>-->
        <!--                                </div>-->
                                        
        <!--                                 <div class="col-md-2 col-sm-3 col-xs-3 miconsec">-->
                                            
        <!--                                    <a href="LoanReport" class="nav-link">-->
        <!--                                    <div class="serviceicon">-->
        <!--                                        <img width="40px" src="assets/icons/taxes.svg" />-->
        <!--                                    </div>-->
        <!--                                    </a>-->
                                            
        <!--                                   <a href="LoanReport" class="nav-link">-->
        <!--                                    <div class="servicename">-->
        <!--                                        <h6>Loan</h6>-->
        <!--                                    </div>-->
        <!--                                    </a>-->
        <!--                                </div>-->
                                   
        <!--                                 <div class="col-md-2 col-sm-3 col-xs-3 miconsec">-->
                                            
        <!--                                    <a href="BBPSCategoryReport.php?type=Insurance&mode=ONLINE">-->
        <!--                                    <div class="serviceicon">-->
        <!--                                        <img width="40px" src="assets/icons/taxes.svg" />-->
        <!--                                    </div>-->
        <!--                                    </a>-->
                                            
        <!--                                    <a href="BBPSCategoryReport.php?type=Insurance&mode=ONLINE">-->
        <!--                                    <div class="servicename">-->
        <!--                                        <h6>Insurance</h6>-->
        <!--                                    </div>-->
        <!--                                     </a>-->
        <!--                                </div>-->
                                        
                                        
                                     
                                        
        <!--                            </div>-->
                 
        <!--          <?php }else{ ?>-->
               
        <!--           <div class="row icons_section">-->
                                        
                                        
        <!--                                <div class="col-md-2 col-sm-3 col-xs-3 miconsec">-->
        <!--                                    <a href="javascript:void(0)" class="duser">-->
        <!--                                    <div class="serviceicon">-->
        <!--                                        <img width="40px" src="assets/icons/money_transfer.svg" />-->
        <!--                                    </div>-->
        <!--                                    </a>-->
                                            
        <!--                                     <a href="javascript:void(0)" class="duser">-->
        <!--                                    <div class="servicename">-->
        <!--                                        <h6>Money Transfer</h6>-->
        <!--                                    </div>-->
        <!--                                     </a>-->
        <!--                                </div>-->
                                        
        <!--                                <div class="col-md-2 col-sm-3 col-xs-3 miconsec">-->
        <!--                                    <a href="javascript:void(0)" class="duser">-->
        <!--                                    <div class="serviceicon">-->
        <!--                                        <img width="40px" src="assets/icons/money_transfer.svg" />-->
        <!--                                    </div>-->
        <!--                                    </a>-->
                                            
        <!--                                     <a href="javascript:void(0)" class="duser">-->
        <!--                                    <div class="servicename">-->
        <!--                                        <h6>X-DMT</h6>-->
        <!--                                    </div>-->
        <!--                                     </a>-->
        <!--                                </div>-->
        <!--                                <div class="col-md-2 col-sm-3 col-xs-3 miconsec">-->
        <!--                                    <a href="#" class="duser">-->
        <!--                                    <div class="serviceicon">-->
        <!--                                        <img width="40px" src="assets/icons/money_transfer.svg" />-->
        <!--                                    </div>-->
        <!--                                    </a>-->
                                            
        <!--                                     <a href="#" class="duser">-->
        <!--                                    <div class="servicename">-->
        <!--                                        <h6>UPI Transfer</h6>-->
        <!--                                    </div>-->
        <!--                                     </a>-->
        <!--                                </div>-->
                                      
        <!--                                <div class="col-md-2 col-sm-3 col-xs-3 miconsec">-->
                                            
        <!--                                    <a href="javascript:void(0)" class="duser">-->
        <!--                                    <div class="serviceicon">-->
        <!--                                        <img width="40px" src="assets/icons/taxes.svg" />-->
        <!--                                    </div>-->
        <!--                                    </a>-->
                                            
        <!--                                    <a href="javascript:void(0)" class="duser">-->
        <!--                                    <div class="servicename">-->
        <!--                                        <h6>Payout</h6>-->
        <!--                                    </div>-->
        <!--                                     </a>-->
        <!--                                </div>-->
                                        
        <!--                                <div class="col-md-2 col-sm-3 col-xs-3 miconsec">-->
                                            
        <!--                                    <a href="javascript:void(0)" class="duser">-->
        <!--                                    <div class="serviceicon">-->
        <!--                                        <img width="40px" src="assets/icons/aeps.svg" />-->
        <!--                                    </div>-->
        <!--                                    </a>-->
                                            
        <!--                                    <a href="javascript:void(0)" class="duser">-->
        <!--                                    <div class="servicename">-->
        <!--                                        <h6>AEPS</h6>-->
        <!--                                    </div>-->
        <!--                                     </a>-->
        <!--                                </div>-->
                                        
        <!--                                <div class="col-md-2 col-sm-3 col-xs-3 miconsec">-->
                                            
        <!--                                    <a href="javascript:void(0)" class="duser">-->
        <!--                                    <div class="serviceicon">-->
        <!--                                        <img width="40px" src="assets/icons/mobile.svg" />-->
        <!--                                    </div>-->
                                            
        <!--                                    </a>-->
                                            
                                            
        <!--                                    <a href="javascript:void(0)" class="duser">-->
        <!--                                    <div class="servicename">-->
        <!--                                        <h6>Recharges</h6>-->
        <!--                                    </div>-->
                                            
        <!--                                     </a>-->
        <!--                                </div>-->
                               
                                        
                                    
                                        
        <!--                                 <div class="col-md-2 col-sm-3 col-xs-3 miconsec">-->
        <!--                                    <a href="javascript:void(0)"  class="nav-link duser"> -->
        <!--                                    <div class="serviceicon">-->
        <!--                                        <img width="40px" src="assets/icons/electricity.svg" />-->
        <!--                                    </div>-->
        <!--                                    </a>-->
                                            
        <!--                                    <a href="javascript:void(0)"  class="nav-link duser">-->
        <!--                                    <div class="servicename">-->
        <!--                                        <h6>Electricity</h6>-->
        <!--                                    </div>-->
        <!--                                     </a>-->
        <!--                                </div>-->
                                        
        <!--                                <div class="col-md-2 col-sm-3 col-xs-3 miconsec">-->
        <!--                                    <a href="javascript:void(0)"  class="nav-link duser">-->
        <!--                                    <div class="serviceicon">-->
        <!--                                        <img width="40px" src="assets/icons/water.svg" />-->
        <!--                                    </div>-->
        <!--                                    </a>-->
                                            
        <!--                                    <a href="javascript:void(0)"  class="nav-link duser">-->
        <!--                                    <div class="servicename">-->
        <!--                                        <h6>Water</h6>-->
        <!--                                    </div>-->
        <!--                                     </a>-->
        <!--                                </div>-->
                                        
                                
        <!--                                <div class="col-md-2 col-sm-3 col-xs-3 miconsec">-->
                                            
        <!--                                     <a href="javascript:void(0)"  class="nav-link duser">-->
        <!--                                    <div class="serviceicon">-->
        <!--                                        <img width="40px" src="assets/icons/toll.svg" />-->
        <!--                                    </div>-->
        <!--                                    </a>-->
                                            
        <!--                                     <a href="javascript:void(0)"  class="nav-link duser">-->
        <!--                                    <div class="servicename">-->
        <!--                                        <h6>Fastag</h6>-->
        <!--                                    </div>-->
        <!--                                    </a>-->
        <!--                                </div>-->
            
                                        
                                        
                                        
        <!--                                 <div class="col-md-2 col-sm-3 col-xs-3 miconsec">-->
                                            
        <!--                                    <a href="javascript:void(0)"  class="nav-link duser">-->
        <!--                                    <div class="serviceicon">-->
        <!--                                        <img width="40px" src="assets/icons/pancard.svg" />-->
        <!--                                    </div>-->
        <!--                                    </a>-->
                                            
        <!--                                   <a href="javascript:void(0)"  class="nav-link duser">-->
        <!--                                    <div class="servicename">-->
        <!--                                        <h6>Pan Card</h6>-->
        <!--                                    </div>-->
        <!--                                    </a>-->
        <!--                                </div>-->
                                        
                                        
        <!--                                 <div class="col-md-2 col-sm-3 col-xs-3 miconsec">-->
                                            
        <!--                                    <a href="javascript:void(0)"  class="nav-link duser">-->
        <!--                                    <div class="serviceicon">-->
        <!--                                        <img width="40px" src="assets/icons/pancard.svg" />-->
        <!--                                    </div>-->
        <!--                                    </a>-->
                                            
        <!--                                   <a href="javascript:void(0)"  class="nav-link duser">-->
        <!--                                    <div class="servicename">-->
        <!--                                        <h6>Account Opening</h6>-->
        <!--                                    </div>-->
        <!--                                    </a>-->
        <!--                                </div>-->
                                        
        <!--                                 <div class="col-md-2 col-sm-3 col-xs-3 miconsec">-->
                                            
        <!--                                    <a href="javascript:void(0)"  class="nav-link duser">-->
        <!--                                    <div class="serviceicon">-->
        <!--                                        <img width="40px" src="assets/icons/taxes.svg" />-->
        <!--                                    </div>-->
        <!--                                    </a>-->
                                            
        <!--                                   <a href="javascript:void(0)"  class="nav-link duser">-->
        <!--                                    <div class="servicename">-->
        <!--                                        <h6>Loan</h6>-->
        <!--                                    </div>-->
        <!--                                    </a>-->
        <!--                                </div>-->
                                   
        <!--                                 <div class="col-md-2 col-sm-3 col-xs-3 miconsec">-->
                                            
        <!--                                    <a href="javascript:void(0)" class="nav-link duser">-->
        <!--                                    <div class="serviceicon">-->
        <!--                                        <img width="40px" src="assets/icons/taxes.svg" />-->
        <!--                                    </div>-->
        <!--                                    </a>-->
                                            
        <!--                                    <a href="javascript:void(0)" class="nav-link duser">-->
        <!--                                    <div class="servicename">-->
        <!--                                        <h6>Insurance</h6>-->
        <!--                                    </div>-->
        <!--                                     </a>-->
        <!--                                </div>-->
                                        
                                
        <!--                            </div>-->
                                    
        <!--                            <?php } ?>-->
        <!--      </div>-->
              <!-- ./card-body -->
        <!--    </div>-->
            <!-- /.card -->
        <!--  </div>-->
          <!-- /.col -->
        <!--</div>-->
    
    <?php
    if($user_type == 47){    ?>
                <div class="row">
          <div class="col-md-12" style="margin-bottom: -6%;">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title">Overview</h5>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <div class="btn-group">
                    <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown">
                      <i class="fas fa-filter"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" role="menu">
                      <a href="#" class="dropdown-item">Today</a>
                      <a href="#" class="dropdown-item">Weekly</a>
                      <a href="#" class="dropdown-item">Monthly</a>
                      <a href="#" class="dropdown-item">Yearly</a>
                      <a class="dropdown-divider"></a>
                      <a href="#" class="dropdown-item">Customer Date</a>
                    </div>
                  </div>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  <!--<div class="col-md-8">-->
                  <!--  <p class="text-center">-->
                  <!--    <strong>Sales: 1 Jan, 2014 - 30 Jul, 2014</strong>-->
                  <!--  </p>-->

                  <!--  <div class="chart">-->
                      <!-- Sales Chart Canvas -->
                  <!--    <canvas id="salesChart" height="180" style="height: 180px;"></canvas>-->
                  <!--  </div>-->
                    <!-- /.chart-responsive -->
                  <!--</div>-->
                  <!-- /.col -->
                  <div class="col-md-12">
                    <p class="text-center">
                      <strong>Goal Completion</strong>
                    </p>
                    
                    
                    <!-- /.progress-group -->
                    <div class="progress-group">
                      <span class="progress-text">Success</span>
                      <span class="float-right"><b>480</b>/800</span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-success" style="width: 60%"></div>
                      </div>
                    </div>
                    
                    
                     <!-- /.progress-group -->
                    <div class="progress-group">
                      Pending
                      <span class="float-right"><b>250</b>/500</span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-warning" style="width: 50%"></div>
                      </div>
                    </div>
                    
                    <!-- /.progress-group -->

                    <div class="progress-group">
                      Failed
                      <span class="float-right"><b>310</b>/400</span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-danger" style="width: 75%"></div>
                      </div>
                    </div>
    
                    <!-- /.progress-group -->

                    <div class="progress-group">
                      Reject
                      <span class="float-right"><b>160</b>/200</span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-primary" style="width: 80%"></div>
                      </div>
                    </div>
                   
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
              <!-- ./card-body -->
              <!--<div class="card-footer">-->
              <!--  <div class="row">-->
              <!--    <div class="col-sm-3 col-6">-->
              <!--      <div class="description-block border-right">-->
              <!--        <span class="description-percentage text-success"><i class="fas fa-caret-up"></i> 17%</span>-->
              <!--        <h5 class="description-header">₹35,210.43</h5>-->
              <!--        <span class="description-text">TOTAL VOLUME</span>-->
              <!--      </div>-->
                    <!-- /.description-block -->
              <!--    </div>-->
                  <!-- /.col -->
              <!--    <div class="col-sm-3 col-6">-->
              <!--      <div class="description-block border-right">-->
              <!--        <span class="description-percentage text-warning"><i class="fas fa-caret-left"></i> 0%</span>-->
              <!--        <h5 class="description-header">₹10,390.90</h5>-->
              <!--        <span class="description-text">TRANSACTION</span>-->
              <!--      </div>-->
                    <!-- /.description-block -->
              <!--    </div>-->
                  <!-- /.col -->
              <!--    <div class="col-sm-2 col-6">-->
              <!--      <div class="description-block border-right">-->
              <!--        <span class="description-percentage text-success"><i class="fas fa-caret-up"></i> 20%</span>-->
              <!--        <h5 class="description-header">₹24,813.53</h5>-->
              <!--        <span class="description-text">TOTAL COMMISSION</span>-->
              <!--      </div>-->
                    <!-- /.description-block -->
              <!--    </div>-->
              <!--    <div class="col-sm-2 col-6">-->
              <!--      <div class="description-block border-right">-->
              <!--        <span class="description-percentage text-success"><i class="fas fa-caret-up"></i> 20%</span>-->
              <!--        <h5 class="description-header">₹24,813.53</h5>-->
              <!--        <span class="description-text">GIVEN COMMISSION</span>-->
              <!--      </div>-->
                    <!-- /.description-block -->
              <!--    </div>-->
              <!--    <div class="col-sm-2 col-6">-->
              <!--      <div class="description-block">-->
              <!--        <span class="description-percentage text-success"><i class="fas fa-caret-up"></i> 20%</span>-->
              <!--        <h5 class="description-header">₹24,813.53</h5>-->
              <!--        <span class="description-text">TOTAL PROFIT</span>-->
              <!--      </div>-->
                    <!-- /.description-block -->
              <!--    </div>-->
                  <!-- /.col -->
              <!--  </div>-->
                <!-- /.row -->
              <!--</div>-->
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>

   <section class="content">
      <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
         <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <!--<span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>-->

              <div class="info-box-content">
                <span class="info-box-text">Recharge <img src="assets/prepaid.png" width="20"alt="no images" style="float:right"></span>
                <span class="info-box-number"><?php
                   $tdate = date("Y-m-d");
                   $todayrc = $con->query("SELECT FORMAT(IFNULL(SUM(AMOUNT),0),2)tamt FROM `recharge_transaction` WHERE `OWNER_ID` = '$my_id' AND date(FILTER_DATE) = '$tdate'")->fetch_assoc();
                   ?>Today <b style="float:right">₹<?php echo $todayrc['tamt']; ?></b></span>
                <span class="info-box-number">Monthly <?php
                   
                   $mdate = date("Y-m-d",strtotime("-1 month"));
                //   echo $mdate; 
                //   echo $tdate;
                   $mdayrc= $con->query("SELECT FORMAT(IFNULL(SUM(AMOUNT),0),2)tamtmo FROM `recharge_transaction` WHERE `OWNER_ID` = '$my_id' AND date(FILTER_DATE) between '$mdate' AND '$tdate'")->fetch_assoc();
                   ?><b style="float:right">₹<?php echo $mdayrc['tamtmo'];?></b></span>
                <span class="info-box-number">Yearly <?php
                   
                   $ydate = date("Y-m-d",strtotime("-1 year"));
                //   echo $ydate;
                $ydayrc= $con->query("SELECT FORMAT(IFNULL(SUM(AMOUNT),0),2)tamtyea FROM `recharge_transaction` WHERE `OWNER_ID` = '$my_id' AND date(FILTER_DATE) between '$ydate' AND '$tdate'")->fetch_assoc();
                   ?><b style="float:right">₹<?php echo $ydayrc['tamtyea'];?></b></span>
              </div>
             <!--<i class="fas fa-users"></i>-->
             <!-- <i class="fas fa-users">-->
               <!--/.info-box-content -->
            </div>
             <!--/.info-box -->
          </div>
         <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <!--<span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>-->

              <div class="info-box-content">
                <span class="info-box-text">Cash Withdrawl <img src="assets/aeps1.png" width="20"alt="no images" style="float:right"></span>
                <span class="info-box-number"><?php
                   $tdate = date("Y-m-d");
                $todayaeps = $con->query("SELECT FORMAT(IFNULL(SUM(AMOUNT),0),2)tamt FROM aeps_transactions WHERE `OWNER_ID` = '$my_id' AND TRANS_TYPE='CW' AND STATUS='Success,AEPS Transaction Success' AND date(FILTER_DATE) = '$tdate'")->fetch_assoc();                   
                ?>Today <b style="float:right">₹<?php echo $todayaeps['tamt']; ?></b></span>
                <span class="info-box-number">Monthly <?php
                   
                   $mdate = date("Y-m-d",strtotime("-1 month"));
                //   echo $mdate; 
                //   echo $tdate;
                   $mdayrc= $con->query("SELECT FORMAT(IFNULL(SUM(AMOUNT),0),2)tamtmo FROM `aeps_transactions` WHERE `OWNER_ID` = '$my_id' AND TRANS_TYPE='CW' AND STATUS='Success,AEPS Transaction Success' AND date(FILTER_DATE) between '$mdate' AND '$tdate'")->fetch_assoc();
                   ?><b style="float:right">₹<?php echo $mdayrc['tamtmo'];?></b></span>
                <span class="info-box-number">Yearly <?php
                   
                   $ydate = date("Y-m-d",strtotime("-1 year"));
                //   echo $ydate;
                $ydayrc= $con->query("SELECT FORMAT(IFNULL(SUM(AMOUNT),0),2)tamtyea FROM `aeps_transactions` WHERE `OWNER_ID` = '$my_id' AND TRANS_TYPE='CW' AND STATUS='Success,AEPS Transaction Success' AND date(FILTER_DATE) between '$ydate' AND '$tdate'")->fetch_assoc();                   
                ?><b style="float:right">₹<?php echo $ydayrc['tamtyea'];?></b></span>
              </div>
             <!--<i class="fas fa-users"></i>-->
             <!-- <i class="fas fa-users">-->
               <!--/.info-box-content -->
            </div>
             <!--/.info-box -->
          </div>
         <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <!--<span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>-->

              <div class="info-box-content">
                <span class="info-box-text">Aadhaar Pay <img src="assets/aeps1.png" width="20"alt="no images" style="float:right"></span>
                <span class="info-box-number"><?php
                   $tdate = date("Y-m-d");
                $todayaeps = $con->query("SELECT FORMAT(IFNULL(SUM(AMOUNT),0),2)tamt FROM aeps_transactions WHERE `OWNER_ID` = '$my_id' AND TRANS_TYPE='M' AND STATUS='Success,AEPS Transaction Success' AND date(FILTER_DATE) = '$tdate'")->fetch_assoc();
                   ?>Today <b style="float:right">₹<?php echo $todayaeps['tamt']; ?></b></span>
                <span class="info-box-number">Monthly <?php
                   
                   $mdate = date("Y-m-d",strtotime("-1 month"));
                //   echo $mdate; 
                //   echo $tdate;
                   $mdayrc= $con->query("SELECT FORMAT(IFNULL(SUM(AMOUNT),0),2)tamtmo FROM `aeps_transactions` WHERE `OWNER_ID` = '$my_id' AND TRANS_TYPE='M' AND STATUS='Success,AEPS Transaction Success' AND date(FILTER_DATE) between '$mdate' AND '$tdate'")->fetch_assoc();
                   ?><b style="float:right">₹<?php echo $mdayrc['tamtmo'];?></b></span>
                <span class="info-box-number">Yearly<?php
                   
                   $ydate = date("Y-m-d",strtotime("-1 year"));
                //   echo $ydate;
                $ydayrc= $con->query("SELECT FORMAT(IFNULL(SUM(AMOUNT),0),2)tamtyea FROM `aeps_transactions` WHERE `OWNER_ID` = '$my_id' AND TRANS_TYPE='M' AND STATUS='Success,AEPS Transaction Success' AND date(FILTER_DATE) between '$ydate' AND '$tdate'")->fetch_assoc();
                   ?><b style="float:right">₹<?php echo $ydayrc['tamtyea'];?></b></span>
              </div>
             <!--<i class="fas fa-users"></i>-->
             <!-- <i class="fas fa-users">-->
               <!--/.info-box-content -->
            </div>
             <!--/.info-box -->
          </div>
         <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <!--<span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>-->

              <div class="info-box-content">
                <span class="info-box-text">BBPS </span>
                <span class="info-box-number"><?php
                   $tdate = date("Y-m-d");
                 $total_aeps = $con->query("SELECT  FORMAT(IFNULL(SUM(AMOUNT),0),2)pay FROM `pay_bill_api` WHERE date(FILTER_DATE) = '$tdate'")->fetch_assoc();
                   ?>Today <b style="float:right">₹<?php echo $total_aeps['pay']; ?></b></span>
                <span class="info-box-number">Monthly <?php
                   
                   $mdate = date("Y-m-d",strtotime("-1 month"));
                //   echo $mdate; 
                //   echo $tdate;
                   $mdayrc= $con->query("SELECT FORMAT(IFNULL(SUM(AMOUNT),0),2)tamtmo FROM `pay_bill_api` WHERE date(FILTER_DATE) between '$mdate' AND '$tdate'")->fetch_assoc();
                   ?><b style="float:right">₹<?php echo $mdayrc['tamtmo'];?></b></span>
                <span class="info-box-number">Yearly<?php
                   
                   $ydate = date("Y-m-d",strtotime("-1 year"));
                //   echo $ydate;
                $ydayrc= $con->query("SELECT FORMAT(IFNULL(SUM(AMOUNT),0),2)tamtyea FROM `pay_bill_api` WHERE date(FILTER_DATE) between '$ydate' AND '$tdate'")->fetch_assoc();
                   ?><b style="float:right">₹<?php echo $ydayrc['tamtyea'];?></b></span>
              </div>
             <!--<i class="fas fa-users"></i>-->
             <!-- <i class="fas fa-users">-->
               <!--/.info-box-content -->
            </div>
             <!--/.info-box -->
          </div>
         <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <!--<span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>-->

              <div class="info-box-content">
                <span class="info-box-text">DMT <img src="assets/money_transfer.svg" width="20"alt="no images" style="float:right"></span>
                <span class="info-box-number"><?php
                   $tdate = date("Y-m-d");
                 $todaydmt = $con->query("SELECT FORMAT(IFNULL(SUM(AMOUNT),0),2)tamt FROM dmt_transactions WHERE `OWNER_ID` = '$my_id' AND date(TIMESTAMP) = '$tdate'")->fetch_assoc();
                   ?>Today <b style="float:right">₹<?php echo $todaydmt['tamt']; ?></b></span>
                <span class="info-box-number">Monthly <?php
                   
                   $mdate = date("Y-m-d",strtotime("-1 month"));
                //   echo $mdate; 
                //   echo $tdate;
                   $mdayrc= $con->query("SELECT FORMAT(IFNULL(SUM(AMOUNT),0),2)tamtmo FROM `dmt_transactions` WHERE `OWNER_ID` = '$my_id' AND date(TIMESTAMP) between '$mdate' AND '$tdate'")->fetch_assoc();
                   ?><b style="float:right">₹<?php echo $mdayrc['tamtmo'];?></b></span>
                <span class="info-box-number">Yearly<?php
                   
                   $ydate = date("Y-m-d",strtotime("-1 year"));
                //   echo $ydate;
                $ydayrc= $con->query("SELECT FORMAT(IFNULL(SUM(AMOUNT),0),2)tamtyea FROM `dmt_transactions` WHERE `OWNER_ID` = '$my_id' AND date(TIMESTAMP) between '$ydate' AND '$tdate'")->fetch_assoc();
                   ?><b style="float:right">₹<?php echo $ydayrc['tamtyea'];?></b></span>
              </div>
             <!--<i class="fas fa-users"></i>-->
             <!-- <i class="fas fa-users">-->
               <!--/.info-box-content -->
            </div>
             <!--/.info-box -->
          </div>
         <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <!--<span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>-->

              <div class="info-box-content">
                <span class="info-box-text">Payout <img src="assets/money_transfer.svg" width="20"alt="no images" style="float:right"></span>
                <span class="info-box-number"><?php
                   $tdate = date("Y-m-d");
                   $todaypayout = $con->query("SELECT FORMAT(IFNULL(SUM(AMOUNT),0),2)tamt FROM payout_transaction WHERE STATUS ='ACCEPTED' AND FILTER_DATE = '$tdate'")->fetch_assoc();
                   ?>Today <b style="float:right">
                   ₹<?php
                    if($todaypayout['tamt'] != ''){
                    echo $todaypayout['tamt']; 
                    }else{
                       echo '0'; 
                    }?></b></span>
                   
                <span class="info-box-number">Monthly <?php
                   
                   $mdate = date("Y-m-d",strtotime("-1 month"));
                //   echo $mdate; 
                //   echo $tdate;
                   $mdayrc= $con->query("SELECT FORMAT(IFNULL(SUM(AMOUNT),0),2)tamtmo FROM `payout_transaction` WHERE STATUS ='ACCEPTED' AND date(FILTER_DATE) between '$mdate' AND '$tdate'")->fetch_assoc();
                   ?><b style="float:right">₹<?php echo $mdayrc['tamtmo'];?></b></span>
                <span class="info-box-number">Yearly<?php
                   
                   $ydate = date("Y-m-d",strtotime("-1 year"));
                //   echo $ydate;
                $ydayrc= $con->query("SELECT FORMAT(IFNULL(SUM(AMOUNT),0),2)tamtyea FROM `payout_transaction` WHERE STATUS ='ACCEPTED' AND date(FILTER_DATE) between '$ydate' AND '$tdate'")->fetch_assoc();
                   ?><b style="float:right">₹<?php echo $ydayrc['tamtyea'];?></b></span>
              </div>
             <!--<i class="fas fa-users"></i>-->
             <!-- <i class="fas fa-users">-->
               <!--/.info-box-content -->
            </div>
             <!--/.info-box -->
          </div>
         <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <!--<span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>-->

              <div class="info-box-content">
                <span class="info-box-text">PanCard </span>
                <span class="info-box-number"><?php
                   $tdate = date("Y-m-d");
                 $total_aeps = $con->query("SELECT  FORMAT(IFNULL(SUM(AMOUNT),0),2)pan FROM `pan_transaction` WHERE date(DATE) = '$tdate'")->fetch_assoc();
                   ?>Today <b style="float:right">₹<?php echo $total_aeps['pan']; ?></b></span>
                <span class="info-box-number">Monthly <?php
                   
                   $mdate = date("Y-m-d",strtotime("-1 month"));
                //   echo $mdate; 
                //   echo $tdate;
                   $mdayrc= $con->query("SELECT FORMAT(IFNULL(SUM(AMOUNT),0),2)tamtmo FROM `pan_transaction` WHERE date(DATE) between '$mdate' AND '$tdate'")->fetch_assoc();
                   ?><b style="float:right">₹<?php echo $mdayrc['tamtmo'];?></b></span>
                <span class="info-box-number">Yearly<?php
                   
                   $ydate = date("Y-m-d",strtotime("-1 year"));
                //   echo $ydate;
                $ydayrc= $con->query("SELECT FORMAT(IFNULL(SUM(AMOUNT),0),2)tamtyea FROM `pan_transaction` WHERE date(DATE) between '$ydate' AND '$tdate'")->fetch_assoc();
                   ?><b style="float:right">₹<?php echo $ydayrc['tamtyea'];?></b></span>
              </div>
             <!--<i class="fas fa-users"></i>-->
             <!-- <i class="fas fa-users">-->
               <!--/.info-box-content -->
            </div>
             <!--/.info-box -->
          </div>
         <!--<div class="col-12 col-sm-6 col-md-3">-->
         <!--   <div class="info-box mb-3">-->
              <!--<span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>-->

              <!--<div class="info-box-content">-->
              <!--  <span class="info-box-text">Subscription </span>-->
                <!--<span class="info-box-number">-->
                <?php
                //   $tdate = date("Y-m-d");
                //   $todayrc = $con->query("SELECT FORMAT(IFNULL(SUM(AMOUNT),0),2)tamt FROM `recharge_transaction` WHERE date(FILTER_DATE) = '$tdate'")->fetch_assoc();
                   ?>
                   <!--Today <b style="float:right">₹-->
                   <?php 
                //   echo $todayrc['tamt']; 
                   ?>
                   <!--</b></span>-->
                <!--<span class="info-box-number">Monthly -->
                <?php
                   
                //   $mdate = date("Y-m-d",strtotime("-1 month"));
                //   echo $mdate; 
                //   echo $tdate;
                //   $mdayrc= $con->query("SELECT FORMAT(IFNULL(SUM(AMOUNT),0),2)tamtmo FROM `recharge_transaction` WHERE date(FILTER_DATE) between '$mdate' AND '$tdate'")->fetch_assoc();
                   ?>
                   <!--<b style="float:right">₹-->
                   <?php 
                //   echo $mdayrc['tamtmo'];
                   ?>
                   <!--</b></span>-->
                <!--<span class="info-box-number">Total -->
                <?php
                   
                //   $ydate = date("Y-m-d",strtotime("-1 year"));
                //   echo $ydate;
                // $ydayrcc= $con->query("SELECT FORMAT(IFNULL(SUM(AMOUNT),0),2)tamtyea FROM `recharge_transaction` WHERE date(FILTER_DATE) between '$ydate' AND '$tdate'")->fetch_assoc();
                   ?>
                   <!--<b style="float:right">₹-->
                   <?php 
                //   echo $ydayrcc['tamtyea'];
                   ?>
                   <!--0</b></span>-->
              <!--</div>-->
             <!--<i class="fas fa-users"></i>-->
             <!-- <i class="fas fa-users">-->
               <!--/.info-box-content -->
            <!--</div>-->
             <!--/.info-box -->
          <!--</div>-->
         <!--<div class="col-12 col-sm-6 col-md-3">-->
         <!--   <div class="info-box mb-3">-->
              <!--<span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>-->

              <!--<div class="info-box-content">-->
              <!--  <span class="info-box-text">Today Join User </span>-->
              <!--  <span class="info-box-number">-->
                <?php
                //   $tdate = date("Y-m-d");
                //   $todayrc = $con->query("SELECT FORMAT(IFNULL(SUM(AMOUNT),0),2)tamt FROM `recharge_transaction` WHERE date(FILTER_DATE) = '$tdate'")->fetch_assoc();
                   ?>
                   <!--Today <b style="float:right">₹-->
                   <?php 
                //   echo $todayrc['tamt']; 
                   ?>
                   <!--</b></span>-->
             
               
              <!--</div>-->
             <!--<i class="fas fa-users"></i>-->
             <!-- <i class="fas fa-users">-->
               <!--/.info-box-content -->
            <!--</div>-->
             <!--/.info-box -->
          <!--</div>-->
         <!--<div class="col-12 col-sm-6 col-md-3">-->
         <!--   <div class="info-box mb-3">-->
              <!--<span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>-->

              <!--<div class="info-box-content">-->
              <!--  <span class="info-box-text">All User </span>-->
              <!--   <span class="info-box-number">-->
                 <?php
                //   $tdate = date("Y-m-d");
                //   $todayrc = $con->query("SELECT COUNT(ID)id,FORMAT(IFNULL(SUM(MAIN_BAL),0),2)mbal,FORMAT(IFNULL(SUM(AEPS_BAL),0),2)abal FROM `user`")->fetch_assoc();
                   ?>
                   <?php 
                //   echo $todayrc['id']; 
                   ?>
              <!--     </span>-->
              <!--</div>-->
             <!--<i class="fas fa-users"></i>-->
             <!-- <i class="fas fa-users">-->
               <!--/.info-box-content -->
            <!--</div>-->
             <!--/.info-box -->
          <!--</div>-->
         <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <!--<span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>-->

              <div class="info-box-content">
                <span class="info-box-text">All Retailer</span>
                <span class="info-box-number">
                            <?php 
                                $todayrc = $con->query("SELECT COUNT(ID)id,FORMAT(IFNULL(SUM(MAIN_BAL),0),2)mbal,FORMAT(IFNULL(SUM(AEPS_BAL),0),2)abal FROM `user` WHERE `OWNER_ID` = '$my_id' AND USER_TYPE='46'")->fetch_assoc();
                                echo $todayrc['id'];
                                ?>
                
              </div>
             <!--<i class="fas fa-users"></i>-->
             <!-- <i class="fas fa-users">-->
               <!--/.info-box-content -->
            </div>
             <!--/.info-box -->
          </div>
         
         <!--<div class="col-12 col-sm-6 col-md-3">-->
         <!--   <div class="info-box mb-3">-->
              <!--<span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>-->

         <!--     <div class="info-box-content">-->
         <!--                         <span class="info-box-text">Master Distributor </span>-->

                <!--<span class="info-box-number">-->
         <?php
                //   $tdate = date("Y-m-d");
                //   $todayrc = $con->query("SELECT COUNT(ID)id,FORMAT(IFNULL(SUM(MAIN_BAL),0),2)mbal,FORMAT(IFNULL(SUM(AEPS_BAL),0),2)abal FROM `user` WHERE USER_TYPE='48'")->fetch_assoc();
          ?>
         <?php
        //  echo $todayrc['id']; 
         ?></span>
         <!--     </div>-->
             <!--<i class="fas fa-users"></i>-->
             <!-- <i class="fas fa-users">-->
               <!--/.info-box-content -->
         <!--   </div>-->
             <!--/.info-box -->
         <!-- </div>-->
       
         <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <!--<span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>-->

              <div class="info-box-content">
                <span class="info-box-text">Total Wallet Amount </span>
                 <span class="info-box-number"><?php
                   $tdate = date("Y-m-d");
                   $todayrc = $con->query("SELECT COUNT(ID)id,FORMAT(IFNULL(SUM(MAIN_BAL),0),2)mbal,FORMAT(IFNULL(SUM(AEPS_BAL),0),2)abal FROM `user` WHERE `OWNER_ID` = '$my_id'")->fetch_assoc();
                   
                   $aepsBalAll = $con->query("SELECT SUM(AEPS_BAL) FROM user")->fetch_assoc();
                   $mainBalAll = $con->query("SELECT SUM(MAIN_BAL) FROM user")->fetch_assoc();
                   $total    = $aepsBalAll['SUM(AEPS_BAL)'] +$mainBalAll['SUM(MAIN_BAL)'];
                   ?>₹<?php  echo $total;
                               ?></span>
              </div>
             <!--<i class="fas fa-users"></i>-->
             <!-- <i class="fas fa-users">-->
               <!--/.info-box-content -->
            </div>
             <!--/.info-box -->
          </div>
         <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <!--<span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>-->

              <div class="info-box-content">
                <span class="info-box-text">Retailer Wallet Amount</span>
                <span class="info-box-number">
                      <?php
                    $tdate = date("Y-m-d");
                    $todayrc = $con->query("SELECT COUNT(ID)id,FORMAT(IFNULL(SUM(MAIN_BAL),0),2)mbal,FORMAT(IFNULL(SUM(AEPS_BAL),0),2)abal FROM `user` WHERE `OWNER_ID` = '$my_id' AND USER_TYPE = '46'")->fetch_assoc();
                ?>
                         <h6> Main Wallet : ₹ <?php echo $todayrc['mbal']; ?></h6>
                         <h6> Aeps Wallet : ₹ <?php echo $todayrc['abal']; ?></h6>
              </div>
             <!--<i class="fas fa-users"></i>-->
             <!-- <i class="fas fa-users">-->
               <!--/.info-box-content -->
            </div>
             <!--/.info-box -->
          </div>
         <!--<div class="col-12 col-sm-6 col-md-3">-->
         <!--   <div class="info-box mb-3">-->
              <!--<span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>-->

              <!--<div class="info-box-content">-->
              <!--                    <span class="info-box-text">Distributor Wallet Amount </span>-->

                <!--<span class="info-box-number">  -->
                <?php
                //     $tdate = date("Y-m-d");
                //   $todayrc = $con->query("SELECT COUNT(ID)id,FORMAT(IFNULL(SUM(MAIN_BAL),0),2)mbal,FORMAT(IFNULL(SUM(AEPS_BAL),0),2)abal FROM `user` WHERE USER_TYPE = '47'")->fetch_assoc();
                ?>       
              <!--  <h6> Main Wallet : ₹ <?php echo $todayrc['mbal']; ?></h6>-->
              <!--           <h6> Aeps Wallet : ₹ <?php echo $todayrc['abal']; ?></h6>-->
              <!--</div>-->
             <!--<i class="fas fa-users"></i>-->
             <!-- <i class="fas fa-users">-->
               <!--/.info-box-content -->
            <!--</div>-->
             <!--/.info-box -->
          <!--</div>-->
         <!--<div class="col-12 col-sm-6 col-md-3">-->
            <!--<div class="info-box mb-3">-->
              <!--<span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>-->

              <!--<div class="info-box-content">-->
              <!--  <span class="info-box-text">Master Wallet Amount </span>-->
                <!--<span class="info-box-number">-->
               <?php
            //            $tdate = date("Y-m-d");
            //             $todayrc = $con->query("SELECT COUNT(ID)id,FORMAT(IFNULL(SUM(MAIN_BAL),0),2)mbal,FORMAT(IFNULL(SUM(AEPS_BAL),0),2)abal FROM `user` WHERE USER_TYPE = '48'")->fetch_assoc();
            ?>
              <!--<h6> Main Wallet : ₹ <?php echo $todayrc['mbal']; ?></h6>-->
              <!--           <h6> Aeps Wallet : ₹ <?php echo $todayrc['abal']; ?></h6>-->
              <!--</div>-->
             <!--<i class="fas fa-users"></i>-->
             <!-- <i class="fas fa-users">-->
               <!--/.info-box-content -->
            <!--</div>-->
             <!--/.info-box -->
          <!--</div>-->
          
         
          
          <!-- /.col -->
          
        </div>
        </div>
        <!-- /.row -->
        </section>
        <!-- /.row -->
<?php }else if($user_type == 48){ ?>
<div class="row">
          <div class="col-md-12" style="margin-bottom: -6%;">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title">Overview</h5>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <div class="btn-group">
                    <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown">
                      <i class="fas fa-filter"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" role="menu">
                      <a href="#" class="dropdown-item">Today</a>
                      <a href="#" class="dropdown-item">Weekly</a>
                      <a href="#" class="dropdown-item">Monthly</a>
                      <a href="#" class="dropdown-item">Yearly</a>
                      <a class="dropdown-divider"></a>
                      <a href="#" class="dropdown-item">Customer Date</a>
                    </div>
                  </div>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  <!--<div class="col-md-8">-->
                  <!--  <p class="text-center">-->
                  <!--    <strong>Sales: 1 Jan, 2014 - 30 Jul, 2014</strong>-->
                  <!--  </p>-->

                  <!--  <div class="chart">-->
                      <!-- Sales Chart Canvas -->
                  <!--    <canvas id="salesChart" height="180" style="height: 180px;"></canvas>-->
                  <!--  </div>-->
                    <!-- /.chart-responsive -->
                  <!--</div>-->
                  <!-- /.col -->
                  <div class="col-md-12">
                    <p class="text-center">
                      <strong>Goal Completion</strong>
                    </p>
                    
                    
                    <!-- /.progress-group -->
                    <div class="progress-group">
                      <span class="progress-text">Success</span>
                      <span class="float-right"><b>480</b>/800</span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-success" style="width: 60%"></div>
                      </div>
                    </div>
                    
                    
                     <!-- /.progress-group -->
                    <div class="progress-group">
                      Pending
                      <span class="float-right"><b>250</b>/500</span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-warning" style="width: 50%"></div>
                      </div>
                    </div>
                    
                    <!-- /.progress-group -->

                    <div class="progress-group">
                      Failed
                      <span class="float-right"><b>310</b>/400</span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-danger" style="width: 75%"></div>
                      </div>
                    </div>
    
                    <!-- /.progress-group -->

                    <div class="progress-group">
                      Reject
                      <span class="float-right"><b>160</b>/200</span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-primary" style="width: 80%"></div>
                      </div>
                    </div>
                   
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
              <!-- ./card-body -->
              <!--<div class="card-footer">-->
              <!--  <div class="row">-->
              <!--    <div class="col-sm-3 col-6">-->
              <!--      <div class="description-block border-right">-->
              <!--        <span class="description-percentage text-success"><i class="fas fa-caret-up"></i> 17%</span>-->
              <!--        <h5 class="description-header">₹35,210.43</h5>-->
              <!--        <span class="description-text">TOTAL VOLUME</span>-->
              <!--      </div>-->
                    <!-- /.description-block -->
              <!--    </div>-->
                  <!-- /.col -->
              <!--    <div class="col-sm-3 col-6">-->
              <!--      <div class="description-block border-right">-->
              <!--        <span class="description-percentage text-warning"><i class="fas fa-caret-left"></i> 0%</span>-->
              <!--        <h5 class="description-header">₹10,390.90</h5>-->
              <!--        <span class="description-text">TRANSACTION</span>-->
              <!--      </div>-->
                    <!-- /.description-block -->
              <!--    </div>-->
                  <!-- /.col -->
              <!--    <div class="col-sm-2 col-6">-->
              <!--      <div class="description-block border-right">-->
              <!--        <span class="description-percentage text-success"><i class="fas fa-caret-up"></i> 20%</span>-->
              <!--        <h5 class="description-header">₹24,813.53</h5>-->
              <!--        <span class="description-text">TOTAL COMMISSION</span>-->
              <!--      </div>-->
                    <!-- /.description-block -->
              <!--    </div>-->
              <!--    <div class="col-sm-2 col-6">-->
              <!--      <div class="description-block border-right">-->
              <!--        <span class="description-percentage text-success"><i class="fas fa-caret-up"></i> 20%</span>-->
              <!--        <h5 class="description-header">₹24,813.53</h5>-->
              <!--        <span class="description-text">GIVEN COMMISSION</span>-->
              <!--      </div>-->
                    <!-- /.description-block -->
              <!--    </div>-->
              <!--    <div class="col-sm-2 col-6">-->
              <!--      <div class="description-block">-->
              <!--        <span class="description-percentage text-success"><i class="fas fa-caret-up"></i> 20%</span>-->
              <!--        <h5 class="description-header">₹24,813.53</h5>-->
              <!--        <span class="description-text">TOTAL PROFIT</span>-->
              <!--      </div>-->
                    <!-- /.description-block -->
              <!--    </div>-->
                  <!-- /.col -->
              <!--  </div>-->
                <!-- /.row -->
              <!--</div>-->
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>

   <section class="content">
      <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
         <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <!--<span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>-->

              <div class="info-box-content">
                <span class="info-box-text">Recharge <img src="assets/prepaid.png" width="20"alt="no images" style="float:right"></span>
                <span class="info-box-number"><?php
                   $tdate = date("Y-m-d");
                   $todayrc = $con->query("SELECT FORMAT(IFNULL(SUM(AMOUNT),0),2)tamt FROM `recharge_transaction` WHERE `OWNER_ID` = '$my_id' AND date(FILTER_DATE) = '$tdate'")->fetch_assoc();
                   ?>Today <b style="float:right">₹<?php echo $todayrc['tamt']; ?></b></span>
                <span class="info-box-number">Monthly <?php
                   
                   $mdate = date("Y-m-d",strtotime("-1 month"));
                //   echo $mdate; 
                //   echo $tdate;
                   $mdayrc= $con->query("SELECT FORMAT(IFNULL(SUM(AMOUNT),0),2)tamtmo FROM `recharge_transaction` WHERE `OWNER_ID` = '$my_id' AND date(FILTER_DATE) between '$mdate' AND '$tdate'")->fetch_assoc();
                   ?><b style="float:right">₹<?php echo $mdayrc['tamtmo'];?></b></span>
                <span class="info-box-number">Yearly <?php
                   
                   $ydate = date("Y-m-d",strtotime("-1 year"));
                //   echo $ydate;
                $ydayrc= $con->query("SELECT FORMAT(IFNULL(SUM(AMOUNT),0),2)tamtyea FROM `recharge_transaction` WHERE `OWNER_ID` = '$my_id' AND date(FILTER_DATE) between '$ydate' AND '$tdate'")->fetch_assoc();
                   ?><b style="float:right">₹<?php echo $ydayrc['tamtyea'];?></b></span>
              </div>
             <!--<i class="fas fa-users"></i>-->
             <!-- <i class="fas fa-users">-->
               <!--/.info-box-content -->
            </div>
             <!--/.info-box -->
          </div>
         <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <!--<span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>-->

              <div class="info-box-content">
                <span class="info-box-text">Cash Withdrawl <img src="assets/aeps1.png" width="20"alt="no images" style="float:right"></span>
                <span class="info-box-number"><?php
                   $tdate = date("Y-m-d");
                $todayaeps = $con->query("SELECT FORMAT(IFNULL(SUM(AMOUNT),0),2)tamt FROM aeps_transactions WHERE `OWNER_ID` = '$my_id' AND TRANS_TYPE='CW' AND STATUS='Success,AEPS Transaction Success' AND date(FILTER_DATE) = '$tdate'")->fetch_assoc();                   
                ?>Today <b style="float:right">₹<?php echo $todayaeps['tamt']; ?></b></span>
                <span class="info-box-number">Monthly <?php
                   
                   $mdate = date("Y-m-d",strtotime("-1 month"));
                //   echo $mdate; 
                //   echo $tdate;
                   $mdayrc= $con->query("SELECT FORMAT(IFNULL(SUM(AMOUNT),0),2)tamtmo FROM `aeps_transactions` WHERE `OWNER_ID` = '$my_id' AND TRANS_TYPE='CW' AND STATUS='Success,AEPS Transaction Success' AND date(FILTER_DATE) between '$mdate' AND '$tdate'")->fetch_assoc();
                   ?><b style="float:right">₹<?php echo $mdayrc['tamtmo'];?></b></span>
                <span class="info-box-number">Yearly <?php
                   
                   $ydate = date("Y-m-d",strtotime("-1 year"));
                //   echo $ydate;
                $ydayrc= $con->query("SELECT FORMAT(IFNULL(SUM(AMOUNT),0),2)tamtyea FROM `aeps_transactions` WHERE `OWNER_ID` = '$my_id' AND TRANS_TYPE='CW' AND STATUS='Success,AEPS Transaction Success' AND date(FILTER_DATE) between '$ydate' AND '$tdate'")->fetch_assoc();                   
                ?><b style="float:right">₹<?php echo $ydayrc['tamtyea'];?></b></span>
              </div>
             <!--<i class="fas fa-users"></i>-->
             <!-- <i class="fas fa-users">-->
               <!--/.info-box-content -->
            </div>
             <!--/.info-box -->
          </div>
         <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <!--<span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>-->

              <div class="info-box-content">
                <span class="info-box-text">Aadhaar Pay <img src="assets/aeps1.png" width="20"alt="no images" style="float:right"></span>
                <span class="info-box-number"><?php
                   $tdate = date("Y-m-d");
                $todayaeps = $con->query("SELECT FORMAT(IFNULL(SUM(AMOUNT),0),2)tamt FROM aeps_transactions WHERE `OWNER_ID` = '$my_id' AND TRANS_TYPE='M' AND STATUS='Success,AEPS Transaction Success' AND date(FILTER_DATE) = '$tdate'")->fetch_assoc();
                   ?>Today <b style="float:right">₹<?php echo $todayaeps['tamt']; ?></b></span>
                <span class="info-box-number">Monthly <?php
                   
                   $mdate = date("Y-m-d",strtotime("-1 month"));
                //   echo $mdate; 
                //   echo $tdate;
                   $mdayrc= $con->query("SELECT FORMAT(IFNULL(SUM(AMOUNT),0),2)tamtmo FROM `aeps_transactions` WHERE `OWNER_ID` = '$my_id' AND TRANS_TYPE='M' AND STATUS='Success,AEPS Transaction Success' AND date(FILTER_DATE) between '$mdate' AND '$tdate'")->fetch_assoc();
                   ?><b style="float:right">₹<?php echo $mdayrc['tamtmo'];?></b></span>
                <span class="info-box-number">Yearly<?php
                   
                   $ydate = date("Y-m-d",strtotime("-1 year"));
                //   echo $ydate;
                $ydayrc= $con->query("SELECT FORMAT(IFNULL(SUM(AMOUNT),0),2)tamtyea FROM `aeps_transactions` WHERE `OWNER_ID` = '$my_id' AND TRANS_TYPE='M' AND STATUS='Success,AEPS Transaction Success' AND date(FILTER_DATE) between '$ydate' AND '$tdate'")->fetch_assoc();
                   ?><b style="float:right">₹<?php echo $ydayrc['tamtyea'];?></b></span>
              </div>
             <!--<i class="fas fa-users"></i>-->
             <!-- <i class="fas fa-users">-->
               <!--/.info-box-content -->
            </div>
             <!--/.info-box -->
          </div>
         <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <!--<span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>-->

              <div class="info-box-content">
                <span class="info-box-text">BBPS </span>
                <span class="info-box-number"><?php
                   $tdate = date("Y-m-d");
                 $total_aeps = $con->query("SELECT  FORMAT(IFNULL(SUM(AMOUNT),0),2)pay FROM `pay_bill_api` WHERE date(FILTER_DATE) = '$tdate'")->fetch_assoc();
                   ?>Today <b style="float:right">₹<?php echo $total_aeps['pay']; ?></b></span>
                <span class="info-box-number">Monthly <?php
                   
                   $mdate = date("Y-m-d",strtotime("-1 month"));
                //   echo $mdate; 
                //   echo $tdate;
                   $mdayrc= $con->query("SELECT FORMAT(IFNULL(SUM(AMOUNT),0),2)tamtmo FROM `pay_bill_api` WHERE date(FILTER_DATE) between '$mdate' AND '$tdate'")->fetch_assoc();
                   ?><b style="float:right">₹<?php echo $mdayrc['tamtmo'];?></b></span>
                <span class="info-box-number">Yearly<?php
                   
                   $ydate = date("Y-m-d",strtotime("-1 year"));
                //   echo $ydate;
                $ydayrc= $con->query("SELECT FORMAT(IFNULL(SUM(AMOUNT),0),2)tamtyea FROM `pay_bill_api` WHERE date(FILTER_DATE) between '$ydate' AND '$tdate'")->fetch_assoc();
                   ?><b style="float:right">₹<?php echo $ydayrc['tamtyea'];?></b></span>
              </div>
             <!--<i class="fas fa-users"></i>-->
             <!-- <i class="fas fa-users">-->
               <!--/.info-box-content -->
            </div>
             <!--/.info-box -->
          </div>
         <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <!--<span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>-->

              <div class="info-box-content">
                <span class="info-box-text">DMT <img src="assets/money_transfer.svg" width="20"alt="no images" style="float:right"></span>
                <span class="info-box-number"><?php
                   $tdate = date("Y-m-d");
                 $todaydmt = $con->query("SELECT FORMAT(IFNULL(SUM(AMOUNT),0),2)tamt FROM dmt_transactions WHERE `OWNER_ID` = '$my_id' AND date(TIMESTAMP) = '$tdate'")->fetch_assoc();
                   ?>Today <b style="float:right">₹<?php echo $todaydmt['tamt']; ?></b></span>
                <span class="info-box-number">Monthly <?php
                   
                   $mdate = date("Y-m-d",strtotime("-1 month"));
                //   echo $mdate; 
                //   echo $tdate;
                   $mdayrc= $con->query("SELECT FORMAT(IFNULL(SUM(AMOUNT),0),2)tamtmo FROM `dmt_transactions` WHERE `OWNER_ID` = '$my_id' AND date(TIMESTAMP) between '$mdate' AND '$tdate'")->fetch_assoc();
                   ?><b style="float:right">₹<?php echo $mdayrc['tamtmo'];?></b></span>
                <span class="info-box-number">Yearly<?php
                   
                   $ydate = date("Y-m-d",strtotime("-1 year"));
                //   echo $ydate;
                $ydayrc= $con->query("SELECT FORMAT(IFNULL(SUM(AMOUNT),0),2)tamtyea FROM `dmt_transactions` WHERE `OWNER_ID` = '$my_id' AND date(TIMESTAMP) between '$ydate' AND '$tdate'")->fetch_assoc();
                   ?><b style="float:right">₹<?php echo $ydayrc['tamtyea'];?></b></span>
              </div>
             <!--<i class="fas fa-users"></i>-->
             <!-- <i class="fas fa-users">-->
               <!--/.info-box-content -->
            </div>
             <!--/.info-box -->
          </div>
         <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <!--<span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>-->

              <div class="info-box-content">
                <span class="info-box-text">Payout <img src="assets/money_transfer.svg" width="20"alt="no images" style="float:right"></span>
                <span class="info-box-number"><?php
                   $tdate = date("Y-m-d");
                   $todaypayout = $con->query("SELECT FORMAT(IFNULL(SUM(AMOUNT),0),2)tamt FROM payout_transaction WHERE STATUS ='ACCEPTED' AND FILTER_DATE = '$tdate'")->fetch_assoc();
                   ?>Today <b style="float:right">
                   ₹<?php
                    if($todaypayout['tamt'] != ''){
                    echo $todaypayout['tamt']; 
                    }else{
                       echo '0'; 
                    }?></b></span>
                   
                <span class="info-box-number">Monthly <?php
                   
                   $mdate = date("Y-m-d",strtotime("-1 month"));
                //   echo $mdate; 
                //   echo $tdate;
                   $mdayrc= $con->query("SELECT FORMAT(IFNULL(SUM(AMOUNT),0),2)tamtmo FROM `payout_transaction` WHERE STATUS ='ACCEPTED' AND date(FILTER_DATE) between '$mdate' AND '$tdate'")->fetch_assoc();
                   ?><b style="float:right">₹<?php echo $mdayrc['tamtmo'];?></b></span>
                <span class="info-box-number">Yearly<?php
                   
                   $ydate = date("Y-m-d",strtotime("-1 year"));
                //   echo $ydate;
                $ydayrc= $con->query("SELECT FORMAT(IFNULL(SUM(AMOUNT),0),2)tamtyea FROM `payout_transaction` WHERE STATUS ='ACCEPTED' AND date(FILTER_DATE) between '$ydate' AND '$tdate'")->fetch_assoc();
                   ?><b style="float:right">₹<?php echo $ydayrc['tamtyea'];?></b></span>
              </div>
             <!--<i class="fas fa-users"></i>-->
             <!-- <i class="fas fa-users">-->
               <!--/.info-box-content -->
            </div>
             <!--/.info-box -->
          </div>
         <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <!--<span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>-->

              <div class="info-box-content">
                <span class="info-box-text">PanCard </span>
                <span class="info-box-number"><?php
                   $tdate = date("Y-m-d");
                 $total_aeps = $con->query("SELECT  FORMAT(IFNULL(SUM(AMOUNT),0),2)pan FROM `pan_transaction` WHERE date(DATE) = '$tdate'")->fetch_assoc();
                   ?>Today <b style="float:right">₹<?php echo $total_aeps['pan']; ?></b></span>
                <span class="info-box-number">Monthly <?php
                   
                   $mdate = date("Y-m-d",strtotime("-1 month"));
                //   echo $mdate; 
                //   echo $tdate;
                   $mdayrc= $con->query("SELECT FORMAT(IFNULL(SUM(AMOUNT),0),2)tamtmo FROM `pan_transaction` WHERE date(DATE) between '$mdate' AND '$tdate'")->fetch_assoc();
                   ?><b style="float:right">₹<?php echo $mdayrc['tamtmo'];?></b></span>
                <span class="info-box-number">Yearly<?php
                   
                   $ydate = date("Y-m-d",strtotime("-1 year"));
                //   echo $ydate;
                $ydayrc= $con->query("SELECT FORMAT(IFNULL(SUM(AMOUNT),0),2)tamtyea FROM `pan_transaction` WHERE date(DATE) between '$ydate' AND '$tdate'")->fetch_assoc();
                   ?><b style="float:right">₹<?php echo $ydayrc['tamtyea'];?></b></span>
              </div>
             <!--<i class="fas fa-users"></i>-->
             <!-- <i class="fas fa-users">-->
               <!--/.info-box-content -->
            </div>
             <!--/.info-box -->
          </div>
         <!--<div class="col-12 col-sm-6 col-md-3">-->
         <!--   <div class="info-box mb-3">-->
              <!--<span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>-->

              <!--<div class="info-box-content">-->
              <!--  <span class="info-box-text">Subscription </span>-->
                <!--<span class="info-box-number">-->
                <?php
                //   $tdate = date("Y-m-d");
                //   $todayrc = $con->query("SELECT FORMAT(IFNULL(SUM(AMOUNT),0),2)tamt FROM `recharge_transaction` WHERE date(FILTER_DATE) = '$tdate'")->fetch_assoc();
                   ?>
                   <!--Today <b style="float:right">₹-->
                   <?php 
                //   echo $todayrc['tamt']; 
                   ?>
                   <!--</b></span>-->
                <!--<span class="info-box-number">Monthly -->
                <?php
                   
                //   $mdate = date("Y-m-d",strtotime("-1 month"));
                //   echo $mdate; 
                //   echo $tdate;
                //   $mdayrc= $con->query("SELECT FORMAT(IFNULL(SUM(AMOUNT),0),2)tamtmo FROM `recharge_transaction` WHERE date(FILTER_DATE) between '$mdate' AND '$tdate'")->fetch_assoc();
                   ?>
                   <!--<b style="float:right">₹-->
                   <?php 
                //   echo $mdayrc['tamtmo'];
                   ?>
                   <!--</b></span>-->
                <!--<span class="info-box-number">Total -->
                <?php
                   
                //   $ydate = date("Y-m-d",strtotime("-1 year"));
                //   echo $ydate;
                // $ydayrcc= $con->query("SELECT FORMAT(IFNULL(SUM(AMOUNT),0),2)tamtyea FROM `recharge_transaction` WHERE date(FILTER_DATE) between '$ydate' AND '$tdate'")->fetch_assoc();
                   ?>
                   <!--<b style="float:right">₹-->
                   <?php 
                //   echo $ydayrcc['tamtyea'];
                   ?>
                   <!--0</b></span>-->
              <!--</div>-->
             <!--<i class="fas fa-users"></i>-->
             <!-- <i class="fas fa-users">-->
               <!--/.info-box-content -->
            <!--</div>-->
             <!--/.info-box -->
          <!--</div>-->
         <!--<div class="col-12 col-sm-6 col-md-3">-->
         <!--   <div class="info-box mb-3">-->
              <!--<span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>-->

              <!--<div class="info-box-content">-->
              <!--  <span class="info-box-text">Today Join User </span>-->
              <!--  <span class="info-box-number">-->
                <?php
                //   $tdate = date("Y-m-d");
                //   $todayrc = $con->query("SELECT FORMAT(IFNULL(SUM(AMOUNT),0),2)tamt FROM `recharge_transaction` WHERE date(FILTER_DATE) = '$tdate'")->fetch_assoc();
                   ?>
                   <!--Today <b style="float:right">₹-->
                   <?php 
                //   echo $todayrc['tamt']; 
                   ?>
                   <!--</b></span>-->
             
               
              <!--</div>-->
             <!--<i class="fas fa-users"></i>-->
             <!-- <i class="fas fa-users">-->
               <!--/.info-box-content -->
            <!--</div>-->
             <!--/.info-box -->
          <!--</div>-->
         <!--<div class="col-12 col-sm-6 col-md-3">-->
         <!--   <div class="info-box mb-3">-->
              <!--<span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>-->

              <!--<div class="info-box-content">-->
              <!--  <span class="info-box-text">All User </span>-->
              <!--   <span class="info-box-number">-->
                 <?php
                //   $tdate = date("Y-m-d");
                //   $todayrc = $con->query("SELECT COUNT(ID)id,FORMAT(IFNULL(SUM(MAIN_BAL),0),2)mbal,FORMAT(IFNULL(SUM(AEPS_BAL),0),2)abal FROM `user`")->fetch_assoc();
                   ?>
                   <?php 
                //   echo $todayrc['id']; 
                   ?>
              <!--     </span>-->
              <!--</div>-->
             <!--<i class="fas fa-users"></i>-->
             <!-- <i class="fas fa-users">-->
               <!--/.info-box-content -->
            <!--</div>-->
             <!--/.info-box -->
          <!--</div>-->
         <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <!--<span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>-->

              <div class="info-box-content">
                <span class="info-box-text">All Retailer</span>
                <span class="info-box-number">
                            <?php 
                                $todayrc = $con->query("SELECT COUNT(ID)id,FORMAT(IFNULL(SUM(MAIN_BAL),0),2)mbal,FORMAT(IFNULL(SUM(AEPS_BAL),0),2)abal FROM `user` WHERE `OWNER_ID` = '$my_id' AND USER_TYPE='46'")->fetch_assoc();
                                echo $todayrc['id'];
                                ?>
                
              </div>
             <!--<i class="fas fa-users"></i>-->
             <!-- <i class="fas fa-users">-->
               <!--/.info-box-content -->
            </div>
             <!--/.info-box -->
          </div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <!--<span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>-->

              <div class="info-box-content">
                                  <span class="info-box-text">Distributor </span>

                <span class="info-box-number"><?php
                   $tdate = date("Y-m-d");
                   $todayrc = $con->query("SELECT COUNT(ID)id,FORMAT(IFNULL(SUM(MAIN_BAL),0),2)mbal,FORMAT(IFNULL(SUM(AEPS_BAL),0),2)abal FROM `user` WHERE USER_TYPE='47'")->fetch_assoc();
                   ?><?php echo $todayrc['id']; ?></span>
              </div>
             <!--<i class="fas fa-users"></i>-->
             <!-- <i class="fas fa-users">-->
               <!--/.info-box-content -->
            </div>
             <!--/.info-box -->
          </div>
         <!--<div class="col-12 col-sm-6 col-md-3">-->
         <!--   <div class="info-box mb-3">-->
              <!--<span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>-->

         <!--     <div class="info-box-content">-->
         <!--                         <span class="info-box-text">Master Distributor </span>-->

                <!--<span class="info-box-number">-->
         <?php
                //   $tdate = date("Y-m-d");
                //   $todayrc = $con->query("SELECT COUNT(ID)id,FORMAT(IFNULL(SUM(MAIN_BAL),0),2)mbal,FORMAT(IFNULL(SUM(AEPS_BAL),0),2)abal FROM `user` WHERE USER_TYPE='48'")->fetch_assoc();
          ?>
         <?php
        //  echo $todayrc['id']; 
         ?></span>
         <!--     </div>-->
             <!--<i class="fas fa-users"></i>-->
             <!-- <i class="fas fa-users">-->
               <!--/.info-box-content -->
         <!--   </div>-->
             <!--/.info-box -->
         <!-- </div>-->
       
         <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <!--<span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>-->

              <div class="info-box-content">
                <span class="info-box-text">Total Wallet Amount </span>
                 <span class="info-box-number"><?php
                   $tdate = date("Y-m-d");
                   $todayrc = $con->query("SELECT COUNT(ID)id,FORMAT(IFNULL(SUM(MAIN_BAL),0),2)mbal,FORMAT(IFNULL(SUM(AEPS_BAL),0),2)abal FROM `user` WHERE `OWNER_ID` = '$my_id'")->fetch_assoc();
                   
                   $aepsBalAll = $con->query("SELECT SUM(AEPS_BAL) FROM user")->fetch_assoc();
                   $mainBalAll = $con->query("SELECT SUM(MAIN_BAL) FROM user")->fetch_assoc();
                   $total    = $aepsBalAll['SUM(AEPS_BAL)'] +$mainBalAll['SUM(MAIN_BAL)'];
                   ?>₹<?php  echo $total;
                               ?></span>
              </div>
             <!--<i class="fas fa-users"></i>-->
             <!-- <i class="fas fa-users">-->
               <!--/.info-box-content -->
            </div>
             <!--/.info-box -->
          </div>
         <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <!--<span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>-->

              <div class="info-box-content">
                <span class="info-box-text">Retailer Wallet Amount</span>
                <span class="info-box-number">
                      <?php
                    $tdate = date("Y-m-d");
                    $todayrc = $con->query("SELECT COUNT(ID)id,FORMAT(IFNULL(SUM(MAIN_BAL),0),2)mbal,FORMAT(IFNULL(SUM(AEPS_BAL),0),2)abal FROM `user` WHERE `OWNER_ID` = '$my_id' AND USER_TYPE = '46'")->fetch_assoc();
                ?>
                         <h6> Main Wallet : ₹ <?php echo $todayrc['mbal']; ?></h6>
                         <h6> Aeps Wallet : ₹ <?php echo $todayrc['abal']; ?></h6>
              </div>
             <!--<i class="fas fa-users"></i>-->
             <!-- <i class="fas fa-users">-->
               <!--/.info-box-content -->
            </div>
             <!--/.info-box -->
          </div>
         <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <!--<span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>-->

              <div class="info-box-content">
                                  <span class="info-box-text">Distributor Wallet Amount </span>

                <span class="info-box-number">  <?php
                    $tdate = date("Y-m-d");
                   $todayrc = $con->query("SELECT COUNT(ID)id,FORMAT(IFNULL(SUM(MAIN_BAL),0),2)mbal,FORMAT(IFNULL(SUM(AEPS_BAL),0),2)abal FROM `user` WHERE USER_TYPE = '47'")->fetch_assoc();
                ?>       <h6> Main Wallet : ₹ <?php echo $todayrc['mbal']; ?></h6>
                         <h6> Aeps Wallet : ₹ <?php echo $todayrc['abal']; ?></h6>
              </div>
             <!--<i class="fas fa-users"></i>-->
             <!-- <i class="fas fa-users">-->
               <!--/.info-box-content -->
            </div>
             <!--/.info-box -->
          </div>
         <!--<div class="col-12 col-sm-6 col-md-3">-->
            <!--<div class="info-box mb-3">-->
              <!--<span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>-->

              <!--<div class="info-box-content">-->
              <!--  <span class="info-box-text">Master Wallet Amount </span>-->
                <!--<span class="info-box-number">-->
               <?php
            //            $tdate = date("Y-m-d");
            //             $todayrc = $con->query("SELECT COUNT(ID)id,FORMAT(IFNULL(SUM(MAIN_BAL),0),2)mbal,FORMAT(IFNULL(SUM(AEPS_BAL),0),2)abal FROM `user` WHERE USER_TYPE = '48'")->fetch_assoc();
            ?>
              <!--<h6> Main Wallet : ₹ <?php echo $todayrc['mbal']; ?></h6>-->
              <!--           <h6> Aeps Wallet : ₹ <?php echo $todayrc['abal']; ?></h6>-->
              <!--</div>-->
             <!--<i class="fas fa-users"></i>-->
             <!-- <i class="fas fa-users">-->
               <!--/.info-box-content -->
            <!--</div>-->
             <!--/.info-box -->
          <!--</div>-->
          
         
          
          <!-- /.col -->
          
        </div>
        </div>
        <!-- /.row -->
        </section>
        <!-- /.row -->
<?php }?>
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-light">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
 <?php
    include("include/BottomBar.php");
 ?>
 
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="plugins/raphael/raphael.min.js"></script>
<script src="plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="plugins/jquery-mapael/maps/usa_states.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>

<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard2.js"></script>
 <script>
      $(document).ready(function(){
          $(".duser").click(function(){
              Swal.fire({
                                      icon: "info",
                                      title: "Verify Acount!",
                                       button: "Okay",
                                      text: 'Please Verify Yourself Call Now : +917428274282.',
                                    });
          });
      });
  </script>
</body>
</html>
