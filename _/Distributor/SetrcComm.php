<?php
include('../Db/config.php');
   
   
if(isset($_POST['submit-op'])){
    $id = trim($_POST['id']);
    $prcnt = trim($_POST['prcnt']);
    $type = trim($_POST['type']);
    $amtype = trim($_POST['amount_type']);
    $tds = trim($_POST['tds']);
    $gst = trim($_POST['gst']);
    
    $ds_com = trim($_POST['ds_com']);
    $ms_com = trim($_POST['ms_com']);
     if($con->query("update operator_comm set AMOUNT='$prcnt' , `DS_COM`='$ds_com', `MS_COM`='$ms_com' , TYPE='$type' , AMOUNT_TYPE='$amtype', TDS='$tds', GST='$gst'  where ID='$id'")){
        echo "<script>alert('updated')</script>";
    }
}


?>
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

<body class="hold-transition light-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
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
            <h1 class="m-0">Recharge Commission Setup</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Recharge Services Recharge Commission Setup</li>
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
                <h3 class="card-title">Recharge Commission Setup</h3>
              </div>
              <!-- /.card-header -->
             <div class="card">
              <!-- /.card-header -->
              
              <div class="card-body">
                    
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>SL No</th>
                    <th>Operator</th>
                    <th>Rt Comm</th>
                    <th>Ds Comm</th>
                    <th>Type</th>
                    <th>Amount Type</th>
                    <th>GST</th>
                    <th>TDS</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                    <tbody>
                 
                   <?php
                    $pak_id = $_GET['pack_id'];
                        $res = $con->query("SELECT * FROM operator_comm WHERE PACKAGE_ID='$pak_id' order by OP_NAME asc");
                        if($res->num_rows > 0){
                           $i=1;
                            while($row = $res->fetch_assoc()){
                                 ?>
                            <tr>
                             <form method="post">
                                <td><?php echo  $i++ ?></td>
                                <td><?php echo $row['OP_NAME'] ?></td>
                                <td><input type="text" name="prcnt" value='<?php echo $row['AMOUNT'] ?>' style="width:65px"></td>
                                <td><input type="text" name="ds_com" value='<?php echo $row['DS_COM'] ?>' style="width:65px"></td>
                                <td>
                                    <select name="type">
                                        <option value="PERCENTAGE"  <?php echo ($row['TYPE'] == "PERCENTAGE") ?"selected" :""  ?> >Percentage</option>
                                        <option value="FLAT" <?php echo ($row['TYPE'] == "FLAT") ?"selected" :""  ?> >Flat</option>
                                    </select>
                                </td>
                                <td>
                                 <select name="amount_type">
                                    <option value="DEBIT"<?php echo ($row['AMOUNT_TYPE'] == "DEBIT") ?"selected" :""  ?>>Debit</option>
                                    <option value="CREDIT" <?php echo ($row['AMOUNT_TYPE'] == "CREDIT") ?"selected" :""  ?>>Credit</option>
                                </select>
                                </td>
                                <td><input type="text" value='<?php echo $row['GST'] ?>'  style="width:65px"></td>
                                <td><input type="text" value='<?php echo $row['TDS'] ?>'  style="width:65px"></td>
                                <td>
                                    <input type="hidden" name="id" value="<?php echo $row['ID'] ?>">
                                    <button type="submit" name="submit-op" class="m-r-15 btn btn-primary" >Update</button>
                                </td>
                            </form>
                            </tr>
                            <?php
                              }
                            }
                                
                            ?>
                        
                     </tbody>
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

 <script>  
 $(document).ready(function(){  
      $('#setCom').click(function(e){ 
          e.preventDefault()
           var startRange = $('#start_range').val();  
           var endRange = $('#end_range').val();  
           var retailerComm = $('#retailer_comm').val();  
           var distributorComm = $('#distributor_comm').val();  
           var Gst = $('#gst').val();  
           var Tds = $('#tds').val();  
           var Commtype = $('#comm_type').val(); 
           if(startRange == "" || endRange == "" || retailerComm == "" || distributorComm == "" || Gst == "" || Tds == "" || Commtype == "" )  
           {  
                $('#response').html('<h4 class="text-danger">All Fields are required</h4>');  
           }  
           else  
           {  
                $.ajax({  
                     url:"handler/SetAePsCommission.php",  
                     method:"POST",  
                     data:$('#Aeps_Form').serialize(),  
                     success:function(data){  
                          $('form').trigger("reset");  
                          $('#response').fadeIn().html(data);  
                          setTimeout(function(){  
                               $('#response').fadeOut("slow");  
                          }, 5000);  
                     }  
                });  
           }  
      });  
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
