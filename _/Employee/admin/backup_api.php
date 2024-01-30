
<?php 
include("../connection/config.php");
    error_reporting(0);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Backup Api</title>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <meta name="keywords" content="bootstrap, bootstrap admin template, admin theme, admin dashboard, dashboard template, admin template, responsive"/>
    <meta name="author" content="Codedthemes" />
    <!-- Favicon icon -->
    <link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700" rel="stylesheet">
    <!-- waves.css -->
    <link rel="stylesheet" href="assets/pages/waves/css/waves.min.css" type="text/css" media="all">
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap/css/bootstrap.min.css">
    <!-- themify-icons line icon -->
    <link rel="stylesheet" type="text/css" href="assets/icon/themify-icons/themify-icons.css">
    <!-- ico font -->
    <link rel="stylesheet" type="text/css" href="assets/icon/icofont/css/icofont.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" type="text/css" href="assets/icon/font-awesome/css/font-awesome.min.css">
    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="assets/css/style.php">
    <link rel="stylesheet" type="text/css" href="assets/css/jquery.mCustomScrollbar.css">

</head>

<body>
    <!-- Pre-loader start -->
       <?php
        include("include/loader.php");
    ?>
    <!-- Pre-loader end -->
    <div id="pcoded" class="pcoded">
        <div class="pcoded-overlay-box"></div>
        <div class="pcoded-container navbar-wrapper">
            <!-- Top header start -->
            <?php
                include("include/topheader.php");
            ?>
                <!-- Top header end -->
            <div class="pcoded-main-container">
                <div class="pcoded-wrapper">
                   <!-- Sidebarlist Start -->
                    <?php
                        include("include/sidebar.php");
                    ?>
                    <!-- Sidebarlist End -->
             
                    <div class="pcoded-content">
                        <!-- Page-header start -->
                        <div class="page-header">
                            <div class="page-block">
                                <div class="row align-items-center">
                                    <div class="col-md-8">
                                        <div class="page-header-title">
                                            <h5 class="m-b-10">Backup Api</h5>
                                            <p class="m-b-0">Dear admin you can customize your Backup Api here</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <ul class="breadcrumb">
                                            <li class="breadcrumb-item">
                                                <a href="index.html"> <i class="fa fa-home"></i> </a>
                                            </li>
                                            <li class="breadcrumb-item"><a href="#!">CMS Manager</a>
                                            </li>
                                            <li class="breadcrumb-item"><a href="#!">Backup Api </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Page-header end -->
                        <div class="pcoded-inner-content">
                            <!-- Main-body start -->
                            <div class="main-body">
                                <div class="page-wrapper">

                                    <!-- Page body start -->
                                    <div class="page-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <!-- Backup Api Table -->
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h5>Backup Api List</h5>
                                                        <span> If Default API Down / Failed This Function Auto Route Your Recharge to Backup API</span>
                                                       
                                                        <div class="card-header-right">
                                                            <ul class="list-unstyled card-option">
                                                                <li><i class="fa fa fa-wrench open-card-option"></i></li>
                                                                <li><i class="fa fa-window-maximize full-card"></i></li>
                                                                <li><i class="fa fa-minus minimize-card"></i></li>
                                                                <li><i class="fa fa-refresh reload-card"></i></li>
                                                                <li><i class="fa fa-trash close-card"></i></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="card-block table-border-style">
                                                        <div class="table-responsive">
                                                            <table class="table">
                                                                <thead>
                                                                    <tr>
                                                                        <th>SL No</th>
                                                                        <th>Name</th>
                                                                        <th>Status</th>
                                                                        <th>Created Date</th>
                                                                        <th>Action</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr class="table-active">
                                                                        <th scope="row">1</th>
                                                                        <td>Prepaid</td>
                                                                        <td>Active</td> 
                                                                        <td>20/05/2021</td> 
                                                                        <td><a href=""><i class="ti-pencil-alt" style="font-size:20px;"></i></a>&nbsp;&nbsp;&nbsp;<a href=""><i class="ti-close" style="font-size:20px;"></i></a></td>
                                                                    </tr>    
                                                                    <tr class="">
                                                                        <th scope="row">1</th>
                                                                        <td>Prepaid</td>
                                                                        <td>Active</td> 
                                                                        <td>20/05/2021</td> 
                                                                        <td><a href=""><i class="ti-pencil-alt" style="font-size:20px;"></i></a>&nbsp;&nbsp;&nbsp;<a href=""><i class="ti-close" style="font-size:20px;"></i></a></td>
                                                                    </tr>    
                                                                    <tr class="table-active">
                                                                        <th scope="row">1</th>
                                                                        <td>Prepaid</td>
                                                                        <td>Active</td> 
                                                                        <td>20/05/2021</td> 
                                                                        <td><a href=""><i class="ti-pencil-alt" style="font-size:20px;"></i></a>&nbsp;&nbsp;&nbsp;<a href=""><i class="ti-close" style="font-size:20px;"></i></a></td>
                                                                    </tr>    
                                                                    <tr class="">
                                                                        <th scope="row">1</th>
                                                                        <td>Prepaid</td>
                                                                        <td>Active</td> 
                                                                        <td>20/05/2021</td> 
                                                                        <td><a href=""><i class="ti-pencil-alt" style="font-size:20px;"></i></a>&nbsp;&nbsp;&nbsp;<a href=""><i class="ti-close" style="font-size:20px;"></i></a></td>
                                                                    </tr>    
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            <!-- Backup Api table-->
                                        
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Page body end -->
                                </div>
                            </div>
                            <!-- Main-body end -->
                            <div id="styleSelector">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Required Jquery -->
    <script type="text/javascript" src="assets/js/jquery/jquery.min.js "></script>
    <script type="text/javascript" src="assets/js/jquery-ui/jquery-ui.min.js "></script>
    <script type="text/javascript" src="assets/js/popper.js/popper.min.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap/js/bootstrap.min.js "></script>
    <!-- waves js -->
    <script src="assets/pages/waves/js/waves.min.js"></script>
    <!-- jquery slimscroll js -->
    <script type="text/javascript" src="assets/js/jquery-slimscroll/jquery.slimscroll.js"></script>

    <!-- Custom js -->
    <script src="assets/js/pcoded.min.js"></script>
    <script src="assets/js/vertical/vertical-layout.min.js"></script>
    <script src="assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script type="text/javascript" src="assets/js/script.js"></script>
</body>

</html>
