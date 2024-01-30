<?php
session_start();
include("../Db/config.php");
$my_id = $_SESSION["UsId"];
$date = date("Y-m-d");
$myuser = $con->query("SELECT * FROM `user` WHERE ID='$my_id'")->fetch_assoc();
$tearn = $con->query("SELECT FORMAT(IFNULL(SUM(COMMISSION),0),2)earn FROM `commission_report` WHERE `USER_ID` = '$my_id' AND DATE(`TIME`) = '$date'")->fetch_assoc();
$tbusiness = $con->query("SELECT FORMAT(IFNULL(SUM(AMOUNT),0),2)amt FROM `commission_report` WHERE `USER_ID` = '$my_id' AND DATE(`TIME`) = '$date'")->fetch_assoc();

if(isset($_GET['logout'])){
    session_destroy();
    header("location:Login");
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
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__wobble" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" width="120">
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
            <?php if($user["US_STATUS"] == 'Active'){ ?>
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
                <span class="info-box-text">AePs Wallet</span>
                <span class="info-box-number">₹ <?php echo number_format((float)$user['AEPS_BAL'], 2, '.', ''); ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            </a>
            <!-- /.info-box -->
          </div>
          
          <?php }else{ ?>
          
          <div class="col-12 col-sm-6 col-md-3">
              <a href="javascript:void(0)" class="nav-link duser">
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
              <a href="javascript:void(0)" class="nav-link duser">
                    <div class="info-box mb-3">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-wallet"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">AePs Wallet</span>
                <span class="info-box-number">₹ <?php echo number_format((float)$user['AEPS_BAL'], 2, '.', ''); ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            </a>
            <!-- /.info-box -->
          </div>
          
          <?php } ?>
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Today Earing</span>
                <span class="info-box-number">₹ <?php echo number_format((float)$tearn['earn'], 2, '.', ''); ?></span>
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
                <span class="info-box-number">₹ <?php echo number_format((float)$tbusiness['amt'], 2, '.', ''); ?></span>
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
                <h5 class="card-title">Our News</h5>
                </div>
                <div class="container">
                   <ul class="list-unstyled">
           
                <?php
                    // if(isset($_POST['pageid']) && $_POST['pageid'] == ){                                            
                    $i=1;
                    $fromdate = $_POST['formdate'];
                    $todate = $_POST['todate'];
                    
                    
                    $res = $con->query("SELECT * FROM `news` WHERE RETAILER_ID = '$my_id' AND date(DATE) between '$fromdate' and '$todate' ORDER BY ID DESC");
                    if($res->num_rows > 0){
                        while($row = $res->fetch_assoc()){
                              
                     ?>
                       <li class="media my-4">
                        <img class="mr-3" src="..." alt="Generic placeholder image">
                        <div class="media-body">
                          <h5 class="mt-0 mb-1">List-based media object</h5>
                            <?php echo $row['NEWS_TEXT'] ?>
                        </div>
                     </li>

                    <?php
                      }
                    }
    
                        
                    ?>
             
                <li class="media">
                        <img class="mr-3" src="..." alt="Generic placeholder image">
                        <div class="media-body">
                          <h5 class="mt-0 mb-1">List-based media object</h5>
                          Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                        </div>
  </li>
                    </ul>
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

 <script>
      $(document).ready(function(){
          $(".duser").click(function(){
              Swal.fire({
                                      icon: "info",
                                      title: "Verify Acount!",
                                       button: "Okay",
                                      text: "Please Verify Yourself Call Now : +917428274282.",
                                    });
          });
      });
  </script>

</body>
</html>
