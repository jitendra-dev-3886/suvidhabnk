<?php
session_start();
include("include/Connection/config.php");
include("include/FetchData/adminData.php");
include("include/Auth.php");

// $usf = $con->query("select * from user where USER_TYPE='47' ");
// while($usdt = $usf->fetch_assoc()){
//     $usfid = $usdt['ID'];
//     $updt  = "PDDT".$usfid;
//     $con->query("update user set PARTNER_ID='$updt' where ID='$usfid' ");
// }

$row = $con->query("SELECT * FROM `websetting`")->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard </title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
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
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Admin Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Admin Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
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

<a href="MainWalletReport.php">
              <div class="info-box-content">
                <span class="info-box-text">Main Wallet</span>
                <span class="info-box-number">
                     ₹ <?php
                 $total_main = $con->query("SELECT  SUM(MAIN_BAL) FROM `user`")->fetch_assoc();
                   echo number_format($total_main['SUM(MAIN_BAL)'] ,2);
                 ?>
                                                            
                 
                </span>
              </div>
              </a>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-wallet"></i></span>
<a href="AePsWalletReport.php">
              <div class="info-box-content">
                <span class="info-box-text">AePs Wallet</span>
                <span class="info-box-number">₹ <?php
                 $total_aeps = $con->query("SELECT  FORMAT(IFNULL(SUM(AEPS_BAL),0),2)aeps FROM `user`")->fetch_assoc();
                   echo $total_aeps['aeps'];
                 ?></span>
              </div>
              </a>
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
                <span class="info-box-text">Agent</span>
                <!--<span class="info-box-number">Retailer | Distributor</span>-->
                 <?php
			    	$sql = "SELECT * FROM `user` where USER_TYPE='46'";
			    	$dist = $con->query("SELECT * FROM `user` where USER_TYPE='47'")->num_rows;

                        if ($result = mysqli_query($con, $sql)) {
                        
                            // Return the number of rows in result set
                            $rowcount = mysqli_num_rows( $result );
                         }
               ?>
                <span class="info-box-number">R - <?php echo $rowcount; ?> | D - <?php echo $dist; ?>  | A - <?php echo $dist; ?></span>
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
                <span class="info-box-text">Today Active User</span>
                <span class="info-box-number">
                    <?php
                    // echo "select distinct USER_ID from login_history where LOGIN_DATE='".date("Y-m-d")."'";
                    echo $con->query("select distinct USER_ID from login_history where USER_ID<>'' and LOGIN_DATE='".date("Y-m-d")."' ")->num_rows;
                    ?>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

        <div class="row">
          <div class="col-md-12">
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
                      <strong>Transaction Analysis</strong>
                    </p>
                    
                    
                    <!-- /.progress-group -->
                    <div class="progress-group">
                     Success
                      <?php
                        
                        // $a=date("m");
                        // $time = strtotime("2022-$a-2");
                        // $tg=date("h:i:s A");
                        // $final = date("Y-m-d", strtotime("-1 month",$time));
                        
                        // $fail=$con->query("SELECT SUM(AMOUNT) FROM dmt_transactions WHERE STATUS='failed' AND date(FILTER_DATE) BETWEEN '$final' and '$time'");
                        $total_SUCCESS = $con->query("SELECT COUNT(*) AS `count` FROM `dmt_transactions` WHERE STATUS='SUCCESS'")->fetch_assoc();
                        $count_SUCCESS = $total_SUCCESS['count'];
                        
                        $total_transaction = $con->query("SELECT COUNT(*) AS `count` FROM `dmt_transactions`")->fetch_assoc();
                        $count = $total_transaction['count'];
                        
                        ?>
                      <span class="float-right"><b><?php echo $count_SUCCESS?></b>/<?php echo $count?></span>
                      <div class="progress progress-sm">
                       <?php
                       $current=50;
                       $total=100;
                       
                       $cal=round(($current/$total)*100,2);
                       ?>   
                        <div class="progress-bar bg-success" style="width: <?php echo $cal?>%"></div>
                        
                      </div>
                    
                    </div>
                    
                    
                     <!-- /.progress-group -->
                     
                    
                     
                    <div class="progress-group">
                      Pending
                       <?php
                        
                        // $a=date("m");
                        // $time = strtotime("2022-$a-2");
                        // $tg=date("h:i:s A");
                        // $final = date("Y-m-d", strtotime("-1 month",$time));
                        
                        // $fail=$con->query("SELECT SUM(AMOUNT) FROM dmt_transactions WHERE STATUS='failed' AND date(FILTER_DATE) BETWEEN '$final' and '$time'");
                        $total_pending = $con->query("SELECT COUNT(*) AS `count` FROM `dmt_transactions` WHERE STATUS='PENDING'")->fetch_assoc();
                        $count_pending = $total_pending['count'];
                        
                        $total_transaction = $con->query("SELECT COUNT(*) AS `count` FROM `dmt_transactions`")->fetch_assoc();
                        $count = $total_transaction['count'];
                        
                        ?>
                       
                      <span class="float-right"><b><?php echo $count_pending ?></b>/<?php echo $count ?></span>
                      <div class="progress progress-sm">
                       <?php
                       $current1=$count_pending;
                       $total1=$count;
                       
                       $cal=round(($current1/$total1)*100,2);
                       ?>   
                        <div class="progress-bar bg-warning" style="width: <?php echo $cal?>%"></div>
                        
                      </div>
                    
                    </div>
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                     
                     
                     
                     
                     
                     
                     
                     
                     
                     
                     
                    <!--<div class="progress-group">-->
                    <!--  Pending-->
                    <!--  <span class="float-right"><b>250</b>/500</span>-->
                    <!--  <div class="progress progress-sm">-->
                    <!--    <div class="progress-bar bg-warning" style="width: 50%"></div>-->
                    <!--  </div>-->
                    <!--</div>-->
                    
                    <!-- /.progress-group -->

                    <div class="progress-group">
                        
                        
                      Failed
                      <span class="float-right">
                      <?php
                        
                        // $a=date("m");
                        // $time = strtotime("2022-$a-2");
                        // $tg=date("h:i:s A");
                        // $final = date("Y-m-d", strtotime("-1 month",$time));
                        
                        // $fail=$con->query("SELECT SUM(AMOUNT) FROM dmt_transactions WHERE STATUS='failed' AND date(FILTER_DATE) BETWEEN '$final' and '$time'");
                        $total_failed = $con->query("SELECT COUNT(*) AS `count` FROM `dmt_transactions` WHERE STATUS='Failed'")->fetch_assoc();
                        $count_failed = $total_failed['count'];
                        
                        $total_transaction = $con->query("SELECT COUNT(*) AS `count` FROM `dmt_transactions`")->fetch_assoc();
                        $count = $total_transaction['count'];
                        
                        ?>
                        </span>
                      <span class="float-right"><b><?php echo $count_failed?></b>/<?php echo $count?></span>
                      <div class="progress progress-sm">
                       <?php
                       $first=$count_failed;
                       $second=$count;
                       
                       $cal=round(($first/$second)*100,2);
                       ?>   
                        <div class="progress-bar bg-danger" style="width: <?php echo $cal?>%"></div>
                        
                      </div>
                    
                    </div>
    
                    <!-- /.progress-group -->

                   
                 
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
                   $todayrc = $con->query("SELECT FORMAT(IFNULL(SUM(AMOUNT),0),2)tamt FROM `recharge_transaction` WHERE date(FILTER_DATE) = '$tdate'")->fetch_assoc();
                   ?>Today <b style="float:right">₹<?php echo $todayrc['tamt']; ?></b></span>
                <span class="info-box-number">Monthly <?php
                   
                   $mdate = date("Y-m-d",strtotime("-1 month"));
                //   echo $mdate; 
                //   echo $tdate;
                   $mdayrc= $con->query("SELECT FORMAT(IFNULL(SUM(AMOUNT),0),2)tamtmo FROM `recharge_transaction` WHERE date(FILTER_DATE) between '$mdate' AND '$tdate'")->fetch_assoc();
                   ?><b style="float:right">₹<?php echo $mdayrc['tamtmo'];?></b></span>
                <span class="info-box-number">Yearly <?php
                   
                   $ydate = date("Y-m-d",strtotime("-1 year"));
                //   echo $ydate;
                $ydayrc= $con->query("SELECT FORMAT(IFNULL(SUM(AMOUNT),0),2)tamtyea FROM `recharge_transaction` WHERE date(FILTER_DATE) between '$ydate' AND '$tdate'")->fetch_assoc();
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
                $todayaeps = $con->query("SELECT FORMAT(IFNULL(SUM(AMOUNT),0),2)tamt FROM aeps_transactions WHERE TRANS_TYPE='CW' AND STATUS='Success,AEPS Transaction Success' AND date(FILTER_DATE) = '$tdate'")->fetch_assoc();                   
                ?>Today <b style="float:right">₹<?php echo $todayaeps['tamt']; ?></b></span>
                <span class="info-box-number">Monthly <?php
                   
                   $mdate = date("Y-m-d",strtotime("-1 month"));
                //   echo $mdate; 
                //   echo $tdate;
                   $mdayrc= $con->query("SELECT FORMAT(IFNULL(SUM(AMOUNT),0),2)tamtmo FROM `aeps_transactions` WHERE TRANS_TYPE='CW' AND STATUS='Success,AEPS Transaction Success' AND date(FILTER_DATE) between '$mdate' AND '$tdate'")->fetch_assoc();
                   ?><b style="float:right">₹<?php echo $mdayrc['tamtmo'];?></b></span>
                <span class="info-box-number">Yearly <?php
                   
                   $ydate = date("Y-m-d",strtotime("-1 year"));
                //   echo $ydate;
                $ydayrc= $con->query("SELECT FORMAT(IFNULL(SUM(AMOUNT),0),2)tamtyea FROM `aeps_transactions` WHERE TRANS_TYPE='CW' AND STATUS='Success,AEPS Transaction Success' AND date(FILTER_DATE) between '$ydate' AND '$tdate'")->fetch_assoc();                   
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
                $todayaeps = $con->query("SELECT FORMAT(IFNULL(SUM(AMOUNT),0),2)tamt FROM aeps_transactions WHERE TRANS_TYPE='M' AND STATUS='Success,AEPS Transaction Success' AND date(FILTER_DATE) = '$tdate'")->fetch_assoc();
                   ?>Today <b style="float:right">₹<?php echo $todayaeps['tamt']; ?></b></span>
                <span class="info-box-number">Monthly <?php
                   
                   $mdate = date("Y-m-d",strtotime("-1 month"));
                //   echo $mdate; 
                //   echo $tdate;
                   $mdayrc= $con->query("SELECT FORMAT(IFNULL(SUM(AMOUNT),0),2)tamtmo FROM `aeps_transactions` WHERE TRANS_TYPE='M' AND STATUS='Success,AEPS Transaction Success' AND date(FILTER_DATE) between '$mdate' AND '$tdate'")->fetch_assoc();
                   ?><b style="float:right">₹<?php echo $mdayrc['tamtmo'];?></b></span>
                <span class="info-box-number">Yearly<?php
                   
                   $ydate = date("Y-m-d",strtotime("-1 year"));
                //   echo $ydate;
                $ydayrc= $con->query("SELECT FORMAT(IFNULL(SUM(AMOUNT),0),2)tamtyea FROM `aeps_transactions` WHERE TRANS_TYPE='M' AND STATUS='Success,AEPS Transaction Success' AND date(FILTER_DATE) between '$ydate' AND '$tdate'")->fetch_assoc();
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
                 $todaydmt = $con->query("SELECT FORMAT(IFNULL(SUM(AMOUNT),0),2)tamt FROM dmt_transactions WHERE date(TIMESTAMP) = '$tdate'")->fetch_assoc();
                   ?>Today <b style="float:right">₹<?php echo $todaydmt['tamt']; ?></b></span>
                <span class="info-box-number">Monthly <?php
                   
                   $mdate = date("Y-m-d",strtotime("-1 month"));
                //   echo $mdate; 
                //   echo $tdate;
                   $mdayrc= $con->query("SELECT FORMAT(IFNULL(SUM(AMOUNT),0),2)tamtmo FROM `dmt_transactions` WHERE date(TIMESTAMP) between '$mdate' AND '$tdate'")->fetch_assoc();
                   ?><b style="float:right">₹<?php echo $mdayrc['tamtmo'];?></b></span>
                <span class="info-box-number">Yearly<?php
                   
                   $ydate = date("Y-m-d",strtotime("-1 year"));
                //   echo $ydate;
                $ydayrc= $con->query("SELECT FORMAT(IFNULL(SUM(AMOUNT),0),2)tamtyea FROM `dmt_transactions` WHERE date(TIMESTAMP) between '$ydate' AND '$tdate'")->fetch_assoc();
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
         <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <!--<span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>-->

              <div class="info-box-content">
                <span class="info-box-text">Subscription </span>
                <span class="info-box-number"><?php
                   $tdate = date("Y-m-d");
                //   $todayrc = $con->query("SELECT FORMAT(IFNULL(SUM(AMOUNT),0),2)tamt FROM `recharge_transaction` WHERE date(FILTER_DATE) = '$tdate'")->fetch_assoc();
                   ?>Today <b style="float:right">₹<?php echo $todayrc['tamt']; ?></b></span>
                <span class="info-box-number">Monthly <?php
                   
                   $mdate = date("Y-m-d",strtotime("-1 month"));
                //   echo $mdate; 
                //   echo $tdate;
                //   $mdayrc= $con->query("SELECT FORMAT(IFNULL(SUM(AMOUNT),0),2)tamtmo FROM `recharge_transaction` WHERE date(FILTER_DATE) between '$mdate' AND '$tdate'")->fetch_assoc();
                   ?><b style="float:right">₹<?php echo $mdayrc['tamtmo'];?></b></span>
                <span class="info-box-number">Total <?php
                   
                   $ydate = date("Y-m-d",strtotime("-1 year"));
                //   echo $ydate;
                // $ydayrcc= $con->query("SELECT FORMAT(IFNULL(SUM(AMOUNT),0),2)tamtyea FROM `recharge_transaction` WHERE date(FILTER_DATE) between '$ydate' AND '$tdate'")->fetch_assoc();
                   ?><b style="float:right">₹<?php echo $ydayrcc['tamtyea'];?>0</b></span>
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
                <span class="info-box-text">Today Join User </span>
                <span class="info-box-number"><?php
                   $tdate = date("Y-m-d");
                //   $todayrc = $con->query("SELECT FORMAT(IFNULL(SUM(AMOUNT),0),2)tamt FROM `recharge_transaction` WHERE date(FILTER_DATE) = '$tdate'")->fetch_assoc();
                   ?>Today <b style="float:right">₹<?php echo $todayrc['tamt']; ?></b></span>
             
               
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
                <span class="info-box-text">All User </span>
                 <span class="info-box-number"><?php
                   $tdate = date("Y-m-d");
                   $todayrc = $con->query("SELECT COUNT(ID)id,FORMAT(IFNULL(SUM(MAIN_BAL),0),2)mbal,FORMAT(IFNULL(SUM(AEPS_BAL),0),2)abal FROM `user`")->fetch_assoc();
                   ?><?php echo $todayrc['id']; ?></span>
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
                <span class="info-box-text">All Retailer</span>
                <span class="info-box-number">
                            <?php 
                                $todayrc = $con->query("SELECT COUNT(ID)id,FORMAT(IFNULL(SUM(MAIN_BAL),0),2)mbal,FORMAT(IFNULL(SUM(AEPS_BAL),0),2)abal FROM `user` WHERE USER_TYPE='46'")->fetch_assoc();
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
         <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <!--<span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>-->

              <div class="info-box-content">
                                  <span class="info-box-text">Master Distributor </span>

                <span class="info-box-number"><?php
                   $tdate = date("Y-m-d");
                   $todayrc = $con->query("SELECT COUNT(ID)id,FORMAT(IFNULL(SUM(MAIN_BAL),0),2)mbal,FORMAT(IFNULL(SUM(AEPS_BAL),0),2)abal FROM `user` WHERE USER_TYPE='48'")->fetch_assoc();
                   ?><?php echo $todayrc['id']; ?></span>
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
                <span class="info-box-text">Total Wallet Amount </span>
                 <span class="info-box-number"><?php
                   $tdate = date("Y-m-d");
                   $todayrc = $con->query("SELECT COUNT(ID)id,FORMAT(IFNULL(SUM(MAIN_BAL),0),2)mbal,FORMAT(IFNULL(SUM(AEPS_BAL),0),2)abal FROM `user`")->fetch_assoc();
                   
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
                    $todayrc = $con->query("SELECT COUNT(ID)id,FORMAT(IFNULL(SUM(MAIN_BAL),0),2)mbal,FORMAT(IFNULL(SUM(AEPS_BAL),0),2)abal FROM `user` WHERE USER_TYPE = '46'")->fetch_assoc();
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
         <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <!--<span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>-->

              <div class="info-box-content">
                <span class="info-box-text">Master Wallet Amount </span>
                <span class="info-box-number"><?php
                        $tdate = date("Y-m-d");
                        $todayrc = $con->query("SELECT COUNT(ID)id,FORMAT(IFNULL(SUM(MAIN_BAL),0),2)mbal,FORMAT(IFNULL(SUM(AEPS_BAL),0),2)abal FROM `user` WHERE USER_TYPE = '48'")->fetch_assoc();
                    ?>   <h6> Main Wallet : ₹ <?php echo $todayrc['mbal']; ?></h6>
                         <h6> Aeps Wallet : ₹ <?php echo $todayrc['abal']; ?></h6>
              </div>
             <!--<i class="fas fa-users"></i>-->
             <!-- <i class="fas fa-users">-->
               <!--/.info-box-content -->
            </div>
             <!--/.info-box -->
          </div>
          
         
          
          <!-- /.col -->
          
        </div>
        <!-- /.row -->
        </section>
        
        
        
        
        
       

        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <div class="col-md-8">
            <!-- MAP & BOX PANE -->
            <!--<div class="card">-->
            <!--  <div class="card-header">-->
            <!--    <h3 class="card-title">Indian Member</h3>-->

            <!--    <div class="card-tools">-->
            <!--      <button type="button" class="btn btn-tool" data-card-widget="collapse">-->
            <!--        <i class="fas fa-minus"></i>-->
            <!--      </button>-->
            <!--      <button type="button" class="btn btn-tool" data-card-widget="remove">-->
            <!--        <i class="fas fa-times"></i>-->
            <!--      </button>-->
            <!--    </div>-->
            <!--  </div>-->
              <!-- /.card-header -->
            <!--  <div class="card-body p-0">-->
            <!--    <div class="d-md-flex">-->
            <!--      <div class="p-1 flex-fill" style="overflow: hidden">-->
                    <!-- Map will be created here -->
            <!--        <div id="world-map-markers" style="height: 325px; overflow: hidden">-->
            <!--          <div class="map"></div>-->
            <!--        </div>-->
            <!--      </div>-->
            <!--      <div class="card-pane-right bg-success pt-2 pb-2 pl-4 pr-4">-->
            <!--        <div class="description-block mb-4">-->
            <!--          <div class="sparkbar pad" data-color="#fff">905745</div>-->
            <!--          <h5 class="description-header">80</h5>-->
            <!--          <span class="description-text">Total User</span>-->
            <!--        </div>-->
                    <!-- /.description-block -->
            <!--        <div class="description-block mb-4">-->
            <!--          <div class="sparkbar pad" data-color="#fff">905445</div>-->
            <!--          <h5 class="description-header">30%</h5>-->
            <!--          <span class="description-text">Retailer</span>-->
            <!--        </div>-->
                    <!-- /.description-block -->
            <!--        <div class="description-block">-->
            <!--          <div class="sparkbar pad" data-color="#fff">90,5045</div>-->
            <!--          <h5 class="description-header">70%</h5>-->
            <!--          <span class="description-text">Distributor</span>-->
            <!--        </div>-->
                    <!-- /.description-block -->
            <!--        <div class="description-block">-->
            <!--          <div class="sparkbar pad" data-color="#fff">90,5045</div>-->
            <!--          <h5 class="description-header">70%</h5>-->
            <!--          <span class="description-text">Employee</span>-->
            <!--        </div>-->
                    <!-- /.description-block -->
            <!--      </div><!-- /.card-pane-right -->
            <!--    </div><!-- /.d-md-flex -->
            <!--  </div>-->
              <!-- /.card-body -->
            <!--</div>-->
            <!-- /.card -->
            <!--<div class="row">-->
            <!--  <div class="col-md-6">-->
                <!-- Task Board -->
            <!--    <div class="card direct-chat direct-chat-warning">-->
            <!--      <div class="card-header">-->
            <!--        <h3 class="card-title">Task Board</h3>-->

            <!--        <div class="card-tools">-->
            <!--          <span title="3 New Messages" class="badge badge-warning">3</span>-->
            <!--          <button type="button" class="btn btn-tool" data-card-widget="collapse">-->
            <!--            <i class="fas fa-minus"></i>-->
            <!--          </button>-->
            <!--          <button type="button" class="btn btn-tool" title="Contacts" data-widget="chat-pane-toggle">-->
            <!--            <i class="fas fa-comments"></i>-->
            <!--          </button>-->
            <!--          <button type="button" class="btn btn-tool" data-card-widget="remove">-->
            <!--            <i class="fas fa-times"></i>-->
            <!--          </button>-->
            <!--        </div>-->
            <!--      </div>-->
                  <!-- /.card-header -->
            <!--      <div class="card-body">-->
                    <!-- Conversations are loaded here -->
            <!--        <div class="direct-chat-messages">-->
                      <!-- Message. Default to the left -->
            <!--          <div class="direct-chat-msg">-->
            <!--            <div class="direct-chat-infos clearfix">-->
            <!--              <span class="direct-chat-name float-left">Alexander Pierce</span>-->
            <!--              <span class="direct-chat-timestamp float-right">23 Jan 2:00 pm</span>-->
            <!--            </div>-->
                        <!-- /.direct-chat-infos -->
            <!--            <img class="direct-chat-img" src="dist/img/user1-128x128.jpg" alt="message user image">-->
                        <!-- /.direct-chat-img -->
            <!--            <div class="direct-chat-text">-->
            <!--              Is this template really for free? That's unbelievable!-->
            <!--            </div>-->
                        <!-- /.direct-chat-text -->
            <!--          </div>-->
                      <!-- /.direct-chat-msg -->

                      <!-- Message to the right -->
            <!--          <div class="direct-chat-msg right">-->
            <!--            <div class="direct-chat-infos clearfix">-->
            <!--              <span class="direct-chat-name float-right">Sarah Bullock</span>-->
            <!--              <span class="direct-chat-timestamp float-left">23 Jan 2:05 pm</span>-->
            <!--            </div>-->
                        <!-- /.direct-chat-infos -->
            <!--            <img class="direct-chat-img" src="dist/img/user3-128x128.jpg" alt="message user image">-->
                        <!-- /.direct-chat-img -->
            <!--            <div class="direct-chat-text">-->
            <!--              You better believe it!-->
            <!--            </div>-->
                        <!-- /.direct-chat-text -->
            <!--          </div>-->
                      <!-- /.direct-chat-msg -->

                      <!-- Message. Default to the left -->
            <!--          <div class="direct-chat-msg">-->
            <!--            <div class="direct-chat-infos clearfix">-->
            <!--              <span class="direct-chat-name float-left">Alexander Pierce</span>-->
            <!--              <span class="direct-chat-timestamp float-right">23 Jan 5:37 pm</span>-->
            <!--            </div>-->
                        <!-- /.direct-chat-infos -->
            <!--            <img class="direct-chat-img" src="dist/img/user1-128x128.jpg" alt="message user image">-->
                        <!-- /.direct-chat-img -->
            <!--            <div class="direct-chat-text">-->
            <!--              Working with AdminLTE on a great new app! Wanna join?-->
            <!--            </div>-->
                        <!-- /.direct-chat-text -->
            <!--          </div>-->
                      <!-- /.direct-chat-msg -->

                      <!-- Message to the right -->
            <!--          <div class="direct-chat-msg right">-->
            <!--            <div class="direct-chat-infos clearfix">-->
            <!--              <span class="direct-chat-name float-right">Sarah Bullock</span>-->
            <!--              <span class="direct-chat-timestamp float-left">23 Jan 6:10 pm</span>-->
            <!--            </div>-->
                        <!-- /.direct-chat-infos -->
            <!--            <img class="direct-chat-img" src="dist/img/user3-128x128.jpg" alt="message user image">-->
                        <!-- /.direct-chat-img -->
            <!--            <div class="direct-chat-text">-->
            <!--              I would love to.-->
            <!--            </div>-->
                        <!-- /.direct-chat-text -->
            <!--          </div>-->
                      <!-- /.direct-chat-msg -->

            <!--        </div>-->
                    <!--/.direct-chat-messages-->

                    <!-- Contacts are loaded here -->
            <!--        <div class="direct-chat-contacts">-->
            <!--          <ul class="contacts-list">-->
            <!--            <li>-->
            <!--              <a href="#">-->
            <!--                <img class="contacts-list-img" src="dist/img/user1-128x128.jpg" alt="User Avatar">-->

            <!--                <div class="contacts-list-info">-->
            <!--                  <span class="contacts-list-name">-->
            <!--                    Count Dracula-->
            <!--                    <small class="contacts-list-date float-right">2/28/2015</small>-->
            <!--                  </span>-->
            <!--                  <span class="contacts-list-msg">How have you been? I was...</span>-->
            <!--                </div>-->
                            <!-- /.contacts-list-info -->
            <!--              </a>-->
            <!--            </li>-->
                        <!-- End Contact Item -->
            <!--            <li>-->
            <!--              <a href="#">-->
            <!--                <img class="contacts-list-img" src="dist/img/user7-128x128.jpg" alt="User Avatar">-->

            <!--                <div class="contacts-list-info">-->
            <!--                  <span class="contacts-list-name">-->
            <!--                    Sarah Doe-->
            <!--                    <small class="contacts-list-date float-right">2/23/2015</small>-->
            <!--                  </span>-->
            <!--                  <span class="contacts-list-msg">I will be waiting for...</span>-->
            <!--                </div>-->
                            <!-- /.contacts-list-info -->
            <!--              </a>-->
            <!--            </li>-->
                        <!-- End Contact Item -->
            <!--            <li>-->
            <!--              <a href="#">-->
            <!--                <img class="contacts-list-img" src="dist/img/user3-128x128.jpg" alt="User Avatar">-->

            <!--                <div class="contacts-list-info">-->
            <!--                  <span class="contacts-list-name">-->
            <!--                    Nadia Jolie-->
            <!--                    <small class="contacts-list-date float-right">2/20/2015</small>-->
            <!--                  </span>-->
            <!--                  <span class="contacts-list-msg">I'll call you back at...</span>-->
            <!--                </div>-->
                            <!-- /.contacts-list-info -->
            <!--              </a>-->
            <!--            </li>-->
                        <!-- End Contact Item -->
            <!--            <li>-->
            <!--              <a href="#">-->
            <!--                <img class="contacts-list-img" src="dist/img/user5-128x128.jpg" alt="User Avatar">-->

            <!--                <div class="contacts-list-info">-->
            <!--                  <span class="contacts-list-name">-->
            <!--                    Nora S. Vans-->
            <!--                    <small class="contacts-list-date float-right">2/10/2015</small>-->
            <!--                  </span>-->
            <!--                  <span class="contacts-list-msg">Where is your new...</span>-->
            <!--                </div>-->
                            <!-- /.contacts-list-info -->
            <!--              </a>-->
            <!--            </li>-->
                        <!-- End Contact Item -->
            <!--            <li>-->
            <!--              <a href="#">-->
            <!--                <img class="contacts-list-img" src="dist/img/user6-128x128.jpg" alt="User Avatar">-->

            <!--                <div class="contacts-list-info">-->
            <!--                  <span class="contacts-list-name">-->
            <!--                    John K.-->
            <!--                    <small class="contacts-list-date float-right">1/27/2015</small>-->
            <!--                  </span>-->
            <!--                  <span class="contacts-list-msg">Can I take a look at...</span>-->
            <!--                </div>-->
                            <!-- /.contacts-list-info -->
            <!--              </a>-->
            <!--            </li>-->
                        <!-- End Contact Item -->
            <!--            <li>-->
            <!--              <a href="#">-->
            <!--                <img class="contacts-list-img" src="dist/img/user8-128x128.jpg" alt="User Avatar">-->

            <!--                <div class="contacts-list-info">-->
            <!--                  <span class="contacts-list-name">-->
            <!--                    Kenneth M.-->
            <!--                    <small class="contacts-list-date float-right">1/4/2015</small>-->
            <!--                  </span>-->
            <!--                  <span class="contacts-list-msg">Never mind I found...</span>-->
            <!--                </div>-->
                            <!-- /.contacts-list-info -->
            <!--              </a>-->
            <!--            </li>-->
                        <!-- End Contact Item -->
            <!--          </ul>-->
                      <!-- /.contacts-list -->
            <!--        </div>-->
                    <!-- /.direct-chat-pane -->
            <!--      </div>-->
                  <!-- /.card-body -->
            <!--      <div class="card-footer">-->
            <!--        <form action="#" method="post">-->
            <!--          <div class="input-group">-->
            <!--            <input type="text" name="message" placeholder="Type Message ..." class="form-control">-->
            <!--            <span class="input-group-append">-->
            <!--              <button type="button" class="btn btn-warning">Send</button>-->
            <!--            </span>-->
            <!--          </div>-->
            <!--        </form>-->
            <!--      </div>-->
                  <!-- /.card-footer-->
            <!--    </div>-->
                <!--/.direct-chat -->
            <!--  </div>-->
              <!-- /.col -->

            <!--  <div class="col-md-6">-->
                <!-- USERS LIST -->
            <!--    <div class="card">-->
            <!--      <div class="card-header">-->
            <!--        <h3 class="card-title">Top Employee</h3>-->

            <!--        <div class="card-tools">-->
            <!--          <span class="badge badge-danger">8 New Members</span>-->
            <!--          <button type="button" class="btn btn-tool" data-card-widget="collapse">-->
            <!--            <i class="fas fa-minus"></i>-->
            <!--          </button>-->
            <!--          <button type="button" class="btn btn-tool" data-card-widget="remove">-->
            <!--            <i class="fas fa-times"></i>-->
            <!--          </button>-->
            <!--        </div>-->
            <!--      </div>-->
                  <!-- /.card-header -->
            <!--      <div class="card-body p-0">-->
            <!--        <ul class="users-list clearfix">-->
            <!--          <li>-->
            <!--            <img src="dist/img/user1-128x128.jpg" alt="User Image">-->
            <!--            <a class="users-list-name" href="#">Alexander Pierce</a>-->
            <!--            <span class="users-list-date">6289195314</span>-->
            <!--          </li>-->
            <!--          <li>-->
            <!--            <img src="dist/img/user8-128x128.jpg" alt="User Image">-->
            <!--            <a class="users-list-name" href="#">Norman</a>-->
            <!--            <span class="users-list-date"><a href="tel:6289195314">6289195314</a></span>-->
            <!--          </li>-->
            <!--          <li>-->
            <!--            <img src="dist/img/user7-128x128.jpg" alt="User Image">-->
            <!--            <a class="users-list-name" href="#">Jane</a>-->
            <!--            <span class="users-list-date">12 Jan</span>-->
            <!--          </li>-->
            <!--          <li>-->
            <!--            <img src="dist/img/user6-128x128.jpg" alt="User Image">-->
            <!--            <a class="users-list-name" href="#">John</a>-->
            <!--            <span class="users-list-date">12 Jan</span>-->
            <!--          </li>-->
            <!--          <li>-->
            <!--            <img src="dist/img/user2-160x160.jpg" alt="User Image">-->
            <!--            <a class="users-list-name" href="#">Alexander</a>-->
            <!--            <span class="users-list-date">13 Jan</span>-->
            <!--          </li>-->
            <!--          <li>-->
            <!--            <img src="dist/img/user5-128x128.jpg" alt="User Image">-->
            <!--            <a class="users-list-name" href="#">Sarah</a>-->
            <!--            <span class="users-list-date">14 Jan</span>-->
            <!--          </li>-->
            <!--          <li>-->
            <!--            <img src="dist/img/user4-128x128.jpg" alt="User Image">-->
            <!--            <a class="users-list-name" href="#">Nora</a>-->
            <!--            <span class="users-list-date">15 Jan</span>-->
            <!--          </li>-->
            <!--          <li>-->
            <!--            <img src="dist/img/user3-128x128.jpg" alt="User Image">-->
            <!--            <a class="users-list-name" href="#">Nadia</a>-->
            <!--            <span class="users-list-date">15 Jan</span>-->
            <!--          </li>-->
            <!--        </ul>-->
                    <!-- /.users-list -->
            <!--      </div>-->
                  <!-- /.card-body -->
            <!--      <div class="card-footer text-center">-->
            <!--        <a href="javascript:">View All Users</a>-->
            <!--      </div>-->
                  <!-- /.card-footer -->
            <!--    </div>-->
                <!--/.card -->
            <!--  </div>-->
              <!-- /.col -->
            <!--</div>-->
            <!-- /.row -->

            <!-- /.card -->
          </div>
          <!-- /.col -->

          <div class="col-md-4">
            <!-- Info Boxes Style 2 -->
            
            <!--<div class="card">-->
            <!--  <div class="card-header">-->
            <!--    <h3 class="card-title">Services Usage</h3>-->

            <!--    <div class="card-tools">-->
            <!--      <button type="button" class="btn btn-tool" data-card-widget="collapse">-->
            <!--        <i class="fas fa-minus"></i>-->
            <!--      </button>-->
            <!--      <button type="button" class="btn btn-tool" data-card-widget="remove">-->
            <!--        <i class="fas fa-times"></i>-->
            <!--      </button>-->
            <!--    </div>-->
            <!--  </div>-->
              <!-- /.card-header -->
            <!--  <div class="card-body">-->
            <!--    <div class="row">-->
            <!--      <div class="col-md-8">-->
            <!--        <div class="chart-responsive">-->
            <!--          <canvas id="pieChart" height="150"></canvas>-->
            <!--        </div>-->
                    <!-- ./chart-responsive -->
            <!--      </div>-->
                  <!-- /.col -->
            <!--      <div class="col-md-4">-->
            <!--        <ul class="chart-legend clearfix">-->
            <!--          <li><i class="far fa-circle text-danger"></i> AePs</li>-->
            <!--          <li><i class="far fa-circle text-success"></i> DMT</li>-->
            <!--          <li><i class="far fa-circle text-warning"></i> M-ATM</li>-->
            <!--          <li><i class="far fa-circle text-info"></i> Recharge & DTH</li>-->
            <!--          <li><i class="far fa-circle text-primary"></i> BBPS</li>-->
            <!--          <li><i class="far fa-circle text-secondary"></i> Other Service</li>-->
            <!--        </ul>-->
            <!--      </div>-->
                  <!-- /.col -->
            <!--    </div>-->
                <!-- /.row -->
            <!--  </div>-->
              <!-- /.card-body -->
            <!--  <div class="card-footer p-0">-->
            <!--    <ul class="nav nav-pills flex-column">-->
            <!--      <li class="nav-item">-->
            <!--        <a href="#" class="nav-link">-->
            <!--          AePs-->
            <!--          <span class="float-right text-danger">-->
            <!--            <i class="fas fa-arrow-down text-sm"></i>-->
            <!--            12%</span>-->
            <!--        </a>-->
            <!--      </li>-->
            <!--      <li class="nav-item">-->
            <!--        <a href="#" class="nav-link">-->
            <!--          DMT-->
            <!--          <span class="float-right text-success">-->
            <!--            <i class="fas fa-arrow-up text-sm"></i> 4%-->
            <!--          </span>-->
            <!--        </a>-->
            <!--      </li>-->
            <!--      <li class="nav-item">-->
            <!--        <a href="#" class="nav-link">-->
            <!--          M-ATM-->
            <!--          <span class="float-right text-warning">-->
            <!--            <i class="fas fa-arrow-left text-sm"></i> 0%-->
            <!--          </span>-->
            <!--        </a>-->
            <!--      </li>-->
            <!--    </ul>-->
            <!--  </div>-->
              <!-- /.footer -->
            <!--</div>-->
            <!-- /.card -->

            <!-- PRODUCT LIST -->
            <!--<div class="card">-->
            <!--  <div class="card-header">-->
            <!--    <h3 class="card-title">News & Notification</h3>-->

            <!--    <div class="card-tools">-->
            <!--      <button type="button" class="btn btn-tool" data-card-widget="collapse">-->
            <!--        <i class="fas fa-minus"></i>-->
            <!--      </button>-->
            <!--      <button type="button" class="btn btn-tool" data-card-widget="remove">-->
            <!--        <i class="fas fa-times"></i>-->
            <!--      </button>-->
            <!--    </div>-->
            <!--  </div>-->
              <!-- /.card-header -->
            <!--  <div class="card-body p-0">-->
            <!--    <ul class="products-list product-list-in-card pl-2 pr-2">-->
            <!--      <li class="item">-->
            <!--        <div class="product-img">-->
            <!--          <img src="dist/img/default-150x150.png" alt="Product Image" class="img-size-50">-->
            <!--        </div>-->
            <!--        <div class="product-info">-->
            <!--          <a href="javascript:void(0)" class="product-title">Samsung TV-->
            <!--            <span class="badge badge-warning float-right">₹1800</span></a>-->
            <!--          <span class="product-description">-->
            <!--            Samsung 32" 1080p 60Hz LED Smart HDTV.-->
            <!--          </span>-->
            <!--        </div>-->
            <!--      </li>-->
                  <!-- /.item -->
            <!--      <li class="item">-->
            <!--        <div class="product-img">-->
            <!--          <img src="dist/img/default-150x150.png" alt="Product Image" class="img-size-50">-->
            <!--        </div>-->
            <!--        <div class="product-info">-->
            <!--          <a href="javascript:void(0)" class="product-title">Bicycle-->
            <!--            <span class="badge badge-info float-right">₹700</span></a>-->
            <!--          <span class="product-description">-->
            <!--            26" Mongoose Dolomite Men's 7-speed, Navy Blue.-->
            <!--          </span>-->
            <!--        </div>-->
            <!--      </li>-->
                  <!-- /.item -->
            <!--      <li class="item">-->
            <!--        <div class="product-img">-->
            <!--          <img src="dist/img/default-150x150.png" alt="Product Image" class="img-size-50">-->
            <!--        </div>-->
            <!--        <div class="product-info">-->
            <!--          <a href="javascript:void(0)" class="product-title">-->
            <!--            Xbox One <span class="badge badge-danger float-right">-->
            <!--            ₹350-->
            <!--          </span>-->
            <!--          </a>-->
            <!--          <span class="product-description">-->
            <!--            Xbox One Console Bundle with Halo Master Chief Collection.-->
            <!--          </span>-->
            <!--        </div>-->
            <!--      </li>-->
                  <!-- /.item -->
            <!--      <li class="item">-->
            <!--        <div class="product-img">-->
            <!--          <img src="dist/img/default-150x150.png" alt="Product Image" class="img-size-50">-->
            <!--        </div>-->
            <!--        <div class="product-info">-->
            <!--          <a href="javascript:void(0)" class="product-title">PlayStation 4-->
            <!--            <span class="badge badge-success float-right">₹399</span></a>-->
            <!--          <span class="product-description">-->
            <!--            PlayStation 4 500GB Console (PS4)-->
            <!--          </span>-->
            <!--        </div>-->
            <!--      </li>-->
                  <!-- /.item -->
            <!--    </ul>-->
            <!--  </div>-->
              <!-- /.card-body -->
            <!--  <div class="card-footer text-center">-->
            <!--    <a href="javascript:void(0)" class="uppercase">View All Products</a>-->
            <!--  </div>-->
              <!-- /.card-footer -->
            <!--</div>-->
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
        
        
          <div class="row">
          <div class="col-md-6">
            <!--<div class="card">-->
            <!--  <div class="card-header">-->
            <!--    <h5 class="card-title">Top 100 Retailer</h5>-->

            <!--    <div class="card-tools">-->
            <!--      <button type="button" class="btn btn-tool" data-card-widget="collapse">-->
            <!--        <i class="fas fa-minus"></i>-->
            <!--      </button>-->
            <!--      <div class="btn-group">-->
            <!--        <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown">-->
            <!--          <i class="fas fa-filter"></i>-->
            <!--        </button>-->
            <!--        <div class="dropdown-menu dropdown-menu-right" role="menu">-->
            <!--          <a href="#" class="dropdown-item">Today</a>-->
            <!--          <a href="#" class="dropdown-item">Weekly</a>-->
            <!--          <a href="#" class="dropdown-item">Monthly</a>-->
            <!--          <a href="#" class="dropdown-item">Yearly</a>-->
            <!--          <a class="dropdown-divider"></a>-->
            <!--          <a href="#" class="dropdown-item">Customer Date</a>-->
            <!--        </div>-->
            <!--      </div>-->
            <!--      <button type="button" class="btn btn-tool" data-card-widget="remove">-->
            <!--        <i class="fas fa-times"></i>-->
            <!--      </button>-->
            <!--    </div>-->
            <!--  </div>-->
              
                <!-- USERS LIST -->
                
                <!-- /.card-header -->
            <!--    <div class="card-body p-0">-->
            <!--    <div class="table-responsive">-->
            <!--      <table class="table m-0">-->
            <!--        <thead>-->
            <!--        <tr>-->
            <!--          <th>Order ID</th>-->
            <!--          <th>Item</th>-->
            <!--          <th>Status</th>-->
            <!--          <th>Popularity</th>-->
            <!--        </tr>-->
            <!--        </thead>-->
            <!--        <tbody>-->
            <!--        <tr>-->
            <!--          <td><a href="pages/examples/invoice.html">OR9842</a></td>-->
            <!--          <td>Call of Duty IV</td>-->
            <!--          <td><span class="badge badge-success">Shipped</span></td>-->
            <!--          <td>-->
            <!--            <div class="sparkbar" data-color="#00a65a" data-height="20">90,80,90,-70,61,-83,63</div>-->
            <!--          </td>-->
            <!--        </tr>-->
            <!--        <tr>-->
            <!--          <td><a href="pages/examples/invoice.html">OR1848</a></td>-->
            <!--          <td>Samsung Smart TV</td>-->
            <!--          <td><span class="badge badge-warning">Pending</span></td>-->
            <!--          <td>-->
            <!--            <div class="sparkbar" data-color="#f39c12" data-height="20">90,80,-90,70,61,-83,68</div>-->
            <!--          </td>-->
            <!--        </tr>-->
            <!--        <tr>-->
            <!--          <td><a href="pages/examples/invoice.html">OR7429</a></td>-->
            <!--          <td>iPhone 6 Plus</td>-->
            <!--          <td><span class="badge badge-danger">Delivered</span></td>-->
            <!--          <td>-->
            <!--            <div class="sparkbar" data-color="#f56954" data-height="20">90,-80,90,70,-61,83,63</div>-->
            <!--          </td>-->
            <!--        </tr>-->
            <!--        <tr>-->
            <!--          <td><a href="pages/examples/invoice.html">OR7429</a></td>-->
            <!--          <td>Samsung Smart TV</td>-->
            <!--          <td><span class="badge badge-info">Processing</span></td>-->
            <!--          <td>-->
            <!--            <div class="sparkbar" data-color="#00c0ef" data-height="20">90,80,-90,70,-61,83,63</div>-->
            <!--          </td>-->
            <!--        </tr>-->
            <!--        <tr>-->
            <!--          <td><a href="pages/examples/invoice.html">OR1848</a></td>-->
            <!--          <td>Samsung Smart TV</td>-->
            <!--          <td><span class="badge badge-warning">Pending</span></td>-->
            <!--          <td>-->
            <!--            <div class="sparkbar" data-color="#f39c12" data-height="20">90,80,-90,70,61,-83,68</div>-->
            <!--          </td>-->
            <!--        </tr>-->
            <!--        <tr>-->
            <!--          <td><a href="pages/examples/invoice.html">OR7429</a></td>-->
            <!--          <td>iPhone 6 Plus</td>-->
            <!--          <td><span class="badge badge-danger">Delivered</span></td>-->
            <!--          <td>-->
            <!--            <div class="sparkbar" data-color="#f56954" data-height="20">90,-80,90,70,-61,83,63</div>-->
            <!--          </td>-->
            <!--        </tr>-->
            <!--        <tr>-->
            <!--          <td><a href="pages/examples/invoice.html">OR9842</a></td>-->
            <!--          <td>Call of Duty IV</td>-->
            <!--          <td><span class="badge badge-success">Shipped</span></td>-->
            <!--          <td>-->
            <!--            <div class="sparkbar" data-color="#00a65a" data-height="20">90,80,90,-70,61,-83,63</div>-->
            <!--          </td>-->
            <!--        </tr>-->
            <!--        </tbody>-->
            <!--      </table>-->
            <!--    </div>-->
                <!-- /.table-responsive -->
            <!--  </div>-->
              <!-- /.card-body -->
            <!--  <div class="card-footer clearfix">-->
            <!--    <a href="javascript:void(0)" class="btn btn-sm btn-info float-left">Place New Order</a>-->
            <!--    <a href="javascript:void(0)" class="btn btn-sm btn-secondary float-right">View All Orders</a>-->
            <!--  </div>-->
              <!-- /.card-footer -->
            <!--</div>-->
            <!-- /.card -->
          </div>
          <div class="col-md-6">
            <!--<div class="card">-->
            <!--  <div class="card-header">-->
            <!--    <h5 class="card-title">Top 100 Distributor</h5>-->

            <!--    <div class="card-tools">-->
            <!--      <button type="button" class="btn btn-tool" data-card-widget="collapse">-->
            <!--        <i class="fas fa-minus"></i>-->
            <!--      </button>-->
            <!--      <div class="btn-group">-->
            <!--        <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown">-->
            <!--          <i class="fas fa-filter"></i>-->
            <!--        </button>-->
            <!--        <div class="dropdown-menu dropdown-menu-right" role="menu">-->
            <!--          <a href="#" class="dropdown-item">Today</a>-->
            <!--          <a href="#" class="dropdown-item">Weekly</a>-->
            <!--          <a href="#" class="dropdown-item">Monthly</a>-->
            <!--          <a href="#" class="dropdown-item">Yearly</a>-->
            <!--          <a class="dropdown-divider"></a>-->
            <!--          <a href="#" class="dropdown-item">Customer Date</a>-->
            <!--        </div>-->
            <!--      </div>-->
            <!--      <button type="button" class="btn btn-tool" data-card-widget="remove">-->
            <!--        <i class="fas fa-times"></i>-->
            <!--      </button>-->
            <!--    </div>-->
            <!--  </div>-->
              <!-- /.card-header -->
            <!--  <div class="card-body p-0">-->
            <!--    <div class="table-responsive">-->
            <!--      <table class="table m-0">-->
            <!--        <thead>-->
            <!--        <tr>-->
            <!--          <th>Order ID</th>-->
            <!--          <th>Item</th>-->
            <!--          <th>Status</th>-->
            <!--          <th>Popularity</th>-->
            <!--        </tr>-->
            <!--        </thead>-->
            <!--        <tbody>-->
            <!--        <tr>-->
            <!--          <td><a href="pages/examples/invoice.html">OR9842</a></td>-->
            <!--          <td>Call of Duty IV</td>-->
            <!--          <td><span class="badge badge-success">Shipped</span></td>-->
            <!--          <td>-->
            <!--            <div class="sparkbar" data-color="#00a65a" data-height="20">90,80,90,-70,61,-83,63</div>-->
            <!--          </td>-->
            <!--        </tr>-->
            <!--        <tr>-->
            <!--          <td><a href="pages/examples/invoice.html">OR1848</a></td>-->
            <!--          <td>Samsung Smart TV</td>-->
            <!--          <td><span class="badge badge-warning">Pending</span></td>-->
            <!--          <td>-->
            <!--            <div class="sparkbar" data-color="#f39c12" data-height="20">90,80,-90,70,61,-83,68</div>-->
            <!--          </td>-->
            <!--        </tr>-->
            <!--        <tr>-->
            <!--          <td><a href="pages/examples/invoice.html">OR7429</a></td>-->
            <!--          <td>iPhone 6 Plus</td>-->
            <!--          <td><span class="badge badge-danger">Delivered</span></td>-->
            <!--          <td>-->
            <!--            <div class="sparkbar" data-color="#f56954" data-height="20">90,-80,90,70,-61,83,63</div>-->
            <!--          </td>-->
            <!--        </tr>-->
            <!--        <tr>-->
            <!--          <td><a href="pages/examples/invoice.html">OR7429</a></td>-->
            <!--          <td>Samsung Smart TV</td>-->
            <!--          <td><span class="badge badge-info">Processing</span></td>-->
            <!--          <td>-->
            <!--            <div class="sparkbar" data-color="#00c0ef" data-height="20">90,80,-90,70,-61,83,63</div>-->
            <!--          </td>-->
            <!--        </tr>-->
            <!--        <tr>-->
            <!--          <td><a href="pages/examples/invoice.html">OR1848</a></td>-->
            <!--          <td>Samsung Smart TV</td>-->
            <!--          <td><span class="badge badge-warning">Pending</span></td>-->
            <!--          <td>-->
            <!--            <div class="sparkbar" data-color="#f39c12" data-height="20">90,80,-90,70,61,-83,68</div>-->
            <!--          </td>-->
            <!--        </tr>-->
            <!--        <tr>-->
            <!--          <td><a href="pages/examples/invoice.html">OR7429</a></td>-->
            <!--          <td>iPhone 6 Plus</td>-->
            <!--          <td><span class="badge badge-danger">Delivered</span></td>-->
            <!--          <td>-->
            <!--            <div class="sparkbar" data-color="#f56954" data-height="20">90,-80,90,70,-61,83,63</div>-->
            <!--          </td>-->
            <!--        </tr>-->
            <!--        <tr>-->
            <!--          <td><a href="pages/examples/invoice.html">OR9842</a></td>-->
            <!--          <td>Call of Duty IV</td>-->
            <!--          <td><span class="badge badge-success">Shipped</span></td>-->
            <!--          <td>-->
            <!--            <div class="sparkbar" data-color="#00a65a" data-height="20">90,80,90,-70,61,-83,63</div>-->
            <!--          </td>-->
            <!--        </tr>-->
            <!--        </tbody>-->
            <!--      </table>-->
            <!--    </div>-->
                <!-- /.table-responsive -->
            <!--  </div>-->
              <!-- /.card-body -->
            <!--  <div class="card-footer clearfix">-->
            <!--    <a href="javascript:void(0)" class="btn btn-sm btn-info float-left">Place New Order</a>-->
            <!--    <a href="javascript:void(0)" class="btn btn-sm btn-secondary float-right">View All Orders</a>-->
            <!--  </div>-->
              <!-- /.card-footer -->
            <!--</div>-->
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

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
