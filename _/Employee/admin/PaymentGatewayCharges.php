<?php
session_start();
include("include/Connection/config.php");
include("include/FetchData/adminData.php");
include("include/Auth.php");
$row=$con->query("SELECT * FROM websetting")->fetch_assoc();

$admin_bnk=$con->query("SELECT * FROM `payment_gateway_charge` WHERE `ID`='1'")->fetch_assoc();
$CREDIT_CARD=$admin_bnk['CREDIT_CARD'];
$DEBIT_CARD=$admin_bnk['DEBIT_CARD'];
$WALLETS=$admin_bnk['WALLETS'];
$NET_BANK=$admin_bnk['NET_BANK'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard </title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- Bootstrap4 Duallistbox -->
  <link rel="stylesheet" href="plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
  <!-- BS Stepper -->
  <link rel="stylesheet" href="plugins/bs-stepper/css/bs-stepper.min.css">
  <!-- dropzonejs -->
  <link rel="stylesheet" href="plugins/dropzone/min/dropzone.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  
  
  
  <!-- Rich text-->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
  <!-- CodeMirror -->
  <link rel="stylesheet" href="plugins/codemirror/codemirror.css">
  <link rel="stylesheet" href="plugins/codemirror/theme/monokai.css">
  <!-- SimpleMDE -->
  <link rel="stylesheet" href="plugins/simplemde/simplemde.min.css">
  <!-- Rich text-->
  
  
  
    <style>
      img.notifyimg {
    width: 10rem;
}
  </style>
</head>

<body class="hold-transition light-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <!--<div class="preloader flex-column justify-content-center align-items-center">-->
  <!--  <img class="animation__wobble" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">-->
  <!--</div>-->
  
  
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
            <h1>Payment Gateway Charge</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Payment Gateway Charge</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Payment Gateway Charge</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
                   <form method = "post" id="adddata" name="adddata" enctype="multipart/form-data">
                <div class="card-body">
   
                   <div class="form-row d-flex justify-content-around">
                       
                       <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">Credit Card</label>
                          <input type="text" class="form-control" id="c_credit" name="c_credit" style="width: 100%;" value="<?php echo $CREDIT_CARD?>">
                          <input type="hidden" id ="id" name="id" value="9">
                      </div>
                     
                     <div class="form-group col-md-6">
                            <label for="exampleInputEmail1">Debit Card</label>
                            <input type="text" class="form-control" id="c_debit" name="c_debit" style="width: 100%;" value="<?php echo $DEBIT_CARD?>">
                        </div>
                     </div> 
                     <div class="form-row d-flex justify-content-around">
                       <div class="form-group col-md-6">
                            <label for="exampleInputEmail1">Wallets</label>
                            <input type="text" id="c_wallet" name="c_wallet" class="form-control" value="<?php echo $WALLETS?>">
                       </div>
                       <div class="form-group col-md-6">
                            <label for="exampleInputEmail1">Net Banking</label>
                            <input type="text" id="c_netbank" name="c_netbank" class="form-control" value="<?php echo $NET_BANK?>">
                       </div>
                     </div>
                  <!--<div class="form-row d-flex justify-content-around">   -->
                  <!--   <div class="form-group col-md-6">-->
                  <!--          <label for="exampleInputEmail1">IFSC Code</label>-->
                  <!--          <input type="text" id="ifsc_co" name="ifsc_co" class="form-control" value="<?php echo $acc_ifsc?>">-->
                  <!--   </div>-->
                  <!--   <div class="form-group col-md-6">-->
                  <!--          <label for="exampleInputEmail1">UPI ID</label>-->
                  <!--          <input type="text" id="upi_id" name="upi_id" class="form-control" value="<?php echo $upi_id?>">-->
                  <!--     </div>-->
                  <!--</div>  -->
              
                	<!-- -->
                    <!--<div class="form-row d-flex justify-content-around">   -->
                    <!--  <div class="form-group col-md-12">-->
                    <!--         <textarea id="summernote" name="richtext" id="richtext">-->
                    <!--          </textarea>-->
                    <!--   </div>-->
                    <!--</div>  -->
                  
				<!-- -->
                
                <!-- /.card-body -->

                <div class="card-footer d-flex justify-content-center">
                  <button type="submit" id="add_blog" name="add_blog" class="btn btn-primary">Update Charges</button>
                </div>
              </form>
            </div>
            <!-- /.card -->

  

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
<!--        <section class="content">-->
<!--      <div class="container-fluid">-->
<!--        <div class="row">-->
<!--          <div class="col-12">-->
            <!-- /.card -->

<!--            <div class="card">-->
<!--              <div class="card-header">-->
<!--                <h3 class="card-title">Blog List</h3>-->
<!--              </div>-->
              <!-- /.card-header -->
              
             
<!--              <div class="row">-->
<!--              <div class="search px-4 col-md-4">-->
<!--<label>From : </label>-->
<!--<input type="date" id="fromdate" value="<?php echo date("Y-m-d") ?>" class="form-control">-->
<!--</div>-->
<!--<div class="search px-4 col-md-4">-->
<!--<label>To : </label>-->
<!--<input type="date" id="todate" value="<?php echo date("Y-m-d") ?>" class="form-control">-->
<!-- </div>-->
<!--<div class="search px-4 col-md-2">-->
<!--<span id="datesbtn" class="searchicon" onclick="load_data()"><i class="fas fa-search"></i></span>-->
<!-- </div>-->
<!--</div>-->

<!--<h2 id="loadingtext" class="px-4"></h2>-->
              
<!--              <div class="card-body" id="tbcard">-->
                
<!--              </div>-->
              <!-- /.card-body -->
<!--            </div>-->
            <!-- /.card -->
<!--          </div>-->
          <!-- /.col -->
<!--        </div>-->
        <!-- /.row -->
<!--      </div>-->
      <!-- /.container-fluid -->
<!--    </section>-->

    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->


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

<script src="https://code.jquery.com/jquery-3.1.1.min.js">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js">
</script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js">
</script>
<!--JS below-->
<script>
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




<!--========= Rich text==============-->


<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<!-- CodeMirror -->
<script src="plugins/codemirror/codemirror.js"></script>
<script src="plugins/codemirror/mode/css/css.js"></script>
<script src="plugins/codemirror/mode/xml/xml.js"></script>
<script src="plugins/codemirror/mode/htmlmixed/htmlmixed.js"></script>

<!-- Page specific script -->
<script>
  $(function () {
    // Summernote
    $('#summernote').summernote()

    // CodeMirror
    CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
      mode: "htmlmixed",
      theme: "monokai"
    });
  })
</script>


<!--========= Rich text==============-->






<!--display-->
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
        url:"handler/Blog_reportt.php",
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
    
    

</script>


 <!--insert code-->
<script>
// $(document).ready(function(){
    $('#adddata').submit(function(e){
     e.preventDefault();
  $.ajax({
     url:"handler/Gateway_Charge.php",
     type:'POST',
     data : new FormData(this),
      processData: false,
      contentType: false,
     success: function(data){
       if(data == 1){
             Swal.fire({
              icon: 'success',
              title: 'Updated successfully..',
              button: 'Okay'
             }).then(function(){
                      location.replace('PaymentGatewayCharges.php');
             });
       
       }else{
                      Swal.fire({
  icon: 'error',
  title: 'OOPS..!',
  text: 'Something Went Wrong..!',
  button: 'Close'
});
     }
     },
 });
})
</script>

<!--delete code-->
<script>
  $(document).on("click",".delete-btn",function(){

var teamid=$(this).data("id");
$.ajax({
        url:"Blog_deleteee.php",
        type:"POST",
        data:{id:teamid},
        success:function(data){
      
     if(data==1){
          alert("Recorded deleted");
          location.replace("Add_Blog.php");
          displaystudent();
        }else{
             alert("Failed to deleted");
      }
      //  alert(delete);
      },

});
}); 
</script>


<!--update code-->

<script>
$.ajax({
         url:"handler/Blog_reporttt.php",
         type:"POST",
        data : new FormData(this),
         contentType:false,
         processData:false,
          success:function(data){
           if(data ==1){
            icon: 'success',
              title: 'Update successful..',
              button: 'Okay'
             }).then(function(){
                      location.replace('Add_Blog.php');
             });
           }
          });
});
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
  previewNode.id = ""
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

</body>
</html>
