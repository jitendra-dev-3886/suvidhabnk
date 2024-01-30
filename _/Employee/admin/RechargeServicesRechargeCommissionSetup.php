<?php            
session_start();
// error_reporting(E_ALL);
// ini_set("display_errors" , 1);
include("../Db/config.php");

// exit;

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
            <h1 class="m-0">Recharge Services RechargeCommission</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Recharge Services RechargeCommission</li>
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
                <h3 class="card-title">Recharge Services RechargeCommission</h3>
              </div>
              <!-- /.card-header -->
              <form id="rccomm_setup">
                <div class="card-body">
               <div class="form-row d-flex justify-content-around ">
                    <div class="form-group col-md-3">
                        <label for="exampleInputEmail1">Select Commission Type</label>
                        <select class="form-control select2" name="user_comm" id="user_comm" onchange="changeCom(this.value)" style="width: 100%;" required>
                            <option selected value="46">Agent</option>
                            <option value="company">Company</option>
                        </select>
                    </div>
                    <div class="form-group col-md-4" id="companyNameDiv" style="display:none">
                        <label for="exampleInputEmail1">Select Company Name Type</label>
                        <select class="form-control select2" name="company_name" id="company_name">
                            <option value="Paysprint">Paysprint</option>
                            <option value="Paytm">Paytm</option>
                            <option value="other">other</option>
                        </select>
                    </div>
                      <div class="form-group col-md-4">
                        <label for="exampleInputEmail1">Name</label>
                        <input type="text" class="form-control" placeholder="COMPANY NAME" name="pack_name" id="pack_name" required>
                      </div>
                </div>
                </div>
                <div class="card-footer d-flex justify-content-center">
                  <button type="submit" id="rccom_save" name="rccom_save" class="btn btn-primary">Set Commission Setup</button>
                </div>
                </form>
                </div>
                  <!-- /.card-body -->

             <div class="card">
            <div class="card-header">
                <h3 class="card-title">Commission type : Agent</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                 <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>SL No</th>
                    <th>Name</th>
                    <th>Created Date</th>
                    <th>Setup Commission</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                        //  include('config.php');
                         $i=1;
                         $res= $con->query("SELECT * FROM `commission_package` WHERE USER_TYPE='46' AND SERVICES='Recharge' ORDER BY ID DESC");
                         if($res->num_rows >0){
                             while($row = $res->fetch_assoc()){
                      
                      ?>
                  <tr>
                    <td><?php echo $i++ ?></td>
                    <td><?php echo $row['PACKAGE_NAME'] ?></td>
                    <td><?php echo $row['DATE'] ?></td>
                    <td><a href="SetrcComm.php?pack_id=<?php echo $row['ID'] ?>" class="badge badge-info right">Go For Setup</a></td>
                    <td><a href="#" class="fas fa-edit"  name="edit"  data-toggle="modal" data-target="#exampleModaledit" id="<?php echo $row["id"]; ?>"></a>&nbsp;  &nbsp; <a href="javascript:void(0)" onclick = "deletedata(<?php echo $row['ID']; ?>)"><i class="fas fa-trash"></i></i></a></i></td>

                  <!-- Modal -->
                    <div class="modal fade" id="exampleModaledit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                       <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Edit</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" id="insert_form">  
            <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <!-- /.card -->
            <div class="card">
<div class="card-body">
                
                <div class="form-row d-flex justify-content-around ">
                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">Select Commission Type</label>
                        <select class="form-control select2" name="user_comm" id="user_comm" style="width: 100%;">
                            <option selected value="46">Agent</option>
                            <option value="company">Company</option>
                            </select>
                    </div>
                      <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">Name</label>
                        <input type="text" class="form-control" name="company_name" id="company_name" placeholder="Name">
                      </div>
                      <div class="card-footer d-flex justify-content-center">
                  
                  <input type="submit" name="" id="edit-submit" value="submit" class="btn btn-primary" />  
                     
                </div>
                </div>
                </div>
                </div>
            
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
        </form>
      </div>
      <div class="modal-footer">
        
      </div>
    </div>
  </div>
                    </div>
                    <!-- Modal -->                  
                  
                  
                  
                  
                  
                  </tr>
                  <?php } } ?>
                  </tbody>
                  <tfoot>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
              
               
            </div>

             <div class="card">
            <div class="card-header">
                <h3 class="card-title">Commission type : Company</h3>
              </div>
              <!-- /.card-header -->
              
              <div class="card-body">
                    
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>SL No</th>
                    <th>Company Name</th>
                    <th>Name</th>
                    <th>Created Date</th>
                    <th>Setup Commission</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                         <?php
                        //  include("../Db/config.php");
                         $i=1;
                         $res= $con->query("SELECT * FROM `commission_package` WHERE USER_TYPE='company' AND SERVICES='Recharge' ORDER BY ID DESC");
                         if($res->num_rows >0){
                             while($row = $res->fetch_assoc()){
                      
                      ?>
                  <tr>
                    <td><?php echo $i++ ?></td>
                    <td><?php echo $row['COMPANY_NAME'] ?></td>
                    <td><?php echo $row['PACKAGE_NAME'] ?></td>
                    <td><?php echo $row['DATE'] ?></td>
                    <td><span class="badge badge-info right">Go For Setup</span></td>
                    <td><a href="SetrcComm.php?pack_id=<?php echo $row['ID'] ?>" class="badge badge-info right">Go For Setup</a></td>
                    <td><a  class="fas fa-edit edit_data"  name="edit" value="Edit" data-toggle="modal" data-target="#exampleModaledit" id="<?php echo $row["id"]; ?>"></a>&nbsp;  &nbsp; 
                    <a name="button" onclick = "deletedata(<?php echo $row['ID']; ?>);"><i class="fas fa-trash"></i></i></a></i></td>
                  
                  </tr>
                  </tbody>
                 <?php } } ?>
                </table>
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
  
  <!--========= Agent Edit Modal =========-->
<!-- Modal -->
<div class="modal fade" id="exampleModaledit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Edit</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
            <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <!-- /.card -->
            <div class="card">
<div class="card-body">
                
                <div class="form-row d-flex justify-content-around ">
                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">Select Commission Type</label>
                        <select class="form-control select2" style="width: 100%;">
                            <option selected="selected">Company</option>
                            <option>Agent</option>
                            </select>
                    </div>
                      <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">Name</label>
                        <input type="text" class="form-control" placeholder="Name">
                      </div>
                      <div class="card-footer d-flex justify-content-center">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                </div>
                </div>
                </div>
            
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
        </form>
      </div>
      <div class="modal-footer">
        
      </div>
    </div>
  </div>
</div>
  <!--========= Edit Modal =========-->
  
  <div class="modal fade" id="exampleModaleditcompany" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Edit</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method = "post" name="contact-form">
            <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <!-- /.card -->
            <div class="card">
<div class="card-body">
                
                <div class="form-row d-flex justify-content-around ">
                    <div class="form-group col-md-3">
                        <label for="exampleInputEmail1">Select Commission Type</label>
                        <select class="form-control select2"  onchange="changeCom(this.value)" style="width: 100%;">
                            <option selected value="agent">Agent</option>
                            <option value="company">Company</option>
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="exampleInputEmail1">Select Company Name Type</label>
                        <select class="form-control select2">
                            <option value="Paysprint">Paysprint</option>
                            <option value="Paytm">Paytm</option>
                            <option value="other">other</option>
                        </select>
                    </div>
                      <div class="form-group col-md-4">
                        <label for="exampleInputEmail1">Name</label>
                        <input type="text" class="form-control" placeholder="Name">
                      </div>
                </div>
                </div>
                <div class="card-footer d-flex justify-content-center">
                  <button type="submit" class="btn btn-primary">Set Commission Setup</button>
                </div>
                </div>
            
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
        </form>
      </div>
      <div class="modal-footer">
        
      </div>
    </div>
  </div>
</div>
  <!--========= Company Edit Modal =========-->

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

<script>

   function deletedata(id){
       $.ajax({
                   url: "handler/rc_service_rcCommSetup.php",
                  type : "POST",
                  data : {id,pageid:1},
                  success : function(data){
                      if(data == 1){
                      alert("Failed to Delete data");
                  }else{
                      alert("Data Delete Successfully");
                      
                  }
                  }
                   
              });
   }

       $(document).ready(function(){

          $("#rccom_save").click(function(e){
              e.preventDefault();
            //   console.log("hELLO");
                  $.ajax({
                   url: "handler/rc_service_rcCommSetup.php",
                  type : "POST",
                  data : $("#rccomm_setup").serialize(),
                  success : function(data){
                      alert(data);
                     $('form').trigger("reset");  
                  }
                   
              });
              
              
          });
          
  }); 
</script>
    
    
</body>
</html>
