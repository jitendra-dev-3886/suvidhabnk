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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    
  
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script>
        function fun(){
            document.getElementById('NAME').value='';
            document.getElementById('WORKINGTYPE').value='';
            document.getElementById('WORKINGCRITERIA').value='';
            document.getElementById('REPORTINGTO').value='';
            }
    </script>

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
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>PromoCode</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Add PromoCode</li>
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
                <h3 class="card-title">Add New PromoCode</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method = "post" id="addPromoCode" name="addPromoCode">
                <div class="card-body">
                
                <div class="form-row d-flex justify-content-around ">
                    <div class="form-group col-md-5">
                        <label for="exampleInputEmail1">Name</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Enter Name">
                      </div>
                      <div class="form-group col-md-5">
                        <label for="exampleInputEmail1">Description</label>
                        <textarea type="text" name="desc" class="form-control" id="desc" rows="5" cols="25" placeholder="Message"></textarea>
                      </div>
                </div>
                <div class="form-row d-flex justify-content-around">
                    <div class="form-group col-md-5">
                        <label for="exampleInputEmail1">Amount</label>
                        <input type="number" class="form-control" name="amt" id="amt" placeholder="Enter Amount">
                      </div>
                      <div class="form-group col-md-5">
                          <label for="exampleInputEmail1">Discount Type</label>
                          <select class="form-control" name="d_type" id="d_type">
                              <option value="Percentage">Percentage</option>
                              <option value="Flat">Flat</option>
                            </select>
                      </div>
                </div>
                <div class="form-row d-flex justify-content-around">
                    <div class="form-group col-md-5">
                        <label for="exampleInputEmail1">Validity</label>
                        <input type="text" class="form-control" name="validity" id="validity" placeholder="Enter Validity">
                      </div>
                  </div>
      
            </div>
                <!-- /.card-body -->

                <div class="card-footer d-flex justify-content-center">
                  <button type="submit" class="btn btn-primary" id="promoCode">Create PromoCode</button>
                </div>
                 
              </form>
                <div id="response"></div>  
            </div>
            <!-- /.card -->

  <script>  
 $(document).ready(function(){  
      $('#promoCode').click(function(e){ 
        //   console.log("CLicked button");
          e.preventDefault()
           var name = $('#name').val();  
           var desc = $('#desc').val();  
           var amt = $('#amt').val();  
           var d_type = $('#d_type').val();  
           var validity = $('#validity').val();  
           
        //   console.log(name)
           
           if(name == "" || desc == "" || amt == "" || d_type == "" || validity == "")  
           {  
                $('#response').html('<h4 class="text-danger">All Fields are required</h4>');  
           }  
           else  
           {  
                $.ajax({  
                     url:"handler/promoCode.php",  
                     method:"POST",  
                     data:$('#addPromoCode').serialize(),  
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

          </div>
          <!--/.col (left) -->
          <!-- right column -->
          <!--/.col (right) -->
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
  $(document).ready(function(){
          $("#save").click(function(e){
              e.preventDefault();
              
             
                   $.ajax({
                  url : "api-insert.php",
                  type : "POST",
                  data : $("#addempform").serialize(),
                  success : function(data){
                      alert(data);
                  }
              });
              
              
          });
     
     
  });  
  
    
</script>


</body>
</html>
