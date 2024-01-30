<?php
session_start();

include("../Db/config.php");
require("include/Auth.php"); // user auth
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title> vehicle Insurance </title>

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

.wizard1{
    display:none;
}
  </style>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">vehicle Insurance </h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">vehicle Insurance </li>
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
                <h3 class="card-title">vehicle Insurance</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
                <div class="card-body">
                   <section class="signup-step-container">
        <div class="container">
           
            <div class="row d-flex justify-content-center">
                <div class="col-md-12">
                    <div class="wizard">
                       
                        <form method="post" class="loan_Form" id="vinsurance_Form">
                            <div class="tab-content" id="main_form">
                                <div class="tab-pane active" role="tabpanel" id="step1">
                                    <h4 class="text-center">Vehicle Insurance Request Form</h4>
                                    <div class="row">
                                      
                                        <div class="col-md-4">
                                               <div class="form-group">
                                            <label for="exampleInputEmail1">Insurance Type</label>
                                            <input type="hidden" name="page" value="1" />
                                            <select class="form-control" name="insurance_type" required id="loantype">
                                                <option>Select Insurance Type</option>
                                                <option value="Bike">Bike</option>
                                                <option value="Four Wheeler">Four Wheeler</option>
                                                <option value="Taxi">Taxi</option>
                                                <option value="Busn">Bus</option>
                                                <option value="Commercial Wheeler">Commercial Wheeler</option>
                                            </select>
                                         </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Name* (vehicle Owner) </label>
                                                <input type="text" name="vowner" id="cname" class="form-control" placeholder="Enter Customer Name" autocomplete="off" />
                                             </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>WhatsApp Number * </label>
                                                <input type="text" name="whatsappmob" id="mob" class="form-control" placeholder="Enter Mobile No" autocomplete="off" />
                                            </div>
                                        </div>
                                        <!--<div class="col-md-4" style="display:none;">-->
                                        <!--    <div class="form-group">-->
                                        <!--        <label>Verify Mobile No * </label>-->
                                        <!--        <input type="text" name="mob" id="otp" class="form-control" placeholder="Enter Mobile Otp" autocomplete="off" />-->
                                        <!--    </div>-->
                                        <!--</div>-->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Vechile Number * </label>
                                                <input type="text" name="vnum" id="vnum" class="form-control" placeholder="Vehicle number (Eg: MH12BG7327)" autocomplete="off" />
                                            </div>
                                        </div>
                                    </div>
                                     
                                </div>
                                
                                    </div>
                                    <ul class="list-inline pull-right">
                                      
                                        <li><input type="submit" name="fetch_vehicle" class="default-btn next-step vsfetchbtn btn" value="Fetch Vehicle" style="background-color: #276569;color:#fff;"></li>
                                    </ul>
                                    </form>
                                </div>
                                
                                
                                <div class="wizard1">
                       
                        
                                   
                                </div>
                                
                                    <div class="clearfix"></div>
                            </div>
                            
                        
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
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>


<script>
$(document).ready(function(){
    
    $("#vinsurance_Form").submit(function(e){
    e.preventDefault();
    $(".vsfetchbtn").val("Please Wait...");
   
    $.ajax({
    url:"Backend/VehicleRegistration/signzy/vehicleregistration_function.php",
    method:"POST",
    data:new FormData(this),
    contentType:false,
    cache:false,
    processData:false,
    beforeSend: function(xhr){xhr.setRequestHeader('Token', localStorage.getItem('Token'));},
    success: function(data)
    {
     $(".vsfetchbtn").val("Fetch Vehicle");
     let rslt = JSON.parse(data);
     let rs_code = rslt.response_code;
     let vdata = rslt.receivableData;
     let reqdata = rslt.requestedData;
     let msg = rslt.message;
     
     if(rs_code == 1){
         
         $(".wizard1").html(`
         <input type="hidden" id="res_data" />
         <input type="hidden" id="req_data" />
         <input type="hidden" id="instype" />
         <input type="hidden" id="insowner" />
         <input type="hidden" id="inswno" />
         <input type="hidden" id="insvno" />
         <ul class='list-group'>
  <li class='list-group-item'>Vehicle Name : ${vdata["result"]["model"]}</li>
  <li class='list-group-item'>Owner Name : ${vdata["result"]["owner"]}</li>
  <li class='list-group-item'>Owner FatherName : ${vdata["result"]["ownerFatherName"]}</li>
  <li class='list-group-item'>Owner Count : ${vdata["result"]["ownerCount"]}</li>
  <li class='list-group-item'>Mobile Number : ${vdata["result"]["mobileNumber"]}</li>
  <li class='list-group-item'>Number : ${vdata["result"]["regNo"]}</li>
  <li class='list-group-item'>Class : ${vdata["result"]["class"]}</li>
  <li class='list-group-item'>Engine : ${vdata["result"]["engine"]}</li>
  <li class='list-group-item'>Chassis Number : ${vdata["result"]["chassis"]}</li>
  <li class='list-group-item'>Manufacturer Name : ${vdata["result"]["vehicleManufacturerName"]}</li>
  <li class='list-group-item'>Vehicle Colour : ${vdata["result"]["vehicleColour"]}</li>
  <li class='list-group-item'>Vehicle Category : ${vdata["result"]["vehicleCategory"]}</li>
  <li class='list-group-item'>Norms Type : ${vdata["result"]["normsType"]}</li>
  <li class='list-group-item'>Body Type : ${vdata["result"]["bodyType"]}</li>
  <li class='list-group-item'>StatusAsOn : ${vdata["result"]["statusAsOn"]}</li>
  <li class='list-group-item'>Rc StandardCap : ${vdata["result"]["rcStandardCap"]}</li>
  <li class='list-group-item'>Vehicle Cylinders No : ${vdata["result"]["vehicleCylindersNo"]}</li>
  <li class='list-group-item'>Vehicle Seat Capacity : ${vdata["result"]["vehicleSeatCapacity"]}</li>
  <li class='list-group-item'>Vehicle Sleeper Capacity : ${vdata["result"]["vehicleSleeperCapacity"]}</li>
  <li class='list-group-item'>Vehicle Standing Capacity : ${vdata["result"]["vehicleStandingCapacity"]}</li>
  <li class='list-group-item'>Wheel base : ${vdata["result"]["wheelbase"]}</li>
  <li class='list-group-item'>Pucc Number : ${vdata["result"]["puccNumber"]}</li>
  <li class='list-group-item'>Pucc Upto : ${vdata["result"]["puccUpto"]}</li>
  <li class='list-group-item'>Blacklist Status : ${vdata["result"]["blacklistStatus"]}</li>
  <li class='list-group-item'>Permit IssueDate : ${vdata["result"]["permitIssueDate"]}</li>
  <li class='list-group-item'>Permit Number : ${vdata["result"]["permitNumber"]}</li>
  <li class='list-group-item'>Permit Type : ${vdata["result"]["permitType"]}</li>
  <li class='list-group-item'>Permit Valid From : ${vdata["result"]["permitValidFrom"]}</li>
  <li class='list-group-item'>Permit Valid Upto : ${vdata["result"]["permitValidUpto"]}</li>
  <li class='list-group-item'>National Permit Number : ${vdata["result"]["nationalPermitNumber"]}</li>
  <li class='list-group-item'>National Permi tUpto : ${vdata["result"]["nationalPermitUpto"]}</li>
  <li class='list-group-item'>National Permit IssuedBy : ${vdata["result"]["nationalPermitIssuedBy"]}</li>
  <li class='list-group-item'>is Commercial : ${vdata["result"]["isCommercial"]}</li>
  <li class='list-group-item'>nocDetails : ${vdata["result"]["nocDetails"]}</li>
  <li class='list-group-item'>Type : ${vdata["result"]["type"]}</li>
  <li class='list-group-item'>Reg. Authority : ${vdata["result"]["regAuthority"]}</li>
  <li class='list-group-item'>Reg. Date : ${vdata["result"]["regDate"]}</li>
  <li class='list-group-item'>Vehicle Manufacturing MonthYear : ${vdata["result"]["vehicleManufacturingMonthYear"]}</li>
  <li class='list-group-item'>Rc ExpiryDate : ${vdata["result"]["rcExpiryDate"]}</li>
  <li class='list-group-item'>vehicle TaxUpto : ${vdata["result"]["vehicleTaxUpto"]}</li>
  <li class='list-group-item'>Vehicle Insurance CompanyName : ${vdata["result"]["vehicleInsuranceCompanyName"]}</li>
  <li class='list-group-item'>vehicle Insurance Upto : ${vdata["result"]["vehicleInsuranceUpto"]}</li>
  <li class='list-group-item'>Rc Financer : ${vdata["result"]["rcFinancer"]}</li>
  <li class='list-group-item'>Vehicle Cubic Capacity : ${vdata["result"]["vehicleCubicCapacity"]}</li>
  <li class='list-group-item'>Gross Vehicle Weight : ${vdata["result"]["grossVehicleWeight"]}</li>
  <li class='list-group-item'>Unladen Capacity : ${vdata["result"]["unladenWeight"]}</li>
  <li class='list-group-item'>Vehicle Cubic Capacity : ${vdata["result"]["vehicleCubicCapacity"]}</li>
  <li class='list-group-item'>Address : ${vdata["result"]["presentAddress"]}</li>
  <li class='list-group-item'>Address Line : ${vdata["result"]["splitPresentAddress"]["addressLine"]}</li>
  <li class='list-group-item'>District : ${vdata["result"]["splitPresentAddress"]["district"][0]}</li>
  <li class='list-group-item'>State : ${vdata["result"]["splitPresentAddress"]["state"][0][0]}</li>
  <li class='list-group-item'>City : ${vdata["result"]["splitPresentAddress"]["city"][0]}</li>
  <li class='list-group-item'>Pincode : ${vdata["result"]["splitPresentAddress"]["pincode"]}</li>
  <li class='list-group-item'>Country : ${vdata["result"]["splitPresentAddress"]["country"][2]}</li>
  </ul>
  
  <ul class="list-inline pull-right mt-3">
  <li><input type="button" name="submit" id="vsbtn" class="default-btn next-step btn" value="Submit" style="background-color: #276569;color:#fff;"></li>
     </ul>

         
         `);
         
         
    $("#req_data").val(JSON.stringify(reqdata));
    $("#res_data").val(JSON.stringify(vdata));
    $("#instype").val($("#loantype").val());
    $("#insowner").val($("#cname").val());
    $("#inswno").val($("#mob").val());
    $("#insvno").val($("#vnum").val());
         
         Swal.fire({
              icon: "success",
              title: "Hurray!",
               button: "Okay",
              text: 'Vehicle Fetch Successfull',
            }).then(function(){ 
                  $(".wizard").hide();                       
                  $(".wizard1").show(); 
                                       
            });
     }else{
         Swal.fire({
              icon: "error",
              title: "OOPS..!",
               button: "Close",
              text: rslt.message,
            })
     }
     
        $("#vinsurance_Form")[0].reset();
    },
});
});

$(document).on("click","#vsbtn",function(){
    
    $("#vsbtn").val("Please Wait...");
    
    let request_data = $("#req_data").val();
    let res_data = $("#res_data").val();
    var instype = $("#instype").val();
    var insowner = $("#insowner").val();
    var inswno = $("#inswno").val();
    var insvno = $("#insvno").val();
    
    $.ajax({
    url:"Backend/VehicleRegistration/signzy/vehicleregistration_function.php",
    type :"POST",
    data : {
        vehcData:res_data,
        reqData:request_data,
        insurance_type:instype,
        insurance_ownername:insowner,
        insurance_wno:inswno,
        insurance_vno:insvno,
        page:2
        
    },
    beforeSend: function(xhr){xhr.setRequestHeader('Token', localStorage.getItem('Token'));},
    success: function(data)
    {
        $("#vsbtn").val("Submit");
        
        let rslt = JSON.parse(data);
        let rs_code = rslt.response_code;
        let message = rslt.message;
        
        if(rs_code == 1){
            
            Swal.fire({
              icon: "success",
              title: "Hurray!",
               button: "Okay",
              text: message,
            }).then(function(){ 
                location.replace("VehicleInsuranceRequest");
            });
            
        }else{
            
             Swal.fire({
              icon: "error",
              title: "OOPS..!",
               button: "Close",
              text: message,
            });
        }
    }
   });
  });

 });

</script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<!--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>-->
<script src="dist/js/demo.js"></script>

<!--<script src="js/vehicle Insurance.js"></script>-->
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
