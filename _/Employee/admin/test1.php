
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>PayDeer | Dashboard </title>

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
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>

<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    
    <style>
        #pagination{
  text-align: center;
  padding: 10px;
}
#pagination a{
  background: #2980b9;
  color: #fff;
  text-decoration: none;
  display: inline-block;
  padding:5px 10px;
  margin-right: 5px;
  border-radius: 3px;
}
#pagination a.active{
  background: #27ae60;
}

    </style>
    
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
            <h1 class="m-0">Member List</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Member List</li>
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

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Member List Data Table</h3>
              </div>
              <!-- /.card-header -->
             <table id="example1" class="table table-bordered table-striped">
                 
                 <thead>
                  <tr>
                    <th>Member ID</th>
                    <th>Full Name</th>
                    <th>Mobile</th>
                    <th>Type</th>
                    <th>Owner</th>
                    <th>Profile</th>
                    <th>Status</th>
                  </tr>
                  </thead>
                 
            </table>
            
            
            <script>
                $(document).ready(function(){
                     $("#example1").DataTable({
                         "ajax" : {
                             "url" : "ajaxphp/atest.php",
                             "dataSrc" : ""
                         },
                         "columns" : [
                             {"data" : "ID"},
                             {"data" : "FIRST_NAME"}+' '+{"data" : "LAST_NAME"},
                             {"data" : "MOBILE"},
                             {"data" : "USER_TYPE"},
                             {"data" : "STATUS"}
                             
                             ]
                     });
                });
            </script>
            
            
              <!-- /.card-body -->
                
                
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
             <div id="mwrap">
            
         </div>
             
         <div class="row">
             <div class="col-12">
               <div class="form-row d-flex justify-content-between ">
                <div class="form-group col-md-3">
                  <a class="badge badge-info right" >Download Aadhar</a>
                </div>
                <div class="form-group col-md-3">
                  <a class="badge badge-info right" >Download E-Stamp</a>
                </div>
                <div class="form-group col-md-3">
                  <a class="badge badge-info right" >Download PAN</a>
                </div>
                <div class="form-group col-md-3">
                  <label class="badge badge-info right" >View Video KYC</label>
                </div>
                </div>
              </div>
          </div>     
             
         <div class="row">
             <label><u>Bank Account Details</u></label>
             <div class="col-12">
               <div class="form-row d-flex justify-content-between ">
                <div class="form-group col-md-3">
                  <label >Account Holder Name</label>
                  <input type="text" Placeholder="" class="form-control">
                </div>
                <div class="form-group col-md-3">
                   <label >Account Number</label>
                   <input type="number" Placeholder="" class="form-control">
                </div>
                <div class="form-group col-md-3">
                  <label >IFSC Code</label>
                   <input type="text" Placeholder="" class="form-control">
                </div>
                <div class="form-group col-md-3">
                  <label >Bank Name</label>
                   <input type="text" Placeholder="" class="form-control">
                </div>
                </div>
              </div>
          </div>     
             
             
         <div class="row">
             <label><u>Services</u> 
             --
            <span>OFF</span>
            <label class="switch">
              <input type="checkbox" checked>
              <span class="slider round"></span>
            </label>
            <span>ON</span>
            
            </label>
             <div class="col-12">
               <div class="form-row d-flex justify-content-between ">
                <div class="form-group col-md-3">
                  <label >AePs</label>
                   -
                   <span>OFF</span>
                    <label class="switch">
                      <input type="checkbox" checked>
                      <span class="slider round"></span>
                    </label>
                    <span>ON</span>
                </div>
                <div class="form-group col-md-3">
                   <label >DMT</label>
                    -
                   <span>OFF</span>
                    <label class="switch">
                      <input type="checkbox" checked>
                      <span class="slider round"></span>
                    </label>
                    <span>ON</span>
                </div>
                <div class="form-group col-md-3">
                  <label >X-DMT</label>
                   -
                   <span>OFF</span>
                    <label class="switch">
                      <input type="checkbox" checked>
                      <span class="slider round"></span>
                    </label>
                    <span>ON</span>
                </div>
                <div class="form-group col-md-3">
                  <label >Payout</label>
                   -
                   <span>OFF</span>
                    <label class="switch">
                      <input type="checkbox" checked>
                      <span class="slider round"></span>
                    </label>
                    <span>ON</span>
                </div>
                <div class="form-group col-md-3">
                  <label >Virtual Account</label>
                   -
                   <span>OFF</span>
                    <label class="switch">
                      <input type="checkbox" checked>
                      <span class="slider round"></span>
                    </label>
                    <span>ON</span>
                </div>
                </div>
              </div>
          </div> 
          
         <div class="row">
             <label><u>Commission Setup</u></label>
             <div class="col-12">
               <div class="form-row d-flex justify-content-between ">
                <div class="form-group col-md-4">
                  <label >AePs</label>
                   -
                  <select >
                      <option>Commission 1</option>
                      <option>Commission 2</option>
                      <option>Commission 3</option>
                  </select>
                </div>
                <div class="form-group col-md-4">
                  <label >DMT</label>
                   -
                  <select >
                      <option>Commission 1</option>
                      <option>Commission 2</option>
                      <option>Commission 3</option>
                  </select>
                </div>
                <div class="form-group col-md-4">
                  <label >Electric Bill</label>
                   -
                  <select >
                      <option>Commission 1</option>
                      <option>Commission 2</option>
                      <option>Commission 3</option>
                  </select>
                </div>
                
                </div>
              </div>
          </div>     


        </form>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary">Activity</button>
        <button type="button" class="btn btn-primary">Update</button>
      </div>
    </div>
  </div>
</div>
  <!--==============  View Profile Modal ===================-->
                
                
              
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
<script src="dist/js/demo.js"></script>
<script src="js/pagination.min.js"></script>
<!-- Page specific script -->

<!--<script>-->
<!--    $(document).ready(function(){-->
<!--        $("#abtn").click(function(e){-->
<!--          e.preventDefault();-->
<!--        });-->
<!--    });-->
<!--</script>-->


<script>
    $(document).ready(function(){
    // Load Table Records
    // function loadTable(){
    //   $.ajax({
    //     url : "ajaxphp/atest.php",
    //     type : "POST",
    //     success : function(data){
    //       $("#example1").append(data);
    //     }
    //   });
    // }
    
    // loadTable(); // Load Table Records on Page Load
    
    
    $(document).on("click","#mbtn",function(){
        var m_id = $(this).data("mid");
        $.ajax({
        url: "ajaxphp/select_modal.php",
        type: "POST",
        data: {mid: m_id },
        success: function(data) {
          $("#mwrap").html(data);
        }
      })
    });
    
    //  $(document).on("change","#mlimit",function() {
    //   var page_limit = $(this).val();
      
    // loadTable(page_limit);
    // });
    
    
    });
</script>

<!--<script>-->
<!--  $(function () {-->
<!--    $("#example1").DataTable({-->
<!--      "responsive": true, "lengthChange": false, "autoWidth": false,-->
<!--      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]-->
<!--    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');-->
<!--    $('#example2').DataTable({-->
<!--      "paging": true,-->
<!--      "lengthChange": false,-->
<!--      "searching": false,-->
<!--      "ordering": true,-->
<!--      "info": true,-->
<!--      "autoWidth": false,-->
<!--      "responsive": true,-->
<!--    });-->
<!--  });-->
<!--</script>-->
</body>
</html>
