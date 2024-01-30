<?php
include("../Db/config.php");
session_start();
$my_id = $_SESSION["UsId"];

$virtual_acc = $con->query("SELECT * FROM `virtual_account` WHERE USER_ID='$my_id'")->fetch_assoc();
$qrres = json_decode($virtual_acc["QR_RESPONSE"],true);
$qrimg  = $qrres["qrCode"];

$register_userdata = $con->query("SELECT * FROM `register_user_data` WHERE USER_ID='$my_id'")->fetch_assoc();

$bnkdt = json_decode($register_userdata['BANK_DATA'],true);
$videokyc = $register_userdata['VIDEO_URL'];
$panPdf = $register_userdata['PAN_PDF'];

$user = $con->query("SELECT * FROM `user` WHERE ID='$my_id'")->fetch_assoc();

        $usertype = $user['USER_TYPE'];
        $userType = $con->query("SELECT * FROM user_type WHERE ID = '$usertype'")->fetch_assoc();
        
        
        $filteredJson =  trim(str_replace(": " , "-" ,$register_userdata['AADHAAR_DATA']));
        $filteredJson =  trim(str_replace("\n" , "-" ,$filteredJson));
        $filteredJson =  rtrim($filteredJson);
        $adhdata = json_decode($filteredJson , true);
        $profilepath = $adhdata['result']['photo'];
        
        $vausdata = $con->query("SELECT * FROM `virtual_account` where USER_ID='$id' ")->fetch_assoc();

if(isset($_GET['logout'])){
    session_destroy();
    header("location:Login");
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
    <section class="content">
      <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-wallet"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Main Wallet</span>
                <span class="info-box-number">
                  ₹ <?php echo $user['MAIN_BAL'] ?>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-wallet"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">AePs Wallet</span>
                <span class="info-box-number">₹ <?php echo $user['AEPS_BAL'] ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
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
                <span class="info-box-number">₹0</span>
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
                <span class="info-box-number">0</span>
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

        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title">User Profile</h5>

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
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                   
                   <div class="row icons_section">
                   
                  
                                        
                                        
                                       <form id="modalform">
             <div id="mwrap"><div class="row">
                <!--left data-->
                <input type="hidden" name="userid" value="868660">
                <div class="col-9">
                    <div class="form-row">
                      <div class="form-group col-md-4">
                      <label for="inputEmail4">Member ID : <?php echo $user['ID'] ?></label>
                    </div>
                    
                    </div>
                    
                    <div class="form-row">
                      <div class="form-group col-md-4">
                      <label for="inputEmail4">Subscription Plan Name : <?php echo $user['SUBSCRIPTION'] ?></label>
                    </div>
            
                    
                      <div class="form-group col-md-5">
                      <label for="inputEmail4">Validity: ( Remaining Days)</label>
                    </div>
                    </div>
                    <div class="form-row">
                      <div class="form-group col-md-4">
                      <label for="inputEmail4">Member ID: <?php echo $user['ID'] ?></label>
                    </div>
                      <div class="form-group col-md-5">
                      
                      <label for="inputEmail4">Member Type : <?php echo $userType['NAME'] ?></label>
                    
                    </div>
                    </div>
                    <div class="form-row">
                      <div class="form-group col-md-4">
                      <label for="inputEmail4">Mobile : <?php echo $user['MOBILE'] ?></label>
                    </div>
                      <div class="form-group col-md-5">
                         <label for="inputEmail4">Email ID: <?php echo $user['EMAIL'] ?></label>
                      </div>
                    </div>
                    <div class="form-row">
                      <div class="form-group col-md-8">
                      <label for="inputEmail4">Member Owner : <?php echo $user['OWNER_ID'] ?></label>
                    </div>
                    </div>
                    <label><u>Permanent Address</u></label>
                    <div class="form-row">
                      <div class="form-group col-md-12">
                        <label for="inputEmail4">Full Address : <?php echo $user['ADDRESS'] ?></label>
                      </div>
                      <div class="form-group col-md-4">
                      <label for="inputEmail4">State : <?php echo $user['STATE'] ?></label>
                    </div>
                      <div class="form-group col-md-4">
                        <label for="inputEmail4">City : <?php echo $user['CITY'] ?></label>
                      </div>
                      <div class="form-group col-md-4">
                        <label for="inputEmail4">Pin Code : <?php echo $user['PIN'] ?></label>
                      </div>
                       
                    </div>
                    <label><u>Office Address</u></label>
                    <div class="form-row">
                      <div class="form-group col-md-12">
                        <label for="inputEmail4">Full Address : <?php echo $user['ADDRESS'] ?></label>
                      </div>
                      <div class="form-group col-md-4">
                      <label for="inputEmail4">State : <?php echo $user['STATE'] ?></label>
                    </div>
                      <div class="form-group col-md-4">
                        <label for="inputEmail4">City : <?php echo $user['CITY'] ?></label>
                      </div>
                      <div class="form-group col-md-4">
                        <label for="inputEmail4">Pin Code : <?php echo $user['PIN'] ?></label>
                      </div>
                      
                    </div>
                
                </div>
                

                
               <div class="col-md-3">
                 <!--<img src="https://persist.signzy.tech/api/files/300488543/download/f11752030a104636971f02f6f43039217133daa3eb4b4b37ba7f21ef875042ff.jpeg" id="adhaarpic" class="rounded mx-auto d-block">-->
                 <img src="<?php echo $profilepath ?>" id="adhaarpic" class="rounded mx-auto d-block">
                <br>

                
              <label class="text-center">Joining Date : <br> <?php echo $user['DATE'] ?></label>
              <label class="text-danger text-center">Virtual Account Details </label>
              
               <p>Virtual Id : <?php echo $virtual_acc['VA_ID'] ?></p>
               <p>Account Number : <?php echo $virtual_acc['ACCOUNT_NUM'] ?></p>
               <p>IFSC : <?php echo $virtual_acc['IFSC'] ?></p> 
               <p>UPI :<?php echo $virtual_acc['UPI'] ?></p>
               <img src="<?php echo $qrimg ?>" style='border: 1px solid #17a2b8;' class="img-fluid" width="150px">
               
            </div>
            </div> 
             
         <div class="row">
             <div class="col-12">
               <div class="form-row d-flex justify-content-between ">
                <div class="form-group col-md-4">
                  <label>Aadhar Number : <?php echo $user['ADHAAR'] ?></label>
                </div>
                <div class="form-group col-md-4">
                  <label>PAN Number : <?php echo $user['PAN'] ?></label>
                </div>
                <div class="form-group col-md-4">
                  <label>GST Number : </label>
                </div>
              </div>
          </div>
             
         </div>
    
     <div class="row">
             <div class="col-12">
             
               <div class="form-row d-flex justify-content-between ">
                <div class="form-group col-md-3">
                  <a class="badge badge-info right">Download Aadhar</a>
                </div>
                <div class="form-group col-md-3">
                  <a class="badge badge-info right">Download E-Stamp</a>
                </div>
                <div class="form-group col-md-3">
                  <!--<a href="https://files.signzy.tech/api/files/300489371/download/5a6b29b5945844e5aa2a7fc98372090f337dc2e43df1498d989eb819b8f82e79.pdf" target="_blank" class="badge badge-info right">Download PAN</a>-->
                  <a href="<?php echo $panPdf ?>" target="_blank" class="badge badge-info right">Download PAN</a>
                </div>
                <div class="form-group col-md-3">
                  <!--<a href="https://persist.signzy.tech/api/files/300490279/download/b5bda3b008804aaa95bc9d4af8dfc2357d8a7acd447648828d9461f94578341b.blob" target="_blank" class="badge badge-info right">View Video KYC</a>-->
                  <a href="<?php echo $videokyc ?>" target="_blank" class="badge badge-info right">View Video KYC</a>
                </div>
                </div>
              </div>
          </div>     
        
    
    
         <div class="row">
             <label><u>Bank Account Details</u></label>
             <div class="col-12">
               <div class="form-row d-flex justify-content-between ">
                <div class="form-group col-md-3">
                  <label>Account Holder Name</label>
                  <input type="text" value="<?php echo $bnkdt['beneName'];?>" disabled="" class="form-control">
                </div>
                <div class="form-group col-md-3">
                   <label>Account Number</label>
                   <input type="number" value="<?php echo $bnkdt['beneAcc'];?>" disabled="" class="form-control">
                </div>
                <div class="form-group col-md-3">
                  <label>IFSC Code</label>
                   <input type="text" value="<?php echo $bnkdt['beneIFSC'];?>" disabled="" class="form-control">
                </div>
                <div class="form-group col-md-3">
                  <label>Bank Name</label>
                   <input type="text" disabled="" class="form-control" value="<?php echo $bnkdt[''];?>">
                </div>
                </div>
              </div>
          </div>
         
 </div>
  
         

  <!--==============  View Profile Modal ===================-->
                
                
              
            </form>
                                        
                                     
                                        
                                    </div>
              </div>
              <!-- ./card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

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
</body>
</html>
