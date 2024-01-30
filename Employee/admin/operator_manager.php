<?php
session_start();
include("../Db/config.php");

$row = $con->query("SELECT * FROM `websetting`")->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard </title>

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

<body class="hold-transition light-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    
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
    <img class="animation__wobble" src="../assets/img/<?php echo $row['I_LOGO'] ?>" alt="AdminLTELogo" width="120">
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

            <!--<div class="card">-->
            <!--  <div class="card-header">-->
            <!--    <h3 class="card-title">Member List Data Table</h3>-->
            <!--  </div>-->
              <!-- /.card-header -->
            <!--  <div class="card-body">-->
            <!--      <div class="container-fluid mt-4">-->
            <?php
                                     $status = $_GET['status'];
                                    if($status == "add_operator_manager"){
                                     ?>
                                    <!-- Page body start -->
                                    <div class="page-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h5>Add Operator</h5>
                                                    </div>
                                                    <div class="card-block my-3">
                                                        <form class="form-material" action="handler/operator_manager.php" method="post">
                                                            <div class="form-row d-flex justify-content-around">
                                                                <div class="form-group form-primary col-md-3">
                                                                    <select name="selectservice" required class="form-control">
                                                                        <option value="" selected disabled>Select Service</option>
                                                                         <?php
                                                                $query = "SELECT * FROM service_manager order by ID asc";
                                                                $run = mysqli_query($con , $query);
                                              
                                                                while($row = mysqli_fetch_array($run)){
                                                        
                                                                echo "<option value='".$row['SERVICE']."'>".$row['SERVICE']."</option>>";
                                                                 }
                                                                    ?>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group form-primary col-md-3">
                                                                    <select name="serviceapi" required class="form-control ">
                                                                        <option value="select">Select Service Api</option>
                                                                         <?php
                                                                $query = "SELECT * FROM rechargeApi order by ID asc";
                                                                $run = mysqli_query($con , $query);
                                              
                                                                while($row = mysqli_fetch_array($run)){
                                                        
                                                                echo "<option value='".$row['NAME']."'>".$row['NAME']."</option>>";
                                                                 }
                                                                ?>
                                                                    </select>
                                                                </div>
                                                                <!--<div class="form-group form-primary col-md-3">-->
                                                                <!--    <select name="backupapi" class="form-control">-->
                                                                <!--        <option value="select">Select Backup Api</option>-->
                                                                <!--        <option value="service 1">service Api 1</option>-->
                                                                <!--        <option value="service 2">service Api 2</option>-->
                                                                <!--    </select>-->
                                                                <!--</div>-->
                                                                <div class="form-group form-primary col-md-3">
                                                                    <input type="text" name="productname" required class="form-control">
                                                                    <span class="form-bar"></span>
                                                                    <label class="float-label">Product Name / State</label>
                                                                </div>
                                                            </div>
                                                            <div class="form-row d-flex justify-content-around">
                                                                <div class="form-group form-primary col-md-3">
                                                                    <input type="text" name="productcode"required  class="form-control">
                                                                    <span class="form-bar"></span>
                                                                    <label class="float-label">Product Code from api doc</label>
                                                                </div>
                                                                <div class="form-group form-primary col-md-3">
                                                                    <select name="apiservicename" required class="form-control ">
                                                                        <option value="" disabled selected>Select Type</option>
                                                                        <option value="operator">Operator</option>
                                                                        <option value="circle">Circle</option>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group form-primary col-md-3">
                                                                    <select name="status" required class="form-control ">
                                                                        <option value="" disabled selected>Select Status</option>
                                                                        <option value="active">Active</option>
                                                                        <option value="deactive">De-Active</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-row mt-4 d-flex justify-content-center">
                                                                <div class="col-md-8">
                                                                    <button  type="submit" name="submitoperator_manager" class="btn waves-effect waves-light btn-primary btn-block btn-outline-primary"><i class="ti-panel"></i>Add Operators</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                                <!-- Operator Table -->
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h5>Operator List</h5>
                                                        <span>You can active deactive or update and delete the Operators</span>
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
                                                                        <th>Service</th>
                                                                        <th>Api Name</th>
                                                                        <th>Backup Api</th>
                                                                        <th>Product Name</th>
                                                                        <th>Api Code</th>
                                                                        <th>Op type</th>
                                                                        <th>Status</th>
                                                                        
                                                                        <th>Action</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                       <?php
                                                                    $user_id = $_SESSION['id']; 
                                                                    $i = 1;
                                                                        $res = $con->query("SELECT * FROM operatorManager order by ID desc");
                                                                 
                                                                    if($res->num_rows > 0){
                                                                        while($paysprint = $res->fetch_assoc()){
                                                                            ?>
                                                                            
                                                                    <tr class="">
                                                                        <th scope="row"><?php echo $i++ ?></th>
                                                                        <td><?php echo $paysprint['SERVICE'] ?></td>
                                                                        <td><?php echo $paysprint['SERVICEAPI'] ?></td>
                                                                        <td><?php echo $paysprint['BACKUPAPI'] ?></td>
                                                                        <td><?php echo $paysprint['PRODUCTNAME'] ?></td>
                                                                        <td><?php echo $paysprint['PRODUCTCODE'] ?></td>
                                                                        <td><?php echo $paysprint['APISERVICENAME'] ?></td>
                                                                        <td><?php echo $paysprint['STATUS'] ?></td>
                                                                       
                                                                        
                                                                        <td><a href="operator_manager.php?status=edit_operator_manager&row_id=<?php echo $paysprint['ID'] ?>"><i class="ti-pencil-alt" style="font-size:20px;"></i></a>&nbsp;&nbsp;&nbsp;
                                                                        <a href="operator_manager.php?status=add_operator_manager&delete&id=<?php echo $paysprint['ID'] ?>"><i class="ti-trash" style="font-size:20px;"></i></a></td>
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
                                        <!--Operator table-->
                                        
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Page body end -->
                                         <?php
                                    }
                                    
                                    $row_id = $_GET['row_id'];
                                    if($status == "edit_operator_manager"){
                                        $paysprint_api = $con->query("SELECT * FROM `operatorManager` WHERE ID='$row_id' order by ID desc")->fetch_assoc();
                                     ?>
                                       <div class="page-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h5>Add Operator</h5>
                                                    </div>
                                                    <div class="card-block my-3">
                                                        <form class="form-material" action="handler/operator_manager.php" method="post">
                                                            
                                                            <div class="form-row d-flex justify-content-around">
                                                                <div class="form-group form-primary col-md-3">
                                                                     <input type="hidden" name="row_id" value="<?php echo $row_id ?>">
                                                                    <select name="selectservice" class="form-control">
                                                                         <option value="<?php echo $paysprint_api['SERVICE'] ?> "><?php echo $paysprint_api['SERVICE'] ?> (Already Seleted )</option>
                                                                       <?php
                                                                $query = "SELECT * FROM service_manager order by ID asc";
                                                                $run = mysqli_query($con , $query);
                                              
                                                                while($row = mysqli_fetch_array($run)){
                                                        
                                                                echo "<option value='".$row['SERVICE']."'>".$row['SERVICE']."</option>>";
                                                                 }
                                                                    ?>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group form-primary col-md-3">
                                                                    <select name="serviceapi" class="form-control ">
                                                                       <option value="<?php echo $paysprint_api['SERVICEAPI'] ?> "><?php echo $paysprint_api['SERVICEAPI'] ?> (Already Seleted )</option>
                                                                         <?php
                                                                $query = "SELECT * FROM rechargeApi order by ID asc";
                                                                $run = mysqli_query($con , $query);
                                              
                                                                while($row = mysqli_fetch_array($run)){
                                                        
                                                                echo "<option value='".$row['NAME']."'>".$row['NAME']."</option>>";
                                                                 }
                                                                ?>
                                                                    </select>
                                                                </div>
                                                               
                                                                <div class="form-group form-primary col-md-3">
                                                                    <input type="text" name="productname" class="form-control" value="<?php echo $paysprint_api['PRODUCTNAME'] ?> ">
                                                                    <span class="form-bar"></span>
                                                                    <label class="float-label">Product Name / State</label>
                                                                </div>
                                                            </div>
                                                            <div class="form-row d-flex justify-content-around">
                                                                <div class="form-group form-primary col-md-3">
                                                                    <input type="text" name="productcode" class="form-control" value="<?php echo $paysprint_api['PRODUCTCODE'] ?> ">
                                                                    <span class="form-bar"></span>
                                                                    <label class="float-label">Product Code from api doc</label>
                                                                </div>
                                                                <div class="form-group form-primary col-md-3">
                                                                    <select name="apiservicename" class="form-control ">
                                                                         <option value="<?php echo $paysprint_api['APISERVICENAME'] ?> "><?php echo $paysprint_api['APISERVICENAME'] ?> (Already Seleted )</option>
                                                                        <option value="operator">Operator</option>
                                                                        <option value="circle">Circle</option>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group form-primary col-md-3">
                                                                    <select name="status" class="form-control ">
                                                                         <option value="<?php echo $paysprint_api['STATUS'] ?> "><?php echo $paysprint_api['STATUS'] ?> (Already Seleted )</option>
                                                                        <option value="active">Active</option>
                                                                        <option value="deactive">De-Active</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-row mt-4 d-flex justify-content-center">
                                                                <div class="col-md-8">
                                                                    <button  type="submit" name="update_operator_manager" class="btn waves-effect waves-light btn-primary btn-block btn-outline-primary"><i class="ti-panel"></i>Add Operators</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                                 </div>
                                                </div>
                                                </div>
                                                 <?php
                                    
                                    } 
                                    ?>
                                </div>
                            </div>
                            <!-- Main-body end -->
                            
      <!--        </div>-->
              <!-- /.card-body -->
              
      <!--      </div>-->
            <!-- /.card -->
      <!--    </div>-->
          <!-- /.col -->
      <!--  </div>-->
        <!-- /.row -->
      <!--</div>-->
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
     load_data(1);

    function load_data(page, query = '')
    {
      $.ajax({
        url:"ajaxphp/select_user.php",
        method:"POST",
        data:{page:page, query:query},
        success:function(data)
        {
          $('#cbody').html(data);
        }
      });
    }

    
    $(document).on("keyup","#search_box",function(){
      var query = $(this).val();
      load_data(1, query);
    });
    
    $(document).on('click', '.page-link', function(){
      var page = $(this).data('page_number');
      var query = $('#search_box').val();
      load_data(page, query);
    });
    
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
</body>
</html>
