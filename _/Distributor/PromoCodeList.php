<?php
include("config.php");
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
            <h1 class="m-0">PromoCodeList</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">PromoCodeList</li>
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
                <h3 class="card-title">DataTable with default features</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                  <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>SL No</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Amount </th>
                    <th>Discount</th>
                    <th>Validity</th>
                    <th>Action</th>
                    <th>Date</th>
                  </tr>
                  </thead>
                  <tbody>
                      
                     <?php
                         $i = 1;
                         $res = $conn->query("SELECT * FROM `promocode` ORDER BY ID DESC");
                         if($res->num_rows > 0){
                             while($sublist = $res->fetch_assoc()){
                
                      ?>
                  <tr>
                    <td><?php echo $i++; ?></td>
                    <td><?php echo $sublist['NAME']; ?></td>
                    <td><?php echo $sublist['DESCRIPTION']; ?></td>
                    <td><?php echo $sublist['AMOUNT']; ?></td>
                    <td><?php echo $sublist['DISCOUNT']; ?></td>
                    <td><?php echo $sublist['VALIDITY']; ?></td>
	            	<td> <a href="PromoCodeList.php?id=<?php echo $sublist["ID"]; ?>"
	            	    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter"><span class="fas fa-edit"></span></button></a>
	            	<!--<a href="edit_CreateSubscription.php?delete&id=<?php// echo $sublist["ID"]; ?>" onclick="javascript:confirmationDelete($(this));return false;"><i class="fas fa-trash"></i></a>-->
	            	
	            	</td>
	            	 <td><?php echo $sublist['DATE']; ?></td>
                   </tr>
                   
                   <?php
                          } 
                  
                  }
                  ?>

                                  
                   <!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">PromoCode Edit</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <?php
                $promo_code = $conn->query("SELECT * FROM `subscription` ORDER BY ID DESC")->fetch_assoc();
             ?>
   <form method="post" id="editPromoCode">
                <div class="card-body">
                
                <div class="form-row d-flex">
                    <input type="hidden" name="promo_id" value="<?php echo $_GET['id'] ?>">
                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">Name</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Enter Name" value="<?php echo $promo_code['NAME'] ?>">
                      </div>
                      <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">Description</label>
                        <textarea type="text" name="desc" class="form-control" id="desc"  placeholder="Message"><?php echo $promo_code['DESCRIPTION'] ?></textarea>
                      </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">Amount</label>
                        <input type="number" class="form-control" name="amt" id="amt" placeholder="Enter Amount" value="<?php echo $promo_code['AMOUNT'] ?>">
                      </div>
                      <div class="form-group col-md-6">
                          <label for="exampleInputEmail1">Discount Type</label>
                          <select class="form-control" name="d_type" id="d_type">
                              <option value="<?php echo $promo_code['DISCOUNT'] ?>"><?php echo $promo_code['DISCOUNT'] ?></option>
                              <option value="<?php echo $promo_code['DISCOUNT'] ?>"><?php echo $promo_code['DISCOUNT'] ?></option>
                            </select>
                      </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">Validity</label>
                        <input type="text" class="form-control" name="validity" id="validity" placeholder="Enter Validity" value="<?php echo $promo_code['VALIDITY'] ?>">
                      </div>
                  </div>
      
            </div>
                <!-- /.card-body -->
                       <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" name="promoCode" class="btn btn-primary" id="promoCode">Edit PromoCode</button>
                          </div>
              </form>
                <div id="response"></div> 
                  <script>  
                  jQuery(document).ready(function () {
    jQuery("#promoCode").click(function () {
        jQuery("#basicModal").modal("show");
        
          console.log("Edit Button Clicked");
    let id = $(this).attr("data-sid");
    // console.log(id);
    mydata = { sid: id };
    });
});
                   </script>   

      </div>

    </div>
  </div>
</div>

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
