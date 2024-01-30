<?php
session_start();
include('../Db/config.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>PayDeer | News </title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  
  <!-- Select2 -->
  <link rel="stylesheet" href="plugins/select2/css/select2.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>

<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__wobble" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
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
            <h1 class="m-0">News</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">News</li>
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
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Add New News</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method = "post" id="addNews" name="addNews">
                <div class="card-body">
                
                <div class="form-row d-flex justify-content-around ">
                    <div class="form-group col-md-5" id="user_type">
                        <label for="exampleInputEmail1">Select User</label>
                        <!--<input type="text" class="form-control" name="name" id="name" placeholder="All User">-->
                        <select class="form-control" name="d_type" id="d_type" onchange="changeCom(this.value)">
                              <option value="All User">All User</option>
                              <option value="Distributor">Distributor</option>
                              <option value="Retailer">Retailer</option>
                              <option value="Employee">Employee</option>
                            </select>
                      </div>
                      
                      
                      <div class="form-group col-md-5" id="city">
                        <label for="exampleInputEmail1">Select State</label>
                        <!--<textarea type="text" name="desc" class="form-control" id="desc" rows="5" cols="25" placeholder="Message"></textarea>-->
                        <?php
                        
                        $sql = $con->query("SELECT STATE FROM user");
                
                        ?>
                        <select name="city" class="form-control select2" style="width: 100%;">
                             <option selected disabled>Select State</option>
                             <option>All State</option>
                            <?php
                            while($row = $sql->fetch_assoc()){
                            
                            ?>
                            
                            <option value = "<?php echo $row['STATE'] ?>"><?php echo $row['STATE']?></option>
                            
                            <?php } ?>
                            
                        </select>
                      </div>
                      
                      
                      <div class="form-group col-md-5" id="distributor" style="display:none">
                        <label for="exampleInputEmail1">Select Distrbuter</label>
                        <!--<textarea type="text" name="desc" class="form-control" id="desc" rows="5" cols="25" placeholder="Message"></textarea>-->
                        <?php
                        
                        $sql = $con->query("SELECT * FROM user WHERE USER_TYPE = '47'");
                
                        ?>
                        <select name="distributor" class="form-control select2" style="width: 100%;">
                             <option selected disabled>Select Distributor</option>
                             <option value ='All Distributor'>All Distributor</option>
                            <?php
                            while($row = $sql->fetch_assoc()){
                            
                            ?>
                            
                            <option value = "<?php echo $row['ID'] ?>"><?php echo $row['FIRST_NAME'].' '.$row['LAST_NAME'] ?> ( <?php echo $row['MOBILE'] ?> )</option>
                            
                            <?php } ?>
                            
                        </select>
                      </div>
                </div>
                <div class="form-row d-flex justify-content-around">
                    <div class="form-group col-md-5" id="retailer" style="display:none">
                        <label for="exampleInputEmail1">Select Retailer</label>
                        <!--<textarea type="text" name="desc" class="form-control" id="desc" rows="5" cols="25" placeholder="Message"></textarea>-->
                        <?php
                        
                        $sql = $con->query("SELECT * FROM user WHERE USER_TYPE = '46'");
                
                        ?>
                        <select name="retailer" class="form-control select2" style="width: 100%;">
                             <option selected disabled>Select Retailer</option>
                             <option>All Retailer</option>
                            <?php
                            while($row = $sql->fetch_assoc()){
                            
                            ?>
                            <option value = "<?php echo $row['ID'] ?>"><?php echo $row['FIRST_NAME'].' '.$row['LAST_NAME'] ?> ( <?php echo $row['MOBILE'] ?> )</option>
                            
                            <?php } ?>
                            
                        </select>
                      </div>
                      
                    <div class="form-group col-md-5" id="employee" style="display:none">
                        <label for="exampleInputEmail1">Select Employee</label>
                        <!--<textarea type="text" name="desc" class="form-control" id="desc" rows="5" cols="25" placeholder="Message"></textarea>-->
                        
                        <select name="employee" class="form-control select2" style="width: 100%;">
                             <option selected disabled>Select Employee</option>
                             <option>All Employee</option>
                            </select>
                      </div>
                </div>
                <div class="form-row d-flex justify-content-around">
                    <div class="form-group col-md-5" id="news">
                        <label for="exampleInputEmail1">News Text</label>
                        <!--<input type="text" class="form-control" name="validity" id="validity" placeholder="Enter Validity">-->
                        <textarea type="text" name="desc" class="form-control" id="desc" rows="5" cols="25" placeholder="Message"></textarea>
                      </div>
                  </div>
                  <div class="form-group col-md-5" id="employee" style="display:none">
                        <label for="exampleInputEmail1">Select Employee</label>
                        <!--<textarea type="text" name="desc" class="form-control" id="desc" rows="5" cols="25" placeholder="Message"></textarea>-->
                        
                        <select name="employee" class="form-control select2" style="width: 100%;">
                             <option selected disabled>Select Employee</option>
                             <option>All Employee</option>
                            </select>
                      </div>
                      <!--<div class="row">-->
                          <!--<div class="col-6">-->
                          <div class="form-row d-flex justify-content-around">
                              <div class="col-md-5" id="fromdate1">
                      <label>From : </label>
<input type="date" name="fromdate1" value="<?php echo date("Y-m-d") ?>" class="form-control">
</div>
<!--<div class="col-6">-->
<div class="col-md-5" id="todate1">
<!--<div class="search px-4 col-md-4">-->
<label>To : </label>
<input type="date" name="todate1" value="<?php echo date("Y-m-d") ?>" class="form-control">
 </div>
 </div>
      
            </div>
                <!-- /.card-body -->

                <div class="card-footer d-flex justify-content-center">
                  <button type="submit" class="btn btn-primary" id="add_news">Add News</button>
                </div>
              </form>
                <div id="response"></div>  
            </div>
            <!-- /.card -->

  

          </div>
          <!--/.col (left) -->
          <!-- right column -->
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
        <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <!-- /.card -->

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">News Table</h3>
              </div>
              <!-- /.card-header -->
              
              <div class="row">
              <div class="search px-4 col-md-4" >
<label>From : </label>
<input type="date" id="fromdate" value="<?php echo date('Y-m-d',strtotime("-1 month")) ?>" class="form-control">
</div>
<div class="search px-4 col-md-4">
<label>To : </label>
<input type="date" id="todate" value="<?php echo date("Y-m-d") ?>" class="form-control">
 </div>
<div class="search px-4 col-md-2">
<span id="datesbtn" class="searchicon" onclick="load_data()"><i class="fas fa-search"></i></span>
 </div>
</div>

<!--<h2 id="loadingtext" class="px-4"></h2>-->
              
              <div class="card-body" id="tbcard">
                
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


 <style>
     .switch {
  position: relative;
  display: inline-block;
  width: 40px;
  height: 17px;
}

.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 13px;
  width: 13px;
  left: 0px;
  bottom: 2px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
 </style> 
  <!--==============  View Profile Modal ===================-->

<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Member Profile</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <form>
             
            
             
             
         <div class="row">
             <label><u>Details</u></label>
             <div class="col-12">
               <div class="form-row d-flex justify-content-between ">
                <div class="form-group col-md-4">
                  <label >Name</label>
                  <input type="text" Placeholder="" class="form-control">
                </div>
                
                <div class="form-group col-md-4">
                  <label >Agent Id.</label>
                   <input type="text" Placeholder="" class="form-control">
                </div>
                <div class="form-group col-md-4">
                  <label >Agent Mobile No.</label>
                   <input type="text" Placeholder="" class="form-control">
                </div>
                
                </div>
              </div>
              <div class="col-12">
               <div class="form-row d-flex justify-content-between ">
                <div class="form-group col-md-4">
                  <label >Message 1</label>
                  
                </div>
                <div class="form-group col-md-12">
                <div class="alert alert-primary" role="alert">This is a primary alert—check it out!</div>
                </div>
                </div>
              </div>
              <div class="col-12">
               <div class="form-row d-flex justify-content-between ">
                <div class="form-group col-md-4">
                  <label >Message 2</label>
                  
                </div>
                <div class="form-group col-md-12">
                <div class="alert alert-success" role="alert">This is a success alert—check it out!</div>
                </div>
                
                </div>
              </div>
          </div>     
             
             
         
            
 
        </form>
        </div>
        
    </div>
  </div>
</div>
<script>
    function changeCom(value){
        console.log(value);
        if(value == "Distributor"){
            $("#distributor").show();
            $("#retailer").hide();
            $("#employee").hide();
        }
         else if (value == "Retailer"){
            $("#retailer").show();
            $("#distributor").hide();
            $("#employee").hide();
        }
         else if (value == "All User"){
            $("#retailer").hide();
            $("#distributor").hide();
            $("#employee").hide();
        }
        else if(value == "Employee"){
            $("#employee").show();
            $("#distributor").hide();
            $("#retailer").hide();
        }
       
       
    }
</script>
  <!--==============  View Profile Modal ===================-->
<!--========= Edit Modal =========-->
  
<!--  <div class="modal fade" id="exampleModaleditcompany" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">-->
<!--  <div class="modal-dialog modal-dialog-centered" role="document">-->
<!--    <div class="modal-content">-->
<!--      <div class="modal-header">-->
<!--        <h5 class="modal-title" id="exampleModalLongTitle">Edit</h5>-->
<!--        <button type="button" class="close" data-dismiss="modal" aria-label="Close">-->
<!--          <span aria-hidden="true">&times;</span>-->
<!--        </button>-->
<!--      </div>-->
<!--      <div class="modal-body">-->
<!--        <form>-->
<!--            <section class="content">-->
<!--      <div class="container-fluid">-->
<!--        <div class="row">-->
<!--          <div class="col-12">-->
            <!-- /.card -->
<!--            <div class="card">-->
<!--<div class="card-body">-->
                
<!--                <div class="form-row d-flex justify-content-around ">-->
                    
<!--                      <div class="form-group col-md-10">-->
<!--                        <label for="exampleInputEmail1">Name</label>-->
<!--                        <input type="text" class="form-control" placeholder="Name">-->
<!--                      </div>-->
<!--                      <div class="form-group col-md-10">-->
<!--                        <label for="exampleInputEmail1">agent id.</label>-->
<!--                        <input type="text" class="form-control" placeholder="agent id.">-->
<!--                      </div>-->
<!--                      <div class="form-group col-md-10">-->
<!--                        <label for="exampleInputEmail1">agent mobile no.</label>-->
<!--                        <input type="text" class="form-control" placeholder="agent mobile no.">-->
<!--                      </div>-->
<!--                </div>-->
<!--                </div>-->
<!--                <div class="card-footer d-flex justify-content-center">-->
<!--                  <button class="btn btn-primary" type="submit" onclick="bootstrapAlert()">Transaction</button>-->
<!--                </div>-->
<!--                </div>-->
            
            <!-- /.card -->
<!--          </div>-->
          <!-- /.col -->
<!--        </div>-->
        <!-- /.row -->
<!--      </div>-->
      <!-- /.container-fluid -->
<!--    </section>-->
<!--        </form>-->
<!--      </div>-->
<!--      <div class="modal-footer">-->
        
<!--      </div>-->
<!--    </div>-->
<!--  </div>-->
<!--</div>-->
<div class="modal fade" id="update_user_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Response</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body" >
            <div id='edit_modal'> 

            </div>
        </div>
       
      </div>
    </div>
  </div>
  <!--========= Company Edit Modal =========-->

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
<!-- Select2 -->
<script src="plugins/select2/js/select2.full.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- Page specific script -->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
        url:"handler/News_Report.php",
        method:"POST",
        data:{pageid:2,formdate:fromd,todate:tod},
        success:function(data)
        {
            
        $("#loadingtext").text("");
          $('#tbcard').html(data);
          
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
        }
      });
    }
    
    
//      $("#datesbtn").on("click",function(){
    
//     var fromd = $("#fromdate").val();
//     var tod = $("#todate").val();
        
//         $.ajax({
//             url : "ajaxphp/date_range.php",
//             type : "POST",
//             data : {formdate:fromd,todate:tod,pageid:2},
//             success : function(response){
//                 $('#tbcard').html(response);
                
//                 $("#example1").DataTable({
//       "responsive": true, "lengthChange": false, "autoWidth": false,
//       "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
//     }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
//     $('#example2').DataTable({
//       "paging": true,
//       "lengthChange": false,
//       "searching": false,
//       "ordering": true,
//       "info": true,
//       "autoWidth": false,
//       "responsive": true,
//     });
//             }
//         });
    
// });

    
   
    
//     });
</script>
// <script>
//     $(document).ready(function(){
//       readRecord();
// </script>
// <script>
//   $(document).ready(function(){
//  $('#add_news').click(function(e){ 
//         //   console.log("CLicked button");
//           e.preventDefault()
//           {  
//                 $.ajax({  
//                      url:"handler/News_Report.php",  
//                      method:"POST",  
//                      data:$('#addNews').serialize(),  
//                      success:function(data){
//                                   if(data == 1){
//                                       Swal.fire({
//                                               icon: "success",
//                                               title: "Hurray!",
//                                               button: "Okay",
//                                               text: 'Prome code Add Successfully.',
//                                             }).then(function(){ 
//                                               location.replace("index.php");
//                                     });
//                                         //   $('#lmodal').modal('hide');
//                                   }else{
//                                       popup('error' , 'OOPS..!' ,"Failed to Add Promocode !");
//                                   }
//                           $('form').trigger("reset");  
//                           $('#response').fadeIn().html(data);  
//                           setTimeout(function(){  
//                               $('#response').fadeOut("slow");  
//                           }, 5000);  
//                      }  
//                 });  
//           }  
//       });  
//   });  
  
    
// </script>
<script>
    $('#add_news').click(function(e){
        e.preventDefault();
  $.ajax({
     url:"handler/News_Report.php",
     type:'POST',
     data :$("#addNews").serialize(),
     success: function(data){
       if(data == 1){
        Swal.fire({
              icon: 'success',
              title: 'News added successfully..',
              button: 'Okay'
             }).then(function(){
                      location.replace('News.php');
             });

    //   $('#add_data')[0].reset();
           
       }else{
            Swal.fire({
  icon: 'error',
  title: 'OOPS..!',
  text: 'News added Unsuccessfull..!',
  button: 'Close'
});
      }
    //      readRecord();
     },

 });
})
</script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date picker
    $('#reservationdate').datetimepicker({
        format: 'L'
    });

    //Date and time picker
    $('#reservationdatetime').datetimepicker({ icons: { time: 'far fa-clock' } });

    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({
      timePicker: true,
      timePickerIncrement: 30,
      locale: {
        format: 'MM/DD/YYYY hh:mm A'
      }
    })
    //Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )

    //Timepicker
    $('#timepicker').datetimepicker({
      format: 'LT'
    })

    //Bootstrap Duallistbox
    $('.duallistbox').bootstrapDualListbox()

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    $('.my-colorpicker2').on('colorpickerChange', function(event) {
      $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
    })

    $("input[data-bootstrap-switch]").each(function(){
      $(this).bootstrapSwitch('state', $(this).prop('checked'));
    })

  })
  // BS-Stepper Init
  document.addEventListener('DOMContentLoaded', function () {
    window.stepper = new Stepper(document.querySelector('.bs-stepper'))
  })

  // DropzoneJS Demo Code Start
  Dropzone.autoDiscover = false

  // Get the template HTML and remove it from the doumenthe template HTML and remove it from the doument
  var previewNode = document.querySelector("#template")
 
  var previewTemplate = previewNode.parentNode.innerHTML
  previewNode.parentNode.removeChild(previewNode)

  var myDropzone = new Dropzone(document.body, { // Make the whole body a dropzone
    url: "/target-url", // Set the url
    thumbnailWidth: 80,
    thumbnailHeight: 80,
    parallelUploads: 20,
    previewTemplate: previewTemplate,
    autoQueue: false, // Make sure the files aren't queued until manually added
    previewsContainer: "#previews", // Define the container to display the previews
    clickable: ".fileinput-button" // Define the element that should be used as click trigger to select files.
  })

  myDropzone.on("addedfile", function(file) {
    // Hookup the start button
    file.previewElement.querySelector(".start").onclick = function() { myDropzone.enqueueFile(file) }
  })

  // Update the total progress bar
  myDropzone.on("totaluploadprogress", function(progress) {
    document.querySelector("#total-progress .progress-bar").style.width = progress + "%"
  })

  myDropzone.on("sending", function(file) {
    // Show the total progress bar when upload starts
    document.querySelector("#total-progress").style.opacity = "1"
    // And disable the start button
    file.previewElement.querySelector(".start").setAttribute("disabled", "disabled")
  })

  // Hide the total progress bar when nothing's uploading anymore
  myDropzone.on("queuecomplete", function(progress) {
    document.querySelector("#total-progress").style.opacity = "0"
  })

  // Setup the buttons for all transfers
  // The "add files" button doesn't need to be setup because the config
  // `clickable` has already been specified.
  document.querySelector("#actions .start").onclick = function() {
    myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED))
  }
  document.querySelector("#actions .cancel").onclick = function() {
    myDropzone.removeAllFiles(true)
  }
  // DropzoneJS Demo Code End
</script>
<script>
    $(document).on("click", ".edit_btn",function(){
//   alert("btn worked");
  // open modal
  $('#update_user_modal').modal("show");

  var edit_id = $(this).data("mid");
//   console.log(edit_id)
  $.ajax({
     url:"News_edit.php",
     type:'POST',
     data :{pageid:9,sid:edit_id},
     success: function(data){
        $('#edit_modal').html(data); 
        // alert(data);
     },
 });
});

// update

$(document).on("click", "#update",function(){
//   alert("btn worked");
  var up_id = $("#update_id").val();
  var up_type = $("#update_user_type").val();
  var up_distributer = $("#update_distributer_name").val();
  var up_retailer = $("#update_retailer_name").val();
  var up_employee = $("#update_employee_name").val();
  var up_news = $("#update_news_text").val();
  
  // testing value
//   console.log(up_id);
//   console.log(up_status);
//   console.log(up_remark);
 
  
  $.ajax({
     url:"handler/News_Report.php",
     type:'POST',
     data :{id:7,updates_id:up_id,update_user_type:up_type,update_distributer_name:up_distributer,update_retailer_name:up_retailer,update_employee_name:up_employee,update_news_text:up_news},
     success: function(data){

         if(data == 1){
          Swal.fire({
              icon: 'success',
              title: 'Update successful..',
              button: 'Okay'
             }).then(function(){
                      location.replace('News.php');
             });
        load_data();
         }

     },
 });
})
</script>


</body>
</html>
