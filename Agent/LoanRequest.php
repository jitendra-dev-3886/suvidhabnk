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
  <title> Loan Request </title>

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
    <style type="text/css">

.nav-tabs {
    border-bottom: none;
}
.list-inline {
    padding-left: 0;
    list-style: none;
    /*margin-right: 1rem;*/
    margin-left: 1rem;
    display: flex;
    justify-content: flex-end;
}
  </style>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Loan Request </h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Loan Request </li>
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
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Loan Request </h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
                <div class="card-body">
                   <section class="signup-step-container">
        <div class="container">
           
            <div class="row d-flex justify-content-center">
                <div class="col-md-12">
                    <div class="wizard">
                        <div class="wizard-inner">
                            <div class="connecting-line none"></div>
                            <ul class="nav nav-tabs none" role="tablist">
                                <li role="presentation" class="active">
                                    <a href="#step1" data-toggle="tab" aria-controls="step1" role="tab" aria-expanded="true"><span class="round-tab"></span></a>
                                </li>
                                <li role="presentation" class="disabled">
                                    <a href="#step2" data-toggle="tab" aria-controls="step2" role="tab" aria-expanded="false"><span class="round-tab"></span></a>
                                </li>
                                <li role="presentation" class="disabled">
                                    <a href="#step3" data-toggle="tab" aria-controls="step3" role="tab"><span class="round-tab"></span></a>
                                </li>
                                <!--<li role="presentation" class="disabled">-->
                                <!--    <a href="#step4" data-toggle="tab" aria-controls="step4" role="tab"><span class="round-tab"></span></a>-->
                                <!--</li>-->
                            </ul>
                        </div>
        
                        <form method="post" class="loan_Form" id="loan_Form">
                            <div class="tab-content" id="main_form">
                                <div class="tab-pane active" role="tabpanel" id="step1">
                                    <h4 class="text-center">Step 1</h4>
                                    <div class="row">
                                      
                                        <div class="col-md-4">
                                               <div class="form-group">
                                            <label for="exampleInputEmail1">Loan Type</label>
                                            <select class="form-control" name="loantype" required id="loantype">
                                                <option>Select LoanType</option>
                                                <option value="Personal Loan">Personal Loan</option>
                                                <option value="Home Loan">Home Loan</option>
                                                <option value="Mortgage Loan">Mortgage Loan</option>
                                                <option value="Business Loan">Business Loan</option>
                                                <option value="Car Loan">Car Loan</option>
                                                <option value="Education Loan">Education Loan</option>
                                            </select>
                                         </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Customer Name * </label>
                                                <input type="text" name="cname" id="cname" class="form-control" placeholder="Enter Customer Name" autocomplete="off" />
                                                <input type="hidden" name="txnid" id="txnid" class="form-control"/>
                                             </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Mobile No * </label>
                                                <input type="text" name="mob" id="mob" class="form-control" placeholder="Enter Mobile No" autocomplete="off" />
                                            </div>
                                        </div>
                                        <div class="col-md-4" style="display:none;">
                                            <div class="form-group">
                                                <label>Verify Mobile No * </label>
                                                <input type="text" name="otp" id="otp" class="form-control" placeholder="Enter Mobile Otp" autocomplete="off" />
                                            </div>
                                        </div>
                                    </div>
                                    <ul class="list-inline">
                                        <li><input type="button" class="default-btn next-step btn" style="background-color: #276569;color:#fff;" value="Continue to next step"/></li>
                                    </ul>   
                                </div>
                                
                                <div class="tab-pane" role="tabpanel" id="step2">
                                    <h4 class="text-center">Step 2</h4>
                                    <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Profession</label>
                                            <select class="form-control" name="profession" required id="profession">
                                                <option>Select Profession</option>
                                                <option value="SelfEmployed">Self Employed</option>
                                                <option value="Salaried">Salaried</option>
                                                <option value="GovtEmployed">Govt Employed</option>
                                            </select>
                                         </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Income(Monthly)*</label>
                                            <input  type="text" name="income" id="income" class="form-control" placeholder="Enter Income(Monthly)" autocomplete="off" />
                                         </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Required Loan Amount</label>
                                            <input  type="number" name="loan_amt" id="loan_amt" class="form-control" placeholder="Enter Required Loan Amount" autocomplete="off" />
                                         </div>
                                    </div>
                                   </div>
                                    <ul class="list-inline">
                                        <li><button type="button" class="default-btn prev-step  btn" style="background-color: #276569;color:#fff;">Back</button></li>&nbsp;&nbsp;
                                        <!-- <li><button type="button" class="default-btn next-step skip-btn">Skip</button></li> -->
                                        <li><button type="button" class="default-btn next-step  btn" style="background-color: #276569;color:#fff;">Continue</button></li>
                                    </ul>
                                </div>
                                <div class="tab-pane" role="tabpanel" id="step3">
                                    <h4 class="text-center">Kyc Documents*</h4>
                                     <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>AadharCard Front *</label> 
                                            <input type="file" class="form-control"  name="adharf" id="adharf" required> 
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>AadharCard Back *</label> 
                                            <input type="file" class="form-control"  name="adharb" id="adharb" required> 
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>PanCard *</label> 
                                            <input type="file" class="form-control"  name="pan" id="pan" required> 
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Salary Slip *</label> 
                                            <input type="file" class="form-control"  name="salaryslip" id="salaryslip"> 
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Bank Statement *</label> 
                                            <input type="file" class="form-control"  name="bankstmt" id="bankstmt"> 
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Last Year ITR *</label> 
                                            <input type="file" class="form-control"  name="last_itr" id="last_itr"> 
                                        </div>
                                    </div>
                                  
                                  
                                 
                                    </div>
                                    <ul class="list-inline pull-right">
                                        <input type="hidden" value="1" name="type">
                                        <li><button type="button" class="default-btn prev-step btn" style="background-color: #276569;color:#fff;">Back</button></li> &nbsp;&nbsp;
                                         <!--<li><button type="button" class="default-btn next-step skip-btn">Skip</button></li> -->
                                        <li><input type="submit" id="Loan_Accept" class="default-btn next-step btn" value="Submit" style="background-color: #276569;color:#fff;"></li>
                                    </ul>
                                </div>
                                    <div class="clearfix"></div>
                            </div>
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
                
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


<style>
/* Style the input fields */
input {
  padding: 10px;
  width: 100%;
  font-size: 17px;
  font-family: Raleway;
  border: 1px solid #aaaaaa;
}

/* Mark input boxes that gets an error on validation: */
input.invalid {
  background-color: #ffdddd;
}

/* Hide all steps by default: */
.tab {
  display: none;
}

/* Make circles that indicate the steps of the form: */
.step {
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbbbbb;
  border: none;
  border-radius: 50%;
  display: inline-block;
  opacity: 0.5;
}

/* Mark the active step: */
.step.active {
  opacity: 1;
}

/* Mark the steps that are finished and valid: */
.step.finish {
  background-color: #04AA6D;
}
</style>


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
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

<script>
$(document).ready(function(){
    $("#loan_Form").submit(function(e){
    e.preventDefault();
    $.ajax({
    url:"handler/loanRequest.php",
    method:"POST",
    data:new FormData(this),
    contentType:false,
    cache:false,
    processData:false,
    beforeSend: function(xhr){xhr.setRequestHeader('Token', localStorage.getItem('Token'));},
    success: function(data)
    {
         let rslt = JSON.parse(data);
      let rscode = rslt.response_code;
      let msg = rslt.message;
       if(rscode == 1){
              Swal.fire({
                      icon: "success",
                      title: "Hurray!",
                      button: "Okay",
                      text: msg,
                    }).then(function(){ 
                      location.replace("LoanReport.php");
            });
                              
          }else{
              Swal.fire({
                      icon: "error",
                      title: "OOPS!",
                      button: "Close",
                      text: msg,
                    });
          }
    },
});
            $("#loan_Form")[0].reset();

});
});

</script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<!--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>-->
<script src="dist/js/demo.js"></script>

<!--<script src="js/Loan Request.js"></script>-->
<!--<script src="js/Main.js"></script>-->
<!-- Page specific script -->
    <script>
        // ------------step-wizard-------------
$(document).ready(function () {
    $('.nav-tabs > li a[title]').tooltip();

    //Wizard
    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {

        var target = $(e.target);
    
        if (target.parent().hasClass('disabled')) {
            return false;
        }
    });

    $(".next-step").click(function (e) {

        var active = $('.wizard .nav-tabs li.active');
        active.next().removeClass('disabled');
        nextTab(active);

    });
    $(".prev-step").click(function (e) {

        var active = $('.wizard .nav-tabs li.active');
        prevTab(active);

    });
});

function nextTab(elem) {
    $(elem).next().find('a[data-toggle="tab"]').click();
}
function prevTab(elem) {
    $(elem).prev().find('a[data-toggle="tab"]').click();
}


$('.nav-tabs').on('click', 'li', function() {
    $('.nav-tabs li.active').removeClass('active');
    $(this).addClass('active');
});



    </script>

</body>
</html>
