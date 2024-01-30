<?php
session_start();
// error_reporting(E_ALL);
// ini_set("display_errors" , 1);
include("../Db/config.php");
require("include/Auth.php"); // user auth
include("Backend/Functions/all_function.php"); // for create token

$row = $con->query("SELECT * FROM `websetting`")->fetch_assoc();
$longlat=$con->query("SELECT * FROM `login_history` WHERE USER_ID='$usid' ORDER BY ID DESC")->fetch_assoc();
$longitu=$longlat['LONGITUDE'];
$longitude=number_format($longitu, 2);
$latitu=$longlat['LATITUDE'];
$latitude=number_format("$latitu", 2);

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
<!--<div id="loading_ajax" style="width: 100%;height: 130%;position: absolute;top: 0;left: 0;background: #00000038; background-attachment:fixed; z-index: 22222;display: none;">-->
    
    
 <div id="loading_ajax" style="width: 100%; height: 130%; position: absolute; top: 0px; left: 0px; background: fixed rgba(0, 0, 0, 0.22); z-index: 22222; display: none;">
    <!--    <div id="loading"></div>-->
    <!--</div>   -->
    
    
    
    
    
        <div id="loading"></div>
    </div>
    <div class="modal fade" id="exampleModal12" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <span class="modal-title" id='title'></span>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="rplandata">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
     
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
              <div class="card-header">
                <h3 class="card-title">Recharge </h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
                <div class="card-body">
                
                <div class="form-row d-flex justify-content-around ">
                                                <div class="form-group form-primary col-md-3 ">
                                <label class="float-label">Enter Mobile Number</label>
                                <input type="number" name="recharge_mobile" id="recharge_mobile" onkeypress="return this.value.length < 10;" oninput="if(this.value.length>=10) { this.value = this.value.slice(0,10); }" required="" class="form-control" autocomplete="false" >
                                <input type="hidden" name="longi" id="longi" value="<?php echo $longitude?>">
                                <input type="hidden" name="lati" id="lati" value="<?php echo $latitude?>">
                                <span class="form-bar"></span>
                            </div>
                            <div class="form-group form-primary col-md-3 ">
                                <label class="float-label">Enter Amount</label>
                                <input type="number" name="recharge_amount" id="recharge_amount" value="" onkeypress="return this.value.length < 4;" oninput="if(this.value.length>=4) { this.value = this.value.slice(0,4); }" required="" class="form-control" autocomplete="false">
                                <span class="form-bar"></span>
                            </div>
                            <div class="form-group form-primary col-md-3 ">
                                
                                <label class="float-label">Select Operator</label>
                                <select name="recharge_operator" id="rc_operator" required class="form-control fill">
                                <option value="">Select Operator</option>
                                    <?php
                                    $rc_op = $con->query("select * from switchOperator where SERVICETYPE='8' ");
                                    while ($op_data = $rc_op->fetch_assoc()) {
                                    ?>
                                        <option value="<?php echo $op_data['LONGCODE'] ?>"><?php echo $op_data['PRODUCTNAME'] ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <!--    <div class="form-group form-primary col-md-3">-->
                            <!--    <label class="float-label">Enter M-Pin</label>-->
                            <!--    <input type="password" required name="tpin" class="form-control" autocomplete="false">-->
                            <!--    <span class="form-bar"></span>-->
                            <!--</div>-->
                </div>
            </div>
                <!-- /.card-body -->

                <div class="card-footer d-flex justify-content-center">
                    <div class="col-md-4">
                        <button type="button" id="recahrgecbtn" class="btn btn-primary">Submit</button>
                    </div>
                    <div class="col-md-2">
                      <button type="button" id="r_btn"  class="btn btn-primary">Roffer Plan</button>
                     
                     </div>
                    <div class="col-md-4">
                        <!--<button type="button" onclick="check_plan(false)" class="btn btn-primary">Check Plans</button>-->
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
<!-- Modal -->
<div class="modal fade" id="sendAmModalCenter" tabindex="-1" role="dialog" aria-labelledby="sendAmModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="sendAmModalLongTitle">Recharge Now</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!--<form id="recharge_form" autocomplete="off">-->
            <div class="form-row d-flex justify-content-center">
              <div class="col-10">
                <div class="form-group">
                    <label for="">Mobile : <span id="showmobile"></span></label>
                    <br>
                    <label for="">Operator : <span id="showop"></span></label>
                    <br>
                    <label for="">Amount : <span id="showam"></span> (<span id="showplandesc"></span>)</label>
                    <br>
                    <label for="">Longitude : <span id="showlongi"></span></label>
                    <br>
                    <label for="">Latitude : <span id="showlati"></span></label>
                    <br>
               
                    <!--<input type="hidden" name="recharge_mobile" id="recharge_mobile" >-->
                    <!--<input type="hidden" name="recharge_amount" id="recharge_amount">-->
                    <!--<input type="hidden" name="recharge_operator" id="rc_operator" >-->
                    <!--<input type="hidden" name="smhash_code2" id="hash_code2">-->
                    <label class="float-label">Enter M-Pin</label>
                    <input type="password" required name="tpin" class="form-control" autocomplete="false">
              </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button  id="submitBtn" type="submit" class="btn btn-primary">Submit </button>
      </div>
        <!--</form>-->
    </div>
  </div>
</div>

                 
</form>
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

<!--</form>-->
<!-- Offer  Modal -->
<div class="modal fade" id="offerModalCenter" tabindex="-1" role="dialog" aria-labelledby="offerModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="offerModalLongTitle">Recharge Now</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
                 <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                  
                </ul>
               <div class="tab-content" id="custom-tabs-one-tabContent">
                  <!--<div class="tab-pane fade" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">-->
                  <!--  <div class="row">-->
                  <!--      <div class="col-6"><button class="btn btn-primary">200</button></div>-->
                  <!--      <div class="col-6"><button class="btn btn-primary">validtiy</button></div>-->
                  <!--      <div class="col-6"><button class="btn btn-primary">2022-12-13</div>-->
                  <!--  </div>--->
                  <!--</div>--->
                  <!--<div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">-->
                  <!--   Mauris tincidunt mi at erat gravida, eget tristique urna bibendum. Mauris pharetra purus ut ligula tempor, et vulputate metus facilisis. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Maecenas sollicitudin, nisi a luctus interdum, nisl ligula placerat mi, quis posuere purus ligula eu lectus. Donec nunc tellus, elementum sit amet ultricies at, posuere nec nunc. Nunc euismod pellentesque diam.-->
                  <!--</div>-->
                  <!--<div class="tab-pane fade active show" id="custom-tabs-one-messages" role="tabpanel" aria-labelledby="custom-tabs-one-messages-tab">-->
                  <!--   Morbi turpis dolor, vulputate vitae felis non, tincidunt congue mauris. Phasellus volutpat augue id mi placerat mollis. Vivamus faucibus eu massa eget condimentum. Fusce nec hendrerit sem, ac tristique nulla. Integer vestibulum orci odio. Cras nec augue ipsum. Suspendisse ut velit condimentum, mattis urna a, malesuada nunc. Curabitur eleifend facilisis velit finibus tristique. Nam vulputate, eros non luctus efficitur, ipsum odio volutpat massa, sit amet sollicitudin est libero sed ipsum. Nulla lacinia, ex vitae gravida fermentum, lectus ipsum gravida arcu, id fermentum metus arcu vel metus. Curabitur eget sem eu risus tincidunt eleifend ac ornare magna.-->
                  <!--</div>-->
                  <!--<div class="tab-pane fade" id="custom-tabs-one-settings" role="tabpanel" aria-labelledby="custom-tabs-one-settings-tab">-->
                  <!--   Pellentesque vestibulum commodo nibh nec blandit. Maecenas neque magna, iaculis tempus turpis ac, ornare sodales tellus. Mauris eget blandit dolor. Quisque tincidunt venenatis vulputate. Morbi euismod molestie tristique. Vestibulum consectetur dolor a vestibulum pharetra. Donec interdum placerat urna nec pharetra. Etiam eget dapibus orci, eget aliquet urna. Nunc at consequat diam. Nunc et felis ut nisl commodo dignissim. In hac habitasse platea dictumst. Praesent imperdiet accumsan ex sit amet facilisis.-->
                  <!--</div>-->
                </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
        <!--</form>-->
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

<script src="js/Recharge.js"></script>
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

               showconfirm(true);
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
<script>
    $(document).on("click",".pricebtn",function(){
   let planprice = $(this).text();
   $("#recharge_amount").val(planprice);
   $('#exampleModal12').modal("hide");
});
    
    $('#r_btn').click(function(){
        $("#loading_ajax").show();
        var mobile = $('#recharge_mobile').val();
        if(mobile.length < 10){
        popup('error' , 'OOPS..!' ,"Please Enter 10 Digit Mobile Number For Recharge !");
        }
        else{
            
            $.ajax({
                    
                url:'api/fetchOp.php',
                type:'post',
                data: {mobile : mobile, pageid:13},
                dataType: 'json',
                success: function(res){
                     $("#loading_ajax").hide();
                    let rdata = res.rdata;
                    let rplanhtml = "";
                    
                    for(var i = 0; i<rdata.length; i++){
                    rplanhtml += `<div class="row" style="border: 2px solid grey;padding: 5px;margin: 5px;">
                        <div class="col-2">
                    <button class="btn btn-primary pricebtn">${rdata[i].price}</button>
                    </div>
                    <div class="col-10">${rdata[i].logdesc},<br><br><b style="font-weight:600;">Offer Plan : </b>${rdata[i].ofrtext}</div>
                    </div>`;
                    }
                    
                    $("#rplandata").html(rplanhtml);
                    $('#exampleModal12').modal("show");
                }
           });
        }
    }); 
</script>
</body>
</html>
