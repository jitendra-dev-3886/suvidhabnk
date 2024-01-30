<?php
session_start();
include("../Db/config.php");
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
  <title>Fund Transfer </title>

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
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
                <h1>Fund Transfer</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Fund Transfer</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
                            <div class="main-body container">
                                <div class="page-wrapper">

                                    <!-- Page body start -->
                                    <div class="page-body">
                                        <div class="row">
                                            <div class="col-md-12">
                
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h5>Fund Transfer</h5>
                                                    </div>
                                                    <div class="card-block">
                                                        <!-- Row start -->
                                                        <div class="row">
                                                            <div class="col-lg-12 col-xl-12">
                                                                <div class="tab-content card-block">
                                                                    <div class="tab-pane active" id="i" role="tabpanel">
                                                                       <div class="card-block my-3">
                                                                            <form class="form-material" id="fund_transfer_form" action="handler/fund_transfer.php" method="post">
                                                                                <div class="form-row d-flex justify-content-around">
                                                                                         <input type="hidden" id="long" name="long">
                                                                                        <input type="hidden" id="lati" name="lati">
                                                                                     <div class="form-group form-primary col-md-5">
                                                                                       <select name="select" class="form-control fill" required id="u_type">
                                                                                            <option >Select User type name</option>
                                                                                            <option value="46">Retailer</option>
                                                                                            <option value="47">Distributor</option>
                                                                                            <option value="48">MasterDistributor</option>
                                                                                    </select>
                                                                                    </div>
                                                                                   <div class="form-group form-primary col-md-5">
                                                                                        <select name="user_id" class="form-control fill" id="user_id">
                                                                                            
                                                                                            <option value="" selected disabled>Select User</option>
                                                                                            
                                                                                        </select>
                                                                                    </div>
                                                                                    
                                                                                    </div>
                                                                                    
                                                                                    
                                                                                <div class="form-row mt-3 d-flex justify-content-around">
                                                                                    <div class="form-group form-primary col-md-3">
                                                                                        <input type="number" name="amount" required class="form-control" onkeypress="return this.value.length < 7;" oninput="if(this.value.length>=7) { this.value = this.value.slice(0,7); }">
                                                                                        <span class="form-bar"></span>
                                                                                        <label class="float-label">Amount</label>
                                                                                    </div>
                                                                                    <div class="form-group form-primary col-md-3">
                                                                                        <select name="wallet_type" class="form-control fill" required>
                                                                                            <option value="">Select Wallet Type</option>
                                                                                            <option value="MAIN_BAL">Main Bal</option>
                                                                                            <option value="AEPS_BAL">AEPS Bal</option>
                                                                                        </select>
                                                                                    </div>
                                                                                    <div class="form-group form-primary col-md-3">
                                                                                        <select name="fund_type" class="form-control fill" required>
                                                                                            <option value="">Select Fund Type</option>
                                                                                            <option value="Credit">Add Fund</option>
                                                                                            <option value="Debit">Deduct Fund</option>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                                
                                                                                <div class="form-row mt-3 d-flex justify-content-around">
                                                                                    <div class="form-group form-primary col-md-5">
                                                                                        <input type="text" name="remark" class="form-control" required>
                                                                                        <span class="form-bar"></span>
                                                                                        <label class="float-label">Remark</label>
                                                                                    </div>
                                                                                </div>
                                                                                
                                                                                <div class="form-row mt-4 d-flex justify-content-center">
                                                                                    <div class="col-md-8">
                                                                                        <button type="submit" name="fund_transfer" class="btn waves-effect waves-light  btn-block btn-outline-primary"><i class="ti-wallet"></i>Transfer Money</button>
                                                                                    </div>
                                                                                </div>
                                                                             </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                                <!--<div class="tab-content card-block" style="display:none;">-->
                                                                <!--    <div class="tab-pane active" id="i" role="tabpanel">-->
                                                                <!--       <div class="card-block my-3">-->
                                                                <!--            <form class="form-material">-->
                                                                <!--                <div class="form-row d-flex justify-content-around">-->
                                                                <!--                    <div class="form-group form-primary col-md-3">-->
                                                                <!--                        <select name="select" class="form-control fill">-->
                                                                <!--                            <option >Select User type name</option>-->
                                                                <!--                            <option value="user">user 1</option>-->
                                                                <!--                            <option value="user">user 2</option>-->
                                                                <!--                            <option value="user">user 3</option>-->
                                                                <!--                        </select>-->
                                                                <!--                    </div>-->
                                                                <!--                    <div class="form-group form-primary col-md-3">-->
                                                                <!--                        <input type="number" name="footer-email" class="form-control" onkeypress="return this.value.length < 7;" oninput="if(this.value.length>=7) { this.value = this.value.slice(0,7); }">-->
                                                                <!--                        <span class="form-bar"></span>-->
                                                                <!--                        <label class="float-label">Amount</label>-->
                                                                <!--                    </div>-->
                                                                <!--                    <div class="form-group form-primary col-md-3">-->
                                                                <!--                        <select name="fund_type" class="form-control fill">-->
                                                                <!--                            <option >Select Fund Type</option>-->
                                                                <!--                            <option value="Credit" seleted>Add Fund</option>-->
                                                                <!--                            <option value="Debit">Deduct</option>-->
                                                                <!--                        </select>-->
                                                                <!--                    </div>-->
                                                                <!--                </div>   -->
                                                                <!--                <div class="form-row mt-4 d-flex justify-content-center">-->
                                                                <!--                    <div class="col-md-8">-->
                                                                <!--                        <button class="btn waves-effect waves-light btn-primary btn-block btn-outline-primary"><i class="ti-wallet"></i>Transfer Money</button>-->
                                                                <!--                    </div>-->
                                                                <!--                </div>-->
                                                                <!--             </form>-->
                                                                <!--        </div>-->
                                                                <!--    </div>-->
                                                                <!--</div>-->
                                                                
                                                                
                                                            </div>
                                                        </div>
                                                        <!-- Row end -->
                                                    </div>
                                                </div>
                                                
                                                <!-- Service Table -->
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h5>Last 10 Payment List</h5>
                                                        <span>My Last 10 payment</span>
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
                                                                        <th>Amount</th>
                                                                        <th>Type</th>
                                                                        <th>My Opening Balance</th>
                                                                        <th>My Closing Balance</th>
                                                                        <th>Date</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                     <?php
                                                                     $i = 1;
                                                                        $id = $_SESSION['id']; 
                                                                        $res = $con->query("SELECT * FROM fund_transfer where OWNER_ID='$id' order by ID desc");
                                                                        if($res->num_rows > 0){
                                                                            while($fund_transfer = $res->fetch_assoc()){
                                                                                ?>
                                                                    <tr class="">
                                                                        <th scope="row"><?php echo $i++ ?></th>
                                                                        <td><?php echo $fund_transfer['AMOUNT'] ?></td>
                                                                        <td>
                                                                            <?php if( $fund_transfer['OWNER_PREVIOUS_AMOUNT'] > $fund_transfer['OWNER_AFTER_AMOUNT']){
                                                                                echo "Debit";
                                                                            }
                                                                            elseif($fund_transfer['OWNER_PREVIOUS_AMOUNT'] < $fund_transfer['OWNER_AFTER_AMOUNT']){
                                                                              echo "Credit";  
                                                                            }
                                                                            else{
                                                                              echo "Illegal Transaction";    
                                                                            }
                                                                            ?>
                                                                        </td>
                                                                        <td><?php echo $fund_transfer['OWNER_PREVIOUS_AMOUNT'] ?></td> 
                                                                        <td><?php echo $fund_transfer['OWNER_AFTER_AMOUNT'] ?></td> 
                                                                        <td><?php echo $fund_transfer['DATE'] ?></td> 
                                                                    </tr>  
                                                                    
                                                                    <?php
                                                                        }
                                                                    }
                                                                    ?>
                                                                
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                        <!--Service table-->
                                        
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Page body end -->
                                </div>
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
    $(document).ready(function() {
      $("#user_id").select2();
        
    });

</script>
<script>
        $(document).ready(function(){
          $("#u_type").change(function(){
              let user_type = $('#u_type').val();
              $.ajax({
			url: "handler/fundChangeUser.php",
			type: "POST",
			data: {pageid:"fund_rt",user_type:user_type},
			success: function(data){
				$("#user_id").html(data);
			}
		});
              
          });
          
                  $('#myTable').DataTable( {
             dom: 'Bfrtip',
             buttons: [
                
                 'excelHtml5',
                
                 'pdfHtml5'
             ]
         } );
        });
</script>

</body>
</html>

 