<?php
session_start();
// error_reporting(E_ALL);
// ini_set("display_errors" , 1);
include("../Db/config.php");
require("include/Auth.php"); // user auth


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Pan Card Coupon</title>

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
  

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!--<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />-->


    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body class="hold-transition light-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
       <div id="loading_ajax" style="width: 100%;height: 130%;position: absolute;top: 0;left: 0;background: #00000038; background-attachment:fixed; z-index: 22222;display: none;"></div>
      
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__wobble" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" width="150">
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
            <h1 class="m-0">Pan Card Coupon </h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Pan Card Coupon</li>
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
           
           
                
          <div class="col-6">
            <!-- /.card -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Request Pan Card Coupon</h3>
               
              </div>
              <!-- /.card-header -->
              <!-- form start -->
                <div class="card-body">
        <div class="container">
           
            <div class="row d-flex justify-content-center">
                <div class="col-md-12">
                    <div class="wizard">
                            <?php
                               $qry=$con->query("SELECT * FROM `pan_coupon` WHERE ID='1'")->fetch_assoc();
                            ?>
                        <form id="pan_form">
                            <div class="tab-content" id="main_form">
                                <div class="tab-pane active" role="tabpanel" id="step1">
                                    <h3 class="text-center text-primary">Coupon Request</h3>
                                     <hr>
                                    <div class="row">
                                        <div class="col-md-12">
                                          <h4 class="text-primary">Coupon Price - <?php echo $qry['COUPON_PRICE'] ?></h4>
                                        </div>
                                        <div class="col-md-4 mt-3">
                                            <h4 class="text-primary">No of Coupon -</h4>
                                        </div>
                                        <div class="col-md-4 mt-2" style="display:none;">
                                            <div class="form-group">
                                                <!--<input type="number" class="form-control" name="first_val" id="first_val" value="<?php echo $qry['COUPON_PRICE'] ?>" placeholder="Number of Coupon" autocomplete="off" />-->
                                                <input type="hidden" class="form-control" name="no_of_cpn1" id="no_of_cpn1" value="<?php echo $qry['COUPON_PRICE'] ?>" placeholder="Number of Coupon" autocomplete="off" />
                                            </div>
                                        </div>
                                        <div class="col-md-4 mt-2">
                                            <div class="form-group">
                                                <!--<input type="number" class="form-control" name="second_val" id="second_val" value="" placeholder="Number of Coupon" autocomplete="off" />-->
                                                <input type="number" class="form-control" name="no_of_cpn2" id="no_of_cpn2" value="1" placeholder="Number of Coupon" autocomplete="off" />
                                            </div>
                                        </div>
                                         <div class="col-md-12">
                                          <h4 class="text-primary" id="show" value="<?php echo $qry['COUPON_PRICE'] ?>">Coupon Price - <?php echo $qry['COUPON_PRICE'] ?></h4>
                                        </div>
                                        <!--<div class="col-md-8">-->
                                        <!--    <input type="number" class="form-control" name="output" id="output" value="" placeholder="Number of Coupon" autocomplete="off" />-->
                                        <!--</div>-->
                                    </div>
                                </div>
                            </div>
                              <div class="card-footer d-flex justify-content-center">
                                    <div class="col-md-4">
                                        <input type="hidden" name="type" value="1">
                                        <button type="submit" class="btn btn-primary" name="pan_form" id="add_btn">Submit </button>
                                    </div>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div> 
                <!--</div>-->
               </div>
                <!-- /.card-body -->

          
                

            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
          
            
          <div class="col-6">
            <!-- /.card -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Coupon Request </h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
                <div class="card-body">
                <!--</div>-->
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script>
// step1
$(document).ready(function () {
    var no_cpn1,no_cpn2,$total_cpn;
    $(function(){
    $("#no_of_cpn2,#no_of_cpn1").keyup(function (e){
      
      if($("#no_of_cpn2").val() < 0) {
          alert("Please minimum 1 coupon request");
      }
        
    e.preventDefault();
      no_cpn1 = $('#no_of_cpn1').val();
      no_cpn2 = $('#no_of_cpn2').val();
      total_cpn= $("#show").text("Total Coupon Price = "+ no_cpn1*no_cpn2);
      total_cpn.val();
    }); 
    $('#pan_form').submit(function(e){
         e.preventDefault();

         if($("#no_of_cpn2").val() < 0) {
          alert("Please minimum 1 coupon request");
      }else{
           $.ajax({
             url:"handler/PanCardRequest.php",  
            type: "POST",
            data:  new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
             beforeSend: function(xhr){xhr.setRequestHeader('Token', localStorage.getItem('Token'));},
            success: function(data)
            {
        let rslt = JSON.parse(data);
        let rs_code = rslt.response_code;
        let msg = rslt.message;
                 if(rs_code == 1){
                    Swal.fire({
                          icon: "success",
                          title: "Hurray!",
                          button: "Okay",
                          text: 'PanCard Request Successfully.',
                        }).then(function(){ 
                          $("#pan_form")[0].reset();
                }); 
                   
                 }else{
                     Swal.fire({
                          icon: "error",
                          title: "OOPS!",
                          button: "Close",
                          text: msg,
                        }) 
                 }
                
            }, error:function(err){
                         $("#loading_ajax").hide();
                         popup('error' , 'OOPS..!' , "some internel error occured we are fixing it");
                     }
  });
   }
});
    }); 
});
//   // this is a global variable
// var g_var = "This is a global variable.";
// $(function(){
// // since g_var is global, can use it here
// alert(g_var);
// // this is a local variable
// var l_var = "This is a local variable.";
// $("#btn").click(function(){
// // here access to both the global scope and local scope variable.
// alert(g_var+l_var);
// return false;
// });
// });  

// step 2
// $("#add_btn").click(function(){
//     var first_val = parseInt($("#first_val").val());
//     var second_val = parseInt($("#second_val").val());
    
//     $("#show").text("Total Coupon Price = "+first_val*second_val);
// })
</script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<!--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>-->
<script src="dist/js/demo.js"></script>

<!--<script src="js/Recharge.js"></script>-->
<!--<script src="js/Main.js"></script>-->
<!-- Page specific script -->


</body>
</html>
