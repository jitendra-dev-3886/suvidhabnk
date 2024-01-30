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
            <h1 class="m-0">Task Management</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Task Management</li>
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
                <h3 class="card-title">Send Task</h3>
              </div>
              <!-- /.card-header -->
              <form id="fupForm" action="" method="post" enctype="multipart/form-data">
                <div class="card-body">
                
                <div class="form-row d-flex justify-content-around ">
                    <div class="form-group col-md-3">
                        <label for="exampleInputEmail1">Select Task Type</label>
                        <select class="form-control select2" onchange="changeCom(this.value)" name="TASKTYPE" id="TASKTYPE" style="width: 100%;">
                            <option selected value="agent">Self</option>
                            <option value="company">Another</option>
                        </select>
                    </div>
                    <div class="form-group col-md-3" id="companyNameDiv" style="display:none">
                        <label for="exampleInputEmail1">Enter Mobile No</label>
                        <input type="text" class="form-control" name="ANOTHERMOBILENO" id="ANOTHERMOBILENO" placeholder="Enter Mobile No">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="exampleInputEmail1">Task Name</label>
                        <input type="text" name="TASKNAME" id="TASKNAME" class="form-control" placeholder="Enter Task Name">
                      </div>
                </div>
                <div class="form-row d-flex justify-content-around ">
                    <div class="form-group col-md-3">
                        <label for="exampleInputEmail1">Verified Name</label>
                        </div>
                    <div class="form-group col-md-3">
                        <label for="exampleInputEmail1">Verified Post</label>
                        </div>
                      <div class="form-group col-md-4">
                        <label for="exampleInputEmail1">Verified Location</label>
                        </div>
                </div>
                <div class="form-row d-flex justify-content-around ">
                    <div class="form-group col-md-11">
                        <label for="exampleInputEmail1">Enter Task</label>
                        <textarea id="ENTERTASK" name="ENTERTASK" rows="5" cols="120"></textarea>
                      </div>
                </div>
                <div class="form-row d-flex justify-content-around ">
                    <div class="form-group col-md-11">
                        <label for="exampleInputEmail1">Upload File</label>
                        <input type="file" id="pdf" name="pdf" class="form-control" placeholder="Name">
                      </div>
                </div>
                <div class="card-footer d-flex justify-content-center">
                  <button type="button" onclick="addTasks()" class="btn btn-primary">Add Task</button>
                </div>
                </div>
                </form>
                  <!-- /.card-body -->

             

             
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
  

<script>
    function changeCom(value){
        console.log(value);
        if(value == "company"){
            $("#companyNameDiv").show();
        }
        else{
            $("#companyNameDiv").hide();
        }
    }
</script>
  <!--==============  View Profile Modal ===================-->

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
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- Page specific script -->

<script src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous"></script>
  <script type="text/javascript" src="js/jquery.js"></script>
  <script type="text/javascript">
  
  
  
      function addTasks(){
          
          var TASKTYPE = $('#TASKTYPE').val();
          var TASKNAME = $('#TASKNAME').val();
          var ANOTHERMOBILENO = $('#ANOTHERMOBILENO').val();
          var ENTERTASK = $('#ENTERTASK').val();
          
          
          
          $.ajax({
              url:"api-inserttask.php",
              type:'post',
              data: { TASKTYPE : TASKTYPE,
                  TASKNAME : TASKNAME,
                  ANOTHERMOBILENO : ANOTHERMOBILENO,
                  ENTERTASK : ENTERTASK,
                  
              },
              success:function(data,status){
                  console.log(data);
                  //   readrecords();
              }
          });
      }
  </script>
</body>
</html>
