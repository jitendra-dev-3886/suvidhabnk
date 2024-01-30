<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>PayDeer | Dashboard </title>

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
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add New Member</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Add New Member</li>
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
                <h3 class="card-title">Add New Member</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form>
                <div class="card-body">
                
                <div class="form-row d-flex justify-content-around">
                    <div class="form-group col-md-4">
                        <label for="exampleInputEmail1">Member ID : Status</label>
                         <select class="form-control select2" value="MEMBERIDSTATUS" name="MEMBERIDSTATUS" style="width: 100%;">
                            <option>Select Status</option>
                          <option>Active</option>
                          <option>Deactive</option>
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="exampleInputEmail1">Subscription Plan Name</label>
                         <select class="form-control select2" value="MEMBERNAME" name="MEMBERNAME" style="width: 100%;">
                            <option>Plan 1</option>
                          <option>Plan 2</option>
                          <option>Plan 3</option>
                        </select>
                    </div>
                     <div class="form-group col-md-4">
                        <label for="exampleInputEmail1">Member ID : Type</label>
                         <select class="form-control select2" value="MEMBERNAME" name="MEMBERNAME" style="width: 100%;">
                            <option>Select Status</option>
                          <option>ID 1</option>
                          <option>ID 2</option>
                        </select>
                    </div>
                </div>
                <div class="form-row d-flex justify-content-around">
                    
                    <div class="form-group col-md-4">
                        <label for="exampleInputEmail1">Member Name</label>
                        <input type="text" value="MEMBERNAME" name="MEMBERNAME" class="form-control" placeholder="">
                      </div>
                
                    <div class="form-group col-md-4">
                        <label for="exampleInputEmail1">Mobile Number </label>
                        <input type="number" class="form-control" placeholder="">
                      </div>
                      <div class="form-group col-md-4">
                        <label for="exampleInputEmail1">Email ID </label>
                        <input type="text" class="form-control" placeholder="">
                      </div>
                </div>
                
                <div class="form-row d-flex justify-content-around">
                    <div class="form-group col-md-4">
                        <label for="exampleInputEmail1">Member ID</label>
                        <input type="text" class="form-control" placeholder="">
                      </div>
                      <div class="form-group col-md-4">
                        <label for="exampleInputEmail1">Upload Profile Picture</label>
                        <input type="file" class="form-control" placeholder="">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="exampleInputEmail1">Joining Date</label>
                        <input type="text" class="form-control" placeholder="">
                    </div>
                </div>
                
                
                
                
                
                 
                
                <div class="form-row d-flex justify-content-around">
                   <div class="form-group col-md-12">
                        <label><u>Permanent Address</u></label>
                        </div>
                        </div>
                <div class="form-row d-flex justify-content-around">
                    
                    <div class="form-group col-md-3">
                        <label for="exampleInputEmail1">Full Address:</label>
                        <input type="text" class="form-control" placeholder="">
                    </div>
                     <div class="form-group col-md-3">
                        <label for="exampleInputEmail1">State </label>
                         <select class="form-control select2" style="width: 100%;">
                            <option selected="selected">Alabama</option>
                            <option>Alaska</option>
                            <option>California</option>
                            <option>Delaware</option>
                            <option>Tennessee</option>
                            <option>Texas</option>
                            <option>Washington</option>
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="exampleInputEmail1">City </label>
                         <select class="form-control select2" style="width: 100%;">
                            <option selected="selected">Alabama</option>
                            <option>Alaska</option>
                            <option>California</option>
                            <option>Delaware</option>
                            <option>Tennessee</option>
                            <option>Texas</option>
                            <option>Washington</option>
                        </select>
                    </div>
                     <div class="form-group col-md-3">
                        <label for="exampleInputEmail1">Pin Code</label>
                         <select class="form-control select2" style="width: 100%;">
                            <option selected="selected">712222</option>
                            <option>823003</option>
                            <option>823003</option>
                            <option>823003</option>
                            <option>823003</option>
                        </select>
                    </div>
                </div>
                <div class="form-row d-flex justify-content-around">
                   <div class="form-group col-md-12">
                        <label><u>Office Address</u></label>
                        </div>
                        </div>
                <div class="form-row d-flex justify-content-around">
                    
                    <div class="form-group col-md-3">
                        <label for="exampleInputEmail1">Full Address:</label>
                        <input type="text" class="form-control" placeholder="">
                    </div>
                     <div class="form-group col-md-3">
                        <label for="exampleInputEmail1">State </label>
                         <select class="form-control select2" style="width: 100%;">
                            <option selected="selected">Alabama</option>
                            <option>Alaska</option>
                            <option>California</option>
                            <option>Delaware</option>
                            <option>Tennessee</option>
                            <option>Texas</option>
                            <option>Washington</option>
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="exampleInputEmail1">City </label>
                         <select class="form-control select2" style="width: 100%;">
                            <option selected="selected">Alabama</option>
                            <option>Alaska</option>
                            <option>California</option>
                            <option>Delaware</option>
                            <option>Tennessee</option>
                            <option>Texas</option>
                            <option>Washington</option>
                        </select>
                    </div>
                     <div class="form-group col-md-3">
                        <label for="exampleInputEmail1">Pin Code</label>
                         <select class="form-control select2" style="width: 100%;">
                            <option selected="selected">712222</option>
                            <option>823003</option>
                            <option>823003</option>
                            <option>823003</option>
                            <option>823003</option>
                        </select>
                    </div>
                </div>
                <div class="form-row d-flex justify-content-around">
                    <div class="form-group col-md-4">
                        <label for="exampleInputEmail1">Aadhar Number : </label>
                        <input type="number" class="form-control" placeholder="">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="exampleInputEmail1">PAN Number :</label>
                        <input type="text" class="form-control" placeholder="">
                    </div>
                     <div class="form-group col-md-4">
                        <label for="exampleInputEmail1">GST Number :</label>
                        <input type="text" class="form-control" placeholder="">
                    </div>
                </div>
                <div class="form-row d-flex justify-content-around">
                    
                <div class="form-group col-md-3">
                  <input type="file" class="form-control" placeholder=""><a class="badge badge-info right" >Upload Aadhar</a></input>
                </div>
                <div class="form-group col-md-3">
                  <input type="file" class="form-control" placeholder=""><a class="badge badge-info right" >Upload E-Stamp</a></input>
                </div>
                <div class="form-group col-md-3">
                  <input type="file" class="form-control" placeholder=""><a class="badge badge-info right" >Upload PAN</a></input>
                </div>
                <div class="form-group col-md-3">
                  <input type="file" class="form-control" placeholder=""><a class="badge badge-info right" >Upload Video KYC</a></input>
                </div>
                </div>
                <div class="form-row d-flex justify-content-around">
                   <div class="form-group col-md-12">
                        <label><u>Bank Account Details</u></label>
                        </div> 
                   
                </div>
                <div class="form-row d-flex justify-content-around">
                    
                    <div class="form-group col-md-3">
                        <label for="exampleInputEmail1">Account Holder Name</label>
                        <input type="text" class="form-control" placeholder="">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="exampleInputEmail1">Account Number</label>
                        <input type="text" class="form-control" placeholder="">
                    </div>
                     <div class="form-group col-md-3">
                        <label for="exampleInputEmail1">IFSC Code</label>
                        <input type="text" class="form-control" placeholder="">
                    </div>
                    <div class="form-group col-md-3">
                  <label >Bank Name</label>
                   <input type="text" Placeholder="" class="form-control">
                </div>
                </div>
      
            </div>
                <!-- /.card-body -->

                <div class="card-footer d-flex justify-content-center">
                  <button type="submit" class="btn btn-primary">Add Member</button>
                </div>
              </form>
            </div>
            <!-- /.card -->

  

          </div>
          
      
                </div>
                <!-- /.card-body -->

                
              </form>
            </div>
            <!-- /.card -->

  

          </div>
          <!-- right column -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

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
<!-- Select2 -->
<script src="plugins/select2/js/select2.full.min.js"></script>
<!-- Bootstrap4 Duallistbox -->
<script src="plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
<!-- InputMask -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/inputmask/jquery.inputmask.min.js"></script>
<!-- date-range-picker -->
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- bootstrap color picker -->
<script src="plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Bootstrap Switch -->
<script src="plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<!-- BS-Stepper -->
<script src="plugins/bs-stepper/js/bs-stepper.min.js"></script>
<!-- dropzonejs -->
<script src="plugins/dropzone/min/dropzone.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>


<!--State / Distric / Block Filter -->
<script>
var stateObject = {
"India": { "Delhi": ["new Delhi", "North Delhi"],
"Kerala": ["Thiruvananthapuram", "Palakkad"],
"Goa": ["North Goa", "South Goa"],
},
"Australia": {
"South Australia": ["Dunstan", "Mitchell"],
"Victoria": ["Altona", "Euroa"]
}, "Canada": {
"Alberta": ["Acadia", "Bighorn"],
"Columbia": ["Washington", ""]
},
}
window.onload = function () {
var countySel = document.getElementById("countySel"),
stateSel = document.getElementById("stateSel"),
districtSel = document.getElementById("districtSel");
for (var country in stateObject) {
countySel.options[countySel.options.length] = new Option(country, country);
}
countySel.onchange = function () {
stateSel.length = 1; // remove all options bar first
districtSel.length = 1; // remove all options bar first
if (this.selectedIndex < 1) return; // done
for (var state in stateObject[this.value]) {
stateSel.options[stateSel.options.length] = new Option(state, state);
}
}
countySel.onchange(); // reset in case page is reloaded
stateSel.onchange = function () {
districtSel.length = 1; // remove all options bar first
if (this.selectedIndex < 1) return; // done
var district = stateObject[countySel.value][this.value];
for (var i = 0; i < district.length; i++) {
districtSel.options[districtSel.options.length] = new Option(district[i], district[i]);
}
}
}
</script>
<!--State / Distric / Block Filter -->

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

<!-- Page specific script -->
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
