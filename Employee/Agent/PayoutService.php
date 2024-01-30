<?php
session_start();
include("../Db/config.php");
require("include/Auth.php"); // user auth
include("Backend/Functions/all_function.php"); // for create token

$row = $con->query("SELECT * FROM `websetting`")->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title> Payout </title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
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
    <img class="animation__wobble" src="../assets/img/<?php echo $row['I_LOGO'] ?>" alt="AdminLTELogo" width="120">
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
        <div class="row">
          <div class="col-12">
            <!-- /.card -->
                      <?php
                         $payoutUser = $con->query("select * from payout_users where US_ID='$usid' and BENEID<>'' ");
                         if($payoutUser->num_rows == 0){
                         ?>
                               <div class="card">
                                                        <div class="card-header">
                                                            <h5>Create an account</h5>
                                                        </div>
                                                            <div class="card-block my-3">
                                                                 <form class="form-material" id="payout">
                                                                        <div class="form-row d-flex justify-content-around">
                                                                               <div class="form-group form-primary col-md-3">
                                                                                    <select name="bankName" required class="form-control fill">
                                                                                        <option value="">Select Bank</option>
                                                                                        <?php
                                                                                        $bank = $con->query("select * from paysprint_bank_list order by BANK_NAME asc");
                                                                                        while($banklist = $bank->fetch_assoc()){
                                                                                            echo "<option value='".$banklist['BANK_NAME']."'>".$banklist['BANK_NAME']."</option>";
                                                                                        }
                                                                                        ?>
                                                                                    </select>
                                                                                </div>
                                                                                <div class="form-group form-primary col-md-3">
                                                                                    <input type="text" required name="beneName" class="form-control">
                                                                                    <span class="form-bar"></span>
                                                                                    <label class="float-label">Full Name</label>
                                                                                </div>
                                                                                <div class="form-group form-primary col-md-3">
                                                                                    <input type="number"required name="beneMobile" class="form-control">
                                                                                    <span class="form-bar"></span>
                                                                                    <label class="float-label">Mobile </label>
                                                                                </div>
                                                                                <div class="form-group form-primary col-md-3">
                                                                                    <input type="text" required name="beneEmail" class="form-control">
                                                                                    <span class="form-bar"></span>
                                                                                    <label class="float-label">Email </label>
                                                                                </div>
                                                                                <div class="form-group form-primary col-md-3">
                                                                                    <input type="number"required name="beneAcc" class="form-control" >
                                                                                    <span class="form-bar"></span>
                                                                                    <label class="float-label">Account Number</label>
                                                                                </div>
                                                                                <div class="form-group form-primary col-md-3">
                                                                                    <input type="text" required name="beneAdd" class="form-control">
                                                                                    <span class="form-bar"></span>
                                                                                    <label class="float-label">Address  </label>
                                                                                </div>
                                                                                 <div class="form-group form-primary col-md-3">
                                                                                    <input type="text" required name="beneIFSC" class="form-control" >
                                                                                    <span class="form-bar"></span>
                                                                                    <label class="float-label">IFSC Code</label>
                                                                                </div>
                                                                             </div>
                                                                            <!--<div class="form-group form-primary col-md-3 " >-->
                                                                            <!--    <input type="number" name="amount" class="form-control">-->
                                                                            <!--    <span class="form-bar"></span>-->
                                                                            <!--    <label class="float-label">amount</label>-->
                                                                            <!--</div>-->
                                                                        </div>
                                                                        <div class="form-row mt-4 d-flex justify-content-center">
                                                                             <div class="col-md-4">
                                                                                <button type="submit" class="btn btn-primary">Submit</button>
                                                                            </div>
                                                                            
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                             <?php 
                                         }
                                         else{ 
                                         $userDet =$payoutUser->fetch_assoc();
                                         ?>
                                            <div class="card card-primary">
                                                  <div class="card-header">
                                                    <h3 class="card-title">Payout - Do Transaction</h3>
                                                  </div>
                                                            <div class="card-block my-3 container">
                                      <div style="display: flex;
                                                    flex-direction: column;
                                                    margin-left: 2%;
                                                    align-items: center;" class="row">
                                                                    <h5>Name : <?php echo $userDet["NAME"]; ?></h5>
                                                                    <h5>Account No : <?php echo $userDet["ACCOUNT"]; ?></h5>
                                                                    <h5>IFSC Code : <?php echo $userDet["IFSC"]; ?></h5>
                                                                </div>
                                                                 <form class="form-material" method="post" id="payout_trans">
                                                                        <div class="form-row d-flex justify-content-around">
                                                                            <input type="hidden" name="bene_id" id="send_bene_id" value="<?php echo $userDet['BENEID']?>">
                                                                            <input type="hidden" name="otpSendTime" id="otpSendTime" value="0">
                                                                              <div class="form-group form-primary col-md-6">
                                                                                <label class="float-label">Amount</label>
                                                                                <input type="number" required name="send_amount" id="send_amount" autocomplete="off" class="form-control fill">
                                                                            </div>
                                                                              <div class="form-group form-primary col-md-6" style="display:none" id="otp_enter">
                                                                                <label class="float-label">Enter OTP</label>
                                                                                <input type="text" required name="otp" id="otp" autocomplete="off" class="form-control fill">
                                                                            </div>
                                                                        </div>
                                                                        <input type="hidden" required name="verify" id="verify" readonly>
                                                                        <div class="form-row mt-4 d-flex justify-content-center">
                                                                             <div class="col-md-4" id="otp_area">
                                                                                <button type="button" id="send_otpbtn"  onclick="sendotp()" class="btn btn-primary">Send OTP</button>
                                                                            </div>
                                                                             <div class="col-md-4" id="submit_area" style="display:none">
                                                                                <button type="submit" class="btn btn-primary">Submit</button>
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                    
                                                    <!--  History Table -->
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h5>Last 10 Transaction List</h5>
                                                            <span>My last 10 transaction</span>
                                                            <!--<div class="card-header-right">-->
                                                            <!--    <ul class="list-unstyled card-option">-->
                                                            <!--        <li><i class="fa fa fa-wrench open-card-option"></i></li>-->
                                                            <!--        <li><i class="fa fa-window-maximize full-card"></i></li>-->
                                                            <!--        <li><i class="fa fa-minus minimize-card"></i></li>-->
                                                            <!--        <li><i class="fa fa-refresh reload-card"></i></li>-->
                                                            <!--        <li><i class="fa fa-trash close-card"></i></li>-->
                                                            <!--    </ul>-->
                                                            <!--</div>-->
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
                                                              
                                                                   $dmt_trans_q = $con->query("select * from payout_transaction where USER_ID='$usid' order by ID Desc LIMIT 10");
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
                                                                        <td><?php echo $row['FILTER_DATE'].' '.$row['TIMESTAMP'] ?></td>
                                                                        <?php
                                                                        if(strtolower($row['STATUS'])!= "success" && strtolower($row['STATUS']) != "rejected"){
                                                                            echo '<td onclick="check_status(\' '.$row['REFFRENCE_ID'].'\')">Check Status</td>';
                                                                        }
                                                                        else{
                                                                            echo "<td>Not Avail.</td>";
                                                                        }
                                                                        
                                                                        ?>
                                                                   </tr>
                                                                   <?php  }?>
                                                                </tbody>
                                                            </table>
                                                            </div>
                                                        </div>
                                                    <!--</div>-->
                                                  <?php } ?>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
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


<script src="js/PAYOUT.js"></script>
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
</body>
</html>
