<?php
include("../Db/config.php");

if(isset($_GET['delete']))
{
    $row_id = strip_tags($_GET['id']);
    if($con->query("delete from switchOperator where ID='$row_id'")){
       header("location:switch_operator.php?status=add_switch_operator&?msg=successfully&desc=Switch Operator Deleted");
    }
}

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
            <h1 class="m-0">Switch Operator</h1>
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
                                    if($status == "add_switch_operator"){
                                     ?>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h5>Add Switch Operator</h5>
                                                    </div>
                                                    <div class="card-block my-3">
                                                        <form class="form-material" action="handler/switch_operator.php" method="post" enctype="multipart/form-data">
                                                            <div class="form-row d-flex justify-content-around">
                                                                <div class="form-group form-primary col-md-3">
                                                                    <label class="float-label">Product Name </label>
                                                                    <input required type="text" name="product_name" class="form-control">
                                                                </div>
                                                                <div class="form-group form-primary col-md-2">
                                                                    <label class="float-label">Long Code</label>
                                                                    <input required type="text" name="long_code" class="form-control">
                                                                </div>
                                                                <div class="form-group form-primary col-md-2">
                                                                    <label class="float-label">R-offer</label>
                                                                    <input required type="text" name="r_offer" class="form-control">
                                                                </div>
                                                                <div class="form-group form-primary col-md-2">
                                                                    <label class="float-label">Service Type</label>
                                                                      <input type='hidden' id="service_type">
                                                                    <select  required class="form-control fill" onChange="gettype(this.value);" name="service_type">
                                                                        <option value="" disabled selected>Select Service Type</option>
                                                                           <?php
                                                                $query = "SELECT * FROM service_manager order by ID asc";
                                                                $run = mysqli_query($con , $query);
                                              
                                                                while($row = mysqli_fetch_array($run)){
                                                        
                                                                echo "<option value='".$row['ID']."'>".$row['SERVICE']."</option>";
                                                                 }
                                                                    ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-row d-flex justify-content-around">
                                                                <div class="form-group form-primary col-md-3">
                                                                    <label class="float-label">Api User Code</label>
                                                                    <input required type="text" name="api_user_code" class="form-control">
                                                                </div>
                                                                <div class="form-group form-primary col-md-2">
                                                                    <label class="float-label">Min Amount</label>
                                                                    <input required type="number" name="min_amount" class="form-control">
                                                                </div>
                                                                <div class="form-group form-primary col-md-2">
                                                                    <label class="float-label">Max Amount</label>
                                                                    <input required type="number" name="max_amount" class="form-control">
                                                                </div>
                                                                <div class="form-group form-primary col-md-2">
                                                                    <label class="float-label">API Company</label>
                                                                    <select  class="form-control fill" onChange="getSubcat(this.value);" name="api_company">
                                                                        <option value="" disabled selected>Select Api Company</option>
                                                                         <?php
                                                                            $query = "SELECT * FROM `rechargeApi` order by ID asc";
                                                                            $run = mysqli_query($con , $query);
                                                          
                                                                            while($row = mysqli_fetch_array($run)){
                                                                    
                                                                            echo "<option value='".$row['ID']."'>".$row['NAME']."</option>";
                                                                             }
                                                                            ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-row mt-4 d-flex justify-content-around">
                                                                <div class="form-group form-primary col-md-3">
                                                                    <label class="float-label">API Product</label>
                                                                    <select class="form-control fill" id="product" name="api_product_name">

                                                                    </select>
                                                                </div>
                                                                <div class="form-group form-primary col-md-4">
                                                                    <label class="float-label">Operator Logo</label>
                                                                    <input required type="file" class="form-control fill" name="operator_logo">
                                                                </div>
                                                                <div class="form-group form-primary col-md-3">
                                                                    <label class="float-label">Status</label>
                                                                    <select  required class="form-control fill" name="status">
                                                                        <option value="" disabled selected>Select Status</option>
                                                                        <option value="active">Active</option>
                                                                        <option value="deactive">De-Active</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <!--<div class="form-row mt-4 d-flex justify-content-center">-->
                                                            <!--    <div class="col-md-8" style="margin-left: 30%;">-->
                                                            <!--        <button type="submit" name="add_switch" class="btn btn-primary"><i class="ti-panel"></i>Add Switch Switch Operators</button>-->
                                                            <!--    </div>-->
                                                            <!--</div>-->
                                                            <div class="row">
                                                                <div class="col text-center">
                                                                        <button type="submit" name="add_switch" class="btn btn-primary"><i class="ti-panel"></i>Add Switch Operators</button>
                                                                    </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                                <!-- Switch Operator Table -->
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h5>Switch Operator List</h5>
                                                    </div> 
                                                    <!--card-block table-border-style-->
                                                              <div class="card-body">
                                                                    <table id="example1" class="table table-bordered table-striped">
                                                                 <thead>
                                                                    <tr>
                                                                        <th>SL No</th>
                                                                        <th>PRODUCT NAME</th>
                                                                        <th>LONG CODE</th>
                                                                        <th>SERVICE TYPE </th>
                                                                        <th>MIN AMOUNT</th>
                                                                        <th>MAX AMOUNT</th>
                                                                        <th>API COMPANY</th>
                                                                        <th>BACKUP API</th>
                                                                        <th>API PRODUCT</th>
                                                                        <th>STATUS</th>
                                                                        <th>R OFFER</th>
                                                                        <th>API USER CODE </th>
                                                                        <th>LOGO</th>
                                                                        <th>Action</th>
                                                                        
                                                                    </tr>
                                                                </thead>
                                                                        <tbody>
                                                                   <?php
                                                                    $user_id = $_SESSION['id']; 
                                                                    $i = 1;
                                                                        $res = $con->query("SELECT * FROM switchOperator order by PRODUCTNAME ASC");
                                                                 
                                                                    if($res->num_rows > 0){
                                                                        while($paysprint = $res->fetch_assoc()){
                                                                            ?>
                                                                            
                                                                    <tr class="">
                                                                        <th scope="row"><?php echo $i++ ?></th>
                                                                        <td><?php echo $paysprint['PRODUCTNAME'] ?></td>
                                                                        <td><?php echo $paysprint['LONGCODE'] ?></td>
                                                                        <td><?php echo $paysprint['SERVICETYPE'] ?></td>
                                                                        <td><?php echo $paysprint['MINRCAMOUNT'] ?></td>
                                                                        <td><?php echo $paysprint['MAXRCAMOUNT'] ?></td>
                                                                        <?php 
                                                                            $api = $paysprint['APICOMPANY'];
                                                                            $api_name = $con->query("SELECT * FROM `rechargeApi` WHERE ID='$api'")->fetch_assoc();
                                                                            
                                                                        ?>
                                                                        <td><?php echo $api_name['NAME']; ?></td>
                                                                        <td><?php echo $paysprint['BACKUP_API'] ?></td>
                                                                        <td><?php echo $paysprint['APIPRODUCT'] ?></td> 
                                                                        <td><?php echo $paysprint['STATUS'] ?></td> 
                                                                         <td><?php echo $paysprint['roffer'] ?></td>
                                                                        <td><?php echo $paysprint['API_USER_CODE'] ?></td>
                                                                         <td> <img src="assets/switch_opertor/<?php echo $paysprint['LOGO']?>" width="50px"> </td> 
                                                                        
                                                                        <td><a href="switch_operator.php?status=edit_switch_operator&row_id=<?php echo $paysprint['ID'] ?>"><i class="fas fa-edit" style="font-size:20px;"></i></a>&nbsp;&nbsp;&nbsp;
                                                                        <a href="switch_operator.php?status=add_switch_operator&delete&id=<?php echo $paysprint['ID'] ?>"><i class="fas fa-trash" style="font-size:20px;"></i></a></td>
                                                                    </tr> 
                                                                    
                                                                <?php
                                                                 }
                                                                }
                                                                    
                                                                ?>   
                                                                </tbody>
                                                                    </table>
                                                               </div>
                                                         <!-- /.card-body End-->
                                                </div>
                                            <!-- Switch Operator table-->
                                        
                                            </div>
                                        </div>
                                           <?php
                                    }
                                    
                                    $row_id = $_GET['row_id'];
                                    if($status == "edit_switch_operator"){
                                        $paysprint_api = $con->query("SELECT * FROM `switchOperator` WHERE ID='$row_id' order by ID desc")->fetch_assoc();
                                     ?>
                                     
                                                <div class="page-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h5>Add Switch Operator</h5>
                                                    </div>
                                                    <div class="card-block my-3">
                                                        <form class="form-material" action="handler/switch_operator.php" method="post" enctype="multipart/form-data">
                                                            <div class="form-row d-flex justify-content-around">
                                                                <div class="form-group form-primary col-md-3">
                                                                     <input type="hidden" name="row_id" value="<?php echo $row_id ?>">
                                                                    <input required type="text" name="product_name" class="form-control"  value="<?php echo $paysprint_api['PRODUCTNAME'] ?>">
                                                                    <span class="form-bar"></span>
                                                                    <label class="float-label">Product Name </label>
                                                                </div>
                                                                <?php 
                                                                $api_product = $paysprint_api['APIPRODUCT'];
                                                                $op = $con->query("SELECT * FROM `operatorManager` WHERE ID='$api_product'")->fetch_assoc();
                                                                
                                                                ?>
                                                                <div class="form-group form-primary col-md-2">
                                                                    <input required type="text" name="long_code" class="form-control"  value="<?php echo $op['PRODUCTCODE'];  ?>" >
                                                                    <span class="form-bar"></span>
                                                                    <label class="float-label">Long Code</label>
                                                                </div>
                                                                <div class="form-group form-primary col-md-2">
                                                                    <input required type="text" name="r_offer" class="form-control"  value="<?php echo $paysprint_api['roffer'] ?>">
                                                                    <span class="form-bar"></span>
                                                                    <label class="float-label">R-offer</label>
                                                                </div>
                                                                <div class="form-group form-primary col-md-2">
                                                                  <input required type='hidden' id="service_type" value="<?php echo $paysprint_api['SERVICETYPE'] ?>">
                                                                    <select  required class="form-control fill" name="service_type" >
                                                                        <option value="<?php echo $paysprint_api['SERVICETYPE'] ?> "><?php echo $paysprint_api['SERVICETYPE'] ?> (Already Seleted )</option>
                                                                            <?php
                                                                $query = "SELECT * FROM service_manager order by ID asc";
                                                                $run = mysqli_query($con , $query);
                                              
                                                                while($row = mysqli_fetch_array($run)){
                                                        
                                                                echo "<option value='".$row['ID']."'>".$row['SERVICE']."</option>";
                                                                 }
                                                                    ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-row d-flex justify-content-around">
                                                                <div class="form-group form-primary col-md-3">
                                                                    <input required type="text" name="api_user_code" class="form-control"  value="<?php echo $paysprint_api['API_USER_CODE'] ?>">
                                                                    <span class="form-bar"></span>
                                                                    <label class="float-label">Api User Code</label>
                                                                </div>
                                                                <div class="form-group form-primary col-md-2">
                                                                    <input required type="number" name="min_amount" class="form-control"  value="<?php echo $paysprint_api['MINRCAMOUNT'] ?>">
                                                                    <span class="form-bar"></span>
                                                                    <label class="float-label">Min Amount</label>
                                                                </div>
                                                                <div class="form-group form-primary col-md-2">
                                                                    <input required type="number" name="max_amount" class="form-control"  value="<?php echo $paysprint_api['MAXRCAMOUNT'] ?>">
                                                                    <span class="form-bar"></span>
                                                                    <label class="float-label">Max Amount</label>
                                                                </div>
                                                                <div class="form-group form-primary col-md-2">
                                                                    
                                                                    <select  required  class="form-control fill" onChange="getSubcat(this.value);" name="api_company">
                                                                        <option value="<?php echo $paysprint_api['APICOMPANY'] ?>"><?php echo $paysprint_api['APICOMPANY'] ?></option>
                                                                         <?php
                                                                            $query = "SELECT * FROM rechargeApi order by ID asc";
                                                                            $run = mysqli_query($con , $query);
                                                                            while($row = mysqli_fetch_array($run)){
                                                                            echo "<option value='".$row['ID']."'>".$row['NAME']."</option>>";
                                                                             }
                                                                            ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-row mt-4 d-flex justify-content-around">
                                                                <div class="form-group form-primary col-md-3">
                                                                    <select  required class="form-control fill" id="product" name="api_product_name">
                                                                       <option value="<?php echo $paysprint_api['LONGCODE'] ?>"><?php echo $paysprint_api['PRODUCTNAME'] ?></option>
                                                                    
                                                                    </select>
                                                                </div>
                                                                <div class="form-group form-primary col-md-4">
                                                                    <img src="assets/switch_opertor/<?php echo $paysprint_api['LOGO'] ?>" height="100" width="100" class="img-fluid">
                                                                    <input type="file" class="form-control fill" name="operator_logo">
                                                                    <span class="form-bar"></span>
                                                                    <label class="float-label">Operator Logo</label>
                                                                </div>
                                                                <div class="form-group form-primary col-md-3">
                                                                    <select  required class="form-control fill" name="status" >
                                                                         <option value="<?php echo $paysprint_api['STATUS'] ?> "><?php echo $paysprint_api['STATUS'] ?> (Already Seleted )</option>
                                                                        <option value="active">Active</option>
                                                                        <option value="deactive">De-Active</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col text-center">
                                                                    <button type="submit" name="update_switch" class="btn btn-primary"><i class="ti-panel"></i>Update Switch Operators</button>
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
    //   "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
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
    function gettype(val){
        $("#service_type").val(val)
        console.log($("#service_type").val())
    }
    function getSubcat(val) {
    var type = $("#service_type").val();
    var op_id = val;
	$.ajax({
	type: "POST",
	url: "get_subcat.php",
	data:{op_id:op_id, type:type,},
	success: function(data , status){
	   // console.log(data);
		$("#product").html(data);
		
	}
	});
}
</script>
</body>
</html>
