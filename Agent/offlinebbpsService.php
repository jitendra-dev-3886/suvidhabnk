<?php
session_start();
// error_reporting(E_ALL);
// ini_set("display_errors" , 1);
include("../Db/config.php");
require("include/Auth.php"); // user auth
include("Backend/Functions/all_function.php"); // for create token
include("Backend/BBPS/Paysprint/bbps_function.php"); // for bbps
 $op_response = json_decode(GetOperators() , true);
$op_data = $op_response['data'];
$get_cat = "Electricity";

// print_r(GetOperators());

$row = $con->query("SELECT * FROM `websetting`")->fetch_assoc();

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title> BBPS </title>

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
            <h1 class="m-0">BBPS Offline</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">BBPS Offline</li>
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
              <div class="card-header">
                <h3 class="card-title">BBPS Offline</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
                <div class="card-body">
                            <div class="form-row d-flex justify-content-around ">
                                  <div class="form-group form-primary col-md-3 ">
                                      <label class="float-label">Select Category</label>
                                    <select name="category" id="category" onchange="getOperator(this.value)" required class="form-control fill">
                                    <option value="">Select Category</option>
                                   <?php
                                      if($op_data != ""){
                                          
                                      foreach($op_data as $op_details){
                                          
                                          if($get_cat == $op_details['category']){
                                              $selected = "selected";
                                          }else{
                                              
                                              $selected = "";
                                          }
                                          if(!in_array(strtolower(trim($op_details['category'])) , $catarr)){
                                          ?>
                                            <option <?php echo $selected ?> value="<?php echo $op_details['category'] ?>"><?php echo $op_details['category'] ?></option>
                                          <?php
                                            }
                                          $catarr[] =strtolower(trim($op_details['category']));
                                         }
                                      }
                                      ?>
                                </select>
                                </div>
                              <div class="form-group form-primary col-md-3 ">
                                
                                <label class="float-label">Select Operator</label>
                                <select name="recharge_operator" id="operator" onchange="getOperatorInfo(this.value)" required class="form-control fill">
                                    <option value="">Select Operator</option>
                                </select>
                            </div>
                            <div class="form-group form-primary col-md-3 " id="ca_num_area" style="display:none;">
                                <label class="float-label" id="canum_label">Enter Mobile Number</label>
                                <input  type="text" id="canumber" name="recharge_mobile" class="form-control" autocomplete="false" >
                                <span class="form-bar"></span>
                            </div>
                           
                            <input type="hidden" name="long"  id="long" >
                            <input type="hidden" name="lati"  id="lati" >
                            <input type="hidden" name="Billdate"  id="Billdate" >
                            <input type="hidden" name="dueDate"  id="dueDate" >
                        </div>
                    </div>
                         <div style="display:none;" id="additionalData" class="form-row d-flex justify-content-around">
                           
                        </div>
                <!-- /.card-body -->
                <div class="card-footer d-flex justify-content-center">
                    <div class="col-md-4">
                        <button type="button" id="fetchBtn" class="btn btn-primary">Submit </button>
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
                            <th>Category</th>
                            <th>Operator</th>
                            <th>Consumer Number</th>
                            <th>Amount</th>
                            <th>Operator ID</th>
                            <th>Reffernce ID</th>
                            <th>Status</th>
                            <!--<th>Check Status</th>-->
                        </tr>
                      </thead>
                      <tbody id="">
                            <?php
                        $i = 1;
                        $res = $con->query("SELECT * FROM pay_bill_api where USER_ID='$usid' AND MODE = 'OFFLINE' ORDER BY ID DESC LIMIT 10");
                        if($res->num_rows > 0){
                            while($rc_rpt = $res->fetch_assoc()){
                                ?>
                             <tr>
                               <th scope="row"><?php echo $i++ ?></th>
                                <td><?php echo $rc_rpt['CATEGORY'] ?></td>
                                <td><?php echo $rc_rpt['OP_NAME'] ?></td>
                                <td><?php echo $rc_rpt['CA_NUM'] ?></td>
                                <td><?php echo $rc_rpt['AMOUNT'] ?></td>
                                <td><?php echo $rc_rpt['OPERATORID'] ?></td>
                                <td><?php echo $rc_rpt['REFFRENCE_ID'] ?></td> 
                                <td><?php echo $rc_rpt['STATUS'] ?></td> 
                           </tr>
                           <?php
                             }
                            }
                                
                            ?>
                    </tbody>

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
  <!--========= Transfer Modal =========-->
</form>
<!-- Offer  Modal -->
<div class="modal fade" id="offerModalCenter" tabindex="-1" role="dialog" aria-labelledby="offerModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="offerModalLongTitle">BBPS Offline Now</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="offlineBillSubmit">
      <div class="modal-body">
              <table class="table table-striped">
                   <thead>
                    <tr>
                        <th>Account Number</th>
                        <th>Name</th>
                        <!--<th>Mobile</th>-->
                        <th>Bill Amount</th>
                        <!--<th>Bill Date</th>-->
                        <th>Due Date</th>
                    </tr>
                  </thead>
                  <tbody >
                      <tr id="bill_details">
                     </tr>
                   </tbody>
               </table>
                 <div class="form-group form-primary col-md-3 " id="">
                    <label class="float-label">Enter M-Pin</label>
                    <input type="password" required name="tpin" id="tpin" class="form-control" autocomplete="false">
                </div>
      </div>
      
      <div class="modal-footer">
        <input type="hidden" id="billdata">
        <input type="hidden" id="lati">
        <input type="hidden" id="long">
        <button type="submit" name="billpay" class="btn btn-primary">Pay Now</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
        </form>
    </div>
  </div>
</div>

                 
  <!--========= Transfer Modal =========-->
  
<script>
    function changeCom(value){
        console.log(value);
        if(value == "Cash_Withdrawal" || value == "Aadhaar_Pay"){
            $("#Amount").show();
        }
        else{
            $("#Amount").hide();
        }
    }
</script>

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
<!--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>-->
<script src="dist/js/demo.js"></script>

<script src="js/BBPS.js"></script>
<script src="js/Main.js"></script>
<!-- Page specific script -->
<?php
if($get_cat != ""){
  echo "<script>
  getOperator('".$get_cat."');
  </script>";  
}

?>

<script>
  $(function () {
    $("#example1").DataTable({
     "responsive": true, "lengthChange": true, "autoWidth": false,
        pageLength: 5,
        lengthMenu: [5, 10, 20, 50, 100, 200, 500,1000],
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
