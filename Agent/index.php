<?php
session_start();
include("../Db/config.php");
$my_id = $_SESSION["UsId"];
$date = date("Y-m-d");

// error_reporting(E_ALL);
// ini_set("display_errors",1);

$myuser = $con->query("SELECT * FROM `user` WHERE ID='$my_id'")->fetch_assoc();
$tearn = $con->query("SELECT FORMAT(IFNULL(SUM(COMMISSION),0),2)earn FROM `commission_report` WHERE `USER_ID` = '$my_id' AND DATE(`TIME`) = '$date'")->fetch_assoc();
$tbusiness = $con->query("SELECT FORMAT(IFNULL(SUM(AMOUNT),0),2)amt FROM `commission_report` WHERE `USER_ID` = '$my_id' AND DATE(`TIME`) = '$date'")->fetch_assoc();
$server = $con->query("select * from serversetup where ID='1' ")->fetch_assoc();

if(isset($_GET['logout'])){
    session_destroy();
    header("location:Login");
}

$sql2=$con->query("select * from user where ID='$my_id'")->fetch_assoc();

$type2=$sql2['USER_TYPE'];
if($type2=='46'){
    $abc="RETAILER_ID='$my_id'";
}else if($type2=='47'){
    $abc="DISTRIBUTOR_ID='$my_id'";
}else{
    $abc="EMPLOYEE_ID='$my_id'";
}

$row = $con->query("SELECT * FROM `websetting`")->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo $row['NAME']?> | Dashboard </title>

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  
<style>

@keyframes chartjs-render-animation {
	from {
		opacity: .99;
	}

	to {
		opacity: 1;
	}
}

.chartjs-render-monitor {
	animation: chartjs-render-animation 1ms;
}

.chartjs-size-monitor,.chartjs-size-monitor-expand,.chartjs-size-monitor-shrink {
	position: absolute;
	direction: ltr;
	left: 0;
	top: 0;
	right: 0;
	bottom: 0;
	overflow: hidden;
	pointer-events: none;
	visibility: hidden;
	z-index: -1;
}

.chartjs-size-monitor-expand>div {
	position: absolute;
	width: 1000000px;
	height: 1000000px;
	left: 0;
	top: 0;
}

.chartjs-size-monitor-shrink>div {
	position: absolute;
	width: 200%;
	height: 200%;
	left: 0;
	top: 0;
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

            
            <?php if($user["US_STATUS"] == 'Active'){ ?>
          <div class="col-12 col-sm-6 col-md-3">
              <a href="WalletReport?type=MAIN">
                  <div class="info-box">
              <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-wallet"></i></span>

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
              <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-wallet"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">AePs Wallet</span>
                <span class="info-box-number">₹ <?php echo number_format((float)$user['AEPS_BAL'], 2, '.', '');    ?></span>
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
              <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-wallet"></i></span>

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
              <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-wallet"></i></span>

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
              <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-shopping-cart"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Today Earing</span>
                <span class="info-box-number">₹ <?php echo $tearn['earn']; ?> </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Today Buisness</span>
                <span class="info-box-number">₹ <?php echo $tbusiness['amt']; ?> </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

        <!---->
              <style>
              .space_icon{
                  padding:10px;
              }
                  .space_icon i{
                      font-size:30px;
                      color:#6f42c1;
                  }
                  .services .card{
                      border-radius:15px;
                  }
                  .nav-link i{
                     color:#6f42c1;  
                  }
              </style>
        <!---->


        <div class="row d-flex justify-content-around mt-5">
            
            <div class="col-lg-8 col-md-12 col-12">
                <div class="row d-flex justify-content-around services">
                    <a href="RechargeService" class="card col-md-2 col-3">
                        <div class="space_icon d-flex justify-content-center ">
                            <i class="nav-icon fas fa-mobile-alt"></i>
                        </div>
                        <h6 class="text-center">Mobile Recharge</h6>
                    </a> 
                    
                    <a href="DTHRechargeService" class="card col-md-2 col-3 ml-1">
                        <div class="space_icon d-flex justify-content-center ">
                            <i class="nav-icon  fas fa-baby-carriage"></i>
                        </div>
                        <h6 class="text-center">DTH</h6>
                    </a>
                    
                    <a href="<?php if($server['AEPS'] == "PAYSPRINT"){
                                                echo "Fing_AEPS.php";
                                                            }else{
                                                            echo "Fing_AEPS.php";
                                                                
                                                            }?>" class="card col-md-2 col-3 ml-1">
                        <div class="space_icon d-flex justify-content-center ">
                            <i class="nav-icon fas fa-fingerprint"></i>
                        </div>
                        <h6 class="text-center">AePs</h6>
                    </a> 
                    <a href="<?php if($server['AEPS'] == "PAYSPRINT"){
                                                echo "AePsService.php";
                                                            }else{
                                                            echo "AePsService.php";
                                                                
                                                            }?>" class="card col-md-2 col-3 ml-1">
                        <div class="space_icon d-flex justify-content-center ">
                            <i class="nav-icon fas fa-fingerprint"></i>
                        </div>
                        <h6 class="text-center">AePs2</h6>
                    </a> 
                    
                    <!--<a href="UPI_Service" class="card col-md-2 col-3 ml-1">-->
                    <!--    <div class="space_icon d-flex justify-content-center ">-->
                    <!--        <i class="nav-icon fas fa-exchange-alt"></i>-->
                    <!--    </div>-->
                    <!--    <h6 class="text-center">UPI Transfer</h6>-->
                    <!--</a> -->
                    
                    <a href="dmt_trans" class="card col-md-2 col-3 ml-1">
                        <div class="space_icon d-flex justify-content-center">
                            <i class="nav-icon fas fa-exchange-alt"></i>
                        </div>
                        <h6 class="text-center"> Banking Services</h6>
                    </a> 
                    
                    <a href="BillAvenueBBPS" class="card col-md-2 col-3 ml-1">
                        <div class="space_icon d-flex justify-content-center ">
                            <i class="nav-icon far fa-lightbulb"></i>
                        </div>
                        <h6 class="text-center">BBPS</h6>
                    </a>
                    
                    <a href="ekndPan" class="card col-md-2 col-3 ml-1">
                        <div class="space_icon d-flex justify-content-center ">
                            <i class="nav-icon far fa-address-card"></i>
                        </div>
                        <h6 class="text-center">Coupon</h6>
                    </a>
                    
                      <a href="https://www.psaonline.utiitsl.com/psaonline/showLogin" target= "_blank"class="card col-md-2 col-3 ml-1">
                        <div class="space_icon d-flex justify-content-center ">
                            <i class="nav-icon far fa-address-card"></i>
                        </div>
                        <h6 class="text-center">Apply Pan</h6>
                    </a>
                    
                    <a href="Payout_new" class="card col-md-2 col-3 ml-1">
                        <div class="space_icon d-flex justify-content-center ">
                            <i class="nav-icon fas fa-university"></i>
                        </div>
                        <h6 class="text-center">Payout</h6>
                    </a>
                    
                    <a href="SpecialPayout" class="card col-md-2 col-3 ml-1">
                        <div class="space_icon d-flex justify-content-center ">
                            <i class="nav-icon fas fa-university"></i>
                        </div>
                        <h6 class="text-center">Special Payout</h6>
                    </a>
                    
                    <a href="M-ATMReport" class="card col-md-2 col-3 ml-1">
                        <div class="space_icon d-flex justify-content-center ">
                            <i class="nav-icon far fa-credit-card"></i>
                        </div>
                        <h6 class="text-center">M-ATM</h6>
                    </a>
                    
                    <!--<a href="BBPS_Service" class="card col-md-2 col-3 ml-1">-->
                    <!--    <div class="space_icon d-flex justify-content-center ">-->
                    <!--        <i class="nav-icon fas fa-hands"></i>-->
                    <!--    </div>-->
                    <!--    <h6 class="text-center">LIC</h6>-->
                    <!--</a>-->
                    
                    <!--<a href="Fastag_Service" class="card col-md-2 col-3 ml-1">-->
                    <!--    <div class="space_icon d-flex justify-content-center ">-->
                    <!--        <i class="nav-icon fas fa-car"></i>-->
                    <!--    </div>-->
                    <!--    <h6 class="text-center">Fastag</h6>-->
                    <!--</a>-->
                    
                    <!--<a href="PanCardRequest" class="card col-md-2 col-3 ml-1">-->
                    <!--    <div class="space_icon d-flex justify-content-center ">-->
                    <!--        <i class="nav-icon far fa-credit-card"></i>-->
                    <!--    </div>-->
                    <!--    <h6 class="text-center">Pan Card</h6>-->
                    <!--</a> -->
                    
                    <!--<a href="LoanRequest" class="card col-md-2 col-3 ml-1">-->
                    <!--    <div class="space_icon d-flex justify-content-center ">-->
                    <!--        <i class="nav-icon fas fa-chart-pie"></i>-->
                    <!--    </div>-->
                    <!--    <h6 class="text-center">Loan</h6>-->
                    <!--</a>   -->
                    <div class="card col-md-2 col-3 ml-1">
                        <div class="space_icon d-flex justify-content-center ml-1">
                            <i class="nav-icon fas fa-plane-departure"></i>
                        </div>
                        <h6 class="text-center">Flight</h6>
                    </div>   
                    <div class="card col-md-2 col-3 ml-1">
                        <div class="space_icon d-flex justify-content-center ml-1">
                            <i class="nav-icon fas fa-hotel"></i>
                        </div>
                        <h6 class="text-center">Hotel</h6>
                    </div>    
                    <div class="card col-md-2 col-3 ml-1">
                        <div class="space_icon d-flex justify-content-center ml-1">
                            <i class="nav-icon fas fa-subway"></i>
                        </div>
                        <h6 class="text-center">Train</h6>
                    </div> 
                    <div class="card col-md-2 col-3 ml-1">
                        <div class="space_icon d-flex justify-content-center ml-1">
                            <i class="nav-icon fas fa-bus-alt"></i>
                        </div>
                        <h6 class="text-center">Bus</h6>
                    </div> 
                </div>
            </div>
            <div class="col-lg-4 col-md-12 col-12">
                
            <!--Pie Chart-->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">News Alert</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div class="container"> 
                <div class="ticker"> <div class="title"><h5>Breaking News</h5></div> 
                 <?php
                 $sql1=$con->query("select * from user where ID='$my_id'")->fetch_assoc();
                $type1=$sql1['USER_TYPE'];
                if($type1=='46'){
                    $xyz="RETAILER_ID='$my_id'";
                }else if($type1=='47'){
                    $xyz="DISTRIBUTOR_ID='$my_id'";
                }else{
                    $xyz="EMPLOYEE_ID='$my_id'";
                }
                    $news = $con->query("SELECT * FROM `news` WHERE  $xyz or USER_TYPE='all user'");
                        while($row1 = mysqli_fetch_array($news)){
                            if($row1['NEWS_TEXT'] !=""){
                        ?>
                                  <div class="news"> 
                            <marquee class="news-content"> 
                                <?php echo $row1['NEWS_TEXT'] ?> 
                            </marquee> 
                            </div> 
                        <?php
                        }
                        }
                        ?>
                
                </div> 
                </div>  
                  
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
              <div class="carousel-inner">
                <div class="carousel-item active">
                  <img class="d-block w-100" src="assets/slider/2.png" alt="First slide">
                </div>
                <div class="carousel-item">
                  <img class="d-block w-100" src="assets/slider/3.png" alt="Second slide">
                </div>
                <div class="carousel-item">
                  <img class="d-block w-100" src="assets/slider/1.png" alt="Third slide">
                </div>
              </div>
              <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
              </a>
              <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
              </a>
            </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!--Pie Chart-->
            
            </div>    
            
        </div>    
            
        <div class="row">
          <div class="col-md-12">
              
             
             <!--Login History Start--> 
              
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Login History</h3>
              </div>
                <h2 id="loadingtext" class="px-4"></h2>
              <!-- /.card-header -->
              <div class="card-body" id="tbcard">
                
              </div>
              <!-- /.card-body -->
            </div>
              
              
              <!--Login History End-->
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
<!--<script src="js/Main.js"></script>-->
<script src="plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="plugins/jquery-mapael/maps/usa_states.min.js"></script>

<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard2.js"></script>



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
<script type="text/javascript" src="assets/Js/AddFund.js"></script>


<!-- AdminLTE for demo purposes -->

<!-- Page specific script -->

<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>



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



<script>
    // Load Table Records
     load_data();

    function load_data()
    {
         $("#loadingtext").text("Wait. Loading Data");
         var fromd = $("#fromdate").val();
    var tod = $("#todate").val();
      $.ajax({
        url:"ajaxphp/select_user.php",
        method:"POST",
        data:{pageid:6,formdate:fromd,todate:tod},
        success:function(data)
        {
            $("#loadingtext").text("");
          $('#tbcard').html(data);
          
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
        }
      });
    }

    
</script>


<script>
  $(function () {
    /* ChartJS
     * -------
     * Here we will create a few charts using ChartJS
     */

    //--------------
    //- AREA CHART -
    //--------------

    // Get context with jQuery - using jQuery's .get() method.
    var areaChartCanvas = $('#areaChart').get(0).getContext('2d')

    var areaChartData = {
      labels  : ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
      datasets: [
        {
          label               : 'Digital Goods',
          backgroundColor     : 'rgba(60,141,188,0.9)',
          borderColor         : 'rgba(60,141,188,0.8)',
          pointRadius          : false,
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : [28, 48, 40, 19, 86, 27, 90]
        },
        {
          label               : 'Electronics',
          backgroundColor     : 'rgba(210, 214, 222, 1)',
          borderColor         : 'rgba(210, 214, 222, 1)',
          pointRadius         : false,
          pointColor          : 'rgba(210, 214, 222, 1)',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : [65, 59, 80, 81, 56, 55, 40]
        },
      ]
    }

    var areaChartOptions = {
      maintainAspectRatio : false,
      responsive : true,
      legend: {
        display: false
      },
      scales: {
        xAxes: [{
          gridLines : {
            display : false,
          }
        }],
        yAxes: [{
          gridLines : {
            display : false,
          }
        }]
      }
    }

    // This will get the first returned node in the jQuery collection.
    new Chart(areaChartCanvas, {
      type: 'line',
      data: areaChartData,
      options: areaChartOptions
    })

    //-------------
    //- LINE CHART -
    //--------------
    var lineChartCanvas = $('#lineChart').get(0).getContext('2d')
    var lineChartOptions = $.extend(true, {}, areaChartOptions)
    var lineChartData = $.extend(true, {}, areaChartData)
    lineChartData.datasets[0].fill = false;
    lineChartData.datasets[1].fill = false;
    lineChartOptions.datasetFill = false

    var lineChart = new Chart(lineChartCanvas, {
      type: 'line',
      data: lineChartData,
      options: lineChartOptions
    })

    //-------------
    //- DONUT CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
    var donutData        = {
      labels: [
          'Chrome',
          'IE',
          'FireFox',
          'Safari',
          'Opera',
          'Navigator',
      ],
      datasets: [
        {
          data: [700,500,400,600,300,100],
          backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
        }
      ]
    }
    var donutOptions     = {
      maintainAspectRatio : false,
      responsive : true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    new Chart(donutChartCanvas, {
      type: 'doughnut',
      data: donutData,
      options: donutOptions
    })

    //-------------
    //- PIE CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
    var pieData        = donutData;
    var pieOptions     = {
      maintainAspectRatio : false,
      responsive : true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    new Chart(pieChartCanvas, {
      type: 'pie',
      data: pieData,
      options: pieOptions
    })

    //-------------
    //- BAR CHART -
    //-------------
    var barChartCanvas = $('#barChart').get(0).getContext('2d')
    var barChartData = $.extend(true, {}, areaChartData)
    var temp0 = areaChartData.datasets[0]
    var temp1 = areaChartData.datasets[1]
    barChartData.datasets[0] = temp1
    barChartData.datasets[1] = temp0

    var barChartOptions = {
      responsive              : true,
      maintainAspectRatio     : false,
      datasetFill             : false
    }

    new Chart(barChartCanvas, {
      type: 'bar',
      data: barChartData,
      options: barChartOptions
    })

    //---------------------
    //- STACKED BAR CHART -
    //---------------------
    var stackedBarChartCanvas = $('#stackedBarChart').get(0).getContext('2d')
    var stackedBarChartData = $.extend(true, {}, barChartData)

    var stackedBarChartOptions = {
      responsive              : true,
      maintainAspectRatio     : false,
      scales: {
        xAxes: [{
          stacked: true,
        }],
        yAxes: [{
          stacked: true
        }]
      }
    }

    new Chart(stackedBarChartCanvas, {
      type: 'bar',
      data: stackedBarChartData,
      options: stackedBarChartOptions
    })
  })
</script>
<script>
    $('#save').click(function(e){

 e.preventDefault();
  $.ajax({
     url:"cashfree_pay.php",
     type:'POST',
     data :$("#add_data").serialize(),
     success: function(data){
         
         let arr = JSON.parse(data);
         let link = arr.payment_link;
         location.replace(link);
    //   if(data == 1){
    //       Swal.fire({
    //         icon: 'success',
    //         title: 'Success...',
    //         text: 'Successfully Inserted!',
    //       }).then (function(){
    //       location.replace('index.php');
    //       });
    //   }else{
    //     Swal.fire({
    //       icon: 'error',
    //       title: 'Oops...',
    //       text: 'Something went wrong!',
    //     }).then (function(){
    //       location.replace('index.php');
    //       });
    //   }
    //      load_data();
     },
 });

})

//insert offline wallet data
        // $('#ofline_bal_req').click(function(e) {
        //     e.preventDefault();
        //     $.ajax({
        //         url: "handler/Fund.php",
        //         type: 'POST',
        //         data: $("#main_form").serialize(),
        //         success: function(data) {
        //             // alert(data)
        //             if (data == 1) {
        //             Swal.fire({
        //                     icon: 'success',
        //                     title: 'Success...',
        //                     text: 'Successfully Requested!',
        //                 }).then(function() {
        //                     location.replace("index");
        //                 });
        //             } else {
        //                 Swal.fire({
        //                     icon: 'error',
        //                     title: 'Oops...',
        //                     text: 'Something went wrong!',
        //                 }).then(function() {
        //                     location.replace("index");
        //                 });
        //             }
        //         }
        //     });
        // })
        
$('#main_form').submit(function(e){
        e.preventDefault();
    $.ajax({
        url:"handler/Fund.php",
        type:'POST',
        data:new FormData(this),
        processData: false,
        contentType: false,
        success: function(data){
            const responseObj = JSON.parse(data);
                        const rscode = responseObj.response_code;
                        const message = responseObj.message;
            if(rscode == 1){
                swal.fire({
                    icon:'success',
                    title: 'Success...',
                    text: message,
                    button: 'okay'
                }).then(function(){
                    location.replace('index');
                });
            }else{
                swal.fire({
                    icon:'error',
                    title: 'Error',
                    text:'Something Went Wrong..',
                    button: 'okay'
                });
            }
        },
    });
    })
</script>
</body>
</html>
