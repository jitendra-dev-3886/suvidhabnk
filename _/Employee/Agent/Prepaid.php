<?php
session_start();
// error_reporting(E_ALL);
// ini_set("display_errors" , 1);
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
  <title> Recharge </title>

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
            <h1 class="m-0">Recharge </h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Recharge </li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
              <form method = "post"  id="recharge_form" autocomplete="off">

    <!-- Main content -->
        <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <!-- /.card -->
            <div class="card card-primary">
                   <div class="card">
                    <div class="card-header">
                        <h5>Recharge Now</h5>
                    </div>
                <div class="card-block my-3">
                        <form class="form-material" id="recharge_form" method="post">
                            <div class="form-row d-flex justify-content-around">
                                <div class="form-group form-primary col-md-3 ">
                                    <input type="number" name="recharge_mobile" id="recharge_mobile" onkeypress="return this.value.length < 10;" oninput="if(this.value.length>=10) { this.value = this.value.slice(0,10); }" required="" class="form-control">
                                    <span class="form-bar"></span>
                                    <label class="float-label">Enter Number</label>
                                </div>
                                <div class="form-group form-primary col-md-3 " >
                                    <input type="number" name="recharge_amount" id="recharge_amount" class="form-control">
                                    <span class="form-bar"></span>
                                    <label class="float-label">Enter Amount</label>
                                </div>
                                <div class="form-group form-primary col-md-3 " >
                                        <select name="recharge_operator" id="rc_operator" required class="form-control fill">
                                            <option value="">Select Operator</option>
                                        <?php
                                            $rc_op = $con->query("select * from switchOperator where SERVICETYPE='prepaid'");
                                              while($op_data = $rc_op->fetch_assoc()){
                                                  ?>
                                                    <option value="<?php echo $op_data['LONGCODE'] ?>"><?php echo $op_data['PRODUCTNAME'] ?></option>
                                                  <?php
                                                  } 
                                              ?>
                                        </select>
                                </div>
                            </div>
                            <div class="form-row mt-4 d-flex justify-content-center">
                                <div class="col-md-4">
                                    <button type="submit" class="btn waves-effect waves-light btn-primary btn-block btn-outline-primary" style="color:#fff"><i class="far fa-paper-plane"></i>Recharge Now</button>
                                </div>
                                <div class="col-md-4">
                                    <button type="button" onclick="get_roffer()" class="btn waves-effect waves-light btn-primary btn-block btn-outline-primary" style="color:#fff"><i class="far fa-paper-plane"></i>Search R-offer</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
            <!-- /.card -->

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Last 10 Transaction</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                        <th>SL No</th>
                        <th>Mobile</th>
                        <th>Operator</th>
                        <th>Amount</th>
                        <th>Message</th>
                        <th>Refrence id</th>
                        <th>Date &amp; Time</th>
                        <!--<th>Print</th>-->
                    </tr>
                  </thead>
                  <tbody>
                      <?php

                                    $i = 1;
                                    $res = $con->query("SELECT * FROM recharge_transaction where USER_ID='$usid' and SERVICE='prepaid' order by ID desc LIMIT 10 ");

                                    if ($res->num_rows > 0) {
                                        while ($rc_rpt = $res->fetch_assoc()) {
                                            $op = explode(",", $rc_rpt['OPERATOR']);
                                            $st = explode(",", $rc_rpt['STATUS']);
                                    ?>
                                            <tr>
                                                <th scope="row"><?php echo $i++ ?></th>
                                                <td><?php echo $rc_rpt['MOBILE'] ?></td>
                                                <td>
                                                    <?php
                                                    echo  $op[0];
                                                    ?>
                                                </td>
                                                <td><?php echo $rc_rpt['AMOUNT'] ?></td>
                                                <td><?php echo $st[0] ?></td>
                                                <td><?php echo $rc_rpt['REFERENCE_ID'] ?></td>
                                                <td><?php echo $rc_rpt['FILTER_DATE'].' '.$rc_rpt['TIMESTAMP'] ?></td>
                                                <!--<td><a href="#?status=#&id=<?php echo $rc_rpt['ID'] ?>"><i class="ti-eye" style="font-size:20px;"></i></a>&nbsp;&nbsp;&nbsp;<a onclick="javascript:confirmationDelete($(this));return false;" href="#?#&id=<?php echo $rc_rpt['ID'] ?>"><i class="ti-printer" style="font-size:20px;"></i></a></td>-->
                                            </tr>
                                    <?php
                                        }
                                    }

                                    ?>
                  </tfoot>
                  
                </table>
              </div>
              <!-- /.card-body -->
            </div>
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
<!--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>-->
<script src="dist/js/demo.js"></script>

<script type="text/javascript" src="assets/js/Recharge.js"></script>
<script src="js/Main.js"></script>
<!-- Page specific script -->
<script>

$(document).ready(function(){
   $("#recahrgecbtn").click(function(){
      if($("#recharge_amount").val() < 10){
               popup('error' , 'OOPS..!' ,"Please Recharge Minimum Rs 10 !");
           }else if($("#recharge_mobile").val().length < 10){ 
               popup('error' , 'OOPS..!' ,"Please Enter 10 Digit Mobile Number For Recharge !");
               
           }else{
               showconfirm(false);
           }
   }); 
});



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
