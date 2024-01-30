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
            <h1>CreateSubscription</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Add CreateSubscription</li>
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
                <h3 class="card-title">Create Subscription</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method = "post" id="submit_form" name="submit_form">
                <div class="card-body">
                <?php
                if(isset($_GET['id'])){
                    $id = $_GET['id'];
                }
                
                $addpropertys = $conn->query("SELECT * FROM `subscription` WHERE ID = '$id'")->fetch_assoc();

                ?>
                <div class="form-row d-flex justify-content-around ">
                    <div class="form-group col-md-4">
						<input type="hidden" name="property_id" value="<?php echo $_GET['id'] ?>">
                        <label for="exampleInputEmail1">Name</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Enter Name" value="<?php echo  $addpropertys['NAME'] ?>">
                      </div>
                      <div class="form-group col-md-4">
                        <label for="exampleInputEmail1">Price</label>
                        <input type="number" class="form-control" name="price" id="price" placeholder="Enter price" value="<?php echo  $addpropertys['PRICE'] ?>">
                      </div>
                      <div class="form-group col-md-4">
                        <label for="exampleInputEmail1">Description</label>
                        <input type="text" class="form-control" name="desc" id="desc" placeholder="Write Something..." value="<?php echo  $addpropertys['DESCRIPTION'] ?>">
                      </div>
                </div>
                <div class="form-row d-flex justify-content-around">
                      <div class="form-group col-md-4">
                        <label for="exampleInputEmail1">Validity</label>
                        <input type="text" class="form-control" name="validity" id="validity" placeholder="Enter validity" value="<?php echo  $addpropertys['VALIDITY'] ?>">
                      </div>
                      <div class="form-group col-md-4">
                        <label for="exampleInputEmail1">User</label>
                        <input type="text" class="form-control" name="user" id="user" placeholder="Enter user" value="<?php echo  $addpropertys['USER'] ?>">
                      </div>
                      <div class="form-group col-md-4">
                        <label for="exampleInputEmail1">Status</label>
                          <select class="form-control" name="status" id="status">
                              <option value="<?php echo  $addpropertys['STATUS'] ?>"><?php echo  $addpropertys['STATUS'] ?></option>
                            </select>
                        <!--<label for="exampleInputEmail1">Status</label>-->
                        <!--<input type="text" class="form-control" name="status" id="status" placeholder="Status">-->
                      </div>
                </div>
      
            </div>
                <!-- /.card-body -->
                <div class="card-footer d-flex justify-content-center">
                  <button type="button" class="btn btn-primary" id="subscriptions">Updated Subscription</button>
                </div>
              </form>
               <div id="response"></div>  
            </div>
            <!-- /.card -->

  <?php
include("config.php");

 if(isset($_POST["name"]))  
 {  
      $property_id = $_POST['property_id'];
      $name = mysqli_real_escape_string($conn, $_POST["name"]);  
      $price = mysqli_real_escape_string($conn, $_POST["price"]);  
      $desc = mysqli_real_escape_string($conn, $_POST["desc"]);  
      $validity = mysqli_real_escape_string($conn, $_POST["validity"]);  
      $user = mysqli_real_escape_string($conn, $_POST["user"]);  
      $status = mysqli_real_escape_string($conn, $_POST["status"]);
      
      $query = "UPDATE `subscription` SET `NAME`='$name',`PRICE`='$price',`DESCRIPTION`='$desc',`VALIDITY`='$validity',`USER`='$user',`STATUS`='$status' WHERE ID = '$property_id'";  
      if(mysqli_query($conn, $query))  
       {  
           echo '<script type="text/javascript">alert("Subscription Updated")  
           location.replace("SubscriptionList.php")
</script>';

      }else{
           echo '<script type="text/javascript">alert("Failed to Create Subscription Updated")  
             location.replace("SubscriptionList.php")
</script>';
          
      } 
 } 
 
 	//delete query here
	if(isset($_GET['delete']))
  	{
      $id = $_GET['id'];
       $query = "DELETE FROM `subscription` WHERE ID = '$id'";
        $query_run =  mysqli_query($conn,$query);
        echo "<script> alert('Sucessfully SubscriptionList Deleted')
        location.replace('SubscriptionList.php');
        </script>
        ";
         
     }
?>
	<script>
        
        function confirmationDelete(anchor){
            var conf = confirm("Are You Want To Delete This?");
            if(conf){
                window.location.attr("href");
            }
        }
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
 <script>  
 $(document).ready(function(){  
      $('#subscriptions').click(function(e){ 
          e.preventDefault()
           var name = $('#name').val();  
           var price = $('#price').val();  
           var desc = $('#desc').val();  
           var validity = $('#validity').val();  
           var user = $('#user').val();  
           var status = $('#status').val();  
        //   console.log(name)
           
           if(name == "" || price == "" || desc == "" || validity == "" || user == "" || status == "" )  
           {  
                $('#response').html('<span class="text-danger">All Fields are required</span>');  
           }  
           else  
           {  
                $.ajax({  
                     url:"edit_CreateSubscription.php",  
                     method:"POST",  
                     data:$('#submit_form').serialize(),  
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
  

</body>
</html>
