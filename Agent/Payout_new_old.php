<?php
session_start();
include("../Db/config.php");
require("include/Auth.php"); // user auth
include("Backend/Functions/all_function.php"); // for create token
include("Backend/PAYOUT/paysprint/payout_function.php"); // payout use

    $status = "Payout";
    $pytlst = json_decode(get_list() , true);
    $pytDt = $pytlst['data'];
    // print_r(get_list());
    // exit;
$row = $con->query("SELECT * FROM `websetting`")->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title> <?php echo $row['NAME']?> | PayOut Services </title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Favicons -->
  <link href="assets/img/YesPayBlueicon.png" rel="icon">
  <link href="assets/img/YesPayBlueicon.png" rel="apple-touch-icon">
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  
  
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.css">
  
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="hold-transition light-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
          <div id="loading_ajax" style="width: 100%;height: 130%;position: absolute;top: 0;left: 0;background: #00000038; background-attachment:fixed; z-index: 22222;display: none;"></div>
   
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
       <?php
          include("include/preloder.php");
       ?>
    <!--<img class="animation__wobble" src="../assets/img/<?php echo $row['I_LOGO'] ?>" alt="AdminLTELogo" width="120">-->
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
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Payout Service</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Payout Service</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->


    <!-- Main content -->
        <section class="content">
      <div class="container-fluid">
                        <!-- Page-header end -->
        <div class="pcoded-content">
                        <!-- Page-header start -->
                        <div class="page-header">
                            <div class="page-block">
                                <div class="row align-items-center">
                                    <div class="col-md-8">
                                        <div class="page-header-title">
                                            <h5 class="m-b-10"><?php echo $status ?> Services</h5>
                                            <p class="m-b-0">Dear User don't share any details of your account to anyone</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <ul class="breadcrumb">
                                            <li class="breadcrumb-item">
                                                <a href="index.html"> <i class="fa fa-home"></i> </a>
                                            </li>
                                            <li class="breadcrumb-item"><a href="#!">Service</a>
                                            </li>
                                            <li class="breadcrumb-item"><a href="#!"><?php echo $status ?></a>
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
                                         <?php
                                         if(isset($_GET['addNewAcc'])){
                                            $payoutUser = $con->query("select * from payout_users where US_ID='$id'");
                                            if($payoutUser->num_rows > 5){
                                                echo "<script>location.replace('payout')</script>";
                                            }
                                         ?>
                                        <div class="page-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h5>Create an account</h5>
                                                        </div>
                                                            <div class="card-block my-3">
                                                                 <form class="form-material" id="payout">
                                                                        <div class="form-row d-flex justify-content-around">
                                                                           <div class="form-group form-primary col-md-3">
                                                                               <?php
                                                                            //   echo getbank();
                                                                               ?>
                                                                                    <select name="bankName" required class="form-control fill">
                                                                                        <option value="">Select Bank</option>
                                                                                    <?php
                                                                                        $jsn_data = json_decode(getbank() , true);
                                                                                        // print_r($jsn_data);
                                                                                        $banklist = $jsn_data['banklist'];
                                                                                        $bank_data = $banklist['data'];
                                                                                        foreach($bank_data as $bank){
                                                                                            echo '<option value="'.$bank['id'].'">'.$bank['bankName'].'</option>';
                                                                                        }
                                                                                        ?>
                                                                                    </select>
                                                                            </div>
                                                                            <div class="form-group form-primary col-md-3 " >
                                                                                <input type="text" name="Name" class="form-control">
                                                                                <span class="form-bar"></span>
                                                                                <label class="float-label">Name</label>
                                                                            </div>
                                                                            <div class="form-group form-primary col-md-3 " >
                                                                                <input type="text" name="acc" class="form-control">
                                                                                <span class="form-bar"></span>
                                                                                <label class="float-label">Account Number</label>
                                                                            </div>
                                                                            <div class="form-group form-primary col-md-3 " >
                                                                                <input type="text" name="ifsc" class="form-control">
                                                                                <span class="form-bar"></span>
                                                                                <label class="float-label">Enter IFSC</label>
                                                                            </div>
                                                                            <!--<div class="form-group form-primary col-md-3 " >-->
                                                                            <!--    <input type="number" name="amount" class="form-control">-->
                                                                            <!--    <span class="form-bar"></span>-->
                                                                            <!--    <label class="float-label">amount</label>-->
                                                                            <!--</div>-->
                                                                        </div>
                                                                        <div class="form-row mt-4 d-flex justify-content-center">
                                                                             <div class="col-md-4">
                                                                                <button type="submit" class="btn waves-effect waves-light btn-warning btn-block btn-outline-warning" style="color: #fff; background: #6f42c1;"><i class="far fa-paper-plane"></i>Submit</button>
                                                                            </div>
                                                                            
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                    
                                                    <!-- Recharge History Table -->
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h5>Last 10 Transaction List</h5>
                                                            <!--<span>My last 10 transaction</span>-->
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
                                                                <table class="table table-striped" id="example">
                                                                  <thead>
                                                                    <tr>
                                                                       <th>SL No</th>
                                                                        <th>Account</th>
                                                                        <th>IFSC</th>
                                                                        <th>Amount</th>
                                                                        <th>Status</th>
                                                                        <th>Refrence id</th>
                                                                        <th>TimeStamp</th>
                                                                        <th>Update Status</th>
                                                                    </tr>
                                                                  </thead>
                                                                 <tbody> 
                                                              <?php
                                                                   $id = $_SESSION['id'];
                                                                   $dmt_trans_q = $con->query("select * from payout_transaction where USER_ID='$id' order by ID Desc");
                                                                   while($row = $dmt_trans_q->fetch_assoc()){
                                                                       $userid = $row['USER_ID'];
                                                                       $pusers = $con->query("select * from payout_users where US_ID='$userid' order by ID Desc")->fetch_assoc();
                                                                  ?>
                                                                    <tr>
                                                                        <td>1</td>
                                                                        <td><?php echo $pusers['ACCOUNT'] ?></td>
                                                                        <td><?php echo $pusers['IFSC'] ?></td>
                                                                        <td><?php echo $row['AMOUNT'] ?></td>
                                                                        <td><?php echo $row['STATUS'] ?></td>
                                                                       
                                                                        <td><?php echo $row['REFFRENCE_ID'] ?></td>
                                                                        <td><?php echo $row['DATE'] ?></td>
                                                                        <td onclick="check_status('<?php echo $row['REFFRENCE_ID'] ?>')"><i class="ti-pencil-alt" style="font-size:20px;"></i></td>
                                                                   </tr>
                                                                   <?php  }?>
                                                                </tbody>
                                                            </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                            <!--Service table-->
                                            
                                                </div>
                                            </div>
                                        </div>
                                        <?php 
                                         }
                                         else if(isset($_GET['selectAcc'])) {
                                             $ben =  get_bene(strip_tags(trim($_GET['selectAcc']))) ;
                                            //  print_r($ben);
                                            //  exit;
                                             $selectedId = strip_tags(trim($_GET['selectAcc']));
                                            //  $payoutUser = $con->query("select * from payout_users where US_ID='$id' and ID='$selectedId' ");
                                            //  $usData = $payoutUser->fetch_assoc();
                                             if($ben['verified'] != 1){
                                                   ?>
                                            <div class="page-body">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="card">
                                                                <div class="card-header">
                                                                    <h5>Verify Account.  ( Account : <?php echo $ben['account'] ?> ) ( IFSC : <?php echo $ben['ifsc'] ?> ) </h5>
                                                                </div>
                                                                    <div class="card-block my-3">
                                                                         <form class="form-material" id="payout_verify" enctype="form-data/multipart">
                                                                             
                                                                               <input type="hidden" name="accID" id="accID" value="<?php echo $selectedId  ?>">
                                                                                <div class="form-row d-flex justify-content-around">
                                                                                    <div class="form-group form-primary col-md-3 " >
                                                                                              <select name="doctype" onchange="getdoctype(this.value)" required class="form-control fill">
                                                                                                    <option value="">Select Type</option>
                                                                                                    <option value="PAN">Pan</option>
                                                                                                    <option value="AADHAAR">Adhaar</option>
                                                                                                </select>
                                                                                    </div>
                                                                                    <div class="form-group form-primary col-md-3 " >
                                                                                        <input type="file" name="passbook" class="form-control fill">
                                                                                        <span class="form-bar"></span>
                                                                                        <label class="float-label">Passbook</label>
                                                                                    </div>
                                                                                    <div class="form-group form-primary col-md-3 " style="display:none" id="panImg" >
                                                                                        <input type="file" name="pan" class="form-control fill">
                                                                                        <span class="form-bar"></span>
                                                                                        <label class="float-label">PAN</label>
                                                                                    </div>
                                                                                    <div class="form-group form-primary col-md-3 " style="display:none" id="afrontImg" >
                                                                                        <input type="file" name="afront" class="form-control fill">
                                                                                        <span class="form-bar"></span>
                                                                                        <label class="float-label">Aadhaar Front</label>
                                                                                    </div>
                                                                                    <div class="form-group form-primary col-md-3 " style="display:none" id="abackImg" >
                                                                                          <input type="file" name="aback" class="form-control fill">
                                                                                        <span class="form-bar"></span>
                                                                                        <label class="float-label">Aadhaar Back</label>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-row mt-4 d-flex justify-content-center">
                                                                                     <div class="col-md-4">
                                                                                        <button type="submit" class="btn waves-effect waves-light btn-primary btn-block btn-outline-primary" style="color: #fff;"><i class="far fa-paper-plane"></i>Submit</button>
                                                                                    </div>
                                                                                    
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                    
                                                        </div>
                                                    </div>
                                        </div>
                                        <?php 
                                             }
                                             else if($ben['verified'] == 1){
                                        ?>
                                        <div class="page-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h5>Do Transaction. ( Account : <?php echo $ben['account'] ?> ) ( IFSC : <?php echo $ben['ifsc'] ?> ) </h5>
                                                        </div>
                                                            <div class="card-block my-3">
                                                                 <form class="form-material" method="post" id="payout_trans">
                                                                       <input type="hidden" name="otpSendTime" id="otpSendTime" value="0">
                                                                       <input type="hidden" name="accID" id="accID" value="<?php echo $selectedId  ?>">
                                                                       <input type="hidden" name="verify" id="verify" value="">
                                                                        <div class="form-row d-flex justify-content-around">
                                                                           <div class="form-group form-primary col-md-3">
                                                                               <?php
                                                                                // echo getbank();
                                                                               ?>
                                                                                    <select name="mode" required class="form-control fill">
                                                                                        <option value="">Select Mode</option>
                                                                                        <option value="IMPS">IMPS</option>
                                                                                        <option value="NEFT">NEFT</option>
                                                                                  
                                                                                    </select>
                                                                            </div>
                                                                            <div class="form-group form-primary col-md-3 " >
                                                                                <input type="number" name="amount"  id="amount" class="form-control">
                                                                                <span class="form-bar"></span>
                                                                                <label class="float-label">amount</label>
                                                                            </div>
                                                                            <!--<div class="form-group form-primary col-md-6" style="display:none" id="otp_enter">-->
                                                                            <!--    <input type="text" required name="otp" id="otp" class="form-control">-->
                                                                            <!--    <label class="float-label">Enter OTP</label>-->
                                                                            <!--</div>-->
                                                                        </div>
                                                                        <div class="form-row mt-4 d-flex justify-content-center">
                                                                            <!-- <div class="col-md-4" id="otp_area">-->
                                                                            <!--    <button type="button" id="send_otpbtn"  onclick="sendotp()" class="btn btn-primary">Send OTP</button>-->
                                                                            <!--</div>-->
                                                                             <div class="col-md-4" id="submit_area" >
                                                                                <button type="submit" class="btn btn-primary">Submit</button>
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                    
                                                    <!-- Recharge History Table -->
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h5>Last 10 Transaction List</h5>
                                                            <!--<span>My last 10 transaction</span>-->
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
                                                                <table class="table table-striped">
                                                                  <thead>
                                                                    <tr>
                                                                       <th>SL No</th>
                                                                        <th>NAME</th>
                                                                        <th>ACCOUNT</th>
                                                                        <th>IFSC</th>
                                                                        <th>Amount</th>
                                                                        <th>Status</th>
                                                                        <th>Refrence id</th>
                                                                        <th>TimeStamp</th>
                                                                        <th>Update Status</th>
                                                                    </tr>
                                                                  </thead>
                                                                 <tbody> 
                                                              <?php
                                                                $i = 1;
                                                              
                                                                   $dmt_trans_q = $con->query("select * from payout_transaction where USER_ID='$id' order by ID Desc");
                                                                   while($row = $dmt_trans_q->fetch_assoc()){
                                                                       $userid = $row['USER_ID'];
                                                                       $pusers = $con->query("select * from payout_users where US_ID='$userid' order by ID Desc")->fetch_assoc();
                                                                      
                                                                      ?>
                                                                    <tr>
                                                                        <td><?php echo $i++ ?></td>
                                                                         <td><?php echo $pusers['NAME'] ?></td>
                                                                        <td><?php echo $pusers['ACCOUNT'] ?></td>
                                                                        <td><?php echo $pusers['IFSC'] ?></td>
                                                                        <td><?php echo $row['AMOUNT'] ?></td>
                                                                        <td><?php echo $row['STATUS'] ?></td>
                                                                       
                                                                        <td><?php echo $row['REFFRENCE_ID'] ?></td>
                                                                        <td><?php echo $row['TIMESTAMP'] ?></td>
                                                                        <td onclick="check_status('<?php echo $row['REFFRENCE_ID'] ?>')"><i class="ti-pencil-alt" style="font-size:20px;"></i></td>
                                                                   </tr>
                                                                   <?php  }?>
                                                                </tbody>
                                                            </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                            <!--Service table-->
                                            
                                                </div>
                                            </div>
                                        </div>
                                        <?php 
                                             }
                                         }
                                         else{
                                             ?>
                                              <div class="page-body">
                                                <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="card">
                                                                <div class="card-header">
                                                                    <h5>Choose Account.</h5>
                                                                </div>
                                                                    <div class="card-block my-3">
                                                                        <?php
                                                                        // $payoutUser = $con->query("select * from payout_users where US_ID='$id'");
                                                                        // // echo"select * from payout_users where US_ID='$id'";
                                                                        // if(count($pytDt) <= 5){
                                                                            echo "<a href='Payout_new?addNewAcc' class='btn btn-primary'style='margin-left:448px;background:#6f42c1;border-color: #6f42c1;'>Create New Account</a>";
                                                                        // }
                                                                        // else{
                                                                        //     echo "You have already added 5 account. Cannot add more accounts.";
                                                                        // }
                                                                        ?>
                                                                       </div>
                                                                       <div>
                                                                         <form class="form-material" method="get">
                                                                                <div class="form-row d-flex justify-content-around">
                                                                                   <div class="form-group form-primary col-md-3">
                                                                                            <select name="selectAcc" required class="form-control fill">
                                                                                                <option value="">Select Account</option>
                                                                                                <?php  
                                                                                                $accs = $con->query("select * from payout_users where US_ID='$id'");
                                                                                                foreach($pytDt as $allacc){
                                                                                                ?>
                                                                                                <option value="<?php echo $allacc['beneid'] ?>"><?php echo $allacc['bankname']." ".$allacc['account'] ?> ( <?php echo $allacc['ifsc'] ?> )</option>
                                                                                                <?php } ?>
                                                                                            </select>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-row mt-4 d-flex justify-content-center">
                                                                                     <div class="col-md-4">
                                                                                        <button type="submit" class="btn btn-primary" style="margin-left: 130px;background:#6f42c1;border-color: #6f42c1;">Submit</button>
                                                                                    </div>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                    </div>
                                              </div>
                                             <?php
                                         }
                                        ?>
                                    </div>
                                </div>
                                <!-- Main-body end -->
                            <div id="styleSelector">

                            </div>
                        </div>
                    </div>
      <!-- /.container-fluid -->
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

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
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
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>


<script src="js/payout_2.js"></script>
<script src="js/Main.js"></script>


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


<!-- For New Table-->
<script>
    // $(document).ready(function(){
    // Load Table Records
     load_data();

    function load_data()
    {
         $("#loadingtext").text("Wait. Loading Data");
         var fromd = $("#fromdate").val();
    var tod = $("#todate").val();
      $.ajax({
        url:"ajaxphp/payout.php",
        method:"POST",
        data:{pageid:4,type:"Prepaid",formdate:fromd,todate:tod},
        success:function(data)
        {
            $("#loadingtext").text("");
          $('#tbcard').html(data);
          
           $("#example").DataTable({
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



</body>
</html>
